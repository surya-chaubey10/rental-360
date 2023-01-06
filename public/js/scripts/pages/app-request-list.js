0/**
 * DataTables Basic
 */

 $(function () {
  'use strict';

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   }) 
 
  var isRtl = $('html').attr('data-textdirection') === 'rtl';
  var dt_basic_table = $('.request-list-table'),
    AccountPayment = $('.new-payment-modal'),
    RejectPayment = $('.new-reject-modal'),
    newUserSidebar = $(".add-Queck-Payment"),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
  bookingstatusObj = {
    1: { title: 'Accepted',class: 'badge-light-success'  },
    2: { title: 'Rejected',  class: 'badge-light-warning'},   
      
  } ,
  bookingstatusObj1 = {
    1: { title: 'Released',class: 'badge-light-success'  },
    2: { title: 'Rejected',  class: 'badge-light-warning'},   
      
  } ,
   
    assetPath = '../../../app-assets/';
   
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
     
  }
 
  
  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
      dt_basic_table.DataTable({
          
         ajax: assetPath + "data/superadmin/request/request-datatable-json/_request-list.json",
      columns: [
        { data: 'request_date' },
        { data: 'vendor_name' },
        { data: 'current_balance' },
        { data: 'withdrawl_fees' },
        { data: 'amount_request' },
        { data: 'balance_after_request' },
        { data: ' '}
        
      ],
      columnDefs: [
        {
          // For Responsive
          // className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            var $date = full['request_date']; 
       
            return "<span class='text-truncate align-middle'>"  + $date + '</span>';
          }
        },
        {
          // User full name and username
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $vendor_name = full['vendor_name']; 

            return "<span class='text-truncate align-middle'>"  + $vendor_name + '</span>';
           
        
        }
        },
        {
          // User full name and username
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $current_balance = full['current_balance']; 

          return "<span class='text-truncate align-middle'>"  + $current_balance + '</span>';
        }
        },
        
        {
          // User full name and username
          targets: 3,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $withdrawl_fees = full['withdrawl_fees']; 

          return "<span class='text-truncate align-middle'>"  + $withdrawl_fees + '</span>';
        }
        },
        {
          // User Status 
          targets: 4,
          render: function (data, type, full, meta) {
            var $amount_request = full['amount_request']; 

            return "<span class='text-truncate align-middle'>"  + $amount_request + '</span>';
          }
        }
        ,
        {
          // User Status 
          targets: 5,
          render: function (data, type, full, meta) {
            var $balance_after_request = full['balance_after_request'];
            return "<span class='text-truncate align-middle'>"  + $balance_after_request + '</span>';
          }
        }, 
        {
          // Actions
          targets: 6,
          title: 'Action',
          orderable: false,
          render: function (data, type, full, meta) {
            var $id = full['id'];
            var $status = full['status'];
            var $accepted =full['accepted'];
           
            if($accepted==1)
{
  return (
    '<span class="badge rounded-pill ' +
    bookingstatusObj1[$accepted].class +
    '" text-capitalized>' +
    bookingstatusObj1[$accepted].title +
    '</span>' 
  ); 
}else if($accepted==2)
{
  return (
    '<span class="badge rounded-pill ' +
    bookingstatusObj1[$accepted].class +
    '" text-capitalized>' +
    bookingstatusObj1[$accepted].title +
    '</span>');
} 
             if($status==1){            
              return (
                '<span class="badge rounded-pill ' +
                bookingstatusObj[$status].class +
                '" text-capitalized>' +
                bookingstatusObj[$status].title +
                '</span>'+
              
              '<div class="btn-group">' +
                '<a class="btn btn-sm dropdown-toggle hide-arrow"  data-bs-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-end">' +
                 
                '<button data-value="1" class="dropdown-item" id="request_accept_id" data-bs-toggle="modal" data-bs-target="#modals-addslide" data-click="'+$id+'">' + 
                'Release</button>'+'<button data-value="2" class="dropdown-item" id="rejected" data-bs-toggle="modal" data-bs-target="#modals-removeslide" data-click="'+$id+'" >' + 
                'Reject </button></div>' +
                '</div>' +
                '</div>' 
              );  
             }
            if($status==2){  
              return (
                '<span class="badge rounded-pill ' +
                bookingstatusObj[$status].class +
                '" text-capitalized>' +
                bookingstatusObj[$status].title +
                '</span>'    
              );
             } 
             if($status==null){
            return (
              '<div class="btn-group">' + 
             
              '<button data-value="1" data-id="'+$id+'" id="right" class="dropdown-item" style="color: #18b220;">' +
              feather.icons['check'].toSvg({ class: 'font-small-4 me-50'}) +
              ' </button>' +  
    
              '<button data-value="2" data-id="'+$id+'" id="wrong" class="dropdown-item delete-record " style="color:#fa0707;">' +
              feather.icons['x'].toSvg({ class: 'font-small-4 me-50' }) +
              ' </button>' +
 
              '</div>'  
            );
             }
          }
        }
        
      ],
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
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
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
      order: [[1, 'desc']],
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
      }
    });
  }

  $(document).on('click', '#request_accept_id', function(){ 

    var id=$(this).attr('data-click');
    var value=$(this).attr('data-value'); 
    
    $.ajax({
      url: 'comapany_details'+'/'+id+'/'+value, // JSON file to add data,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (response) { 
       
        if(response!=null){
          $('#vendor_id').val(response.vendor_name); 
          $('#balance_id').val(response.current_balance); 
          $('#amount_id').val(response.amount_request); 
          $('#org_id').val(response.organisation_id); 
          $('#accepted_id').val(response.accepted);
          $('#request_id').val(response.id);
          
        }else{ 
          $('#vendor_id').val(''); 
          $('#balance_id').val(''); 
          $('#amount_id').val('');  
          $('#org_id').val(''); 
          $('#accepted_id').val(''); 
        }
       
       
      },
      error: function (response) {
        
      }
  }) 
 
}); 

