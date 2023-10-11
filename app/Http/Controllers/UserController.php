<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Account;
use App\Mail\signupmail;
use App\Jobs\SendSignupMailJob;
use App\Jobs\ForgetPasswordMailJob;
use App\Mail\ForgetPasswordMail;
use Mail;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PasswordReset;
class UserController extends Controller
{
    // function to render signup page
    public function signup(){
        return view('auth.signup');
    }

    // function to store user account details
    public function customsignup(Request $request){
        $validation=$request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8',
        ]);
        $checkemailunique=User::where('email',$request->email)->first();
        if($checkemailunique==null){
            $insertdata=[
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
                'uuid'=>Str::uuid()
            ];
            // dispatch(function(){
            //     Mail::to('yash@gmail.com')->send(new signupmail('yash'));
            // })->delay(now()->addSeconds(5));
            $user=User::create($insertdata);
            dispatch(new SendSignupMailJob($user->email,$user->name))->delay(now()->addSeconds(5));
            $insertaccount=[
                'holder_name'=>$user->name,
                'account_number'=>$user->uuid,
                'email'=>$user->email,
                'owner_id'=>$user->id
            ];
            Account::create($insertaccount);
            return redirect()->route('login')->with('success','Account created successfully!');
        }
        else{
            return redirect()->route('signup')->with('error','Email Id already exists');
        }
    }

    // function to render login form
    public function login(){
        return view('auth.login');
    }

    // function to login user
    public function customlogin(Request $request){
        $validation=$request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $user_details = auth()->user();
            return redirect('/')->with('success', 'Signed in successfully');
        }

        return redirect()->route('login')->with('error','Invalid email or password.');
    }

    // function to logout user
    public function logout(Request $request){
        auth()->logout();
        return redirect('/')->with('success', 'Signed out successfully');
    }

    public function changepassword(){
        return view('auth.changepassword');
    }
    public function updatepassword(Request $request){
        $validation = $request->validate([
            'currentpassword' => 'required|min:8|max:10',
            'newpassword' =>'required|min:8|max:10',
            'confirmpassword'=>'required|same:newpassword'
        ]);


        $currentuser=auth()->user();
        if(Hash::check($request->currentpassword,$currentuser->password))
        {
            $currentuser->update([
                'password'=>Hash::make($request->newpassword)
            ]);

            return redirect()->route('index')->with('success','Password updated successfully');
        }
        else
        {
            return redirect()->route('change-password')->with('error','Old Password does not match');
        }
    }

    // function to render forgetpassword page
    public function forgetpassword(){
        return view('auth.forgetpassword');
    }

    // function to store reset token and send mail of reset password
    public function postforgetpassword(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required|email',
        ]);

        $user=User::where('email',$request->email)->first();
        // dd($user);
        if(!$user)
        {
            return redirect()->route('forget-password')->with('error','User not found');
        }
        else
        {
            $token=Str::random(100);
            DB::table('password_reset_tokens')->insert([
                'email'=>$user->email,
                'token'=>$token,
                'created_at'=>Carbon::now(),
            ]);
            dispatch(new ForgetPasswordMailJob($user->email,$user->name,$token))->delay(now()->addSeconds(5));
            Session::put('email',$user->email);
            return redirect("/")->with('success','We have sent you a mail');
        }
    }

    // function to render reset password page
    public function getresetpassword($token){
        $password_reset_data=PasswordReset::where('token',$token)->first();
        // dd($password_reset_data);
        $email=$password_reset_data->email;

        if(!$password_reset_data || Carbon::now()->subminutes(10)>$password_reset_data->created_at)
        {
            return redirect("/")->with('error','Invalid password reset link or link expired.');
        }
        else{
            return view('auth.resetpassword',compact('token'));
        }
    }

    // function to update new password 
    public function postresetpassword(Request $request){
        $password_reset_data=PasswordReset::where('token',$request->token)->first();
        // dd($password_reset_data);
        $email=$password_reset_data->email;
        $user=User::where('email',$email)->first();
        // dd($user->id);
        if(!$password_reset_data || Carbon::now()->subminutes(10)>$password_reset_data->created_at)
        {
            // $password_reset_data->delete();
            return redirect()->route('getreset-password')->with('error','Invalid password reset link or link expired.');
        }


        else{
            $validation =$request->validate([
                'password' => 'required|min:8|max:10',
            ]);

            // $password_reset_data->delete();
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            // $password_reset_data->delete();
            return redirect()->route('login')->with('success','Password reseted successfully.');
        }
    }
}
