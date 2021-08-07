@extends('admin.zroot')

@section('title')
<title>Articles</title>
@endsection

@section('content')
<div class="content">
    <div class="row">
        <h5 class="text-center">Signal</h5>
        <span>Signal_id</span>
        <span>{{ $signal->id }}</span>
    </div>

    <div class="row">
        <h5 class="text-center">Article</h5>
        <div class="line">
            <span>id</span>
            <span>{{$article->id}}</span>
        </div>
        <div class="line">
            <span>user_id</span>
            <span>{{$article->user_id }}</span>
        </div>
        <div class="line">
            <span>name</span>
            <span>{{$article->name}}</span>
        </div>
        <div class="line">
            <span>phone_number</span>
            <span>
                @foreach (unserialize($article->phone_number) as $number)
                    {{ $number }} - 
                @endforeach
            </span>
        </div>
        <div class="line">
            <span>wilaya</span>
            <span>{{$article->wilaya}}</span>
        </div>
        <div class="line">
            <span>type</span>
            <span>{{$article->type}}</span>
        </div>
        <div class="line">
            <span>cost</span>
            <span>{{$article->cost}}</span>
        </div>
        <div class="line">
            <span>	location</span>
            <span>{{$article->location}}</span>
        </div>
    </div>

    <div class="row">
        <h5 class="text-center">User</h5>
        <div class="line">
            <span>id</span>
            <span>{{$user->id}}</span>
        </div>
        <div class="line">
            <span>name</span>
            <span>{{$user->name}}</span>
        </div>
        <div class="line">
            <span>phone_number</span>
            <span>{{$user->phone_number}}</span>
        </div>
    </div>
    <div class="row">
        <h5 class="text-center">All Reports</h5>
        <div class="line">
            <span>id</span>
            <span>{{$user->id}}</span>
        </div>
        <div class="line">
            <span>name</span>
            <span>{{$user->name}}</span>
        </div>
        <div class="line">
            <span>phone_number</span>
            <span>{{$user->phone_number}}</span>
        </div>
    </div>
    <div class="row report">
        <h5 class="text-center">All Reports</h5>
        @foreach ($reports as $report)
        <p>
            {{ $report->id }}
            {{ $report->reporter_token }}
        </p>
        @endforeach
    </div>
    <div class="row">
        <form action="{{ route('admin.report.delete') }}" method="POST">
            @csrf
            <input type="hidden" name="signal_id" value="{{ $signal->id }}">
            <input type="hidden" name="article_id" value="{{ $article->id}}">
            @foreach ($reports as $report)
            <p>
                <input type="hidden" name="report_id[{{ $loop->index }}]" value="{{ $report->id}}">
            </p>
            @endforeach

            <button type="submit">delete</button>
        </form>
    </div>
</div>
<style>
    .text-center {
        text-align: center;
    }
    .row {
        border-bottom: 2px solid black;
    }
    .report {
        display: flex;
        flex-direction: column;
    }
    .line {
        display: flex;
        justify-content: space-between;
        width: 100%;
        border-bottom: 1px solid black;
    }

</style>
@endsection