@extends('layouts/contentLayoutMaster')
@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
@endsection
@section('title')
    permissions
@endsection
@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}">
@endsection

@section('content')
    <section class="app-user-list">
        <!-- users filter start -->
        <div class="card">
            <h5 class="card-header">Search Filter</h5>
            <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <!-- users filter end -->
        <!-- list section start -->
        <div class="card">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <button type="button" class="m-2 float-right btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modals-slide-in">New Permission
                    </button>
                    <div class="card-datatable table-responsive pt-0">
                        <table id="permission-datatable" class="permission-list-table table">
                            <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>Permission</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
            <!-- Modal to add new user starts-->

            <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                <div class="modal-dialog">
                    <form action="{{route('permissions.store')}}" method="post" class="add-new-user modal-content pt-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">New Permission</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input
                                    type="text"
                                    class="form-control dt-full-name"
                                    id="basic-icon-default-fullname"
                                    placeholder="New Permission"
                                    name="name"
                                    aria-label="John Doe"
                                    aria-describedby="basic-icon-default-fullname2"
                                />
                                <input
                                    type="hidden"
                                    class="form-control dt-full-name"
                                    id="guard_name"
                                    placeholder="New Permission"
                                    name="guard_name"
                                    value="web"
                                    aria-label="John Doe"
                                    aria-describedby="basic-icon-default-fullname2"
                                />
                            </div>
                            <button type="submit" class="btn btn-primary mr-1 data-submit">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
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
    <script src="{{ asset('js/scripts/permissions/permissions-list.js')}}"></script>
@endsection
