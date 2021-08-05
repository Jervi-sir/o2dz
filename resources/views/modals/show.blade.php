<div class="modal" id="myModal">
    <div class="content">
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
            <div class="text-element">
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
</div>
<script>
    function showModal(element) {
        var modal = $('#myModal');
        var close = $('#close-modal');

        modal.show();
        close.click(function() {
            modal.hide();
            //console.log('close');
        });

        $(window).click(function(event) {
            if(event.target.id == 'myModal'){
                $('#myModal').css({display: "none"});
            }
        });

        var phone_list = element.children[0].value;
        var name = element.children[1].children[0].text;
        var type = element.children[1].children[1].text;
        var location = element.children[2].children[0].innerText;
        var cost = element.children[2].children[1].innerText;
        console.log(phone_list);

        var phone_array = phone_list.split(',');
        $("#phone-list").empty();

        for(var i = 0; i < phone_array.length; i++) 
        {
            var todo = ''+
                '<a class="p-name" href="#" id="target-number">'+
                    phone_array[i]+
                '</a>';
            jQuery('#phone-list').append(todo);
        }
        document.getElementById("target-name").innerText = name; //Name
        document.getElementById("target-type").innerText = type; //Name
        document.getElementById("target-cost").cost; //Name
        document.getElementById("target-location").innerText = location; //Location
    }
</script>

<style>
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