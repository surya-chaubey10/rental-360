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
   var formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),  
    newUserForm = $('.add-manage-booking-invoice'),  //here  
    select = $('.select2'), 
    dtContact = $('.dt-contact');
    

  var assetPath = '../../../app-assets/',
   
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'app/vendor/view/account';
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
   
  if (newUserForm.length) {
    newUserForm.validate({
      errorClass: 'error',
      rules: {
        'full_name': {
          required: true
        },
        'currency_type': {
          required: true
        },
        'transaction_type': {
          required: true
        } 
     
      }
    });   
  } 
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
          let formData = new FormData($('#booking_form_invoice')[0])
          var grand =$('#grandTotal').val();
          if(grand==0){
                     Swal.fire({
                             icon: 'error',
                             text: 'Check Your Invoice Value',
                             customClass: {
                               confirmButton: 'btn btn-error'
                             } 
                           }); 
          }else{
         $.ajax({
              url: '../save_booking_invoice', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              processData: false,
              success: function (data) {  
 
                  $( "#submit" ).prop( "disabled", false );
                  if(data.status === true) {
                  
                    if(data.data.transaction_type == "4") {
                      window.location = "/invoice-preview" + '/' + data.data.uuid; 
                      // window.location = "/manage-booking-list"; 
                    }else{
                      
                      toastr['success'](''+data.message+'', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl 
                      });
                      // window.location = "/manage-booking-list";  
                       window.location = "/invoice-preview" + '/' + data.data.uuid; 
                    }
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
      }
  });
 

    
 
  // Form Validation
//.......................................

  // Phone Number
  if (dtContact.length) {
    dtContact.each(function () {
      new Cleave($(this), {
        phone: true,
        phoneRegionCode: 'US'
      });
    });
  }

     // Confirm Color
     $(document).on('click', '.delete-record', function () {
      const value_id = $(this).data('id')
        console.log(value_id);
        Swal.fire({
          title: 'Destroy Customer?',
          text: 'Are you sure you want to permanently remove this record?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {
  
            deleteRecord(value_id)
            
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'Your imaginary file is safe :)',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          }
        });
      });
  
      function deleteRecord(value_id) {
        $.ajax({
          url: 'bookings-delete'+'/'+value_id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (data) {
              if (data.status === true) {
                Swal.fire({
                  icon: 'success',
                  title: 'Deleted!',
                  text: 'Your record has been deleted.',
                  customClass: {
                    confirmButton: 'btn btn-success'
                  }
                    
                });
                
                location.reload(true);
              } else if (data.status === false) {
                
                 
              }
          },
          error: function (data) {
            
           
          }
      })
    }

   



});
