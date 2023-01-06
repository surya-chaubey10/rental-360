$(function () {
  ('use strict');
  var invoicepopupform = $('#invoicepopupform');

  // jQuery Validation
  // --------------------------------------------------------------------
  if (invoicepopupform.length) {
    invoicepopupform.validate({
      rules: {
        editPermissionName: {
          required: true
        }
      }
    });
  }
});
