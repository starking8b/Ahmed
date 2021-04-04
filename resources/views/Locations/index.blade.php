@extends('layouts/contentLayoutMaster')

@section('title', 'Location Management')
@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection


@section('content')
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row">
            <input type="hidden" id="csrf" value="{{csrf_token() }}">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header border-bottom">

                            <div class="col-9">
                                <h2>State List</h2>
                            </div>
                            <div class="col-3">
                                <a href="#createStateModalbtn" id="createStateModalbtn"  >
                                    <button class=" btn btn-success pull-right"> Add State</button>
                                </a>
                            </div>

                    </div>
                    <div class="card-datatable">
                        <table class="datatables-ajax table datatable" id="statetable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>State Name</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header border-bottom">

                        <div class="col-9">
                            <h2>City List</h2>
                        </div>
                        <div class="col-3">
                            <a href="#createCityModalbtn" id="createCityModalbtn"  >
                                <button class=" btn btn-success pull-right"> Add City</button>
                            </a>
                        </div>

                    </div>
                    <div class="card-datatable">
                        <table class="datatables-ajax table datatable" id="citytable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>City Name</th>
                                <th>State</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->

    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header border-bottom">

                        <div class="col-9">
                            <h2>Thana List</h2>
                        </div>
                        <div class="col-3">
                            <a href="#createThanaModalbtn" id="createThanaModalbtn"  >
                                <button class=" btn btn-success pull-right"> Add Thana</button>
                            </a>
                        </div>

                    </div>
                    <div class="card-datatable">
                        <table class="datatables-ajax table datatable" id="thanatable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Thana Name</th>
                                <th>City</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header border-bottom">

                        <div class="col-9">
                            <h2>Area List</h2>
                        </div>
                        <div class="col-3">
                            <a href="#createAreaModalbtn" id="createAreaModalbtn"  >
                                <button class=" btn btn-success pull-right"> Add Area</button>
                            </a>
                        </div>

                    </div>
                    <div class="card-datatable">
                        <table class="datatables-ajax table datatable" id="areatable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Area Name</th>
                                <th>Thana</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- State Modal Start -->
    <div class="modal fade" id="StateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Edit State</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="state" class="control-label">State: </label>
                            <input type="text" id="editStateShow" name="state_name" value="" class="form-control"
                                   placeholder="Enter State Name">
                            <input type="hidden" id="editStateIdShow" name="state_id" value="" class="form-control">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="submit" id="edit_state_btn" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" name="submit" id="create_state" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit State Modal  Finish --->
<!--- City  Modal -------->
    <div class="modal fade" id="CityModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="cityModalLabel">Edit City</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="state" class="control-label">City: </label>
                            <input type="text" id="city_name" name="city_name" value="" class="form-control"
                                   placeholder="Enter City  Name">
                            <input type="hidden" id="city_id" name="city_id" value="" class="form-control">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="state" class="control-label">State: </label>
                            <select id="select_state" name="select_state" class="form-control">
                             @foreach($stateShow as $state)
                             <option value="{{$state->id}}">{{$state->state_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="submit" id="edit_city_btn" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" name="submit" id="create_city" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

<!---End Create State ---------------->
<!---Thana Modal ------------------>
    <div class="modal fade" id="ThanaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="thanaModalLabel">Edit Thana</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="state" class="control-label">Thana: </label>
                            <input type="text" id="thana_name" name="thana_name" value="" class="form-control"
                                   placeholder="Enter Thana  Name">
                            <input type="hidden" id="thana_id" name="thana_id" value="" class="form-control">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="state" class="control-label">City: </label>
                            <select id="select_city" name="select_city" class="form-control">
                                @foreach($cityShow as $city)
                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="submit" id="edit_thana_btn" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" name="submit" id="create_thana" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
<!------------------------AreaModal ------------------->
    <div class="modal fade" id="AreaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="areaModalLabel">Edit Area</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="state" class="control-label">Thana: </label>
                            <input type="text" id="area_name" name="area_name" value="" class="form-control"
                                   placeholder="Enter Area  Name">
                            <input type="hidden" id="area_id" name="area_id" value="" class="form-control">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="state" class="control-label">Thana: </label>
                            <select id="select_thana" name="select_thana" class="form-control">
                                @foreach($thanaShow as $thana)
                                    <option value="{{$thana->id}}">{{$thana->thana_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="submit" id="edit_area_btn" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" name="submit" id="create_area" class="btn btn-primary"  style="display: none">
                        Save
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>








    <!------End Area Modal ------------>
    <!-- Basic multiple Column Form section start -->

    <!-- Basic Floating Label Form section end -->
@endsection
@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset('js/scripts/Locations/script.js') }}"></script>

@endsection


