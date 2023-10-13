<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionCategory;
use App\Models\TransactionType;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
    // function to view transactions of specified account
    private function totalbalance($transaction,$id){
        $totalbalance=0;
        foreach($transaction as $k=>$v){
            if($v->transactiontype_id==1){
                $totalbalance+=$v->amount;
            }
            if($v->transactiontype_id==2){
                $totalbalance-=$v->amount;
            }
            if($v->transactiontype_id==3 && $v->receiveraccount_id==$id){
                $totalbalance+=$v->amount;
            }
            if($v->transactiontype_id==3 && $v->account_id==$id){
                $totalbalance-=$v->amount;
            }
        }
        return $totalbalance;
    }
    public function viewtransactions($id){
        $transactions=Transaction::where('account_id',$id)->orwhere('receiveraccount_id',$id)->orderBy('created_at','DESC')->get();
        $totalbalance=$this->totalbalance($transactions,$id);
        return view('account.viewtransactions',compact('transactions','totalbalance','id'));
    }

    // function to render add transaction page
    public function addtransactions(){
        $transactioncategory=TransactionCategory::get();
        $transactiontype=TransactionType::get();
        $useraccounts=DB::select('SELECT expense_manager.accounts.id,expense_manager.accounts.holder_name,expense_manager.accounts.account_number,expense_manager.accounts.phone_number,expense_manager.accounts.email,
        CASE
            WHEN  expense_manager.accounts.owner_id=? THEN expense_manager.accounts.created_at
            WHEN expense_manager.others_accounts.user_id=? THEN expense_manager.others_accounts.created_at
        END AS createdat
        FROM expense_manager.accounts LEFT JOIN expense_manager.others_accounts ON expense_manager.accounts.id = expense_manager.others_accounts.account_id
        WHERE expense_manager.accounts.owner_id=? OR expense_manager.others_accounts.user_id=? ORDER BY createdat',[auth()->id(),auth()->id(),auth()->id(),auth()->id()]);

        return view('account.addtransactions',compact('transactioncategory','transactiontype','useraccounts'));
    }

    // function to store transaction in database
    public function storetransactions(Request $request){
        $transactions=Transaction::where('account_id',$request->account_id)->get();
        $totalbalance=$this->totalbalance($transactions,$id);
        if($request->type_id==2 || $request->type_id==3){
            if($request->amount<$totalbalance){
                $insertdata=[
                    'account_id'=>$request->account_id,
                    'amount'=>$request->amount,
                    'transactiontype_id'=>$request->type_id,
                    'transactioncategory_id'=>$request->category_id,
                ];
                if(isset($request->receiver_account_id)){
                    $insertdata['receiveraccount_id']=$request->receiver_account_id;
                }
                Transaction::create($insertdata);
                return redirect()->route('my-accounts')->with('success','Transaction added successfully');
            }
            else{
                return redirect()->route('add-transactions')->with('error','Not Enough balance!');
            }
        }
        else{
            $insertdata=[
                'account_id'=>$request->account_id,
                'amount'=>$request->amount,
                'transactiontype_id'=>$request->type_id,
                'transactioncategory_id'=>$request->category_id,
            ];
            if(isset($request->receiver_account_id)){
                $insertdata['receiveraccount_id']=$request->receiver_account_id;
            }
            Transaction::create($insertdata);
            return redirect()->route('my-accounts')->with('success','Transaction added successfully');
        }
    }

    // function to render edit transaction page
    public function edittransactions($id){
        $transaction=Transaction::findOrFail($id);
        $transactioncategory=TransactionCategory::get();
        $transactiontype=TransactionType::get();
        $useraccounts=DB::select('SELECT expense_manager.accounts.id,expense_manager.accounts.holder_name,expense_manager.accounts.account_number,expense_manager.accounts.phone_number,expense_manager.accounts.email,
        CASE
            WHEN  expense_manager.accounts.owner_id=? THEN expense_manager.accounts.created_at
            WHEN expense_manager.others_accounts.user_id=? THEN expense_manager.others_accounts.created_at
        END AS createdat
        FROM expense_manager.accounts LEFT JOIN expense_manager.others_accounts ON expense_manager.accounts.id = expense_manager.others_accounts.account_id
        WHERE expense_manager.accounts.owner_id=? OR expense_manager.others_accounts.user_id=? ORDER BY createdat',[auth()->id(),auth()->id(),auth()->id(),auth()->id()]);

        return view('account.edittransactions',compact('transaction','transactioncategory','transactiontype','useraccounts'));
    }

    // function to update transactions
    public function updatetransactions(Request $request,$id){
        $transaction=Transaction::findOrFail($id);
        $transactions=Transaction::where('account_id',$request->account_id)->get();
        $totalbalance=$this->totalbalance($transactions,$id);
        if($request->type_id==2 || $request->type_id==3){
            if($request->amount<$totalbalance){
                $updatedata=[
                    'account_id'=>$request->account_id,
                    'amount'=>$request->amount,
                    'transactiontype_id'=>$request->type_id,
                    'transactioncategory_id'=>$request->category_id,
                ];
                if(isset($request->receiver_id)){
                    $insertdata['receiver_id']=$request->receiver_id;
                }
                $transaction->update($updatedata);
                return redirect()->route('view-transactions',$transaction->account_id)->with('success','Transaction updated successfully');
            }
            else{
                return redirect()->route('edit-transactions')->with('error','Not Enough balance!');
            }
        }
    }

    // function to delete transactions
    public function deletetransactions(Request $request,$id){
        $transaction=Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('view-transactions',$transaction->account_id)->with('success','Transaction deleted successfully');
    }

    // function to search receivers account during transfer
    public function accountsearch(Request $request){
        $receiveraccounts=Account::whereNot('id',$request->senderaccount_id)->where('account_number','Like',$request->receiveraccount_id.'%')->get();
        return view('account.receiveraccounts',compact('receiveraccounts'));
    }
}
