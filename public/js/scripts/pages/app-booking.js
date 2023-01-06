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
   var dtUserTable = $('.booking-list-table'),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'), 
    newUserForm = $('.add-manage-booking'), 
  
    select = $('.select2'),
    // bookingstatusObj = {
    //   H: { title: 'Pending', class: 'badge-light-warning' }, 
    //   A: { title: 'Paid', class: 'badge-light-success'}, 
    // },
    driveObj = {
      1: { title: 'Self Drive'},
      2: { title: 'Car with Driver'},
      3: { title: 'Limousine'}
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
     // ajax: assetPath + "data/booking-data/" +1+ "_booking-data.json", // JSON file to add data
      ajax: assetPath + "data/booking-data/_booking-finish_data.json",
      columns: [
        // columns according to JSON
        { data: '' },  
        { data: 'id' },
        { data: 'name' },
        { data: 'payment_status' }, 
        { data: 'vehicle' },
        { data: 'pickup' },  
        { data: 'status' },
        { data: 'amount' } ,
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
            var $booking_code = full['id']; 
            var $driver_id = full['driver_id']; 
            var $uuid = full['id']; 

          return '<a href="'+leadView+'/'+$uuid+'" > <b> <span >' + "1000" + $booking_code + '<br>'   + 
          driveObj[$driver_id].title +
          '</span>  </b> </a>'  ;
           
        
        }
        },
        {
          // User full name and username
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $merchantname = full['name']; 

          return "<span class='text-truncate align-middle'>"  + $merchantname + '</span>';
        }
        },
        {
          // User Status 
          targets: 3,
          render: function (data, type, full, meta) {
            var $pay_status = full['payment_status'];
            if($pay_status=='A' || $pay_status=='A'){
              return '<span class="badge rounded-pill badge-light-success me-1">Paid</span>';
            }
           
            else if($pay_status=='H' || $pay_status=='E' ||$pay_status=='D')
            {
              return '<span class="badge rounded-pill badge-light-warning me-1">Pending</span>';
            }
            else{
              return'<span class="badge rounded-pill badge-light-secondary me-1">N/A</span>';
            }
          }
        },
        {
          // User Status 
          targets: 4,
          render: function (data, type, full, meta) {
            var $brand_name = full['vehicle'];
            return "<span class='text-truncate align-middle'>"  + $brand_name + '</span>';
          }
        },

        {
          targets: 5,
          render: function (data, type, full, meta) {
            var $pickup_address = full['pickup_address']; 
           // var $pickup_address = full['pickup_address']; 
            var $dropoff_address = full['dropoff_address'];  
          return "<span class='text-truncate align-middle'>"  + $pickup_address + '<br>' + $dropoff_address + '</span>';
          // return "<span class='text-truncate align-middle'>"+$pickup +'</span>' ;
        }
        },
        
         
        {
          // User Status 
          targets: 6,
          render: function (data, type, full, meta) {
            var $bookingModel = full['status']; 
         
          return '' ; 
        }
        } 
        ,
         
        {
          // User Status 
          targets: 7,
          render: function (data, type, full, meta) {
            var $amount = full['amount']; 
          return "<span class='text-truncate align-middle'>"  + $amount + '</span>';
        }
        } ,
        {
          // For Responsive
         
          orderable: false,
          responsivePriority: 2,
          targets: 8,
          render: function (data, type, full, meta) {
            return '';
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
      'name': {
        required: true
      },
      'phone': {
        required: true
      },
      'customeremail': {
        required: true
      },'fromdate': {
        required: true
      },
      'todate': {
        required: true
      },'pickup': {
        required: true
      },
      'destination': {
        required: true
      },'bookingMake': {
        required: true
      },'bookingModel': {
        required: true
      }
      ,'inlineRadioOptions': {
        required: true
      },'merchantname': {
        required: true
      },'contact': {
        required: true
      },'paymentmode': {
        required: true
      },
      // 'note': {
      //   required: true
      // }
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
          let formData = new FormData($('#booking_form')[0])

       $.ajax({
              url: 'booking-save', // JSON file to add data,
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

                      // window.location = "booking-list";
                      window.location = "/storeadmin/create_booking_invoice" + '/' + data.data.uuid; 

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
  // Brand base Model
   $(document).on('change', '.brand-name', function () {

    const value_id = $(this).val();
    const model_id = 0;
      console.log(value_id);
          brandmodel(value_id,model_id)

    });

    function brandmodel(value_id,model_id) {
      $.ajax({
        url: '../ajax-brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) { 
          $('.model-name').html(data.html);
        },
         error: function (data) {
        }
    })
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
        url: 'booking-delete'+'/'+value_id, // JSON file to add data,
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
//


$(document).on('focusout', '.merchant_sku', function () {
       
  var merchant_sku = $(this).val() ;
//  alert(merchant_sku); 
$.ajax({
  url: 'getting_merchant_sku'+'/'+merchant_sku, // JSON file to add data,
  type: 'get',
  dataType: 'json',
  contentType: false,
  cache : false, 
  processData: false,
  success: function (data) {     
      $('.merchant_sku_id').val(data.data['id']);    
      $('.merchant_sku_brand').val(data.data['brand']);    
      $('.merchant_sku_model').val(data.data['model']);    
      toastr['success'](''+data.message+'', {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl  
      });
      // $('#merchant_sku_id').val(data); 
  
   
    // $('#email').val(data.email); 
  },
  error: function (data) {
  }
});
   
});

$(document).on('click', '.mt_getuuid', function () { 
  var value_id = $(this).attr('data-value'); 
      $("#mt_getuuid").val(value_id) ; 
});




$(document).on('change', '.select_vehicle', function () {

  const value_id = $(this).val();
  const model_id = 0;
  $('#brand_id').val(value_id);
  $('#selectbrand_id').val(value_id);
    
        brandmodel(value_id,model_id) 
  });

  $(document).on('change', '.select_model', function () {

    const value_id = $(this).val();
    const sku = 0;
    const pickup_date_time=$('#pickup_date_time').val();
    const drop_off_date_time=$('#drop_off_date_time').val();
    const from_date = new Date(pickup_date_time).toLocaleDateString('fr-CA');
    const to_date = new Date(drop_off_date_time).toLocaleDateString('fr-CA');

          check_fleet(value_id,sku,from_date,to_date) 
          
          $('#skudiv').show();
    });

    $(document).on('change', '.select_sku', function () {

      const value_id = $("#select_sku option:selected").text();
      $('#sku').val(value_id);
      });

      function brandmodel(value_id,model_id) {
        $.ajax({
          url: '../brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
                $('.select_model').html(data.html);
          },
          error: function (data) {
          }
      });
    }

    function check_fleet(value_id,fleet_id,pickup_date_time,drop_off_date_time) {

      $.ajax({
        url: '../get_available_fleet'+'/'+value_id+'/'+fleet_id+'/'+pickup_date_time+'/'+drop_off_date_time, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache : false, 
        processData: false,
        success: function (data) {   
              $('.select_sku').html(data.html);
        },
        error: function (data) {
        }
    });
  }

  $(document).ready(function(){
    $(".inlineRadio1").click(function(){
      const value_id = $(this).val();
      if(value_id == 1){
        $('#merchant').hide(); 
        $('#auto_dispached').show(); 
        
      }else{
        $('#merchant').show(); 
        $('#auto_dispached').hide(); 
      }
    });
  });







  //

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


  $(document).on('click', '.getuuid', function () {     
    var value_id = $(this).val();
     if(value_id==1){
    
      $('.tabclass').hide();
       
     }else{
     
      $('.tabclass').show();
     }
  });


  function customer_data(value_id) {
    $.ajax({
      url: 'customer-data'+'/'+value_id, // JSON file to add data,
      type: 'get',
      dataType: 'json',
      contentType: false,
      cache : false, 
      processData: false,
      success: function (data) {   
       
        $('#phone').val(data.mobile); 
        $('#email').val(data.email); 
      },
      error: function (data) {
      }
  });
}  


  $(document).ready(function(){
    $('#select_customer1').on('keyup',function () {
        var query = $(this).val();
        $.ajax({
            url:'customer_auto_suggestion',
            type:'GET',
            data:{'name':query},
            success:function (data) {
                $('#customer_list').html(data);
            }
        })
    });
    $(document).on('click', 'li', function(){
        var value = $(this).text();
        var id = $(this).data('id');

        $('#select_customer1').val(value);
        $('#select_customer1').attr('data-id',id);
        $('#customer_list').html("");

        $('#select_customer').val(id);
        customer_data(id) 
    });
});






  

});
