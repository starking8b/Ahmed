
$(function () {
    'use strict';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dtispTable = $("#isp-datatable"),
      newUserSidebar = $(".new-user-modal"),
      newUserForm = $(".add-new-user");
    var ispDatatable;
    if (dtispTable.length) {
        ispDatatable= dtispTable.DataTable({
                processing: true,
                serverSide: true,
                destroy:true,
                autoWidth: false,
                responsive: true,
                stateSave: false,
                ajax: {
                    url:'/crm/isp/',
                    data:{data:'getRoleData'}
                }, // JSON file to add data
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'actions' }
                ],
                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
            });
    }

    // Check Validity
    function checkValidity(el) {
        if (el.validate().checkForm()) {
            submitBtn.attr('disabled', false);
        } else {
            submitBtn.attr('disabled', true);
        }
    }

    // Form Validation
    if (newUserForm.length) {
        console.log("geldi");
        newUserForm.validate({
            errorClass: 'error',
            rules: {
                'name': {
                    required: true
                },
            }
        });

        newUserForm.on('submit', function (e) {
            var isValid = newUserForm.valid();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(response)
                {
                    ispDatatable.ajax.reload(); // user paging is not reset on reload
                }
            });
            e.preventDefault();
            if (isValid) {
                newUserSidebar.modal('hide');
            }
        });
    }

    // To initialize tooltip with body container
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        container: 'body'
    });
});
