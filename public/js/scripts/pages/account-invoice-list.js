/**
 * DataTables Basic
 */

 $(function () {
  ('use strict');

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   })
  var dt_basic_table = $('.expenses-table'),
    assetPath = '../../../app-assets/';
    var statusObj = {
      1: { title: 'Approved', class: 'badge-light-success' },
      2: { title: 'Pending', class: 'badge-light-warning' },
      3: { title: 'Failed', class: 'badge-light-danger' }
  };
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }
// DataTable with buttons
  if (dt_basic_table.length) {
    var dt_basic = dt_basic_table.DataTable({
      ajax: assetPath + "data/account_invoice-json/" + org_id + "_account-invoice.json", 
       columns: [
          { data: 'tran_ref' }, 
          { data: 'name'},
          { data: 'tran_type' },
          { data: 'payment_method' }, 
          { data: 'cart_currency' },
          { data: 'cart_amount' },
          { data: 'created_at' }, 
          { data: 'payment_status' },
          { data: '' }
        ],
          columnDefs: [
      
            {
              targets: 0,
              render: function (data, type, full, meta) {
                var $transaction_ref = full['tran_ref'];
                var $id = full['tran_id'];
                var $invoiceid = full['id'];
                if($invoiceid==null){
                  return 'N/A';
                }else{
                 var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" data-invoice="'+$invoiceid+'" id="detailsss" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;">INV000'+ $invoiceid + '</a>';
                 return $rowOutput;
                }
              }
            } ,   
            {
              targets: 1,
              render: function (data, type, full, meta) {
                var $name = full['name']
                if($name==null){
                  return 'N/A';
                }else{
                return (
                  '<span class="text-nowrap">' + $name + "</span>"
              );
                } 
              }
            },
            {
              targets: 2,
              render: function (data, type, full, meta) {
                var $type = full['tran_type']
                if($type==null){
                   $NA='N/A';
                }
                if($type==null)
                {
                return (
                  '<span class="text-nowrap ">' + $NA + "</span>"
              );
            }
            else{
              return (
                '<span class="badge rounded-pill badge-light-primary">' + $type + "</span>"
            );
            }
              }
            },
            {
              targets: 3,
              render: function (data, type, full, meta) {
                var $payment_method = full['payment_method'];
                
                if($payment_method==null){
                  $payment_methodN='N/A';
                }
                if($payment_method==null)
                {
                  return (
                    '<span class="text-nowrap">' +$payment_methodN + "</span>"
                );
      
                }
                else{
                  return (
                    '<span class="badge rounded-pill badge-light-success">' + $payment_method + "</span>"
                );
                }
              
    
              }
            },
            {
              targets: 4,
              render: function (data, type, full, meta) {
                  var $currency_type = full['cart_currency'];
                  if($currency_type==null){
                    return 'N/A';
                  }else{
                  return (
                    '<span class="badge rounded-pill badge-light-success">' + $currency_type + "</span>"
                );
                  }
              }
            },
            {
              targets: 5,
              render: function (data, type, full, meta) {
                  var $amount = full['cart_amount'];
                  if($amount==null){
                    return 'N/A';
                  }else{
                  return (
                    '<span class="text-nowrap">' + $amount + "</span>"
                    );
                  }
              }
            },
            {
              targets: 6,
                render: function (data, type, full, meta) {
                  var $date = full['created_at'];
                  const d = new Date($date).toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
                  return (
                    '<span class="text-nowrap">' + d + "</span>"
                );
              }
            }, 
             {
              targets: 7,
              render: function (data, type, full, meta) {
                var $payment_status = full["payment_status"];
                
                if($payment_status == 'A' || $payment_status == 'H'){

                    return (
                      '<span class="badge rounded-pill ' +
                      statusObj[1].class +
                      '" text-capitalized>' +
                      statusObj[1].title +
                      "</span>"
                  );
                }else if($payment_status == 'V' || $payment_status == 'E' || $payment_status =='D'){
                      return (
                        '<span class="badge rounded-pill ' +
                        statusObj[3].class +
                        '" text-capitalized>' +
                        statusObj[3].title +
                        "</span>"
                    );
                }else{
                    return (
                      '<span class="badge rounded-pill ' +
                      statusObj[2].class +
                      '" text-capitalized>' +
                      statusObj[2].title +
                      "</span>"
                  );
                }
                 
              }
            },
            {
              // Actions
              targets: -1,
              title: 'Actions',
              orderable: false,
              render: function (data, type, full, meta) { 
                var $id = full['uuid'];  
                var $booking_uuid = full['booking_uuid'];  
                var edit ='invoice-edit/'+$id+'';
                var $short_link = full['short_link'];  
                var $mobile = full['phone'];  
                var tran_id = full["tran_id"];

                if(tran_id!=null){

                  if(full['tran_type']=='Sale'){

                    return ('<a id="charge" class="btn btn-sm btn-primary" data-toggle="tooltip" data-theme="dark" title="Charge">'+
                    '<input type="hidden" name="id" value="'+tran_id+'"><input type="hidden" name="name" value="'+full['name']+'"><input type="hidden" name="phone" value="'+$mobile+'"><input type="hidden" name="email" value="'+full['email']+'"><input type="hidden" name="country" value="'+full['country']+'"> <input type="hidden" name="token" value=""><input type="hidden" name="tran_ref" value="'+full['tran_ref']+'"><input type="hidden" name="currency" value="'+full['currency_type']+'"><input type="hidden" name="type" value="'+full['country']+'"><input type="hidden" name="tran_type" value="'+full['tran_type']+'"><input type="hidden" name="transaction_type" value="'+full['transaction_type']+'"><input type="hidden" name="cart_amount" value="'+full['cart_amount']+'"><input type="hidden" name="booking_id" value="'+full['booking_id']+'"><input type="hidden" name="cart_id" value="'+full['cart_id']+'">'+
                    feather.icons['minus-square'].toSvg({ class: 'font-small-4 me-50' }) +'</a>');

                  }else{
                    return('');


                  }
               

                }else{
                  return (
                    '<div class="btn-group">' +
                
                    '<a class="btn btn-sm">' 
                    +
                    feather.icons['mail'].toSvg({ class: 'font-small-5' }) 
                    +
                    '</a>'+
                    '<a href="'+ edit +'" class="btn btn-sm">' + 
                     feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                    '</a>'
                    +
                    '<a class="btn btn-sm dropdown-toggle hide-arrow"  data-bs-toggle="dropdown">' +
                    feather.icons['more-horizontal'].toSvg({ class: 'font-small-4' }) +
                    '</a>' +
                    '<div class="dropdown-menu dropdown-menu-end">' +
                    '<button class="dropdown-item getuuid" data-mobile="'+$mobile+'" data-id="'+$short_link+'"  data-value="'+$id+'" data-bs-toggle="modal" data-bs-target="#invoice_preview_popup">' +  feather.icons['credit-card'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Payment Link</button>'+
                    '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Delete Invoice</button>'+'<button class="dropdown-item mt_getuuidmanage"  data-invoiceid="'+$id+'"  data-value="'+$booking_uuid+'" data-bs-toggle="modal" data-bs-target="#manage">' + feather.icons['credit-card'].toSvg({ class: 'font-small-4 me-50' }) +'Manage Transcation</button></div>'+
                    '</div>' +
                    '</div>'
                  );
                }
                
              }
            } 
          ],
      order: [[1, 'desc']],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-md-6"i>' +
        '<"col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..'
      }

    });
  }

 
  $(document).on('click', '.mt_getuuidmanage', function () {

    var value_id = $(this).attr('data-value'); 
    var value_id2 = $(this).attr('data-invoiceid'); 
      
        $("#mt_getuuid").val(value_id);  
        $("#mt_getinvoiceuuid").val(value_id2); 
  });

  $(document).on('click', '.getuuid', function () {
     
    var value_id = $(this).attr('data-value');
    var shortlink = $(this).attr('data-id');
    var mobile = $(this).attr('data-mobile');
        $("#booking_uuid").val(value_id)
        // $("#shortlink").val(shortlink)
        // $("#cpyo").text(shortlink)
       $("#payment_link").html(shortlink)
        document.getElementById('payment_link').setAttribute('href',shortlink);
        $("#whatsapp").attr("href", "https://api.whatsapp.com/send?phone=" + mobile+ "&text=" + shortlink )
        $("#url_link").attr("href",shortlink)
    
  });

  $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id');
    const event= $(this);
      console.log(value_id);
      Swal.fire({
        title: 'Destroy Customer?',
        text: 'Are you sure you want to permanently remove this record?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {

          deleteRecord(value_id,event)
          
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: 'Cancelled',
            text: 'Your imaginary file is safe :)',
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
        }
      });
    });

    function deleteRecord(value_id,event) {
      $.ajax({
        url: 'invoice-delete'+'/'+value_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache : false, 
        processData: false,
        success: function (data) {
            if (data.status === true) {
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Your record has been deleted.',
                customClass: {
                  confirmButton: 'btn btn-success'
                } 
              }); 
              event.closest('tr').remove();
              // location.reload(true);
            } else if (data.status === false) { 
            }
        },
        error: function (data) { 
        }
    })
  }

