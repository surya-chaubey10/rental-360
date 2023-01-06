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
   }) ;

   
  var dtUserTable = $('.company-list-table'), 
    newUserSidebar = $('.new-customer-modal'),
    newUserForm = $('.add-new-customer'),
    
    select = $('.select2'),
    dtContact = $('.dt-contact') ;
     

  var assetPath = '../../../app-assets',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    companyEdit = assetPath + 'storeadmin/edit-company';  
    companyView = assetPath + 'storeadmin/view-company';
    companyVirtualContract = assetPath + 'storeadmin/virtual-contract';

    
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
      ajax: assetPath + "data/company-json/_company-list.json",
  
      columns: [
        // columns according to JSON 
        { data: 'company' },
        { data: 'name' },
        { data: 'email' }, 
        { data: 'profile_id' }, 
        { data: '' },
        { data: '' }
          
         

      ],
      columnDefs: [

        {
          // User Role
          targets: 0,
          render: function (data, type, full, meta) {
            var $company = full['org_name'];
            var $id = full['id'];

            return '<a  href="'+companyView+'/'+$id+'" > <b> <span class="text-nowrap">' + $company + '</span>  </b> </a>'  ;

          }
        },
        {
          targets: 1,
          render: function (data, type, full, meta) {
            var $name = full['org_contact_person'];

            return '<span class="text-nowrap">' + $name + '</span>';
          }
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var $email = full['email'];

            return '<span class="text-nowrap">' + $email + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $profile_id = full['more_info']['profile_id']; 
           if($profile_id==null){
            $profile_id = 'N/A';
           }
            return '<span class="text-nowrap">' + $profile_id + '</span>';
          }
        },
        {
          // Approval
          targets: 4,
          title: 'Approval',
          orderable: false,
          render: function (data, type, full, meta) {
            var $id = full['id'];
            var $uuid = full['uuid'];
            var $agreement_status = full['agreement_status'];

            return (
             
              ($agreement_status == '0' 
              ? '<a href="'+companyVirtualContract +'/'+$uuid+'"> <b> <span class="text" >Pending</span> </b>  </a>' 
              : '<b> <span class="text-success"> Approved </span> </b>')




            );
          }
        },
        {
          // Actions
          targets: 5,
          title: 'Option',
          orderable: false,
          render: function (data, type, full, meta) {
            var $id = full['id'];
            var $uuid = full['uuid'];
            var $agreement_status = full['agreement_status'];

            return (
              '<div class="btn-group">' + 
              ($agreement_status == '0' 
              ? '<a title="Send mail for aggrement." data-id="'+$uuid+'" id="aggrementMail" class="dropdown-item">' +
                feather.icons['mail'].toSvg({ class: 'font-small-4 me-50' }) +
                ' </a>' 
              : '' ) +
              '<a title="Edit" href="'+companyEdit +'/'+$uuid+'" class="dropdown-item">' +
              feather.icons['edit-2'].toSvg({ class: 'font-small-4 me-50' }) +
              ' </a>' +  
              '<a title="Delete" data-id="'+$id+'"  class="btn btn-sm delete-record">' +
              feather.icons['trash'].toSvg({ class: 'font-small-4' }) +
              '</a>'  +
              '</div>'  
            );
          }
        }
      ],
      order: [],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-md-6"i>' +
        '<"col-md-6"p>' +
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
      },
      
    });
  }

   

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


   // Confirm Color
   $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id')
      console.log(value_id);
      Swal.fire({
        title: 'Destroy Company?',
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
        url: 'company-delete'+'/'+value_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {

          console.log(data);
            if (data.status === true) {
              
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Your record has been deleted.',
                customClass: {
                  confirmButton: 'btn btn-success'
                }
                  
              });
              
              window.location = app_path + '../storeadmin/company-list';
            } else if (data.status === false) {
              
              
            }
        },
        error: function (data) {
          
         
        }
    })
  }


    // Sending aggrement mail code start from here.
    $(document).on('click', '#aggrementMail', function () {
      $(this).addClass('d-none');
      const uuid = $(this).data('id')
      $.ajax({
        url: 'company-aggrement-mail'+'/'+uuid, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (res) {

          console.log(res);
            if (res == true) {
              Swal.fire({
                icon: 'success',
                title: 'Sent!',
                text: 'Aggrement mail send successfully.',
                customClass: {
                  confirmButton: 'btn btn-success'
                }
                  
              });
              
            } else if (res == 'false') {
              
              Swal.fire({
                icon: 'danger',
                title: 'Not sent!',
                text: 'Invalid email.',
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
                  
              });

            }
        },
        error: function (data) {
          
         
        }
    })

    });

});
