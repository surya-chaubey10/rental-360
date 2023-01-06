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
    var dtTableinventory = $('.inventory-menu');
    var dtUserTable = $('.inventory-list-table'),
      formBlock = $('.btn-form-block'),
      formSection = $('.form-block'),
      newUserSidebar = $('.new-vendor-modal'),
      newUserForm = $('.update-new-inventory'),
      select = $('.select2'),
      dtContact = $('.dt-contact'),
      statusObj = {
        Enable: { title: 'Enable', class: 'badge-light-success' },
        Disable: { title: 'Disable', class: 'badge-light-warning' }
      },

      inventryObj = {
        1: { title: 'Rental Car', class: 'badge-light-info' },
        2: { title: 'other', class: 'badge-light-danger' }
      };
  
    var assetPath = '../../../app-assets/',
      userView = 'app-user-view-account.html';
  
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
      userView = assetPath + 'storeadmin/inventory_edit';
      userDelete= assetPath + 'inventory_delete';
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
      var dtUser = dtUserTable.DataTable({
        ajax: assetPath + "data/inventry-json/_inventry-list.json",
        columns: [
          // columns according to JSON
          
          { data: 'img' },
          { data: 'brand_name' },
          { data: 'model_name' },
          { data: 'inventory_type' }, 
          { data: 'status' },
          { data: '' }
        ],
        columnDefs: [
          
          {
            // Inventory Image
            targets: 0,
            render: function (data, type, full, meta) {
              var $image =full['img'];
              // alert($image);
              if ($image) {
                // For Avatar image
                var $output =
                  '<img src="'+assetPath+'../images/inventory_images/'+ $image + '" alt="Avatar" height="32" width="32">';
              } else {
                // For Avatar badge
                var stateNum = Math.floor(Math.random() * 6) + 1;
                var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                var $state = states[stateNum],
                  $name = 'null',
                  $initials = $name.match(/\b\w/g) || [];
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
                '<div class="d-flex flex-column">' +
                '</div>' +
                '</div>';
              return $row_output;
            }
          },
          {
            // Brand Name
            targets: 1,
            render: function (data, type, full, meta) {
              var $brandname = full['brand_name'];
              
              return "<span class='text-truncate align-middle'>" + $brandname + '</span>';
            }
          },
          {
            //Model Name
            targets: 2,
            render: function (data, type, full, meta) {
              var $modelname = full['model_name'];
              

              return '<span class="text-nowrap">' + $modelname + '</span>';
            }
          },
          {
            // User Status
            targets: 3,
            render: function (data, type, full, meta) {
              var $inventory_type = full['inventory_type'];
              return (
                '<span class="badge rounded-pill ' +
                inventryObj[1].class +
                '" text-capitalized>' +
                $inventory_type +
                '</span>'
              );
            }
          },
          {
            // User Status
            targets: 4,
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
            targets: 5,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              var $uuid = full['uuid'];
              return (
                '<div class="btn-group">' +
                '<a href="' +
                userView +'/'+$uuid+
                '" class="dropdown-item">' +
                feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
                '</a>' +
                '<button data-id="'+$uuid+'"  class="dropdown-item delete-record">' +
                feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) +
                '</button> </div>' +
                '</div>'
              );
            }
          }
        ],
        //order: [[2, 'desc']],
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
        },
        
      });
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
  
    //Delete Vendor Record
        // Confirm Color
   $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id')
      console.log(value_id);
      Swal.fire({
        title: 'Destroy Vendor?',
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
            text: 'Your imaginary file is safe :',
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
        url: '/storeadmin/inventory_delete'+'/'+value_id, // JSON file to add data,
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

  