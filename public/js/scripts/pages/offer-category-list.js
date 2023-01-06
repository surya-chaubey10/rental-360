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
     var dtUserTable = $('.offer-category-table'),
      formBlock = $('.btn-form-block'),
      formSection = $('.form-block'), 
      newUserSidebar = $('.new-vendor-modal'),
      newUserForm = $('.add-offer-category'), 
      select = $('.select2'), 
      dtContact = $('.dt-contact'),
      statusObj = {
        1: { title: 'Enable', class: 'badge-light-success' },
        2: { title: 'Disable', class: 'badge-light-warning' }, 
      };
  
    var assetPath = '../../../app-assets/',
      userView = 'app-user-view-account.html';
  
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
      userView = assetPath + 'app/vendor/view/account';
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
        ajax: assetPath + "/data/offer-category/" + org_id + "_offercatagory.json",
        columns: [
          // columns according to JSON
          { data: 'id' },  
          { data: 'category_name' }, 
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
            // User full name and username
            targets: 1, 
            render: function (data, type, full, meta) {
              var $num = full['id']; 
              return '<span class="text-nowrap">' + $num + '</span>'; 
            }
          },
          {
          targets: 2, 
          render: function (data, type, full, meta) {
            var $category_name = full['category_name']; 
            if($category_name==null){
               return 'N/A';
            }else{
            return '<span class="text-nowrap">' + $category_name + '</span>'; 
            }
          }
        },
          {
            // User Status 
            targets: 3,
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
            targets: 4,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              var $id = full['id'];
              return (
                '<div class="btn-group">' + 
               
                '<a href="update-offer-category/' +
                $id +
                '" class="dropdown-item">' +
                feather.icons['edit-2'].toSvg({ class: 'font-small-4 me-50' }) +
                ' </a>' + 
                '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                ' </button>' +
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
          // {
          //   text: 'Add New Vendor',
          //   className: 'add-new btn btn-primary',
          //   attr: { 
          //     'data-bs-toggle': 'modal',
          //     'data-bs-target': '#modals-slide-in'
          //   },
          //   init: function (api, node, config) {
          //     $(node).removeClass('btn-secondary');
          //   }
          // }
        ],
        // For responsive popup
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return 'Details of ' + data['category_name'];
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
        },
         
      });
    }

    // Form Validation
if (newUserForm.length) {
  newUserForm.validate({
    errorClass: 'error',
    rules: {
      'category_name': {
        required: true
      },
      'status': {
        required: true
      } 
      
    }
  });}

   

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
            let formData = new FormData($('#addoffercategory')[0])
         $.ajax({
                url: 'offer-category-save', // JSON file to add data,
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
                        window.location = "/offer-category-list"; 
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
    })   ;
  
  

      //Delete Vendor Record
        // Confirm Color
   $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id');
    const event= $(this);
      console.log(value_id);
      Swal.fire({
        title: 'Destroy Category?',
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
            text: 'Your imaginary file is safe :',
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
        url: '../offer-category-delete'+'/'+value_id, // JSON file to add data,
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
              event.closest('tr').remove();


              // location.reload(true);
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
  
    // Phone Number
    if (dtContact.length) {
      dtContact.each(function () {
        new Cleave($(this), {
          phone: true,
          phoneRegionCode: 'US'
        });
      });
    }
      // Form Validation
      if (newUserForm.length) {
        newUserForm.validate({
          errorClass: 'error',
          rules: {
            'user-fullname': {
              required: true
            },
            'user-name': {
              required: true
            }, 
            'user-email': {
              required: true
            }
          }
          }) ;
        }
      });
       
   
    