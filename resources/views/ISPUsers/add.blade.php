@extends('layouts/contentLayoutMaster')


@section('title', 'User List')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

  <style>
    .table_btn{border-radius: 5px;margin: 10px;}
    .multi-menu li{color:black}
  </style>

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset('Plugins/jquery-multi-select/css/multi.select.css') }}">

  <link rel="stylesheet" href="{{ asset('css/users.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}">
@endsection

@section('content')
  <!-- users list start -->
  <section class="app-user-list">
    <!-- users filter start -->
    <div class="card">
      <h5 class="card-header">Filters</h5>

<div class="row">

  <div class="col-3"><div class="form-group"> <label class="form-label" for="owner">Selected Columns</label><div class="multsi" id="multi"></div></div></div>
  <div class="col-3">
    <div class="form-group">
      <label class="form-label" for="owner">Owner</label>
      <select id="owner_search" name="owner_search" class="form-control">
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>


  </div>
</div>







    </div>
    <!-- users filter end -->
    <!-- list section start -->
    <div class="card">
      <div class="card-datatable table-responsive pt-0">

        <div id="context-menu">

          <ul class="dropdown-menu pull-left" role="menu">

            <li>

              <a href="javascript:;" style="color: #000000;"  id="context-copy" class="">

                <i  data-feather="clipboard" ></i><span><span  >copy</span></span>

              </a>

            </li>

            <li>

              <a href="javascript:;" style="color: #000000;" id="context-search">

                <i data-feather="search"></i><span><span  >search</span></span>

              </a>
            </li>

            <li>

              <a href="javascript:;"  style="color: #000000;"id="context-addfilter">

                <i data-feather="filter"></i><span><span data-lang="add_filter">add filter</span></span>

              </a>

            </li>

          </ul>

        </div>

        <div id="context-menu-light">

          <ul class="dropdown-menu pull-left" role="menu">

            <li>
              <a href="javascript:;"style="color: #000000;" id="context-paste">

                <i data-feather="copy"></i><span><span data-lang="paste">Past</span></span>

              </a>

            </li>

            <li>

              <a href="javascript:;" style="color: #000000;" id="context-pastesearch">

                <i data-feather="search"></i><span><span data-lang="paste_and_search">Past and search</span></span>

              </a>

            </li>

          </ul>

        </div>
        <div id="context-menu-details">

          <ul class="dropdown-menu pull-left" role="menu">

            <li>

              <a href="javascript:;" id="add-as-column">

                <i class="fa fa-plus"></i><span><span data-lang="">Add Column</span></span>

              </a>

            </li>

          </ul>

        </div>

        <div class="portlet-body">

          <div id="pageCounterWrap" style="float:right;">

            <div class="paging-wrapper">

              <div id="search">

                <div style="margin-top:8px; padding-right:10px; padding-left:10px;">
                  <ul class="pagination page1-links" id="pageCounter"></ul>

                </div>

              </div>

            </div>

          </div>

          <table class=" table table-bordered  " id="ispuser-table">
            <thead >

            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>



      <!-- Modal to add new user starts-->
      <div class="modal modal-slide-in new-user-modal fade modal-xl" id="modals-slide-in">
        <div class="modal-dialog modal-xl" style="width: 70%">
          <form class="add-new-user modal-content pt-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> ^w</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="exampleModalLabel">New User</h5>
            </div>
            <div class="modal-body flex-grow-1">
              <div class="form-group">
                <label class="form-label" for=" fullname">Full Name</label>
                <input
                        type="text"
                        class="form-control  full-name"
                        id=" fullname"
                        placeholder="John Doe"
                        name=" fullname"
                        aria-label="John Doe"
                        aria-describedby="basic-icon-default-fullname2"
                />
              </div>
              <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input
                        type="text"
                        id=" username"
                        class="form-control  "
                        placeholder="Web Developer"
                        aria-label="jdoe1"
                        aria-describedby="basic-icon-default-uname2"
                        name="username"
                />
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-uname">Password</label>
                <input
                        type="password"
                        id="password"
                        class="form-control "
                        placeholder="Password"
                        aria-label="password"
                        aria-describedby="password"
                        name="password"
                />
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-uname">Confirm Password</label>
                <input
                        type="password"
                        id="confirm-password"
                        name="confirm-password"
                        class="form-control  "
                        placeholder="Reenter Password"
                        aria-label="password"
                        aria-describedby="password"

                />
              </div>
              <div class="form-group">
                <label class="form-label" for=" email">Email</label>
                <input
                        type="text"
                        id=" email"
                        class="form-control "
                        placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com"
                        aria-describedby="basic-icon-default-email2"
                        name="email"
                />
                <small class="form-text text-muted"> You can use letters, numbers & periods </small>
              </div>
              <div class="form-group">
                <label class="form-label" for=phone">Phone</label>
                <input
                        type="text"
                        id="phone"
                        class="form-control phone"
                        placeholder="0533333333"
                        aria-label=" 0533333333"

                        name="phone"
                />

              </div>
              <div class="form-group">
                <label class="form-label" for="address">Address</label>
                <input
                        type="text"
                        id="address"
                        class="form-control  "
                        placeholder="Address"
                        aria-label=" Address"

                        name="address"
                />

              </div>
              <div class="form-group">
                <label class="form-label" for="owner">Owner</label>
                <select id="owner" name="owner" class="form-control">
                  @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group mb-2">
                <label class="form-label" for=" plan">Select Plan</label>
                <select id="plan" name="plan" class="form-control">
                  <option value="basic">Basic</option>
                  <option value="enterprise">Enterprise</option>
                  <option value="company">Company</option>
                  <option value="team">Team</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mr-1 data-submit">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
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


@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset( 'Plugins/metronic.js') }}"></script>
  <script src="{{ asset(mix('vendors/js/pagination/jquery.bootpag.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pagination/jquery.twbsPagination.min.js')) }}"></script>
  <script src="{{ asset( 'Plugins/bootstrap-contextmenu/bootstrap-contextmenu.js') }}"></script>
  <script src="{{ asset( 'Plugins/jquery-multi-select/js/jquery.multi-select.js') }}"></script>
  <script src="{{ asset( 'Plugins/jquery-multi-select/js/multi.select.js') }}"></script>


  <script  src="{{ asset('Plugins/clipboard/clipboard.js')}}"></script>
  <script src="{{ asset( 'js/scripts/ISPUSer/listuser.js') }}"></script>
  <script src="{{ asset('js/scripts/ISPUSer/app-user-list.js') }}"></script>

@endsection




