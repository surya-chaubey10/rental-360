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
   var brandbasemodel = $('.brand-name');

   var formBlock = $('.btn-form-block'),
       formSection = $('.form-block'), 
       UpdateLeadForm = $('.add-update-lead'), 
       newLeadForm = $('.add-new-lead');
       

   // Brand base Model


   $(document).on('change', '.vehicle_name', function () {
    const value_id = $(this).val();
    const model_id = 0;
    $('#brand_id').val(value_id);
      console.log(value_id);
          brandmodel(value_id,model_id)

    });

    var update_id=  $('#updated_id').val();
    if(update_id){

        var value_id = $('#brand').val();
        var model_id = $('#model').val();
      
        brandmodel(value_id,model_id)
     }

    function brandmodel(value_id,model_id) {
      $.ajax({
        url: '../ajax-brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) { 
              $('.model-name').html(data.html);
        },
        error: function (data) {
        }
    })
  }
 

  if (newLeadForm.length) {
    newLeadForm.validate({
  errorClass: 'error',
  rules: {
    'first_name': { 
      required: true
    }, 
    'last_name': {
      required: true
    },
    'mobile': {
      required: true
    },
    'email': {
      required: true
    }
    
  }
});


} 


  newLeadForm.on('submit', function (e) {
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
              url: 'leads-store', // JSON file to add data,
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
                      window.location = "/leads-list";  
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
  });



  if (UpdateLeadForm.length) {
    UpdateLeadForm.validate({
  errorClass: 'error',
  rules: {
    'first_name': { 
      required: true
    }, 
    'last_name': {
      required: true
    },
    'mobile': {
      required: true
    },
    'email': {
      required: true
    }

  }
});

} 
  
 //Updae form
 UpdateLeadForm.on('submit', function (e) {
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
        let formData = new FormData($('#fud_idd')[0])
     $.ajax({
      
            url: '../leads-update', // JSON file to add data,
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
                    window.location = "/leads-list";  
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
});
 
  
});
