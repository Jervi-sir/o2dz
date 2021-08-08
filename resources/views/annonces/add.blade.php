@extends('layouts.root')

@section('title')
<title>O2dz - ajouter</title>
@endsection

@section('content')
<div class="contact">
    {!! Toastr::message() !!}
    @if($announce_count < 7)
    <h1>
        Thank you choosing to help us
    </h1>
    <h2>
        Veuillez remplir les details de l'annonce
        <p>d'oxygène</p>
        <p class="arabic-font">من فضلك ، لا إعلانات مزيفة🙏</p>
    </h2>
    <form action="{{ route('annonce.store') }}" method="POST">
        @csrf
        <input class="input" name="name" type="text" maxlength="40" onkeyup="nameMax(this)" placeholder="Name" required>
        <div id="nameMax"> </div>
        <input class="input" name="location" onkeyup="locationMax(this)"  maxlength="60"  type="text" placeholder="location">
        <div id="locationMax"> </div>
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
        <div>
            <textarea class="textarea" name="description" onkeyup="countChar(this)" maxlength="100" placeholder="description ( غير ملزم )"></textarea>
            <div id="charNum"></div>
        </div>
        
        <div id="phone-list">
            <div class="phone-input">
                <input class="input" onkeyup="onlyNumbers(this)"  name="phone[1]" type="text" minlength="8" maxlength="10" value="{{ is_numeric($phone_number) ? $phone_number : '' }}" placeholder="Phone Number" required>
            </div>
        </div>
        <div class="row-submit add-btn">
            <button type="button" onclick="addPhone()" >+</button>
            <div class="count-row">
                <span id="phone-count">
                4 / 5 
                </span>
                <span class="count-text">
                    <p>numbers</p>
                    <p>lefts</p>
                </span>
            </div>
        </div>
        <div class="row-submit">
            <button class="submit" type="submit">Ajouter</button>
        </div>
    </form>
    @else
    <h2 class="sorry-message arabic-font">
        <p>
            نحن آسفون 😥 وضعنا الحد الأقصى عند 7 إعلان لبعض الأسباب
        </p>
        <p>
            يمكنك حذف أحد الإعلانات الافضل الإعلانات المجمدة
        </p>
        <p>
            أو اتصل بنا إذا واجهتك مشكلة
        </p>
    </h2>
    <h1>
        <a href="{{ route('annonce.manage') }}">
           > Gérer mes annoces <
        </a>
    </h1>
    @endif

</div>
<!--  -->
@endsection

@section('script')
<script>
$(document.body).on('click', '.btn-remove-phone' ,function(){
    $(this).closest('.phone-input').remove();
    var index = $('.phone-input').length;
    $('#phone-count').text(5 - index + " / 6 ");
    $('.count-row').removeClass('red');
    $('.count-row').removeClass('shake');
});

function addPhone() {
    var index = $('.phone-input').length + 1;
    //console.log(index);
    if(index <= 5) {
        $('#phone-count').text(5 - index + " / 5 ");
        $('#phone-list').append('' +
            '<div class="phone-input">'+
                '<input class="input" name="phone['+ index +']" onkeyup="onlyNumbers(this)" minlength="8" maxlength="10" type="text" placeholder="Phone Number" required>'+
                '<span class="input-group-btn">'+
                    '<button type="button" class="btn-remove-phone" >-</button>'+
                '</span>'+
            '</div>'
        );
    }
    else {
        $('.count-row').addClass('red');
        $('.count-row').addClass('shake');
    }
}

function countChar(ele)
{
    //console.log(ele.maxLength);
    var len = ele.value.length;
    if (len >= 101) {
        ele.value = ele.value.substring(0, 100);
    } else {
        $('#charNum').text(( 100 - len ) + ' / 100');
        if (len < 20) {
            $('#charNum').css('color', '#666');
        }
        if (len > 20 && len < 50) {
            $('#charNum').css('color', '#6d5555');
        }
        if (len > 50 && len < 70) {
            $('#charNum').css('color', '#793535');
        }
        if (len > 70 && len < 90) {
            $('#charNum').css('color', '#841c1c');
        }
        if (len > 90 && len < 99) {
            $('#charNum').css('color', '#8f0001');
        }
    }
}

function nameMax(ele) {
    var len = ele.value.length;
    if (len >= 41) {
        ele.value = ele.value.substring(0, 40);
    } else {
        $('#nameMax').text(( 40 - len ) + ' / 40');
        if (len < 5) {
            $('#nameMax').css('color', '#666');
        }
        if (len > 5 && len < 10) {
            $('#nameMax').css('color', '#6d5555');
        }
        if (len > 10 && len < 20) {
            $('#nameMax').css('color', '#793535');
        }
        if (len > 20 && len < 30) {
            $('#nameMax').css('color', '#841c1c');
        }
        if (len > 30 && len < 40) {
            $('#nameMax').css('color', '#8f0001');
        }
    }
}

function locationMax(ele) {
    var len = ele.value.length;
    if (len >= 61) {
        ele.value = ele.value.substring(0, 60);
    } else {
        $('#locationMax').text(( 60 - len ) + ' / 60');
        if (len < 10) {
            $('#locationMax').css('color', '#666');
        }
        if (len > 10 && len < 20) {
            $('#locationMax').css('color', '#6d5555');
        }
        if (len > 20 && len < 30) {
            $('#locationMax').css('color', '#793535');
        }
        if (len > 30 && len < 45) {
            $('#locationMax').css('color', '#841c1c');
        }
        if (len > 45 && len < 60) {
            $('#locationMax').css('color', '#8f0001');
        }
    }
}
function onlyNumbers(ele) {
    var number = "";
    for(var i = 0; i < ele.value.length; i++) {
        if(!isNaN(ele.value[i])) {
            number += ele.value[i];
        }
    }
    ele.value = number;
}
</script>
@endsection

@section('style')
<style>
    h1 a {
        color: inherit;
    }
    .sorry-message p{
        margin-bottom: 1rem;
    }
    /* http://waitanimate.wstone.io/#!/ */
    .shake {
        animation: shake-animation 3s ease;
        transform-origin: 50% 50%;
    }
    
    @keyframes shake-animation {
        0% {
            transform: translate(0, 0);
        }
        1.78571% {
            transform: translate(5px, 0);
        }
        3.57143% {
            transform: translate(0, 0);
        }
        5.35714% {
            transform: translate(5px, 0);
        }
        7.14286% {
            transform: translate(0, 0);
        }
        8.92857% {
            transform: translate(5px, 0);
        }
        10.71429% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(0, 0);
        }
    }

    .red {
        color: #fd8383;
    }
    .count-row {
        display: flex;
        gap: 0.5rem;
    }
    .count-row p {
        font-size: 10px;
        text-align: center;
    }
    .contact {
        padding-bottom: 2rem;
    }
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
        border: none;
        border-radius: 5px;
    }
    .add-btn {
        gap: 1rem;
        margin-bottom: 2rem;
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
        background: #19fedf !important;
        font-weight: 700;
        padding: 5px 45px !important;
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
        height: 100%;
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
        margin-bottom: 0;
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
    #nameMax,
    #locationMax {
        margin-bottom: 1.5rem;
        text-align: right;
    }

  </style>
@endsection
