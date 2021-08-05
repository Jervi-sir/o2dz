<div class="modal" id="deleteModal">
    <div class="content">
        
        <div class="header-text">
            <h2 class="target-name">
                Supprimer l'annonce ?
            </h2>
            Are you sure you want to <span class="red"> delete </span> this announce
        </div>
        <div class="btn-container">
            <form action="{{ route('announce.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="delete-item-id" name="item_id">
                <button class="btn" href="#">Yes</button>
            </form>
            <button class="btn" href="#" id="close-deleteModal">Cancel</button>
        </div>
    </div>
</div>
<script>
    function deleteItem(nth) {
        var modal = document.getElementById("deleteModal");
        var close = document.getElementById("close-deleteModal");

        var id = $('#id_' + nth).val();
        
        $('#delete-item-id').val(id) ; 

        modal.style.display = "block";
        // When the user clicks on <close> (x), close the modal
        close.onclick = function() {
            modal.style.display = "none";
            //console.log('close');
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        
    }
</script>