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

  var dtInvoiceTable = $('.campaigns-list-table'),
    assetPath = '../../../app-assets/',
    invoicePreview = 'app-invoice-preview.html',
    invoiceAdd = 'app-invoice-add.html',
    invoiceEdit = 'app-invoice-edit.html',
    statusObj = {
      1: { title: 'New', class: 'badge-light-danger' },
      2: { title: 'Sending', class: 'badge-light-success' },  
      3: { title: 'Ready', class: 'badge-light-warning' },  
      4: { title: 'Done', class: 'badge-light-secondary' },  
    };

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    invoicePreview = assetPath + 'app/invoice/preview';
    invoiceAdd = assetPath + 'app/invoice/add';
    invoiceEdit = assetPath + 'app/invoice/edit';
  }

  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
      ajax: assetPath + 'data/campaigns.json', // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'responsive_id' }, 
        { data: 'invoice_status' },
        { data: 'issued_date' },
        { data: 'client_name' }, 
        { data: 'status' },   
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
          // Client name and Service
          targets: 1 ,
          responsivePriority: 4, 
          render: function (data, type, full, meta) {
            var   $name = full['client_name'];
            var   $regular = full['regular'];
            var   $recepient = full['recepient'];
            var   $update = full['update'];
            return '<span class="d-none">' + $name + '</span>' + $name+'<br>' + '<small class="text-truncate text-muted">' +
            $regular +
            '</small>'+'<br>' + '<small class="text-truncate text-muted">' +
            $recepient +
            '</small>'+'<br>' + '<small class="text-truncate text-muted">' +
            $update +
            '</small>' ;
          }
           
        },
         

        {
          // Client Balance/Status
          targets: 2, 
          render: function (data, type, full, meta) {
            var $price = full['rental'];
            if ($price === 0) {
              var $badge_class = 'badge-light-success';
              return'<div class="progress progress-bar-primary" style="height: 6px">'+
              '<div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>'+
            '</div>';
            } else {
              return '<div class="progress progress-bar-primary" style="height: 6px">'+
              '<div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>'+
            '</div><span class="d-none trending-up" >' + $price + '</span>' + $price+'<br>Open Rate';
            }
          }
        },


      
        {
          // Client Balance/Status
          targets: 3, 
          render: function (data, type, full, meta) {
            var $price = full['available'];
            if ($price === 0) {
              var $badge_class = 'badge-light-success';
              return'<div class="progress progress-bar-primary" style="height: 6px">'+
              '<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>'+
            '</div>';
            } else {
              return '<div class="progress progress-bar-primary" style="height: 6px">'+
              '<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>'+
            '</div><span class="d-none trending-up" >' + $price + '</span>' + $price+'<br>Click Rate';
            }
          }
        },
        
        {
          // Client Balance/Status
          targets: 4, 
          render: function (data, type, full, meta) {
            var $price = full['available'];
            if ($price === 0) {
              var $badge_class = 'badge-light-success';
              return'<div class="progress progress-bar-primary" style="height: 6px">'+
              '<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>'+
            '</div>';
            } else {
              return '<div class="progress progress-bar-primary" style="height: 6px">'+
              '<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>'+
            '</div><span class="d-none trending-up" >' + $price + '</span>' + $price+'<br>Click Rate';
            }
          }
        },

        {
          // Client Balance/Status
          targets: 5, 
          render: function (data, type, full, meta) {
            var $status = full['status'];
            return (
              '<span class="badge rounded-pill ' +
              statusObj[$status].class +
              '" text-capitalized>' +
              statusObj[$status].title +
              '</span>'
            );
          }
        },
     
        {
          // Actions
          targets: 6,
          title: 'Actions', 
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              
              // '<a class="me-1" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Mail">' +
              // feather.icons['send'].toSvg({ class: 'font-medium-2 text-body' }) +
              '<div class="d-flex align-items-center col-actions">' +
              
              '<a style="text-decoration:none; color:white;" class="me-25" href="#' +
              invoicePreview +
              '" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview Invoice">' +
              '<div class="btn btn-danger" >Edit'+
              
              '</a>' +'</div>'+ 
              '<div class="dropdown">' +
              '<a class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="#" class="dropdown-item">' +
              feather.icons['download'].toSvg({ class: 'font-small-4 me-50' }) +
              'Download</a>' +
              '<a href="' +
              invoiceEdit +
              '" class="dropdown-item">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Edit</a>' +
              '<a href="#" class="dropdown-item">' +
              feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) +
              'Delete</a>' +
              '<a href="#" class="dropdown-item">' +
              feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) +
              'Duplicate</a>' +
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [1, 'desc'],
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