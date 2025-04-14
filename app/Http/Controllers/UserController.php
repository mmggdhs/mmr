<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

class UserController extends Controller{
 
    public function home(Request $request)
    {
        $projects = Project::all();
            return view('index',['projects'=>$projects]);
    }

    public function login(Request $request)
    {       
        $valid = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',

        ]);

            if(Auth::attempt($valid)){
                $request->session()->regenerate();
                
                return redirect('/');
            }
            
            throw ValidationException::withMessages([
                'somethingwrong' => 'email or password is worng'
            ]);
             
    }

    public function logout(Request $request):RedirectResponse
    {       

                if(Auth::check()){
                    Auth::logout();
                }
                return redirect('/');

    }

    public function Sign(Request $request)
    { 
            $valid = $request->validate([
                'name' => 'required|string|max:255',
                  'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',

            ]);

            $user = User::create($valid);

            Auth::login($user);

            return redirect('/');     

    }
}
