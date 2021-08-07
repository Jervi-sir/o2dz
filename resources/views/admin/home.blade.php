@extends('admin.zroot')

@section('title')
<title>Articles</title>
@endsection

@section('content')
<div class="card">
    <div class="grid">
        <a class="item" href="{{ route('admin.users') }}">
            Users
        </a>
        <a class="item" href="{{ route('admin.articles') }}">
            Articles
        </a>
        <a class="item" href="{{ route('admin.wilaya') }}">
            Wilaya
        </a>
        <a class="item" href="{{ route('admin.types') }}">
            Types
        </a>
        <a class="item" href="{{ route('admin.costs') }}">
            Cost
        </a>
        <a class="item" href="{{ route('admin.roles') }}">
            Roles
        </a>
        <a class="item" href="{{ route('admin.messages') }}">
            Messages
        </a>
        <a class="item" href="{{ route('admin.reported') }}">
            Reported Announces
        </a>
        <a class="item" href="{{ route('admin.toDelete') }}">
            Announces to delete
        </a>
        <a class="item" href="{{ route('annonce.find') }}">
            O2dz
        </a>
    </div>
    <h3 class="text-center">
        JERVI-IVERJ
    </h3>
</div>

<style>
    .text-center {
        text-align: center;
    }
    .card {
        width: 100%;
    }
    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: white;
        border-radius: 15px;
        padding: 1rem;
        width: 500px;
        height: 400px;
        margin: auto;
        align-items: center;
        text-align: center;
        margin-top: 3rem;
        gap:0 1rem;
    }
    .item {
        border: 2px solid black;
        border-radius: 5px;
        padding: 1rem;

    }
    .item:hover {
        background: #3F83EF;
        transition: 0.5s;
        cursor: pointer;
    }
    a {
        color: black;
    }
   
</style>
@endsection