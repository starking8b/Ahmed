
var EditUser=function(){
    var csrf=$('#_token').attr('content');
    Dropzone.autoDiscover = false;
    var handleDropzone = function () {



        var myDropzoneOptions = {
            maxFilesize: 1,
            acceptedFiles: '.png,.jpeg',
            addRemoveLinks: true,
            clickable: true,
            headers: {
                'X-CSRF-TOKEN': $('#_token').attr('content')

            }
        };
        var myDropzone = new Dropzone('#m-dropzone-idcard', myDropzoneOptions);
        var ADressDropzone = new Dropzone('#m-dropzone-address', myDropzoneOptions);


        myDropzone.on('success', function (file) {

        });



    }
    var handleCheckbox=function(){
        $("#ipswitch").on('change', function() {
            if ($(this).is(':checked')) {
                $('#ipdiv').show()
               // To verify
                $("#ipaddress").rules("add", {
                    required: true
                });
                $("#mac").rules("add", {
                    required: true
                });
            }
            else {
                $('#ipdiv').hide()
                $("#ipaddress").rules('remove');
                $("#mac")  .rules('remove');
            }
        });
        $("#addressswitch").on('change', function() {
            if ($(this).is(':checked')) {
                $('#addressdiv').show()
                // To verify
                $("#addressbill").rules("add", {
                    required: true
                });
                $("#countrybill").rules("add", {
                    required: true
                });
                $("#pincodebill").rules("add", {
                    required: true
                });
                $("#citybill").rules("add", {
                    required: true
                });
            }
            else {
                $('#addressdiv').hide()
                $("#addressbill").rules('remove');
                $("#countrybill")  .rules('remove');
                $("#pincodebill")  .rules('remove');
                $("#city")  .rules('remove');
            }
        });


  }


  var handleInsertUser= function(){











  }

  var handleLocationchange=function(){
      $('#select_state').on('change', function () {
          var state_id = $(this).val();
          var ownerId = $('#owner').val();
          $.ajax({
              url: "/Location/get_city_by_state",
              type: 'POST',
              dataType: 'json',
              headers: {
                  'X-CSRF-TOKEN':csrf
              },
              data: {
                  'stateid': state_id,
                  'ownerId': ownerId,

              },
              success: function (res) {
                  var select = $('#select_city');
                  select.find('option').remove();
                  if (res.length > 0) {
                      select.attr('disabled', false);
                      select.append('<option value="">Select City </option>'); // return empty
                      $.each(res, function (k, v) {
                          select.append('<option value=' + v.id + '>' + v.city_name + '</option>'); // return empty
                      });
                  } else {
                      select.attr('disabled', true);
                      select.append('<option value="">Select City</option>'); // return empty
                  }
              }
          });
      });

      $('#select_city').on('change', function () {
          var city_id = $(this).val();
          var ownerId = $('#owner').val();
          $.ajax({
              url: "/Location/get_thana_by_city",
              type: 'POST',
              dataType: 'json',
              headers: {
                  'X-CSRF-TOKEN':csrf
              },
              data: {
                  'cityId': city_id,
                  'ownerId': ownerId,

              },
              success: function (res) {
                  var select = $('#select_thana');
                  select.find('option').remove();
                  if (res.length > 0) {
                      select.attr('disabled', false);
                      select.append('<option value="">Select Thana </option>'); // return empty
                      $.each(res, function (k, v) {
                          select.append('<option value=' + v.id + '>' + v.thana_name + '</option>'); // return empty
                      });
                  } else {
                      select.attr('disabled', true);
                      select.append('<option value="">Select Thana</option>'); // return empty
                  }
              }
          });
      });
      $('#select_thana').on('change', function () {
          var thana_id = $(this).val();
          var ownerId = $('#owner').val();

          $.ajax({
              url: "/Location/get_area_by_thana",
              type: 'POST',
              headers: {
                  'X-CSRF-TOKEN':csrf
              },
              dataType: 'json',
              data: {
                  'thanaId': thana_id,
                  'ownerId': ownerId,

              },
              success: function (res) {
                  var select = $('#select_area');
                  select.find('option').remove();
                  if (res.length > 0) {
                      select.attr('disabled', false);
                      select.append('<option value="">Select Area </option>'); // return empty
                      $.each(res, function (k, v) {
                          select.append('<option value=' + v.id + '>' + v.area_name + '</option>'); // return empty
                      });
                  } else {
                      select.attr('disabled', true);
                      select.append('<option value="">Select Area</option>'); // return empty
                  }
              }
          });
      });

  }
var handleWizard=function(){
    'use strict';

    var bsStepper = document.querySelectorAll('.bs-stepper'),
        select = $('.select2'),
        horizontalWizard = document.querySelector('.horizontal-wizard-example');

    // Adds crossed class
    if (typeof bsStepper !== undefined && bsStepper !== null) {
        for (var el = 0; el < bsStepper.length; ++el) {
            bsStepper[el].addEventListener('show.bs-stepper', function (event) {
                var index = event.detail.indexStep;
                var numberOfSteps = $(event.target).find('.step').length - 1;
                var line = $(event.target).find('.step');

                // The first for loop is for increasing the steps,
                // the second is for turning them off when going back
                // and the third with the if statement because the last line
                // can't seem to turn off when I press the first item. ¯\_(ツ)_/¯

                for (var i = 0; i < index; i++) {
                    line[i].classList.add('crossed');

                    for (var j = index; j < numberOfSteps; j++) {
                        line[j].classList.remove('crossed');
                    }
                }
                if (event.detail.to == 0) {
                    for (var k = index; k < numberOfSteps; k++) {
                        line[k].classList.remove('crossed');
                    }
                    line[0].classList.remove('crossed');
                }
            });
        }
    }




        var numberedStepper = new Stepper(horizontalWizard),
            $form = $(horizontalWizard).find('form');
        $form.each(function () {
            var $this = $(this);
            $this.validate({
                rules: {

                    email: {
                        required: true
                    },

                    'full-name': {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    pincode: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    landmark: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    language: {
                        required: true
                    },
                    twitter: {
                        required: true,
                        url: true
                    },
                    facebook: {
                        required: true,
                        url: true
                    },
                    google: {
                        required: true,
                        url: true
                    },
                    linkedin: {
                        required: true,
                        url: true
                    }
                }
            });
        });

        $(horizontalWizard)
            .find('.btn-next')
            .each(function () {
                $(this).on('click', function (e) {
                    var isValid = $(this).parent().siblings('form').valid();
                    if (isValid) {
                        numberedStepper.next();
                    } else {
                        e.preventDefault();
                    }
                });
            });

        $(horizontalWizard)
            .find('.btn-prev')
            .on('click', function () {
                numberedStepper.previous();
            });

        $(horizontalWizard)
            .find('.btn-submit')
            .on('click', function () {
                var username=$('#username').val();

                var plan=$('#plan').val();
                var full_name=$('#full-name').val()
                var email=$('#email').val();
                var country=$('#country').val();
                var city=$('#city').val();
                var state=$('#state').val();
                var address=$('#address').val();
                var pincode=$('#pincode').val();
                var phone=$('#phone').val();
                var addressswitch=$('#addressswitch').is(':checked');
                var countrybill=$('#countrybill').val();
                var citybill=$('#citybill').val();
                var addressbill=$('#addressbill').val();
                var pincodebill=$('#pincodebill').val();
                var owner=$('#owner').val();
                var area=$('#area').val();
                var street=$('#street').val();
                var building=$('#building').val();
                var latitude=$('#latitude').val();
                var longitude=$('#longitude').val();
                var ipswitch=$('#ipswitch').is(':checked');;
                var ipaddress=$('#ipaddress').val();
                var mac=$('#mac').val();
                var notification=$('#notification').val();
                var comment=$('#comment').val();

                var isValid = $(this).parent().siblings('form').valid();


                if (isValid) {


                    $.ajax({
                        dataType:'json',
                        type: 'get',

                        url:'/ISP/users/edit'   ,

                        data:  {username:username,plan:plan,full_name:full_name,email:email,country:country,city:city,address:address,pincode:pincode,
                            addressswitch:addressswitch,countrybill:countrybill,citybill:citybill,addressbill:addressbill,pincodebill:pincodebill,owner:owner,are:area,
                            street:street,building:building,latitude:latitude,longitude:longitude,ipswitch:ipswitch,ipaddress:ipaddress,mac:mac,notification:notification,comment:comment,state:state} ,
                        contentType: 'application/json; charset=utf-8',
                        success: OnSuccess,
                        error:OnError
                    })

                    function OnSuccess(data) {

                        if(data.success=='true')
                        { toastr["success"]( " User has been Saved Successfully ");
                        }
                        else{

                            toastr["error"]("ERROR ! Please Try Again Later");
                        }

                    }
                    function OnError(data) {

                        if(data.success=='true')
                        { toastr["success"]( " User has been Saved Successfully ");
                        }
                        else{

                            toastr["error"]("ERROR ! Please Try Again Later");
                        }

                    }
                }
            });



    // Modern Wizard
    // --------------------------------------------------------------------






}




    return {

        init: function () {
            handleCheckbox();
            handleDropzone()
            handleWizard()
            handleLocationchange()
        }

    }



}();

jQuery(document).ready(function () {
    EditUser.init(); // init metronic core componets
});
