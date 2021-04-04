
@extends('layouts/contentLayoutMaster')

@section('title', 'Add New User')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
  <link rel="stylesheet" href="{{ asset('Plugins/countries/mobiscroll.jquery.min.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

@endsection

@section('content')
  <!-- Horizontal Wizard -->
  <section class="horizontal-wizard">
    <div class="bs-stepper horizontal-wizard-example">
      <div class="bs-stepper-header">
        <div class="step" data-target="#account-details">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">1</span>
            <span class="bs-stepper-label">
            <span class="bs-stepper-title">Login Details</span>
            <span class="bs-stepper-subtitle">Setup Login Details</span>
          </span>
          </button>
        </div>
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" data-target="#personal-info">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">2</span>
            <span class="bs-stepper-label">
            <span class="bs-stepper-title">Personal Info</span>
            <span class="bs-stepper-subtitle">Add Personal Info</span>
          </span>
          </button>
        </div>
{{--        <div class="line">--}}
{{--          <i data-feather="chevron-right" class="font-medium-2"></i>--}}
{{--        </div>--}}
{{--        <div class="step" data-target="#address-step">--}}
{{--          <button type="button" class="step-trigger">--}}
{{--            <span class="bs-stepper-box">3</span>--}}
{{--            <span class="bs-stepper-label">--}}
{{--            <span class="bs-stepper-title">Location & Zone Details</span>--}}
{{--            <span class="bs-stepper-subtitle">Add Location & Zone Details</span>--}}
{{--          </span>--}}
{{--          </button>--}}
{{--        </div>--}}
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" data-target="#technical-step">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">4</span>
            <span class="bs-stepper-label">
            <span class="bs-stepper-title">Technical Details</span>
            <span class="bs-stepper-subtitle">Insert Technical Details</span>
          </span>
          </button>
        </div>
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" data-target="#social-links">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">5</span>
            <span class="bs-stepper-label">
            <span class="bs-stepper-title">Upload Documents</span>
            <span class="bs-stepper-subtitle">Upload Proof Documents</span>
          </span>
          </button>
        </div>

      </div>
      <div class="bs-stepper-content">
        <div id="account-details" class="content">
          <div class="content-header">
            <h5 class="mb-0">Account Details</h5>
            <small class="text-muted">Enter Your Account Details.</small>
          </div>
          <form>
            <div class="row">
              <div class="form-group col-md-12">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
              </div>

            </div>
            <div class="row">
              <div class="form-group form-password-toggle col-md-12">
                <label class="form-label" for="password">Password</label>
                <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                />
              </div>
              <div class="form-group form-password-toggle col-md-12">
                <label class="form-label" for="confirm-password">Confirm Password</label>
                <input
                        type="password"
                        name="confirm-password"
                        id="confirm-password"
                        class="form-control"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                />
              </div>
              <div class="form-group   col-md-12">
                <label class="form-label" for=" plan">Select Plan</label>
                <select id="plan" name="plan" class="form-control">
                  <option value="1">Basic</option>
                  <option value="2">Enterprise</option>
                  <option value="3">Company</option>
                  <option value="4">Team</option>
                </select>
              </div>
            </div>
          </form>
          <div class="d-flex justify-content-between">
            <button class="btn btn-outline-secondary btn-prev" disabled>
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>
        <div id="personal-info" class="content">
          <div class="content-header">
            <h5 class="mb-0">Personal Info</h5>
            <small>Enter Your Personal Info.</small>
          </div>
          <div class="row">
            <div class="col-md-6">
              <form>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label class="form-label" for="owner">Owner</label>
                    <select id="owner" name="owner" class="form-control">
                      @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>


                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="form-label" for="full-name">Full Name</label>
                    <input type="text" name="full-name" id="full-name" class="form-control" placeholder="John" />
                  </div>
                  <div class="form-group col-md-6">
                    <label class="form-label" for="phone">Mobile Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="xxx-xxx-xxxx" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            placeholder="john.doe@email.com"
                            aria-label="john.doe"
                    />
                  </div>

                  <div class="form-group col-md-6">
                    <label class="form-label" for="country">Country</label>
                    <select  class="form-control" id="country">
                      <option value="IN">India</option>
                      <option value="UK">United Kingdom</option>
                      <option value="USA">USA</option>

                    </select>
                    {{--                <input--}}
                    {{--                        type="text"--}}
                    {{--                        name="country"--}}
                    {{--                        id="country"--}}
                    {{--                        class="form-control"--}}
                    {{--                        placeholder="john.doe@email.com"--}}
                    {{--                        aria-label="Country"--}}
                    {{--                />--}}
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="form-label" for="landmark">PinCode</label>
                    <input type="text" name="pincode" id="pincode" class="form-control" placeholder="PinCode" />
                  </div>
                  <div class="form-group col-md-6">
                    <label class="form-label" for="country">State</label>
                    <input
                            type="text"
                            name="state"
                            id="state"
                            class="form-control"
                            placeholder="State"
                            aria-label="State"
                    />
                  </div>


                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="form-label" for="country">City</label>
                    <input
                            type="text"
                            name="city"
                            id="city"
                            class="form-control"
                            placeholder="City"
                            aria-label="city"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label class="form-label" for="address">Address</label>
                    <input
                            type="text"
                            id="address"
                            name="address"
                            class="form-control"
                            placeholder="98  Borough bridge Road, Birmingham"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="form-label" for="latitude">Latitude</label>
                    <input type="text" id="latitude" class="form-control" placeholder="658921" />
                  </div>
                  <div class="form-group col-md-6">
                    <label class="form-label" for="city1">Longitude</label>
                    <input type="text" id="longitude" class="form-control" placeholder="658921" />
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-12">

                    <div class="custom-control custom-switch custom-switch-success">
                      <p class="mb-50">Billing Address Same ?</p>
                      <input type="checkbox" class="custom-control-input" id="addressswitch"   />
                      <label class="custom-control-label" for="addressswitch">
                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                      </label>
                    </div>
                  </div>

                </div>
                <div class="row" id="addressdiv" style="display: none">
                  <div class="form-group col-md-6">
                    <label class="form-label" for="country">Country</label>
                    <input
                            type="text"
                            name="countrybill"
                            id="countrybill"
                            class="form-control"
                            placeholder="Country"
                            aria-label="Country"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label class="form-label" for="country">City</label>
                    <input
                            type="text"
                            name="citybill"
                            id="citybill"
                            class="form-control"
                            placeholder="City"
                            aria-label="city"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label class="form-label" for="address">Address</label>
                    <input
                            type="text"
                            id="addressbill"
                            name="addressbill"
                            class="form-control"
                            placeholder="98  Borough bridge Road, Birmingham"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label class="form-label" for="landmark">PinCode</label>
                    <input type="text" name="pincodebill" id="pincodebill" class="form-control" placeholder="PinCode" />
                  </div>

                </div>
              </form>
              <div class="d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none">Next</span>
                  <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                </button>
              </div>

            </div>
            <div class="col-md-6">
              <div id="map-canvas"  style=" height: 100%;
 margin: 0px;
      padding: 0px;position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>


            </div>

          </div>


        </div>

