<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\Article;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {   
        return view('admin.home');
    }

    public function users()
    {   
        $users = User::all();
        
        return view('admin.users',['users' => $users]);
    }

    public function wilaya()
    {
        $wilayas = Wilaya::all();
        
        return view('admin.wilayas',['wilayas' => $wilayas]);
    }

    public function types()
    {
        $types = Type::all();
        
        return view('admin.types',['types' => $types]);
    }

    public function articles()
    {
        $articles = Article::all();
        
        return view('admin.articles',['articles' => $articles]);
    }

    public function roles()
    {
        $roles = Role::all();
        
        return view('admin.roles',['roles' => $roles]);
    }

    public function costs()
    {
        $costs = Cost::all();
        return view('admin.costs',['costs' => $costs]);
    }

    public function messages()
    {
        $messages = Message::all();
        
        return view('admin.messages',['messages' => $messages]);
    }

    /*----------Add------------*/
    public function costsAdd(Request $request)
    {
        $cost = new Cost;
        $cost->number = $request->number;
        $cost->name = $request->name;
        $cost->save();

        return back();
        
    }

    public function messagesAdd(Request $request)
    {
        $message = new Message;
        $message->text = $request->text;
        $message->save();

        return back();
    }

    public function rolesAdd(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return back();
    }

    public function typesAdd(Request $request)
    {
        $type = new Type;
        $type->number = $request->number;
        $type->name = $request->name;
        $type->save();

        return back();
    }

    /*----- delete ------------*/

    public function costsDelete(Request $request)
    {
        $cost = Cost::find($request->id);
        $cost->delete();
        return back();
        
    }

    public function messagesDelete(Request $request)
    {
        $message = Message::find($request->id);
        $message->delete();
        return back();
    }

    public function rolesDelete(Request $request)
    {
        $role = Role::find($request->id);
        $role->delete();
        return back();
    }

    public function typesDelete(Request $request)
    {
        $type = Type::find($request->id);
        $type->delete();
        return back();
    }


    /*----- edit --------------*/

    public function costsEdit(Request $request)
    {
        dd($request);
        $cost = Cost::find($request->id);
        return back();
        
    }

    public function messagesEdit(Request $request)
    {
        dd($request);
        $message = Message::find($request->id);
        return back();
    }

    public function rolesEdit(Request $request)
    {
        dd($request);
        $role = Role::find($request->id);
        return back();
    }

    public function typesEdit(Request $request)
    {
        dd($request);
        $type = Type::find($request->id);
        return back();
    }


}
