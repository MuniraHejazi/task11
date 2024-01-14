<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class AuthController extends Controller
{
   
    public function showLoginForm()
    {
        return view ('auth.login');
    } 
    
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'Required|email', 
            'password'=>'Required',
        ]);
        if (Auth::attempt($credentials)) {
           $request->session()->regenerate();
            return redirect()->intended('/');
          //  return redirect()->intended('/dashboard'); 
        }
        return back()->withErrors(['email'=>'Invalid credentials']);
    } 
    
   /* public function showRegistrationForm()
    {
        return view('auth.register');
    }

   public function register(Request $request)
    {
       $validaData= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

          $user= User::create($validaData);
           Auth::login($user);
           return redirect('/');
    }*/
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
           // 'password' => bcrypt($data['password']),
           'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/'); 
    }

       
   public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }   
   /* public function logout()
    {
        Auth::logout();
        return redirect('/'); // تحويل المستخدم إلى الصفحة التي ترغب فيها بعد تسجيل الخروج
    }*/
}
