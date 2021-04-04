<div class="text-right">
    <button title="{{trans('labels.buttons.delete')}}"  data-target="#modal_delete"
            data-toggle="modal"  class="delete_action btn btn-danger btn-sm"
            type="button" onclick="delete_action({{$data->id}},'users')">
        Delete
    </button>
    <a class="btn btn-sm btn-info" href="{{route('users.edit',$data->id)}}">Edit</a>
</div>



