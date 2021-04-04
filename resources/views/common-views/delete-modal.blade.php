<div id="modal_delete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                {{-- <form id='delete-modal' action="" method="DELETE">
                    @csrf
                    <input type="hidden" name="_method" value="">
                </form> --}}
                <form id="delete-modal" action=" " method="POST" style="display: none;">
                    @method('delete')
                    @csrf
                </form>

                <div class="bootbox-body"><strong style="float: left;
                    ">{{__('notification.Are_You_Sure_You_Want_to_delete')}}</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger">@lang("labels.buttons.no")</button>
                <button id="delete_action" type="button" class="btn btn-success" title="@lang("labels.buttons.delete")">@lang("labels.buttons.yes")</button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    function delete_action(item_id,route_name){
        let name=route_name+"/"+item_id;
        $('#delete-modal').attr('action', name);
    }

    window.addEventListener('load', function() {
        $('#delete_action').on('click', function (e) {
        e.preventDefault();
        $("#delete-modal").submit();

    });
        $('#modal_delete').on('hidden.bs.modal', function () {
        $('#item_id').val(0);

    });
});


</script>
