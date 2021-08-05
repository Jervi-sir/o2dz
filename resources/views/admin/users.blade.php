@extends('admin.zroot')

@section('title')
<title>Users</title>
@endsection

@section('content')
<div class="content">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Goes By</th>
            <th>Gender</th>
            <th>Class</th>
            <th>Alive</th>
        </thead>
        <tbody>
            <tr class="disabled">
            </tr>
            @foreach ($users as $user)
            <tr>
                <td> {{ $user->id }} </td>
                <td> {{ $user->name }} </td>
                <td> {{ $user->phone_number }} </td>
                <td> {{ $user->role()->first()->name }} </td>
                <td> {{ $user->wilaya()->first()->name }} </td>
                <td> {{ $user->articles()->count() }} </td>
                <td> {{ $user->created_at->isoFormat('d MMMM YY') }}</td>
            </tr>
            @endforeach
    
    </table>
</div>
@endsection

