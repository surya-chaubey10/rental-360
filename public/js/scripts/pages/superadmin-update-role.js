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
    newUserForm = $('.update-role-form');
  
   
    
    var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    fleetEdit = assetPath + 'superadmin-edit-role';

  }
    // Form Validation
if (newUserForm.length) {
  newUserForm.validate({
    errorClass: 'error',
    rules: {
    
      'role_name': {
        required: true
      },'status': {
        required: true
      },
     
    }
  });

}
  $('#submit').click(function (e) {
    
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

        $('input[name="menu[]"]:checked').each(function(){
            menu.push($(this).val());
        });

        $('input[name="sub_menu[]"]:checked').each(function(){
            sub_menu.push($(this).val());
            smenu.push($(this).data('id'));

        });
        $('#smenuid').val(smenu);

        
        let formData = new FormData($('#role_form')[0])
         formData.append('menu', menu);
         formData.append('smenu', smenu);
         formData.append('sub_menu', sub_menu);
      
        // formData.append('org_id', org_id);
        // formData.append('menu_name', menu_id);
        // formData.append('submenu_name', submenu_id);


       $.ajax({
              url: '../superadmin-edit-role', // JSON file to add data,
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
                      window.location = '../superadminrole-list'; 
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


  $( document ).ready(function() {

    var id=$("#updated_id").val();
    var madul=$("#menu_id").val();
    var submadul=$("#submenu_id").val();

    $('.inp').prop('checked', false);
    $('.submodule').prop('checked', false);

    get_role_base_data(id,madul,submadul);

  });

  function get_role_base_data(id,madul,submadul){
    $.ajax({
      url: '../get_role_base_data'+'/'+id+'/'+madul+'/'+submadul, // JSON file to add data,
      type: 'get',
      dataType: 'json',  
      contentType: false,
      processData: false,
      success: function (data) {
        
        $('.inp').each(function (tt) {

          var ss=$(this).val();
          var fdsfd=$(this);
          
          jQuery.each(data, function(index, item) {

            if(data[index].admin_menu_id==ss){
              fdsfd.prop('checked', true);
            }
            
          });
        });

        $('.submodule').each(function () {
          var gg=$(this).val();
          var rara=$(this);
          
          jQuery.each(data, function(index1, item) {
            jQuery.each(data[index1].role_sub_menu, function(index2, item) {
              
              if(data[index1].role_sub_menu[index2].admin_sub_menu_id==gg){
              rara.prop('checked', true);
              }  
              
            });
          });

        });
        
      }
    })
  }



});
