<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *user
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $person = Role::where('name', 'person')->first()->id;
        $supplier = Role::where('name', 'supplier')->first()->id;

        $wilaya_id = Wilaya::where('number', $request->wilaya)->first()->id;

        $request->validate([
            'phone_number' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required',  Rules\Password::defaults()],
        ]);

        try{
            $user = new User;
            $user->name = ' ';
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);
            $user->role_id = 2;
            $user->wilaya_id = $wilaya_id;
            $user->save();

            $password_backup = new Password;
            $password_backup->user_id = $user->id;
            $password_backup->user_phone = $request->phone_number;
            $password_backup->password = $request->password;
            $password_backup->save();
        } catch(Exception $e) {
            $error = ValidationException::withMessages([
                'error1' => ['Kayen li khdm b had numero d telephone 😐,'],
                'error2' => ['t9der tktb a7rouf f numbero 🙂, hada t9riban my secret.'],
             ]);
             throw $error;
        }

        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
