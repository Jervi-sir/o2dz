@extends('layouts.root')

@section('title')
<title>O2dz - gerer</title>
@endsection

@section('content')
{!! Toastr::message() !!}

<div class="contact">
    <h1>
        Thank you choosing to help us
    </h1>
    <h2 class="arabic-font">
        يمكنك نشر 7 إعلانات الأكسجين فقط
    </h2>
</div>
@if($articles->count())
<div class="result">
    <div class="row justify-between">
    </div>
    <div id="article-list">
        @foreach ($articles as $article)
        <div class="item" id="nth-item_{{ $loop->index }}" >
            @if(!$article->active)
                <div class="frozen">
                    <h1>Votre annonce est cachée</h1>
                </div>
            @endif
            <input type="hidden" value="{{ $article->id }}" id="id_{{ $loop->index }}">
            <input type="hidden" value="{{ $article->wilaya_id }}" id="wilaya_id_{{ $loop->index }}">
            <input type="hidden" value="{{ $article->type_id }}" id="type_id_{{ $loop->index }}">
            <input type="hidden" value="{{ $article->cost_id }}" id="cost_id_{{ $loop->index }}">
            
            <div class="name" id="name_{{ $loop->index }}">{{ $article->name }}</div>
            <div class="location" >
                <span id="location_{{ $loop->index }}">{{ $article->location }}</span>
                <span>{{ $article->wilaya_id }} - {{ $article->wilaya }}</span>
            </div>
            
            <div class="details">
                <p>
                    type: <span id="type_{{ $loop->index }}">{{ $article->type }}</span>
                </p>
                <p>
                    cost: <span id="cost_{{ $loop->index }}">{{ $article->cost }}</span>
                </p>
                <p>
                    date: <span id="date_{{ $loop->index }}">{{ $article->updated_at->isoFormat('d - MMMM - YY') }}</span>
                </p>
                
            </div>
            
            <input type="hidden" id="phoneNumber_{{ $loop->index }}" value="{{ json_encode( unserialize( $article->phone_number)) }}">
            @foreach (unserialize($article->phone_number) as $phone)
                {{ $phone }}
            @endforeach
            
        </div>
        <div class="tool">
            <div class="edit">
                <button onclick="updateItem({{ $loop->index }})" >Modifier</button>
            </div>
            @if($article->active)
            <div class="freeze">
                <button onclick="freezeItem({{ $loop->index }})">Cacher</button>
            </div>
            @else
            <div class="activate">
                <button onclick="activateItem({{ $loop->index }})">activate</button>
            </div>
            @endif
            
            <div class="delete">
                <button onclick="deleteItem({{ $loop->index }})">Supprimer</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="text-center non-found">
    <h3 class="">Veuillez ajouter votre announce d'oxygen</h3>
    <a href="{{ route('annonce.add') }}" class="">  Ajouter une annonce</a>
</div>
@endif
@include('modals.activate')
@include('modals.delete')
@include('modals.freeze')
@include('modals.update')

@endsection

@section('script')

@endsection

@section('style')
<style>
#article-list .item:nth-of-type(even) {
    /* background: linear-gradient(52.35deg, #D2E1FB 31.01%, #EAF1FF 82.46%); */
    background: linear-gradient(52.35deg, #b9d2fd 31.01%, #EAF1FF 82.46%);
}

