<div class="modal" id="freezeModal">
    <div class="content">
       
        <div class="header-text">
            <h2 class="target-name">
                Freeze announce
            </h2>
            Are you sure you want to <span class="blue"> freeze </span>  this announce
        </div>
        <div class="btn-container">
            <form action="{{ route('announce.freeze') }}" method="POST">
                @csrf
                <input type="hidden" id="freeze-item-id" name="item_id">
                <button class="btn" href="#">Yes</button>
            </form>
            <button class="btn" href="#" id="close-freezeModal">Cancel</button>
        </div>
    </div>
</div>

<script>
    function freezeItem(nth) {
        
        var modal = document.getElementById("freezeModal");
        var close = document.getElementById("close-freezeModal");
        var id = $('#id_' + nth).val();
        
        $('#freeze-item-id').val(id) ; 

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