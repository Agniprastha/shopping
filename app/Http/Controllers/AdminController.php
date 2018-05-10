<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request){
    	if ($request->ismethod('post')) {
    		$data=$request->input();
    		if (auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
    			//echo "success"; die;
    			Session::put('AdminSession',$data['email']);
    			return redirect('/admin/dashboard');
    		}
    		else{
    			//echo "Failed";die;
    			//Session::flash('success', 'Here is your success message');

    			return redirect('/admin')->with('flash_message_error','invalid username or password');
    		}
    	}
    	return view('admin.login');
    }

    public function dashboard(){
    	if (session::has('AdminSession')) {

    		# code...
    	}else{
    		return redirect('/admin')->with('flash_message_error','plese login to access');
    	}
    	return view('admin.dashboard');
    }
    
    public function settings(){
        return view('admin.setting');
    }

    public function chkpassword(Request $request){
        $data = $request->all();//dd($data);
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>1])->first();
        if (Hash::check($current_password,$check_password->password)){
            echo "true";die;
            # code...
        }else{
            echo "false";die;
        }
        return view('admin.setting');
    }

    public function updatepassword(Request $request){
        if ($request->isMethod('post')) {
            $data=$request->all();
            #dd($data);
            $check_password = User::where(['email'=>Auth::user()->email])->first();
            $current_password = $data['current_pwd'] ;
            if(Hash::check($current_password,$check_password->password)) {
                $password = bcrypt($data['new_pwd']);//dd($password);
                User::where('id','1')->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','password update successfully');

            }else{
                return redirect('/admin/settings')->with('flash_message_error','Incorrect current_password');
            }
        }
        return view('admin.setting');
    }

    public function logout(){
    	Session::flush();
    	return redirect('/admin')->with('flash_message_success','logged out successfully');
    }


}
