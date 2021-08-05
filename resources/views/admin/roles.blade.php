@extends('admin.zroot')

@section('title')
<title>Roles</title>
@endsection

@section('content')
<div class="content">
    <div class="flex row-reverse">
        <button onclick="showModal()">Add new Role</button>
    </div>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Articles</th>
            <th></th>
        </thead>
        <tbody>
            <tr class="disabled">
            </tr>
            @foreach ($roles as $role)
            <tr>
                <td> {{ $role->id }} </td>
                <td> {{ $role->name }} </td>
                <td> {{ $role->users()->count() }} </td>
                <td> 
                    <form action="{{ route('admin.roles.delete') }}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{ $role->id }}">
                      <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
</div>


<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>article types</p>
      <form action="{{ route('admin.roles.add') }}" method="POST">
          @csrf
          <input type="text" name="name" placeholder="name"  required>
          <button type="submit">Submit</button>
      </form>
    </div>
  
  </div>
  
@endsection
