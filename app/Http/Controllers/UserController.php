<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Reports;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
        $projectCount = Project::count();
        $userCount =user::count();
        $reports = Reports::all();
            return view('index',
            [
            'projects'=>$projects,
            'projectCount' => $projectCount,
            'userCount'=>$userCount,
            'reports'=>$reports            
            ]);
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
                'somethingwrong' => 'email or password is wrong'
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

            event(new Registered($user));
            Auth::login($user);

            return redirect('/email/verify');     

    }
    public function update(Request $request)
    {
        $request->validate([
            'name'=>"",
            'about' => 'required|string|max:1000', // تحقق من المدخلات
        ]);

        $user = Auth::user();
        $user->about = $request->about;
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'تم تحديث الوصف بنجاح!');
    }
}
