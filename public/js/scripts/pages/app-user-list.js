/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function() {
  "use strict";

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  var dtUserTable = $(".user-list-table"),
    newUserSidebar = $(".new-user-modal"),
    newUserForm = $(".add-new-user");

  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable = dtUserTable.DataTable({
      ajax: {
        url: "/crm/users/",
        data: { data: "getUserData" },
      },
      columns: [
        // columns according to JSON
        { data: "id" },
        { data: "name" },
        { data: "email" },
        { data: "actions" },
      ],
      language: {
        sLengthMenu: "Show _MENU_",
        search: "Search",
        searchPlaceholder: "Search..",
      },
    });
  }

  // Check Validity
  function checkValidity(el) {
    if (el.validate().checkForm()) {
      submitBtn.attr("disabled", false);
    } else {
      submitBtn.attr("disabled", true);
    }
  }

  // Form Validation
  if (newUserForm.length) {
    newUserForm.validate({
      errorClass: "error",
      rules: {
        "user-fullname": {
          required: true,
        },
        "user-name": {
          required: true,
        },
        "user-email": {
          required: true,
        },
      },
    });

    newUserForm.on("submit", function(e) {
      var isValid = newUserForm.valid();
      var form = $(this);
      var url = form.attr("action");
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(response) {
          dtUserTable.ajax.reload(); // user paging is not reset on reload
        },
      });
      if (isValid) {
        newUserSidebar.modal("hide");
      }
    });
  }

  // To initialize tooltip with body container
  $("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    container: "body",
  });
});