{{--        <div id="address-step" class="content">--}}
{{--          <div class="content-header">--}}
{{--            <h5 class="mb-0">Location & Zone Details </h5>--}}
{{--            <small>Enter Your Location.</small>--}}
{{--          </div>--}}
{{--          <form>--}}
{{--            <div class="row">--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="owner">Owner</label>--}}
{{--                <select id="owner" name="owner" class="form-control">--}}
{{--                  @foreach($users as $user)--}}
{{--                    <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                  @endforeach--}}
{{--                </select>--}}
{{--              </div>--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="area">State</label>--}}
{{--                <select id="select_state" name="select_state" class="form-control">--}}
{{--                  @foreach($states as $state)--}}
{{--                    <option value="{{$state->id}}">{{$state->state_name}}</option>--}}
{{--                  @endforeach--}}
{{--                </select>--}}
{{--              </div>--}}

{{--            </div>--}}
{{--            <div class="row">--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="area">City </label>--}}
{{--                <select id="select_city" name="select_city" class="form-control" disabled>--}}

{{--                </select>--}}
{{--              </div>--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="area">Thana</label>--}}
{{--                <select id="select_thana" name="select_thana" class="form-control" disabled>--}}

{{--                </select>--}}
{{--              </div>--}}


{{--            </div>--}}
{{--            <div class="row">--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="area">Area</label>--}}
{{--                <select id="select_area" name="select_area" class="form-control" disabled>--}}

