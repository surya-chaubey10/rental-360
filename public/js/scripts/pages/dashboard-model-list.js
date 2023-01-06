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

   
  var dtUserTable = $('.dftable'), 
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
      
        { data: 'org_name' },
        { data: 'org_contact_person' },
        { data: 'email' }, 
        { data: 'email' }, 
        
       
          
         

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
          // User Role
          targets: 1,
          render: function (data, type, full, meta) {
            var $company = full['org_name'];
            var $id = full['id'];

            return '<a  href="'+companyView+'/'+$id+'" > <b> <span class="text-nowrap">' + $company + '</span>  </b> </a>'  ;

          }
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var $name = full['org_contact_person'];

            return '<span class="text-nowrap">' + 2 + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $email = full['email'];

            return '<span class="text-nowrap">' +1500 + '</span>';
          }
        },
         {
          targets: 4,
          render: function (data, type, full, meta) {
            var $email = full['revenue'];

            return '<span class="text-nowrap">500' + '</span>';
          }
        },
        {
          targets: 5,
          width: '98px',
          render: function (data, type, full, meta) {
            var $balance = full['trend'];
            if ($balance<=50 ) {
              var $badge_class = 'badge-light-danger';
              return '<div class="icon-wrapper"><span class="badge rounded-pill  ' + $badge_class + '"  text-capitalized> Down </span><div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-down"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline><polyline points="17 18 23 18 23 12"></polyline></svg></div>';
            } else {
              var $badge_class = 'badge-light-success';

              return '<div class="icon-wrapper"><span class="badge rounded-pill  ' + $badge_class + '"  text-capitalized> Up </span><div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></div><p class="icon-name text-truncate mb-0 mt-1"></p> </div>';
            }
          }
        },
         
      
       
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

});
