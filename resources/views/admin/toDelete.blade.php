@extends('admin.zroot')

@section('title')
<title>Articles</title>
@endsection

@section('content')
<div class="content">

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>article_id</th>
            <th></th>
        </thead>                                                                                
        <tbody>
            <tr class="disabled">
            </tr>
            @foreach ($articles as $article)
            <tr>
                <td> {{ $article->id }} </td>
                <td> {{ $article->article_id }} </td>
                <td> 
                    <form action="{{ route('admin.signals.view') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $article->id }}">
                        <button type="submit">view</button>
                    </form>    
                </td>
            </tr>
            @endforeach
    </table>
</div>
@endsection