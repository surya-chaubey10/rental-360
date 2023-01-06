 

$(document).ready(function (){
    ('use strict');
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     })

    var formBlock = $('.btn-form-block');
    var newUserForm = $('.add-manage-booking');

    
    $(document).on('change', '.select_vehicle', function () {

        var value_id = $(this).val();
        var model_id = 0;
        $('#brand_id').val(value_id);
        $('#selectbrand_id').val(value_id);
          
              brandmodel(value_id,model_id) 
              $("#select_sku").html('<option value="" ></option>');
    });

    $(document).on('change', '.select_marchantvehicle', function () {
           
        const value_id = $(this).val();
        const model_id = 0;
        $('#brand_id').val(value_id);
        $('#selectbrand_id').val(value_id);
          
              marchantbrandmodel(value_id,model_id) 
        });

    // filter brand on change start 
    $(document).on('change', '.filter_vehicle', function () {

        var value_id = $(this).val();
        var model_id = 0;

        $(function() {
            $("#select_vehicle option").each(function(i){
                (value_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });

        $(function() {
            $("#mselect_vehicle option").each(function(i){
                (value_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });
          
        filterbrandmodel(value_id,model_id) 
        brandmodel(value_id,model_id)

        $("#filter_sku").html('<option value="" ></option>');

    });
    // filter brand on change end 

    $(document).on('change', '.select_model', function () {

        var value_id = $(this).val();
        var sku = 0;
        var pickup_date_time=$('#pickup_date_time').val();
        var drop_off_date_time=$('#drop_off_date_time').val();
        var from_date = new Date(pickup_date_time).toLocaleDateString('fr-CA');
        var to_date = new Date(drop_off_date_time).toLocaleDateString('fr-CA');

        check_fleet(value_id,sku,from_date,to_date) 
              
              
    });


    // filter model on change start 
    $(document).on('change', '.filter_model', function () {

        var modal_id = $(this).val();

        $(function() {
            $("#select_model option").each(function(i){
                (modal_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });

        $(function() {
            $("#mselect_model option").each(function(i){
                (modal_id == $(this).val() ? $(this).prop('selected', true) : '');
            });
        });

        get_filter_fleet(modal_id) 


        
    });
    // filter model on change end 



    $(document).on('change', '.select_sku', function () {

        var value_id = $("#select_sku option:selected").text();
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
    function marchantbrandmodel(value_id,model_id) {
    
        $.ajax({
          url: '../marchantbrandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (data) {   
                $('.select_marchantmodel').html(data.html);
          },
          error: function (data) {
          }
      });
    }

    // -------------- Filter function start from here---------------------

        // getting filter model based on brand filter start 
        function filterbrandmodel(value_id,model_id) {
            $.ajax({
            url: '../brandmodel'+'/'+value_id+'/'+model_id, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false,
            cache : false, 
            processData: false,
            success: function (data) {   
                    $('.filter_model').html(data.html);
            },
            error: function (data) {
            }
        });
        }
        // getting filter model based on brand filter end 

        // getting filter model based on brand filter start 

        function get_filter_fleet(modal_id) {

            $.ajax({
            url: '../get_filter_model_fleet'+'/'+modal_id, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false,
            cache : false, 
            processData: false,
            success: function (data) {   
                    $('.filter_sku').html(data.html);
            },
            error: function (data) {
            }
        });
        }
    // getting filter model based on brand filter end 
    // -------------- Filter function end here---------------------
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
          var value_id = $(this).val();
          if(value_id == 1){
            $('#merchant').hide(); 
            $('#auto_dispached').show(); 
            
          }else{
            $('#merchant').show(); 
            $('#auto_dispached').hide(); 
          }
        });
    });
    function customer_data(value_id) {
        $.ajax({
          url: '../../customer_data'+'/'+value_id, // JSON file to add data,
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
        $(document).on('click', '#customer_ul li', function(){
            var value = $(this).text();
            var id = $(this).data('id');

            // $('#select_customer1').val(value);
            
            $('#select_customer_n').val(value);
            // $('#select_customer1').attr('data-id',id);
            $('#customer_list').html(""); 
            $('#select_customer').val(id);
            customer_data(id) ;

            $('#select_customer1').val('');  
        });

        $('#clear').click(function() {
            location.reload();
        });
    });
});





