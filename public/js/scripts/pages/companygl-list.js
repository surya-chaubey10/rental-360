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

  var dtInvoiceTable = $('.gltable'),
    assetPath = '../../../app-assets/',
    invoicePreview = 'app-invoice-preview.html',
    select = $('.select2'),
    invoiceAdd = 'app-invoice-add.html';
   
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
      url: '/transaction_details'+'/'+id,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (response) {
       
        var $date= (response.created_at);
        const d = new Date($date).toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
        $('#transaction_id').text(response.id);
       $('#transaction_referance').text(response.tran_ref);
       $('#status_label').text(response.payment_code);
       $('#transaction_type').text(response.tran_type);
       $('#cart_amount_currency').text(response.cart_amount);
       $('#transaction_cart_id').text(response.cart_id);
       $('#transaction_status').text(response.payment_status);
       $('#transaction_resp_msg').text(response.response_code);
       $('#transaction_invoice_no').text(response.invoice_id);
       $('#payment_description').text(response.payment_description);
       $('#card_type').text(response.card_type);
       $('#status_idss').text(response.status == 1 ? 'P' : 'A');
       $('#card_scheme').text(response.payment_method);
       $('#name').text(response.name); 
       $('#comapany').text(response.org_name); 
       $('#c_email').text(response.email);
       $('#address').text(response.street);
       $('#c_country').text(response.country);
       $('#c_state').text(response.state);
       $('#sub_total').text(response.subtotal);
       $('#discount').text(response.subtotal_discount);
       $('#shipping_charges').text(response.delivery_charge);
       $('#grand_totalsss').text(response.grand_total);
       $('#transaction_invoice_ref').text(response.invoice_ref);
       $('#transaction_customer_ref').text(response.customer_ref);
       $('#transaction_description').text(response.tran_type);
       $('#expiryMonth').text(response.expiry_month);
       $('#expiryYear').text(response.expiry_year);
       $('#transaction_date').text(d);
  
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
