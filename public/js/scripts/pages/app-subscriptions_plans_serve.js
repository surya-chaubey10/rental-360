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
  //  var confirmColor = $('.delete-record');
   var dtUserTable = $('.subscription_list'),
    formBlock = $('.btn-form-block-overlay'),
    formSection = $('.app-subscrioption-list'),
    newUserForm = $('.add-subscriptions_plans'),

    select = $('.select2'),
    bookingstatusObj = {
      1: { title: 'Upcoming',class: 'badge-light-success'  },
      2: { title: 'Close',  class: 'badge-light-warning'},
      3: { title: 'Canceled',  class: 'badge-light-danger'},
    },
    driveObj = {
      1: { title: 'professional',class: 'badge-light-success'},
      2: { title: 'rejected',class: 'badge-light-danger'},
      3: { title: 'resigned',  class: 'badge-light-danger'},
      4: { title: 'applied',  class: 'badge-light-danger'},
      5: { title: 'current',  class: 'badge-light-warning'},

    };

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    fleetEdit = assetPath + 'fleet-edit';
    fleetDelete = assetPath + 'fleet-delete';
    leadView = assetPath + 'storeadmin/tabinvoice';
    userView = assetPath + 'storeadmin/subscription-update';

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
      ajax: assetPath +"data/subscriptionplans/subscription-data-list.json",
      columns: [
        // columns according to JSON

        { data: 'plan_name' },
        { data: 'add_on_charge' },
        { data: 'deposit' },
        { data: 'convenience_fees_amount' },
        { data: 'payment_gateway_charge' },
        { data: 'status_type' },


      ],
      columnDefs: [
        {
          // User full name and username
          targets: 0,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $plane_name = full['plan_name'];

          return "<span class='text-truncate align-middle'>"  + $plane_name + '</span>';
        }
        },

        {
          // User Status
          targets: 1,
          render: function (data, type, full, meta) {
            var $add_on_charge = full['add_on_charge'];
            return "<span class='text-truncate align-middle'>"  + $add_on_charge + '</span>';
          }
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var $deposit = full['deposit'];
          return "<span class='text-truncate align-middle'>"  + $deposit + '</span>';

        }
        },
        {
          // User Status
          targets: 3,
          render: function (data, type, full, meta) {
            var $convenience_fees_amount = full['convenience_fees_amount'];
          return "<span class='text-truncate align-middle'>"  + $convenience_fees_amount + '</span>';
        }
        } ,

        {
          // User Status
          targets: 4,
          render: function (data, type, full, meta) {
            var $status = full['status_type'];
            return (
              '<span class="badge rounded-pill ' +
              driveObj[$status].class +
              '" text-capitalized>' +
              driveObj[$status].title +
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
            var $id = full['id'];
            var $uuid = full['uuid'];
            return (
              '<div class="btn-group">' +
              '<a href="' +
              userView +'/'+$uuid+
              '" class="dropdown-item">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              '</a>' +
              '<button data-id="'+$id+'"  class="dropdown-item delete-record">' +
              feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) +
              '</button> </div>' +
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

    });
  }

    // Form Validation
