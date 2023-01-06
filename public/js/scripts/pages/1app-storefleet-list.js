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
     updateFleetForm = $('.update-page1-brand');  //here  
     
     var i = 1;
     var rowcount=$("#rowcount").val();
     if(rowcount!=1){
      var i = parseInt(rowcount);
      }
      
     $(document).on('click', '.add_row', function () {
         $('#addr' + i).html('<td><select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">'+"<option value='1'>Hourly</option><option value='2'>Daily</option><option value='3'>Weekly</option><option value='4'>Monthly</option><option value='5'>Custom</option>"+"</td><td><input type='text' name='unit_price[]'  placeholder='Price' data-unit='"+i+"' value='0' class='form-control price_key'/><td><input type='text' name='vat[]' placeholder='Vat' data-vat='"+i+"' value='0' class='form-control vat_key'/></td><td><input type='text' name='sub_total[]' id='total_"+i+"' placeholder='Sub Total' value='0' class='form-control input-md'/></td><td><input type='text' name='deposite[]' placeholder='Deposite' class='form-control input-md' value='0' /></td><td><button type='button' name='remove' id='"+i+"' class='btn btn-danger btn_remove'>"+feather.icons['trash-2'].toSvg({ class: 'font-medium-4' })+"</button></td>");
 
         $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
         i++;
     });


     $(document).on('keyup', '.prefix_no', function(){ 
           var prefix = $(this).val();
           var sku = $('.sku_no').val(); 
           var num_plate = $('.num_plate').val();
           var fleet_no = sku+'-'+prefix+''+num_plate;
          $('.sku_num').val(fleet_no);
     });
     $(document).on('keyup', '.num_plate', function(){ 
        var prefix = $('.prefix_no').val();
        var sku = $('.sku_no').val();
        var num_plate = $(this).val(); 
        var fleet_no = sku+'-'+prefix+''+num_plate;
        $('.sku_num').val(fleet_no);
    });



     $(document).on('keyup', '.price_key', function(){ 
       var keyid = $(this).attr("data-unit"); 
       var array1=[];
       var array2=[];
       $("input[name='unit_price[]']").map( function(key){
           array1[key]=$(this).val();
       })
        $("input[name='vat[]']").map( function(key1){
          array2[key1]=$(this).val();
         })
         var total=0;
         total = parseInt(array1[keyid]) + (parseInt(array1[keyid])*parseInt(array2[keyid])) / 100 ;

      $('#total_'+keyid+'').val(total); 
    
    });
    $(document).on('keyup', '.vat_key', function(){ 
      var keyid = $(this).attr("data-vat"); 
      var array1=[];
      var array2=[];
      $("input[name='unit_price[]']").map( function(key){
          array1[key]=$(this).val();
      })
       $("input[name='vat[]']").map( function(key1){
         array2[key1]=$(this).val();
        })
      var total=0;
      
       total = parseInt(array1[keyid]) + (parseInt(array1[keyid])*parseInt(array2[keyid])) / 100 ;

      $('#total_'+keyid+'').val(total); 
   
    });

     $(document).on('click', '.btn_remove', function(){ 
        i--;
        var button_id = $(this).attr("id"); 
        $('#addr'+button_id+'').remove(); 
         
        }); 

        $(document).on('click', '.form-check-input', function(){ 
            var but_id = $(this).val(); 
            if(but_id==2){
                $('.Ownership-Info').show(); 
            }else{
                $('.Ownership-Info').hide(); 
            }
        });
        var selected_type = $('#type_id').val(); 
        if(selected_type==2){
              $('.Ownership-Info').show(); 
        }
        $(document).on('click', '.nextpage', function(){ 
            
                $('.fleetpage2').show(); 
                $('.fleetpage1').hide();
                $('.Previous').show();
                $('.Next').hide();
                $( ".submitshow" ).prop( "disabled", false );
        });
        $(document).on('click', '.priviouspage', function(){ 
            
                $('.fleetpage2').hide(); 
                $('.fleetpage1').show();
                $('.Next').show();
                $('.Previous').hide();
                $('.submitshow').show();
                $('.submitshow' ).prop( "disabled", true );
                
        });
          // Add Form Validation
    if (newFleetForm.length) {
      newFleetForm.validate({
        errorClass: 'error',
        rules: {
        
          'number_plate': {
            required: true
          },
          'prefix': {
            required: true
          },
          'sku': {
            required: true
          } ,
          
          'unit': {
            required: true
          },
          'child_sheet': {
            required: true
          },
          // 'insurance': {
          //   required: true
          // },
          'additional': {
            required: true
          },
          'document': {
            required: true
          },
          'document1': {
            required: true
          },
          // 'year': {
          //   required: true
          // },
          // 'color': {
          //   required: true
          // },
          // 'allowed': {
          //   required: true
          // },
          // 'service_type': {
          //   required: true
          // } ,
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
                  var sku = $('.sku_num').val();
                  $.ajax({
                    url: '../../../checksku_name'+'/'+sku, // JSON file to add data,
                    type: 'get',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (data) {     
                            if(data || $.trim(data).length)
                            {
                    
                                $('#sku_error').html("This sku name is already exists");
                                return $('#sku').focus(); 
                            }else{

                                $.ajax({
                                      url: '../../fleet-store', // JSON file to add data,  
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
                                              window.location = "/fleetshow";  
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
                        },
                        error: function (data) {
                        }
                      })
              }
          });


          //Update form   

          if ( updateFleetForm.length) {
            updateFleetForm.validate({
              errorClass: 'error',
              rules: {
               
                'number_plate': {
                  required: true
                },
                'prefix': {
                  required: true
                },
              
                'sku': {
                  required: true
                } ,
                
                'unit': {
                  required: true
                },
                'child_sheet': {
                  required: true
                },
                // 'insurance': {
                //   required: true
                // },
                'additional': {
                  required: true
                },
                 'document': {
                  required: true
                },
                'document1': {
                  required: true
                },
                  // 'service_type': {
                //   required: true
                // } ,
                // 'allowed': {
                //   required: true
                // },
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
                      url: '../../../fleet-update', // JSON file to add data,
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
                              window.location = "/fleetshow";  
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
          
          var updated_id = $('#updated_id').val(); 
          var inventory_id = $('#inventory_id').val(); 
          if(updated_id){

              $.ajax({
                url: '../../../image-json'+'/'+updated_id, // JSON file to add data,
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

            }else if(inventory_id){
                $.ajax({
                url: '../../../inventoryimagejson'+'/'+inventory_id, // JSON file to add data,
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
            }else{
                 $('.input-images-1').imageUploader();
         
                }
          if(updated_id){
            var prefix = $('.prefix_no').val();
            var sku = $('.sku_no').val();
            var num_plate = $('.num_plate').val();
            var fleet_no = sku+'-'+prefix+''+num_plate;
            $('.sku_num').val(fleet_no);
          }
          
  });
  
  //29-11-2022
  //loader
  $('document').ready(function(e){
    $(".loader").fadeOut("slow");
  });

  
$('#submit').click(function() {
 $('.loader').show();
 $.ajax({
   success:function(result){
     $('.loader').hide();
   }
 })
})
