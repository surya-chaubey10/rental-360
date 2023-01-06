/**
 * DataTables Basic
 */

 $(function () {
    'use strict';
    var dt_basic_table = $('.get_data_all'),
      assetPath = '../../../app-assets/';
      var statusObj = {   
        1: { title: "P", class: "badge-light-warning" },
        2: { title: "A", class: "badge-light-success" },
    };
    var method = {
      1: { title: "Visa/MasterCard", class: "badge-light-warning" },
      2: { title: "Amex", class: "badge-light-success" },
  },
    typeObj = {
      1: { title: "Sales", class: "badge-light-primary" },
      2: { title: "Pre Auth", class: "badge-light-info" }, 
      3: { title: "Tokenize", class: "badge-light-success" }, 
      4: { title: "Cash", class: "badge-light-success" }, 
    };
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
    }
  // DataTable with buttons
    if (dt_basic_table.length) {
       dt_basic_table.DataTable({
        ajax: assetPath + "data/superadmin/company/invoice-json/_invoice-list.json",
        columns: [
         
            { data: 'tran_ref' }, 
            { data: 'name'},
            { data: 'transaction_type' },
            { data: 'payment_method' }, 
            { data: 'currency_type' },
            { data: 'status' },
            { data: 'cart_amount' }, 
            { data: 'status' },
            { data: '' }
          ],
            columnDefs: [
              {
                targets: 0,
                render: function (data, type, full, meta) {
                  var $id = full['id']
                  return (
                    '<span class="text-nowrap">' + $id + "</span>"
                );
                }
              } , 
              {
                targets: 1,
                render: function (data, type, full, meta) {
                  var $transaction_ref = full['tran_ref'];
                  var $id = full['id'];
                  var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="invoice_details" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> ' + $transaction_ref + '</a>';
                  return $rowOutput;
                }
              } , 
              {
                targets: 2,  
                render: function (data, type, full, meta) {
                  var $name = full['name']
                  return (
                    '<span class="text-nowrap">' + $name + "</span>"
                );
                   
                }
              },
              {
                targets:3,
                render: function (data, type, full, meta) {
                  var $type = full['transaction_type']
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
                targets: 4,
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
                targets: 5,
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
                targets: 6,
                render: function (data, type, full, meta) {
                  var tran_id = full["status"];
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
              {
                targets: 7,
                  render: function (data, type, full, meta) {
                    var $amount = full['cart_amount'];
                    
                    return (
                      '<span class="text-nowrap">' + $amount + "</span>"
                  );
                }
              }, 
                
              {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) { 
                  var $id = full['uuid'];  
                  var edit ='invoice-edit/'+$id+'';
                  var $short_link = full['short_link'];  
                  var $mobile = full['phone'];  
                  
                    return (
                      '<div class="btn-group">' +
                      '<a href="#" class="btn btn-sm" style="font-size:50px; color:#a300ff;">' + 
                      feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) +
                     '</a>'
                     +
                     '<a href="#" class="btn btn-sm" style="font-size:50px; color:#008aff;">' + 
                     feather.icons['eye'].toSvg({ class: 'font-small-4 me-50' }) +
                    '</a>'
                    +
                    '<a href="#" class="btn btn-sm" style="font-size:20px; color:#20ae00;">' + 
                    '<i class="fa fa-whatsapp"></i>'+
                   '</a>'
                   +
                      '<a href="#" class="btn btn-sm" style="font-size:50px; color:#0573ffe0;">' + 
                      feather.icons['message-circle'].toSvg({ class: 'font-small-4 me-50' }) +
                     '</a>'
                     +
                     '<a class="btn btn-sm" style="font-size:50px; color:#ffca00;">' 
                      +
                      feather.icons['mail'].toSvg({ class: 'font-small-5' }) 
                      +
                      '</a>'+
                       '<a  class="dbtn btn-sm" style="color:red;">' +
                      feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                      '</a>'+
                     
                      '</div>'
                    );
                  
                }
              } 
            ],
       

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

    $(document).on('click', '#invoice_details', function(){ 
       
      var id=$(this).attr('data-id');
      
      $.ajax({
        url: '/storeadmin/company_invoice_details'+'/'+id, // JSON file to add data,
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
       $('#sub_total').text(response.subtotal);
       $('#discount').text(response.subtotal_discount);
       $('#shipping_charges').text(response.delivery_charge);
       $('#grand_totalsss').text(response.grand_total);
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

  $(document).on('click', '#invoice_details', function(){ 

    var id=$(this).attr('data-id');
    
      $.ajax({
      url: '/storeadmin/invoice_details_data'+'/'+id,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (response) {
          $('#tbodys').html(response.html);
        
        },
      error: function (response) {
        
      }
    }) 
  
  
  }); 
   
  });
  
  