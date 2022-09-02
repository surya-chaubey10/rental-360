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
  var dtUserTable = $('.customer-list-table'),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
    newUserSidebar = $('.new-customer-modal'),
    newUserForm = $('.add-new-customer'),
    select = $('.select2'),
    dtContact = $('.dt-contact'),
    statusObj = {
      Pending: { title: 'Pending', class: 'badge-light-warning' },
      Active: { title: 'Active', class: 'badge-light-success' },
      Inactive: { title: 'Inactive', class: 'badge-light-secondary' }
    };

  var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'app/customer/view/account';
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
      ajax: 'data/customer-list-json', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'fullname' },
        { data: 'customer_type' },
        { data: 'email' },
        { data: 'contact' },
        { data: 'status' },
        { data: '' }
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
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['fullname'],
              $email = full['email'],
              $image = full['avatar'];
            if ($image) {
              // For Avatar image
              var $output =
                '<img src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" height="32" width="32">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6) + 1;
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['fullname'],
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
              '<div class="d-flex flex-column">' +
              '<a href="' +
              userView +
              '" class="user_name text-truncate text-body"><span class="fw-bolder">' +
              $name +
              '</span></a>' +
              '<small class="emp_post text-muted">' +
              $email +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          // User Role
          targets: 2,
          render: function (data, type, full, meta) {
            var $customer_type = full['customer_type'];
            var roleBadgeObj = {
              Subscriber: feather.icons['user'].toSvg({ class: 'font-medium-3 text-primary me-50' }),
              Author: feather.icons['settings'].toSvg({ class: 'font-medium-3 text-warning me-50' }),
              Maintainer: feather.icons['database'].toSvg({ class: 'font-medium-3 text-success me-50' }),
              Editor: feather.icons['edit-2'].toSvg({ class: 'font-medium-3 text-info me-50' }),
              Admin: feather.icons['slack'].toSvg({ class: 'font-medium-3 text-danger me-50' })
            };
            return "<span class='text-truncate align-middle'>" + $customer_type + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $email = full['email'];

            return '<span class="text-nowrap">' + $email + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var $contact = full['contact'];

            return '<span class="text-nowrap">' + $contact + '</span>';
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
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="btn-group">' +
              '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="' +
              userView +
              '" class="dropdown-item">' +
              feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
              'Details</a>' +
              '<a href="javascript:;" class="dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Delete</a></div>' +
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
        {
          text: 'Add New Customer',
          className: 'add-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modals-slide-in'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
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
      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(2)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="Type">Type</label>').appendTo('.customer_type');
            var select = $(
              '<select id="UserType" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Type </option></select>'
            )
              .appendTo('.customer_type')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        // Adding plan filter once table initialized
        this.api()
          .columns(5)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="CustomerPlan">Plan</label>').appendTo('.customer_plan');
            var select = $(
              '<select id="CustomerPlan" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Plan </option></select>'
            )
              .appendTo('.customer_plan')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        // Adding status filter once table initialized
        this.api()
          .columns(5)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="FilterTransaction">Status</label>').appendTo('.customer_status');
            var select = $(
              '<select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value=""> Select Status </option></select>'
            )
              .appendTo('.customer_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' +
                    statusObj[d].title +
                    '" class="text-capitalize">' +
                    statusObj[d].title +
                    '</option>'
                );
              });
          });
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
          let formData = new FormData($('#addCustomerForm')[0])
       $.ajax({
              url: 'customer-save', // JSON file to add data,
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
                      location.reload(true); 
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
      'fullname': {
        required: true
      },
      'username': {
        required: true
      },
      'email': {
        required: true
      }
    }
  });

  newUserForm.on('submit', function (e) {
    var isValid = newUserForm.valid();
    e.preventDefault();
    if (isValid) {
      newUserSidebar.modal('hide');
    }
  });
}

// Phone Number
if (dtContact.length) {
  dtContact.each(function () {
    new Cleave($(this), {
      phone: true,
      phoneRegionCode: 'US'
    });
  });
}

});
