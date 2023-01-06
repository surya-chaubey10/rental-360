/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
    ("use strict");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
       })
       var isRtl = $('html').attr('data-textdirection') === 'rtl';

    var dtUserTable = $(".user-list-table"),
        newUserSidebar = $(".new-user-modal"),
        newUserForm = $(".add-new-user"),
        formBlock = $('.btn-form-block'),
        formSection = $('.form-block'),
        select = $(".select2"),
        dtContact = $(".dt-contact");
      
    var assetPath = "../../../app-assets/",
        userView = "app-user-view-account.html";

    if ($("body").attr("data-framework") === "laravel") {
        assetPath = $("body").attr("data-asset-path");
        userView = assetPath + "app/user/view/account";
        userEdit = "user-edit";
    }

    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: "100%",
            dropdownParent: $this.parent(),
        });
    });
 
    
    $("#role_id").change(function(){
      var id=$("#role_id").val();
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
 
            

              let formData = new FormData;
              var id=$("#role_id").val();
               
               formData.append('menu', menu);
               formData.append('smenu', smenu);
               formData.append('sub_menu', sub_menu);
               formData.append('role_id', id);
             
               formData.append('org_id', org_id);
               formData.append('menu_name', menu_id);
               formData.append('submenu_name', submenu_id);
              
                 
           $.ajax({
                  url: '../permision-store', // JSON file to add data,
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
                         // window.location = "/users";
  
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
 
});
