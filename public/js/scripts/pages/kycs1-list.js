/**
 * DataTables Basic
 */

 $(function () {
  'use strict';

  var dt_basic_table = $('.kycs1-list'),
     assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
    var dt_basic = dt_basic_table.DataTable({
      ajax: assetPath + "data/superadmin/company/kycs1-json/_kycs1-datatable.json",
      columns: [
        
        { data: 'ow_doc_type1'},
        { data: 'ow_document1' },
        { data: 'modify' }  
        
      ],
      columnDefs: [
        {
          // User full name and username
          targets: 0,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $ow_doc_type1 = full['ow_doc_type1']; 
           
           if($ow_doc_type1==null){
            return 'N/A';
           }else{
          return "<span class='text-truncate align-middle'>"  + ($ow_doc_type1 == '1' ? 'Passport ID' : ($ow_doc_type1 == '2' ? 'Resident ID' : ($ow_doc_type1 == '3' ? 'License ID' : ($ow_doc_type1 == '4' ? 'Extra' : '')))) + '</span>';
           }
        }
        },
        {
          // User full name and username
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $ow_document1 = full['ow_document1']; 
            if($ow_document1==null){
              return 'N/A';
             }else{
          return "<span class='text-truncate align-middle'>"  + $ow_document1 + '</span>';
             }
        }
        },
         {
          // Actions
          targets:2,
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
              return 'Details of ' + data['document'];
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
