/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
    ('use strict');
  
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     })
     var isRtl = $('html').attr('data-textdirection') === 'rtl';
    var dtUserTable = $('.customer-list-table'),
      formBlock = $('.btn-form-block'),
      formSection = $('.form-block'),
      newUserSidebar = $('.new-customer-modal'),
      newUserForm = $('.update-new-offer'),
      select = $('.select2'),
      dtContact = $('.dt-contact'),
      statusObj = {
        Pending: { title: 'Pending', class: 'badge-light-warning' },
        Active: { title: 'Active', class: 'badge-light-success' },
        Inactive: { title: 'Inactive', class: 'badge-light-secondary' }
      };
  
    var assetPath = '../../../app-assets/',
      userView = 'app-user-view-account.html';
  
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
      userView = assetPath + 'app/customer/view/account';
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
  
   
  
    newUserForm.on('submit', function (e) {
      if (!e.isDefaultPrevented()) {
            e.preventDefault()
          $( "#submit" ).prop( "disabled", true );
          if (formBlock.length && formSection.length) {
            formBlock.on('click', function () {
              formSection.block({
                message: '<div class="spinner-border text-white" role="status"></div>',
                timeout: 1000,
                css: {
                  backgroundColor: 'transparent',
                  color: '#fff',
                  border: '0'
                },
                overlayCSS: {
                  opacity: 0.5
                }
              });
            });
          }
            let formData = new FormData($('#form_idd')[0])
         $.ajax({
                url: '../offer-update', // JSON file to add data,
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $( "#submit" ).prop( "disabled", false );
                     
                    if (data.status === true) {  
                        toastr['success'](''+data.message+'', {
                          closeButton: true,
                          tapToDismiss: false,
                          rtl: isRtl
                        });
                        window.location = "/offer-list";
                         
                    } else if (data.status === false) {
                      $( "#submit" ).prop( "disabled", false );
                      toastr['error'](''+data.message+'', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                      });
                       
                    }
                },
                error: function (data) {
                  $( "#submit" ).prop( "disabled", false );
                  toastr['error'](''+data.message+'', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                  });
                }
            })
        }
    })
    // Form Validation
  if (newUserForm.length) {
    newUserForm.validate({
        errorClass: 'error',
        rules: {
          'offer_category': {
            required: true
          },
          'image_path': {
            required: true
          },
          'startdate': {
            required: true
          },'enddate': {
            required: true
          },
          'starttime': {
            required: true
          },'endtime': {
            required: true
          },
          'minimum': {
            required: true
          },'maximum': {
            required: true
          },'status': {
            required: true
          }
        }
      });
  }

});