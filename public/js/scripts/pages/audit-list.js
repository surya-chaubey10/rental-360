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
    var dtUserTable = $('.audit-table table'), 
      formBlock = $('.btn-form-block'),
      formSection = $('.form-block'),
      newUserForm = $('.add-new-offer'),
      
      
      select = $('.select2'),
      dtContact = $('.dt-contact'),
      statusObj = {
        1: { title: 'Enable', class: 'badge-light-success' },
        2: { title: 'Disable', class: 'badge-light-warning' }
      };
  
    var assetPath = '../../../app-assets/',
      userView = 'app-user-view-account.html';
  
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
      userView = assetPath + 'audit-edit';
      offercopy = assetPath + 'audit-copy';
      
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
        ajax: assetPath + "data/audit/audit-json/" + org_id + "_audit-list.json", // JSON file to add data 
        //add data
        columns: [
          // columns according to JSON
          { data: '' },
          { data: '' },
          { data: '' },
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
            responsivePriority: 4,
            render: function (data, type, full, meta) {
              var $category_name = full['category_name'];
            
              return "<span class='text-truncate align-middle'>" + $category_name + '</span>';
            }
          },
          {
            // User Role
            targets: 2,
            render: function (data, type, full, meta) {
              var $vehicle_name = full['vehicle_name'];
            
              return "<span class='text-truncate align-middle'>" + $vehicle_name + '</span>';
            }
          },
          {
            targets: 3,
            render: function (data, type, full, meta) {
              var $startdate = full['startdate'];
  
              return '<span class="text-nowrap">' + $startdate + '</span>';
            }
          },
          {
            targets: 4,
            render: function (data, type, full, meta) {
              var enddate = full['enddate'];
          
              return '<span class="text-nowrap">' + enddate + '</span>';
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
                '</button>'+'<a href="' +
                offercopy +'/'+$uuid+
                '"  class="dropdown-item ">' +
                feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) +
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

    $(document).on('keydown.autocomplete', "#vehicle_name", function () {
        var coptions = {
            source: function (request, response) {
                $.ajax({
                    url: 'get_vehicle_autoseggestion', // JSON file to add data,
                    type: 'get',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        response(data);
                    }, beforeSend: function() {
                        //$('.data_loader').removeClass('hide');
                    }
                });
            },
            focus: function (event, ui) {
                $("#vehicle_name").val(ui.item.ccode  + ' - ' + ui.item.name + ' (' + ui.item.customerphone + ')');
               
                 //alert("asd")
                return false;
            },
            select: function (event, ui) {
                // alert(ui);
                $("#vehicle_name").val(ui.item.ccode  + ' - ' + ui.item.name + ' (' + ui.item.customerphone + ')');
                $.ajax({
                    url: 'get_vehicle_details'+'/'+ui.item.id, // JSON file to add data,
                    type: 'get',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        parsedata = JSON.parse(data);
                        
                    }
                }); 
    //            $('.se-pre-con').fadeOut();
                return false;
            }
        };

        $(this).autocomplete(coptions).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<div>" + item.ccode + " - " + item.name + " (" + item.customerphone + ")")
                    .appendTo(ul);
        };
    });

  });
  