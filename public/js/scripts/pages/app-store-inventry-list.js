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
       newUserSidebar = $(".new-model-modal"),
       newUserForm = $('.add-new-model'),  //here  
       newBrandForm = $('.add-vehicle-brand'),  //here 
       newBrandSidebar = $(".new-user-modal"),
       select = $('.select2');
   



       var updateid=  $('#update_id').val();
      if(updateid!=''){
           var selectbrand_id=  $('#selectbrand_id').val();
           var selectmodel_id=  $('#selectmodel_id').val();
           document.getElementById('my-input-id').disabled = false;
        brandmodel(selectbrand_id,selectmodel_id)
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
              let formData = new FormData($('#form_model')[0])
           $.ajax({
                  url: 'store-model', // JSON file to add data,
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
                          
                         const value_id = $('#brand_name').val()
                          const modelid = 0;
                           brandmodel(value_id,modelid)

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
          // Form Validation

      });
          
      if (newUserForm.length) {
        newUserForm.validate({
          errorClass: 'error',
          rules: {
            'model_name': {
              required: true
            }
          }
        });
        
        newUserForm.on("submit", function (e) {
          var isValid = newUserForm.valid();
          e.preventDefault();
          if (isValid) {
              newUserSidebar.modal("hide");
          }
        });
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

  //add button show hide
  $(document).on('change', '.model-name', function () {
    
     var model_id = $('#model_name').val();
      if(model_id!=''){
        document.getElementById('my-input-id').disabled = false;
      }else{
        document.getElementById('my-input-id').disabled = true;
      }
    
    });

  // click add button
    $(document).on('click', '.add_button', function () {
     
      var update_id=  $('#update_id').val();
      
      if(update_id!=''){
        // var brand_id=  $('#selectbrand_id').val();
        // var model_id=  $('#selectmodel_id').val();
          var brand_id=  $('#brand_name').val();
          var model_id=  $('#model_name').val();
          
              window.location = "../storeadmin/update-Inventry" +'/'+brand_id+'/'+model_id+'/'+update_id; 
      }
      else
      {
        var brand_id=  $('#brand_name').val();
        var model_id=  $('#model_name').val();       

        
              window.location = "create_inventory" +'/'+brand_id+'/'+model_id;  


          }

      });
    
   // Brand base Model
   $(document).on('change', '.brand-name', function () {
   
    const value_id = $(this).val();
    
    $('#brandid').val(value_id);
    const model_id = 0;
     
    brandmodel(value_id,model_id)

    });

    function brandmodel(value_id,model_id) {
      $.ajax({
        url: '../storeadmin/ajax-brandmodel1'+'/'+value_id+'/'+model_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) { 
              // alert(data);
             if(data.status==true){
                 document.getElementById('my-input-id').disabled = false;
              } 
              $('.addmodel12').show();
              $('.select_model').show();
              $('.model-name').html(data.html);
        },
         error: function (data) {
        }
    })
  }
  newBrandForm.on('submit', function (e) {
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
          let formData = new FormData($('#addvehicle_brand')[0])

       $.ajax({
              url: 'store-brand', // JSON file to add data,
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
                      window.location = "/storeadmin/inventory-list";  
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
          //form validation
        if (newBrandForm.length) {
          newBrandForm.validate({
            errorClass: 'error',
            rules: {
              'brand_name': {
                required: true
              }
            }
          });
          newBrandForm.on("submit", function (e) {
            var isValid = newBrandForm.valid();
            e.preventDefault();
            if (isValid) {
              newBrandSidebar.modal("hide");
            }
          });
          }
          
      
  });

 
 
  
});
