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
@section('title')
isp
@endsection
@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet"
      href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('css/base/pages/app-user.css')) }}">
@endsection

@section('content')
<section class="app-user-list">
  <!-- list section start -->
  <div class="card">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <a class="m-2 float-right btn btn-primary btn-sm" href="{{route('isp.create')}}">New isp</a>
        <div class="card-datatable table-responsive pt-0">
          <table id="isp-datatable"
                 class="isp-list-table table">
            <thead class="thead-light">
              <tr>
                <th>Id</th>
                <th>isp name</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
    <!-- Modal to add new user starts-->
    @include('common-views.delete-modal')
    <!-- Modal to add new user Ends-->
  </div>
  <!-- list section end -->
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
{{-- Page js files --}}
<script src="{{ asset('js/scripts/isp/isp-list.js')}}"></script>
@endsection