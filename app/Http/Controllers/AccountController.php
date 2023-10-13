<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Requests;
use App\Models\OtherAccount;
use Illuminate\Support\Facades\DB;
class AccountController extends Controller
{
    // function to render add account form
    public function addaccount(){
        return view('account.addaccount');
    }

    // function to store account details in database
    public function storeaccount(Request $request){
        $validation=$request->validate([
            'name'=>'required',
            'accountnumber'=>'required',
            'phone'=>'min:10|max:10',
            'email'=>'required|email'
        ]);
        $insertdata=[
            'holder_name'=>$request->name,
            'account_number'=>$request->accountnumber,
            'phone_number'=>$request->phone,
            'email'=>$request->email,
            'owner_id'=>auth()->id()
        ];
        Account::create($insertdata);
        return redirect()->route('my-accounts')->with('success','Account add successfully!');
    }

    // function to render myaccounts page
    public function myaccounts(){
        $myaccounts=DB::select('SELECT expense_manager.accounts.id,expense_manager.accounts.holder_name,expense_manager.accounts.account_number,expense_manager.accounts.phone_number,expense_manager.accounts.email,expense_manager.accounts.owner_id,expense_manager.others_accounts.user_id,
        CASE
            WHEN  expense_manager.accounts.owner_id=? THEN expense_manager.accounts.created_at
            WHEN expense_manager.others_accounts.user_id=? THEN expense_manager.others_accounts.created_at
        END AS createdat
        FROM expense_manager.accounts LEFT JOIN expense_manager.others_accounts ON expense_manager.accounts.id = expense_manager.others_accounts.account_id
        WHERE expense_manager.accounts.owner_id=? OR expense_manager.others_accounts.user_id=? ORDER BY createdat',[auth()->id(),auth()->id(),auth()->id(),auth()->id()]);
        return view('account.myaccount',compact('myaccounts'));
    }

    // function to render editaccount form
    public function editaccount($id){
        $account=Account::findOrFail($id);
        return view('account.editaccount',compact('account'));
    }

    // function to update account details
    public function updateaccount(Request $request,$id){
        $account=Account::findOrFail($id);
        $updatedata=[
            'holder_name'=>$request->name,
            'account_number'=>$request->accountnumber,
            'phone_number'=>$request->phone,
            'email'=>$request->email,
        ];
        $account->update($updatedata);
        return redirect()->route('my-accounts')->with('success','Account updated successfully!');
    }

    // function to delete account
    public function deleteaccount(Request $request,$id){
        $account=Account::findOrFail($id);
        $account->delete();
        return redirect()->route('my-accounts')->with('success','Account deleted successfully!');

    }

    // function to render other users account page
    public function addothersaccount(){
        return view('account.addothersaccount');
    }

    // function to search accounts that belongs to user of entered email
    public function searchothersaccount(Request $request){
        $user=User::where('email',$request->email)->first();
        $accounts=$user->accounts;
        return view('account.searchothersaccount',compact('accounts','user'));
    }


    // function to delete other user account
    public function deleteothersaccount(Request $request,$id){
        $othersaccount=OtherAccount::where('account_id',$id)->where('user_id',auth()->id())->first();
        $othersaccount->delete();
        $request=Requests::where('sender_id',auth()->id())->where('account_id',$id)->delete();
        return redirect()->route('my-accounts')->with('success','Account deleted successfully!');
    }
    // function to send request to other user for accessing accounts
    public function sendrequest(Request $request,$id){
        $insertdata=[
            'sender_id'=>auth()->id(),
            'account_id'=>$id,
        ];
        $request=Requests::create($insertdata);
        return redirect()->route('add-othersaccount')->with('success','Request sent successfully!');
    }

    // function to view requests of logged user accounts
    public function viewrequests(){
        $requests=Requests::get();
        return view('account.viewrequests',compact('requests'));
    }

    // function to approve request and add the requested account on requested user account
    public function approverequest($id){
        $request=Requests::findOrFail($id);
        $updatedata=[
            'is_approved'=>1
        ];
        $request->update($updatedata);
        $insertdata=[
            'account_id'=>$request->account_id,
            'user_id'=>$request->sender_id
        ];
        OtherAccount::create($insertdata);
        return redirect()->route('view-requests')->with('success','Request approved successfully!');
    }
}