if (newUserForm.length) {
  newUserForm.validate({
    errorClass: 'error',
    rules: {
      'plan_name': {
        required: true
      },
      'add_on_charge': {
        required: true
      },
      'deposit': {
        required: true
      },'customColorRadio3': {
        required: true
      },
      'convenience_fees_amount': {
        required: true
      },'customColorRadio4': {
        required: true
      },
      'commission_fees_amount': {
        required: true
      },'customColorRadio5': {
        required: true
      },'withdrawal_charges_amuont': {
        required: true
      }
      ,'payment_gateway_charge': {
        required: true
      } ,
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
          let formData = new FormData($('#form_subscription')[0])

       $.ajax({
              url: 'subscriptions-save', // JSON file to add data,
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

                        window.location = "/storeadmin/subscription-list";
                     // window.location = "/storeadmin/subscription-list" + '/' + data.data.uuid;

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
    const value_id = $(this).attr('data-id')

      Swal.fire({
        title: 'Destroy Subscription?',
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
        url: 'subscription_delete'+'/'+value_id, // JSON file to add data,
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


//      //TODO: Creating new navbar menu
$('#submit').click(function()
{

     const menu = [];
     const sub_menu = [];
     const smenu = [];

     $('input[name="menu[]"]:checked').each(function(){
         menu.push($(this).val());
     });

     $('input[name="sub_menu[]"]:checked').each(function(){
         sub_menu.push($(this).val());
         smenu.push($(this).data('id'));

     });
     $('#smenuid').val(smenu);
//   console.log(smenu);

const plan_name = $('input[name="plan_name"]:checked').val();

const add_on_charge = $('input[name="add_on_charge"]:checked').val();

const deposit = $('input[name="deposit"]:checked').val();

const description = $('input[name="description"]:checked').val();

const customColorRadio3 = $('input[name="customColorRadio3"]:checked').val();

const convenience_fees_amount = $('#convenience_fees_amount').val();

const customColorRadio4 = $('input[name="customColorRadio4"]:checked').val();

const commission_fees_amount = $('#commission_fees_amount').val();

const customColorRadio5 = $('input[name="customColorRadio5"]:checked').val();

const withdrawal_charges_amuont = $('#withdrawal_charges_amuont').val();
const payment_gateway_charge = [];

$('input[name="payment_gateway_charge[]"]:checked').each(function(){
 payment_gateway_charge.push($(this).val());
 });



$(document).on('click', '.mt_getuuid', function () {
  var value_id = $(this).attr('data-value');
      $("#mt_getuuid").val(value_id) ;
});



      const formData = new FormData;
      formData.append('plan_name', plan_name);
      formData.append('add_on_charge', add_on_charge);
      formData.append('deposit', deposit);
      formData.append('payment_gateway_charge', payment_gateway_charge);
      formData.append('withdrawal_charges_amuont', withdrawal_charges_amuont);
      formData.append('commission_fees_amount', commission_fees_amount);
      formData.append('customColorRadio5', customColorRadio5);
      formData.append('customColorRadio4', customColorRadio4);
      formData.append('convenience_fees_amount', convenience_fees_amount);
      formData.append('customColorRadio3', customColorRadio3);
      formData.append('description', description);
      formData.append('menu', menu);
      formData.append('smenu', smenu);
      formData.append('sub_menu', sub_menu);




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


 //Permission module and sub-module check box functionality

 $('.module').change(function(){

  var prop = $(this).is(':checked');

  if(prop == false){

      var value = $(this).data('id');

      $('.sub_module'+value).prop('checked',false);


  }

  if(prop == true){

      var value = $(this).data('id');

      $('.sub_module'+value).prop('checked',true);


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




//   function customer_data(value_id) {
//     $.ajax({
//       url: '../../customer_data'+'/'+value_id, // JSON file to add data,
//       type: 'get',
//       dataType: 'json',
//       contentType: false,
//       cache : false,
//       processData: false,
//       success: function (data) {
//         $('#phone').val(data.mobile);
//         $('#email').val(data.email);
//       },
//       error: function (data) {
//       }
//   });
// }


//   $(document).ready(function(){
//     $('#select_customer1').on('keyup',function () {
//         var query = $(this).val();
//         $.ajax({
//             url:'customer_auto_suggestion',
//             type:'GET',
//             data:{'name':query},
//             success:function (data) {
//                 $('#customer_list').html(data);
//             }
//         })
//     });
//     $(document).on('click', 'li', function(){
//         var value = $(this).text();
//         var id = $(this).data('id');

//         $('#select_customer1').val(value);
//         $('#select_customer1').attr('data-id',id);
//         $('#customer_list').html("");

//         $('#select_customer').val(id);
//         customer_data(id)
//     });
});





