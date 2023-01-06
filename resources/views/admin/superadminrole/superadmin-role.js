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
   var dtUserTable = $('.role-list-table'),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'), 
    newUserForm = $('.add-role-form'), 
  
    select = $('.select2')
    var statusObj = {
      1: { title: "Active", class: "badge-light-success" },
      2: { title: "Inactive", class: "badge-light-danger" },
  };
  var promotion_type = {
    1: { title: "Flat", class: "badge-light-info" },
    2: { title: "Percentage", class: "badge-light-warning" },
};
    
    var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    fleetEdit = assetPath + 'fleet-edit';
    fleetDelete = assetPath + 'fleet-delete';
    leadView = assetPath + 'storeadmin/tabinvoice';

    
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
      ajax: assetPath + "data/role-list/" + org_id + "_role.json", // JSON file to add data
   
      columns: [
        // columns according to JSON
        { data: '' },  
        { data: 'role_name' },
        { data: 'status' }, 
        { data: '' } ,
         
        
      ],
      columnDefs: [
        {
          // For Responsive
         
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
            var $role_name = full['role_name']; 

          return "<span class='text-truncate align-middle fw-bold'>" +'<strong>' + $role_name + '</strong>'+ '</span>';
        }
        },
       
        {
          // Status
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $status = full['status']; 
             var $id = full["id"];
            return (
             /* --22-12-2022--  
             '<span class="badge rounded-pill ' +
              statusObj[$status].class +
              '" text-capitalized>' +
              statusObj[$status].title +
              "</span>" */

          '<input type="checkbox" id='+$id+' class="toggle" '+($status==1 ? `Checked` : '') +' data-on="Active" data-off="Inactive" data-toggle="toggle">'

          );
        }
        },
         {
          // Actions
          targets:3,
          title: 'Actions',
      
          orderable: false,
          render: function (data, type, full, meta) {
            var $id = full['uuid'];   
            
            return (
              '<div class="dropdown">' +
              '<a class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              
              '<a href="update-role/'+$id +
              '" class="dropdown-item">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Edit</a>' +
              '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Delete</button>'+
             
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        }
        ],
         order: [[2, 'desc']],
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
       
    });
  }





  
    // Form Validation
if (newUserForm.length) {
  newUserForm.validate({
    errorClass: 'error',
    rules: {
      'role_name': {
        required: true
      },
      'status': {
        required: true
      },
     
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

        const menu = [];
        const sub_menu = [];
        const smenu = [];
        const menu_id = [];
        const submenu_id = [];
        const org_id = [];
       
        $('input[name="menu_name[]"]:checked').each(function(){
            menu.push($(this).val());
            menu_id.push($(this).data('id'));
            org_id.push($(this).data('value'));
        });
    
        $('input[name="submenu_name[]"]:checked').each(function(){
            sub_menu.push($(this).val());
            smenu.push($(this).data('id'));
            submenu_id.push($(this).data('value'));
           
        });



        let formData = new FormData($('#role_form')[0]);
        formData.append('menu', menu);
        formData.append('smenu', smenu);
        formData.append('sub_menu', sub_menu);
      
        formData.append('org_id', org_id);
        formData.append('menu_name', menu_id);
        formData.append('submenu_name', submenu_id);
        



       $.ajax({
              url: 'role-store', // JSON file to add data,
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

                     
                      window.location = 'role-list';  

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
   // Confirm Color
   $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id')
      console.log(value_id);
      Swal.fire({
        title: 'Destroy Role?',
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
      url: 'role-delete'+'/'+value_id, // JSON file to add data,
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




// 22-12-2022
//toggle button 

$(document).ready(function(){
  $(document).on('click', '.toggle', function() {
    // alert();
  const thisRef = $(this); 
  
  thisRef.text('Processing');
  $.ajax({
  type: 'GET',
  url: 'role-toggle/'+thisRef.attr('id'),
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


