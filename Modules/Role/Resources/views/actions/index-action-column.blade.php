<div class="text-right">
    <button title="{{trans('labels.buttons.delete')}}"  data-target="#modal_delete"
            data-toggle="modal"  class="delete_action btn btn-danger btn-sm"
            type="button" onclick="delete_action({{$data->id}},'roles')">
        <i class="fas fa-trash-alt"></i>
    </button>
    <a class="btn btn-sm btn-info" href="{{route('roles.edit',$data->id)}}"><i class="fas fa-edit"></i></a>

</div>



