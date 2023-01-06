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
   var dtUserTable = $('.offer-list-table'),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
    newUserForm = $('.add-new-offer'),
  
    select = $('.select2'),

    statusObj = {
      1: { title: 'Active', class: 'badge-light-success' },
      2: { title: 'Inactive', class: 'badge-light-warning' }
    },
    serviceObj = {
      1: { title: 'Self Drive'},
      2: { title: 'Car with Driver'},
      3: { title: 'Limousine'}
    };
    
    var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    fleetEdit = assetPath + 'fleet-edit'; 
    fleetDelete = assetPath + 'fleet-delete';
    fleetCalendar = assetPath + 'fleet-calendar';
    
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

  if (dtUserTable.length) {
    dtUserTable.DataTable({
      ajax: assetPath + "data/fleetshow/" + org_id + "_fleetshow.json",
     
      columns: [
        // columns according to JSON
        // { data: 'id' },
        { data: 'brand_name' },
        { data: 'car_service_type' },
        { data: 'brand_image' },
        { data: 'model_name' },
        { data: 'status' }
        
      ],

      columnDefs: [
          // {
          // // User full name and username
          // targets: 0,
          // responsivePriority: 4,
          // render: function (data, type, full, meta) {
          //   var $id = full['id'];
          
          //   return "<span class='text-truncate align-middle'>" + $id + '</span>';
          // }
          // },
          {
          targets: 0,
          render: function (data, type, full, meta) {
             var image = full['image'];
            
              if(image) {
               var array = image.split(",");
            
              var $output =
                '<img src="'+assetPath+'public/images/fleet_images/'+ array[0] + '" alt="Avatar" height="32" width="32">';
            } else {
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = 'null', 
                $initials = $name.match(/\b\w/g) || [];
                $output = '<span class="avatar-content">' + $initials + '</span>';
            }
            var colorClass = image === '' ? ' bg-light-' + $state + ' ' : '';
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
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $brand_name = full['brand_name'];
          
            return "<span class='text-truncate align-middle'>" + $brand_name + '</span>';
          }
        },
        {
          // User Role
          targets: 2,
          render: function (data, type, full, meta) {
            var $model_name = full['model_name'];
          
            return "<span class='text-truncate align-middle'>" + $model_name + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $type = full['car_service_type'];

            return '<span class="text-nowrap">' + serviceObj[$type].title + '</span>';
          }
        },
        {
          // User Status
          targets: 4,
          render: function (data, type, full, meta) {
              var $status = full['status'];
              var $id = full['id'];
              return (
              /* --29-11-2022-- 
                '<span class="badge rounded-pill ' +
                statusObj[$status].class +
                '" text-capitalized>' +
                statusObj[$status].title +
                '</span>' */
                '<input type="checkbox" id='+$id+' class="toggle" '+($status==1 ? `Checked` : '') +' data-on="Active" data-off="Inactive" data-toggle="toggle">'
             

              );
          }
        },
        {
            // Actions
          targets: 5,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            var $uuid = full['uuid'];
            var $did = full['id'];
            return (
              '<div class="btn-group">' 

              +'<a title="Calendar" href="'+fleetCalendar +'/'+$uuid+'" class="dropdown-item ">' +
              feather.icons['calendar'].toSvg({ class: 'font-small-4 me-50' }) +
              '</a>'+

              '<a title="Edit" href="'+fleetEdit +'/'+$uuid+
              '"  class="dropdown-item ">' +
              feather.icons['edit-2'].toSvg({ class: 'font-small-4 me-50' }) +
              '</a>'+

              '<button title="Delete" data-id="'+$did+'"  class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                '</button></div>' +
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
         }
      ],
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
              // location.reload(true); 
            } else if (data.status === false) {
              
            }
        },
        error: function (data) {
          
        }
    })
  }

  $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id')
    const event= $(this);
      Swal.fire({
        title: 'Destroy Fleet?',
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

          deleteRecord(value_id,event)
          
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

    function deleteRecord(value_id,event) {
      $.ajax({
        url: 'fleet-delete'+'/'+value_id, // JSON file to add data,
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
                },  
                 
              });
             /*  dtUserTable = $('.offer-list-table') */
            
           event.closest('tr').remove();
           
              // location.reload(true);
            } else if (data.status === false) {
              
               
            }
           
        },
        error: function (data) {
          
        } 
        
    })
 
  }

});


// 29-11-2022
//toggle button 

$(document).ready(function(){
  $(document).on('click', '.toggle', function() {
  const thisRef = $(this);
  
  
  thisRef.text('Processing');
  $.ajax({
  type: 'GET',
  url: 'toggle/'+thisRef.attr('id'),
  success:function(response) {
    var response = JSON.parse(response);
    if(response == 'success'){
      console.log('success')
    } else {
      console.log('failed')
    }
  }
  });
  });
  });