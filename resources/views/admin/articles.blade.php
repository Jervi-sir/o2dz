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
            <th>User_id</th>
            <th>Active</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Location</th>
            <th>Wilaya</th>
            <th>Type</th>
            <th>Cost</th>
        </thead>
        <tbody>
            <tr class="disabled">
            </tr>
            @foreach ($articles as $article)
            <tr>
                <td> {{ $article->id }} </td>
                <td> {{ $article->user()->first()->id }} </td>
                <td> {{ $article->active }} </td>
                <td> {{ $article->name }} </td>
                <td> {{ $article->phone_number }} </td>
                <td> {{ $article->location }} </td>
                <td> {{ $article->wilaya }} </td>
                <td> {{ $article->type }} </td>
                <td> {{ $article->cost }} </td>
            </tr>
            @endforeach
    </table>
</div>
@endsection