{{--                </select>--}}
{{--              </div>--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="street">Street</label>--}}
{{--                <input type="text" id="street" class="form-control" placeholder="Street" />--}}
{{--              </div>--}}

{{--            </div>--}}
{{--            <div class="row">--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="building">Building</label>--}}
{{--                <input type="text" id="building" class="form-control" placeholder="Building" />--}}
{{--              </div>--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="street">pincode</label>--}}
{{--                <input type="text" id="loc_pincode" class="form-control" placeholder="Street" />--}}
{{--              </div>--}}


{{--            </div>--}}
{{--            <div class="row">--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="latitude">Latitude</label>--}}
{{--                <input type="text" id="latitude" class="form-control" placeholder="658921" />--}}
{{--              </div>--}}
{{--              <div class="form-group col-md-6">--}}
{{--                <label class="form-label" for="city1">Longitude</label>--}}
{{--                <input type="text" id="longitude" class="form-control" placeholder="658921" />--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </form>--}}
{{--          <div class="d-flex justify-content-between">--}}
{{--            <button class="btn btn-primary btn-prev">--}}
{{--              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>--}}
{{--              <span class="align-middle d-sm-inline-block d-none">Previous</span>--}}
{{--            </button>--}}
{{--            <button class="btn btn-primary btn-next">--}}
{{--              <span class="align-middle d-sm-inline-block d-none">Next</span>--}}
{{--              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>--}}
{{--            </button>--}}
{{--          </div>--}}
{{--        </div>--}}
        <div id="technical-step" class="content">
          <div class="content-header">
            <h5 class="mb-0">Technical Details </h5>
            <small>Enter Technical Details.</small>
          </div>
          <form>
            <div class="row">
              <div class="form-group col-md-12">

                <div class="custom-control custom-switch custom-switch-success">
                  <p class="mb-50">IP Auth?</p>
                  <input type="checkbox" class="custom-control-input" id="ipswitch"   />
                  <label class="custom-control-label" for="ipswitch">
                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                  </label>
                </div>
              </div>

            </div>
            <div class="row" id="ipdiv" style="display: none">
            <div class="form-group col-md-6">
              <label class="form-label" for="ipaddress">IP Address</label>
              <input type="text" name="ipaddress" id="ipaddress" class="form-control" placeholder="Ip Address" />
            </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="landmark">Mac Address</label>
                <input type="text" name="mac" id="mac" class="form-control" placeholder="Mac Address" />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-6">
                <label class="d-block">Notification Type</label>
                <div class="custom-control custom-radio my-50">
                  <input type="radio" id="validationsms" name="notification" class="custom-control-input" value="sms" aria-describedby="validationsms-error" aria-invalid="false">
                  <label class="custom-control-label" for="validationsms">SMS</label>
                </div>
                <div class="custom-control custom-radio my-50">
                  <input type="radio" id="validationwhatsapp" name="notification" class="custom-control-input" value="whatsapp" aria-describedby="validationwhatsapp-error" aria-invalid="false">
                  <label class="custom-control-label" for="validationwhatsapp">Whatsapp</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="validationemail" name="notification" class="custom-control-input" aria-invalid="false">
                  <label class="custom-control-label" for="validationemail">Email</label>
                </div><span id="validationemail-error" class="error" style="display: none;"></span>
              </div>
            </div>

            <div class="row" >
              <div class="form-group col-md-6">
                <label class="form-label" for="ipaddress">Comment</label>
                <input type="text" name="comment" id="comment" class="form-control" placeholder="Comment" />
              </div>

            </div>

          </form>
          <div class="d-flex justify-content-between">
            <button class="btn btn-primary btn-prev">
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>
        <div id="social-links" class="content">
          <div class="content-header">
            <h5 class="mb-0">Documentation Proof</h5>
            <small>Insert Documentation that required for Proof account.</small>
          </div>
          <form>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">ID Card </h4>
                  </div>
                  <div class="card-body">
                    <input type="hidden" name="_token"  id="_token"content="{{csrf_token()}}">
                    <div class="form-group" style="display: flex;">
                      <div class="col-md-8">
                        <label>Upload ID Card</label>
                        <div class="m-dropzone dropzone m-dropzone--success" enctype="multipart/form-data" action="/ISP/uploadIdImage/idcard " id="m-dropzone-idcard">
                          <div class="m-dropzone__msg dz-message needsclick">
                            <h4 class="m-dropzone__msg-title"  >
                              <span data-lang="drop_files_here_or_click_to_upload">Click here To Upload</span>
                            </h4>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="form-group" style="display: flex;">
                      <div class="col-md-8">
                        <label>Upload Adress Details</label>
                        <div class="m-dropzone dropzone m-dropzone--success" enctype="multipart/form-data" action="/ISP/uploadIdImage/address" id="m-dropzone-address">
                          <div class="m-dropzone__msg dz-message needsclick">
                            <h4 class="m-dropzone__msg-title"  >
                              <span data-lang="drop_files_here_or_click_to_upload">Click here To Upload</span>
                            </h4>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </form>
          <div class="d-flex justify-content-between">
            <button class="btn btn-primary btn-prev">
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-success btn-submit" id="User_Submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Horizontal Wizard -->

  <!-- Vertical Wizard -->

  <!-- /Vertical Wizard -->




  <!-- /Modern Vertical Wizard -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjLKh5z-ZA23e3jIBfbf5C6uhAhOD9zx4&sensor=false">
  </script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset( 'Plugins/countries/mobiscroll.jquery.min.js') }}"></script>
  <script src="{{ asset( 'js/scripts/ISPUSer/add.js') }}"></script>
