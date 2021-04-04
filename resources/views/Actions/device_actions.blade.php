
<div >
 <a   title="Delete" href="javascript:void(0)"  id="delete_plan" data-srvname= "{{$data->srvname}}"><span data-feather="trash-2"></span></a>
 <a href="javascript:void(0)" id="edit_plan" title="Edit" data-srvname= "{{$data->srvname}}" data-downrate= "{{$data->downrate}}" data-uprate= "{{$data->uprate}}" data-sim= "{{$data->sim_usage}}"data-tax= "{{$data->tax}}" data-taxincluded= "{{$data->tax_included}}" data-price= "{{$data->unitprice}}" data-quota= "{{$data->quota}}" data-status= "{{$data->status}}" data-users="{{$data->users()->pluck('users.id')->implode(';')}}"><span data-feather="edit"></span></a>
 <a href="javascript:void(0)"  title="Graph"><span data-feather="bar-chart"></span></a>


</div>
