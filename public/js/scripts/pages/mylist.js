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
  var dtUserTable = $('.invoice-list-table'),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
    newUserForm = $('.add-new-offer'),
    
    
    select = $('.select2'),
    dtContact = $('.dt-contact'),
    statusObj = {
      1: { title: 'Subscribers', class: 'badge-light-success' },
      2: { title: 'Unsubscribers', class: 'badge-light-warning' }
    };

  var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'offer-edit';
    payrollview = assetPath + 'payroll-view';
    
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
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      ajax: assetPath + 'data/mylist.json', // JSON file to add data
      //add data
      columns: [
        // columns according to JSON
        // { data: 'responsive_id' },
       
        { data: 'rental' },
        { data: 'available' },
        { data: 'price' },
        { data: 'responsive_id' },
        { data: 'created' },
        { data: 'client_name' }
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
          width: '170px',
          render: function (data, type, full, meta) {
            var $name = full['client_name'],
              $email = full['created'],
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
          targets: 2,
          width: '223px',
          render: function (data, type, full, meta) {
            var $booking = full['price'];
            return '<span class="d-none">' + $booking + '</span>' + $booking+'<br>Subscribers';
          }
        },

        {
          // Client Balance/Status
          targets: 3,
          width: '298px',
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
          targets: 4,
          width: '298px',
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
          // Actions
          targets:5,
          title: 'Actions',
      
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center col-actions">' +
              // '<a class="me-1" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Mail">' +
              // feather.icons['send'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +
              
              '<a class="me-25" href="#' +
             
              '" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview Invoice">' +
              feather.icons['user'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +
              '<a style="text-decoration:none; color:white;" class="me-25" href="#' +
             
              '" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview Invoice">' +
              '<div class="btn btn-danger" >Statistics'+
            
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
      // // buttons: [
      // //   {
      // //     extend: 'collection',
      // //     className: 'btn btn-outline-secondary dropdown-toggle me-2',
      // //     text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
      // //     buttons: [
      // //       {
      // //         extend: 'print',
      // //         text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
      // //         className: 'dropdown-item',
      // //         exportOptions: { columns: [1, 2, 3, 4, 5] }
      // //       },
      // //       {
      // //         extend: 'csv',
      // //         text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
      // //         className: 'dropdown-item',
      // //         exportOptions: { columns: [1, 2, 3, 4, 5] }
      // //       },
      // //       {
      // //         extend: 'excel',
      // //         text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
      // //         className: 'dropdown-item',
      // //         exportOptions: { columns: [1, 2, 3, 4, 5] }
      // //       },
      // //       {
      // //         extend: 'pdf',
      // //         text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
      // //         className: 'dropdown-item',
      // //         exportOptions: { columns: [1, 2, 3, 4, 5] }
      // //       },
      // //       {
      // //         extend: 'copy',
      // //         text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
      // //         className: 'dropdown-item',
      // //         exportOptions: { columns: [1, 2, 3, 4, 5] }
      // //       }
      // //     ],
      //     init: function (api, node, config) {
      //       $(node).removeClass('btn-secondary');
      //       $(node).parent().removeClass('btn-group');
      //       setTimeout(function () {
      //         $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
      //       }, 50);
      //     }
      //    }
      // ],
      // For responsive popup
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
      }
    });
  }

  newUserForm.on('submit', function (e) {
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
          let formData = new FormData($('#form_idd')[0])
       $.ajax({
              url: '/../offer-save', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              processData: false,
              success: function (data) {
                  $( "#submit" ).prop( "disabled", false );
                  if (data.status === true) {

                      toastr['success'](''+data.message+'', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                      });

                      window.location = "/offer-list";

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
  })
  
// Form Validation
if (newUserForm.length) {
  newUserForm.validate({
    errorClass: 'error',
    rules: {
      'offer_category': {
        required: true
      },
      'image_path': {
        required: true
      },
      'startdate': {
        required: true
      },'enddate': {
        required: true
      },
      'starttime': {
        required: true
      },'endtime': {
        required: true
      },
      'minimum': {
        required: true
      },'maximum': {
        required: true
      },'status': {
        required: true
      }
    }
  });

}

   // Confirm Color
   $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id')
      console.log(value_id);
      Swal.fire({
        title: 'Destroy Offer?',
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
        url: 'offer-delete'+'/'+value_id, // JSON file to add data,
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
});