<script>
  var remoteData = {
    url: 'https://trial.mobiscroll.com/content/countries.json',
    type: 'json'
  };
  $.each(remoteData,function(key, value)
  {
    $('#country').append('<option value=' + key + '>' + value + '</option>');
  });


</script>
  <script type="text/javascript">
    geocoder = new google.maps.Geocoder();
    var map;
    var myCenter = new google.maps.LatLng(51.508742, -0.120850);
    var marker;
    var infowindow;
    function initialize() {

      var mapProp = {
        center: myCenter,
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };

      map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);

      google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
      });

    }


    function placeMarker(location) {
      if (!marker || !marker.setPosition) {
        marker = new google.maps.Marker({
          position: location,
          map: map,
        });
        var icon = {
          url: "{{ asset("images/icons/user.png" )}}", // url
          scaledSize: new google.maps.Size(50, 50), // scaled size
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
        };
        marker.setIcon(icon);
      } else {
        marker.setPosition(location);
      }
      if (!!infowindow && !!infowindow.close) {
        infowindow.close();
      }
      infowindow = new google.maps.InfoWindow({

        content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()

      });
      $('#latitude').val(location.lat())
      $('#longitude').val(location.lng())
      var latlng = new google.maps.LatLng(location.lat(), location.lng());
      geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            $('#address').val( results[1].formatted_address)

          }
        }
      });


      infowindow.open(map, marker);
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    function geo(country,zip) {
      google.maps.event.addDomListener(window, 'load', initialize);

      geocoder.geocode({'address': zip,'country':country}, function (results, status) {
        console.log(results[0].formatted_address)


        if (status == google.maps.GeocoderStatus.OK) {
          //Got result, center the map and put it out there

          var indice = 0;


          for (var i = 0; i < results[0].address_components.length; i++) {
            if (results[0].address_components[i].types[0] == "locality") {
              //this is the object you are looking for City
              city = results[0].address_components[i];
            }
            if (results[0].address_components[i].types[0] == "administrative_area_level_1") {
              //this is the object you are looking for State
              state = results[0].address_components[i];
            }
            if (results[0].address_components[i].types[0] == "country") {
              //this is the object you are looking for
              country = results[0].address_components[i];
            }
          }

          //city data



          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
          });
$('#city').val(city.long_name)
$('#state').val(state.long_name)

        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
    }

    $('#country').on('change',function(){
      var country=$(this).val();
      var zip=$('#pincode').val()
      geo(country,zip)

    })
    $("#pincode").keyup(function(){
      var zip=$(this).val();
      var country=$('#country').val()
      geo(country,zip)
    });

  </script>


@endsection
