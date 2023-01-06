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
    var formBlock = $('.btn-form-block'),
      formSection = $('.form-block'),
      accountUploadImg = $('#account-upload-img'),
      accountUploadBtn = $('#account-upload'),
      accountUserImage = $('.uploadedAvatar'),
      accountResetBtn = $('#account-reset'),
      newUserForm = $('.update-new-user'),
      select = $('.select2'),
      dtContact = $('.dt-contact') ;

    var assetPath = '../../../app-assets/',
      userView = 'app-user-view-account.html';

    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
      userView = assetPath + 'app/customer/view/account';
    }
    if (accountUserImage) {
      var resetImage = accountUserImage.attr('src');
      accountUploadBtn.on('change', function (e) {
        var reader = new FileReader(),
          files = e.target.files;
        reader.onload = function () {
          if (accountUploadImg) {
            accountUploadImg.attr('src', reader.result);
          }
        };
        reader.readAsDataURL(files[0]);
      });

      accountResetBtn.on('click', function () {
        accountUserImage.attr('src', resetImage);
      });
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

    const role_id = $('#role_id').val();
    const user_id = $('#user_updated_id').val();

    if(role_id){
      all_submenu(role_id,user_id)
    }

    $(document).on('change', '#role_id', function () {
      const value_id = $(this).val();
      const user_id = $('#user_updated_id').val();
      all_submenu(value_id,user_id)
  });

  function all_submenu(value_id,user_id) {
      $.ajax({
        url: '../ajax_fetchall_submenu'+'/'+value_id+'/'+user_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {
              $('#submenupermision_data').html(data.html);
        },
         error: function (data) {
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
            let formData = new FormData($('#form_idd1')[0])
         $.ajax({
                url: '../superadmin-update-user', // JSON file to add data,
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
                        window.location = "../superadminuser-list";

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
        'fullname': {
          required: true
        },
        'status': {
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

  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

  togglePassword.addEventListener("click", function () {
      // toggle the type attribute
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);

      // toggle the icon
      this.classList.toggle("bi-eye");
  });


  var input = document.querySelector("#contact");
  window.intlTelInput(input,({
      preferredCountries: ["ae"],
  }));

  $(document).ready(function() {
      $('.iti__flag-container').click(function() {
          var countryCode = $('.iti__selected-flag').attr('title');

          var countryCode = countryCode.replace(/[^0-9]/g,'');

          $('#contact').val("");
          $('#contact').val("+"+countryCode+" "+ $('#contact').val());
      });
  });


  });
