/**
 * DataTables Advanced
 */

'use strict';

// Advanced Search Functions Starts
// --------------------------------------------------------------------

// Filter column wise function
function filterColumn(i, val) {
    if (i == 5) {
        var startDate = $('.start_date').val(),
            endDate = $('.end_date').val();
        filterByDate(i, startDate, endDate); // We call our filter function

        $('.dt-advanced-search').dataTable().fnDraw();
    } else {
        $('.dt-advanced-search').DataTable().column(i).search(val, false, true).draw();
    }
}

// Datepicker for advanced filter
var separator = ' - ',
    rangePickr = $('.flatpickr-range'),
    dateFormat = 'MM/DD/YYYY';
var options = {
    autoUpdateInput: false,
    autoApply: true,
    locale: {
        format: dateFormat,
        separator: separator
    },
    opens: $('html').attr('data-textdirection') === 'rtl' ? 'left' : 'right'
};

//
if (rangePickr.length) {
    rangePickr.flatpickr({
        mode: 'range',
        dateFormat: 'm/d/Y',
        onClose: function (selectedDates, dateStr, instance) {
            var startDate = '',
                endDate = new Date();
            if (selectedDates[0] != undefined) {
                startDate =
                    selectedDates[0].getMonth() + 1 + '/' + selectedDates[0].getDate() + '/' + selectedDates[0].getFullYear();
                $('.start_date').val(startDate);
            }
            if (selectedDates[1] != undefined) {
                endDate =
                    selectedDates[1].getMonth() + 1 + '/' + selectedDates[1].getDate() + '/' + selectedDates[1].getFullYear();
                $('.end_date').val(endDate);
            }
            $(rangePickr).trigger('change').trigger('keyup');
        }
    });
}

// Advance filter function
// We pass the column location, the start date, and the end date
var filterByDate = function (column, startDate, endDate) {
    // Custom filter syntax requires pushing the new filter to the global filter array
    $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
        var rowDate = normalizeDate(aData[column]),
            start = normalizeDate(startDate),
            end = normalizeDate(endDate);

        // If our date from the row is between the start and end
        if (start <= rowDate && rowDate <= end) {
            return true;
        } else if (rowDate >= start && end === '' && start !== '') {
            return true;
        } else if (rowDate <= end && start === '' && end !== '') {
            return true;
        } else {
            return false;
        }
    });
};

// converts date strings to a Date object, then normalized into a YYYYMMMDD format (ex: 20131220). Makes comparing dates easier. ex: 20131220 > 20121220
var normalizeDate = function (dateString) {
    var date = new Date(dateString);
    var normalized =
        date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
    return normalized;
};
// Advanced Search Functions Ends

