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
      dtContact = $('.dt-contact'),
      statusObj = {
        1: { title: 'Active', class: 'badge-light-success' },
        2: { title: 'Inactive', class: 'badge-light-warning' }
      };
  
    var assetPath = '../../../app-assets/',
      userView = 'app-user-view-account.html';
  
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
      userView = assetPath + 'offer-edit';
      offercopy = assetPath + 'offer-copy';
      
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
         ajax: assetPath + 'data/salesinvoice-datatable.json',
        //add data
        columns: [
          // columns according to JSON
          { data: 'id' },
          { data: 'invoice_no' },
          { data: 'client' },
          { data: 'sub_total' },
          { data: 'transport' },
          { data: 'discount' },
          { data: 'tax' },
          { data: 'net_total' },
          { data: 'total_paid' },
          { data: 'total_due' },
          { data: 'date' },
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
            // User full name and username
            targets: 1,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var $invoice_no = full['invoice_no'];
            
              return "<span class='text-truncate align-middle'>" + $invoice_no + '</span>';
            }
          },
          {
            targets: 2,
            render: function (data, type, full, meta) {
              var date = full['date'];
          
              return '<span class="text-nowrap">' + date + '</span>';
            }
          },
          {
            // User Role
            targets: 3,
            render: function (data, type, full, meta) {
              var $client = full['client'];
            
              return "<span class='text-truncate align-middle'>" + $client + '</span>';
            }
          },
          {
            targets: 4,
            render: function (data, type, full, meta) {
              var $sub_total = full['sub_total'];
  
              return '<span class="text-nowrap">' + $sub_total + '</span>';
            }
          },
          {
            targets: 5,
            render: function (data, type, full, meta) {
              var transport = full['transport'];
          
              return '<span class="text-nowrap">' + transport + '</span>';
            }
          },
          {
            targets: 6,
            render: function (data, type, full, meta) {
              var discount = full['discount'];
          
              return '<span class="text-nowrap">' + discount + '</span>';
            }
          },
          {
            targets: 7,
            render: function (data, type, full, meta) {
              var tax = full['tax'];
          
              return '<span class="text-nowrap">' + tax + '</span>';
            }
          },
          {
            targets: 8,
            render: function (data, type, full, meta) {
              var net_total = full['net_total'];
          
              return '<span class="text-nowrap">' + net_total + '</span>';
            }
          },
          {
            targets: 9,
            render: function (data, type, full, meta) {
              var total_paid = full['total_paid'];
          
              return '<span class="text-nowrap">' + total_paid + '</span>';
            }
          },
          {
            targets: 10,
            render: function (data, type, full, meta) {
              var total_due = full['total_due'];
          
              return '<span class="text-nowrap">' + total_due + '</span>';
            }
          },
          
          {
            // User Status
            targets: 11,
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
          },
          {
              // Actions
            targets: 12,
            render: function (data, type, full, meta) {
            
              return (
                '<div class="btn-group">' +
                '<a href="#" class="dropdown-item">' +
                feather.icons['eye'].toSvg({ class: 'font-small-4 me-50' }) +
                '</a>' 
                +'<a href="#"  class="dropdown-item ">' +
                feather.icons['edit-2'].toSvg({ class: 'font-small-4 me-50' }) +
                '</a></div>' +
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
                
                location.reload(true);
              } else if (data.status === false) {
                
                 
              }
          },
          error: function (data) {
            
          }
      })
    }
  });
  