<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\Article;
use App\Models\Message;
use App\Models\Report;
use App\Models\Signal;
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

    public function reported()
    {
        $articles = Report::all();
        
        return view('admin.reported',['articles' => $articles]);
    }

    public function toDelete()
    {
        $articles = Signal::all();
        
        return view('admin.toDelete',['articles' => $articles]);
    }


    /*----------View------------*/
    public function signalsView(Request $request)
    {
        //signal object
        $signal = Signal::find($request->id);
        //article
        $article = $signal->article()->first();
        //user
        $user = $article->user()->first();
        $reports = Report::where('article_id', $article->id)->get();
        return view('admin.viewReport', ['signal' => $signal, 'article' => $article, 'user' => $user , 'reports' => $reports]);
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

  
    public function reportDelete(Request $request)
    {
        $signal = Signal::find($request->signal_id);
        $article = Article::find($request->article_id);
        $report_array = $request->report_id;

        for($i = 0; $i < count($report_array); $i++)
        {
            $report = Report::find($report_array[$i]);
            $report->delete();
        }

        $signal->delete();
        $article->delete();

        return redirect()->route('admin.home');;
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
