/**
 * DataTables Basic
 */

 $(function () {
    'use strict';
  
    var dt_basic_table = $('.expenses-table'),
      dt_date_table = $('.dt-date'),
      dt_complex_header_table = $('.dt-complex-header'),
      dt_row_grouping_table = $('.dt-row-grouping'),
      dt_multilingual_table = $('.dt-multilingual'),
      assetPath = '../../../app-assets/';
  
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
    }
  
    // DataTable with buttons
    // --------------------------------------------------------------------
  
    if (dt_basic_table.length) {
      var dt_basic = dt_basic_table.DataTable({
        ajax: assetPath + 'data/expenses-table.json',
        columns: [
          { data: 's_no' },
          {  
             targets: 2,
             title: 'Image',
             orderable: false,
             render: function (data, type, full, meta) {
               var $id = full['uuid'];
               return (
                '<img src="A"  height="32" width="32">' 
               );
             }
            }, 
            { data: 'exp_resan'},
          { data: 'category' },
          { data: 'sub_name' }, 
          { data: 'amount' },
          { data: 'acount' },
          { data: 'date' }, 
          { data: 'status' },
          {
            // Actions
            targets: 11,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              var $id = full['uuid'];
              return (
                '<div class="eye">' +
                 
                '<a class="eye">' +
                feather.icons['eye'].toSvg({ class: 'font-small-4' }) +
                '</a>' + 
                '</div>'+
                '<div class="edit-2">' +
                '<a class="edit-2">' +
                feather.icons['edit-2'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                 
                '</div>'
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
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        } ,
        buttons: [
          {
              extend: "collection",
              className: "btn btn-outline-secondary dropdown-toggle me-2",
              text:
                  feather.icons["external-link"].toSvg({
                      class: "font-small-4 me-50",
                  }) + "Export",
              buttons: [
                  {
                      extend: "print",
                      text:
                          feather.icons["printer"].toSvg({
                              class: "font-small-4 me-50",
                          }) + "Print",
                      className: "dropdown-item",
                      exportOptions: { columns: [1, 2, 3, 4, 5] },
                  },
                  {
                      extend: "csv",
                      text:
                          feather.icons["file-text"].toSvg({
                              class: "font-small-4 me-50",
                          }) + "Csv",
                      className: "dropdown-item",
                      exportOptions: { columns: [1, 2, 3, 4, 5] },
                  },
                  {
                      extend: "excel",
                      text:
                          feather.icons["file"].toSvg({
                              class: "font-small-4 me-50",
                          }) + "Excel",
                      className: "dropdown-item",
                      exportOptions: { columns: [1, 2, 3, 4, 5] },
                  },
                  {
                      extend: "pdf",
                      text:
                          feather.icons["clipboard"].toSvg({
                              class: "font-small-4 me-50",
                          }) + "Pdf",
                      className: "dropdown-item",
                      exportOptions: { columns: [1, 2, 3, 4, 5] },
                  },
                  {
                      extend: "copy",
                      text:
                          feather.icons["copy"].toSvg({
                              class: "font-small-4 me-50",
                          }) + "Copy",
                      className: "dropdown-item",
                      exportOptions: { columns: [1, 2, 3, 4, 5] },
                  },
              ],
              init: function (api, node, config) {
                  $(node).removeClass("btn-secondary");
                  $(node).parent().removeClass("btn-group");
                  setTimeout(function () {
                      $(node)
                          .closest(".dt-buttons")
                          .removeClass("btn-group")
                          .addClass("d-inline-flex mt-50");
                  }, 50);
              },
          } ,
      ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return 'Details of ' + data['full_name'];
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
        
       
      });
    }
   
  
  
  
  
  });
  
  