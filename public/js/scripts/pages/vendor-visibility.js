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
      ajax: assetPath + 'data/visibility.json', // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'responsive_id' },
        { data: 'invoice_id' },
        // { data: 'invoice_status' },
        { data: 'issued_date' },
        { data: 'client_name' },
        { data: 'total' },
        { data: 'balance' },
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
          width: '46px',
          render: function (data, type, full, meta) {
            var $invoiceId = full['invoice_id'];
            // Creates full output for row
            var $rowOutput = '<a class="fw-bold" href="' + invoicePreview + '"> #' + $invoiceId + '</a>';
            return $rowOutput;
          }
        },
      
        {
          // Client name and Service
          targets: 2 ,
          responsivePriority: 4,
          width: '270px',
          render: function (data, type, full, meta) {
            var $name = full['client_name'],
              $email = full['email'],
              $image = full['avatar'],
              stateNum = Math.floor(Math.random() * 6),
              states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
              $state = states[stateNum],
              $name = full['client_name'],
              $initials = $name.match(/\b\w/g) || [];
            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
            if ($image) {
              // For Avatar image
              var $output =
                '<img  src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" width="32" height="32">';
            } else {
              // For Avatar badge
              $output = '<div class="avatar-content">' + $initials + '</div>';
            }
            // Creates full output for row
            var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : ' ';

            var $rowOutput =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar' +
              colorClass +
              'me-50">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<h6 class="user-name text-truncate mb-0">' +
              $name +
              '</h6>' +
              '<small class="text-truncate text-muted">' +
              $email +
              '</small>' +
              '</div>' +
              '</div>';
            return $rowOutput;
          }
        },
        {
          // Total Invoice Amount
          targets: 3,
          width: '73px',
          render: function (data, type, full, meta) {
            var $booking = full['booking'];
            return '<span class="d-none">' + $booking + '</span>' + $booking;
          }
        },
        {
          // Total Invoice Amount
          targets: 4,
          width: '73px',
          render: function (data, type, full, meta) {
            var $booking = full['total'];
            return '<span class="d-none">' + $booking + '</span>' + $booking;
          }
        },
        {
          // Total Invoice Amount
          targets: 5,
          width: '73px',
          render: function (data, type, full, meta) {
            var $revenue = full['revenue'];
            return '<span class="d-none">' + $revenue + '</span>' + $revenue;
          }
        },
        {
          // Client Balance/Status
          targets: 6,
          width: '98px',
          render: function (data, type, full, meta) {
            var $balance = full['balance'];
            if ($balance<=50 ) {
              var $badge_class = 'badge-light-danger';
              return '<div class="icon-wrapper"><span class="badge rounded-pill  ' + $badge_class + '"  text-capitalized> Down </span><div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-down"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline><polyline points="17 18 23 18 23 12"></polyline></svg></div>';
            } else {
              var $badge_class = 'badge-light-success';

              return '<div class="icon-wrapper"><span class="badge rounded-pill  ' + $badge_class + '"  text-capitalized> Up </span><div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></div><p class="icon-name text-truncate mb-0 mt-1"></p> </div>';
            }
          }
        },
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
      },
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
