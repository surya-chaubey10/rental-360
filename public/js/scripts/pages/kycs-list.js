/**
 * DataTables Basic
 */

 $(function () {
  'use strict';

  var dt_basic_table = $('.kycs-list'),
     assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
    dt_basic_table.DataTable({
        ajax: assetPath + "data/superadmin/company/kycs-json/_kycs-datatable.json",
      columns: [
        
        { data: 'id' },
        { data: 'bank_name' },
        { data: 'iban_code' },
        { data: 'status'},
        { data: '' },
        { data: '' },
        { data: '' }  
        
      ],
      columnDefs: [
        {
          // User full name and username
          targets: 0,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $id = full['id']; 

          return "<span class='text-truncate align-middle'>"  + $id + '</span>';
        }
        },
        {
          // User full name and username
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $bank_name = full['bank_name']; 

          return "<span class='text-truncate align-middle'>"  + $bank_name + '</span>';
        }
        },
        {
          // User full name and username
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $iban_code = full['iban_code']; 

          return "<span class='text-truncate align-middle'>"  + $iban_code + '</span>';
        }
        },
        {
          // Label
          targets: 3,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              0: { title: 'Pending', class: 'badge-light-success' },
              1: { title: 'Accepted', class: 'badge-light-success' },
              2: { title: 'Rejected', class: 'badge-light-danger' },
             
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        { 
         
          targets: 4,
          title: 'Primary',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<a >' +
             feather.icons['square'].toSvg({ class: 'font-small-4 me-50' }) +
             '</a>' 
             );
          }
        },
        {
          // Label
          targets: 5,
          title: 'Active',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<a style="font-size:50px">' +
             feather.icons['unlock'].toSvg({ class: 'font-small-4 me-50' }) +
             '</a>' 
             );
          }
        },
        {
          // Actions
          targets:6,
          title: 'Status',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
               '<a style="font-size:50px">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              '</a>' +
              '<a style="font-size:50px; color:red;">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              '</a>' 
              );
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
      },
        
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['bank_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
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
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
    
  }
  
});
