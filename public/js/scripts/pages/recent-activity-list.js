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

   var dtUserTable = $('.manage-booking-table'),
       dtFleetTable = $('.offer-list-table'),  // here

    bookingstatusObj = {
      1: { title: 'paid',class: 'badge-light-success'  },
      2: { title: 'decline',  class: 'badge-light-warning'},   
      // 3: { title: 'Canceled',  class: 'badge-light-danger'},   
    } ,
    statusObj = {
      1: { title: 'Active', class: 'badge-light-success' },
      2: { title: 'Inactive', class: 'badge-light-warning' }
    },
    serviceObj = {
      1: { title: 'Self Drive'},
      2: { title: 'Car with Driver'},
      3: { title: 'Limousine'}
    },
    driveObj = {
      1: { title:  'Self Drive'  },
      2: { title:  'Car with Driver' },   
      3: {  title: 'Limousine' },   
    } ;

    var assetPath = '../../../app-assets/';
   
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'app/vendor/view/account';
    leadView = assetPath + 'tabinvoice';
  }
 

  // Booking Data List
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      ajax: assetPath + "data/dashboard-booking-json/" + org_id + "_manage-booking-list1.json", // JSON file to add data
       
      columns: [
        // columns according to JSON
        { data: '' },  
        { data: 'id' },
        { data: 'name' },
        { data: 'status' }, 
        { data: 'vehicle' },
        { data: 'pickup_address' },  
        { data: 'agent' },
        { data: 'amount' },
       
        
      ],
      columnDefs: [
        {
          // For Responsive
          // className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // User full name and username
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $booking_code = full['id']; 
            var $driver_id = full['driver_id']; 
            var $id = full['id']; 
           if($booking_code==null){
              return 'N/A';
           }else{
          return '<a href="'+leadView+'/'+$id+'" > <b> <span >' + "1000" + $booking_code + '<br>'   + 
          driveObj[$driver_id].title +
          '</span>  </b> </a>'  ;
           }
        
        }
        },
        {
          // User full name and username
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['name']; 
            if($name==null){
              return 'N/A';
           }else{
          return "<span class='text-truncate align-middle'>"  + $name + '</span>';
           }
        }
        },
        {
          // User Status 
          targets: 3,
          render: function (data, type, full, meta) {
            var $status = full['booking_status'];
            return (  
              '<span class="badge rounded-pill ' +
              bookingstatusObj[$status].class +
              '" text-capitalized>' +
              bookingstatusObj[$status].title +
              '</span>'
            );
          }
        }
        ,
        {
          // User Status 
          targets: 4,
          render: function (data, type, full, meta) {
            var $vehicle = full['vehicle'];
            if($vehicle==null){
              return 'N/A';
           }else{
            return "<span class='text-truncate align-middle'>"  + $vehicle + '</span>';
           }
          }
        },
        {
          targets: 5,
          render: function (data, type, full, meta) {
            var $pickup_address = full['pickup_address']; 
            var $dropoff_address = full['dropoff_address']; 
          return "<span class='text-truncate align-middle'>"  + $pickup_address + '<br>' + $dropoff_address + '</span>';
        }
        },
          
         
        {
          // User Status 
          targets: 6,
          render: function (data, type, full, meta) {
            var $image = full['agent']; 
            // $image = full['avatar'];
            if ($image) {
              // For Avatar image
              var $output =
                '<img src="' + assetPath + 'images/organisation/' + $image + '" alt="Avatar" height="32" width="32">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['name'],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-content">' + $initials + '</span>';
            }
            var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar ' +
              colorClass +
              ' me-1">' +
              $output +
              '</div>' + 
              '</div>' +  
              '</div>';
            return $row_output; 
        }
        }, 
        {
          // User Status 
          targets: 7,
          render: function (data, type, full, meta) {
            var $amount = full['amount']; 
            if($amount==null){
              return 'N/A';
           }else{
             return "<span class='text-truncate align-middle'>"  + $amount + '</span>';
           }
           }
        }
      ], 
     // order: [[1, 'desc']],
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
      
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['brand_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
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
      }
      
    });
  }
   
  if (dtFleetTable.length) {
      dtFleetTable.DataTable({
      ajax: assetPath + "data/fleetshow/" + org_id + "_fleetshow.json",
     
      columns: [
        // columns according to JSON
        { data: 'id' },
        { data: 'brand_name' },
        { data: 'car_service_type' },
        { data: 'brand_image' },
        { data: 'model_name' },
        { data: 'status' }
        
      ],

      columnDefs: [
        {
          // User full name and username
          targets: 0,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $id = full['id'];
          
            return "<span class='text-truncate align-middle'>" + $id + '</span>';
          }
        },
        {
          targets: 1,
          render: function (data, type, full, meta) {
             $image = '';
            if ($image) {
              var $output =
                '<img src="'+assetPath+'/vehicle_brand'+ $image + '" alt="Avatar" height="32" width="32">';
            } else {
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = 'null',
                $initials = $name.match(/\b\w/g) || [];
                $output = '<span class="avatar-content">' + $initials + '</span>';
            }
            var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
            var $row_output =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar ' +
              colorClass +
              ' me-1">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $brand_name = full['brand_name'];
          
            return "<span class='text-truncate align-middle'>" + $brand_name + '</span>';
          }
        },
        {
          // User Role
          targets: 3,
          render: function (data, type, full, meta) {
            var $model_name = full['model_name'];
          
            return "<span class='text-truncate align-middle'>" + $model_name + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var $type = full['car_service_type'];

            return '<span class="text-nowrap">' + serviceObj[$type].title + '</span>';
          }
        },
        {
          // User Status
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
      }
    });
  }
$(document).on('click', '.btn0', function () {
var day1=  $('.radio_option1').val();




});
$(document).on('click', '.btn2', function () {
var day1=  $('.radio_option2').val();
});
$(document).on('click', '.btn3', function () {
var day1=  $('.radio_option3').val();
});
$(document).on('click', '.btn4', function () {
var day1=  $('.radio_option4').val();
});
$(document).on('click', '.btn5', function () {
var day1=  $('.radio_option5').val();
});
$(document).on('click', '.btn6', function () {
var day1=  $('.radio_option6').val();
});
$(document).on('click', '.btn7', function () {
  var day1=  $('.radio_option7').val();
  });


  $(document).on('click', '.btn8', function () {
    var day1=  $('.radio_option8').val();
    function deleteRecord(value_id) {
      $.ajax({
        url: '../vendor-delete'+'/'+value_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status === true) {
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Your record has been deleted.',
                customClass: {
                  confirmButton: 'btn btn-success'
                }                 
              });              
              location.reload(true);
            } else if (data.status === false) {              
               
            }
        },
        error: function (data) { 
        }
    })
  } 
      newUserForm.on('submit', function (e) {
        var isValid = newUserForm.valid();
        e.preventDefault();
        if (isValid) {
          newUserSidebar.modal('hide');
        }
      });
      });
                 
});

 