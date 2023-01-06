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

  var dtInvoiceTable = $('.invoice-list-table2'),
    assetPath = '../../../app-assets/',
    invoicePreview = 'app-invoice-preview.html',
    invoiceAdd = 'app-invoice-add.html',
    statusObj = {
          A: { title: 'Approved', class: 'badge-light-success' },
          H: { title: 'Hold', class: 'badge-light-warning' },
          V: { title: 'Decline', class: 'badge-light-danger' },
          E: { title: 'Decline', class: 'badge-light-danger' },
          D: { title: 'Decline', class: 'badge-light-danger' }
    };
    

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    invoicePreview = assetPath + 'app/invoice/preview';
    invoiceAdd = assetPath + 'app/invoice/add';

  }


  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
       ajax: assetPath + "data/transaction2-json/" + org_id + "_transaction2.json", // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'tran_ref' }, 
        { data: 'name'},
        { data: 'tran_type' },
        { data: 'payment_method' }, 
        { data: 'cart_currency' },
        { data: 'cart_amount' },
        { data: 'transaction_time' }
        
      ],
      columnDefs: [
        {
          targets: 0,
          width: '46px',
          render: function (data, type, full, meta) {
            var $transaction_ref = full['tran_ref'];
            var $acounts_payment_id = full['acounts_payment_id'];
            var $id = full['id'];
            var $tran_type = full['tran_type'];
            var $invoiceid = full['invoice_id'];
          
            if($transaction_ref==null){
              return 'N/A';
            }else{
              if($acounts_payment_id!=null && $invoiceid==null)
              {
                if($tran_type=='Cash')
                {
                  var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="invoice_details" data-bs-toggle="modal" data-bs-target="#myModel_cash" style="color:red;"> ' + $transaction_ref + '</a>';
                  return $rowOutput;
                }else{
                var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="invoice_details" data-bs-toggle="modal" data-bs-target="#myModel" style="color:red;"> ' + $transaction_ref + '</a>';
                return $rowOutput;
                }  
              }
              else if($acounts_payment_id!=null && $invoiceid!=null)
              {
                if($tran_type=='Cash')
                {
                  var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="invoice_details" data-bs-toggle="modal" data-bs-target="#detais_cash" style="color:red;"> ' + $transaction_ref + '</a>';
                  return $rowOutput;
                }else{
                var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="invoice_details" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> ' + $transaction_ref + '</a>';
                return $rowOutput;
                }
              } 
              else
              {
                if($tran_type=='Cash')
                {
                  var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="invoice_details" data-bs-toggle="modal" data-bs-target="#detais_cash" style="color:red;"> ' + $transaction_ref + '</a>';
                  return $rowOutput;
                }else{
                var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="invoice_details" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> ' + $transaction_ref + '</a>';
                return $rowOutput;
                }
              }
           
            }
          }
        },
        {
          targets: 1,
          width: '73px',
          render: function (data, type, full, meta) {
            var $name = full['name'];
            if($name==null){
              return 'N/A';
            }else{
            return (
              '<span class="text-nowrap">' + $name + "</span>"
          );
            }
          }
        } , 
        {
          targets: 2,
          width: '42px',
          render: function (data, type, full, meta) {
            var $typs = full['tran_type']
            if($typs==null){
              $typs='N/A';
            }
            if($typs=='Sale')
            {
              return (
              '<span class="badge rounded-pill badge-light-primary"  text-capitalized> '+ $typs +"</span>")
            }
            return (

              '<span class="badge rounded-pill badge-light-success"  text-capitalized> ' + $typs + "</span>"
          );
             
          }
        },
        {
          targets: 3,
          width: '130px',
          render: function (data, type, full, meta) {
            var $payment_method = full['payment_method'];
            
            if($payment_method==null){
              $payment_method='N/A';
            }
            return (
              '<span class="text-nowrap">' + $payment_method + "</span>"
          );

          }
        },
        {
          targets: 4,
          width: '98px',
          render: function (data, type, full, meta) {
              var $amount = full['cart_amount'];
              return (
                '<span class="text-nowrap">' + $amount + "</span>"
               );

          }
        },
        {
          targets: 5,
          width: '46px', 
            render: function (data, type, full, meta) {
              var $date = full['transaction_time'];
              const d = new Date($date).toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
              return (
                '<span class="text-nowrap">' + d + "</span>"
            );
          }
        },  {
          targets: 6,
          responsivePriority: 4,
          width: '76px',
          render: function (data, type, full, meta) {
           
            var $status = full["payment_status"];

            return (
                '<span class="badge rounded-pill ' +
                statusObj[$status].class +
                '" text-capitalized>' +
                statusObj[$status].title +
                "</span>"
            );
          }
        }
        
      ],
      order: [[1, 'desc']],
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


  $(document).on('click', '#invoice_details', function(){ 

    var id=$(this).attr('data-id');
   
    $.ajax({
      url: 'transaction_details'+'/'+id, // JSON file to add data,
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

$(document).on('click', '#invoice_details', function(){ 

  var id=$(this).attr('data-id');
  
    $.ajax({
    url: 'invoice_details_data'+'/'+id, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (response) {
      console.log(response);
        $('#tbodyss').html(response.html);
        $('#tbody').html(response.html);
       
      
      },
    error: function (response) {
      
    }
  }) 

}); 

$('body').delegate('#refund_btn', 'click', function()
{
    $('#r_name').val($(this).find('#hidden_name').val());
    // $('#r_balance').val($(this).find('#availables_bal').val());
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
  
});
