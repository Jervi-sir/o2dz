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
            <th>reporter_token</th>
        </thead>
        <tbody>
            <tr class="disabled">
            </tr>
            @foreach ($articles as $article)
            <tr>
                <td> {{ $article->id }} </td>
                <td> {{ $article->article_id }} </td>
                <td> {{ $article->reporter_token }} </td>
            </tr>
            @endforeach
    </table>
</div>
@endsection