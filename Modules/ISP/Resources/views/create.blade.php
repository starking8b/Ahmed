@extends('layouts/contentLayoutMaster')
@section('title')
create isp
@endsection
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet"
      href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
<!-- Page css files -->
<link rel="stylesheet"
      href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
<link rel="stylesheet"
      href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Horizontal Wizard -->
<section class="horizontal-wizard">
    <div class="bs-stepper horizontal-wizard-example">
        <div class="bs-stepper-header">
            <div class="step"
                 data-target="#isp-details">
                <button type="button"
                        class="step-trigger">
                    <span class="bs-stepper-box">1</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">isp Details</span>
                        <span class="bs-stepper-subtitle">Setup isp Details</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right"
                   class="font-medium-2"></i>
            </div>

            <div class="step"
                 data-target="#address-step">
                <button type="button"
                        class="step-trigger">
                    <span class="bs-stepper-box">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Contact</span>
                        <span class="bs-stepper-subtitle">Add Contact info</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right"
                   class="font-medium-2"></i>
            </div>
            <div class="step"
                 data-target="#social-links">
                <button type="button"
                        class="step-trigger">
                    <span class="bs-stepper-box">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Social Links</span>
                        <span class="bs-stepper-subtitle">Add Social Links</span>
                    </span>
                </button>
            </div>
        </div>
        <form action="{{route('isp.store')}}"
              method="post"
              enctype="multipart/form-data">
 
            @csrf
            <div class="bs-stepper-content">

                <div id="isp-details"
                     class="content">
 
               

                    <div class="row">
                        <div class="form-group form-logo-toggle col-md-6">
                            <label class="form-label"
                                   for="logo">logo</label>
                            <input type="file"
                                   name="logo"
                     
                                   id="logo"
                                   class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="name">name</label>
                            <input type="text"
                                   name="name"
                   
                                   id="name"
                                   class="form-control"
                                   placeholder="name" />
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="about">about isp</label>

                            <div class="form-label-group mb-0">
                                <textarea data-length="20"
                                          class="form-control char-textarea"
                                          id="textarea-counter"
                                          rows="3"
                                          name="about"></textarea>

                            </div>
                            <small class="textarea-counter-value float-right"><span class="char-count">0</span> / 20
                            </small>

                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a class="btn btn-outline-secondary btn-prev"
                           disabled>
                            <i data-feather="arrow-left"
                               class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </a>
                        <a class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                            <i data-feather="arrow-right"
                               class="align-middle ml-sm-25 ml-0"></i>
                        </a>
                    </div>
                </div>

                <div id="address-step"
                     class="content">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="address">Address</label>
                            <input type="text"
                                    
                                   id="address"
                                   name="address"
                                   class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="landmark">phone</label>
                            <input  
                                   type="text"
                                   name="phone"
                                   id="phone"
                                   class="form-control"
                                   placeholder="Borough bridge" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="mobile">mobile</label>
                            <input type="text"
                                   name="mobile"
                        
                                   id="mobile"
                                   class="form-control"
                                   placeholder="658921" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="email">email</label>
                            <input type="text"
                                   name="email"
                                   id="email"
                   
                                   class="form-control"
                                   placeholder="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="map_location">map_location</label>
                            <input type="text"
                                   name="map_location"
                      
                                   id="map_location"
                                   class="form-control"
                                   placeholder="658921" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="fax">fax</label>
                            <input type="text"
                                   id="fax"
                                   name="fax"
                   
                                   class="form-control"
                                   placeholder="fax" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary btn-prev">
                            <i data-feather="arrow-left"
                               class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </a>
                        <a class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                            <i data-feather="arrow-right"
                               class="align-middle ml-sm-25 ml-0"></i>
                        </a>
                    </div>
                </div>

                <div id="social-links"
                     class="content">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="twitter">Instagram</label>
                            <input type="text"
                               
                                   id="instagram_url"
                                   name="instagram_url"
                                   class="form-control"
                                   placeholder="https://twitter.com/abc" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="facebook">Facebook</label>
                            <input type="text"
                             
                                   id="facebook_url"
                                   name="facebook_url"
                                   class="form-control"
                                   placeholder="https://facebook.com/abc" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label"
                                   for="linkedin">Linkedin</label>
                            <input type="text"
                             
                                   id="linkedin_url"
                                   name="linkedin_url"
                                   class="form-control"
                                   placeholder="https://linkedin.com/abc" />
                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary btn-prev">
                            <i data-feather="arrow-left"
                               class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </a>
                        <button class="btn btn-success btn-submit">Submit</button>
                    </div>
                </div>
        </form>
    </div>

    </div>
</section>
<!-- /Horizontal Wizard -->

@endsection
@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset('js/scripts/isp/isp-update.js')}}"></script>
@endsection