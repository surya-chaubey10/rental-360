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
     var dtUserTable1 = $('.trading-model-table')

      
      select = $('.select2'),
      dtContact = $('.dt-contact'),
      statusObj = {
        0: { title: 'Pending' },
        1: { title: 'Qualified'},
        2: { title: 'Disqualified'},
        3: { title: 'Contacted'},
        4: { title: 'Proposal Sent'},
        5: { title: 'Converted'}
        
      },
  
      sourceObj = {
        1: { title: 'Social Media' },
        2: { title: 'Google'},
        3: { title: 'Direct'},
        4: { title: 'Other'}
      };
  
  
  
    var assetPath = '../../../app-assets/',
      userView = 'app-user-view-account.html';
  
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');

      
    }
  
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
    if (dtUserTable1.length) {
  
      dtUserTable1.DataTable({
        // ajax: assetPath + "data/lead-json/" +org_id+ "_lead-list.json",
        ajax: assetPath + "data/dashboard-company-json/dashboard-trading-list.json",
        columns: [
          // columns according to JSON
          { data: 'name' },
          { data: 'rental' },
          { data: 'trend' }
        ],
        columnDefs: [

          {
            // User full name and username
            targets: 0,
            width:10,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var $name = full['name'];
  
              return '<span class="text-nowrap user_name">' + $name +'</span>';
            }
          },
           
          {
            targets: 1,
            render: function (data, type, full, meta) {
              var $rental = full['rental'];
  
              return '<span class="text-nowrap">' + $rental + '</span>';
            }
          },
         
          {
            targets: 2,
            render: function (data, type, full, meta) {
            var $balance = full['trend'];
            if ($balance<=50 ) {

              var $badge_class = 'badge-light-success';

              return '<div class="icon-wrapper"><span class="badge rounded-pill  ' + $badge_class + '"  text-capitalized> Up </span><div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></div><p class="icon-name text-truncate mb-0 mt-1"></p> </div>';
            }
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
     
      
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        },
         
      });
    }
  
    
  
  });
  