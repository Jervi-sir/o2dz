<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Wilaya;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

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
        if($request->role != $supplier)
        {
            $role_id = $person;
        }
        else {
            $role_id = $supplier;
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            //'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role_id,
            'wilaya_id' => $wilaya_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
