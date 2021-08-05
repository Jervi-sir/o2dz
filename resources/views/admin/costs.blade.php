@extends('admin.zroot')

@section('title')
<title>Costs</title>
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
            @foreach ($costs as $cost)
            <tr>
                <td> {{ $cost->id }} </td>
                <td> {{ $cost->number }} </td>
                <td> {{ $cost->name }} </td>
                <td> {{ $cost->articles()->count() }} </td>
                <td> 
                    <form action="{{ route('admin.costs.delete') }}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{ $cost->id }}">
                      <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @if ($loop->last)
                <?php
                    $max = $cost->number
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
      <p>how the articles would be offered</p>
      <form action="{{ route('admin.costs.add') }}" method="POST">
          @csrf
          <input type="number" min="{{ $max+1 }}" value="{{ $max+1 }}" name="number" placeholder="number"  required>
          <input type="text" name="name" placeholder="name"  required>
          <button type="submit">Submit</button>
      </form>
    </div>
  
  </div>
@endsection

