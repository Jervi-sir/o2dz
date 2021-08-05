
@extends('admin.zroot')

@section('title')
<title>Messages</title>
@endsection

@section('content')
<div class="content">
<div class="flex row-reverse">
    <button id="myBtn" onclick="showModal()">Add new message</button>
</div>
<table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Text</th>
        <th></th>
    </thead>
    <tbody>
        <tr class="disabled">
        </tr>
        @foreach ($messages as $message)
        <tr>
            <td> {{ $message->id }} </td>
            <td> {{ $message->text }} </td>
            <td> 
              <form action="{{ route('admin.messages.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $message->id }}">
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
    <p>Write an advices, that will be displayed when ever someome enter o2dz,</p>
    <form action="{{ route('admin.messages.add') }}" method="POST">
        @csrf
        <input type="text" name="text" placeholder="message" required>
        <button type="submit">Submit</button>
    </form>
  </div>
</div>


@endsection

