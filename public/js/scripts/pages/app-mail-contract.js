

$(document).ready(function(){

    function ToastError(type, message)
    {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "2000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr[type](message);
    }



    $('#submit').attr('disabled', true);
    $('#agree_options').hide();
    $('#otp').hide();
    $('#e-signature').hide();


    $('#terms').change(function() {

        $('input[type=radio][name="agree_option"]').prop('checked', false);

        if(this.checked) {

            $('#submit').attr('disabled', false);
            $('#agree_options').show();

        } else {
            $('#submit').attr('disabled', true);
            $('#agree_options').hide();
            $('#otp').hide();
            $('#e-signature').hide();
        }
    });


    $('input[type=radio][name="agree_option"]').change(function () {
        if(this.value == "OTP") {
            const company_id =$('#company_id').val();
            $('.loadering').show();
            $.ajax({
                url:"../send-otp/"+company_id,
                method:"GET",
                // data:{company_id},
                success:function(res_card)
                {
                    $('.loadering').hide();
                    $('#otp').show();
                    $('#e-signature').hide();
                    //Get refreence to span and button
                    var spn = document.getElementById("count");
                    var btn = document.getElementById("btnCounter");

                    var count = 60;     // Set count
                    var timer = null;  // For referencing the timer

                    (function countDown(){
                        // Display counter and start counting down
                        spn.textContent = count;

                        // Run the function again every second if the count is not zero
                        if(count !== 0){
                            $('#count').show();
                            timer = setTimeout(countDown, 1000);
                            count--; // decrease the timer
                        } else {
                            // Enable the button
                            btn.removeAttribute("disabled");
                            $('#count').hide();
                        }
                    }());
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });

        }
        else {
            $('#otp').hide();
            $('#e-signature').show();
        }
    });


    $('#btnCounter').click(function() {
        const company_id =$('#company_id').val();
        $('.loadering').show();
        $.ajax({
            url:"../send-otp/"+company_id,
            method:"GET",
            // data:{company_id},
            success:function(res_card)
            {
                $('.loadering').hide();
                //Get refreence to span and button

                var spn = document.getElementById("count");
                var btn = document.getElementById("btnCounter");
                var count = 60;     // Set count
                var timer = null;  // For referencing the timer

                (function countDown(){
                    // Display counter and start counting down
                    spn.textContent = count;
                    // Run the function again every second if the count is not zero
                    if(count !== 0){
                        $('#count').show();
                        timer = setTimeout(countDown, 1000);
                        count--; // decrease the timer
                    } else {
                        // Enable the button
                        btn.removeAttribute("disabled");
                        $('#count').hide();
                    }
                }());
            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });
    });



    $('#submit').click(function() {

        if($('input[name="agree_option"]:checked').map(function () { return $(this).val(); }).get() == "")
        {
            ToastError("error", "Please select Option");
            return false;

        }else if($('input[name="agree_option"]:checked').map(function () { return $(this).val(); }).get()=='E-Signature' && $('#signature64').val() == "")
        {
            ToastError("error", "Please write signtaure");
            return false;

        }
        else if($('input[name="agree_option"]:checked').map(function () { return $(this).val(); }).get()=='OTP' && $('#otp_input').val() == "")
        {
            ToastError("error", "Please Enter OTP");

            return false;

        }

        $('.loadering').show();
        $.ajax({
            url:'../virtual-contract-store',
            method:"POST",
            data: $('#formvirtual').serialize(),
            success:function(res)
            {
                if(res == 1){
                    ToastError("error", "Please write signature");
                    $('.loadering').hide();
                }else  if(res == 2){
                    ToastError("success", "You have successfully agreed to our virtual agreement");
                    window.location.href = "../company-list";
                }else  if(res == 3){
                    ToastError("error", "Please enter OTP");
                    $('.loadering').hide();
                }else  if(res == 4){
                    ToastError("success", "You have successfully agreed to our virtual agreement");
                    window.location.href = "../company-list";
                }else  if(res == 5){
                    ToastError("error", "You have entered an invalid OTP");
                    $('.loadering').hide();
                }

            },
            error:function(xhr)
            {
                console.log(xhr.responseText);
            }
        });
    });





});