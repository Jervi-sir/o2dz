<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Cost;
use App\Models\Type;
use App\Models\Wilaya;
use App\Models\Article;
use App\Models\Message;
use App\Models\Report;
use App\Models\Signal;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class AccounceController extends Controller
{
    public function add()
    {
        $wilayas = Wilaya::all();
        $user = Auth()->user();
        $announce_count = $user->articles()->count();

        $types = Type::all();
        $costs = Cost::all();
        $phone_number = Auth()->user()->phone_number;
        
        return view('annonces.add', ['wilayas' => $wilayas, 
                                        'types' => $types, 
                                        'costs' => $costs, 
                                        'phone_number' => $phone_number,
                                        'announce_count' => $announce_count
                                    ]);
    }

    public function store(Request $request)
    {
        if(count($request->phone) > 5)
        {
            Toastr::success('a77 dont change js code tho, little snoppy, but i like u since u took time to inspect this code, send me a message at 0558054300 writing ( Jervi i know iverj u fukin slave XD ) will be waiting for you ', '', ["positionClass" => "toast-top-center"]);
            return back();
        }
        $array_phone = [];
        foreach($request->phone as $phone)
        {
            array_push($array_phone, $phone);
        }
        $phone_encode = serialize($array_phone);

        $wilaya = Wilaya::where('number', $request->wilaya_number)->first();
        $type = Type::where('number', $request->type_number)->first();
        $cost = Cost::where('number', $request->cost_number)->first();

        $article = new Article;
        $article->user_id = Auth()->user()->id;
        $article->wilaya_id = $wilaya->id;
        $article->type_id = $type->id;
        $article->cost_id = $cost->id;
        $article->location = $request->location ? $request->location : '';
        $article->description =  $request->description ? $request->description : '';

        $article->name = $request->name;
        $article->phone_number = $phone_encode;

        $article->wilaya = $wilaya->name;
        $article->type = $type->name;
        $article->cost = $cost->name;

        $article->save();

        Toastr::success('🤍  شكرا لك على مساعدتنا ', '', ["positionClass" => "toast-top-center"]);
        return redirect(route('annonce.manage'));
    }

    public function all()
    {
        $articles = Auth()->user()->articles()->get();
        return view('annonces.edit', ['articles' => $articles]);
    }

    public function report(Request $request)
    {
        //XSRF-TOKEN, laravel_session
        //veryfi if the client already reported the post
        $reported = Report::where('article_id', $request->id)->where('reporter_token', $request->ip())->count();

        //if client havent reported this article
        //$request->cookie('XSRF-TOKEN')
        if($reported == 0) 
        {
            $report = new Report;
            $report->article_id = $request->id;
            $report->reporter_token = $request->ip();
            $report->save();

            //check if anything more then 10
            $signal = Report::where('article_id', $request->id)->count();
            if($signal > 7) 
            { 
                $delete = new Signal;
                $delete->article_id = $request->id;
                $delete->save();
            }

            return Response::json(['signaled' => 'merci pour votre contribution, il rest '. 7 - $signal . ' sur 7 de signal afin de supprimer cette annonce'], 200);
        }
        else 
        {
            return Response::json(['already' => 'Vous avez deja signaler cette annonce'], 200);
            //Toastr::success('Vous avez deja signaler cette annonce ', '', ["positionClass" => "toast-top-center"]);
        }


    }

    public function find(Request $request)
    {
        $ipRequest = $request->ip();
        $visitor = Visitor::where('ip', $ipRequest)->first();
        if($visitor == null)
        {
            $ip = new Visitor;
            $ip->ip = $request->ip();
            $ip->save();
        }
        else 
        {
            $visitor->count++;
            $visitor->save();
        }

        $only_walayas = [];
        //$count_per_wilaya = [];
        $wilayas = Wilaya::all();
        foreach ($wilayas as $wilaya)
        {   
            //select a wilaya
            if($wilaya->articles()->count())
            {
                //wilaya has articles
                //$count = 0;
                //push this wilaya
                array_push($only_walayas, $wilaya);
                /*
                foreach ($wilaya->articles()->get() as $article)
                {   
                    //one article
                    if( $article->active == 1 ) 
                    {
                        //this article is active
                        $count =  $count + 1 ;
                    }
                }
                array_push($count_per_wilaya, $count);
                */
            }
        }
       
        
        //$article_active = Article::where('active',1)->count();    

        $message = Message::inRandomOrder()->first()->text;

        $types = Type::all();
        Toastr::success($message , '', ["positionClass" => "toast-bottom-center"]);
        return view('find', ['wilayas' => $only_walayas, 'types' => $types]);
    }
    
    public function findGet(Request $request)
    {
        $wilaya_id = Wilaya::where('number', $request->wilaya_number)->first()->id;
        $articles = Article::where('wilaya_id', $wilaya_id)->where('active', 1)->get();
        //$articles = Article::where('wilaya_id', $wilaya_id)->get();
        //$array_articles = [];

        $json_array = [];
        foreach($articles as $article)
        {
            $role = $article->user()->first()->role()->first()->name;
            $json = [
                    'id' => $article->id,
                    'name' => $article->name,
                    'phone_number' => json_encode(unserialize( $article->phone_number)),
                    'wilaya' => $article->wilaya,
                    'location' => $article->location,
                    'type' => $article->type,
                    'type_id' => $article->type_id,
                    'cost' => $article->cost,
                    'description' => $article->description,
                    'user_type' => ' ',
                ];
            array_push($json_array, $json);
            //array_push($array_articles, $article);
        }

        return Response::json($json_array);
    }

    public function manage()
    {
        $articles = Auth()->user()->articles()->get();
        $wilayas = Wilaya::all();
        $types = Type::all();
        $costs = Cost::all();
        return view('annonces.manage', ['articles' => $articles, 'wilayas' => $wilayas, 'types' => $types, 'costs' => $costs]);
    }

    public function update(Request $request)
    {
        $array_phone = [];
        foreach($request->phone_number as $phone)
        {
            array_push($array_phone, $phone);
        }
        $phone_encode = serialize($array_phone);
        
        //item_id, name, phone_number, location, wilaya[id], type[id], cost[id]
        $item = Article::find($request->item_id);
        $item->wilaya_id = $request->wilaya;
        $item->type_id = $request->type;
        $item->cost_id = $request->cost;

        $item->name = $request->name;
        $item->phone_number = $request->phone_number;
        $item->phone_number = $phone_encode;
        $item->wilaya = Wilaya::find($request->wilaya)->name;
        $item->type = Type::find($request->type)->name;
        $item->cost = Cost::find($request->cost)->name;
        $item->location = $request->location ? $request->location : '';
        $item->description = $request->description ? $request->description : '';
        $item->save();
        
        Toastr::success('Votre annonce a été modifiée 🤍 ', '', ["positionClass" => "toast-top-center"]);
        return back();

    }

    public function freeze(Request $request) 
    {
        $article = Article::find($request->item_id);
        $article->active = 0;
        $article->save();

        Toastr::success('Votre annonce est maintenant cachée 🙂 ', '', ["positionClass" => "toast-top-center"]);
        return back()->with(['success'=>'disactivated successfully.']);

    }
    public function activate(Request $request) 
    {
        $article = Article::find($request->item_id);
        $article->active = 1;
        $article->save();

        Toastr::success('Votre annonce est mise a la liste 🙂 ', '', ["positionClass" => "toast-top-center"]);
        return back()->with(['success'=>'activated successfully.']);
    }

    public function delete(Request $request) 
    {
        $article = Article::find($request->item_id);
        $article->delete();

        Toastr::info('Votre annonce est supprimer 😢 ', '', ["positionClass" => "toast-top-center"]);
        return back()->with(['success'=>'deleted successfully.']);
    }

}
