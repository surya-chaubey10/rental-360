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
   var dtUserTable = $('.leads-list-table'),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
    newUserSidebar = $('.new-customer-modal'),
    newUserForm = $('.add-new-customer'),
    
    select = $('.select2'),
    dtContact = $('.dt-contact'),
    statusObj = {
      0: { title: 'Pending' },
      1: { title: 'Qualified'},
      2: { title: 'Disqualified'},
      3: { title: 'Contacted'},
      4: { title: 'Proposal Sent'},
      5: { title: 'Converted'}
      
    },

    sourceObj = {
      1: { title: 'Social Media' },
      2: { title: 'Google'},
      3: { title: 'Direct'},
      4: { title: 'Other'}
    };



  var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
     leadEdit = assetPath + 'leads-edit';
     leadView = assetPath + 'leads-view';
    
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
      ajax: assetPath + "data/lead-json/" +org_id+ "_lead-list.json",
  
      columns: [
        // columns according to JSON
     
        { data: 'fullname' },
        { data: 'mobile' },
        { data: 'date' },
        { data: 'source' },
        { data: 'fullname' },
        { data: 'status' },  
       
      ],
      columnDefs: [
       
        {
          // User full name and username
          targets: 0,
          width:10,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $fname = full['first_name'];
            var $lname = full['last_name'];
            var $Vid = full['uuid'];

            return '<a href="'+leadView+'/'+$Vid+'"  "><span class="text-nowrap user_name">' + $fname +' ' + $lname +'</span></a>';
          }
        },
         
        {
          targets: 1,
          render: function (data, type, full, meta) {
            var $contact = full['mobile'];

            return '<span class="text-nowrap">' + $contact + '</span>';
          }
        },
       
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var $date = full['created_at'];
             const d = new Date($date).toLocaleDateString('en-us', {day: 'numeric', year:"numeric", month:"short"});
            return '<span class="text-nowrap">' + d + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $source = full['source'];

            return '<span class="text-nowrap">' + sourceObj[$source].title + '</span>';

          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var $assign = full['fullname'];
                if($assign==null){
                  $assign ='N/A';
                }
            return '<span class="text-nowrap">' + $assign + '</span>';

          }
          
        },
        {
          // User Status
          targets: 5,
          render: function (data, type, full, meta) {
            var $status = full['status'];
            return '<span class="text-nowrap">' + statusObj[$status].title + '</span>';
           
          }
        },
        {
          // Actions
          targets: 6,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) { 
            var $uuid = full['uuid'];
            var $eid = full['id'];
            var $user = full['assigned'];
            
            return (
              '<div class="btn-group">' +
              '<a data-id="'+$uuid+'"  class="btn btn-sm delete-record">' +
              feather.icons['trash'].toSvg({ class: 'font-small-4' }) +
              '</a>' 
              +
              '<a class="btn btn-sm commentget" data-user="'+$user+'"  data-value="'+$eid+'" data-bs-toggle="modal" data-bs-target="#leadsComment" >' 
              +
              feather.icons['message-square'].toSvg({ class: 'font-small-5' }) 
              +
              '</a>'
              +
              '<a href="'+leadEdit +'/'+$uuid+
              '" class="btn btn-sm ">' +
              feather.icons['edit'].toSvg({ class: 'font-small-5' }) +
              '</a>'
              +


              '<a class="btn btn-sm dropdown-toggle hide-arrow"  data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
               
              '<button class="dropdown-item getuuid"  data-value="'+$eid+'" data-bs-toggle="modal" data-bs-target="#leadsChangeStatus">' + 
              'Change Status</button></div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
     // order: [[1, 'desc']],
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

  $(document).on('click', '.getuuid', function () {
    var value_id = $(this).attr('data-value');
        $("#updateid").val(value_id)
    
  });

  $(document).on('click', '.commentget', function () {
     var user_id = $(this).attr('data-user');
     var value_id = $(this).attr('data-value');
          $("#update_id").val(value_id) 
          $("#user_id").val(user_id)
          previouscomment(value_id)
  });

    function previouscomment(id) {
      $.ajax({
        url: 'get-comment'+'/'+id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {
              $('.comments').html(data.html)
        },
        error: function (data) {
        }
      })
    }

   // Confirm Color
   $(document).on('click', '.delete-record', function () {
    const value_id = $(this).data('id');
    const event= $(this);
      console.log(value_id);
      Swal.fire({
        title: 'Destroy Customer?',
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
        url: 'leads-delete'+'/'+value_id, // JSON file to add data,
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
  

});