$(document).on('click', '#rejected', function(){ 

  var id=$(this).attr('data-click');
  var value=$(this).attr('data-value'); 
   
  $.ajax({
    url: 'comapany_details'+'/'+id+'/'+value, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (response) { 
        $('#message').val(response.message); 
        $('#id').val(response.id); 
         
    },
    error: function (response) {
      
    }
}) 

}); 

  
  $(document).on('click', '#right', function(){ 

      var id=$(this).attr('data-id');
      var checked=$(this).attr('data-value'); 
        
    $.ajax({
      url: 'store_release'+'/'+id+'/'+checked, // JSON file to add data,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (data) { 
        location.reload();
      },
      error: function (response) {
        
      }
  }) 
 
     
}); 

$(document).on('click', '#wrong', function(){ 

    var id=$(this).attr('data-id');
    var checked=$(this).attr('data-value'); 
    
    $.ajax({
      url: 'store_release'+'/'+id+'/'+checked, // JSON file to add data,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (response) {  
        location.reload();
      },
      error: function (response) {
        
      }
    }) 

 
}); 

AccountPayment.on('submit', function (e) {
           
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
        let formData = new FormData($('#form_model')[0])
     
     $.ajax({
            url: 'request_save', // JSON file to add data,
            type: 'POST',
            dataType: 'json',  
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
              
              if (data.status === true) {
                $( "#submit" ).prop( "disabled", false );
                toastr['success'](''+data.message+'', {
                  closeButton: true,
                  tapToDismiss: false,
                  rtl: isRtl
                });
              } else if (data.status === false) {
                $( "#submit" ).prop( "disabled", false );
                toastr['error'](''+data.message+'', {
                  closeButton: true,
                  tapToDismiss: false,
                  rtl: isRtl
                });
                 
              }
              $('.cancel').click();
              location.reload();  

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
 
RejectPayment.on('submit', function (e) {
           
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
        let formData = new FormData($('#form_model_reject')[0])
        
     $.ajax({
            url: 'reject_save', // JSON file to add data,
            type: 'POST',
            dataType: 'json',  
            data: formData,  
            contentType: false,
            processData: false,
            success: function (data) {
              
              if (data.status === true) {
                $( "#submit" ).prop( "disabled", false );
                toastr['success'](''+data.message+'', {
                  closeButton: true,
                  tapToDismiss: false,
                  rtl: isRtl
                });
              } else if (data.status === false) {
                $( "#submit" ).prop( "disabled", false );
                toastr['error'](''+data.message+'', {
                  closeButton: true,
                  tapToDismiss: false,
                  rtl: isRtl
                });
                 
              }
              $('.cancels').click();
               location.reload();  


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

});
