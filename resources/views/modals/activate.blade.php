<div class="modal" id="activateModal">
    <div class="content">
       
        <div class="header-text">
            <h2 class="target-name">
                activate announce
            </h2>
            Are you sure you want to <span class="blue"> activate </span>  this announce
        </div>
        <div class="btn-container">
            <form action="{{ route('announce.activate') }}" method="POST">
                @csrf
                <input type="hidden" id="activate-item-id" name="item_id">
                <button class="btn" href="#">Yes</button>
            </form>
            <button class="btn" href="#" id="close-activateModal">Cancel</button>
        </div>
    </div>
</div>
<script>
    function activateItem(nth) {
        
        var modal = document.getElementById("activateModal");
        var close = document.getElementById("close-activateModal");
        var id = $('#id_' + nth).val();
        
        $('#activate-item-id').val(id) ; 

        modal.style.display = "block";
        // When the user clicks on <close> (x), close the modal
        close.onclick = function() {
            modal.style.display = "none";
            console.log('close');
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>