 

$(document).ready(function (){
    ('use strict');
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     })

    var formBlock = $('.btn-form-block');
    var newUserForm = $('.add-manage-booking');

    
    $(document).on('change', '.select_vehicle', function () {

        var value_id = $(this).val();
        var model_id = 0;
        $('#brand_id').val(value_id);
        $('#selectbrand_id').val(value_id);
          
              brandmodel(value_id,model_id) 
              $("#select_sku").html('<option value="" ></option>');
    });

    $(document).on('change', '.select_marchantvehicle', function () {
           
        const value_id = $(this).val();
        const model_id = 0;
        $('#brand_id').val(value_id);
        $('#selectbrand_id').val(value_id);
          
              marchantbrandmodel(value_id,model_id) 
        });

    // filter brand on change start 
    $(document).on('change', '.filter_vehicle', function () {

        var value_id = $(this).val();
        var model_id = 0;

        $(function() {
            $("#select_vehicle option").each(function(i){
                (value_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });

        $(function() {
            $("#mselect_vehicle option").each(function(i){
                (value_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });
          
        filterbrandmodel(value_id,model_id) 
        brandmodel(value_id,model_id)

        $("#filter_sku").html('<option value="" ></option>');

    });
    // filter brand on change end 

    $(document).on('change', '.select_model', function () {

        var value_id = $(this).val();
        var sku = 0;
        var pickup_date_time=$('#pickup_date_time').val();
        var drop_off_date_time=$('#drop_off_date_time').val();
        var from_date = new Date(pickup_date_time).toLocaleDateString('fr-CA');
        var to_date = new Date(drop_off_date_time).toLocaleDateString('fr-CA');

        check_fleet(value_id,sku,from_date,to_date) 
              
              
    });


    // filter model on change start 
    $(document).on('change', '.filter_model', function () {

        var modal_id = $(this).val();

        $(function() {
            $("#select_model option").each(function(i){
                (modal_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });

        $(function() {
            $("#mselect_model option").each(function(i){
                (modal_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });

        get_filter_fleet(modal_id) 


        
    });
    // filter model on change end 



    $(document).on('change', '.select_sku', function () {

        var value_id = $("#select_sku option:selected").text();
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

    // -------------- Filter function start from here---------------------

        // getting filter model based on brand filter start 
        function filterbrandmodel(value_id,model_id) {
            $.ajax({
            url: '../brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false,
            cache : false, 
            processData: false,
            success: function (data) {   
                    $('.filter_model').html(data.html);
            },
            error: function (data) {
            }
        });
        }
        // getting filter model based on brand filter end 


        // getting filter model based on brand filter start 

        function get_filter_fleet(modal_id) {

            $.ajax({
            url: '../get_filter_model_fleet'+'/'+modal_id, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false,
            cache : false, 
            processData: false,
            success: function (data) {   
                    $('.filter_sku').html(data.html);
            },
            error: function (data) {
            }
        });
        }

        // getting filter model based on brand filter end 


    // -------------- Filter function end here---------------------



    function check_fleet(value_id,fleet_id,pickup_date_time,drop_off_date_time) {

        $.ajax({
          url: '../get_available_fleet'+'/'+value_id+'/'+fleet_id+'/'+pickup_date_time+'/'+drop_off_date_time, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
                $('.select_sku').html(data.html);
          },
          error: function (data) {
          }
      });
    }


    $(document).ready(function(){
        $(".inlineRadio1").click(function(){
          var value_id = $(this).val();
          if(value_id == 1){
            $('#merchant').hide(); 
            $('#auto_dispached').show(); 
            
          }else{
            $('#merchant').show(); 
            $('#auto_dispached').hide(); 
          }
        });
    });


    function customer_data(value_id) {
        $.ajax({
          url: '../../customer_data'+'/'+value_id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
            $('#phone').val(data.mobile); 
            $('#email').val(data.email); 
          },
          error: function (data) {
          }
      });
    }


    $(document).ready(function(){
        $('#select_customer1').on('keyup',function () {
            var query = $(this).val();
            $.ajax({
                url:'customer_auto_suggestion',
                type:'GET',
                data:{'name':query},
                success:function (data) {
                    $('#customer_list').html(data);
                }
            }) 
        });
        $(document).on('click', '#customer_ul li', function(){
            var value = $(this).text();
            var id = $(this).data('id');

            // $('#select_customer1').val(value);
            
            $('#select_customer_n').val(value);
            // $('#select_customer1').attr('data-id',id);
            $('#customer_list').html(""); 
            $('#select_customer').val(id);
            customer_data(id) ;

            $('#select_customer1').val('');  
        });


        // $('#fleets_search').on('keyup',function () {
        //     var query = $(this).val();
        //     $.ajax({
        //         url:'fleets_auto_suggestion',
        //         type:'GET',
        //         data:{'name':query},
        //         success:function (data) {
        //             $('#fleet_list').html(data);
        //         }
        //     }) 
        // });


        $('#clear').click(function() {
            location.reload();
        });



    });


    // $(document).ready(function(){
    //     $('.merchant_sku').on('keyup',function () {
    //         var query = $(this).val();
    //         $.ajax({
    //             url:'marchantsku_auto_suggestion',
    //             type:'GET',
    //             data:{'name':query},
    //             success:function (data) {
    //                 $('#opensku_list').html(data);
    //             }
    //         }) 
    //     }); 
    //     $(document).on('click', '#sku_ul li', function(){
    //         var value = $(this).text();
    //         var id = $(this).data('id');
    //         var model_id = $(this).data('model');
    //         var brand_id = $(this).data('brand');
           
    //         $('#opensku_list').html('');
    //         $('#merchant_sku').val(value); 
    //         $('#merchant_sku_id').val(id);
    //         $('#merchant_sku_brand').val(brand_id);
    //         $('#merchant_sku_model').val(model_id);
            
    //     });
    // });




     
    // $(document).on('click', '#submit', function (e) {

    //     // Form validation and save through ajax code start here.

    //     var phone = $('#phone').val();
    //     var pickup_date_time = $('#pickup_date_time').val();
    //     var drop_off_date_time = $('#drop_off_date_time').val();
    //     var pickup_time = $('#pickup_time').val();
    //     var drop_off_time = $('#drop_off_time').val();
    //     var select_driver = $('#select_driver').val();

    //     var no_of_traveller = $('#no_of_traveller').val();
    //     var pickup_address = $('#pickup_address').val();
    //     var dropoff_address = $('#dropoff_address').val();
    //     var merchantName = $('#merchantName').val();
    //     var merchantPhone = $('#merchantPhone').val();
    //     // var merchant_sku = $('#merchant_sku').val();

    //     var select_vehicle = $('#select_vehicle').val();
    //     var select_model = $('#select_model').val();  
    //     var select_sku = $('#select_sku').val();

    //     var noteTextarea = $('#noteTextarea').val();
    //     var mselect_vehicle = $('#mselect_vehicle').val();
    //     var mselect_model = $('#mselect_model').val();
    //     var mcomment = $('#mcomment').val();

    //     //Blank text in span error field
    //    $('#phone_error').html("");
    //    $('#pickup_date_time_error').html("");
    //    $('#drop_off_date_time_error').html("");
    //    $('#pickup_time_error').html("");
    //    $('#drop_off_time_error').html("");
    //    $('#select_driver_error').html("");

    //    $('#no_of_traveller_error').html("");
    //    $('#pickup_address_error').html("");
    //    $('#dropoff_address_error').html("");
    //    $('#merchantName_error').html("");
    //    $('#merchantPhone_error').html("");
    // //    $('#merchant_sku_error').html("");
    //    $('#select_vehicle_error').html("");
    //    $('#select_model_error').html("");   
    //    $('#select_sku_error').html("");
    //    $('#noteTextarea_error').html("");   

    //    $('#mcomment_error').html("");
    //    $('#mselect_vehicle_error').html("");
    //    $('#mselect_model_error').html("");   

    //     // Applying Validations Here
    //     if(!phone || !$.trim(phone).length)
    //     {

    //         $('#phone_error').html("The phone field is required");
    //         return $('#phone').focus(); 
    //     }
    //     else if(!pickup_date_time || !$.trim(pickup_date_time).length)
    //     {
    //         $('#pickup_date_time_error').html("The pickup date field is required");
    //         return $('#pickup_date_time').focus(); 
    //     }
    //     else if(!drop_off_date_time || !$.trim(drop_off_date_time).length)
    //     {
    //         $('#drop_off_date_time_error').html("The drop-off date field is required");
    //         return $('#drop_off_date_time').focus(); 
    //     }
    //     else if(!pickup_time || !$.trim(pickup_time).length)
    //     {
    //         $('#pickup_time_error').html("The pickup time field is required");
    //         return $('#pickup_time').focus(); 
    //     }
    //     else if(!drop_off_time || !$.trim(drop_off_time).length)
    //     {
    //         $('#drop_off_time_error').html("The drop-off date field is required");
    //         return $('#drop_off_time').focus(); 
    //     }
    //     else if(!select_driver || !$.trim(select_driver).length)
    //     {
    //         $('#select_driver_error').html("The drop-off date field is required");
    //         return $('#select_driver').focus(); 
    //     }
    //     else if(!no_of_traveller || !$.trim(no_of_traveller).length)
    //     {
    //         $('#no_of_traveller_error').html("The drop-off date field is required");
    //         return $('#no_of_traveller').focus(); 
    //     }
    //     else if(!pickup_address || !$.trim(pickup_address).length)
    //     {
    //         $('#pickup_address_error').html("The drop-off date field is required");
    //         return $('#pickup_address').focus(); 
    //     }
    //     else if(!dropoff_address || !$.trim(dropoff_address).length)
    //     {
    //         $('#dropoff_address_error').html("The drop-off date field is required");
    //         return $('#dropoff_address').focus(); 
    //     }


    //     if($('input[name="inlineRadioOptions"]:checked').val() == 1){

    //         if(!select_vehicle || !$.trim(select_vehicle).length)
    //         {
    //             $('#select_vehicle_error').html("The brand field is required");
    //             return $('#select_vehicle').focus(); 
    //         }
    //         else if(!select_model || !$.trim(select_model).length)
    //         {
    //             $('#select_model_error').html("The model field is required");
    //             return $('#select_model').focus(); 
    //         }
    //         else if(!select_sku || !$.trim(select_sku).length)
    //         {
    //             $('#select_sku_error').html("The SKU field is required");
    //             return $('#select_sku').focus(); 
    //         }
    //         else if(!noteTextarea || !$.trim(noteTextarea).length)
    //         {
    //             $('#noteTextarea_error').html("The textarea field is required");
    //             return $('#noteTextarea').focus(); 
    //         }
    //     }

    //     if($('input[name="inlineRadioOptions"]:checked').val() == 2){

    //         if(!merchantName || !$.trim(merchantName).length)
    //         {
    //             $('#merchantName_error').html("The merchant name field is required");
    //             return $('#merchantName').focus(); 
    //         }
    //         else if(!merchantPhone || !$.trim(merchantPhone).length)
    //         {
    //             $('#merchantPhone_error').html("The phone field is required");
    //             return $('#merchantPhone').focus(); 
    //         }
    //         // else if(!merchant_sku || !$.trim(merchant_sku).length)
    //         // {
    //         //     $('#merchant_sku_error').html("The SKU field is required");
    //         //     return $('#merchant_sku').focus(); 
    //         // }
    //         else if(!mselect_vehicle || !$.trim(mselect_vehicle).length)
    //         {
    //             $('#mselect_vehicle_error').html("The brand field is required");
    //             return $('#mselect_vehicle').focus(); 
    //         }
    //         else if(!mselect_model || !$.trim(mselect_model).length)
    //         {
    //             $('#mselect_model_error').html("The model field is required");
    //             return $('#mselect_model').focus(); 
    //         }
    //         else if(!mcomment || !$.trim(mcomment).length)
    //         {
    //             $('#mcomment_error').html("The comment field is required");
    //             return $('#mcomment_error').focus(); 
    //         }
    //         else if(!noteTextarea || !$.trim(noteTextarea).length)
    //         {
    //             $('#noteTextarea_error').html("The textarea field is required");
    //             return $('#noteTextarea').focus(); 
    //         }

    //     }




    
    //     if (!e.isDefaultPrevented()) {
    //         e.preventDefault()
    
    //         $( "#submit" ).prop( "disabled", true );

    //         let formData = new FormData($('#booking_form')[0])
    //         $.ajax({
    //               url: 'save_manage_booking', // JSON file to add data,
    //               type: 'POST',
    //               dataType: 'json',
    //               data: formData,
    //               contentType: false,
    //               cache : false, 
    //               processData: false,
    //               success: function (data) {  
     
    //                   $( "#submit" ).prop( "disabled", false );
    //                   if (data.status === true) {
    //                         $('#btnClose').click();
    //                       toastr['success'](''+data.message+'', {
    //                         closeButton: true,
    //                         tapToDismiss: false,
    //                         rtl: isRtl 
    //                       });
    //                     //   window.location = "/create_invoice" + '/' + data.data.uuid;  
    //                       //  window.location = "/manage-booking-list" ;  
    //                   } else if (data.status === false) {
    //                     $( "#submit" ).prop( "disabled", false );
    //                     toastr['error'](''+data.message+'', {
    //                       closeButton: true,
    //                       tapToDismiss: false,
    //                       rtl: isRtl
    //                     });
                         
    //                   }
    //               },
    //               error: function (data) {
    //                 $( "#submit" ).prop( "disabled", false );
    //                 toastr['error'](''+data.message+'', {
    //                   closeButton: true,
    //                   tapToDismiss: false,
    //                   rtl: isRtl
    //                 });
    //               }
    //           }) 
    //       }
    // });

    // Form validation and save code end here.

    // document.getElementById("filter_submit").addEventListener("click", displayDate);

    // function displayDate() {
    //   var brandId = $('#filter_vehicle').val();
    //   alert(brandId);
    //   calendar.refetchEvents();
    // }

    // Vanilla Javascript----------------------------------------------------
// var input = document.querySelector("#phone");
// window.intlTelInput(input,({
//     preferredCountries: ["ae"],
// }));    

// $(document).ready(function() {
//     $('.iti__flag-container').click(function() { 
//         var countryCode = $('.iti__selected-flag').attr('title');
//         var countryCode = countryCode.replace(/[^0-9]/g,'')
//         $('#phone').val("");
//         $('#phone').val("+"+countryCode+" "+ $('#phone').val());
//     });
// });

// var input = document.querySelector("#phones");
// window.intlTelInput(input,({
//     preferredCountries: ["ae"],
// })); 
// $(document).ready(function() {
//     $('.iti__flag-container').click(function() { 
//         var countryCode = $('.iti__selected-flag').attr('title');
//         var countryCode = countryCode.replace(/[^0-9]/g,'')
//         $('#phones').val("");
//         $('#phones').val("+"+countryCode+" "+ $('#phones').val());
//     });
// });
 
// var input = document.querySelector("#merchantPhone");
// window.intlTelInput(input,({
//     preferredCountries: ["ae"],
// }));  
  

// $(document).ready(function() {
//     $('.iti__flag-container').click(function() { 
//         var countryCode = $('.iti__selected-flag').attr('title');
//         var countryCode = countryCode.replace(/[^0-9]/g,'')
//         $('#merchantPhone').val("");
//         $('#merchantPhone').val("+"+countryCode+" "+ $('#merchantPhone').val());
//     });
// });

// const phoneInputField = document.querySelector("#phone");
// const phoneInputField2 = document.querySelector("#phone_num");
// const phoneInputField3 = document.querySelector("#merchantPhone");
// const phoneInput = window.intlTelInput(phoneInputField, {preferredCountries: ["ae"]});
// const phoneInput2 = window.intlTelInput(phoneInputField2, {preferredCountries: ["ae"]}); 
// const phoneInput2 = window.intlTelInput(phoneInputField3, {preferredCountries: ["ae"]});
// window.addEventListener('load', function() {
//   // Get the forms we want to add validation styles to
//   var forms = document.getElementsByClassName('needs-validation');
//   // Loop over them and prevent submission
//   var validation = Array.prototype.filter.call(forms, function(form) {
//     form.addEventListener('submit', function(event) {
//       if (form.checkValidity() === false) {
//         event.preventDefault();
//         event.stopPropagation();
//       }
//       form.classList.add('was-validated');
//     }, false);
//   });
// }, false);
// $(document).ready(function() {
//   $('.smsForm .iti__flag-container').click(function() { 
//     var countryCode = $('.smsForm .iti__selected-flag').attr('title');
//     var countryCode = countryCode.replace(/[^0-9]/g,'');
//     $('#phone').val("");
//     $('#phone').val("+"+countryCode+" "+ $('#phone').val());
//   });


//   $('.merchantPhoneno .iti__flag-container').click(function() { 
//     var countryCode = $('.merchantPhoneno .iti__selected-flag').attr('title');
//     var countryCode = countryCode.replace(/[^0-9]/g,'');
//     $('#merchantPhone').val("");
//     $('#merchantPhone').val("+"+countryCode+" "+ $('#merchantPhone').val());
//   });

//   $('.whatsappForm .iti__flag-container').click(function() {
//     var countryCode = $('.whatsappForm .iti__selected-flag').attr('title');
//     var countryCode = countryCode.replace(/[^0-9]/g,'');
//     $('#phone_num').val("");
//     $('#phone_num').val("+"+countryCode+" "+ $('#phone_num').val());
//   });
// });


});





