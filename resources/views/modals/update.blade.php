<div class="modal" id="updateModal">
    <div class="content">
        <div class="header-text">
            <h2 class="target-name">
                edit announce
            </h2>
            <form action="{{ route('annonce.update') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" id="update-item-id">
                <div class="row">
                    <label for="modal_name">Name</label>
                    <input id="modal_name" name="name" type="text" required>
                </div>
                
                <div class="row">
                    <label for="modal_location">Location</label>
                    <input id="modal_location" name="location" type="text" required>
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
            <button class="btn" type="submit" onclick="submitUpdate()">Update</button>
            <button class="btn"  id="close-modal">Cancel</button>
        </div>
    </div>
</div>

<script>
    
    function submitUpdate() {
        var form = document.getElementById("updateModal");
        var btn = document.getElementById('update-submit-btn');
        btn.click();
    }
    function addPhone() {
        var index = $('.phone-number').length + 1;
        $('#modal_phoneNumber').append('' +
            '<div class="phone-number">'+
                '<input class="phone_input" name="phone_number[' + index + ']" minlength="8" maxlength="10" type="text" required>'+
                '<span class="input-group-btn">'+
                    '<button type="button" class="btn-remove-phone">-</button>'+
                '</span>'+
            '</div>'
        );
    }
    function updateItem(nth) {
        //get data from dom
        var id = $('#id_' + nth).val();
        var wilaya_id = $('#wilaya_id_' + nth).val();
        var type_id = $('#type_id_' + nth).val();
        var cost_id = $('#cost_id_' + nth).val();
        var type = $('#type_' + nth).text();
        var cost = $('#cost_' + nth).text();
        var date = $('#date_' + nth).text();
        var name = $('#name_' + nth).text();
        var location = $('#location_' + nth).text();
        var phone_number = $('#phoneNumber_' + nth).val();
        var phone_array = JSON.parse(phone_number);
        console.log(phone_number);
        
        $('#update-item-id').val(id) ; 
        $('#modal_name').val(name) ; 
        $('#modal_location').val(location) ; 
        $('#modal_wilaya').val(wilaya_id) ; 
        $('#modal_type').val(type_id) ; 
        $('#modal_cost').val(cost_id) ; 
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
        console.log(len);

        var modal = document.getElementById("updateModal");
        var close = document.getElementById("close-modal");

        modal.style.display = "block";
        // When the user clicks on <close> (x), close the modal
        close.onclick = function() {
            modal.style.display = "none";
            $('#modal_phoneNumber').empty();
            console.log('close');
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
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
                console.log('igga')
            return false;
            }
        });
        
    }

    

</script>