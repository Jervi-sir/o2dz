<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">rrr
    <link rel="icon" type="image/png" href="images/logo.svg"/>

    <title>Contact us</title>
</head>
<body>
    
    <div class="body">
            @include('elements.header')
            <div class="contact">
                <h1>
                  Thank you for contacting us
                </h1>
                <h2>
                  Veuillez remplir vos coordonnées, afin que nous puissions vous ajouter automatiquement à la liste
                </h2>
                <h5 class="success" v-show="status == 'success'"></h5>
                <form @submit.prevent="addData">
                  <select name="cars " id="cars" v-model="selected" class="custom-select" required>
                    <option value="0" selected disabled hidden>Selectioner votre Ville</option>
                    @foreach ($wilayas as $wilaya)
                    <option value="{{ $wilaya->number }}">{{ $wilaya->number }} - {{ $wilaya->name }}</option> 
                    @endforeach
                  </select>
                  <input type="text" placeholder="Nom de votre local" v-model="name">
                  <input type="text" placeholder="Address du local" v-model="address">
                  <div class="phone-number" v-for="(input,k) in phone_numbers" :key="k">
                    <input type="text" pattern="[0]\d*" minlength="6" maxlength="10" class="phone-input" v-model="phone_numbers[k].number" placeholder="Numero de telephone" required>
                    <span class="add">
                      <img src="images/plus.svg" @click="add(k)" v-show="k == phone_numbers.length-1">
                      <img src="images/minus.svg" @click="remove(k)" v-show="k || ( !k && phone_numbers.length > 1)">
                    </span>
                  </div>
                  <div class="row">
                    <button type="submit" :disabled="notActive">Envoyer</button>
                  </div>
                </form>
              </div>
            <footer>
              Made by :: 2KingsWebsites
            </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 
    </div>
    <style>
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

        select, input, .phone-number {
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

        input {
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

</body>
</html>