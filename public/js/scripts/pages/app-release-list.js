/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
  ('use strict');
 
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   })
   var isRtl = $('html').attr('data-textdirection') === 'rtl';
   var confirmColor = $('.delete-record');
   var dtUserTable = $('.communication-list-table'),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
    newUserForm = $('.add-new-offer'),
  
    select = $('.select2'),

    statusObj = {
      1: { title: 'Approved', class: 'badge-light-success' }, 
      2: { title: 'Rejected',  class: 'badge-light-warning'}   
       
    };
     
    var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';


  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

    select.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        // the following code is used to disable x-scrollbar when click in select input and
        // take 100% width in responsive also
        dropdownAutoWidth: true,
        width: '100%',
        dropdownParent: $this.parent()
      });
    });
  
    // Users List datatable

    if (dtUserTable.length) {
      dtUserTable.DataTable({
        ajax: assetPath + '/data/superadmin/request/FinanceRelease-json/_release-list.json', // JSON file to add data
        columns: [
          // columns according to JSON 

       
          { data: 'company_name' },
          { data: 'withdraw_amount' },
          { data: 'withdraw_fees' },
          { data: 'request_on' },
          { data: 'last_approval_date' },
          { data: 'status' },
          { data: '' },
        
        ], 
        columnDefs: [
          {
            // For Responsive
            className: 'control',
            orderable: false,
            responsivePriority: 2,
            targets: 0,
            render: function (data, type, full, meta) {
              return '';
            }
          },
          {
            targets: 1,
            render: function (data, type, full, meta) {
              var $company_name = full['company_name'];
  
              return '<span class="text-nowrap">' + $company_name + '</span>';
            }
          },
          {
            targets: 2,
            render: function (data, type, full, meta) {
              var $withdraw_amount = full['withdraw_amount'];
  
              return '<span class="text-nowrap">' + $withdraw_amount + '</span>';
            }
          },
          {
            targets: 3,
          render: function (data, type, full, meta) {
            var $withdraw_fees = full['withdraw_fees'];

            return '<span class="text-nowrap">' + $withdraw_fees + '</span>';
            }
          },
          {
            targets: 4,
          render: function (data, type, full, meta) {
            var $request_on = full['request_on'];

            return '<span class="text-nowrap">' + $request_on + '</span>';
            }
          },
          {
           
            targets: 5,
            render: function (data, type, full, meta) {
              var $last_approval_date = full['last_approval_date'];
  
              return '<span class="text-nowrap">' + $last_approval_date + '</span>';
              }
          },
 
          {
          
            targets: 6,
            render: function (data, type, full, meta) {
              var $status = full['status'];
              if($status==1){
              return (               
                '<span class="badge rounded-pill ' +
                statusObj[$status].class +
                '" text-capitalized>' +
                statusObj[$status].title +       
                '</span>'
              );
              }else{
                return (               
                  '<span class="badge rounded-pill ' +
                  statusObj[$status].class +
                  '" text-capitalized>' +
                  statusObj[$status].title +       
                  '</span>'
                );
              }
            }
          },

          {
            // Actions
            targets: 7,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) { 
                var $id = full['id'];
               
              return (
                '<div class="btn-group">' +
                
              
                '<a class="btn btn-sm dropdown-toggle hide-arrow"  data-bs-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-end">' +
                 
                '<button data-value="1" class="dropdown-item" id="release" data-id="'+$id+'">' + 
                'Release Approved</button>'+'<button data-value="2" class="dropdown-item" id="rejected" data-id="'+$id+'">' + 
                'Release Rejected</button></div>' +
                '</div>' +
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
          '<"col-sm-12 col-md-6"i>' +
          '<"col-sm-12 col-md-6"p>' +
          '>',
        language: {
          sLengthMenu: 'Show _MENU_',
          search: 'Search',
          searchPlaceholder: 'Search..'
        },
        // Buttons with Dropdown
        buttons: [
          {
            extend: 'collection',
            className: 'btn btn-outline-secondary dropdown-toggle me-2',
            text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
            buttons: [
              {
                extend: 'print',
                text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                className: 'dropdown-item',
                exportOptions: { columns: [1, 2, 3, 4, 5] }
              },
              {
                extend: 'csv',
                text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                className: 'dropdown-item',
                exportOptions: { columns: [1, 2, 3, 4, 5] }
              },
              {
                extend: 'excel',
                text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                className: 'dropdown-item',
                exportOptions: { columns: [1, 2, 3, 4, 5] }
              },
              {
                extend: 'pdf',
                text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                className: 'dropdown-item',
                exportOptions: { columns: [1, 2, 3, 4, 5] }
              },
              {
                extend: 'copy',
                text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                className: 'dropdown-item',
                exportOptions: { columns: [1, 2, 3, 4, 5] }
              }
            ],
            init: function (api, node, config) {
              $(node).removeClass('btn-secondary');
              $(node).parent().removeClass('btn-group');
              setTimeout(function () {
                $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
              }, 50);
            }
          },
          
        ],
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        },
       
                });
            };

            $(document).on('click', '#release', function(){ 

              var id=$(this).attr('data-id');
              var checked=$(this).attr('data-value');
             
            $.ajax({
              url: 'store_gl'+'/'+id+'/'+checked, // JSON file to add data,
              type: 'get',
              dataType: 'json',
              contentType: false,
              cache : false, 
              processData: false,
              success: function (data) { 
               location.reload();
              },
              error: function (response) {
                
              }
          }) 
          }); 

          $(document).on('click', '#rejected', function(){ 

            var id=$(this).attr('data-id');
            var checked=$(this).attr('data-value');
            
          $.ajax({
            url: 'store_gl'+'/'+id+'/'+checked, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false,
            cache : false, 
            processData: false,
            success: function (data) { 
             location.reload();
            },
            error: function (response) {
              
            }
        }) 
        });
          
        });
     
  