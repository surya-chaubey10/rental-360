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

      formBlock = $('.btn-form-block'),
      formSection = $('.form-block'),

      newUserForm = $('.update-subscriptions_plans'),
      select = $('.select2'),
      dtContact = $('.dt-contact');


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
        //   console.log(formData);
         $.ajax({
                url: '/storeadmin/subscription-edit', // JSON file to add data,
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

});





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