$(function () {
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    var csrf=$('#csrf').val();
    var dt_ajax_table = $('#statetable'),
        statetable = $('#statetable'),
        citytable = $('#citytable'),
        thanatable = $('#thanatable'),
        areatable = $('#areatable'),
        dt_adv_filter_table = $('#statetable'),
        dt_responsive_table = $('#statetable'),
        assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }

    // Ajax Sourced Server-side
    // --------------------------------------------------------------------

function  initstateTable() {
    var table = statetable.dataTable({
        processing: true,
        dom:
            '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        ajax: '/Location/state_list_get',
        columns: [
            {
                data: 'id',
                name: 'id',


            },
            {
                data: 'state_name',
                name: 'state_name',
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
        language: {
            paginate: {
                // remove previous & next text from pagination
                previous: '&nbsp;',
                next: '&nbsp;'
            }
        }
    });
}
/////////////////////////city table ///////

    function  initcityTable() {
        var table = citytable.dataTable({
            processing: true,
            dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            ajax: '/Location/city_list_get',
            columns: [
                {
                    data: 'id',
                    name: 'id',


                },
                {
                    data: 'city_name',
                    name: 'city_name',
                    orderable: true,


                },
                {
                    data: 'state_name',
                    name: 'state_name',
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
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }



    //////////  finish city table ///////////
///////////Thana Table //////////////////////

    function  initThanaTable() {
        var table = thanatable.dataTable({
            processing: true,
            dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            ajax: '/Location/thana_list_get',
            columns: [
                {
                    data: 'id',
                    name: 'id',


                },
                {
                    data: 'thana_name',
                    name: 'thana_name',
                    orderable: true,


                },
                {
                    data: 'city_name',
                    name: 'city_name',
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
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }



    /////Finish Thana Table /////////////////////

    ////////Area Table////////////////

    function  initAreaTable() {
        var table = areatable.dataTable({
            processing: true,
            dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            ajax: '/Location/area_list_get',
            columns: [
                {
                    data: 'id',
                    name: 'id',


                },
                {
                    data: 'area_name',
                    name: 'area_name',
                    orderable: true,


                },
                {
                    data: 'thana_name',
                    name: 'thana_name',
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
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }


    ///////Finish Area Table //////////////////

    // Column Search
    // --------------------------------------------------------------------


    // Advanced Search
    // --------------------------------------------------------------------



    // // Filter form control to default size for all tables
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .custom-select').removeClass('custom-select-sm').removeClass('form-control-sm');


    initstateTable();
    initcityTable()
    initThanaTable()
    initAreaTable();

///////////state functions/////////////////////////////////
    $('body').on('click','#createStateModalbtn',function () {

     $('#edit_state_btn').hide()
        $('#create_state').show()
        $('#defaultModalLabel').html("Create State")
        $('#editStateShow').val('');
        $('#editStateIdShow').val('');
        $('#StateModal').modal('show')

    });
    $('body').on('click','#editStateModalBtn',function () {

        $('#edit_state_btn').show()
        $('#create_state').hide()
        $('#defaultModalLabel').html("Edit State")
        var editStateId = $(this).attr('state_id');
        var editStateName = $(this).attr('state_name');


        $('#editStateShow').val(editStateName);
        $('#editStateIdShow').val(editStateId);
        $('#StateModal').modal('show')
    });
    $('#edit_state_btn').on('click', function (e) {
        e.preventDefault();
     var state_name=$('#editStateShow').val();
     var state_id=$('#editStateIdShow').val();


        $.ajax({
            url: "/Location/edit_state",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN':csrf
            },
            data: {state_id:state_id,state_name:state_name},
            success: function (res) {
                if (res.success == 1) {
                    toastr['success']('👋 State Has been Saved Successfully', 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    statetable.DataTable().destroy();
                    initstateTable();
                    load_states();
                } else {
                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,

                    });
                }
            },
            error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,

                    });

            }
        });

    });
    $('#create_state').on('click', function (e) {
        e.preventDefault();
        var state_name=$('#editStateShow').val();



        $.ajax({
            url: "/Location/add_state",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN':csrf
            },
            data: { state_name:state_name},
            success: function (res) {
                if (res.success == 1) {
                    toastr['success']('👋 State Has been addedd Successfully', 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,

                    });
                    statetable.DataTable().destroy();
                    initstateTable();
                    load_states()
                } else {
                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                }
            },
            error: function (res) {

                toastr['error']('👋 Please Try Again Later.', 'Error!', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });

            }
        });

    });

    ///////////////////////End State Functions////////////////////////////////////

    //////////////////////////City Functions//////////////////////////////////////
    $('#create_city').on('click', function (e) {
        e.preventDefault();
        city_functions("add")
    });
    $('#edit_city_btn').on('click', function (e) {
        e.preventDefault();
        city_functions("edit")
    });
    $('body').on('click','#delete_city_btn',function (e) {

        e.preventDefault();

        var id=$(this).attr('city_id')
        areyousure(id,'city')

    });
    $('body').on('click','#delete_thana_btn',function (e) {

        e.preventDefault();

        var id=$(this).attr('thana_id')
        areyousure(id,'thana')

    });

    $('body').on('click','#delete_area_btn',function (e) {

        e.preventDefault();

        var id=$(this).attr('area_id')
        areyousure(id,'area')

    });
    $('body').on('click','#delete_state_btn',function (e) {

        e.preventDefault();
        var id=$(this).attr('state_id')
        areyousure(id,'state')

    });
    $('body').on('click','#createCityModalbtn',function (e) {

        $('#edit_city_btn').hide()
        $('#create_city').show()
        $('#cityModalLabel').html("Create City")
        $('#city_name').val('');
        $('#city_id').val('');
        $('#CityModal').modal('show')

    });
    $('body').on('click','#editCityModalBtn',function () {

        $('#edit_city_btn').show()
        $('#create_city').hide()
        $('#cityModalLabel').html("Edit City")
        var editCityId = $(this).attr('city_id');
        var editCityName = $(this).attr('city_name');
        var state_id = $(this).attr('state_id');

        $('#city_name').val(editCityName);
        $('#city_id').val(editCityId);
        $('#select_state').val(state_id)
        $('#CityModal').modal('show')
    });


    $('body').on('click','#createThanaModalbtn',function (e) {

        $('#edit_thana_btn').hide()
        $('#create_thana').show()
        $('#thanaModalLabel').html("Create Thana")
        $('#thana_name').val('');
        $('#thana_id').val('');
        $('#ThanaModal').modal('show')

    });
    $('body').on('click','#editThanaModalBtn',function () {

        $('#edit_thana_btn').show()
        $('#create_thana').hide()
        $('#thanaModalLabel').html("Edit Thana")
        var editThanaId = $(this).attr('thana_id');
        var editThanaName = $(this).attr('thana_name');
        var city_id = $(this).attr('city_id');

        $('#thana_name').val(editThanaName);
        $('#thana_id').val(editThanaId);
        $('#select_thana').val(city_id)
        $('#ThanaModal').modal('show')
    });



    $('body').on('click','#createAreaModalbtn',function (e) {

        $('#edit_area_btn').hide()
        $('#create_area').show()
        $('#areaModalLabel').html("Create Area")
        $('#area_name').val('');
        $('#area_id').val('');
        $('#AreaModal').modal('show')

    });
    $('body').on('click','#editAreaModalBtn',function () {

        $('#edit_area_btn').show()
        $('#create_area').hide()
        $('#thanaModalLabel').html("Edit Area")
        var editAreaId = $(this).attr('area_id');
        var editAreaName = $(this).attr('area_name');
        var thana_id = $(this).attr('thana_id');

        $('#area_name').val(editAreaName);
        $('#area_id').val(editAreaId);
        $('#select_area').val(thana_id)
        $('#AreaModal').modal('show')
    });


    function load_states(){
        $.ajax({
            url: "/Location/get_all_states",
            method: "get",
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            success: function (res) {
                $('#select_state').empty();
             var data=res
                $.each(data, function(i, obj){
                    $('#select_state').append($('<option>').text(obj.state_name).attr('value', obj.id));
                });
            },
            error: function (res) {


            }
        });

    }
    function load_cities(){
        $.ajax({
            url: "/Location/get_all_cities",
            method: "get",
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            success: function (res) {
                $('#select_city').empty();
                var data=res
                $.each(data, function(i, obj){
                    $('#select_city').append($('<option>').text(obj.city_name).attr('value', obj.id));
                });
            },
            error: function (res) {


            }
        });



    }
    function load_thana(){
        $.ajax({
            url: "/Location/get_all_thana",
            method: "get",
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            success: function (res) {
                $('#select_thana').empty();
                var data=res
                $.each(data, function(i, obj){
                    $('#select_thana').append($('<option>').text(obj.thana_name).attr('value', obj.id));
                });
            },
            error: function (res) {


            }
        });



    }
function areyousure(id,op){

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
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
                delete_function(id,op)
            }
            else
                return "false";
        });



}


    function delete_function(id,op) {



            if (op == 'city') {
                $.ajax({
                    url: "/Location/delete_city",
                    method: "get",
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    data: {id: id},
                    success: function (res) {
                        if (res.success == 1) {
                            toastr['success']('👋 City Has been deleted Successfully', 'Success!', {
                                closeButton: true,
                                tapToDismiss: false,

                            });
                            citytable.DataTable().destroy();
                            initcityTable();
                            load_cities();
                        } else {
                            toastr['error']('👋 ' + res.message, 'Error!', {
                                closeButton: true,
                                tapToDismiss: false,

                            });
                        }
                    },
                    error: function (res) {

                        toastr['error']('👋 Please Try Again Later.', 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });

                    }
                });
            }
        if (op == 'thana') {
            alert(id)
            $.ajax({
                url: "/Location/delete_thana",
                method: "get",
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                data: {id: id},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 Thana Has been deleted Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                        thanatable.DataTable().destroy();
                        initThanaTable() ;
                        load_thana()
                    } else {
                        toastr['error']('👋 ' + res.message, 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,

                    });

                }
            });
        }
        if (op == 'area') {

            $.ajax({
                url: "/Location/delete_area",
                method: "get",
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                data: {id: id},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 Area Has been deleted Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                        areatable.DataTable().destroy();
                        initAreaTable() ;
                    } else {
                        toastr['error']('👋 ' + res.message, 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,

                    });

                }
            });
        }
        if (op == 'state') {
            $.ajax({
                url: "/Location/delete_state",
                method: "get",
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                data: {id: id},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 state Has been deleted Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                        statetable.DataTable().destroy();
                        initstateTable();
                        load_states()
                    } else {
                        toastr['error']('👋 ' +res.message, 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,

                    });

                }
            });
        }

    }
    function city_functions(op){
        var city_name=$('#city_name').val()
        var city_id=$('#city_id').val();
        var selected_state=$('#select_state').val();


        if(op=='edit'){
            $.ajax({
                url: "/Location/edit_city",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                data: {city_id:city_id,state_id:selected_state,city_name:city_name},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 City Has been Saved Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                        citytable.DataTable().destroy();
                        initcityTable();
                        load_cities()
                    } else {
                        toastr['error']('👋 Please Try Again Later.', 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                }
            });

        }
        if(op=='add'){
            $.ajax({
                url: "/Location/add_city",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                data: { state_id:selected_state,city_name:city_name},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 City Has been added Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                        citytable.DataTable().destroy();
                        initcityTable();
                        load_cities()
                    } else {
                        toastr['error']('👋 '+res.message, 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,

                    });

                }
            });
        }

    }



    //////////////////////////End City Functions//////////////////////////////////////


    //////////////////Thana Function /////////////////////
    $('#create_thana').on('click', function (e) {
        e.preventDefault();
        thana_functions("add")
    });
    $('#edit_thana_btn').on('click', function (e) {
        e.preventDefault();
        thana_functions("edit")
    });
    function thana_functions(op){
        var thana_name=$('#thana_name').val()
        var thana_id=$('#thana_id').val();
        var selected_city=$('#select_city').val();


        if(op=='edit'){
            $.ajax({
                url: "/Location/edit_thana",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                data: {thana_id:thana_id,city_id:selected_city,thana_name:thana_name},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 Thana Has been Saved Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                        thanatable.DataTable().destroy();
                        initThanaTable();
                        load_thana()
                    } else {
                        toastr['error']('👋 Please Try Again Later.', 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                }
            });

        }
        if(op=='add'){
            $.ajax({
                url: "/Location/add_thana",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                data: { city_id:selected_city,thana_name:thana_name},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 Thana Has been added Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                        thanatable.DataTable().destroy();
                        initThanaTable();
                        load_thana()
                    } else {
                        toastr['error']('👋 '+res.message, 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                }
            });
        }

    }



    //////////////////Area Function /////////////////////
    $('#create_area').on('click', function (e) {
        e.preventDefault();
        area_functions("add")
    });
    $('#edit_area_btn').on('click', function (e) {
        e.preventDefault();
        area_functions("edit")
    });

    function area_functions(op){
        var area_name=$('#area_name').val()
        var area_id=$('#area_id').val();
        var selected_thana=$('#select_thana').val();


        if(op=='edit'){
            $.ajax({
                url: "/Location/edit_area",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                data: {area_id:area_id,thana_id:selected_thana,area_name:area_name},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 Area Has been Saved Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                        areatable.DataTable().destroy();
                        initAreaTable();
                    } else {
                        toastr['error']('👋 Please Try Again Later.', 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                }
            });

        }
        if(op=='add'){
            $.ajax({
                url: "/Location/add_area",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                data: { thana_id:selected_thana,area_name:area_name},
                success: function (res) {
                    if (res.success == 1) {
                        toastr['success']('👋 Area Has been added Successfully', 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                        areatable.DataTable().destroy();
                        initAreaTable();
                    } else {
                        toastr['error']('👋 '+res.message, 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,

                        });
                    }
                },
                error: function (res) {

                    toastr['error']('👋 Please Try Again Later.', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                }
            });
        }

    }


});
