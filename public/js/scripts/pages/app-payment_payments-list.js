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

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   })
   var isRtl = $('html').attr('data-textdirection') === 'rtl';
  var dtInvoiceTable = $('.invoice-list-table1'),
    assetPath = '../../../app-assets/',
    AccountPayment = $('.add-Queck-Payment'),
    WithdrawPayment = $('.withdraw-Payment'), 
    newUserSidebar = $(".new-payment-modal"),
    newUserSidebars = $(".new-withdraw-modal"),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
    statusObj = {
          A: { title: 'Authorized', class: 'badge-light-success' },
          H: { title: 'Hold', class: 'badge-light-warning' },
          V: { title: 'Voided', class: 'badge-light-danger' },
          E: { title: 'Decline', class: 'badge-light-danger' },
          D: { title: 'Decline', class: 'badge-light-danger' },
          C: { title: 'Cancel', class: 'badge-light-danger' }
    },
    typeObj = {
      1: { title: "Sales", class: "badge-light-primary" },
      2: { title: "Pre Auth", class: "badge-light-info" }, 
      3: { title: "Tokenize", class: "badge-light-success" }, 
      4: { title: "Cash", class: "badge-light-success" }, 
    };
    
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    var invoicePreview = assetPath + 'app/invoice/preview';
   var invoiceAdd = assetPath + 'app/invoice/add';

  }

  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
      ajax: assetPath + "data/directpayment/" + org_id + "_directpayment.json", // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'booking_id' } ,
        { data: 'invoice_id' },
        { data: 'transaction_ref' },
        { data: 'amount' },
        { data: 'transaction_type' },
        { data: 'created_at' },
        { data: 'agentname' } 
        
      ],
      columnDefs: [
       
        {
          // Total Invoice Amount
          targets: 0,
          render: function (data, type, full, meta) {
            var $transaction_ref = full['tran_ref'];
            var $id = full['tran_id'];
            var $invoiceid = full['invoice_id'];
           
            if($invoiceid==null)
            {
              return 'N/A';
            }else{
             var $rowOutput = '<a class="fw-bold" data-id="'+$invoiceid+'" data-invoice="'+$invoiceid+'" id="invoicedetails" data-bs-toggle="modal" data-bs-target="#invoicede" style="color:red;">INV000'+ $invoiceid + '</a>';
             return $rowOutput;
            }
          }
        },   
          
        {
          // Invoice status
          targets: 1, 
        render: function (data, type, full, meta) {
            var $transaction_ref = full['transaction_ref'];
            var $id = full['id'];
            var $acounts_payment_id = full['id'];
            var $tran_type = full['transaction_type'];
            var $invoiceid = full['invoice_id']; 
         
          if($transaction_ref==null){
            return 'N/A';
          }else{
            
            if($acounts_payment_id!=null && $invoiceid==null)
              {
                if($tran_type==4)
                {
                  var $rowOutput = '<a class="fw-bold" data-id="'+$transaction_ref+'" id="invoice_details1" data-bs-toggle="modal" data-bs-target="#myModel_cash" style="color:red;"> ' + $transaction_ref + '</a>';
                  return $rowOutput;
                }else{
                var $rowOutput = '<a class="fw-bold" data-id="'+$transaction_ref+'" id="invoice_details1" data-bs-toggle="modal" data-bs-target="#myModel" style="color:red;"> ' + $transaction_ref + '</a>';
                return $rowOutput;
                }
              }
              else if($acounts_payment_id!=null && $invoiceid!=null)
              {
                if($tran_type==4)
                {
                  var $rowOutput = '<a class="fw-bold" data-id="'+$transaction_ref+'" id="invoice_details1" data-bs-toggle="modal" data-bs-target="#detais_cash" style="color:red;"> ' + $transaction_ref + '</a>';
                  return $rowOutput;
                }else{
                var $rowOutput = '<a class="fw-bold" data-id="'+$transaction_ref+'" id="invoice_details1" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> ' + $transaction_ref + '</a>';
                return $rowOutput;
                }
              } 
              else
              {
                if($tran_type==4)
                {
                  var $rowOutput = '<a class="fw-bold" data-id="'+$transaction_ref+'" id="invoice_details1" data-bs-toggle="modal" data-bs-target="#detais_cash" style="color:red;"> ' + $transaction_ref + '</a>';
                  return $rowOutput;
                }else{
                var $rowOutput = '<a class="fw-bold" data-id="'+$transaction_ref+'" id="invoice_details1" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> ' + $transaction_ref + '</a>';
                return $rowOutput;
                }
              }
          }
        }
      },
        {
          // Due Date
          targets: 2,
          render: function (data, type, full, meta) {
           
            var $currency = 'AED';
            return (
              '<span class="text-nowrap">' + $currency + "</span>"
          );

          }
        },
        {
          // Due Date
          targets: 3,
           render: function (data, type, full, meta) {
             var $total = full['amount'];
             if($total==null){
              return 'N/A';
            }else{
            return (
              '<span class="text-nowrap">' + $total + "</span>"
            
          );
        }
          }
        },
        {
          // Client Balance/Status
          targets: 4,
          render: function (data, type, full, meta) {
            var status = full["payment_status"];
          if(status){
            return (
              '<span class="badge rounded-pill ' +
              statusObj[status].class +
              '" text-capitalized>' +
              statusObj[status].title +
              "</span>"
            );
            }else{
              return (
                '<span class="badge rounded-pill badge-light-warning" text-capitalized="">Pending</span>'
              );
            }
          }
        },  {
          // Client name and Service
          targets: 5,
            render: function (data, type, full, meta) {
            var $type = full["transaction_type"];
            return (
                '<span class="badge rounded-pill ' +
                typeObj[$type].class +
                '" text-capitalized>' +
                typeObj[$type].title +
                "</span>"
            );
          }
        },
        
        {
          // Invoice ID
          targets: 6,
          render: function (data, type, full, meta) {
            var $date = full['created_at'];
            const d = new Date($date).toLocaleDateString('en-us', {day: 'numeric', year:"numeric", month:"short"});
            return (
              '<span class="text-nowrap">' + d + "</span>"
          );
          }
        },
        
       
        {
          // Invoice ID
          targets: 7,
          render: function (data, type, full, meta) {
            var $booking_id = full['booking_id'];
            var sync='Yes';
            if($booking_id==null){
              sync='No';
            }
            return (
              '<span class="text-nowrap">' + sync + "</span>"
          );
          }
        },
        {
          // Invoice ID
          targets: 8,
          render: function (data, type, full, meta) {
            var short_link = full['short_link'];
            if(short_link){
              return (       
                '<a href="'+short_link+'" target="_blank" class="btn btn-sm">' +feather.icons["credit-card"].toSvg({class: "font-small-4", }) +'</a>'
             );
            }else{
              return '';
            }
            
          }
        }
      ],
      order: [[2, 'desc']], 
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +
        '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
        '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search Invoice',
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      // Buttons with Dropdown
      buttons: [
        
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['client_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.columnIndex !== 2 // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIdx +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');
            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
    
      drawCallback: function () {
        $(document).find('[data-bs-toggle="tooltip"]').tooltip();
      }
    });
  }
  

 // Form Validation
 if (AccountPayment.length) {
  AccountPayment.validate({
      errorClass: "error",
      rules: {
          "full_name": {
              required: true,
          },
          "email": {
              required: true,
          },
          "amount": {
              required: true,
          },
          "amount": {
              required: true,
          },
      },
  });
  //namevalidate()
}


  AccountPayment.on('submit', function (e) {
            
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
              url: 'addquick-payment', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              processData: false,
              success: function (data) {
                 
                  $( "#submit" ).prop( "disabled", false );
                  if (data.status === true) {
                    if(data.data.transaction_type==4){
                        $('.cancel').click();
                        
                     }else{
                      $('#modals-addslide').modal("hide");
                     $('#mediumModal').modal("show");
                     $('#address1').html(data.data.address1);
                     $('#address2').html(data.data.address2);
                     $('#city').html(data.data.city);
                     $('#street').html(data.data.state);
                     $('#name1').html(data.data.agentname);
                     $('#email1').html(data.data.email);
                     $('#agents').val(data.data.agentname);
                     $('#grand_total').html(data.data.amount);
                     $('#phone_sms').val(data.data.phone);
                     $('#id_sms').val(data.data.id);
                     $('#payment_link').html(data.data.short_link);
                     document.getElementById('my-link').setAttribute('href', 'https://api.whatsapp.com/send?phone='+data.data.phone+'&text='+data.data.short_link);
                    
                      document.getElementById('make_payment').setAttribute('href',data.data.short_link);
                      document.getElementById('payment_link').setAttribute('href',data.data.short_link);
                      $(document).on('click', '#sms_send_data', function(){ 
                    
                        var id = $('#id_sms').val(); 
                           
                            $.ajax({
                                url: "../sms_for_quick_list" + '/' + id,
                                type: "get",
                      
                                cache: false,
                                success: function(res){
                                  
                                  if (res == 'true') {
                      
                                    Swal.fire({
                                      icon: 'success',
                                      title: 'Sent!',
                                      text: 'Payment link has been sent successfully.',
                                      customClass: {
                                        confirmButton: 'btn btn-success'
                                      }
                                        
                                    });
                                    
                                  }
                                }
                            }); 
                          });  
                          $('#mail_send_data').on('click', function() { 
                            var id = $('#id_sms').val();  
                          
                                $.ajax({
                                    url: "../mail_for_quick_list" + '/' + id,
                                    type: "get",
                                    data: { 
                                      _token: $("#csrf").val()
                                    },
                                    cache: false,
                                    success: function(res){
                                      
                                        if (res == 'true') {
                          
                                          Swal.fire({
                                            icon: 'success',
                                            title: 'Sent!',
                                            text: 'Mail has been sent successfully.',
                                            customClass: {
                                              confirmButton: 'btn btn-success'
                                            }
                                              
                                          });
                                          
                                        }
                                    }
                                }); 
                              });  
                     }
                      toastr['success'](''+data.message+'', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                      });
              
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
      AccountPayment.on("submit", function (e) {
        var isValid = AccountPayment.valid();
        e.preventDefault();
        if (isValid) {
            newUserSidebar.modal("hide");
        }
      });
  })
   
 


  WithdrawPayment.on('submit', function (e) {
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
          let formData = new FormData($('#form_models')[0])
          var  amount_value =  $("#amount_value").val();
          var  withdrawl_fees =  $("#total_with").val();
          var valued=parseFloat(amount_value) + parseFloat(withdrawl_fees);
          var balance = $('#available_balance').val();
          var  withdrawal_type =  $("#withdrawal_type").val();
             
             if(withdrawal_type==1){
          if(balance <= withdrawl_fees){ 
                 
                  Swal.fire({
                    icon: 'error',
                     text: 'Your Available Balance is ' +balance+ ' in Statement',
                    customClass: {
                      confirmButton: 'btn btn-error'
                    } 
                  })

                }else{

       $.ajax({
              url: 'withdraw_save', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              processData: false,
              success: function (data) {
                 
                  $( "#submit" ).prop( "disabled", false );
                  toastr['success'](''+data.message+'', {
                   closeButton: true,
                   tapToDismiss: false,
                   rtl: isRtl
                 });
                   location.reload();
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
      }else{

        if(balance <= valued){  
                 
          Swal.fire({
            icon: 'error',
             text: 'Your Available Balance is ' +balance+ ' in Statement',
            customClass: {
              confirmButton: 'btn btn-error'
            } 
          })

        }else{

          $.ajax({
                url: 'withdraw_save', // JSON file to add data,
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                  
                    $( "#submit" ).prop( "disabled", false );
                    toastr['success'](''+data.message+'', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                  });
                    location.reload();
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
      }
      

  });

  if (WithdrawPayment.length) {
    // AccountPayment.validate({
    //   errorClass: 'error',
    //   rules: {
    //     'model_name': {
    //       required: true
    //     }
    //   }
    // });
    
    WithdrawPayment.on("submit", function (e) {
      var isValid = WithdrawPayment.valid();
      e.preventDefault();
      if (isValid) {
        newUserSidebars.modal("hide");
      }
    });
  }
    
  $("#amount_request").keyup(function () {
    var  amount_request = parseFloat(this.value);
    var  withdrawl_fees =  $("#withdrawl_select").val();
    var  withdrawal_type =  $("#withdrawal_type").val();
     
    
   if(isNaN(amount_request)){
        amount_request = 0;
    }
   if(withdrawal_type==2){

      var  total = (parseFloat(amount_request) * parseFloat(withdrawl_fees))/100;  
      
       $("#total_with").val(total);
       $("#total_withdra").val(total+amount_request);
       $("#withdrawl_fees").val(total);
       $("#amount_value").val(amount_request);
   }else if(withdrawal_type==1){

     var  total = (parseFloat(amount_request) + parseFloat(withdrawl_fees));  
      $("#total_with").val(total);
      $("#total_withdra").val(total);
      // $("#withdrawl_fees").val(total);
      $("#amount_value").val(amount_request);

   }else{

     var  total = 0;
     $("#total_with").val(total);
     $("#withdrawl_fees").val(total);
     $("#amount_value").val(amount_request);
   }
  

});  

$(document).on('click', '#invoicedetails', function(){ 

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
      $('#transaction_id_data').text(response.id);
      $('#type_data').text(response.tran_type);
     $('#transaction_referance_data').text(response.tran_ref);
     $('#status_label_data').text(response.payment_code);
     $('#transaction_type_data').text(response.tran_type);
     $('#cart_amount_currency_data').text(response.cart_amount);
     $('#transaction_cart_id_data').text(response.cart_id);
     $('#transaction_status_data').text(response.payment_status);
     $('#transaction_resp_msg_data').text(response.response_code);
     $('#transaction_invoice_no_data').text(response.invoice_id);
     $('#payment_description_data').text(response.payment_description);
     $('#card_type_data').text(response.card_type);
     $('#status_idss_data').text(response.status == 1 ? 'P' : 'A');
     $('#card_scheme_data').text(response.payment_method);
     $('#name_data').text(response.name); 
     $('.invoice_id_data').val('1000'+response.invoiceid); 
     $('#c_email_data').text(response.email);
     $('#address_data').text(response.street);
     $('#c_country_data').text(response.country);
     $('#c_state_data').text(response.state);
     $('#name_data').text(response.name);
     $('#address2_data').text(response.street);
     $('#phone1_data').text(response.phone);
     $('#email1_data').text(response.email);
     $('#inv_preview_note_data').text(response.note);
     
     
     const date = new Date(response.invoicedate).toLocaleDateString('en-us', {day: 'numeric', year:"numeric", month:"short"})
     $('.invoice_date').val(date);
     
     if(response.invoice_id==''){
      $('#sub_total_data').text(0);
      $('#discount_data').text(0);
      $('#shipping_charges_data').text(0);
      $('#grand_totalsss_data').text(0);
     }else{
     $('#sub_total_data').text(response.subtotal);
     $('#discount_data').text(response.subtotal_discount);
     $('#shipping_charges_data').text(response.delivery_charge);
     $('#grand_totalsss_data').text(response.grand_total);
     }
     $('#transaction_invoice_ref').text(response.invoice_ref);
     $('#transaction_customer_ref').text(response.customer_ref);
     $('#transaction_description').text(response.inv_description);
     $('#expiryMonth').text(response.expiry_month);
     $('#expiryYear').text(response.expiry_year);
     $('#transaction_date').text(d);
     
     $('#hidden_name').val(response.name); 
     $('#name12').val(response.name); 
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
    //  $('#phone_sms').val(data.data.phone);
    //  $('#id_sms').val(data.data.id);

    },
    error: function (response) {
      
    }



  }) 

}); 






    $(document).on('click', '#invoicedetails', function(){ 

      var id=$(this).attr('data-invoice');
      
        $.ajax({
        url: 'get_invoice_details_data'+'/'+id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache : false, 
        processData: false,
        success: function (response) {
        
            $('#tbody1').html(response.html);
          
          },
        error: function (response) {
          
        }
      }) 
      
      }); 
 

$(document).on('click', '#invoice_details1', function(){ 

  var id=$(this).attr('data-id');
   
  $.ajax({
    url: 'transaction_details_for_payment'+'/'+id, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (response) {
       
      if(response.refund_resp=='A'){
        
        $('#refunded').show();
        $('#refund_p').hide();
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
      $('#transaction_id9').text(response.id);
      $('#transaction_id1').text(response.id);
      $('#transaction_id123').text(response.id);
     $('#transaction_referance').text(response.tran_ref);
     $('#transaction_referance9').text(response.tran_ref);
     $('#transaction_referance1').text(response.tran_ref);
     $('#transaction_referance123').text(response.tran_ref);
     $('#status_label1').text(response.payment_code);
     $('#status_label123').text(response.payment_code);
     $('#status_label').text(response.payment_code);
     $('#status_label9').text(response.payment_code);
     $('#transaction_type').text(response.tran_type);
     $('#transaction_type9').text(response.tran_type);
     $('#transaction_type1').text(response.tran_type);
     $('#transaction_type123').text(response.tran_type);
     $('#cart_amount_currency').text(response.cart_amount);
     $('#cart_amount_currency9').text(response.cart_amount);
     $('#cart_amount_currency1').text(response.cart_amount);
     $('#cart_amount_currency123').text(response.cart_amount);
     $('#transaction_cart_id').text(response.cart_id);
     $('#transaction_cart_id9').text(response.cart_id);
     $('#transaction_cart_id1').text(response.cart_id);
     $('#transaction_cart_id123').text(response.cart_id);
     $('#transaction_status1').text(response.payment_status);
     $('#transaction_status123').text(response.payment_status);
     $('#transaction_status').text(response.payment_status);
     $('#transaction_status9').text(response.payment_status);
     $('#transaction_resp_msg').text(response.response_code);
     $('#transaction_resp_msg9').text(response.response_code);
    //  $('#transaction_date').text(response.transaction_time);
     $('#payment_description1').text(response.comment);
     $('#payment_description123').text(response.comment);
     $('#transaction_description1').text(response.description);
     $('#transaction_description123').text(response.description);
     $('#phone2').text(response.phone);
     $('#phone234').text(response.phone);
   
     $('#transaction_resp_msg1').text(response.response_code);
     $('#transaction_invoice_no').text(response.invoice_id);
     $('#transaction_invoice_no9').text(response.invoice_id);
     $('#transaction_invoice_no1').text(response.invoice_id);
     $('#transaction_invoice_no123').text(response.invoice_id);
     $('#payment_description').text(response.payment_description);
     $('#payment_description9').text(response.payment_description);
     $('#payment_description1').text(response.payment_description);
     $('#card_type').text(response.card_type);
     $('#card_type9').text(response.card_type);
     $('#card_type1').text(response.card_type);
     $('#status_idss').text(response.status == 1 ? 'P' : 'A');
     $('#status_idss9').text(response.status == 1 ? 'P' : 'A');
     $('#card_scheme').text(response.payment_method);
     $('#card_scheme9').text(response.payment_method);
     $('#card_scheme1').text(response.payment_method);
     $('#name').text(response.name);  
     $('#name9').text(response.name);  
     $('#name12').text(response.full_name);    
     $('#name1234').text(response.full_name);  
     $('#c_email').text(response.email);
     $('#c_email9').text(response.email);
     $('#c_email1').text(response.email);  
     $('#c_email123').text(response.email);
     $('#address').text(response.street);
     $('#address9').text(response.street);
     $('#address1').text(response.street);
     $('#address123').text(response.street);
     $('#c_country').text(response.country);
     $('#c_country9').text(response.country);
     $('#c_country1').text(response.country);
     $('#c_country123').text(response.country);
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
     $('#transaction_customer_ref9').text(response.customer_ref);
     $('#transaction_customer_ref1').text(response.customer_ref);
     $('#transaction_description').text(response.inv_description);
     $('#transaction_description9').text(response.inv_description);
     $('#transaction_description1').text(response.inv_description);
     $('#expiryMonth').text(response.expiry_month);
     $('#expiryMonth9').text(response.expiry_month);
     $('#expiryMonth1').text(response.expiry_month);
     $('#expiryYear').text(response.expiry_year);
     $('#expiryYear9').text(response.expiry_year);
     $('#expiryYear1').text(response.expiry_year);
     $('#transaction_date').text(d);
     $('#transaction_date9').text(d);
     $('#transaction_date1').text(d);
     $('#transaction_date123').text(d);

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

$(document).on('click', '#invoice_details1', function(){ 

var id=$(this).attr('data-id');

  $.ajax({
  url: 'invoice_details_data_payments'+'/'+id, // JSON file to add data,
  type: 'get',
  dataType: 'json',
  contentType: false,
  cache : false, 
  processData: false,
  success: function (response) {
      // $('#tbody1').html(response.html);
      $('#tbodyss').html(response.html);
      $('#tbody').html(response.html);
    },
  error: function (response) {
    
  }
}) 

}); 

});
