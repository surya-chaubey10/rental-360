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
  
     newUserForm = $('.add-manage-booking-invoice-update'); //here 
     var i = $('#incr').val();
     $(document).on('click', '.add_row', function () {
        i++;
     
        var sku = $('#sku_set').val();
        var sku_id = $('#sku_id').val();
        var description = $('#description_set').val();   
        var price = $('#price_set').val();   

         $('#addr' + i).html("<td colspan='2'><input type='hidden'  class='form-control sku1'  value='"+sku+"'/><input type='hidden' name='sku[]' class='form-control sku'  value='"+sku_id+"'/> <input type='text' name='description[]'   class='form-control input-md description1'  value=''/><div id='list"+i+"' class='list'></div></td><td><input type='text' name='unit_price[]' class='form-control input-md price' id='price"+i+"' value='0'  /></td><td><input type='text' name='quantity[]' value='' class='form-control input-md period'/></td><td><input type='text' name='discount[]' value='0'  class='form-control input-md discount'/><input type='hidden'  value='0' placeholder='discountamount' class='form-control discountamount'/></td><td><input type='text' name='tax[]' value='0'  class='form-control input-md tax'/></td><td><input type='text' name='total[]' value='0' class='form-control input-md total'readonly/></td><td><button type='button' name='remove' id='"+i+"' class='btn btn-danger btn_remove btn-sm'>"+feather.icons['trash-2'].toSvg({ class: 'font-medium-4' })+"</button></td>");
  
         $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
         
     });


     $('tbody').delegate('.description1','keyup',function(){   
      var query = $(this).val();
      var fleet = $('.sku1').val();
      var tr=$(this).parent().parent(); 
      var row1 = tr.find('.list').attr("id"); 
      $.ajax({
              url:'/description_auto_suggestion',
              type:'GET',
              data:{'description1':query,
                      'fleet':fleet}, 
                  success:function (data) {
                  $('#'+row1+'').html(data);            
              }
            })  
    }); 

    $('tbody').delegate('li','click', function(){   
     
        var value = $(this).text();
        var id = $(this).data('id'); 
        var fleet = $('.sku1').val(); 
        var row1 = $(this).parents('tr').find(".list").attr("id");
        var pricerow = $(this).parents('tr').find(".price").attr("id");
        $(this).parents('tr').find(".description1").val(value);
        $('#'+row1+'').html("");
        $.ajax({
          url: '/description_price'+'/'+fleet+'/'+id, // JSON file to add data, 
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
            $('#'+pricerow+'').val(data);
          },
          error: function (data) {
          }
      });
    }); 
   
    $(document).on('click', '.btn_remove', function(){ 
        i--;
        var button_id = $(this).attr("id"); 
        $('#addr'+button_id+'').remove(); 
         
        var total_amt = 0;
        var to_discount_amt = 0; 
        $(".head tr").each(function () {  

          total_amt +=  parseFloat( ( isNaN($(this).find(".total").val() ) ? '0' : $(this).find(".total").val() ) );

          to_discount_amt += parseFloat( ( isNaN( $(this).find(".discountamount").val() ) ? '0' : $(this).find(".discountamount").val() ) );

          if(isNaN(to_discount_amt)){
            to_discount_amt = 0;
          }
        });  
        $(".sub_total").val(total_amt);
        $(".footer_discount").val(to_discount_amt);
        var promotion= $("#footer_promotion").val();
        var deliveryCharge=$(".delivery_charge").val();
        if(isNaN(deliveryCharge)){
          deliveryCharge = 0;
        }

        $(".grand_total").val(parseFloat(total_amt) + parseFloat(deliveryCharge) - parseFloat(promotion));

    }); 


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

              let formData = new FormData($('#booking_form_invoice-update')[0])
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
                  url: '../save_booking_invoice_update', // JSON file to add data,
                  type: 'POST',
                  dataType: 'json',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function (data) {  
     
                      $( "#submit" ).prop( "disabled", false );
                      if (data.status === true) {
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

    $('tbody').delegate('.period, .price, .discount, .tax','keyup',function(){
        
        var price = 0;
        var totalprice = 0; 
        var period = 0;
        var discount = 0;
        var tax = 0;
        var total = 0;
        var total_amt = 0;
        var discount_amt = 0;
        var grandtotal = 0;
        var to_discount_amt = 0;
         
        var tr=$(this).parent().parent();

        price = parseFloat( tr.find('.price').val() );
        period = parseFloat( $(this).parents('tr').find(".period").val() );
        discount = parseFloat( $(this).parents('tr').find(".discount").val() );
        tax = parseFloat( $(this).parents('tr').find(".tax").val() );

        
        if(isNaN(price)){
            price = 0.00;
        }
        if(isNaN(period)){
            period = 0;
        }
        if(isNaN(discount)){
            discount = 0.00;
        }
        if(isNaN(tax)){
            tax = 0;
        }
        
        discount_amt = ((price * period) * discount) / parseFloat(100);
        totalprice  = ((price * period) - discount_amt); 

        total = (parseFloat(totalprice) * tax) / parseFloat(100);

        $(this).parents('tr').find(".total").val(parseFloat(total) + parseFloat(totalprice));
        $(this).parents('tr').find(".discountamount").val(parseFloat(discount_amt));

         //Calculate Total in footer

         $(".head tr").each(function () {
            total_amt +=  parseFloat( ( isNaN($(this).find(".total").val() ) ? '0' : $(this).find(".total").val() ) );

            to_discount_amt += parseFloat( ( isNaN( $(this).find(".discountamount").val() ) ? '0' : $(this).find(".discountamount").val() ) );

            if(isNaN(to_discount_amt)){
                to_discount_amt = 0;
            }
            
        });  

        $(".sub_total").val(total_amt);
        $(".footer_discount").val(to_discount_amt);
        var promotion= $("#footer_promotion").val();
        var deliveryCharge=$(".delivery_charge").val();
        if(isNaN(deliveryCharge)){
          deliveryCharge = 0;  
        }
        $("#grandTotal").val(parseFloat(total_amt) + parseFloat(deliveryCharge) - parseFloat(promotion));

    });
  

    $("#deliveryCharge").keyup(function () {
         deliveryCharge = parseFloat(this.value);
        var subTotal_amt =  $("#subTotal").val();
        var footer_discount_amt =  $("#footer_discount").val();
        var promotion= $("#footer_promotion").val();

        if(isNaN(deliveryCharge)){
            deliveryCharge = 0;
       }
       console.log(deliveryCharge);
        
      grandtotal = (parseFloat(deliveryCharge) + parseFloat(subTotal_amt)) - parseFloat(promotion);
     
      $("#grandTotal").val(grandtotal);

    });


    $(document).on('click', '.PromotionRadio', function(){ 

      var radio_value = $(this).val(); 
      var total = $('#subTotal').val();
       if(radio_value==1){
          document.getElementById("promotion_radio").checked = false;
          document.getElementById("promotion_code").disabled = true;
          $('#promotion_radio').val(0);
          $('#promotion_code').val(" ");
          $("#promotion_type").val(0);
          $("#promotion_id").val(0);
          $("#footer_promotion").val(0.000);
          $("#grandTotal").val(total);
       }else{
          document.getElementById("promotion_radio").checked = true;
          document.getElementById("promotion_code").disabled = false;
          $('#promotion_radio').val(1);
       }
       
    }); 

      $("#promotion_code").keyup(function () {
        var code =  $(this).val();
        $.ajax({
        url: '../../get-promotion'+'/'+code, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) { 

          var total = $('#subTotal').val();
           $("#promotion_type").val(data.type);
           $("#promotion_id").val(data.id);

         if(data.type == 1){

             total = parseFloat(total) - parseFloat(data.value);
             $("#footer_promotion").val(data.value);
             $("#grandTotal").val(total);
         }else if(data.type == 2){

          var promotionvalue = (parseFloat(total) * data.value) / parseFloat(100);
              total = parseFloat(total) - parseFloat(promotionvalue);
             
              $("#footer_promotion").val(promotionvalue);
              $("#grandTotal").val(total);
         }else{
              $("#footer_promotion").val(0);
              $("#grandTotal").val(total);
         }
        },
        error: function (data) {
        }
        })
      });
  });
  