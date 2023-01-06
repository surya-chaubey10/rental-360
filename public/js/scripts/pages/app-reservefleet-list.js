/**
 * DataTables Basic
 */

 $(function () {
    'use strict';

    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    var dt_basic_table = $('.reservefleet-table'),
      assetPath = '../../../app-assets/';
     var driveObj = { 
        1: { title:  'Self Drive'  }, 
        2: { title:  'Car with Driver' },   
        3: {  title: 'Limousine' },   
      } ;
    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
      leadView = assetPath + 'tabinvoice';
    }
  // DataTable with buttons
    if (dt_basic_table.length) {
      var dt_basic = dt_basic_table.DataTable({ 
        ajax: assetPath + "data/reservefleetshow/" + org_id + "_reservefleetshow.json", 
        columns: [
            { data: 'booked' }, 
            { data: 'brand_name' }, 
            { data: 'car_SKU'},
            { data: 'from_date' },
            { data: 'fullname' }, 
            { data: 'model_name' },
            { data: 'to_date' },
            { data: '' }, 
           
          ],
            columnDefs: [
          
              {
                targets: 0,
                render: function (data, type, full, meta) {
                  var $driver_id = full['car_service_type'];
                  var $id = full['booked'];
                  return '<a href="'+leadView+'/'+$id+'" > <b> <span >' + "1000" + $id + '<br>'   + 
                    driveObj[$driver_id].title +
                    '</span>  </b> </a>';
                }
              } , 
              {
                targets: 1,
                render: function (data, type, full, meta) {
                  var $car_SKU = full['car_SKU']
                  return (
                    '<span class="text-nowrap">' + $car_SKU + "</span>"
                ); 
                }
              },
              {
                targets: 2,
                render: function (data, type, full, meta) {
                  var $fullname = full['fullname']
                  if($fullname==null){
                    return 'N/A';
                  }else{
                  return (
                    '<span class="text-nowrap">' + $fullname + "</span>"
                );
                  }
                }
              },
              {
                targets: 3,
                render: function (data, type, full, meta) {
                  var $brand_name = full['brand_name'];
                  
                  if($brand_name==null){
                    return 'N/A';
                  }else{
                  return (
                    '<span class="text-nowrap">' + $brand_name + "</span>"
                );
                  }
                }
              },
              {
                targets: 4,
                render: function (data, type, full, meta) {
                    var $model_name = full['model_name'];
                    if($model_name==null){
                     return 'N/A';
                    }else{
                    return (
                      '<span class="text-nowrap">' + $model_name + "</span>"
                  );
                    }
                }
              },
              {
                targets: 5,
                render: function (data, type, full, meta) {
                    var $from_date = full['from_date'];
                    return (
                      '<span class="text-nowrap">' + $from_date + "</span>"
                     );
                }
              },
              {
                targets: 6,
                  render: function (data, type, full, meta) {
                    var $to_date = full['to_date'];
                    // const d = new Date($date).toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
                    return (
                      '<span class="text-nowrap">' + $to_date + "</span>"
                  );
                }
              }, 
               {
                targets: 7,
                render: function (data, type, full, meta) {
                  var $id = full['id'];
                  var m = new Date();
                  var dateString =
                      m.getUTCFullYear() + "-" +
                      ("0" + (m.getUTCMonth()+1)).slice(-2) + "-" +
                      ("0" + m.getUTCDate()).slice(-2);
                      var $to_date = full['to_date'];
                      var $fleet = full['fleetid'];
                  if($to_date < dateString){
                    return (
                      '<div class="btn-group">' + 
                      '<button data-value="'+$fleet+'" data-id="'+$id+'" id="right" class="dropdown-item" style="color: #18b220;">' +
                      feather.icons['check'].toSvg({ class: 'font-small-4 me-50'}) +
                      'Return</button></div>'  
                    );
                  }else{
                      return '';
                  }
                }
              },
            ],
        order: [[2, 'desc']],
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
        }

      });
    }

    $(document).on('click', '.getuuid', function () {
       
      var value_id = $(this).attr('data-value');
      var shortlink = $(this).attr('data-id');
      var mobile = $(this).attr('data-mobile');
          $("#booking_uuid").val(value_id)
          $("#shortlink").val(shortlink)
          $("#copy").text(shortlink)
          $("#whatsapp").attr("href", "https://api.whatsapp.com/send?phone=" + mobile+ "&text=" + shortlink )
          $("#url_link").attr("href",shortlink)
      
    });

    
    
   $(document).on('click', '#right', function(){ 

      var id=$(this).attr('data-id');
      var fleetid=$(this).attr('data-value');
      $.ajax({
        url: 'return_fleet_toadmin'+'/'+id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache : false, 
        processData: false,
        success: function (data) {

          if (data.status === true) {
            toastr['success'](''+data.message+'', {
              closeButton: true,
              tapToDismiss: false,
              rtl: isRtl
            });
          } else if (data.status === false) {
            toastr['error'](''+data.message+'', {
              closeButton: true,
              tapToDismiss: false,
              rtl: isRtl
            });
             
          } 

          location.reload();
        },
        error: function (response) {
          
        }
    }) 
     
}); 
   
  });
  
  