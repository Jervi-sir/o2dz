@extends('layouts.root')

@section('title')
<title>O2dz</title>
@endsection
@section('content')
{!! Toastr::message() !!}

<main>
    <div class="row">
        <h5>
            Sélectionnez Votre Lieu
        </h5>
        <span id="test"></span>
    </div>
    <div class="row ">
        <form action="{{ route('findGet') }}" method="POST">
            @csrf
            <select name="wilaya"class="custom-select" onchange="search(this)">
                <option value="0" selected disabled hidden>Ville</option>
                @foreach ($wilayas as $wilaya)     
                    <option value="{{ $wilaya->number }}">{{ $wilaya->number }} - {{ $wilaya->name }} ( {{ $wilaya->articles()->where('active',1)->count() }} )</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="row">
        <select name="type " id="type_select" class="custom-select" onchange="filter(this)" disabled> 
            <option value="0">afficher tout</option>
            @foreach ($types as $type)
            <option value="{{ $type->id }} ">{{ $type->name }}</option> 
            @endforeach
        </select>
    </div>
</main>
<div class="result">
    <div class="row justify-between">
        <div class="left"></div>
        <div class="right ">
            <p id="item-found"> </p>
        </div>
    </div>

    <div id="please-message" class="text-center">
        <h3>
            Please sélectionnez Votre wilaya
        </h3>
    <!--
        <h5>
            il y a autour $active_count des annonces actives
        </h5>
    -->
    </div>
    <div id="article-list">
    </div>
    <h3 class="bottom-message">
        si vous avez un equipement d'oxygène à announcer,
        <p><a href="{{ route('annonce.add') }}">vous pouvez l'ajouter</a> </p> 
    </h3>
</div>
@include('modals.show')

@endsection

@section('style')
<style>
    .bottom-message {
        font-weight: 100;
        font-size: 15px;
        text-align: center;
    }
    .bottom-message a {
        letter-spacing: 2px;
        color: rgb(64 154 27);
    }
.slide-up {
    transform: translateY(0);
    transition: 0.5s;
}
.slide-down {
    transform: translateY(100%);
    transition: 0.5s;
}

.alert-container {
  border-radius: 1rem 1rem 0 0;
  background-color: #5f7c8a;
  color: #f8f8f8;
  border: 1px solid #516a76;
    position: absolute;
    bottom: 0px;
    left: 0%;
    width: 100%;
    transform: translateY(100%);
}
.alert-container .alert {
  text-align: center;
  padding: 17px 0 20px 0;
  height: 60px;
  font-size: 15px;

}}

#please-message h5 {
    font-weight: 100 !important;
    color: greenyellow;
}

#please-message {
    padding-bottom: 3rem;

}