#article-list .item:nth-of-type(odd) {
    /* background: linear-gradient(52.35deg, #ECF2FF 31.01%, #FFFFFF 82.46%);*/
    background: linear-gradient(344deg, #e8efff 31.01%, #FFFFFF 82.46%);
}
.non-found {
    padding-bottom: 2rem;
}
.non-found a {
    color: #7f7ff3;
    font-weight: 600;
    letter-spacing: 2px;
}
.tool button {
    font-weight: 400;
    letter-spacing: 2px;
    font-size: 12px;
}
.row-submit {
    display: flex;
    flex-direction: row-reverse;
}
.row-submit button{
    padding: 5px 30px;
}
#phone-list input {
    margin-bottom: 0;
}
.phone-input {
    display: flex;
    align-items: center;
}
.input-group-btn {
    width: 15%;
    height: 35px;
    margin-right: 0 !important;
}
.btn-remove-phone {
    padding: 0;
    background: #fd8383;
    color: white;
    width: 100%;
    height: 100%;
    font-size: 30px;
}
.item {
    position: relative;
}
.item .frozen {
    position: absolute;
    top: 0;
    left: 0;
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    height: 100%;
    width: 100%;
}
.frozen h1 {
    position: absolute;
    top: 50%;
    left: 50%;
    right: 0;
}
.target-name {
    margin-bottom: 1rem;
}
.red {
    color: rgb(240, 54, 54);
}
.blue {
    color: rgb(61, 61, 235);
}
.header-text {
    width: 70%;
}
.modal .row {
    display: block;
}
.modal input {
    padding-left: 1rem;
    margin-bottom: 1rem;
}
input {
    background: #FAFBFF;
    border-radius: 10px;
    border: none;
    height: 36px;
    width: 100%;
    box-shadow: inset 0px -1px 7px #E5EEFF, inset 0px 5px 8px #E5EEFF;
}

.modal select {
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
    margin-bottom: 0.5rem;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
}

.modal select:-moz-focusring {
    color: transparent;
    text-shadow: 0 0 0 #000;
}

.modal select.custom-select {
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%);
    background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px), calc(100% - 2.5em) 0.5em;
    background-size: 5px 5px, 5px 5px, 1px 1.5em;
    background-repeat: no-repeat;
}

.modal select.custom-select:focus {
    background-image: linear-gradient(45deg, green 50%, transparent 50%), linear-gradient(135deg, transparent 50%, green 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 15px) 1em, calc(100% - 20px) 1em, calc(100% - 2.5em) 0.5em;
    background-size: 5px 5px, 5px 5px, 1px 1.5em;
    background-repeat: no-repeat;
    border-color: green;
    outline: 0;
}

.item {
    font-family: Aldrich;
    padding: 1rem 2rem;
    border-radius: 15px 15px 0px 0px;
    padding-bottom: 10px;
}
.item:nth-of-type(even) {
    /* background: linear-gradient(52.35deg, #D2E1FB 31.01%, #EAF1FF 82.46%); */
    background: linear-gradient(52.35deg, #b9d2fd 31.01%, #EAF1FF 82.46%);
}

.item:nth-of-type(odd) {
    /* background: linear-gradient(52.35deg, #ECF2FF 31.01%, #FFFFFF 82.46%);*/
    background: linear-gradient(344deg, #e8efff 31.01%, #FFFFFF 82.46%);
}
.item .details {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
    font-size: 15px;
    line-height: 15px;
    color: #354168;
}
.item .name {
    font-size: 25px;
    line-height: 24px;
    color: #354168;
}
.item .location {
    font-size: 15px;
    line-height: 15px;
    color: #65859A;
}
.item .phone_number {
    font-size: 15px;
    line-height: 15px;
    color: #4C4F59;
}
.tool {
    display: flex;
    width: 100%;
    justify-content: space-around;
    align-items: center;
    background: #88B1FF;
    height: 31px;
    border-radius: 0px 0px 15px 15px;
    font-size: 15px;
    line-height: 15px;
    color: #FFFFFF;
    margin-bottom: 1rem;
}   
.item .details {
    margin-bottom: 10px;
}
.item .name {
    margin-bottom: 10px;
}
.item .location {
    margin-bottom: 15px;
}
.tool button {
    background: none;
    border-radius: 0;
    padding: 0;
    color: white;
}
.tool button:hover {
    cursor: pointer;
    color: #000;
    transition: 0.5s 
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

button {
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
margin-bottom: 10px;
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
