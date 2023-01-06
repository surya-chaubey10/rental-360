/**
 * DataTables Basic
 */

 $(function () {
    'use strict';
    var dt_basic_table = $('.expenses-table'),
      assetPath = '../../../app-assets/';
      var statusObj = {
        1: { title: "Pending", class: "badge-light-warning" },
        2: { title: "Approved", class: "badge-light-success" },
    };
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
    }
  // DataTable with buttons
    if (dt_basic_table.length) {
      var dt_basic = dt_basic_table.DataTable({ 
        ajax: assetPath + "data/dashboard1-invoice-json/" + org_id + "_transaction2.json", 
        columns: [
            { data: 'tran_ref' }, 
            { data: 'name'},
            { data: 'tran_type' },
            { data: 'payment_method' }, 
            { data: 'cart_currency' },
            { data: 'cart_amount' },
            { data: 'created_at' }, 
            { data: 'status' },
           
          ],
            columnDefs: [
          
              {
                targets: 0,
                render: function (data, type, full, meta) {
                  var $transaction_ref = full['tran_ref'];
                  var $id = full['tran_id'];
                  // alert($id);
                  if($transaction_ref==null){
                    return 'N/A';
                  }else{
                  var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="dash_invoice_details" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> ' + $transaction_ref + '</a>';
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
                    return 'N/A';
                  }else{
                  return (
                    '<span class="text-nowrap">' + $type + "</span>"
                );
                  }
                }
              },
              {
                targets: 3,
                render: function (data, type, full, meta) {
                  var $payment_method = full['payment_method'];
                  
                  if($payment_method==null){
                    return 'N/A';
                  }else{
                  return (
                    '<span class="text-nowrap">' + $payment_method + "</span>"
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
                      '<span class="text-nowrap">' + $currency_type + "</span>"
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
                  var tran_id = full["tran_id"];
                  if(tran_id!=null){
                    return (
                      '<span class="badge rounded-pill ' +
                      statusObj[2].class +
                      '" text-capitalized>' +
                      statusObj[2].title +
                      "</span>"
                  );
                  }else{
                    return (
                      '<span class="badge rounded-pill ' +
                      statusObj[1].class +
                      '" text-capitalized>' +
                      statusObj[1].title +
                      "</span>"
                  );
                  }
                  
                }
              },
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

    $(document).on('click', '.getuuid', function () {
       
      var value_id = $(this).attr('data-value');
      var shortlink = $(this).attr('data-id');
      var mobile = $(this).attr('data-mobile');
          $("#booking_uuid").val(value_id)
          $("#shortlink").val(shortlink)
          $("#copy").text(shortlink)
          $("#whatsapp").attr("href", "https://api.whatsapp.com/send?phone=" + mobile+ "&text=" + shortlink )
          $("#url_link").attr("href",shortlink)
      
    });

    $(document).on('click', '.delete-record', function () {
      const value_id = $(this).data('id')
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
  
            deleteRecord(value_id)
            
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
  
      function deleteRecord(value_id) {
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
                location.reload(true);
              } else if (data.status === false) { 
              }
          },
          error: function (data) { 
          }
      })
    }

    $(document).on('click', '#dash_invoice_details', function(){ 

      var id=$(this).attr('data-id');
      
      $.ajax({
        url: 'invoice_details1'+'/'+id, // JSON file to add data,
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
         $('#c_email').text(response.email);
         $('#address').text(response.street);
         $('#c_country').text(response.country);
         $('#c_state').text(response.state);
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
   
          
        },
        error: function (response) {
          
        }
      }) 
   
  }); 
  
  $(document).on('click', '#dash_invoice_details', function(){ 
  
    var id=$(this).attr('data-id');
    
      $.ajax({
      url: 'get_invoice_details_data1'+'/'+id, // JSON file to add data,
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
   
  });
  
  