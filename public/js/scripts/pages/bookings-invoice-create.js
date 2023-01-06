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
  
     
     var i = 1;
     $(document).on('click', '.add_row', function () {

        var sku = $('#sku_set').val();
        var sku_id = $('#sku_id').val();
        var description = $('#description_set').val(); 
        var price = $('#price_set').val();
 
         $('#addr' + i).html("<td colspan='2' ><input type='hidden' name='sku1[]' class='form-control sku' value='"+sku+"'/><input type='hidden' name='sku[]' class='form-control sku'  value='"+sku_id+"'/><input type='text' name='description[]'   class='form-control input-md description'  value='"+description+"'/></td><td><input type='text' name='unit_price[]' class='form-control input-md price' value='"+price+"'  /></td><td><input type='text' name='quantity[]' value='' class='form-control input-md period'/></td><td><input type='text' name='discount[]' value='0'  class='form-control input-md discount'/></td><td><input type='text' name='tax[]' value='0'  class='form-control input-md tax'/></td><td><input type='text' name='total[]' value='0' class='form-control input-md total'readonly/></td><td><button type='button' name='remove' id='"+i+"' class='btn btn-danger btn_remove btn-sm'>"+feather.icons['trash-2'].toSvg({ class: 'font-medium-4' })+"</button></td>");
 
         $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');


         i++;
     });

   
    $(document).on('click', '.btn_remove', function(){ 
        i--;
        var button_id = $(this).attr("id"); 
        $('#addr'+button_id+'').remove(); 
         
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
        
        totalprice  = ((price * period) - discount); 

        total = (parseFloat(totalprice) * tax) / parseFloat(100);

        $(this).parents('tr').find(".total").val(parseFloat(total) + parseFloat(totalprice));
 
        
         //Calculate Total in footer

            

         $(".head tr").each(function () {

            total_amt +=  parseInt( ( isNaN($(this).find(".total").val() ) ? '0' : $(this).find(".total").val() ) );

            discount_amt += parseInt( ( isNaN( $(this).find(".discount").val() ) ? '0' : $(this).find(".discount").val() ) );

            if(isNaN(discount_amt)){
                discount_amt = 0;
            }


        });  


        $(".sub_total").val(total_amt);
        $(".footer_discount").val(discount_amt);
        
        $(".grand_total").val(parseFloat(total_amt) - parseFloat(discount_amt));

    });
    

    $("#deliveryCharge").keyup(function () {
         deliveryCharge = parseFloat(this.value);
        var subTotal_amt =  $("#subTotal").val();
        var footer_discount_amt =  $("#footer_discount").val();

        if(isNaN(deliveryCharge)){
            deliveryCharge = 0;
       }
       console.log(deliveryCharge);
        
      grandtotal = (parseFloat(deliveryCharge) + parseFloat(subTotal_amt)) - parseFloat(footer_discount_amt);
     
      $("#grandTotal").val(grandtotal);

    });
     

    $(document).on('click', '.PromotionRadio1', function(){ 

        var radio_value = $(this).val(); 
        alert(radio_value);   
       if(radio_value==1){
          document.getElementById("promotion_radio").checked = false;
          document.getElementById("promotion_code").disabled = true;
          $('#promotion_radio').val(0);
          $('#promotion_code').val(" ");
       }else{ 
          document.getElementById("promotion_radio").checked = true;
          document.getElementById("promotion_code").disabled = false;
          $('#promotion_radio').val(1);
       }
         
    });
    
    // $("#promotion_code").keyup(function () {
    //    var code =  $(this).val();
    //    alert(code);
    //    $.ajax({
    //    url: '../../get-promotion'+'/'+code, // JSON file to add data,
    //     type: 'get',
    //     dataType: 'json',
    //     contentType: false,
    //     processData: false,
    //     success: function (data) { 
          
    //     },
    //     error: function (data) {
    //     }
    //  })

    // });

  });
  