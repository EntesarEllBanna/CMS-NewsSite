<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
//ما تنساهها
use App\Http\Requests\AccountRequest;
use App\Account;
use App\Country;
class AccountEQController extends Controller
{  
    public function paging()
    {
        $accounts = Account::paginate(2);
        return view("accounteq.paging",compact("accounts"));
    }
    public function search(Request $request)
    {
        $q = $request["q"];
        $accounts = Account::where("fullname","like","%$q%")
                            ->orWhere("email","like","%$q%")
                            ->orWhere("id","$q")->get();
        return view("accounteq.search",compact("accounts","q"));
    }
    
    public function searchpaging(Request $request)
    {
        $q = $request["q"];
        $accounts = Account::where("fullname","like","%$q%")
                            ->orWhere("email","like","%$q%")
                            ->orWhere("id","$q")->paginate(10)->appends(["q"=>$q]);
        return view("accounteq.searchpaging",compact("accounts","q"));
    }
    public function searchpaging2(Request $request)
    {
        $q = $request["q"];
        $gender = $request["gender"];
        $status = $request["status"];
        $country = $request["country"];
        $countries=Country::get();
        /*$accounts = Account::where("fullname","like","%$q%")
                            ->orWhere("email","like","%$q%")
                            ->orWhere("id","$q")->paginate(10)->appends(["q"=>$q]);*/
        //whereRaw انا بكتب جملة السيلكت على كيفي
        $accounts = Account::whereRaw("(fullname like ? or email like ? or id=?)",["%$q%","%$q%",$q]);
        
        if($gender!="")
            $accounts->where("gender",$gender);
        
        if($status!="")
            $accounts->where("active",$status);
        
        if($country!="")
            $accounts->where("country_id",$country);
        
        $accounts=$accounts->paginate(10)->appends(["q"=>$q,"gender"=>$gender,"status"=>$status,"country"=>$country]);
        return view("accounteq.searchpaging2",compact("accounts","q","gender","status","country","countries"));
    }
    public function index()
    {
        $accounts = Account::get();
        return view("accounteq.index",compact("accounts"));
    }
    
    public function show($id)
    {
        $countries = Country::get();
        $account = Account::find($id);//search by primary key
        if($account==NULL){
            \Session::flash("msg","Account ID is invalid");
            return redirect("/account");
        }
        return view("accounteq.show",compact("account","countries"));
    }
    
    
    public function create()
    {
        $countries = Country::get();
        return view("accounteq.create",compact("countries"));
    }

    public function store(AccountRequest $request)
    {
        $account=new Account();
        $account->fullname=$request["fullname"];
        $account->email=$request["email"];
        $account->gender=$request["gender"];
        $account->country_id=$request["country"];
        $account->active=$request["active"]?1:0;
        $account->save();//احفظ
        
        //خزن الرسالة في السيشن بشكل مؤقت وسيتم حذفها حال عرضها بالزبط
        \Session::flash("msg","Account Created Successfully");
        
        return redirect("/accounteq/create");//افتح الصفحة من اول وجديد
    }
    
    public function edit($id)
    {
        $account=Account::find($id);//بحث فقط من خلال البرايمري كي
        if($account==NULL){
            \Session::flash("msg","Account ID is invalid");
            return redirect("/accounteq");
        }
        $countries = Country::get();
        return view("accounteq.edit",compact("countries","account"));
    }

    public function update(AccountRequest $request, $id)
    {
        $account=Account::find($id);
        $account->fullname=$request["fullname"];
        $account->email=$request["email"];
        $account->gender=$request["gender"];
        $account->country_id=$request["country"];
        $account->active=$request["active"]?1:0;
        $account->save();//احفظ
        
        \Session::flash("msg","Account Updated Successfully");        
        return redirect("/accounteq");//افتح الصفحة من اول وجديد
    }    
    public function destroy($id)
    {
        $account=Account::find($id);
        $account->delete();
        \Session::flash("msg","Account Deleted Successfully");        
        return redirect("/accounteq");//افتح الصفحة من اول وجديد
    }
}