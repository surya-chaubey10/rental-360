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

  var dtInvoiceTable = $('.invoice-list-table'),
    assetPath = '../../../app-assets/',
    invoicePreview = 'app-invoice-preview.html',
    invoiceAdd = 'app-invoice-add.html',
    invoiceEdit = 'app-invoice-edit.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    invoicePreview = assetPath + 'app/invoice/preview';
    invoiceAdd = assetPath + 'app/invoice/add';
    invoiceEdit = assetPath + 'app/invoice/edit';
  }

  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
      ajax: assetPath + 'data/customers.json', // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'responsive_id' },
        // { data: 'invoice_id' },
        { data: 'issued_date' },
        { data: 'price' },
        // { data: 'client_name' },
        // { data: 'total' },
        // { data: 'balance' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          responsivePriority: 2,
          targets: 0
        },
        {
          // Invoice ID
          targets: 1,
          
          render: function (data, type, full, meta) {
            var $invoiceId = full['invoice_id'];
            // Creates full output for row
            var $rowOutput = '<a class="fw-bold" href="' + invoicePreview + '"> ' + $invoiceId + '</a>';
            return $rowOutput;
          }
        },



        {
          // Total Invoice Amount
          targets: 2,
          width: '73px',
          render: function (data, type, full, meta) {
            var $total = full['client_name'];
            return '<span class="d-none">' + $total + '</span>' + $total;
          }
        },
        {
          // Total Invoice Amount
          targets: 3,
         
          render: function (data, type, full, meta) {
            var $total = full['email'];
            return '<span class="d-none">' + $total + '</span>' + $total;
          }
        },
        
        {
          // Total Invoice Amount
          targets: 4,
         
          render: function (data, type, full, meta) {
            var $total = full['phone'];
            return '<span class="d-none">' + $total + '</span>' + $total;
          }
        },
        {
          // Total Invoice Amount
          targets: 5,
          width: '73px',
          render: function (data, type, full, meta) {
            var $total = full['source'];
            return '<span class="d-none">' + $total + '</span>' + $total;
          }
        },
       {
          // Label
          targets: 6,
          responsivePriority: 1,
          render: function (data, type, full, meta) {
            var $progress = full['progress'] + '%',
              $color;
            switch (true) {
              case full['progress'] < 25:
                $color = 'bg-danger';
                break;
              case full['progress'] < 50:
                $color = 'bg-warning';
                break;
              case full['progress'] < 75:
                $color = 'bg-info';
                break;
              case full['progress'] <= 100:
                $color = 'bg-success';
                break;
            }
            return (
              '<div class="d-flex flex-column"><small class="mb-1">'+
              $progress +
              '</small>' +
              '<div class="progress w-100 me-3" style="height: 6px;">' +
              '<div class="progress-bar ' +
              $color +
              '" style="width: ' +
              $progress +
              '" aria-valuenow="' +
              $progress +
              '" aria-valuemin="0" aria-valuemax="100"></div>' +
              '</div>' +'Unlimited Extended License' +
              '</div>'
            );
          }
        }   
        // {
        //   // Client Balance/Status
        //   targets: 7,
        //   width: '98px',
        //   render: function (data, type, full, meta) {
        //     var $balance = full['price'];
        //     if ($balance === 0) {
        //       var $badge_class = 'badge-light-success';
        //       return '<span class="badge rounded-pill ' + $badge_class + '" text-capitalized> Paid </span>';
        //     } else {
        //       return '<span class="d-none">' + $balance + '</span>' + $balance;
        //     }
        //   }
        // },
        // {
        //   targets: 7,
        //   visible: false
        // },
        // {
        //   // Actions
        //   targets: -1,
        //   title: 'Actions',
        //   width: '80px',
        //   orderable: false,
        //   render: function (data, type, full, meta) {
        //     return (
        //       '<div class="d-flex align-items-center col-actions">' +
        //       '<a class="me-1" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Mail">' +
        //       feather.icons['send'].toSvg({ class: 'font-medium-2 text-body' }) +
        //       '</a>' +
        //       '<a class="me-25" href="' +
        //       invoicePreview +
        //       '" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview Invoice">' +
        //       feather.icons['eye'].toSvg({ class: 'font-medium-2 text-body' }) +
        //       '</a>' +
        //       '<div class="dropdown">' +
        //       '<a class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
        //       feather.icons['more-vertical'].toSvg({ class: 'font-medium-2 text-body' }) +
        //       '</a>' +
        //       '<div class="dropdown-menu dropdown-menu-end">' +
        //       '<a href="#" class="dropdown-item">' +
        //       feather.icons['download'].toSvg({ class: 'font-small-4 me-50' }) +
        //       'Download</a>' +
        //       '<a href="' +
        //       invoiceEdit +
        //       '" class="dropdown-item">' +
        //       feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
        //       'Edit</a>' +
        //       '<a href="#" class="dropdown-item">' +
        //       feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) +
        //       'Delete</a>' +
        //       '<a href="#" class="dropdown-item">' +
        //       feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) +
        //       'Duplicate</a>' +
        //       '</div>' +
        //       '</div>' +
        //       '</div>'
        //     );
        //   }
        // }
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
      // initComplete: function () {
      //   $(document).find('[data-bs-toggle="tooltip"]').tooltip();
      //   // Adding role filter once table initialized
      //   this.api()
      //     .columns(7)
      //     .every(function () {
      //       var column = this;
      //       var select = $(
      //         '<select id="UserRole" class="form-select ms-50 text-capitalize"><option value=""> Select Status </option></select>'
      //       )
      //         .appendTo('.invoice_status')
      //         .on('change', function () {
      //           var val = $.fn.dataTable.util.escapeRegex($(this).val());
      //           column.search(val ? '^' + val + '$' : '', true, false).draw();
      //         });

      //       column
      //         .data()
      //         .unique()
      //         .sort()
      //         .each(function (d, j) {
      //           select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
      //         });
      //     });
      // },
      drawCallback: function () {
        $(document).find('[data-bs-toggle="tooltip"]').tooltip();
      }
    });
  }
});
