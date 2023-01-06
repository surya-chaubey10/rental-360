/*=========================================================================================
    File Name: app-invoice-list.js
    Description: app-invoice-list Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  var dtInvoiceTable = $('.statement-table'),
    assetPath = '../../../app-assets/',
    invoicePreview = 'app-invoice-preview.html',
    invoiceAdd = 'app-invoice-add.html';
   
    

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    invoicePreview = assetPath + 'app/invoice/preview';
    invoiceAdd = assetPath + 'app/invoice/add';

  }
  $(document).on('click', '#statement_details', function(){ 
   
    $('#refunded').hide();
    $('#refund_p').hide();
    var id=$(this).attr('data-id');
    
    $.ajax({
      url: 'transaction_details'+'/'+id,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (response) {
      
        var $date= (response.created_at);
        const d = new Date($date).toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
        $('#transaction_id').text(response.id);
        $('#transaction_id9').text(response.id);
        $('#transaction_id1').text(response.id);
        $('#transaction_id123').text(response.id);
        $('#transaction_referance123').text(response.tran_ref);
        $('#status_label123').text(response.payment_code);
        $('#transaction_type123').text(response.tran_type);
        $('#cart_amount_currency123').text(response.cart_amount);
        $('#transaction_cart_id123').text(response.cart_id);
        $('#transaction_status123').text(response.payment_status);
        $('#payment_description123').text(response.comment);
        $('#transaction_description123').text(response.description);
        $('#phone234').text(response.phone);
        $('#transaction_invoice_no123').text(response.invoice_id);
        $('#c_email123').text(response.email);
        $('#name1234').text(response.full_name);  
 
       $('#transaction_referance').text(response.tran_ref);
       $('#transaction_referance9').text(response.tran_ref);
       $('#transaction_referance1').text(response.tran_ref);
       $('#status_label1').text(response.payment_code);
       $('#status_label').text(response.payment_code);
       $('#status_label9').text(response.payment_code);
       $('#transaction_type').text(response.tran_type);
       $('#transaction_type9').text(response.tran_type);
       $('#transaction_type1').text(response.tran_type);
       $('#cart_amount_currency').text(response.cart_amount);
       $('#cart_amount_currency9').text(response.cart_amount);
       $('#cart_amount_currency1').text(response.cart_amount);
       $('#transaction_cart_id').text(response.cart_id);
       $('#transaction_cart_id9').text(response.cart_id);
       $('#transaction_cart_id1').text(response.cart_id);
       $('#transaction_status1').text(response.payment_status);
       $('#transaction_status').text(response.payment_status);
       $('#transaction_status9').text(response.payment_status);
       $('#transaction_resp_msg').text(response.response_code);
       $('#transaction_resp_msg9').text(response.response_code);
       $('#transaction_date1').text(response.transaction_time);
       $('#payment_description1').text(response.comment);
       $('#transaction_description1').text(response.description);
       $('#phone2').text(response.phone);
       $('#address123').text(response.street);
       $('#c_country123').text(response.country);
       $('#transaction_date123').text(d);
     
       $('#transaction_resp_msg1').text(response.response_code);
       $('#transaction_invoice_no').text(response.invoice_id);
       $('#transaction_invoice_no9').text(response.invoice_id);
       $('#transaction_invoice_no1').text(response.invoice_id);
       $('#payment_description').text(response.payment_description);
       $('#payment_description9').text(response.payment_description);
       $('#payment_description1').text(response.payment_description);
       $('#card_type').text(response.card_type);
       $('#card_type9').text(response.card_type);
       $('#card_type1').text(response.card_type);
       $('#status_idss').text(response.status == 1 ? 'P' : 'A');
       $('#card_scheme').text(response.payment_method);
       $('#card_scheme9').text(response.payment_method);
       $('#card_scheme1').text(response.payment_method);
       $('#name').text(response.name);  
       $('#name9').text(response.name);  
       $('#name12').text(response.full_name);  
       $('#c_email').text(response.email);
       $('#c_email9').text(response.email);
       $('#c_email1').text(response.email);
       $('#address').text(response.street);
       $('#address9').text(response.street);
       $('#address1').text(response.street);
       $('#c_country').text(response.country);
       $('#c_country9').text(response.country);
       $('#c_country1').text(response.country);
       $('#c_state').text(response.state);
       $('#c_state9').text(response.state);
       $('#sub_total').text(response.subtotal);
       $('#sub_total9').text(response.subtotal);
       $('#discount').text(response.subtotal_discount);
       $('#discount9').text(response.subtotal_discount);
       $('#shipping_charges').text(response.delivery_charge);
       $('#shipping_charges9').text(response.delivery_charge);
       $('#grand_totalsss').text(response.grand_total);
       $('#grand_totalsss9').text(response.grand_total);
       $('#transaction_invoice_ref').text(response.invoice_ref);
       $('#transaction_invoice_ref9').text(response.invoice_ref);
       $('#transaction_invoice_ref1').text(response.invoice_ref);
       $('#transaction_customer_ref').text(response.customer_ref);
       $('#transaction_customer_ref1').text(response.customer_ref);
       $('#transaction_description').text(response.inv_description);
       $('#transaction_description9').text(response.inv_description);
       $('#transaction_description1').text(response.inv_description);
       $('#expiryMonth1').text(response.expiry_month);
       $('#expiryMonth').text(response.expiry_month);
       $('#expiryMonth9').text(response.expiry_month);
       $('#expiryYear').text(response.expiry_year);
       $('#expiryYear9').text(response.expiry_year);
       $('#expiryYear1').text(response.expiry_year);
       $('#transaction_date').text(d);
       $('#transaction_date9').text(d);
  
       $('#hidden_name').val(response.name); 
      //  $('#availables_bal').val(response.balance); 
       $('#hidden_cart_id').val(response.cart_id);
       $('#hidden_cart_amount').val(response.cart_amount);
       $('#hidden_tran_ref').val(response.tran_ref);
       $('#hidden_id').val(response.id);
       $('#hidden_email').val(response.email);
       $('#hidden_phone').val(response.phone);
       $('#hidden_currency').val(response.cart_currency);
       $('#hidden_booking').val(response.booking); 
       $('#hidden_invoice_id').val(response.invoice_id);
       $('#hidden_total_amount').val(response.cart_amount);
       $('#hidden_tran_type').val(response.tran_type);
  
      },
      error: function (response) {
        
      }
    }) 
 
}); 

$(document).on('click', '#statement_details', function(){ 

  var id=$(this).attr('data-id');
  $('#refunded').hide();
  $('#refund_p').hide();

    $.ajax({
    url: 'invoice_details_data'+'/'+id,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (response) {
      $('#tbodyss').html(response.html);
      $('#tbody').html(response.html);
      
      },
    error: function (response) {
      
    }
  }) 


}); 

/* $(document).on('click', '#url_copy', function(){ 

  var id=$('#payment_link').val();
  
    alert(id);


});  */

  
});
