<div class="modal" id="updateModal">
    <div class="content">
        <div class="header-text">
            <h2 class="target-name">
                Modifier
            </h2>
            <form action="{{ route('annonce.update') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" id="update-item-id">
                <div class="row">
                    <label for="modal_name">Name</label>
                    <input id="modal_name" name="name" maxlength="40" onkeyup="nameMax(this)"  type="text" required>
                    <div id="nameMax"> </div>
                </div>
                            
                <div class="row">
                    <label for="modal_location">Location</label>
                    <input id="modal_location" name="location" onkeyup="locationMax(this)"  maxlength="60"  type="text">
                    <div id="locationMax"> </div>
                </div>
                <div class="row">
                    <label for="modal_wilaya">Wilaya</label>
                    <select id="modal_wilaya" name="wilaya"class=" custom-select" onchange="search(this)">
                        <option value="0" selected disabled hidden>Select Ville</option>
                        @foreach ($wilayas as $wilaya)
                        <option value="{{ $wilaya->number }}">{{ $wilaya->number }} - {{ $wilaya->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <label for="modal_type">Type</label>
                    <select id="modal_type" name="type" class="custom-select" onchange="search(this)">
                        <option value="0" selected disabled hidden>Select Ville</option>
                        @foreach ($types as $type)
                        <option value="{{ $type->number }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <label for="modal_cost">Cost</label>
                    <select id="modal_cost" name="cost" class="custom-select" onchange="search(this)">
                        <option value="0" selected disabled hidden>Select Ville</option>
                        @foreach ($costs as $cost)
                        <option value="{{ $cost->number }}">{{ $cost->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <label for="modal_cost">description</label>
                    <textarea class="textarea" name="description" onkeyup="countChar(this)" maxlength="100" id="modal_description"></textarea>
                    <div id="charNum"></div>
                </div>
                <div class="row">
                    <label for="modal_phoneNumber">Phone Number</label>
                    <div id="modal_phoneNumber">
                       
                    </div>
                    <div class="row-submit">
                        <button type="button" onclick="addPhone()" >Add Phone</button>
                    </div>
                </div>
                <button class="btn" id="update-submit-btn" type="submit" style="display: none">Update</button>
            </form>
        </div>
        <div class="btn-container">
            <button class="btn" type="submit" onclick="submitUpdate(this)">Save</button>
            <button class="btn"  id="close-modal">Cancel</button>
        </div>
    </div>
</div>

<style>
    #updateModal .header-text {
        height: 440px;
        overflow-y: auto;
        width: 100%;
        padding: 0 2rem;
    }
</style>

<script>
    
    function submitUpdate() {
        this.disabled = true;
        var form = document.getElementById("updateModal");
        var btn = document.getElementById('update-submit-btn');
        btn.click();
    }
    function addPhone() {
        var index = $('.phone-number').length + 1;
        $('#modal_phoneNumber').append('' +
            '<div class="phone-number">'+
                '<input class="phone_input" name="phone_number[' + index + ']" onkeyup="onlyNumbers(this)" minlength="8" maxlength="10" type="text" required>'+
                '<span class="input-group-btn">'+
                    '<button type="button" class="btn-remove-phone">-</button>'+
                '</span>'+
            '</div>'
        );
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

    function updateItem(nth) {
        //get data from dom
        var id = $('#id_' + nth).val();
        var wilaya_id = $('#wilaya_id_' + nth).val();
        var type_id = $('#type_id_' + nth).val();
        var cost_id = $('#cost_id_' + nth).val();
        var description = $('#description_' + nth).text();
        var type = $('#type_' + nth).text();
        var cost = $('#cost_' + nth).text();
        var date = $('#date_' + nth).text();
        var name = $('#name_' + nth).text();
        var location = $('#location_' + nth).text();
        var phone_number = $('#phoneNumber_' + nth).val();
        var phone_array = JSON.parse(phone_number);
        //console.log(phone_number);
        
        $('#update-item-id').val(id) ; 
        $('#modal_name').val(name) ; 
        $('#modal_location').val(location) ; 
        $('#modal_wilaya').val(wilaya_id) ; 
        $('#modal_type').val(type_id) ; 
        $('#modal_cost').val(cost_id) ; 
        $('#modal_description').val(description) ; 
        $('#modal_name').val(name) ; 
        
        $('#modal_phoneNumber').val(phone_number) ; 
        $(document.body).on('click', '.btn-remove-phone' ,function(){
            $(this).closest('.phone-number').remove();
        });
        for(var i = 0; i < phone_array.length; i++)
        {
            $('#modal_phoneNumber').append('' +
                '<div class="phone-number">'+
                    '<input class="phone_input" name="phone_number[' + i + ']" minlength="8" maxlength="10" value="' + phone_array[i]  +'" type="text" required>'+
                    '<span class="input-group-btn">'+
                        '<button type="button" class="btn-remove-phone">-</button>'+
                    '</span>'+
                '</div>'
            );
        }
        var len = $('.phone-number').length;
        //console.log(len);

        var modal = document.getElementById("updateModal");
        var close = document.getElementById("close-modal");
        var voidd = document.getElementById("updateModal");
        
        modal.style.display = "block";
        // When the user clicks on <close> (x), close the modal
        close.onclick = function() {
            modal.style.display = "none";
            $('#modal_phoneNumber').empty();
            //console.log('close');
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
            $('#modal_phoneNumber').empty();
                modal.style.display = "none";
            }
        }
        voidd.onclick = function(event) {
            if (event.target == modal) {
            $('#modal_phoneNumber').empty();
                modal.style.display = "none";
            }
        }

        $('.phone_input').keypress(function(e) {
            var keyCode = e.which;
            /*
            8 - (backspace)
            32 - (space)
            48-57 - (0-9)Numbers
            */
            if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57)) { 
                //console.log('igga')
            return false;
            }
        });
        
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

    

</script>