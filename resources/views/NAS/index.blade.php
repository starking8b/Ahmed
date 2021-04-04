@extends('layouts/contentLayoutMaster')

@section('title', 'Plan List')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<style>

 .plan_form{
   border-color: #1976d2;
   background-color: #1976d2;
   color: #fff;
   min-width: 44px;
   width: auto;
 }
</style>
@endsection

@section('content')
<!-- users list start -->
<section class="app-user-list">
  <!-- users filter start -->

  <!-- users filter end -->
  <!-- list section start -->
  <div class="card">
    <input type="hidden" id="csrf" value="{{csrf_token() }}">
    <div class="card-datatable table-responsive pt-0">

      <table class="plan-list-table table">

        <thead class="thead-light">
          <tr>
            <th></th>
            <th>Name</th>
            <th>Price </th>
            <th>Download Speed(kbps)</th>
            <th>Upload Speed(kbps)</th>
            <th>Customers</th>

            <th>Action</th>
          </tr>
        </thead>
        <tbody>



        </tbody>
      </table>
    </div>
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-plan-modal fade" id="modals-slide-in">
      <div class="modal-dialog" style="width: 50%">
        <form class="add-new-plan modal-content pt-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Plan</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Plan Name</label>
              <input
                type="text"
                class="form-control "
                id="plan_name"
                placeholder="1Gb/Month"
                name="plan_name"
                aria-label="1Gb/Month"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>
            <div class="form-group col-md-12">

              <div class="custom-control custom-switch custom-switch-success">
                <p class="mb-50">Enabled</p>
                <input type="checkbox" class="custom-control-input" id="statusswitch"   />
                <label class="custom-control-label" for="statusswitch">
                  <span class="switch-icon-left"><i data-feather="check"></i></span>
                  <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Simultaneous Usage</label>
              <div class="input-group mb-2">


                <input type="text" class="form-control"  id="sim_usage" name="sim_usage" placeholder="Simultaneous Usage" aria-label="Simultaneous Usage" />

              </div>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Quota</label>
              <div class="input-group mb-2">

                <div class="input-group-prepend">
                  <span class="input-group-text plan_form">MB</span>
                </div>
                <input type="text" class="form-control" id="quota" name="quota" placeholder="100" aria-label="Speed(Download)" />

              </div>
            </div>



            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Speed(Download)</label>
              <div class="input-group mb-2">

                <div class="input-group-prepend">
                  <span class="input-group-text plan_form">Kbps</span>
                </div>
                <input type="text" class="form-control" id="download" name="download" placeholder="100" aria-label="Speed(Download)" />

              </div>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Speed(Upload)</label>
              <div class="input-group mb-2">

                <div class="input-group-prepend">
                  <span class="input-group-text plan_form">Kbps</span>
                </div>
                <input type="text" class="form-control" id="upload" name="upload" placeholder="100" aria-label="Speed(Upload)" />

              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Price</label>
              <div class="input-group mb-2">

                <div class="input-group-prepend">
                  <span class="input-group-text plan_form">INR</span>
                </div>
                <input type="text" class="form-control" name="price" id="price" placeholder="100" aria-label="Price" />

              </div>
            </div>
            <div class="form-group col-md-12">

              <div class="custom-control custom-switch custom-switch-success">
                <p class="mb-50">TAX included</p>
                <input type="checkbox" class="custom-control-input" id="taxswich"   />
                <label class="custom-control-label" for="taxswich">
                  <span class="switch-icon-left"><i data-feather="check"></i></span>
                  <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
              </div>
            </div>

              <div class="form-group">
                <label class="form-label" for="tax_select">Tax</label>

                <select class="select2 form-control" id="tax_select" name="tax_select">

                    <option value="20">20%</option>
                    <option value="30">30%</option>


                </select>
              </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Partner</label>

              <select class="select2 form-control  "  multiple="multiple"  id="partner_select" name="partner_select">

               @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach


              </select>
            </div>
            </div>




            <button type="submit" id="add_plan_btn" status='add' class="btn btn-primary mr-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>

        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->
  </div>
  <!-- list section end -->
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script
@endsection

@section('page-script')
  {{-- Page js files --}}

  <script src="{{ asset('js/scripts/Plans/plan-list.js') }}"></script>

@endsection
