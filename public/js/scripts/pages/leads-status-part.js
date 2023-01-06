$(function () {
    ('use strict');
    var leadsStatusForm = $('#leadsStatusForm');
  
    // jQuery Validation
    // --------------------------------------------------------------------
    if (leadsStatusForm.length) {
      leadsStatusForm.validate({
        rules: {
          editPermissionName: {
            required: true
          }
        }
      });
    }
  });
  