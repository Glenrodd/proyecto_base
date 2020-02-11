<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        /*$users = User::all();
        dd($users);*/
        return view('users.index');
    }
    public function create()
    {
        $pagination_rows = request('pagination_rows'??10);
        $id = request('id')??'';
        $name = request('name')??'';
        $email = request('email')??'';

        //Log::info($name);
        $conditions = [];

        if($name != '')
        {
            array_push($conditions,array('name','like',"%{$name}%"));
        }
        if($id != '')
        {
            array_push($conditions,array('id','like',"%{$id}%"));
        }
        if($email != '')
        {
            array_push($conditions,array('email','like',"%{$email}%"));
        }
        $users = User::where($conditions)
                    ->orderBy('name')
                    ->paginate($pagination_rows);
        return response()->json($users->toArray());
    }

    public function store(Request $request)
    {
        if($request->has("id")){
            $user = User::find($request->id);
        }else{
            $user = new User;
        }        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('message','Se registro el Articulo '.$user->name);
        return back()->withInput();
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json(compact('user'));
    }
}
