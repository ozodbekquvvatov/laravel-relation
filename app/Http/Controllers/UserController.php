<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PostController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("login");
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('posts.index');
            } else {
                return back()->withErrors(['email' => 'Noto‘g‘ri parol.']);
            }
        } else {
            return back()->withErrors(['email' => 'Bunday email mavjud emas.']);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view("register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegisterRequest $request)
    {

        $users = User::create($request->all());
        Auth::login($users);  
        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     */

     public function logout(Request $request)
     {
         Auth::logout(); 
         $request->session()->invalidate(); 
         $request->session()->regenerateToken(); 
     
         return redirect('/'); 
     }
     


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
