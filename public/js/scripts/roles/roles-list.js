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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dtRoleTable = $('#role-datatable'),
        newUserSidebar = $('.new-user-modal'),
        newRoleForm = $('.add-new-role');


    // Users List datatable
    if (dtRoleTable.length) {
        dtRoleTable= dtRoleTable.DataTable({
            ajax: {
                url:' /crm/roles/',
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
    if (newRoleForm.length) {
        newRoleForm.validate({
            errorClass: 'error',
            rules: {
                'user-fullname': {
                    required: true
                },
                'user-name': {
                    required: true
                },
                'user-email': {
                    required: true
                }
            }
        });

        newRoleForm.on('submit', function (e) {
            var isValid = newRoleForm.valid();
            var form = $(this);
            var url = form.attr('action');
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(response)
                {
                    dtRoleTable.ajax.reload(); // user paging is not reset on reload
                }
            });
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
