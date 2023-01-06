

$(document).ready(function(){
   
  // From here code start for owner document tab under KYC tab 

          var ow_data_id;
          var ow_checked;
          var ow_id;
          var ow_onclickyes;


      $('.yes').click(function(){
           ow_data_id=$(this).attr('data-id');
           ow_checked=$(this).attr('value'); 
           ow_id=$(this).attr('data');
           ow_onclickyes=$(this);
            
         if(ow_data_id==1){
          $("#ow_approve_modal").modal('show');
         }else{
          $("#ow_reject_modal").modal('show');
         }

 
      }); 

      // this function will run when you click on submit button of wrong sign modal pop-up. 
      $('#ow_reason_submit').click(function(){

        var ow_reason=$("#ow_reason").val();
       
        $.ajax({
          url: '../reason_mail'+'/'+ow_data_id+'/'+ow_checked+'/'+ow_id+'/'+ow_reason, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false, 
          cache : false, 
          processData: false,
          success: function (response) { 
              // console.log(response);
       
                $("#ow_reject_modal").modal('hide');
               
                ow_onclickyes.closest('td').empty().append("<button id='negative' type='button' class='btn mr-4 open1' style='color:#fa0707; '>Rejected</button>");
                  
                 $("#ow_reason").val('');
          },
          error: function (response) {
            
          }
        }) 


      }); 
      //end

      $('#ow_check').click(function(){

        ($(this).is(":checked") == true ? $('#ow_date_input').prop('readonly',true).val('') : $('#ow_date_input').prop('readonly',false).val('') );
            
      });


      // this function will run when you click on submit button of right sign modal pop-up.
      $('#ow_appr_submit').click(function(){
           
        var ow_check = ($('#ow_check').is(":checked") == false ? 0 : 1);
        
        if(ow_check == 0){
           
          var ow_dates=$('#ow_date_input').val();

           if(!ow_dates){
            
            $('#ow_date_input_error').html("This field required.");
            return $('#ow_date_input').focus();
           }else{
            $('#ow_date_input_error').html("");
           }
        }
        else{ 
         
          var ow_dates='null';
          $('#ow_date_input_error').html("");
        }
       
        if(ow_dates!='null'){
          ow_onclickyes.closest('tr').find('td:last').text(ow_dates);
        }else{
          ow_onclickyes.closest('tr').find('td:last').text();
        } 
         
         var ow_password=$("#ow_master_password").val();
         var get_helper_password=$("#get_helper_password").val();
         
       if(ow_password != get_helper_password)
       {
           $('#ow_master_password_error').html("Password Mismatch");
           return $('#master_password').focus();

       }else{

        $('#ow_master_password_error').html("");
        
       
            $.ajax({
            url: '../aprroved_store'+'/'+ow_data_id+'/'+ow_checked+'/'+ow_id+'/'+ow_check+'/'+ow_dates, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false, 
            cache : false, 
            processData: false,
            success: function (response) { 
                 
                
                  $("#ow_approve_modal").modal('hide');
                   ow_onclickyes.closest('td').empty().append("<button id='pasitive' type='button' class='btn mr-4'  style='color:#18b220;'>Approved</button>");
                   $("#ow_check").prop('checked',false);
                   $("#ow_master_password").val('');
                   $('#ow_date_input').prop('readonly',false).val('');
                      
            },
            error: function (response) {
              
            }
        }) 

       }
     
      }); 

      //end

      // From here code end for owner document tab under KYC tab 

      //--------------------------------------------------//

      // From here code start for business document tab under KYC tab 

      var bu_data_id;
      var bu_checked;
      var bu_id;
      var bu_onclickyes;
 
      $('.no').click(function(){

        bu_data_id=$(this).attr('data-id');
        bu_checked=$(this).attr('value'); 
        bu_id=$(this).attr('data'); 
        bu_onclickyes=$(this);

        if(bu_data_id==1){
          $("#bu_approve_modal").modal('show');
         }else{
          $("#bu_reject_modal").modal('show');
         }

      }); 

      // this function will run when you click on submit button of wrong sign modal pop-up.
      $('#bu_reason_submit').click(function(){

          var bu_reason=$("#bu_reason").val();
          
          $.ajax({
            url: '../reason_mail1'+'/'+bu_data_id+'/'+bu_checked+'/'+bu_id+'/'+bu_reason, // JSON file to add data,
            type: 'get',
            dataType: 'json',
            contentType: false, 
            cache : false, 
            processData: false,
            success: function (response) { 
              $("#bu_reject_modal").modal('hide');
                  
              bu_onclickyes.closest('td').empty().append("<button id='negative' type='button' class='btn mr-4 open1' style='color:#fa0707; '>Rejected</button>");
                
              $("#bu_reason").val('');
            },
            error: function (response) {
              
            }
          }) 

      }); 
      //end

      $('#bu_check').click(function(){

        ($(this).is(":checked") == true ? $('#bu_date_input').prop('readonly',true).val('') : $('#bu_date_input').prop('readonly',false).val('') );
            
      });

      // this function will run when you click on submit button of right sign modal pop-up.
      $('#bu_appr_submit').click(function(){

        var bu_check = ($('#bu_check').is(":checked") == false ? 0 : 1);
        
        if(bu_check==0){
            
          var bu_dates=$('#bu_date_input').val();

          if(!bu_dates){
              
            $('#bu_date_input_error').html("This field required.");
            return $('#date_input').focus();
            }else{
            $('#bu_date_input_error').html("");
            }
        }
        else{ 
          
          var bu_dates='null';
          $('#bu_date_input_error').html("");
        }

        if(bu_dates!='null'){
          bu_onclickyes.closest('tr').find('td:last').text(bu_dates);
        }else{
          bu_onclickyes.closest('tr').find('td:last').text();
        } 

        var bu_password=$("#bu_master_password").val();
        var get_helper_password=$("#get_helper_password").val();
          
        if(bu_password != get_helper_password)
        {
            $('#bu_master_password_error').html("Password Mismatch");
            return $('#master_password').focus();
        }
        else
        {
            $('#bu_master_password_error').html("");

            $.ajax({
              url: '../rejected_store'+'/'+bu_data_id+'/'+bu_checked+'/'+bu_id+'/'+bu_check+'/'+bu_dates, // JSON file to add data,
              type: 'get',
              dataType: 'json',
              contentType: false,
              cache : false, 
              processData: false,
              success: function (response) { 
                $("#bu_approve_modal").modal('hide');
                          
                bu_onclickyes.closest('td').empty().append("<button id='pasitive' type='button' class='btn mr-4'  style='color:#18b220;'>Approved</button>");
                    
                $("#bu_check").prop('checked',false);
                $("#bu_master_password").val('');
                $('#bu_date_input').prop('readonly',false).val('');

              },
              error: function (response) {
                
              }
            }) 
        }

      }); 

      //end

    // From here code end for business document tab under KYC tab 

    //--------------------------------------------------//

    // From here code start for other document tab under KYC tab 

    var ot_data_id;
    var ot_checked;
    var ot_id;
    var ot_onclickyes;


    $('.not').click(function(){

      ot_data_id=$(this).attr('data-id');
      ot_checked=$(this).attr('value'); 
      ot_id=$(this).attr('data'); 
      ot_onclickyes=$(this);

      if(ot_data_id==1){
        $("#ot_approve_modal").modal('show');
      }else{
        $("#ot_reject_modal").modal('show');
      }


    });  

    // this function will run when you click on submit button of wrong sign modal pop-up.
    $('#ot_reason_submit').click(function(){

      var ot_reason=$("#ot_reason").val();
      
      $.ajax({
        url: '../reason_mail2'+'/'+ot_data_id+'/'+ot_checked+'/'+ot_id+'/'+ot_reason, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false, 
        cache : false, 
        processData: false,
        success: function (response) { 
          $("#ot_reject_modal").modal('hide');
                 
          ot_onclickyes.closest('td').empty().append("<button id='negative' type='button' class='btn mr-4 open1' style='color:#fa0707; '>Rejected</button>");
            
           $("#ot_reason").val('');
        },
        error: function (response) {
          
        }
      }) 
     
    }); 
    //end

    $('#ot_check').click(function(){

      ($(this).is(":checked") == true ? $('#ot_date_input').prop('readonly',true).val('') : $('#ot_date_input').prop('readonly',false).val('') );
          
    });

    // this function will run when you click on submit button of right sign modal pop-up.
    $('#ot_appr_submit').click(function(){

      var ot_check = ($('#ot_check').is(":checked") == false ? 0 : 1);
        
      if(ot_check==0){
            
            var ot_dates=$('#ot_date_input').val();

            if(!ot_dates){
              $('#ot_date_input_error').html("This field required.");
              return $('#ot_date_input').focus();
            }else{
              $('#ot_date_input_error').html("");
            }
      }
      else{ 
        
        var ot_dates='null';
        $('#ot_date_input_error').html("");
      }

      if(ot_dates!='null'){
        ot_onclickyes.closest('tr').find('td:last').text(ot_dates);
      }else{
        ot_onclickyes.closest('tr').find('td:last').text();
      } 

      var ot_password=$("#ot_master_password").val();
      var get_helper_password=$("#get_helper_password").val();
        
      if(ot_password != get_helper_password)
      {
          $('#ot_master_password_error').html("Password Mismatch");
          return $('#ot_master_password').focus();
      }else{

        $('#ot_master_password_error').html("");

        $.ajax({
          url: '../aprrov_store'+'/'+ot_data_id+'/'+ot_checked+'/'+ot_id+'/'+ot_check+'/'+ot_dates, // JSON file to add data,
          type: 'get',
          dataType: 'json',
          contentType: false,
          cache : false, 
          processData: false,
          success: function (response) { 
            $("#ot_approve_modal").modal('hide');
                        
            ot_onclickyes.closest('td').empty().append("<button id='pasitive' type='button' class='btn mr-4'  style='color:#18b220;'>Approved</button>");
                              
                          $("#bu_check").prop('checked',false);
                          $("#ot_master_password").val('');
                          $('#ot_date_input').prop('readonly',false).val('');
          },
          error: function (response) {
            
          }
        })

      }

    }); 
    //end

    // From here code end for other document tab under KYC tab 

    //--------------------------------------------------//

    //Code written for set icon for different extension that is not preview
    $(".doc_image").each(function() {

      var src = $(this).attr('src');
      var ext = src.split('.').pop();

      if(ext == 'pdf'){
          $(this).attr('src', '/public/company/docs/pdf_image.png');
      }
      else if(ext == 'zip'){

        $(this).attr('src', '/public/company/docs/zip.png');

      }else if(ext == 'jpg' || ext == 'jpeg' || ext == 'png'){

      }else if(ext == 'doc' || ext == 'docx' || ext == 'docx'){

            $(this).attr('src', '/public/company/docs/docs.png');

      }else if(ext == 'txt'){

          $(this).attr('src', '/public/company/docs/file.png');
      }else{

          $(this).attr('src', '/public/company/docs/file.png');
      }
      
    });


  // From here code written for bank approval or reject function.

  var ban_bank;
  var ban_id;
  var ban_onclickyes;

  $('.bank_check').click(function(){

    ban_bank=$(this).attr('bank');
    ban_id=$(this).attr('value');
    ban_onclickyes=$(this);

      if(ban_bank==1){ 
        $("#ban_approve_modal").modal('show');
      }else{
        $("#ban_reject_modal").modal('show');
      }
    
  }); 


  $('#ban_reason_submit').click(function(){

    var ban_reason=$("#ban_reason").val();
    
    $.ajax({
      url: '../bank_check_store_reason'+'/'+ban_bank+'/'+ban_id+'/'+ban_reason, // JSON file to add data,
      type: 'get',
      dataType: 'json',
      contentType: false, 
      cache : false, 
      processData: false,
      success: function (response) { 
        $("#ban_reject_modal").modal('hide');

         ban_onclickyes.closest('td').empty().append("<button id='negative' type='button' class='btn mr-4 open1' style='color:#fa0707; '>Rejected</button>");
          
         $("#ban_reason").val('');
        
      },
      error: function (response) {
        
      }
    }) 

    // $.ajax({
    // url: '../bank_check_store'+'/'+ban_bank+'/'+ban_id, // JSON file to add data,
    // type: 'get',
    // dataType: 'json',
    // contentType: false, 
    // cache : false, 
    // processData: false,
    // success: function (response) { 
    //  // console.log(response);
    //   // location.reload();
      
    // },
    // error: function (response) {
      
    // }
    // })  

  }); 


    $('#ban_check').click(function(){

      ($(this).is(":checked") == true ? $('#ban_date_input').prop('readonly',true).val('') : $('#ban_date_input').prop('readonly',false).val('') );
          
    });

    // this function will run when you click on submit button of right sign modal pop-up.
    $('#ban_appr_submit').click(function(){

      var ban_check = ($('#ban_check').is(":checked") == false ? 0 : 1);
      if(ban_check==0){
      
        var ban_dates=$('#ban_date_input').val();

      if(!ban_dates){
          
        $('#ban_date_input_error').html("This field required.");
        return $('#ban_date_input').focus();

      }else{

        $('#ban_date_input_error').html("");

      }

      }else{ 
    
        var ban_dates='null';
        $('#ban_date_input_error').html("");

      }

      var ban_password=$("#ban_master_password").val();
      var get_helper_password=$("#get_helper_password").val();

      if(ban_password != get_helper_password)
      {
          $('#ban_master_password_error').html("Password Mismatch");
          return $('#master_password').focus();
      }else{
        $('#ban_master_password_error').html("");

        $.ajax({
        url: '../bank_check_store'+'/'+ban_bank+'/'+ban_id, // JSON file to add data,
        type: 'get',
        dataType: 'json',
        contentType: false, 
        cache : false, 
        processData: false,
          success: function (response) { 
          
            $("#ban_approve_modal").modal('hide');
                    
            ban_onclickyes.closest('td').empty().append("<button id='pasitive' type='button' class='btn mr-4'  style='color:#18b220;'>Approved</button>");
                
            $("#ban_check").prop('checked',false);
            $("#ban_master_password").val('');
            $('#ban_date_input').prop('readonly',false).val('');
          },
          error: function (response) {
            
          }
        }) 
      }

    }); 
    //end

    // From here code end for other document tab under KYC tab 

    //--------------------------------------------------//

});