
var Mikrotik=function(){
    var csrf=$('#csrf').val()




    var handleMikrotikAPI=function(){
        $('#save_device_btn').on('click', function () {
            Metronic.blockUI({
                target: $('#information'),
                animate: false,
                boxed: true,
                message: "Loading"
            });
            var device_name = $('#device_name').val();
            var description = $('#description').val()
            var ip = $('#ip').val();
            var id=$('#device_id').val()

            var partner = $('#partner_select').val();
            $.ajax({
                url: "/Routers/Save_device",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                dataType: 'json',
                data: {
                    id:id,
                    device_name: device_name,
                    description: description,
                    ip: ip,

                    partner: partner

                },
                success: function (data) {
                    Metronic.unblockUI($('#information'));
                    if (data.success == 'true') {
                        toastr["success"](data.msg);

                    } else {

                        toastr["error"]("ERROR ! Please Try Again Later");
                    }
                }
            });
        });

        $('#save_api').on('click', function () {
            Metronic.blockUI({
                target: $('#Mikrotiktab'),
                animate: false,
                boxed: true,
                message: "Loading"
            });
            var id=$('#device_id').val()
         var login=$('#login_api').val();
         var password=$('#password').val();
         var port=$('#port').val();
         var status=$('#apiswitch').is(':checked');


            $.ajax({
                url: "/Routers/Save_Mikrotik",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                dataType: 'json',
                data: {
                    'id': id,
                    'login': login,
                    'password':password,
                    'port':port,
                    'status':status

                },
                success: function (data) {
                    if (data.success == 'true') {
                        toastr["success"](data.msg);

                    } else {

                        toastr["error"]("ERROR ! Please Try Again Later");
                    }
                    Metronic.unblockUI($('#Mikrotiktab'));
                }
            });
        });

        $('#test_API').on('click', function () {
            Metronic.blockUI({
                target: $('#Mikrotiktab'),
                animate: false,
                boxed: true,
                message: "Loading"
            });
            var id=$('#device_id').val()
            var login=$('#login_api').val();
            var password=$('#password').val();
            var port=$('#port').val();
            var status=$('#apiswitch').is(':checked');


            $.ajax({
                url: "/Routers/test_API",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                dataType: 'json',
                data: {
                    'id': id,
                    'login': login,
                    'password':password,
                    'port':port,
                    'status':status

                },
                success: function (data) {
                    if (data.success == 'true') {
                        toastr["success"](data.msg);

                    } else {

                        toastr["error"]("ERROR ! Please Try Again Later");
                    }
                    Metronic.unblockUI($('#Mikrotiktab'));
                },
                error: function (data) {
                    if (data.success == 'true') {
                        toastr["success"](data.msg);

                    } else {

                        toastr["error"]("ERROR ! Can not connect to the API at the moment , Please try again  later");
                    }
                    Metronic.unblockUI($('#Mikrotiktab'));
                }
            });
        });

    }
    var handleMap=function (){
        $('#map_btn').on('click', function () {
            Metronic.blockUI({
                target: $('#map_btn'),
                animate: false,
                boxed: true,
                message: ""
            });
            var id=$('#device_id').val()
            var address=$('#address').val();
            var longitude=$('#longitude').val();
            var latitude=$('#latitude').val();
            var area_txt=$('#area_txt').val()


            $.ajax({
                url: "/Routers/save_map",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN':csrf
                },
                dataType: 'json',
                data: {
                    'id': id,
                    'address': address,
                    'longitude':longitude,
                    'latitude':latitude,
                    'area':area_txt

                },
                success: function (data) {
                    if (data.success == 'true') {
                        toastr["success"](data.msg);

                    } else {

                        toastr["error"]("ERROR ! Please Try Again Later");
                    }
                    Metronic.unblockUI($('#map_btn'));
                },
                error: function (data) {
                    if (data.success == 'true') {
                        toastr["success"](data.msg);

                    } else {

                        toastr["error"]("ERROR ! Can not connect to the API at the moment , Please try again  later");
                    }
                    Metronic.unblockUI($('#map_btn'));
                }
            });
        });


    }






    return {

        init: function () {

            handleMikrotikAPI()
            handleMap()
        }

    }



}();

jQuery(document).ready(function () {
    Mikrotik.init(); // init metronic core componets
});
