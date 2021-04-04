/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
  'use strict';
  var select = $('.select2');
  var csrf=$('#csrf').val();
  var dtDeviceTable = $('.device-list-table'),
      newDeviceSidebar = $('.new-device-modal'),
      newDeviceForm = $('.add-new-device'),

    statusObj = {
      1: { title: 'Pending', class: 'badge-light-warning' },
      2: { title: 'Active', class: 'badge-light-success' },
      3: { title: 'Inactive', class: 'badge-light-secondary' }
    };

  var assetPath = '../../../app-assets/',
    userView = 'app-user-view.html',
    userEdit = 'app-user-edit.html';
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'app/user/view';
    userEdit = assetPath + 'app/user/edit';
  }
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });



  function  initDeviceTable() {
    var table = dtDeviceTable.dataTable({
      processing: true,
      dom:
          '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
          '<"col-lg-12 col-xl-6" l>' +
          '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
          '>t' +
          '<"d-flex justify-content-between mx-2 row mb-1"' +
          '<"col-sm-12 col-md-6"i>' +
          '<"col-sm-12 col-md-6"p>' +
          '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..'
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: 'Add New Router',
          className: 'add-new btn btn-primary mt-50',
          attr: {
            id: 'add_modal',
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      ajax: '/Routers/NAS_list_get',
      columns: [
        {
          data: 'id',
          name: 'id',


        },
        {
          data: 'nasname',
          name: 'nasname',
          orderable: true,


        },
        {
          data: 'type',
          name: 'type',
          orderable: true,


        },
        {
          data: 'shortname',
          name: 'shortname',
          orderable: true,


        },
        {
          data: 'pingstatus',
          name: 'pingstatus',
          orderable: true,


        },
        {
          data: 'customers_count',
          name: 'customers_count',
          orderable: true,


        },


        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          width: "25%"
        }
      ],


      drawCallback: function( settings ) {
        feather.replace()
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }
  initDeviceTable()
  // Check Validity
  function checkValidity(el) {
    if (el.validate().checkForm()) {
      submitBtn.attr('disabled', false);
    } else {
      submitBtn.attr('disabled', true);
    }
  }

  // Form Validation
  if (newDeviceForm.length) {
    newDeviceForm.validate({
      errorClass: 'error',
      rules: {
        'device_name': {
          required: true,
          remote: {  // value of 'username' field is sent by default
            type: 'get',
            url: '/Routers/router_exists',
          }
        },
        'pincode': {
          required: true
        },
        'latitude': {
          required: true
        },
        'longitude': {
          required: true
        }

      }
    });

    newDeviceForm.on('submit', function (e) {
      var isValid = newDeviceForm.valid();
      var device_name = $('#device_name').val();
      var description = $('#description').val()
      var ip = $('#ip').val();
      var pincode = $('#pincode').val();
      var latitude = $('#latitude').val();
      var longitude = $('#longitude').val();

      var partner = $('#partner_select').val();
      var btn_status = $(this).data('status');

      e.preventDefault();
      if (isValid) {



          $.ajax({
            dataType: 'json',
            type: 'get',

            url: '/Routers/add',

            data: {
              device_name: device_name,
              description: description,
              ip: ip,
              pincode: pincode,
              longitude: longitude,
              partner: partner
            },
            contentType: 'application/json; charset=utf-8',
            success: OnSuccess,
            error: OnError
          })

          function OnSuccess(data) {

            if (data.success == 'true') {
              toastr["success"](data.msg);
              clearall()
              dtDeviceTable.DataTable().destroy();
              initDeviceTable()
            } else {

              toastr["error"]("ERROR ! Please Try Again Later");
            }

          }

          function OnError(data) {

            if (data.success == 'true') {
              toastr["success"](data.msg);
              clearall();
              dtDeviceTable.DataTable().destroy();
              initDeviceTable()
            } else {

              toastr["error"]("ERROR ! Please Try Again Later");
            }

          }
        }



    });
  }
  $('body').on('click', '#delete_plan', function () {
    var srvname=$(this).data('srvname')
    areyousure(srvname)


  });
  function delete_function(srvname) {
    Metronic.blockUI({
      target: dtDeviceTable,
      animate: false,
      boxed: true,
      message: "Loading"
    });

    $.ajax({
      url: "/Routers/delete",
      method: "post",
      headers: {
        'X-CSRF-TOKEN': csrf
      },
      data: {srvname: srvname},
      success: function (res) {
        console.log(res)
        console.log(res.success)
        if (res.success == "true") {
          toastr['success']('👋 '+ res.msg, 'Success!', {
            closeButton: true,
            tapToDismiss: false,

          });
          dtDeviceTable.DataTable().destroy();
          initPlanTable()
          Metronic.unblockUI(dtDeviceTable);
        } else {   Metronic.unblockUI(dtDeviceTable);
          toastr['error']('👋 ' + res.msg, 'Error!', {
            closeButton: true,
            tapToDismiss: false,

          });
        }
      },
      error: function (res) {
        Metronic.unblockUI(dtDeviceTable);
        toastr['error']('👋 Please Try Again Later.', 'Error!', {
          closeButton: true,
          tapToDismiss: false,

        });

      }
    });
  }
  function areyousure(srvname){

    Swal.fire({
      title: 'Are you sure? ',
      text: "All users who related to this plan will be remove!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ml-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        delete_function(srvname)
      }
      else
        return "false";
    });



  }
  $('body').on('click', '#add_modal', function () {

    newDeviceSidebar.modal('show')



  });
  $('body').on('click', '#edit_plan', function () {
    var quota=$(this).data('quota')
    var srvname=$(this).data('srvname')
    var downrate=$(this).data('downrate')
    var uprate=$(this).data('uprate')
    var sim_usage=$(this).data('sim')
    var status=$(this).data('status')
    var quota=$(this).data('quota')
    var tax=$(this).data('tax')
    var price=$(this).data('price')
    var tax_included=$(this).data('taxincluded')
    var users=$(this).data('users').toString();
    $('#plan_name').attr('disabled',true)
    $('#plan_name').val(srvname)
    $('#download').val(downrate)
    $('#upload').val(uprate)
    $('#quota').val(quota)
    $('#sim_usage').val(sim_usage)
    $('#tax_select').val(tax)
    $('#price').val(price)
    if(tax_included==1)
      $("#taxswich").attr("checked", true);
    else
      $("#taxswich").attr("checked", false);
    if(status==1)
      $("#statusswitch").attr("checked", true);
    else
      $("#statusswitch").attr("checked", false);
    var array = users.split(';');
    $('#partner_select').select2().val(array).trigger('change')
    $("#add_plan_btn").attr("status","edit");
    newDeviceSidebar.modal('show')
  });

function  clearall(){
 $('#plan_name').val('');
 $('#sim_usage').val('');
 $('#quota').val('');
 $('#download').val('');
 $('#upload').val('');
 $('#price').val('');



}
  // To initialize tooltip with body container
  $('body').tooltip({
    selector: '[data-toggle="tooltip"]',
    container: 'body'
  });
});