$(document).on('click', '#detailsss', function(){ 

  var id=$(this).attr('data-invoice');
  
  $.ajax({
    url: 'invoice_details'+'/'+id, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (response) {
      if(response.refund_resp=='A'){
        
        $('#refunded').show();
        $('#refund_p').hide();
      }
      if(response.id==null){
        $('#refund_p').hide();
        $('#refunded').hide();
      }else{
        $('#refund_p').show();
        $('#refunded').hide();
      }
      if(response.tran_type=='refund'){
        $('#refund_p').hide();
      }
      
      var $date= (response.created_at);
      const d = new Date($date).toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
      $('#transaction_id').text(response.id);
      $('#type').text(response.tran_type);
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
     $('.invoice_id').val('1000'+response.invoiceid); 
     $('#c_email').text(response.email);
     $('#address').text(response.street);
     $('#c_country').text(response.country);
     $('#c_state').text(response.state);
     $('#name1').text(response.name);
     $('#address2').text(response.street);
     $('#phone1').text(response.phone);
     $('#email1').text(response.email);
     $('#inv_preview_note').text(response.note);
     
     
     const date = new Date(response.invoicedate).toLocaleDateString('en-us', {day: 'numeric', year:"numeric", month:"short"})
     $('.invoice_date').val(date);
     
     if(response.invoice_id==''){
      $('#sub_total').text(0);
      $('#discount').text(0);
      $('#shipping_charges').text(0);
      $('#grand_totalsss').text(0);
     }else{
     $('#sub_total').text(response.subtotal);
     $('#discount').text(response.subtotal_discount);
     $('#shipping_charges').text(response.delivery_charge);
     $('#grand_totalsss').text(response.grand_total);
     }
     $('#transaction_invoice_ref').text(response.invoice_ref);
     $('#transaction_customer_ref').text(response.customer_ref);
     $('#transaction_description').text(response.inv_description);
     $('#expiryMonth').text(response.expiry_month);
     $('#expiryYear').text(response.expiry_year);
     $('#transaction_date').text(d);
     
     $('#hidden_name').val(response.name); 
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

$(document).on('click', '#detailsss', function(){ 

var id=$(this).attr('data-invoice');

  $.ajax({
  url: 'get_invoice_details_data'+'/'+id, // JSON file to add data,
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

$('body').delegate('#refund_btn', 'click', function()
      {
          $('#r_name').val($(this).find('#hidden_name').val());
          $('#r_phone').val($(this).find('#hidden_phone').val());
          $('#r_amount').val($(this).find('#hidden_cart_amount').val());
          $('#refund_form').modal('show');
      });

    $('#refund').click(function()
      {
          var cart_id = $('#hidden_cart_id').val();
          var amount = $('#r_amount').val();
          var tran_ref = $('#hidden_tran_ref').val();
          const id = $('#hidden_id').val();
          var email = $('#hidden_email').val();
          var currency = $('#hidden_currency').val();
          var description = $('#r_description').val();
          var name = $('#hidden_name').val();
          var booking_id = $('#hidden_booking').val();
          var invoice_id = $('#hidden_invoice_id').val();
          var total_amount = $('#hidden_total_amount').val();
          var tran_type = $('#hidden_tran_type').val();

          if(!description || !$.trim(description).length)
          {
              $('#r_description_error').html('The reason filed is required');
              return $('#description').focus();
          }
          else if(description.length < 5)
          {
              $('#r_description_error').html('The reason must be atleast 5 characters.');
              return $('#description').focus();
          }
          else
          {
              $('#r_description_error').html("");
              Swal.fire({
                title: 'Confirm!',
                text: 'Confirm Refund This Transaction Amount?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                customClass: {
                  confirmButton: 'btn btn-primary',
                  cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
              }).then(function (result) {
                if (result.value) {
            
                    $.ajax({
                        url:"/refund-payment",
                        method:"POST",
                        data:{id, amount, cart_id,tran_ref, description, currency, email, booking_id, invoice_id, total_amount, tran_type, name},
                        beforeSend:function()
                        {
                       
                            // $('#refund').html(`${save_icon} @lang('translation.please_wait')`);
                            // $('#refund').attr('class',`${btn_primary }  ${spinner}`);
                            $('#refund').attr('disabled',true);
                        },

                        complete:function()
                        {
                            // $('#refund').html(`${save_icon} Refund`);
                            // $('#refund').attr('class',`${btn_primary }`);
                            $('#refund').removeAttr('disabled');
                        },
                        success:function(res)
                        {
                          console.log(res)
                            /* location.reload(true); */
                          
                            if(res.status == true )
                            {
                                Swal.fire({
                                  icon: 'success',
                                  text: ' '+res.message,
                                  customClass: {
                                    confirmButton: 'btn btn-error'
                                  } 
                                })
                            }
                            else{

                              Swal.fire({
                                icon: 'error',
                                text: ''+res.message,
                                customClass: {
                                  confirmButton: 'btn btn-error'
                                } 
                              })
                              $('#refund').removeAttr('disabled');
                                $("#refund_form").modal('hide');
                                $('#invoice_details').modal('hide');
                                // $.alert('Payment Refunded Successfully!');
                                DataTable.ajax.reload();
                            }
                             location.reload(true); 
                        },
                        error:function(xhr)
                        {
                            console.log(xhr.responseText);
                        }
                    });
                  
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                  Swal.fire({
                    title: 'Cancelled',
                    text: 'Your imaginary file is safe :)',
                    icon: 'error',
                    customClass: {
                      confirmButton: 'btn btn-success'
                    }
                  });
                }
              });
          }
      });
 
      var id = '';
      var token = '';
      var tran_ref = '';
      var charge_form_email = '';
      var transaction_type = '';
      var transaction_cart_amount = '';
      var transaction_currency = '';
      var booking_id = '';

      //TODO: Getting id and other data for charge payment form
      $('body').delegate('#charge', 'click', function()
      {
          id = $(this).find('input[name="id"]').val();
          token = $(this).find('input[name="token"]').val();
          tran_ref = $(this).find('input[name="tran_ref"]').val();
          var name = $(this).find('input[name="name"]').val();
          charge_form_email = $(this).find('input[name="email"]').val();
          var phone = $(this).find('input[name="phone"]').val();
          transaction_type = $(this).find('input[name="tran_type"]').val();
          transaction_cart_id = $(this).parent().find('input[name="cart_id"]').val();
          transaction_cart_amount = $(this).find('input[name="cart_amount"]').val();
          tran_count = $(this).find('input[name="cart_amount"]').val();
          transaction_currency = $(this).find('input[name="currency"]').val();
           booking_id = $(this).find('input[name="booking_id"]').val();
          $('#c_name').val(name);
          $('#phone').val(phone);
          $('#amount').val('');
          $('#description').val('');
          if(transaction_type == 'auth')
          {
              $('#amount').val(tran_count);
              $('#note').html(`One Time Charge Max Amount ${tran_count}`);
          }
          else
          {
              $('#note').html(``);
          }
          $('#charg_form').modal('show');
      });

      $('#save').click(function()
      {
          const amount = $('#amount').val();
          const cname = $('#c_name').val();
          const description = $('#description').val();
          const support_doc = document.getElementById('support_doc').files[0];

          //TODO: Applying Validations Here
          if(!amount)
          {
              $('#amount_error').html("amount required");
              return $('#amount').focus();
          }
          else if(amount <= 0)
          {
              $('#amount_error').html("amount length");
              return $('#amount').focus();
          }
          else if(transaction_type === 'auth' && parseFloat(amount) > parseFloat(tran_count))
          {
                  $('#amount_error').html(`Amount must be less than or equal to ${tran_count}`);
                  return $('#amount').focus();

          }
          else if(!description || !$.trim(description).length)
          {
              $('#amount_error').html("");
              $('#description_error').html("reason required");
              return $('#description').focus();
          }
          else if(description.length < 3)
          {
              $('#amount_error').html("");
              $('#description_error').html("reason length");
              return $('#description').focus();
          }
          else if(!support_doc)
          {
              $('#support_doc_error').html("The supporting document is required");
              return $('#support_doc').focus();
          }
          else
          {
              const new_tran_count = tran_count - amount;
              $('#amount_error').html("");
              $('#description_error').html("");
              //TODO: Initializing Form Data Object
              const formData = new FormData;
              formData.append('id', id);
              formData.append('amount', amount);
              formData.append('type', transaction_type);
              formData.append('tran_count', new_tran_count);
              formData.append('description', description);
              formData.append('currency', transaction_currency);
              formData.append('token', token);
              formData.append('email', charge_form_email);
              formData.append('name', cname);
              formData.append('tran_ref', tran_ref);
              formData.append('cart_id', transaction_cart_id);
              formData.append('booking_id', booking_id);
              formData.append('support_doc', support_doc);

              //TODO: Seding Ajax Requrest for creating navbar menu
              $.ajax({
                  url:"/charge-payment",
                  method:"POST",
                  data:formData,
                  contentType:false,
                  processData:false,
                  cache:false,
                  beforeSend:function()
                  {
                      // $('#save').html(`${save_icon} @lang('translation.please_wait')`);
                      // $('#save').attr('class',`${btn_primary }  ${spinner}`); 
                      $('#save').attr('disabled',true);
                  },
                  complete:function()
                  {
                      // $('#save').html(`${save_icon} @lang('translation.save')`);
                      // $('#save').attr('class',`${btn_primary }`); 
                      $('#save').removeAttr('disabled');
                  },
                  success:function(res)
                  {
                    
                    if(res.status == true )
                    {
                        Swal.fire({
                          icon: 'success',
                          text: ' '+res.message,
                          timer: 3000,
                          customClass: {
                            confirmButton: 'btn btn-error'
                          } 
                        })
                    }
                    else
                    {
                      Swal.fire({
                        icon: 'error',
                        text: ''+res.message,
                        timer: '10000',
                        customClass: {
                          confirmButton: 'btn btn-error'
                        } 
                      })
                    }
                 
                      location.reload(true);
                  },error:function(xhr)
                  {
                      console.log(xhr.responseText);
                  }
              });
          }
      });

                                   
       $('#tn_submit').click(function(){

        var tn_number = $('#tn_number').val(); 
        var tn_uuid = $('#mt_getuuid').val(); 
        var tninvoice_uuid = $('#mt_getinvoiceuuid').val(); 

        $.ajax({
          url: 'check_invoicetn_number'+'/'+tn_number+'/'+tn_uuid+'/'+tninvoice_uuid, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,    
          success: function (data) {   
           
            if(data == null){
              Swal.fire({
                icon: 'error',
                title: 'Not Found!',
                text: 'Transaction ID Not Found.',
                customClass: {
                  confirmButton: 'btn btn-success'  
                } 
              });
            }else{
              Swal.fire({
                icon: 'success',
                title: 'Maped!',
                text: 'Booking Maped With Transaction.', 
                customClass: {
                  confirmButton: 'btn btn-success'  
                }  
              });
              location.reload(true); 
            }
          },
          error: function (data) {
          }
      });
        
      });

});

