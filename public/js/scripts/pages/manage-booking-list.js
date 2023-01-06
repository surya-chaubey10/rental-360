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

   var customers=[];
   var isRtl = $('html').attr('data-textdirection') === 'rtl'; 
   var dtUserTable = $('.manage-booking-table'),  // here
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),  
    AccountPayment = $('.add-Queck-Payment'),
    newUserSidebar = $('.new-customer-modal'),
    newUserForm = $('.add-manage-booking'),  //here  
    select = $('.select2'), 
    select1 = $('.select3'),  
    dtContact = $('.dt-contact'),
    statusObj = {
      1: { title: 'Pending', class: 'badge-light-success' },
      2: { title: 'Paid', class: 'badge-light-warning' },   
    }  ,
    bookingstatusObj = {
      1: { title: 'Upcoming',class: 'badge-light-success'  },
      2: { title: 'Close',  class: 'badge-light-warning'},   
      3: { title: 'Canceled',  class: 'badge-light-danger'},   
    } ,
    driveObj = {
      1: { title:  'Self Drive'  },
      2: { title:  'Car with Driver' },   
      3: {  title: 'Limousine' },   
    } ;

  var assetPath = '../../../app-assets/',
   
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'app/vendor/view/account';
    leadView = assetPath + 'tabinvoice';
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

  select1.each(function () {
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
      ajax: assetPath + "data/manage-booking-json/" + org_id + "_manage-booking-list.json", // JSON file to add data
       
      columns: [
        // columns according to JSON
        
        { data: 'id' },
        { data: 'name' },
        { data: 'status' }, 
        { data: 'vehicle' },
        { data: 'pickup_address' },  
        { data: 'agent' },
        { data: 'amount' },
        { data: '' }   
        
      ],
      columnDefs: [
       
        {
          // User full name and username
          targets: 0,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $booking_code = full['id']; 
            var $driver_id = full['driver_id']; 
            var $uuid = full['id']; 

          return '<a href="'+leadView+'/'+$uuid+'" > <b> <span >' + "1000" + $booking_code + '<br>'   + 
          driveObj[$driver_id].title +
          '</span>  </b> </a>'  ;
           
        
        }
        },
        {
          // User full name and username
          targets: 1,
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
          targets: 2,
          render: function (data, type, full, meta) { 
            var $payment = full['pay_status'];  
            var $status = full['booking_status'];
            if($payment=='A' || $payment=='A'){
              return '<span class="badge rounded-pill badge-light-success me-1">Paid' +'</span>';
             
            }
           
            else{
              return '<span class="badge rounded-pill badge-light-warning me-1">Pending' +'</span>';

            }
            
          
          }
        }
        ,
        {
          // User Status 
          targets: 3,
          render: function (data, type, full, meta) {
            var $vehicle = full['vehicle'];
            var $model = full['model'];
            if($vehicle==null){
              return 'N/A';
             }else{
              return "<span class='text-truncate align-middle'>"  + $vehicle +'<br>'+$model + '</span>';
             }
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var $pickup_address = full['pickup_address']; 
            var $dropoff_address = full['dropoff_address']; 
          return "<span class='text-truncate align-middle'>"  + $pickup_address + '<br>' + $dropoff_address + '</span>';
        }
        },
        
         
        {
          // User Status 
          targets: 5,
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
        } 
        ,
         
        {
          // User Status 
          targets: 6,
          render: function (data, type, full, meta) {
            var $amount = full['totalDeductions']; 
            if($amount == null){
                $amount='0';
              }
          return "<span class='text-truncate align-middle'>"  + $amount + '</span>';
        }
        } ,
        {
          // Actions
          targets: 7,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) { 
            var $id = full['uuid'];   
            
            var $invoice_uuid = full['uuid'];  
            var $short_link = full['short_link'];  
            var $payment = full['pay_status'];   
            
            var $mobile = full['mobile'];  
            var $booking_status = full['booking_status'];   
      
             var $is_created_invoice = full['is_created_invoice']; 
            var $is_send_invoice = full['is_send_invoice']; 
             if($booking_status== '3' || $payment=='A' || $payment=='H'){  
              
              edit ='manage-booking-edit/'+$id+'';
              return (
                '<div class="btn-group">' +
                '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                    feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                 '</a>'+
                 '<div class="dropdown-menu dropdown-menu-end">' +
                 '<a href="' +
                 edit +
                 '" class="dropdown-item">' + 
                 feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                 'Edit</a>' + '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
                 feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                 'Delete</button>'+'<button class="dropdown-item mtbooking_getuuid"  data-value="'+$id+'" data-bs-toggle="modal" data-bs-target="#manage_invoice">' + feather.icons['credit-card'].toSvg({ class: 'font-small-4 me-50' }) +'Manage Booking Transcation</button>'+
                 '</div>' +
                '<button title="Create Invoice" data-id="' + $id + '" class="dropdown-item booking" id="lighting">'+ feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) +'</button>'+
                '<div class="btn-group">' +
                    '<button title="Quick Payment" data-id="' + $id + '" class="dropdown-item" id="quick_id" data-bs-toggle="modal" data-bs-target="#modals-addslide"><i class="bi bi-lightning"></i></button></div>'+
                '</div>'
              ); 
            } 

            else if($is_created_invoice=='1' && $is_send_invoice=='1'){  
                  edit ='manage-booking-edit/'+$id+'';
                  cancel ='manage-booking-cancel/'+$id+'';
                  Genrate_invoice ='invoice-preview/'+$id+'';  
                  return (
                    '<div class="btn-group">' +
                    '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                    feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                    '</a>' +
                    '<div class="dropdown-menu dropdown-menu-end">' +
                    '<a href="' +
                    edit +
                    '" class="dropdown-item">' + 
                    feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Edit</a>' +  
                   
                    '<button class="dropdown-item getuuid" data-mobile="'+$mobile+'" data-id="'+$short_link+'"  data-value="'+$invoice_uuid+'" data-bs-toggle="modal" data-bs-target="#invoice_preview_popup">' +  feather.icons['credit-card'].toSvg({ class: 'font-small-4 me-50' }) +
                        'Payment Link</button>' + 

                    // '<button data-value="'+$invoice_uuid+'" class="dropdown-item getvalue" >'  +
                    // 'Payment Link</button>'+
                   
                    '<a href="' + cancel + '" class="dropdown-item">' + feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Cancel Booking</a>' +
                    '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Delete</button>'+
                    '<button class="dropdown-item mt_getuuid"  data-value="'+$id+'" data-bs-toggle="modal" data-bs-target="#manage">' + feather.icons['credit-card'].toSvg({ class: 'font-small-4 me-50' }) +'Manage Transcation</button></div>' +
                    '</div>' +
                    '<div class="btn-group">' +
                    '<button title="Quick Payment" data-id="' + $id + '" class="dropdown-item" id="quick_id" data-bs-toggle="modal" data-bs-target="#modals-addslide"><i class="bi bi-lightning"></i></button>' +
                   
                    '</div>'  
                    
                  );

                }else if($is_created_invoice=='1' && $is_send_invoice=='0'){
                  edit ='manage-booking-edit/'+$id+'';
                  cancel ='manage-booking-cancel/'+$id+'';
                  Genrate_invoice ='edit_invoice/'+$id+'';

                  return (
                    '<div class="btn-group">' +
                    '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                    feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                    '</a>' +
                    '<div class="dropdown-menu dropdown-menu-end">' +
                    '<a href="' +
                    edit +
                    '" class="dropdown-item">' +
                    feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Edit</a>' +
      
                    '<a href="' +
                    Genrate_invoice +
                    '" class="dropdown-item">' +
                    feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Update Invoice</a>' +
      
                    '<a href="' +
                    cancel +
                    '" class="dropdown-item">' +
                    feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Cancel Booking</a>' +
                    '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Delete</button>'+
                    '<button class="dropdown-item mt_getuuid"  data-value="'+$id+'" data-bs-toggle="modal" data-bs-target="#manage">' + feather.icons['credit-card'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Manage Transcation</button></div>' +
                    
                    '</div>' +
                    
                    '<div class="btn-group">' +
                    '<button title="Quick Payment" data-id="' + $id + '" class="dropdown-item" id="quick_id" data-bs-toggle="modal" data-bs-target="#modals-addslide"><i class="bi bi-lightning"></i></button>' +
                   
                    '</div>'
                  ); 
                }
                else{
                  edit ='manage-booking-edit/'+$id+'';
                  cancel ='manage-booking-cancel/'+$id+'';
                  Genrate_invoice ='create_invoice/'+$id+'';

                  return (
                    '<div class="btn-group">' +
                    '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                    feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                    '</a>' +
                    '<div class="dropdown-menu dropdown-menu-end">' +
                    '<a href="' +
                    edit +
                    '" class="dropdown-item">' +
                    feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Edit</a>' +
      
                    '<a href="' +
                    Genrate_invoice +
                    '" class="dropdown-item">' +
                    feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Generate Invoice</a>' +
      
                    '<a href="' + cancel + '" class="dropdown-item">' + feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Cancel Booking</a>' +
                    '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Delete</button>'+
            
                    '<button class="dropdown-item mt_getuuid"  data-value="'+$id+'" data-bs-toggle="modal" data-bs-target="#manage">' + feather.icons['credit-card'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Manage Transcation</button></div>' +
                    '</div>'+ 
                    '<div class="btn-group">' +
                    '<button title="Quick Payment" data-id="' + $id + '" class="dropdown-item" id="quick_id" data-bs-toggle="modal" data-bs-target="#modals-addslide"><i class="bi bi-lightning"></i></button>' +
                   
                    '</div>' 
                  ); 
                } 
                  
          }
        } 
       
      ], 
      //order: [[1, 'desc']],
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
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      } ,
       
    });
  }

  if (newUserForm.length) {
    newUserForm.validate({
      errorClass: 'error',
      rules: {
        'select_customer': {
          required: true
        },
        'pickup_date_time': {
          required: true
        },
        'drop_off_date_time': {
          required: true
        },
        'select_vehicle': {
          required: true
        },
        'select_driver': {
          required: true
        }, 
        // 'no_of_traveller': {
        //   required: true
        // },
        // 'pickup_address': {
        //   required: true
        // },
        // 'dropoff_address': {
        //   required: true
        // },
        // 'select_sku': {
        //   required: true
        // } 
        
      }
      
    });}
 
  newUserForm.on('submit', function (e) {
    var booking_type = $('.inlineRadio1').val();
    var sku_count = $('.SKU_error_value').val();
    var selected_sku = $('.select_sku').val();

    if (!e.isDefaultPrevented()) {
        e.preventDefault()
        console.log(booking_type);

        if(booking_type == '1' && sku_count == '1' && (selected_sku=='' || selected_sku == '0')){
          $('#SKU_error').html('Please select SKU.')
          return $('#select_sku').focus();
        }
        if(booking_type == '1' && sku_count == '0' && (selected_sku=='' || selected_sku == '0')){
          $('#SKU_error').html('Not available any SKU in this Brand & Model.')
          return $('#select_sku').focus();
        }

        $( "#submit" ).prop( "disabled", true );
        if (formBlock.length && formSection.length) {
          formBlock.on('click', function () {
            formSection.block({
              message: '<div class="spinner-border text-white" role="status"></div>',
              timeout: 1000,
              css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
              },
              overlayCSS: {
                opacity: 0.5
              }
            });
          });
        }
          let formData = new FormData($('#booking_form')[0])
       $.ajax({
              url: 'save_manage_booking', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              cache : false, 
              processData: false,
              success: function (data) {  
 
                  $( "#submit" ).prop( "disabled", false );
                  if (data.status === true) {
                      toastr['success'](''+data.message+'', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl 
                      });
                      window.location = "/create_invoice" + '/' + data.data.uuid;  
                      //  window.location = "/manage-booking-list" ;  
                  } else if (data.status === false) {
                    $( "#submit" ).prop( "disabled", false );
                    toastr['error'](''+data.message+'', {
                      closeButton: true,
                      tapToDismiss: false,
                      rtl: isRtl
                    });
                     
                  }
              },
              error: function (data) {
                $( "#submit" ).prop( "disabled", false );
                toastr['error'](''+data.message+'', {
                  closeButton: true,
                  tapToDismiss: false,
                  rtl: isRtl
                });
              }
          }) 
      }
  });
  
  // Phone Number
  if (dtContact.length) {
    dtContact.each(function () {
      new Cleave($(this), {
        phone: true,
        phoneRegionCode: 'US'
      });
    });
  }
  
  $(document).on('click', '.getvalue', function () {
   var value=$(this).attr('data-value');
  
    });
     // Confirm Color
     $(document).on('click', '.delete-record', function () {
      const value_id = $(this).data('id')
        console.log(value_id);
        Swal.fire({
          title: 'Destroy Customer?',
          text: 'Are you sure you want to permanently remove this record?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {
  
            deleteRecord(value_id)
            location.reload(true);

            
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'Your imaginary file is safe :)',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          }
        });
      });
  
      function deleteRecord(value_id) {
        $.ajax({
          url: 'bookings-delete'+'/'+value_id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
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
    $(document).on('change', '.select_vehicle', function () {

      const value_id = $(this).val();
      const model_id = 0;
      $('#brand_id').val(value_id);
      $('#selectbrand_id').val(value_id);
        
            brandmodel(value_id,model_id) 
      });

      $(document).on('change', '.select_marchantvehicle', function () {

        const value_id = $(this).val();
        const model_id = 0;
        $('#brand_id').val(value_id);
        $('#selectbrand_id').val(value_id);
          
              marchantbrandmodel(value_id,model_id) 
        });
  
      $(document).on('change', '.select_model', function () {

        const value_id = $(this).val();
        const sku = 0;
        const pickup_date_time=$('#pickup_date_time').val();
        const drop_off_date_time=$('#drop_off_date_time').val();
        const from_date = new Date(pickup_date_time).toLocaleDateString('fr-CA');
        const to_date = new Date(drop_off_date_time).toLocaleDateString('fr-CA');

              check_fleet(value_id,sku,from_date,to_date) 
              
              $('#skudiv').show();
        });

        $(document).on('change', '.select_sku', function () {

          const value_id = $("#select_sku option:selected").text();
          $('#sku').val(value_id);
          });
        
      function brandmodel(value_id,model_id) {
        $.ajax({
          url: '../brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
                $('.select_model').html(data.html);
          },
          error: function (data) {
          }
      });
    }

    function marchantbrandmodel(value_id,model_id) {
    
      $.ajax({
        url: '../marchantbrandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache : false, 
        processData: false,
        success: function (data) {   
              $('.select_marchantmodel').html(data.html);
        },
        error: function (data) {
        }
    });
  }
 
    function check_fleet(value_id,fleet_id,pickup_date_time,drop_off_date_time) {

      $.ajax({
        url: '../get_available_fleet'+'/'+value_id+'/'+fleet_id+'/'+pickup_date_time+'/'+drop_off_date_time, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache : false,  
        processData: false,
        success: function (data) {  
           $('.SKU_error').html("");
           $('.SKU_error_value').val('');
          if(data.status === true){
              $('.select_sku').html(data.html);
              $('.SKU_error_value').val("1");
          }else{
            $('.select_sku').html(data.html);
            $('.SKU_error').html("Not available any SKU in this Brand & Model");
            $('.SKU_error_value').val("0");
          } 
              

        },
        error: function (data) {
        }
    });
  }

//   function fleetvehicle(model,vehicle) {
//     $.ajax({
//       url: '../fleetvehicle'+'/'+model+'/'+vehicle, // JSON file to add data,
//       type: 'get',
//       dataType: 'json',
//       contentType: false,
//       cache : false, 
//       processData: false,
//       success: function (data) {
            
//             $('.select_fleet').html(data.html);
//       },
//       error: function (data) {
//       }
//   });
// }
 
        $(document).ready(function(){
          $(".inlineRadio1").click(function(){
            const value_id = $(this).val();
 
            if(value_id == 1){
              $('#merchant').hide(); 
              $('#auto_dispached').show(); 
              
            }else{
              $('#merchant').show(); 
              $('#auto_dispached').hide(); 
            }
          });
        });


        // $(document).on('change', '.select_customer', function () {

        //   const value_id = $(this).val(); 
        //   $('#brand_id').val(value_id); 
            
        //         customer_data(value_id) 
        //   });
    
        function customer_data(value_id) {
          $.ajax({
            url: '../../customer_data'+'/'+value_id, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false,
            cache : false, 
            processData: false,
            success: function (data) {   
              $('#phone').val(data.mobile); 
              $('#email').val(data.email); 
            },
            error: function (data) {
            }
        });
      }
    
      $(document).on('click', '.getuuid', function () {
       
        var value_id = $(this).attr('data-value');
        var shortlink = $(this).attr('data-id');
        var mobile = $(this).attr('data-mobile');
      //  alert(shortlink);
            $("#booking_uuid").val(value_id)
            $("#shortlink").val(shortlink)
            $("#payment_link").html(shortlink)
            document.getElementById('payment_link').setAttribute('href',shortlink);
            // $("#mobile").val(mobile)
            $("#copy").text(shortlink)
            $("#whatsapp").attr("href", "https://api.whatsapp.com/send?phone=" + mobile+ "&text=" + shortlink )
            $("#url_link").attr("href",shortlink)
        
      });
      $(document).on('focusout', '.merchant_sku', function () {
       
        var merchant_sku = $(this).val() ;
      //  alert(merchant_sku); 
      $.ajax({
        url: 'getting_merchant_sku'+'/'+merchant_sku, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache : false, 
        processData: false,
        success: function (data) {     
            $('.merchant_sku_id').val(data.data['id']);    
            $('.merchant_sku_brand').val(data.data['brand']);    
            $('.merchant_sku_model').val(data.data['model']);    
            toastr['success'](''+data.message+'', {
              closeButton: true,
              tapToDismiss: false,
              rtl: isRtl  
            });
            // $('#merchant_sku_id').val(data); 
        
         
          // $('#email').val(data.email); 
        },
        error: function (data) {
        }
    });
        
      });

      $(document).on('click', '.mtbooking_getuuid', function () { 
           var value_id = $(this).attr('data-value'); 
            $("#mtbooking_uuid").val(value_id) ; 
      });

      $('#tnbooking_submit').click(function(){

        var tn_number = $('#tnbooking_number').val(); 
        var tn_uuid = $('#mtbooking_uuid').val(); 
        var tninvoice_uuid = $('#invoice_idbooking').val(); 
        if(tn_number ==''){
          $('#span_error_tn_number').html('Please Enter Transaction number.')
          return $('#tnbooking_number').focus();
        }
        if(tninvoice_uuid ==''){
          $('#span_error_invoice').html('Please select Invoice.')
          return $('#invoice_idbooking').focus();
        }

        $.ajax({
          url: 'check_invoicetn_number'+'/'+tn_number+'/'+tn_uuid+'/'+tninvoice_uuid, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,     
          success: function (data) {   
           
            if(data == null){
              Swal.fire({
                icon: 'error',
                title: 'Not Found!',
                text: 'Transaction ID Not Found.',
                customClass: {
                  confirmButton: 'btn btn-success'  
                } 
              });
            }else{
              Swal.fire({
                icon: 'success',
                title: 'Maped!',
                text: 'Booking Maped With Transaction.', 
                customClass: {
                  confirmButton: 'btn btn-success'  
                }  
              });
              location.reload(true); 
            }
          },
          error: function (data) {
          }
      });
        
      });


      $(document).on('click', '.mt_getuuid', function () { 
        var value_id = $(this).attr('data-value'); 
            $("#mt_getuuid").val(value_id) ; 
      });
    
 
      $(document).on('click', '#tn_submit', function () {
       
        var tn_number = $('#tn_number').val(); 
        var tn_uuid = $('#mt_getuuid').val(); 
        $.ajax({
          url: 'check_tn_number'+'/'+tn_number+'/'+tn_uuid, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
           
            if(data.status == 'error'){
              Swal.fire({
                icon: 'error',
                title: data.data,
                text: data.message,
                customClass: {
                  confirmButton: 'btn btn-success'  
                } 
              });
            }
            if(data.status == 'success'){
              Swal.fire({
                icon: 'success',
                title: 'Mapped!',
                text: data.message,
                customClass: {
                  confirmButton: 'btn btn-success'  
                }  
              }).then(function() {
                location.reload(true); 
            });

            }
          },
          error: function (data) {
          }
      });
        
      });


      $(document).ready(function(){
        $('#select_customer1').on('keyup',function () {
            var query = $(this).val();
            $.ajax({
                url:'customer_auto_suggestion',
                type:'GET',
                data:{'name':query},
                success:function (data) {
                    $('#customer_list').html(data);
                }
            }) 
        });
        $(document).on('click', '#customer_ul li', function(){
            var value = $(this).text();
            var id = $(this).data('id');

            // $('#select_customer1').val(value);
            
            $('#select_customer_n').val(value);
            // $('#select_customer1').attr('data-id',id);
            $('#customer_list').html(""); 
            $('#select_customer').val(id);
            customer_data(id) ;

            $('#select_customer1').val('');  
           
        });
    });

        $(document).ready(function(){
          $('.merchant_sku').on('keyup',function () {
              var query = $(this).val();
              $.ajax({
                  url:'marchantsku_auto_suggestion',
                  type:'GET',
                  data:{'name':query},
                  success:function (data) {
                      $('#opensku_list').html(data);
                  }
              }) 
          }); 
          $(document).on('click', 'li', function(){
              var value = $(this).text();
              var id = $(this).data('id');
              var model_id = $(this).data('model');
              var brand_id = $(this).data('brand');
             
              $('#opensku_list').html('');
              $('#merchant_sku').val(value); 
              $('#merchant_sku_id').val(id);
              $('#merchant_sku_brand').val(brand_id);
              $('#merchant_sku_model').val(model_id);
              
          });
      });

      $(document).on('click', '#quick_id', function(){ 

        var id=$(this).attr('data-id');
       // console.log(id);
        $.ajax({
          url: 'quick_payment_data'+'/'+id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (response) { 
            
              $('#full_name').val(response.name); 
              $('#phone').val(response.mobile); 
              $('#email').val(response.email); 
              $('#amount').val(response.amount); 
              $('#agent').val(response.id); 
              $('#agent_name').val(response.name); 
              $('#booking_ids').val(response.ids); 
               
          },
          error: function (response) {
            
          }
      }) 
      
      }); 
      
       
       AccountPayment.on('submit', function (e) {
            
       if (!e.isDefaultPrevented()) {
          e.preventDefault()
        $( "#submit" ).prop( "disabled", true );
        if (formBlock.length && formSection.length) {
          formBlock.on('click', function () {
            formSection.block({
              message: '<div class="spinner-border text-white" role="status"></div>',
              timeout: 1000,
              css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
              },
              overlayCSS: {
                opacity: 0.5
              }
            });
          });
        }
      let formData = new FormData($('#form_model')[0])
         $.ajax({
              url: 'booking_addquick_payment', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,  
              contentType: false,
              processData: false,
              success: function (data) {
                   
                  $( "#submit" ).prop( "disabled", false );
                  if (data.status === true) {
                    if(data.data.transaction_type==4){
                      // $('.cancel').click();
                      location.reload();
                   }else{
               
                   $('#mediumModal').modal("show");
                   $('#modals-addslide').modal("hide");
                   $('#adress1').html(data.data.address1);
                   $('#adress2').html(data.data.address2);
                   $('#city').html(data.data.city);
                   $('#street').html(data.data.state);
                   $('#name1').html(data.data.agentname);
                   $('#email1').html(data.data.email);
                   $('#agents').val(data.data.agentname);
                   $('#grand_total').html(data.data.amount);
                   $('#phone_sms').val(data.data.phone);
                   $('#id_sms').val(data.data.id);
                   $('#payment_link').html(data.data.short_link);
                   document.getElementById('my-link').setAttribute('href', 'https://api.whatsapp.com/send?phone='+data.data.phone+'&text='+data.data.short_link);
                  
                    document.getElementById('make_payment').setAttribute('href',data.data.short_link);
                    document.getElementById('payment_link').setAttribute('href',data.data.short_link);

                    $(document).on('click', '#sms_send_data', function(){ 
                    
                    var id = $('#id_sms').val(); 
                       
                        $.ajax({
                            url: "../popupsms_trigger_for_quick" + '/' + id,
                            type: "get",
              
                            cache: false,
                            success: function(res){
                              console.log(res);
              
                              if (res == 'true') {
              
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Sent!',
                                  text: 'Payment link has been sent successfully.',
                                  customClass: {
                                    confirmButton: 'btn btn-success'
                                  }
                                    
                                });
                                
                              }
              
                            }
                        }); 
                      });  
              
                      $('#mail_send_data').on('click', function() { 
                        var id = $('#id_sms').val();  
                        
                            $.ajax({
                                url: "../popupmail_trigger_mail_for_quick" + '/' + id,
                                type: "get",
                                data: { 
                                  _token: $("#csrf").val()
                                },
                                cache: false,
                                success: function(res){
                                    console.log(res);
                    
                                    if (res == 'true') {
                    
                                      Swal.fire({
                                        icon: 'success',
                                        title: 'Sent!',
                                        text: 'Mail has been sent successfully.',
                                        customClass: {
                                          confirmButton: 'btn btn-success'
                                        }
                                          
                                      });
                                      
                                    }
                                }
                            }); 
                          });  

                   }
              
                  } else if (data.status === false) {
                    $( "#submit" ).prop( "disabled", false );
                    toastr['error'](''+data.message+'', {
                      closeButton: true,
                      tapToDismiss: false,
                      rtl: isRtl
                    });
                     
                  }
              },
              error: function (data) {
                $( "#submit" ).prop( "disabled", false );
                toastr['error'](''+data.message+'', {
                  closeButton: true,
                  tapToDismiss: false,
                  rtl: isRtl
                });
              }
          })
      }  
      AccountPayment.on("submit", function (e) {
        var isValid = AccountPayment.valid();
        e.preventDefault();
        if (isValid) {
            newUserSidebar.modal("hide");
        }
      });
  })
 
  $(document).on('click', '.booking', function(){ 
      var id=$(this).attr('data-id');
      window.location = "../bookingdata_get" +'/'+id;    
   });
    
   
  
  //  $(document).on('keyup', '#pickup_address', function(){ 

  //   var x = document.getElementById("pickup_address");
  //   var response ='<iframe id="iframe" width="100%" height="400" zoom="7" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?q='+ x.value +'&output=embed"></iframe><hr>';
  //         $('#showmap').html(response);
  //  });

  //  pickup_address="Dubai";
  // if(pickup_address){
  //   var response ='<iframe id="iframe" width="100%" height="400" zoom="7" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?q='+ pickup_address +'&output=embed"></iframe><hr>';
  //         $('#showmap').html(response);
  //  }
    


    // Vanilla Javascript
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
        // options here
    }));


    $(document).ready(function() {
        $('.iti__flag-container').click(function() { 
            var countryCode = $('.iti__selected-flag').attr('title');
            var countryCode = countryCode.replace(/[^0-9]/g,'')
            $('#phone').val("");
            $('#phone').val("+"+countryCode+" "+ $('#phone').val());
        });
 
    });
 
    
      // $(document).on('click', '#sms_send_data', function(){ 
      //   alert("hello");
      // var id = $('#booking_ids').val(); 
      //  alert(id);
      //     $.ajax({
      //         url: "../popupsms_trigger_for_quick" + '/' + id,
      //         type: "get",

      //         cache: false,
      //         success: function(res){
      //           console.log(res);

      //           if (res == 'true') {

      //             Swal.fire({
      //               icon: 'success',
      //               title: 'Sent!',
      //               text: 'Payment link has been sent successfully.',
      //               customClass: {
      //                 confirmButton: 'btn btn-success'
      //               }
                      
      //             });
                  
      //           }

      //         }
      //     }); 
      //   });  



      $(document).ready(function() {

        var input = document.querySelector("#phone");
      window.intlTelInput(input,({
        preferredCountries: ["ae"],
      }));
      
      
          $('.iti__flag-container').click(function() { 
              var countryCode = $('.iti__selected-flag').attr('title');
              var countryCode = countryCode.replace(/[^0-9]/g,'')
              $('#phone').val("");
              $('#phone').val("+"+countryCode+" "+ $('#phone').val());
          });
      });
      
      // 
      var input = document.querySelector("#merchant_Phone");
      window.intlTelInput(input,({
        preferredCountries: ["ae"],
      }));
      
      $(document).ready(function() {
          $('.iti__flag-container').click(function() { 
              var countryCode = $('.iti__selected-flag').attr('title');
              var countryCode = countryCode.replace(/[^0-9]/g,'')
              $('#merchant_Phone').val("");
              $('#merchant_Phone').val("+"+countryCode+" "+ $('#merchant_Phone').val());
          });
      });

    
});

 