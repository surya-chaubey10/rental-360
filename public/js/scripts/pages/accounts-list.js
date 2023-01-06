/**
 * DataTables Basic
 */

 $(function () {
  'use strict';

  var dt_basic_table = $('.accounts-list'),
       assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
    var dt_basic = dt_basic_table.DataTable({
      ajax: assetPath + 'data/accounts-datatable.json',
      columns: [
        
        { data: '#' },
        { data: 'bank_name' },
        { data: 'branch_name' },
        { data: 'account_number' },
        { data: 'availabe_balance' },
        { data: 'date'},
        { data: '' } ,
        { data: '' }  
        
      ],
      columnDefs: [
        
        {
          // Label
          targets: -2,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              1: { title: 'Active', class: 'badge-light-success' } 
              
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
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a href="view-account"><img src="https://cdn-icons-png.flaticon.com/128/736/736960.png" data-src="https://cdn-icons-png.flaticon.com/128/736/736960.png" alt="Transaction " title="Transaction " width="18" height="18" class="lzy lazyload--done" srcset="https://cdn-icons-png.flaticon.com/128/736/736960.png 4x"></a>' +
             '<div style="margin:0px -4px 0px 15px; color:black;">'+
              '<a href="edit-account" class="pe-1 dropdown-toggle">' +
              feather.icons['edit-2'].toSvg({ class: 'font-small-4' }) +
              '</a>'+'</div>' +
              '</div>'   
               
            );
          }
        }
      ],

       
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['plane_name'];
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
