@extends('layouts.root')

@section('title')
<title>O2dz - ajouter</title>
@endsection

@section('content')
<div class="contact">
    {!! Toastr::message() !!}
    <h1>
        Thank you choosing to help us
    </h1>
    <h2>
        Veuillez remplir vos coordonnées, afin que s'identifier
    </h2>
    <form action="{{ route('annonce.store') }}" method="POST">
        @csrf
        <div class="phone-number" v-for="(input,k) in phone_numbers" :key="k">
            <input class="input" name="name" type="text" placeholder="Name" required>
        </div>
        <input class="input" name="location" type="text" placeholder="location" required>
        <select class="custom-select" name="wilaya_number" >
            @foreach ($wilayas as $wilaya)
            <option value="{{ $wilaya->number }}" {{ $wilaya->id == Auth()->user()->wilaya_id ? 'selected' : '' }}>{{ $wilaya->number }} - {{ $wilaya->name }}</option>
            @endforeach
        </select>
        <select class="custom-select" name="type_number" >
            @foreach ($types as $type)
            <option value="{{ $type->number }}">{{ $type->name }}</option>
            @endforeach
        </select>
        <select class="custom-select" name="cost_number">
            @foreach ($costs as $cost)
            <option value="{{ $cost->number }}">{{ $cost->name }}</option>
            @endforeach
        </select>
        <div id="phone-list">
            <div class="phone-input">
                <input class="input" name="phone[1]" type="text" value="{{ $phone_number }}" placeholder="Phone Number" required>
            </div>
        </div>
        <div class="row-submit add-btn">
            <button type="button" onclick="addPhone()" >+</button>

        </div>
        <div class="row-submit">
            <button class="submit" type="submit">Ajouter</button>
        </div>
    </form>
</div>
<!--  -->
@endsection

@section('script')
<script>
    $(document.body).on('click', '.btn-remove-phone' ,function(){
        $(this).closest('.phone-input').remove();
    });
    
    function addPhone() {
        var index = $('.phone-input').length + 1;
        console.log(index);
        $('#phone-list').append('' +
            '<div class="phone-input">'+
                '<input class="input" name="phone['+ index +']" type="text" placeholder="Phone Number" required>'+
                '<span class="input-group-btn">'+
                    '<button type="button" class="btn-remove-phone" >-</button>'+
				'</span>'+
            '</div>'
        );
    }
</script>
@endsection

@section('style')
<style>
    #phone-list input {
        margin-bottom: 0;
    }
    .phone-input {
        display: flex;
        align-items: center;
        margin-top: 1rem;
        margin-bottom: 5px;
    }
    .btn-remove-phone {
        padding: 0;
        height: 35px;
        padding: 0 1rem;
        background: #fd8383;
        color: white;
    }
    .add-btn button:hover,
    .btn-remove-phone:hover {
        cursor: pointer;
        color: black;
        transition: 0.5s;
    }
    .add-btn button {
        padding: 5px 30px;
        color: white;
        background: #19b5fe;
        margin-bottom: 2rem;
        font-weight: 700;
    }
    .row-submit {
        display: flex;
        flex-direction: row-reverse;
        font-weight: 700;
    }
    .row-submit button:hover {
        cursor: pointer;
        color: black;
        background: #57d6ce;
        transition: 0.5s;
    }
    .submit {
        background: #4ecdc4;
        color: white;
    }
    .body {
        height: 100vh;
    }
    .hideAnimation {
        opacity: 0;
        transition: 0.7s;
    }

    .blur {
        filter: blur(3px);
        position: relative;
    }
    .overlay {
        transform: translate(0%, 30%);
        position: fixed;
        text-align: center;
        z-index: 99;
        height: 100vh;
        width: 100vw;
    }
    .overlay-show {
        display: block;
    }
    .overlay .continue, .overlay .back {
        border-radius: 7px;
        padding: 15px 0;
        width: 100px;
        text-align: center;
        border: none;
        font-size: 15px;
        font-weight: 600;
        font-family: inherit;
    }

    .overlay .row {
        margin-top: 4rem;
        display: flex;
        width: 100%;
        justify-content: space-around;
    }

    .continue {
        color: #800000;
        background: #fd5e53;
    }
    .back {
        color: #4a4c4c;
        background: #b7bdbb;
    }

    .background {
        filter: blur(10px);
        top: 0;
        left: 0;
        background: rgb(233, 245, 248);
        opacity: 0.5;
        width: 100vw;
        height: 100vh;
    }
    
    @media only screen and (min-width: 768px) {
        .overlay {
            width: 50%;
            margin: auto;
        }
    }

    .success, .error {
        text-align: center;
        font-weight: normal;
        font-size: 20px;
        color: rgb(38 165 127);
        background: rgb(38 165 127 / 23%);
        padding: 5px 20px;
        border-radius: 9px;
    }
    .error {
        color: rgb(165 38 38);
        background: rgb(165 38 38 / 23%);
    }
    .add {
        margin-top: 5px;
        display: flex;
        height: 25px;
        width: 80px;
        justify-content: space-between;
        flex-direction: row-reverse;
    }

    h1 {
        font-style: normal;
        font-size: 18px;
        line-height: 18px;
        color: #000000;
        text-align: center;
        margin-bottom: 30px;
    }

    h2 {
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 15px;
        text-align: center;
        text-align: center;
        color: #000000;
        margin-bottom: 50px;
    }

    .contact {
        margin: 0 35px;
        margin-top: 50px;
    }

    .row-submit button {
        background: #BFD7FF;
        border-radius: 7px;
        padding: 15px 45px;
        border: none;
        font-family: inherit;
        color: #323843;
    }

    .row {
        display: flex;
    }

    select, .input, .phone-number {
        width: 100%;
        box-shadow: inset 0px -1px 7px #E5EEFF, inset 0px 5px 8px #E5EEFF;
        background: #FAFBFF;
        border-radius: 6px;
        border: none;
        height: 35px;
        padding-left: 18px;
        font-family: inherit;
        font-size: inherit;
        color: #65859A;
        font-size: 15px;
        margin-bottom: 2rem;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .input {
    font-weight: 100;
    font-size: 14px;
    }

    .phone-number {
    display: flex;
    background: none;
    padding: 0;
    }

    select:-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #000;
    }

    select.custom-select {
        background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%);
        background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px), calc(100% - 2.5em) 0.5em;
        background-size: 5px 5px, 5px 5px, 1px 1.5em;
        background-repeat: no-repeat;
    }

    select.custom-select:focus {
        background-image: linear-gradient(45deg, green 50%, transparent 50%), linear-gradient(135deg, transparent 50%, green 50%), linear-gradient(to right, #ccc, #ccc);
        background-position: calc(100% - 15px) 1em, calc(100% - 20px) 1em, calc(100% - 2.5em) 0.5em;
        background-size: 5px 5px, 5px 5px, 1px 1.5em;
        background-repeat: no-repeat;
        border-color: green;
        outline: 0;
    }

  </style>
@endsection
