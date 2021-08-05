@extends('admin.zroot')

@section('title')
<title>Wilaya</title>
@endsection

@section('content')
<table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Number</th>
        <th>Name</th>
        <th>Articles</th>
        <th>Users</th>
    </thead>
    <tbody>
        <tr class="disabled">
        </tr>
        @foreach ($wilayas as $wilaya)
        <tr>
            <td> {{ $wilaya->id }} </td>
            <td> {{ $wilaya->number }} </td>
            <td> {{ $wilaya->name }} </td>
            <td> {{ $wilaya->articles()->count() }} </td>
            <td> {{ $wilaya->users()->count() }} </td>
        </tr>
        @endforeach
</table>
@endsection

