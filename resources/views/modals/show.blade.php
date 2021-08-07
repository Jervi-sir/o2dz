<div class="modal" id="myModal">
    <div class="content">
        <div class="modal-main">
            <div class="header-text">
                <h2 id="target-name">
                    Name
                </h2>
                <h3 id="target-type" class="text-center">
                    Type
                </h3>
                <h5 id="target-cost" class="text-center">
                    Cost
                </h5>
            </div>
            <div class="card">
                <div class="text-element location-modal">
                    <img src="images/location.svg">
                    <p class="l-name" id="target-location">Location - rue - wilaya</p>
                </div>
            </div>
            <div class="card">
                <div id="phone-list" class="text-element">
                    
                </div>
            </div>
            <button class="btn-container"  id="close-modal">
                <div class="btn">
                    Cancel
                </div>
            </button>
        </div>
        <div id="target-signal" class="signal" onclick="signal(this)" data-myvalue="37">
            <input type="hidden" id="modal-target" value="">
            <h4>
                si l'annonce est fausse, <p> clicker pour signaler </p> 
            </h4>
        </div>
    </div>
    
</div>
<script>
    var clicked_on_report = 0;

    function showModal(element) {
        var modal = $('#myModal');
        var close = $('#close-modal');

        modal.show();
        close.click(function() {
            modal.hide();
            clicked_on_report = 0
            //console.log('close');
        });

        $(window).click(function(event) {
            if(event.target.id == 'myModal'){
                $('#myModal').css({display: "none"});
                clicked_on_report = 0
            }
        });

        var id = element.children[0].value;
        var name = element.children[1].value;
        var type = element.children[2].value;
        var cost = element.children[3].value;
        var location = element.children[4].value;
        var wilaya = element.children[5].value;
        var phone_list = element.children[6].value;

        var phone_array = phone_list.split(',');
        $("#phone-list").empty();

        for(var i = 0; i < phone_array.length; i++) 
        {
            var todo = ''+
                '<a class="p-name" href="tel:' + phone_array[i] + '" id="target-number">'+
                    phone_array[i]+
                '</a>';
            jQuery('#phone-list').append(todo);
        }

        if(location == 'null'){
            location = '';
        }

        $('#modal-target').val(id); 
        document.getElementById("target-name").innerText = name; //Name
        document.getElementById("target-type").innerText = type; //Name
        document.getElementById("target-cost").innerText = cost;//Name
        document.getElementById("target-location").innerText = location + ' - ' + wilaya; //Location
    }

    function signal(ele) {

        if(clicked_on_report == 0)
        {
            //ajax
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                var data = ele.children[0].value;
                console.log(data);
                var type = "POST";
                var ajaxurl = 'announce/report';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: {id: data},
                    dataType: 'json',
                    success: function (data) {
                        clicked_on_report++;
                        //if already    
                        if(data['already']){
                            toastr.options = {"positionClass":"toast-top-center"};
                            toastr.warning(data['already'],'');
                        } 
                        //if success
                        if(data['signaled']){
                            toastr.options = {"positionClass":"toast-top-center"};
                            toastr.info(data['signaled'],'');
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
        }
        //disable ajax requests
        else {
            toastr.options = {"positionClass":"toast-top-center"};
            toastr.warning('Vous avez deja signaler cette annonce','');
        }
    }
</script>

<style>
    .signal {
        margin-top: 1rem;
    }
    .signal h4 {
        text-align: center;
        background: #8dafee85;
        color: #d3e3ff;
        color: white;
        font-weight: 100;
        padding: 5px 10px;
        border-radius: 15px;
    }
    .signal:hover {
        background: #8dafeec7;
        border-radius: 15px;
        color: #d3e3ff;
        cursor: pointer;
        transition: 0.5s;
    }
    .modal .content {
        background-color: transparent !important;

    }
    .modal-main {
        width: 100%;
        background: #D2E1FB;
        border-radius: 15px;
    }

    .location-modal {
        margin: auto;
    }

    #phone-list {
        display: grid;
        text-align: center;
    }
    #phone-list a{
        margin-bottom: 1rem;
    }
    .modal .btn-container {
        margin-top: 0;
        align-items: center;
    }
    .text-element {
        display: flex;
        align-items: center;
    }
    .text-element img{
        margin-right: 0.5rem;
    }
    

</style>