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
  var dtPlanTable = $('.plan-list-table'),
      newPlanSidebar = $('.new-plan-modal'),
      newPlanForm = $('.add-new-plan'),

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
  // Users List datatable
  // if (dtPlanTable.length) {
  //   dtPlanTable.DataTable({
  //     ajax: assetPath + 'data/user-list.json', // JSON file to add data
  //     columns: [
  //       // columns according to JSON
  //       { data: 'responsive_id' },
  //       { data: 'full_name' },
  //       { data: 'email' },
  //       { data: 'role' },
  //       { data: 'current_plan' },
  //       { data: 'status' },
  //       { data: '' }
  //     ],
  //     columnDefs: [
  //       {
  //         // For Responsive
  //         className: 'control',
  //         orderable: false,
  //         responsivePriority: 2,
  //         targets: 0
  //       },
  //       {
  //         // User full name and username
  //         targets: 1,
  //         responsivePriority: 4,
  //         render: function (data, type, full, meta) {
  //           var $name = full['full_name'],
  //             $uname = full['username'],
  //             $image = full['avatar'];
  //           if ($image) {
  //             // For Avatar image
  //             var $output =
  //               '<img src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" height="32" width="32">';
  //           } else {
  //             // For Avatar badge
  //             var stateNum = Math.floor(Math.random() * 6) + 1;
  //             var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
  //             var $state = states[stateNum],
  //               $name = full['full_name'],
  //               $initials = $name.match(/\b\w/g) || [];
  //             $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
  //             $output = '<span class="avatar-content">' + $initials + '</span>';
  //           }
  //           var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
  //           // Creates full output for row
  //           var $row_output =
  //             '<div class="d-flex justify-content-left align-items-center">' +
  //             '<div class="avatar-wrapper">' +
  //             '<div class="avatar ' +
  //             colorClass +
  //             ' mr-1">' +
  //             $output +
  //             '</div>' +
  //             '</div>' +
  //             '<div class="d-flex flex-column">' +
  //             '<a href="' +
  //             userView +
  //             '" class="user_name text-truncate"><span class="font-weight-bold">' +
  //             $name +
  //             '</span></a>' +
  //             '<small class="emp_post text-muted">@' +
  //             $uname +
  //             '</small>' +
  //             '</div>' +
  //             '</div>';
  //           return $row_output;
  //         }
  //       },
  //       {
  //         // User Role
  //         targets: 3,
  //         render: function (data, type, full, meta) {
  //           var $role = full['role'];
  //           var roleBadgeObj = {
  //             Subscriber: feather.icons['user'].toSvg({ class: 'font-medium-3 text-primary mr-50' }),
  //             Author: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning mr-50' }),
  //             Maintainer: feather.icons['database'].toSvg({ class: 'font-medium-3 text-success mr-50' }),
  //             Editor: feather.icons['edit-2'].toSvg({ class: 'font-medium-3 text-info mr-50' }),
  //             Admin: feather.icons['slack'].toSvg({ class: 'font-medium-3 text-danger mr-50' })
  //           };
  //           return "<span class='text-truncate align-middle'>" + roleBadgeObj[$role] + $role + '</span>';
  //         }
  //       },
  //       {
  //         // User Status
  //         targets: 5,
  //         render: function (data, type, full, meta) {
  //           var $status = full['status'];
  //
  //           return (
  //             '<span class="badge badge-pill ' +
  //             statusObj[$status].class +
  //             '" text-capitalized>' +
  //             statusObj[$status].title +
  //             '</span>'
  //           );
  //         }
  //       },
  //       {
  //         // Actions
  //         targets: -1,
  //         title: 'Actions',
  //         orderable: false,
  //         render: function (data, type, full, meta) {
  //           return (
  //             '<div class="btn-group">' +
  //             '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
  //             feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
  //             '</a>' +
  //             '<div class="dropdown-menu dropdown-menu-right">' +
  //             '<a href="' +
  //             userView +
  //             '" class="dropdown-item">' +
  //             feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) +
  //             'Details</a>' +
  //             '<a href="' +
  //             userEdit +
  //             '" class="dropdown-item">' +
  //             feather.icons['archive'].toSvg({ class: 'font-small-4 mr-50' }) +
  //             'Edit</a>' +
  //             '<a href="javascript:;" class="dropdown-item delete-record">' +
  //             feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
  //             'Delete</a></div>' +
  //             '</div>' +
  //             '</div>'
  //           );
  //         }
  //       }
  //     ],
  //     order: [[2, 'desc']],
  //     dom:
  //       '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
  //       '<"col-lg-12 col-xl-6" l>' +
  //       '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
  //       '>t' +
  //       '<"d-flex justify-content-between mx-2 row mb-1"' +
  //       '<"col-sm-12 col-md-6"i>' +
  //       '<"col-sm-12 col-md-6"p>' +
  //       '>',
  //     language: {
  //       sLengthMenu: 'Show _MENU_',
  //       search: 'Search',
  //       searchPlaceholder: 'Search..'
  //     },
  //     // Buttons with Dropdown
  //     buttons: [
  //       {
  //         text: 'Add New Plan',
  //         className: 'add-new btn btn-primary mt-50',
  //         attr: {
  //           'data-toggle': 'modal',
  //           'data-target': '#modals-slide-in'
  //         },
  //         init: function (api, node, config) {
  //           $(node).removeClass('btn-secondary');
  //         }
  //       }
  //     ],
  //     // For responsive popup
  //     responsive: {
  //       details: {
  //         display: $.fn.dataTable.Responsive.display.modal({
  //           header: function (row) {
  //             var data = row.data();
  //             return 'Details of ' + data['full_name'];
  //           }
  //         }),
  //         type: 'column',
  //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
  //           tableClass: 'table',
  //           columnDefs: [
  //             {
  //               targets: 2,
  //               visible: false
  //             },
  //             {
  //               targets: 3,
  //               visible: false
  //             }
  //           ]
  //         })
  //       }
  //     },
  //     language: {
  //       paginate: {
  //         // remove previous & next text from pagination
  //         previous: '&nbsp;',
  //         next: '&nbsp;'
  //       }
  //     },
  //     initComplete: function () {
  //       // Adding role filter once table initialized
  //       this.api()
  //         .columns(3)
  //         .every(function () {
  //           var column = this;
  //           var select = $(
  //             '<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Select Role </option></select>'
  //           )
  //             .appendTo('.user_role')
  //             .on('change', function () {
  //               var val = $.fn.dataTable.util.escapeRegex($(this).val());
  //               column.search(val ? '^' + val + '$' : '', true, false).draw();
  //             });
  //
  //           column
  //             .data()
  //             .unique()
  //             .sort()
  //             .each(function (d, j) {
  //               select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
  //             });
  //         });
  //       // Adding plan filter once table initialized
  //       this.api()
  //         .columns(4)
  //         .every(function () {
  //           var column = this;
  //           var select = $(
  //             '<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Select Plan </option></select>'
  //           )
  //             .appendTo('.user_plan')
  //             .on('change', function () {
  //               var val = $.fn.dataTable.util.escapeRegex($(this).val());
  //               column.search(val ? '^' + val + '$' : '', true, false).draw();
  //             });
  //
  //           column
  //             .data()
  //             .unique()
  //             .sort()
  //             .each(function (d, j) {
  //               select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
  //             });
  //         });
  //       // Adding status filter once table initialized
  //       this.api()
  //         .columns(5)
  //         .every(function () {
  //           var column = this;
  //           var select = $(
  //             '<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx"><option value=""> Select Status </option></select>'
  //           )
  //             .appendTo('.user_status')
  //             .on('change', function () {
  //               var val = $.fn.dataTable.util.escapeRegex($(this).val());
  //               column.search(val ? '^' + val + '$' : '', true, false).draw();
  //             });
  //
  //           column
  //             .data()
  //             .unique()
  //             .sort()
  //             .each(function (d, j) {
  //               select.append(
  //                 '<option value="' +
  //                   statusObj[d].title +
  //                   '" class="text-capitalize">' +
  //                   statusObj[d].title +
  //                   '</option>'
  //               );
  //             });
  //         });
  //     }
  //   });
  // }


  function  initPlanTable() {
    var table = dtPlanTable.dataTable({
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
          text: 'Add New Plan',
          className: 'add-new btn btn-primary mt-50',
          attr: {
            id: 'add_modal',
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      ajax: '/Plans/plan_list_get',
      columns: [
        {
          data: 'id',
          name: 'id',


        },
        {
          data: 'srvname',
          name: 'srvname',
          orderable: true,


        },
        {
          data: 'unitprice',
          name: 'unitprice',
          orderable: true,


        },
        {
          data: 'downrate',
          name: 'downrate',
          orderable: true,


        },
        {
          data: 'uprate',
          name: 'uprate',
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
  initPlanTable()
  // Check Validity
  function checkValidity(el) {
    if (el.validate().checkForm()) {
      submitBtn.attr('disabled', false);
    } else {
      submitBtn.attr('disabled', true);
    }
  }

  // Form Validation
  if (newPlanForm.length) {
    newPlanForm.validate({
      errorClass: 'error',
      rules: {
        'plan_name': {
          required: true
        },
        'price': {
          required: true
        }

      }
    });

    newPlanForm.on('submit', function (e) {
      var isValid = newPlanForm.valid();
      var plan_name = $('#plan_name').val();
      var status = $('#statusswitch').is(':checked')
      var sim_usage = $('#sim_usage').val();
      var quota = $('#quota').val();
      var download = $('#download').val();
      var upload = $('#upload').val();
      var price = $('#price').val();
      var tax = $('#tax_select').val();
      var tax_included = $('#taxswich').is(':checked');
      var partner = $('#partner_select').val();
      var btn_status = $('#add_plan_btn').attr('status');
alert(btn_status)
      e.preventDefault();
      if (isValid) {
      if (btn_status == 'add'){


          $.ajax({
            dataType: 'json',
            type: 'get',

            url: '/Plans/add',

            data: {
              plan_name: plan_name,
              status: status,
              sim_usage: sim_usage,
              quota: quota,
              download: download,
              upload: upload,
              price: price,
              tax: tax,
              tax_included: tax_included,
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
              dtPlanTable.DataTable().destroy();
              initPlanTable()
            } else {

              toastr["error"]("ERROR ! Please Try Again Later");
            }

          }

          function OnError(data) {

            if (data.success == 'true') {
              toastr["success"](data.msg);
              clearall();
              dtPlanTable.DataTable().destroy();
              initPlanTable()
            } else {

              toastr["error"]("ERROR ! Please Try Again Later");
            }

          }
        }
    }
       if (btn_status == 'edit'){


        $.ajax({
          dataType: 'json',
          type: 'get',

          url: '/Plans/edit',

          data: {
            plan_name: plan_name,
            status: status,
            sim_usage: sim_usage,
            quota: quota,
            download: download,
            upload: upload,
            price: price,
            tax: tax,
            tax_included: tax_included,
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
            dtPlanTable.DataTable().destroy();
            initPlanTable()
          } else {

            toastr["error"]("ERROR ! Please Try Again Later");
          }

        }

        function OnError(data) {

          if (data.success == 'true') {
            toastr["success"](data.msg);
            clearall();
            dtPlanTable.DataTable().destroy();
            initPlanTable()
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
      target: dtPlanTable,
      animate: false,
      boxed: true,
      message: "Loading"
    });

    $.ajax({
      url: "/Plans/delete",
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
          dtPlanTable.DataTable().destroy();
          initPlanTable()
          Metronic.unblockUI(dtPlanTable);
        } else {   Metronic.unblockUI(dtPlanTable);
          toastr['error']('👋 ' + res.msg, 'Error!', {
            closeButton: true,
            tapToDismiss: false,

          });
        }
      },
      error: function (res) {
        Metronic.unblockUI(dtPlanTable);
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
    $("#add_plan_btn").attr("status","add");
    $('#plan_name').val('')
    $('#download').val('')
    $('#upload').val('')
    $('#quota').val('')
    $('#sim_usage').val('')
    $('#tax_select').val('')
    $('#price').val('')
    $('#plan_name').attr('disabled',false)
    newPlanSidebar.modal('show')



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
    newPlanSidebar.modal('show')
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
