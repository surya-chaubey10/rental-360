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

  var dtInvoiceTable = $('.transaction-list-table'),
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
       ajax: assetPath + "data/dashboard-transaction2-json/" + org_id + "_invoice.json", // JSON file to add data
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
            var $id = full['id'];
            if($transaction_ref==null){
              return 'N/A';
            }else{
            var $rowOutput = '<a class="fw-bold" data-id="'+$id+'" id="dashb_transaction_details" data-bs-toggle="modal" data-bs-target="#trans" style="color:red;"> ' + $transaction_ref + '</a>';
            return $rowOutput;
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
            return (
              '<span class="text-nowrap">' + $typs + "</span>"
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


  $(document).on('click', '#dashb_transaction_details', function(){ 

    var id=$(this).attr('data-id');
    
    $.ajax({
      url: 'transaction_data1_details1'+'/'+id, // JSON file to add data,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (response) {
       
        var $date= (response.created_at);
        const d = new Date($date).toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
        $('#transactionss_id').text(response.id);
       $('#transactionsss_referance').text(response.tran_ref);
       $('#statusss_label').text(response.payment_code);
       $('#transactionss_type').text(response.tran_type);
       $('#cart_amountss_currency').text(response.cart_amount);
       $('#transaction_cartss_id').text(response.cart_id);
       $('#transactionsss_status').text(response.payment_status);
       $('#transaction_respss_msg').text(response.response_code);
       $('#transaction_invoicess_no').text(response.invoice_id);
       $('#payment_descriptionsss').text(response.payment_description);
       $('#card_typess').text(response.card_type);
       $('#status_idss').text(response.status == 1 ? 'P' : 'A');
       $('#cardss_scheme').text(response.payment_method);
       $('#name').text(response.name);  
       $('#c_email').text(response.email);
       $('#address').text(response.street);
       $('#c_country').text(response.country);
       $('#c_state').text(response.state);
       $('#sub_totalss').text(response.subtotal);
       $('#discountsss').text(response.subtotal_discount);
       $('#shipping_chargesss').text(response.delivery_charge);
       $('#grand_totalxxx').text(response.grand_total);
       $('#transaction_invoicess_ref').text(response.invoice_ref);
       $('#transaction_customerss_ref').text(response.customer_ref);
       $('#transactionss_description').text(response.inv_description);
       $('#expiryMonthss').text(response.expiry_month);
       $('#expiryYearss').text(response.expiry_year);
       $('#transactionss_date').text(d);
 
        
      },
      error: function (response) {
        
      }
    }) 
 
}); 

$(document).on('click', '#dashb_transaction_details', function(){ 

  var id=$(this).attr('data-id');
  
    $.ajax({
    url: 'get_transaction_data1_details_data1'+'/'+id, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (response) {
        $('#tbodyss').html(response.html);
      
      },
    error: function (response) {
      
    }
  }) 

}); 
  
});
