<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Validator;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UserController extends Controller {

	public function index()
    {
        $userData = UserModel::whereNotIn('usertype',['admin'])->latest()->paginate(5);
        return view('index', ['userData' => $userData])->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('userData.index',compact('userData'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        $newUserData = $request->all();
        $newUserData['password'] = md5($newUserData['password']);
        $newUserData['created_at'] = date("Y-m-d H:i:s");
        $newUserData['image'] = "";
  
        UserModel::create($newUserData);
   
        return redirect()->route('userData.index')
                        ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userData = UserModel::find($id);
        return view('show',compact('userData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userData = UserModel::find($id);
        return view('edit',compact('userData','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $userData = UserModel::find($id);
        $userData->name = request('name');
        $userData->email = request('email');
        $userData->save();
                $request->validate([
                'name' => 'required',
                'email' => 'required',
         ]);
        $userData->update($request->all());
  
        return redirect()->route('userData.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserModel::find($id)->delete();
  
        return redirect()->route('userData.index')
                        ->with('success','User deleted successfully');
    }

    public function dashboard(){
        
        $url = env('THIRDPARTY_API_URL');
        
        $client = new Client();
        $result = $client->get( $url );
        $contents = json_decode($result->getBody()->getContents());
    
        return view('dashboard',['data'=>$contents]);
    }
}