.type {
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.cost {
    margin-left: 0.5rem;
    margin-bottom: 0.5rem;
}



</style>
@endsection

@section('script')
<script>

    var results;
    function search(ele) {
        wilaya_number = ele.value;
        if(wilaya_number != 0)
        {
            $("#type_select").prop( "disabled", false );
            
            $("#article-list").empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                wilaya_number: wilaya_number,
            };
            var type = "POST";
            var ajaxurl = 'announce/get';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function (data) {

                    results = data;
                    for(var i = 0; i < data.length; i++)
                    {
                        var phone_list = data[i].phone_number.replace('["', '').replace('"]', '');
                        var phone_array = phone_list.split('","');
                        var location = data[i].location == null ? '' : data[i].location;

                        var todo = ''+
                            '<div class="card m-th" onclick="showModal(this)">'+
                                '<input class="item-id" type="hidden" value="' + data[i].id + '">' +
                                '<input class="item-name" type="hidden" value="' + data[i].name + '">' +
                                '<input class="item-type" type="hidden" value="' + data[i].type + '">' +
                                '<input class="item-type" type="hidden" value="' + data[i].cost + '">' +
                                '<input class="item-location" type="hidden" value="' + data[i].location + '">' +
                                '<input class="item-wilaya" type="hidden" value="' + data[i].wilaya + '">' +
                                '<input class="phone-array" type="hidden" value="' + phone_array + '">' +
                                '<input class="phone-array" type="hidden" value="' + data[i].description + '">' +
                                '<input class="user_type" type="hidden" value="' + data[i].user_type + '">' +
                                '<div class="row justify-between">'+
                                    '<div class="name" v-text="item.name">' + 
                                        data[i].name +
                                    '</div>'+ 
                                ' </div>'+
                                '<div class="row">'+
                                    '<div class="type"> ' +
                                            data[i].type +
                                    '</div>' +
                                    '<span> - </span>'+
                                    '<div class="cost">'  +
                                        data[i].cost +
                                    '</div>' +
                                ' </div>'+
                                '<div class="row justify-between">'+
                                    '<div class="location" >'+
                                        '<img src="images/location.svg">'+
                                        '<span v-text="item.address">'+
                                        location + 
                                        ' - ' +
                                        data[i].wilaya + 
                                        '</span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="phone-number ">'+
                                    '<div>'+
                                        '<span>'+ 
                                        phone_array[0].substring(0, 8)  + ' . . . ...' +
                                        '</span>'+
                                        '<span class="unselectable ">(' +
                                            (phone_array.length) +
                                        ')<u> voir</u></span>' +
                                    '</div>'+
                                    '<div>'+
                                        data[i].user_type +
                                    '</div>'+
                                '</div>'+
                            '</div>';
                        jQuery('#article-list').append(todo);
                    }
                    $("#item-found").text(data.length + ' found');
                    $('#please-message').hide();
                },
                error: function (data) {
                    console.log(data);
                }
            });
            
        }
    }
    //json_encode( unserialize( $article->phone_number))
    function filter(ele) {
        //console.log(ele.value)
        
        $("#article-list").empty();
        var count = 0;
        filter_type = ele.value;
        if(filter_type != 0)
        {
            for(var i = 0; i < results.length; i++)
            {
                if(results[i].type_id == filter_type)
                {
                    var phone_list = results[i].phone_number.replace('["', '').replace('"]', '');
                    var phone_array = phone_list.split('","');
                    var location = results[i].location == null ? '' : results[i].location;
                    var todo = ''+
                            '<div class="card m-th" onclick="showModal(this)">'+
                                '<input class="item-id" type="hidden" value="' + results[i].id + '">' +
                                '<input class="item-name" type="hidden" value="' + results[i].name + '">' +
                                '<input class="item-type" type="hidden" value="' + results[i].type + '">' +
                                '<input class="item-type" type="hidden" value="' + results[i].cost + '">' +
                                '<input class="item-location" type="hidden" value="' + results[i].location + '">' +
                                '<input class="item-wilaya" type="hidden" value="' + results[i].wilaya + '">' +
                                '<input class="phone-array" type="hidden" value="' + phone_array + '">' +
                                '<input class="phone-array" type="hidden" value="' + results[i].description + '">' +
                                '<input class="user_type" type="hidden" value="' + results[i].user_type + '">' +
                                '<div class="row justify-between">'+
                                    '<div class="name" v-text="item.name">' + 
                                        results[i].name +
                                    '</div>'+ 
                                ' </div>'+
                                '<div class="row">'+
                                    '<div class="type"> ' +
                                            results[i].type +
                                    '</div>' +
                                    '<span> - </span>'+
                                    '<div class="cost">'  +
                                        results[i].cost +
                                    '</div>' +
                                ' </div>'+
                                '<div class="row justify-between">'+
                                    '<div class="location" >'+
                                        '<img src="images/location.svg">'+
                                        '<span v-text="item.address">'+
                                        location + 
                                        ' - ' +
                                        results[i].wilaya + 
                                        '</span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="phone-number ">'+
                                    '<div>'+
                                        '<span>'+ 
                                        phone_array[0].substring(0, 8)  + ' . . . ...' +
                                        '</span>'+
                                        '<span class="unselectable ">(' +
                                            (phone_array.length) +
                                        ')<u> voir</u></span>' +
                                    '</div>'+
                                    '<div>'+
                                        results[i].user_type +
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    jQuery('#article-list').append(todo);
                    count++;
                }
            }
            $("#item-found").text(count + ' found');
        }
        else {
            for(var i = 0; i < results.length; i++)
            {
                var phone_list = results[i].phone_number.replace('["', '').replace('"]', '');
                var phone_array = phone_list.split('","');
                var location = results[i].location == null ? '' : results[i].location;
                var todo = ''+
                            '<div class="card m-th" onclick="showModal(this)">'+
                                '<input class="item-id" type="hidden" value="' + results[i].id + '">' +
                                '<input class="item-name" type="hidden" value="' + results[i].name + '">' +
                                '<input class="item-type" type="hidden" value="' + results[i].type + '">' +
                                '<input class="item-type" type="hidden" value="' + results[i].cost + '">' +
                                '<input class="item-location" type="hidden" value="' + results[i].location + '">' +
                                '<input class="item-wilaya" type="hidden" value="' + results[i].wilaya + '">' +
                                '<input class="phone-array" type="hidden" value="' + phone_array + '">' +
                                '<input class="phone-array" type="hidden" value="' + results[i].description + '">' +
                                '<input class="user_type" type="hidden" value="' + results[i].user_type + '">' +
                                '<div class="row justify-between">'+
                                    '<div class="name" v-text="item.name">' + 
                                        results[i].name +
                                    '</div>'+ 
                                ' </div>'+
                                '<div class="row">'+
                                    '<div class="type"> ' +
                                            results[i].type +
                                    '</div>' +
                                    '<span> - </span>'+
                                    '<div class="cost">'  +
                                        results[i].cost +
                                    '</div>' +
                                ' </div>'+
                                '<div class="row justify-between">'+
                                    '<div class="location" >'+
                                        '<img src="images/location.svg">'+
                                        '<span v-text="item.address">'+
                                            location  + 
                                        ' - ' +
                                        results[i].wilaya + 
                                        '</span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="phone-number ">'+
                                    '<div>'+
                                        '<span>'+ 
                                        phone_array[0].substring(0, 8)  + ' . . . ...' +
                                        '</span>'+
                                        '<span class="unselectable ">(' +
                                            (phone_array.length) +
                                        ')<u> voir</u></span>' +
                                    '</div>'+
                                    '<div>'+
                                        results[i].user_type +
                                    '</div>'+
                                '</div>'+
                            '</div>';
                jQuery('#article-list').append(todo);
            }
            $("#item-found").text(results.length + ' found');
        }
    }
</script>

@endsection