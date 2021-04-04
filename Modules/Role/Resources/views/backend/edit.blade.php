@extends('layouts/contentLayoutMaster')
@section('vendor-style')
{{-- Page Css files --}}
<link rel="stylesheet"
      href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet"
      href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('css/base/pages/app-user.css')) }}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
      rel="stylesheet">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css"
      rel="stylesheet">
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <div class="col-md-12">
            <form action="{{route('roles.update',$role->id)}}"
                  method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text"
                           value="{{$role->name}}"
                           name="name"
                           class="form-control">
                    <div class="mt-2">
                        @foreach($permissions as $permission)
                        <input type="checkbox"
                               class="toggle-dis sm"
                               @if(in_array($permission->name,
                        $role->permissions->pluck('name')->all())) checked
                        @endif
                        id="permission-{{$permission->id}}"
                        value="{{$permission->name}}"
                        name="permissions[]"
                        data-toggle="switchbutton"
                        data-onstyle="success"
                        data-offstyle="danger"
                        data-onlabel="Açık"
                        data-offlabel="kapalı"
                        data-width="100">

                        <label for="permission-{{$permission->id}}">{{$permission->name}}</label>
                        @endforeach
                    </div>
                </div>
                <button type="submit"
                        class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>
@endsection
@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js">
</script>
@endsection