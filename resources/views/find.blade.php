@extends('layouts.root')

@section('title')
<title>O2dz</title>
@endsection
@section('content')
{!! Toastr::message() !!}

<main>
    <div class="row">
        <h5>
            Select Your Location
        </h5>
    </div>
    <div class="row ">
        <form action="{{ route('findGet') }}" method="POST">
            @csrf
            <select name="wilaya"class="custom-select" onchange="search(this)">
                <option value="0" selected disabled hidden>Select Ville</option>
                @foreach ($wilayas as $wilaya)
                    <option value="{{ $wilaya->number }}">{{ $loop->index +1 }} - {{ $wilaya->name }} ( {{ $count[$loop->index] }} )</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="row">
        <select name="type " id="type_select" class="custom-select" onchange="filter(this)" disabled> 
            <option value="0">All</option>
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
            Please select your wilaya
        </h3>
        <h5>
            there is around {{ $active_count }} active announces
        </h5>
        
    </div>
    <div id="article-list">
    </div>
</div>
@include('modals.show')
 <!--
<div id="toast" class="alert-container">
    <div class="alert">
     
    </div>
</div>
-->
<style>



</style>
@endsection

@section('style')
<style>
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


</style>
@endsection

@section('script')
<script>
    /*----TOast
    
    setTimeout(function(){ 
        $('#toast').addClass('slide-up');
     }, 1000);

     setTimeout(function(){ 
        $('#toast').addClass('slide-down');
     }, 4000);
     setTimeout(function(){ 
        $('#toast').hide();
     }, 5000);
      ---*/
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
                    //console.log(data);
                    results = data;
                    for(var i = 0; i < data.length; i++)
                    {
                        var phone_list = (data[i].phone_number).replace('[', '').replace(']', '').replaceAll('"', '');
                        var phone_array = phone_list.split(',');
                        var location = results[i].location == null ? '' : results[i].location;
                        var todo = ''+
                            '<div class="card m-th" onclick="showModal(this)">'+
                                '<input class="phone-array" type="hidden" value="' + phone_array + '">' +
                                '<div class="row justify-between">'+
                                    '<div class="name" v-text="item.name">' + 
                                        data[i].name +
                                    '</div>'+ 
                                    '<div class="type"> ' +
                                        data[i].type +
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
                                    '<div class="cost">'  +
                                        data[i].cost +
                                    '</div>' +
                                '</div>'+
                                '<div class="phone-number ">'+
                                    '<span>'+ 
                                    phone_array  + 
                                    '</span>'+
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
                    var phone_list = (results[i].phone_number).replace('[', '').replace(']', '').replaceAll('"', '');
                    var phone_array = phone_list.split(',');
                    var location = results[i].location == null ? '' : results[i].location;
                    var todo = ''+
                            '<div class="card m-th" onclick="showModal(this)">'+
                                '<input class="phone-array" type="hidden" value="' + phone_array + '">' +
                                '<div class="row justify-between">'+
                                    '<div class="name" v-text="item.name">' + 
                                        results[i].name +
                                    '</div>'+ 
                                    '<div class="type"> ' +
                                        results[i].type +
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
                                    '<div class="cost">'  +
                                        results[i].cost +
                                    '</div>' +
                                '</div>'+
                                '<div class="phone-number ">'+
                                    '<span>'+ 
                                    phone_array + 
                                    '</span>'+
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
                var phone_list = (results[i].phone_number).replace('[', '').replace(']', '').replaceAll('"', '');
                var phone_array = phone_list.split(',');
                var location = results[i].location == null ? '' : results[i].location;
                var todo = ''+
                            '<div class="card m-th" onclick="showModal(this)">'+
                                '<input class="phone-array" type="hidden" value="' + phone_array + '">' +
                                '<div class="row justify-between">'+
                                    '<div class="name" v-text="item.name">' + 
                                        results[i].name +
                                    '</div>'+ 
                                    '<div class="type"> ' +
                                        results[i].type +
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
                                    '<div class="cost">'  +
                                        results[i].cost +
                                    '</div>' +
                                '</div>'+
                                '<div class="phone-number ">'+
                                    '<span>'+ 
                                    phone_array + 
                                    '</span>'+
                                '</div>'+
                            '</div>';
                jQuery('#article-list').append(todo);
            }
            $("#item-found").text(results.length + ' found');
        }
    }
</script>




@endsection