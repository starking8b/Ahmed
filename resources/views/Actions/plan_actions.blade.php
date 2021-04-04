@if($func=='State')
<div >
    <button   id="editStateModalBtn"  class='btn btn-sm btn-success mt-1' data-toggle="tooltip"   title="Edit" state_name= "{{$data->state_name}}" state_id={{$data->id}} >
        <i class="icon-pencil text-info"></i>Edit
    </button>
    <button   class='btn btn-sm btn-danger mt-1 delete_state_btn'  id="delete_state_btn"data-toggle="tooltip"  state_id={{$data->id}}  title="Delete"><i class="ficon"  data-feather="clipboard"></i>Delete</button>
</div>

@elseif($func=='City')

    <div >
        <button   id="editCityModalBtn"  class='btn btn-sm btn-success mt-1  ' data-toggle="tooltip"   title="Edit" city_id={{$data->id}} city_name={{$data->city_name}} state_name={{$data->states->state_name}} state_id={{$data->states->id}} >
            <i class="icon-pencil text-info"></i>Edit
        </button>
        <button  class='btn btn-sm btn-danger mt-1 delete_city_btn'  id="delete_city_btn"data-toggle="tooltip" city_id={{$data->id}}  title="Delete"><i class="ficon"  data-feather="clipboard"></i>Delete</button>
    </div>
@elseif($func=='Thana')

    <div >
        <button   id="editThanaModalBtn"  class='btn btn-sm btn-success mt-1  ' data-toggle="tooltip"   title="Edit" thana_id={{$data->id}} city_name={{$data->cities->city_name}} thana_name={{$data->thana_name}}   >
            <i class="icon-pencil text-info"></i>Edit
        </button>
        <button  class='btn btn-sm btn-danger mt-1 delete_city_btn'  id="delete_thana_btn"data-toggle="tooltip" thana_id={{$data->id}}  title="Delete"><i class="ficon"  data-feather="clipboard"></i>Delete</button>
    </div>

@elseif($func=='Area')

    <div >
        <button   id="editAreaModalBtn"  class='btn btn-sm btn-success mt-1  ' data-toggle="tooltip"   title="Edit" area_id={{$data->id}} thana_name={{$data->thanas->thana_name}} area_name={{$data->area_name}}   >
            <i class="icon-pencil text-info"></i>Edit
        </button>
        <button  class='btn btn-sm btn-danger mt-1 delete_city_btn'  id="delete_area_btn"data-toggle="tooltip" area_id={{$data->id}}  title="Delete"><i class="ficon"  data-feather="clipboard"></i>Delete</button>
    </div>
    @endif

