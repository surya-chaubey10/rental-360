/*=========================================================================================
    File Name: app-invoice-list.js
    Description: app-invoice-list Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')   
    }
   })
   var isRtl = $('html').attr('data-textdirection') === 'rtl';
  var dtInvoiceTable = $('.invoice-list-table1'),
    assetPath = '../../../app-assets/',
    AccountPayment = $('.add-Queck-Payment'),
    WithdrawPayment = $('.withdraw-Payment'), 
    newUserSidebar = $(".new-payment-modal"),
    newUserSidebars = $(".new-withdraw-modal"),
    formBlock = $('.btn-form-block'),
    formSection = $('.form-block'),
    statusObj = {
      0: { title: "Pending", class: "badge-light-warning" },
      1: { title: "Paid", class: "badge-light-success" }, 
    },
    typeObj = {
      1: { title: "Sales", class: "badge-light-primary" },
      2: { title: "Pre Auth", class: "badge-light-info" }, 
      3: { title: "Tokenize", class: "badge-light-success" }, 
    };
    
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    var invoicePreview = assetPath + 'app/invoice/preview';
   var invoiceAdd = assetPath + 'app/invoice/add';

  }

  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
      ajax: assetPath + "data/directpayment/" + org_id + "_directpayment.json", // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'invoice_id' },
        { data: 'description' },
        { data: 'amount' },
        { data: 'transaction_type' },
        { data: 'created_at' },
        { data: 'agentname' } 
        
      ],
      columnDefs: [
        {
          // Total Invoice Amount
          targets: 0,
          render: function (data, type, full, meta) {
            var $invoice_id = full['invoice_id'];
            if($invoice_id==null){
              $invoice_id='N/A';
            }
            return (
              '<span class="text-nowrap">' + $invoice_id + "</span>"
          );

          }
        }  ,
          
        {
          // Invoice status
          targets: 1,
          render: function (data, type, full, meta) {
            var $description = full['description']
            if($description==null){
              return 'N/A';
            }else{
            return (
              '<span class="text-nowrap">' + $description + "</span>"
          );
          } 
          }
        },
        {
          // Due Date
          targets: 2,
          render: function (data, type, full, meta) {
           
            var $currency = 'AED';
            return (
              '<span class="text-nowrap">' + $currency + "</span>"
          );

          }
        },
        {
          // Due Date
          targets: 3,
           render: function (data, type, full, meta) {
           
            var $total = full['amount'];
            if($total==null){
              return 'N/A';
            }else{
            return (
              '<span class="text-nowrap">' + $total + "</span>"
          );
            }
          }
        },
        {
          // Client Balance/Status
          targets: 4,
          render: function (data, type, full, meta) {
            var status = full["status"];
            
            return (
              '<span class="badge rounded-pill ' +
              statusObj[status].class +
              '" text-capitalized>' +
              statusObj[status].title +
              "</span>"
            );

          }
        },  {
          // Client name and Service
          targets: 5,
            render: function (data, type, full, meta) {
            var $type = full["transaction_type"];

            return (
                '<span class="badge rounded-pill ' +
                typeObj[$type].class +
                '" text-capitalized>' +
                typeObj[$type].title +
                "</span>"
            );
          }
        },
        
        {
          // Invoice ID
          targets: 6,
          render: function (data, type, full, meta) {
            var $date = full['created_at'];
            const d = new Date($date).toLocaleDateString('en-us', {day: 'numeric', year:"numeric", month:"short"});
            return (
              '<span class="text-nowrap">' + d + "</span>"
          );
          }
        },
        
        {
          // Invoice ID
          targets: 7,
          render: function (data, type, full, meta) {
            var $agentname = full['agentname'];
            if($agentname==null){
              return 'N/A';
            }else{
            return (
              '<span class="text-nowrap">' + $agentname + "</span>"
          );
            }
          }
        },
        {
          // Invoice ID
          targets: 8,
          render: function (data, type, full, meta) {
            var $invoice_id = full['invoice_id'];
            var sync='Yes';
            if($invoice_id==null){
              sync='No';
            }
            return (
              '<span class="text-nowrap">' + sync + "</span>"
          );
          }
        },
        // {
        //   // Invoice ID
        //   targets: 9,
        //   render: function (data, type, full, meta) {
        //     var short_link = full['short_link'];
        //     var status2 = full["status"];
        //     if(status2==0){
        //       return (       
        //         '<a href="'+short_link+'" class="btn btn-sm">' +feather.icons["credit-card"].toSvg({class: "font-small-4", }) +'</a>'
        //      );
        //     }else{
        //       return '';
        //     }
            
        //   }
        // }
      ],
      order: [[2, 'desc']],
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +
        '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
        '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search Invoice',
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      // Buttons with Dropdown
      buttons: [
        
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['client_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.columnIndex !== 2 // ? Do not show row in modal popup if title is blank (for check box)
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
    
      drawCallback: function () {
        $(document).find('[data-bs-toggle="tooltip"]').tooltip();
      }
    });
  }
  
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
              url: 'addquick-payment', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              processData: false,
              success: function (data) {
                  $( "#submit" ).prop( "disabled", false );
                  if (data.status === true) {
                     $('#mediumModal').modal("show");

                     $('#adress1').html(data.data.address1);
                     $('#adress2').html(data.data.address2);
                     $('#city').html(data.data.city);
                     $('#street').html(data.data.state);
                     $('#name1').html(data.data.full_name);
                     $('#email1').html(data.data.email);
                     $('#agents').val(data.data.agentname);
                     $('#grand_total').html(data.data.amount);
                     $('#payment_link').html(data.data.short_link);
                     document.getElementById('my-link').setAttribute('href', 'https://api.whatsapp.com/send?phone='+data.data.phone+'&text='+data.data.short_link);
                    
                     document.getElementById('make_payment').setAttribute('href',data.data.short_link);
                     

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
   if (AccountPayment.length) {
    AccountPayment.validate({
        errorClass: "error",
        rules: {
            "full_name": {
                required: true,
            },
            "email": {
                required: true,
            },
            "amount": {
                required: true,
            },
            "amount": {
                required: true,
            },
        },
    });
    AccountPayment.on("submit", function (e) {
      var isValid = AccountPayment.valid();
      e.preventDefault();
      if (isValid) {
          newUserSidebar.modal("hide");
      }
    });
  }
 


  WithdrawPayment.on('submit', function (e) {
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
          let formData = new FormData($('#form_models')[0])
       $.ajax({
              url: 'withdraw_save', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              processData: false,
              success: function (data) {
                
                  $( "#submit" ).prop( "disabled", false );
                   toastr['success'](''+data.message+'', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                  });
                
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
      // Form Validation

  });

  if (WithdrawPayment.length) {
    // AccountPayment.validate({
    //   errorClass: 'error',
    //   rules: {
    //     'model_name': {
    //       required: true
    //     }
    //   }
    // });
    
    WithdrawPayment.on("submit", function (e) {
      var isValid = WithdrawPayment.valid();
      e.preventDefault();
      if (isValid) {
        newUserSidebars.modal("hide");
      }
    });
  }
      
  

});
