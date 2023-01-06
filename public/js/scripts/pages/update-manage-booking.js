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
   var    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),  
    newUserForm = $('.update-manage-booking');

    if(newUserForm.length) {
      newUserForm.validate({
        errorClass: 'error',
        rules: {
          'select_vehicle': {
            required: true
          },
          'select_model': {
            required: true
          },
          // 'select_sku': {
          //   required: true
          // }
        }
      });
    }
    
  newUserForm.on('submit', function (e) {

    var booking_type = $('.inlineRadio1').val();
    var sku_count = $('.SKU_error_value').val();
    var selected_sku = $('.select_sku').val();
    
    if (!e.isDefaultPrevented()) {
          e.preventDefault()
          
          console.log(booking_type);
          if(booking_type == '1' && sku_count == '1' && (selected_sku=='' || selected_sku == '0')){
            $('#SKU_error').html('Please select SKU.')
            return $('#select_sku').focus();
          }
          if(booking_type == '1' && sku_count == '0' && (selected_sku=='' || selected_sku == '0')){
            $('#SKU_error').html('Not available any SKU in this Brand & Model.')
            return $('#select_sku').focus();
          }

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
          let formData = new FormData($('#booking_form_update')[0])
       $.ajax({
              url: '../update_manage_booking', // JSON file to add data,
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
                      if(data.data.payment_status=='A' || data.data.payment_status=='H'){ 
                          window.location = "/manage-booking-list"; 
                      }else{
                          window.location = "/edit_invoice" + '/' + data.data.uuid; 
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
  });
 

  // $(document).ready(function(){
  //   $(".inlineRadio1").click(function(){
  //     const value_id = $(this).val();
     
  //     if(value_id == 1){
  //       $('#merchant').hide(); 
  //     }else{
  //       $('#merchant').show(); 
  //     }
  //   });
  // });
  $(document).on('change', '.select_vehicle', function () {

    const value_id = $(this).val();
    const model_id = 0;
    $('#brand_id').val(value_id);
    $('#selectbrand_id').val(value_id);
    //console.log(value_id);
          brandmodel(value_id,model_id) 
    });

    $(document).on('change', '.select_marchantvehicle', function () {

      const value_id = $(this).val();
      const model_id = 0;
      $('#brand_id').val(value_id);
      $('#selectbrand_id').val(value_id);
        
            marchantbrandmodel(value_id,model_id) 
      });

      

    var update_id=  $('#updated_id').val();
    if(update_id){

         var value_id = $('#brand').val();
        var model_id = $('#model').val();
        var fleet_id = $('#sku_id').val();
        const pickup_date_time = 0;
        const drop_off_date_time = 0;
        console.log(model_id);
        brandmodel(value_id,model_id)
        marchantbrandmodel(value_id,model_id)
        check_fleet(value_id,fleet_id,pickup_date_time,drop_off_date_time)
     }

    $(document).on('change', '.select_model', function () {

      const value_id = $(this).val();
      const fleet_id = 0;
      const pickup_date_time=$('#pickup_date_time').val();
      const drop_off_date_time=$('#drop_off_date_time').val();
      const from_date = new Date(pickup_date_time).toLocaleDateString('fr-CA');
      const to_date = new Date(drop_off_date_time).toLocaleDateString('fr-CA');

            check_fleet(value_id,fleet_id,from_date,to_date) 
            
            $('#skudiv').show();
      });

      $(document).on('change', '.select_sku', function () {

        const value_id = $("#select_sku option:selected").text();
        $('#sku').val(value_id);
        });

        function brandmodel(value_id,model_id) {
          $.ajax({
            url: '../brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false,
            cache : false, 
            processData: false,
            success: function (data) {   
                  $('.select_model').html(data.html);
            },
            error: function (data) {
            }
        });
      }
      function marchantbrandmodel(value_id,model_id) {
        
        $.ajax({
          url: '../marchantbrandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
                $('.select_marchantmodel').html(data.html);
          },
          error: function (data) {
          }
      });
    }
   
      function check_fleet(value_id,fleet_id,pickup_date_time,drop_off_date_time) {
  
        $.ajax({
          url: '../get_available_fleet'+'/'+value_id+'/'+fleet_id+'/'+pickup_date_time+'/'+drop_off_date_time, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {  

           $('.SKU_error').html("");
           $('.SKU_error_value').val('');
          if(data.status === true){
              $('.select_sku').html(data.html);
              $('.SKU_error_value').val("1");
          }else{
            $('.select_sku').html(data.html);
            $('.SKU_error').html("Not available any SKU in this Brand & Model");
            $('.SKU_error_value').val("0");
          } 
          },
          error: function (data) {
          }
      });
    }
  
    /* 
  $(document).on('change', '.select_vehicle', function () {

    const value_id = $(this).val();
    const model_id = 0;
    $('#brand_id').val(value_id);
    $('#selectbrand_id').val(value_id);
      console.log(value_id);
          brandmodel(value_id,model_id)

    });

  function brandmodel(value_id,model_id) {
    $.ajax({
      url: '../brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
      type: 'get',
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function (data) {   
            $('.select_model').html(data.html);
      },
      error: function (data) {
      }
  });
} */

$(document).on('change', '.select_customer', function () {

  const value_id = $(this).val(); 
  $('#brand_id').val(value_id); 
    console.log(value_id);
        customer_data(value_id)

  });

function customer_data(value_id) {
  $.ajax({
    url: '../customer_data'+'/'+value_id, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (data) {   
      $('#phone').val(data.mobile); 
      $('#email').val(data.email); 
    },
    error: function (data) {
    }
});
}
  // Form Validation
//.......................................

  // Phone Number
  // if (dtContact.length) {
  //   dtContact.each(function () {
  //     new Cleave($(this), {
  //       phone: true,
  //       phoneRegionCode: 'US'
  //     });
  //   });
  // }
  

  // $(document).on('keyup', '#pickup_address', function(){ 

  //   var x = document.getElementById("pickup_address");
  //   var response ='<iframe id="iframe" width="100%" height="400" zoom="7" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?q='+ x.value +'&output=embed"></iframe><hr>';
  //         $('#showmap').html(response);
  //  });

  //  var pickup_address = $("#selectedpickup_address").val();
  // if(pickup_address){
  //   var response ='<iframe id="iframe" width="100%" height="400" zoom="7" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?q='+ pickup_address +'&output=embed"></iframe><hr>';
  //         $('#showmap').html(response);
  //  }else{
  //    var response ='<iframe id="iframe" width="100%" height="400" zoom="7" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?q=india&amp;output=embed"></iframe><hr>';
  //         $('#showmap').html(response);
  //  }
    

     // Vanilla Javascript
  var input = document.querySelector("#phone");
  window.intlTelInput(input,({
    preferredCountries: ["ae"],
  }));

  $(document).ready(function() {
      $('.iti__flag-container').click(function() { 
          var countryCode = $('.iti__selected-flag').attr('title');
          var countryCode = countryCode.replace(/[^0-9]/g,'')
          $('#phone').val("");
          $('#phone').val("+"+countryCode+" "+ $('#phone').val());
      });
  });

  var input = document.querySelector("#merchant_Phone");
      window.intlTelInput(input,({
        preferredCountries: ["ae"],
      }));
      
      $(document).ready(function() {
          $('.iti__flag-container').click(function() { 
              var countryCode = $('.iti__selected-flag').attr('title');
              var countryCode = countryCode.replace(/[^0-9]/g,'')
              $('#merchant_Phone').val("");
              $('#merchant_Phone').val("+"+countryCode+" "+ $('#merchant_Phone').val());
          });
      });

      $(document).ready(function() {
        var input = document.querySelector("#phone");
      window.intlTelInput(input,({
          preferredCountries: ["ae"],
      }));
      
          $('.iti__flag-container').click(function() { 
              var countryCode = $('.iti__selected-flag').attr('title');
              var countryCode = countryCode.replace(/[^0-9]/g,'')
              $('#phone').val("");
              $('#phone').val("+"+countryCode+" "+ $('#phone').val());
          });
      });
  
});
