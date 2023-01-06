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

  var dtInvoiceTable = $('.invoice-list-table3'),
    assetPath = '../../../app-assets/',
    invoicePreview = 'app-invoice-preview.html',
    invoiceAdd = 'app-invoice-add.html';
    

    

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    invoicePreview = assetPath + 'app/invoice/preview';
    invoiceAdd = assetPath + 'app/invoice/add';

  }


  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
      ajax: assetPath + "data/superadmin/company/statement-json/_statement-datatable.json",
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'date' },
        { data: 'booking' },
        { data: 'merchant' },
        { data: 'status' },
        { data: 'vehicle' } 
        
      ],
      columnDefs: [ 
        {
          // Invoice ID
          targets: 1,
          width: '46px',
          render: function (data, type, full, meta) {
            var $invoiceId = full['type'];
            // Creates full output for row
            var $rowOutput = '<a class="fw-bold" href="' + invoicePreview + '"> ' + $invoiceId + '</a>';
            return $rowOutput;
          }
        }
        ,
         
        {
          // Total Invoice Amount
          targets: 2,
          width: '73px',
          render: function (data, type, full, meta) {
            var $total = full['booking'];
            return (
              '<span class="text-nowrap">' + $total + "</span>"
          );

          }
        },
        {
          // Due Date
          targets: 3,
          width: '130px',
          render: function (data, type, full, meta) {
           
            var $total = full['credit'];
            return (
              '<span class="text-nowrap">' + $total + "</span>"
          );

          }
        },
        {
          // Client Balance/Status
          targets: 4,
          width: '98px',
          render: function (data, type, full, meta) {
              var $total = full['debit'];
              return (
                '<span class="text-nowrap">' + $total + "</span>"
            );

          }
        },
        {
          // Client Balance/Status
          targets: 5,
          width: '98px',
          render: function (data, type, full, meta) {
              var $total = full['amount'];
              return (
                '<span class="text-nowrap">' + $total + "</span>"
            );

          }
        }
        
      ],
      order: [[1, 'desc']] 
     
    });
  }
});
