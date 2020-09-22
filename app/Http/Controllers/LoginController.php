<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Validator;


class LoginController extends Controller
{
     

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
        $this->middleware('guest');
    }

 
    public function showLogin(Request $request) {

        if (!$request->session()->exists('user')) {
           return \View::make('login', ['msg' => '']);
        }
        else{
            if(session('user.user_type') == 'admin')
            {
                return redirect()->route('userData.index');
            }
            else
            {
                return redirect()->route('dashboard');
            }
        }
    }

    public function doLogin(Request $request) {
        $postData = $request->all();

        try {

            $userData = UserModel::where(['username'=> $postData['username'],'password'=> MD5($postData['password'])])->get()->toArray();
  
            if(empty($userData)){
                return \View::make('login', ['msg' => "Invalid credentials"]);
            }else{

                //create user to store in session
                $user = new UserModel();
                /* Set any  user specific fields returned by the api request*/
                $user->user_id      = $userData[0]['id'];
                $user->user_type    = $userData[0]['usertype'];
                $user->user_name    = $userData[0]['username'];
                $user->user_fname   = $userData[0]['name']; 

                $request->session()->put('authenticated',true);
                $request->session()->put('user', $user);

                if(session('user.user_type') == 'admin')
                {
                    return redirect()->route('userData.index');
                }
                else
                {
                    return redirect()->route('dashboard');
                }
                
            }

        } catch(\GuzzleHttp\Exception\ClientException $e) {

            //remove user and authenticated from session
            $request->session()->forget('authenticated');
            $request->session()->forget('user');
            //redirect back with error
            return redirect()->back()->with(['msg' => $result->message]);
        }

    }

    public function doLogout(Request $request) {

        $request->session()->forget('authenticated');
        $request->session()->forget('user');

//        \Auth::logout();
        return redirect('login');
    }

}
