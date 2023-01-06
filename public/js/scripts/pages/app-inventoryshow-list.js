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
     select = $('.select2');
     selectlabel = $('.form-check-input'),
     formBlock = $('.btn-form-block'),
     formSection = $('.form-block'),  
     newFleetForm = $('.add-page1-brand'),
     updateFleetForm = $('.update-new-inventory');  //here  
    
     // Add Form Validation
    if (newFleetForm.length) {
      newFleetForm.validate({
        errorClass: 'error',
        rules: {
          'year': {
            required: true
          }
        }
      });
    }
        newFleetForm.on('submit', function (e) {
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
                      url: '../../inventory-add', // JSON file to add data,
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

                              window.location.href = "/storeadmin/inventory-list";
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

      //Update form
          if (updateFleetForm.length) {
            updateFleetForm.validate({
              errorClass: 'error',
              rules: {
                'year': {
                  required: true
                }
              }
            });
          } 
          updateFleetForm.on('submit', function (e) {
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
                  let formData = new FormData($('#updated_idd')[0])
               $.ajax({
                      url: '../inventory_update', // JSON file to add data,
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
                              window.location.href = "/storeadmin/inventory-list"; 
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
          
          var updated_id = $('#update_id').val(); 
          if(updated_id){
              $.ajax({
                url: '../inventoryimagejson1'+'/'+updated_id, // JSON file to add data,
                type: 'get',
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) { 
                  let preloaded = data;
                $('.input-images-1').imageUploader({
                    preloaded: preloaded,
                    imagesInputName: 'inventory_details',
                    preloadedInputName: 'old'
                  });
                },
                error: function (data) {
                }
            })
            }
            else{
                 $('.input-images-1').imageUploader();
                }

          var updateid=  $('#update_id').val();
          if(updateid!=''){
                var selectbrand_id=  $('#selectbrand_id').val();
                var selectmodel_id=  $('#selectmodel_id').val();
                brandmodel(selectbrand_id,selectmodel_id)
          }
          $(document).on('change', '.brand-name', function () {
              const value_id = $(this).val();
              const model_id = 0;
              brandmodel(value_id,model_id)
            });

          function brandmodel(value_id,model_id) {
            $.ajax({
              url: '../ajax-brandmodel1'+'/'+value_id+'/'+model_id, // JSON file to add data,
              type: 'get',
              dataType: 'json',
              contentType: false,
              processData: false,
              success: function (data) { 
                    $('.modelname').html(data.html);
              },
                error: function (data) {
              }
          }) 
        }
  });
  