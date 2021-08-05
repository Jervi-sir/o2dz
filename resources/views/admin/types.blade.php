@extends('admin.zroot')

@section('title')
<title>Types</title>
@endsection

@section('content')
<?php
    $max = 0;
?>
<div class="content">
    <div class="flex row-reverse">
        <button onclick="showModal()">Add new message</button>
    </div>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Number</th>
            <th>Name</th>
            <th>Articles</th>
            <th></th>
        </thead>
        <tbody>
            <tr class="disabled">
            </tr>
            @foreach ($types as $type)
            <tr>
                <td> {{ $type->id }} </td>
                <td> {{ $type->number }} </td>
                <td> {{ $type->name }} </td>
                <td> {{ $type->articles()->count() }} </td>
                <td> 
                    <form action="{{ route('admin.types.delete') }}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{ $type->id }}">
                      <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @if ($loop->last)
                <?php
                    $max = $type->number
                ?>
            @endif
            @endforeach
    
    </table>
</div>



<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>article types</p>
      <form action="{{ route('admin.types.add') }}" method="POST">
          @csrf
          <input type="number" min="{{ $max+1 }}" value="{{ $max+1 }}" name="number" placeholder="number"  required>
          <input type="text" name="name" placeholder="name"  required>
          <button type="submit">Submit</button>
      </form>
    </div>
  
  </div>
  
@endsection

