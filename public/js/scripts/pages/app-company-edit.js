// Vanilla Javascript
var input = document.querySelector("#phone");
window.intlTelInput(input,({
    preferredCountries: ["ae"],
}));

$(document).ready(function() {
    $('.iti__flag-container').click(function() { 
        var countryCode = $('.iti__selected-flag').attr('title');
        var countryCode = countryCode.replace(/[^0-9]/g,'')
        $('#phone').val("");
        $('#phone').val("+"+countryCode+" "+ $('#phone').val());
    });
});


//For business phone number start here

    // Vanilla Javascript
    var input1 = document.querySelector("#org_phone");
    window.intlTelInput(input1,({
        preferredCountries: ["ae"],
    }));

    $(document).ready(function() {
        $('.iti__flag-container').click(function() { 
            var countryCode = $('.iti__selected-flag').attr('title');
            var countryCode = countryCode.replace(/[^0-9]/g,'')
            $('#org_phone').val("");
            $('#org_phone').val("+"+countryCode+" "+ $('#org_phone').val());
        });
    });

//For business phone number end here


$(document).ready(function(){


    //Generating Random Password
    $('#generate_password').click(function(){
        // var randomstring = Math.random().toString(36).slice(-8);
        // $('#password').val(randomstring);
        var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var passwordLength = 8;
        var password = "";
        for (var i = 0; i <= passwordLength; i++) {
           var randomNumber = Math.floor(Math.random() * chars.length);
           password += chars.substring(randomNumber, randomNumber +1);
         } 
             document.getElementById("password").value = password;
             document.getElementById("confirm_password").value = password;
        // $('#confirm_password').val(randomstring);
    });

    $(".togglePassword").click(function (e) {
        e.preventDefault();
        console.log('hello');
        var type = $(this).parent().parent().find(".password").attr("type");
        if(type == "password"){
            $(this).find("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
            $(this).parent().parent().find(".password").attr("type","text");
        }else if(type == "text"){
            $(this).find("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
            $(this).parent().parent().find(".password").attr("type","password");
        }
    });

    var i = $('#row_count').val();
    i++;

    // Getting Values For Edit Bank
    var row_id = '';
    var row_no = '';
    var checkBankExitOrNot = '';
    $('#tbody').delegate('#edit', 'click', function()
    {
        row_id = $(this).closest('tr').find('input[name="e_id"]').val();
        row_no = $(this).closest('tr').find('input[name="row_no"]').val();
        checkBankExitOrNot = $(this).closest('tr').find('input[name="bank_id"]').val();
        const bank_name = $(this).closest('tr').find('input[name="e_bank_name"]').val();
        const bic = $(this).closest('tr').find('input[name="e_bic"]').val();
        const account_name = $(this).closest('tr').find('input[name="e_account_name"]').val();
        const iban = $(this).closest('tr').find('input[name="e_iban"]').val();
        const account_no = $(this).closest('tr').find('input[name="e_account_no"]').val();
        const curreny = $(this).closest('tr').find('input[name="e_currency"]').val();
        const status = $(this).closest('tr').find('input[name="e_status"]').val();

        $('#add').addClass('d-none');
        $('#edit_btn').removeClass('d-none');
        $('#bank_name').val(bank_name);
        $('#bic').val(bic);
        // $('#iban').attr('readonly',true);
        $('#account_name').val(account_name);
        $('#iban').val(iban);
        $('#account_no').val(account_no);
        $('#b_currency').val(curreny);
        $('#b_status').val(status);
    });
    
    // Create Bank Dynamic Crud
    $('#add').click(function(){
        const bank_name = $('#bank_name').val();
        const bic = $('#bic').val();
        const account_name = $('#account_name').val();
        const iban = $('#iban').val();
        const account_no = $('#account_no').val();
        const currency = $('select[name="b_currency"]').val();
        const status = $('#b_status').val();
      
        // Applying Validations Here
        if(!bank_name || !$.trim(bank_name).length)
        {

            $('#bank_name_error').html("The bank field is required");
            return $('#bank_name').focus();
        }
        else if(bank_name.length < 5)
        {

            $('#bank_name_error').html("The bank field length should be at least 5 characters.");
            return $('#bank_name').focus();
        }
        else if(!bic || !$.trim(bic).length)
        {

            $('#bank_name_error').html("");
            $('#bic_error').html("The BIC/SWIFT field is required");
            return $('#bic').focus();
        }
        else if(!account_name || !$.trim('account_name').length)
        {

            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("The account name field is required");
            return $('#account_name').focus();
        }
        else if(account_name.length < 5)
        {

            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("The account name field length should be at least 5 characters.");
            return $('#account_name').focus();
        }
        else if(!iban || !$.trim(iban).length)
        {

            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("");
            $('#iban_error').html("The IBAN field is required");
            return $('#iban').focus();
        }
        else if(iban < 16)
        {
            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("");
            $('#iban_error').html("The IBAN should be greater than 15 characters");
            return $('#iban').focus();
        }
        else if(!account_no || !$.trim(account_no).length)
        {

            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("");
            $('#iban_error').html("");
            $('#account_no_error').html("The account no. field is required");
            return $('#account_no').focus();
        }
        else if(account_no.length < 10)
        {

            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("");
            $('#iban_error').html("");
            $('#account_no_error').html("The acount no. should be greater than 10 characters");
            return $('#account_no').focus();
        }
      
        else  
        {

            // Checking IBAN with Dynamic Created Array
            // if($("input[name='d_iban[]']") !== undefined){
            //    var d_iban = $("input[name='d_iban[]']").map(function(){
            //         return $(this).val();
            //     }).get();
            //     if(d_iban.length > 0)
            //     {
            //         for(var j=0; j < d_iban.length; j++)
            //         {
            //             if(iban === d_iban[j])
            //             {
            //                 $('#iban_error').html("This IBAN is already added to table");
            //                 return $('#iban').focus();
            //             }
            //         }
            //     }
            // }

            $('#bank_name_error').html("");
            $('#bic_error').html("");
            $('#account_name_error').html("");
            $('#iban_error').html("");
            $('#account_no_error').html("");
            
            // Seding Ajax Request for creating Bank Account
            $.ajax({
                url:"../check-unique-bank-numbers",
                method:"POST",
                data:{bank_name, bic, account_name, iban, account_no, currency, status, "_token": $('#token').val()},
                beforeSend:function()
                {
                    $('#add').attr('disabled',true);
                },
                complete:function()
                {
                    $('#add').removeAttr('disabled');
                },
                success:function(res)
                {
                    $('#add').removeAttr('disabled');

                    console.log('success');

                    if(res == "true")
                    {
                        $('#bank_name').val("");
                        $('#bic').val("");
                        $('#account_name').val("");
                        $('#iban').val("");
                        $('#account_no').val("");

                        var tbody = `
                        <tr id="row_${i}">
                            <td>${i}<input type="hidden" name="d_id[]" value="${i}"></td>
                            <td>${bank_name} <input type="hidden" name="d_bank_name[]" value="${bank_name}"></td>
                            <td>${bic} <input type="hidden" name="d_bic[]" value="${bic}"></td>
                            <td>${account_name} <input type="hidden" name="d_account_name[]" value="${account_name}"></td>
                            <td>${account_no} <input type="hidden" name="d_account_no[]" value="${account_no}"></td>
                            <td>${iban} <input type="hidden" name="d_iban[]" value="${iban}"></td>
                            <td>${currency} <input type="hidden" name="d_currency[]" value="${currency}"></td>
                            <td>
                                `;
                                if(status == 0)
                                {
                                    tbody += `<label class="label label-lg label-light-warning label-inline">Pending</label>`;
                                }
                                else if(status == 1)
                                {
                                    tbody += `<label class="label label-lg label-light-success label-inline">Approved</label>`;
                                }
                                else
                                {
                                    tbody += `<label class="label label-lg label-light-danger label-inline">Rejected</label>`;
                                }
                            tbody += ` <input type="hidden" name="d_status[]" value="${status}"></td>
                            <td>
                                <input type="hidden" name="e_id" value="${i}"/>
                                <input type="hidden" name="row_no" value="${i}"/>
                                <input type="hidden" name="bank_id" value="0">
                                <input type="hidden" name="e_bank_name" value="${bank_name}"/>
                                <input type="hidden" name="e_bic" value="${bic}"/>
                                <input type="hidden" name="e_account_no" value="${account_no}"/>
                                <input type="hidden" name="e_account_name" value="${account_name}"/>
                                <input type="hidden" name="e_iban" value="${iban}"/>
                                <input type="hidden" name="e_currency" value="${currency}"/>
                                <input type="hidden" name="e_status" value="${status}"/>
                                <div class="d-flex align-items-center col-actions"> 

                                <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                        </svg>
                                    </span>
                                </a>

                                <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                                    <span class="svg-icon svg-icon-md svg-icon-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    </span>
                                </a>
                                </div>
                            </td>
                        </tr>
                        `;
                        i++;
                        $('#tbody').append(tbody);
                    }
                    else if(res == "Cyber")
                    {
                        ToastError("warning", "Cyber");
                    }
                    else if(res == "iban")
                    {
                        $('#iban_error').html("IBAN exist.");
                        return $('#iban').focus();
                    }
                    else if(res == "account_no")
                    {
                        $('#account_no_error').html("Account no. exist.");
                        return $('#account_no').focus();
                    }
                },error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }
    });


    //Create Bank Dynamic Crud
    $('#edit_btn').click(function(){    
            console.log(checkBankExitOrNot);
            const company_id = $('#company_id').val();
            const bank_name = $('#bank_name').val();
            const bic = $('#bic').val();
            const account_name = $('#account_name').val();
            const iban = $('#iban').val();
            const account_no = $('#account_no').val();
            const currency = $('#b_currency').val();
            const status = $('#b_status').val();

            // Applying Validations Here
            if(!bank_name || !$.trim(bank_name).length)
            {

                $('#bank_name_error').html("The bank field is required");
                return $('#bank_name').focus();
            }
            else if(bank_name.length < 5)
            {

                $('#bank_name_error').html("The bank field length should be at least 5 characters.");
                return $('#bank_name').focus();
            }
            else if(!bic || !$.trim(bic).length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("The BIC/SWIFT field is required");
                return $('#bic').focus();
            }
            else if(!account_name || !$.trim('account_name').length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("The account name field is required");
                return $('#account_name').focus();
            }
            else if(account_name.length < 5)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("The account name field length should be at least 5 characters.");
                return $('#account_name').focus();
            }
            else if(!iban || !$.trim(iban).length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("The IBAN field is required");
                return $('#iban').focus();
            }
            else if(iban < 16)
            {
                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("The IBAN should be greater than 15 characters");
                return $('#iban').focus();
            }
            else if(!account_no || !$.trim(account_no).length)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("The account no. field is required");
                return $('#account_no').focus();
            }
            else if(account_no.length < 10)
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("The acount no should be greater than 10 characters");
                return $('#account_no').focus();
            }
            else
            {

                $('#bank_name_error').html("");
                $('#bic_error').html("");
                $('#account_name_error').html("");
                $('#iban_error').html("");
                $('#account_no_error').html("");


                //Checking IBAN with Dynamic Created Array
                // if($("input[name='d_iban[]']") !== undefined){                                                                                          
                //    var d_iban = $("input[name='d_iban[]']").map(function(){
                //         return $(this).val();
                //     }).get();
                //     var d_id = $("input[name='d_id[]']").map(function(){
                //         return $(this).val();
                //     }).get();
                //     if(d_iban.length > 0)
                //     {
                //         for(var j=0; j < d_iban.length; j++)
                //         {
                //             if(iban === d_iban[j] && row_id != d_id[j])
                //             {
                //                 $('#iban_error').html("This IBAN is already added to table");
                //                 return $('#iban').focus();
                //             }
                //         }
                //     }
                // }

                if(checkBankExitOrNot != '0')
                {
                //Seding Ajax Requrest for creating Bank Account
                $.ajax({
                    url:"../update-bank",                                                                                                                                                                
                    method:"POST",
                    data:{id:row_id, company_id, bank_name, bic, account_name, iban, account_no, currency, status,"_token": $('#token').val()},
                    beforeSend:function()
                    {
                        // $('#edit_btn').attr('disabled',true);
                        // $('#edit_btn').html('Please wait');
                    },
                    complete:function()
                    {
                        $('#add').removeAttr('disabled');

                    },
                    success:function(res)
                    {
                        if(res == "true")
                        {

                            $('#edit_btn').addClass('d-none');
                            $('#add').removeClass('d-none');

                            $('#bank_name').val("");
                            $('#bic').val("");
                            $('#account_name').val("");
                            $('#iban').val("");
                            $('#account_no').val("");
                            $('#b_status').val('0');
                            var tbody = `
                                <td>${row_no} <input type="hidden" name="d_id[]" value="${row_id}"></td>
                                <td>${bank_name} <input type="hidden" name="d_bank_name[]" value="${bank_name}"></td>
                                <td>${bic} <input type="hidden" name="d_bic[]" value="${bic}"></td>
                                <td>${account_name} <input type="hidden" name="d_account_name[]" value="${account_name}"></td>
                                <td>${account_no} <input type="hidden" name="d_account_no[]" value="${account_no}"></td>
                                <td>${iban} <input type="hidden" name="d_iban[]" value="${iban}"></td>
                                <td>${currency} <input type="hidden" name="d_currency[]" value="${currency}"></td>
                                <td>
                                    `;
                                    if(status == 0)
                                    {
                                        tbody += `<label class="label label-lg label-light-warning label-inline">Pending</label>`;
                                    }
                                    else if(status == 1)
                                    {
                                        tbody += `<label class="label label-lg label-light-success label-inline">Accepted</label>`;
                                    }
                                    else
                                    {
                                        tbody += `<label class="label label-lg label-light-danger label-inline">Rejected</label>`;
                                    }
                                tbody += ` <input type="hidden" name="d_status[]" value="${status}"></td>
                                <td>
                                    <input type="hidden" name="e_id" value="${row_id}"/>
                                    <input type="hidden" name="e_bank_name" value="${bank_name}"/>
                                    <input type="hidden" name="e_bic" value="${bic}"/>
                                    <input type="hidden" name="e_account_no" value="${account_no}"/>
                                    <input type="hidden" name="e_account_name" value="${account_name}"/>
                                    <input type="hidden" name="e_iban" value="${iban}"/>
                                    <input type="hidden" name="e_currency" value="${currency}"/>
                                    <input type="hidden" name="e_status" value="${status}"/>
                                    <div class="d-flex align-items-center col-actions"> 
                                    <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </g>
                                            </svg>
                                        </span>
                                    </a>

                                    <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                                        <span class="svg-icon svg-icon-md svg-icon-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        </span>
                                    </a>
                                    </div>
                                </td>
                            `;
                            $(`#row_${row_id}`).html(tbody);
                        }
                        else if(res == "Cyber")
                        {
                            ToastError("warning", "Something Went Wrong!!!')");
                        }
                        else if(res == "iban")
                        {
                            $('#iban_error').html("IBAN is already exist.')");
                            return $('#iban').focus();
                        }
                        else if(res == "account_no")
                        {
                            $('#account_no_error').html("Account no. is already exist.");
                            return $('#account_no').focus();
                        }
                    },error:function(xhr)
                    {
                        console.log(xhr.responseText);
                    }
                });
                }else{

                    $('#edit_btn').addClass('d-none');
                            $('#add').removeClass('d-none');

                            $('#bank_name').val("");
                            $('#bic').val("");
                            $('#account_name').val("");
                            $('#iban').val("");
                            $('#account_no').val("");
                            $('#b_status').val('0');
                            var tbody = `
                                <td>${row_id} <input type="hidden" name="d_id[]" value="${row_id}"></td>
                                <td>${bank_name} <input type="hidden" name="d_bank_name[]" value="${bank_name}"></td>
                                <td>${bic} <input type="hidden" name="d_bic[]" value="${bic}"></td>
                                <td>${account_name} <input type="hidden" name="d_account_name[]" value="${account_name}"></td>
                                <td>${account_no} <input type="hidden" name="d_account_no[]" value="${account_no}"></td>
                                <td>${iban} <input type="hidden" name="d_iban[]" value="${iban}"></td>
                                <td>${currency} <input type="hidden" name="d_currency[]" value="${currency}"></td>
                                <td>
                                    `;
                                    if(status == 0)
                                    {
                                        tbody += `<label class="label label-lg label-light-warning label-inline">Under Review</label>`;
                                    }
                                    else if(status == 1)
                                    {
                                        tbody += `<label class="label label-lg label-light-success label-inline">Accepted</label>`;
                                    }
                                    else
                                    {
                                        tbody += `<label class="label label-lg label-light-danger label-inline">Rejected</label>`;
                                    }
                                tbody += ` <input type="hidden" name="d_status[]" value="${status}"></td>
                                <td>
                                    <input type="hidden" name="e_id" value="${row_id}"/>
                                    <input type="hidden" name="bank_id" value="0">
                                    <input type="hidden" name="e_bank_name" value="${bank_name}"/>
                                    <input type="hidden" name="e_bic" value="${bic}"/>
                                    <input type="hidden" name="e_account_no" value="${account_no}"/>
                                    <input type="hidden" name="e_account_name" value="${account_name}"/>
                                    <input type="hidden" name="e_iban" value="${iban}"/>
                                    <input type="hidden" name="e_currency" value="${currency}"/>
                                    <input type="hidden" name="e_status" value="${status}"/>
                                    <div class="d-flex align-items-center col-actions"> 
                                    <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </g>
                                            </svg>
                                        </span>
                                    </a>

                                    <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                                        <span class="svg-icon svg-icon-md svg-icon-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        </span>
                                    </a>
                                    </div>
                                </td>
                            `;
                            $(`#row_${row_id}`).html(tbody);
                }
            }
    });


    //Updating company details code
   $('#save').click(function()
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
       
       const company_name = $('#company_name').val();
       const company_id = $('#company_id').val();
       const first_name = $('#first_name').val();   
       const last_name = $('#last_name').val();
       const admin_email = $('#admin_email').val();
       const admin_phone = $('#phone').val();
       const password = $('#password').val();
       const confirm_password = $('#confirm_password').val();
       const website = $('#website').val();
       const designation = $('#designation').val(); 

       const gener_country = $('#gener_country').val();
       const gener_city = $('#gener_city').val();

        
       const gener_state = $('#gener_state').val();
       const org_phone = $('#org_phone').val();
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

       var urlPattern = new RegExp('^(https?:\\/\\/)?'+ // validate protocol
       '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // validate domain name
       '((\\d{1,3}\\.){3}\\d{1,3}))'+ // validate OR ip (v4) address
       '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // validate port and path
       '(\\?[;&a-z\\d%_.~+=-]*)?'+ // validate query string
       '(\\#[-a-z\\d_]*)?$','i'); // validate fragment locator

       $('#company_name_error').html("");
       $('#first_name_error').html("");
       $('#last_name_error').html("");
       $('#admin_email_error').html("");    
       $('#admin_web_error').html("");
       $('#admin_phone_error').html("");
       $('#admin_password_error').html("");
       $('#admin_confirm_password_error').html("");


        // Applying Validations Here
        if(!company_name || !$.trim(company_name).length)
        {

            $('#company_name_error').html("The company name field is required");
            return $('#company_name').focus(); 
        }
        else if(!first_name || !$.trim(first_name).length)
        {
            $('#first_name_error').html("The first name field is required");
            return $('#first_name').focus(); 
        }
        else if(!last_name || !$.trim(last_name).length)
        {
            $('#last_name_error').html("The last name field is required");
            return $('#last_name').focus(); 
        }
        else if(!admin_email || !$.trim(admin_email).length)
        {
            $('#admin_email_error').html("The email field is required");
            return $('#admin_email').focus(); 
        }
        else if(!emailReg.test(admin_email))
        {
            $('#admin_email_error').html("The email is not valid");
            return $('#admin_email').focus(); 
        }
        // else if(website && !urlPattern.test(website))
        // {

        //     $('#admin_web_error').html("The web address is not valid");
        //     return $('#website').focus(); 

        // }
        else if(!admin_phone || !$.trim(admin_phone).length)
        {
            $('#admin_phone_error').html("The phone field is required");
            return $('#phone').focus(); 
        }
        else if(admin_phone.length > 15)
        {
            $('#admin_phone_error').html("The phone field should be less than 15 digit.");
            return $('#phone').focus(); 
        }
        else if(admin_phone.length < 4)
        {
            $('#admin_phone_error').html("The phone field should be greater than 4 digit.");
            return $('#phone').focus(); 
        }
        else if(!password || !$.trim(password).length)
        {
            $('#admin_password_error').html("The password field is required");
            return $('#password').focus(); 
        }
        else if(!confirm_password || !$.trim(confirm_password).length)
        {
            $('#admin_confirm_password_error').html("The confirm password field is required");
            return $('#confirm_password').focus(); 
        }
        else if(password != confirm_password)
        {
            $('#admin_confirm_password_error').html("The password field doesn't match with confirm password");
            return $('#confirm_password').focus(); 
        }
        else
        {


        //In KYC tab ->For Owner tab document upload
    //    const own_document1 = $('#own_document1').val();
       const ow_document_type_1 = $('#ow_document_type1').val();

    //    const own_document2 = $('#own_document2').val();
       const ow_document_type_2 = $('#ow_document_type2').val();

    //    const own_document3 = $('#own_document3').val();
       const ow_document_type_3 = $('#ow_document_type3').val();

    //    const own_document4 = $('#own_document4').val();
       const ow_document_type_4 = $('#ow_document_type4').val();

       //In KYC tab ->For Bussiness tab document upload
    //    const bu_document1 = $('#bu_document1').val();
       const bu_document_type_1 = $('#bu_document_type_1').val();

    //    const bu_document2 = $('#bu_document2').val();
       const bu_document_type_2 = $('#bu_document_type_2').val();

    //    const bu_document3 = $('#bu_document3').val();
       const bu_document_type_3 = $('#bu_document_type_3').val();

       const tax_document_check_box = $('input[name="tax_document_check_box"]:checked').val();    

    //    const bu_document4 = $('#bu_document4').val();
       const bu_document_type_4 = $('#bu_document_type_4').val();

        //    const bu_document5 = $('#bu_document5').val();
        const bu_document_type_5 = $('#bu_document_type_5').val();

        //In KYC tab -> For Other tab upload document
    //    const ot_document1 = $('#ot_document1').val();
       const ot_document_type_1 = $('#ot_document_type_1').val();

    //    const ot_document2 = $('#ot_document2').val();
       const ot_document_type_2 = $('#ot_document_type_2').val();

    //    const ot_document3 = $('#ot_document3').val();
       const ot_document_type_3 = $('#ot_document_type_3').val();

    //    const ot_document4 = $('#ot_document4').val();
       const ot_document_type_4 = $('#ot_document_type_4').val();


       // For More Information tab 

       const trn_number = $('#trn_number').val();
       const office_address = $('#office_address').val();
       const more_info_city = $('#more_info_city').val();
       const more_inf_country = $('#more_inf_country').val();  

       const more_info_state = $('#more_info_state').val();
       const more_info_zip = $('#more_info_zip').val();
       const more_info_profile_image = $('#more_info_profile_image').val();
       const profile_id = $('#profile_id').val();
       const server_key = $('#server_key').val();
       const company_prefix = $('#company_prefix').val();
       const account_type = $('#account_type').val();

       const more_info_currency =  $('#more_info_currency').val();

       const company_profile = $('#company_profile').val();

       const package = $('#package').val();  

       const branded_pay_page = $('#branded_pay_page').is(':checked');  
       const branded_email = $('#branded_email').is(':checked');
       const withdraw_limit = $('#kt_select2_1').val();
       const available_limit = $('#kt_select2_2').val();
       const sender_id_by_name = $('#sender_id_by_name').val();
       const api_key = $('#api_key').val();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
       const sms_limit = $('#sms_limit').val();


       //For Subscription tab 

       const billing_plan = $('#billing_plan').val();

       const add_on_charge = $('#add_on_charge').val();
       const deposit = $('#deposit').val();

       const convenience_fees_type = $('input[name="convenience_fees_type"]:checked').val();

       const convenience_amount = $('#convenience_amount').val();

       const commision_fees_type = $('input[name="commision_fees_type"]:checked').val();

       const commission_amount = $('#commission_amount').val();

       const withdrawal_charge_add = $('input[name="withdrawal_charge_add"]:checked').val();

       const withdrawal_charge_amt = $('#withdrawal_charge_amt').val(); 


       const payment_gateway_charge = [];

       $('input[name="payment_gateway_charge[]"]:checked').each(function(){
        payment_gateway_charge.push($(this).val());
        });

        const payement_gateway_amount = [];

        $('input[name="payement_gateway_amount[]"]').each(function(){
            if($(this).val() != ''){
                payement_gateway_amount.push($(this).val());

            }
         });

       const first_billing_date = $('#first_billing_date').val(); 

       const end_billing_date = $('#end_billing_date').val(); 

       const auto_renewal = $('#auto_renewal').is(':checked')?$('#auto_renewal').val():false

       const description = $('#description').val(); 

       const desc_in_invoice = $('#desc_in_invoice').is(':checked')?$('#desc_in_invoice').val():false
     
       const subs_currency = $('#subs_currency').val(); 
       const subs_term_cond = $('#subs_term_cond').val();  

       const payout_setup = $('input[name="payout_setup"]:checked').val(); 
       const time_cycle = $('#time_cycle').val();  
       const payout_day = $('#payout_day').val();  


        //Regular Expression For Email
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        const checkEmail = emailReg.test( admin_email );

        const company_logo = document.getElementById('company_logo').files[0];
        const own_document1 = document.getElementById('own_document1').files[0];
        const own_document2 = document.getElementById('own_document2').files[0];
        const own_document3 = document.getElementById('own_document3').files[0];
        const own_document4 = document.getElementById('own_document4').files[0];

        const bu_document1 = document.getElementById('bu_document1').files[0];
        const bu_document2 = document.getElementById('bu_document2').files[0];
        const bu_document3 = document.getElementById('bu_document3').files[0];
        const bu_document4 = document.getElementById('bu_document4').files[0];
        const bu_document5 = document.getElementById('bu_document5').files[0];

        const ot_document1 = document.getElementById('ot_document1').files[0];
        const ot_document2 = document.getElementById('ot_document2').files[0];
        const ot_document3 = document.getElementById('ot_document3').files[0];
        const ot_document4 = document.getElementById('ot_document4').files[0];


        //GETTING BANK NAME ARRAY VALUES
        var bank_name = [];
        if($("input[name='bank_name[]']") !== undefined){
                bank_name = $("input[name='d_bank_name[]']").map(function(){
                    return $(this).val();
                }).get();
        }

        //GETTING BIC ARRAY VALUES
        var bic = [];
        if($("input[name='bic[]']") !== undefined){
                bic = $("input[name='d_bic[]']").map(function(){
                    return $(this).val();
                }).get();
        }

        //GETTING ACCOUNT NAME ARRAY VALUES
        var account_name = [];
        if($("input[name='account_name[]']") !== undefined){
                account_name = $("input[name='d_account_name[]']").map(function(){
                    return $(this).val();
                }).get();
        }

        //GETTING IBAN NUMBER ARRAY VALUES
        var iban = [];
        if($("input[name='iban[]']") !== undefined){
                iban = $("input[name='d_iban[]']").map(function(){
                    return $(this).val();
                }).get();
        }

        //GETTING ACCOUNT NUMBER ARRAY VALUES
        var account_no = [];
        if($("input[name='account_no[]']") !== undefined){
                account_no = $("input[name='d_account_no[]']").map(function(){
                    return $(this).val();
                }).get();
        }

            //GETTING ACCOUNT NUMBER ARRAY VALUES
        var b_currency = [];
        if($("input[name='b_currency[]']") !== undefined){
        b_currency = $("input[name='d_currency[]']").map(function(){
                    return $(this).val();
                }).get();
        }

            //GETTING ACCOUNT NUMBER ARRAY VALUES
        var b_status = [];
        if($("input[name='b_status[]']") !== undefined){
                b_status = $("input[name='d_status[]']").map(function(){
                    return $(this).val();
                }).get();
        }

        var _token = $('#token').val();


        //Initializing Form Data Object
        const formData = new FormData; 
        formData.append('company_id', company_id);
        formData.append('company_name', company_name);
        formData.append('first_name', first_name);
        formData.append('last_name', last_name);
        formData.append('admin_email', admin_email);
        formData.append('admin_phone', admin_phone);
        formData.append('password', password);
        formData.append('website', website);
        formData.append('designation', designation);
        formData.append('gener_country', gener_country);
        formData.append('gener_city', gener_city);
        formData.append('gener_state', gener_state);
        formData.append('org_phone', org_phone);
        formData.append('own_document1', own_document1);
        formData.append('ow_document_type_1', ow_document_type_1);
        formData.append('own_document2', own_document2);
        formData.append('ow_document_type_2', ow_document_type_2);
        formData.append('own_document3', own_document3);
        formData.append('ow_document_type_3', ow_document_type_3);
        formData.append('own_document4', own_document4);
        formData.append('ow_document_type_4', ow_document_type_4);

        formData.append('bu_document1', bu_document1);
        formData.append('bu_document_type_1', bu_document_type_1);
        formData.append('bu_document2', bu_document2);
        formData.append('bu_document_type_2', bu_document_type_2);
        formData.append('bu_document3', bu_document3);
        formData.append('bu_document_type_3', bu_document_type_3);
        formData.append('bu_document4', bu_document4);
        formData.append('bu_document_type_4', bu_document_type_4);

        formData.append('tax_document_check_box', tax_document_check_box);

        formData.append('bu_document5', bu_document5);
        formData.append('bu_document_type_5', bu_document_type_5);

        formData.append('ot_document1', ot_document1);
        formData.append('ot_document_type_1', ot_document_type_1);
        formData.append('ot_document_type_2', ot_document_type_2);
        formData.append('ot_document2', ot_document2);
        formData.append('ot_document3', ot_document3);
        formData.append('ot_document_type_3', ot_document_type_3);
        formData.append('ot_document4', ot_document4);
        formData.append('ot_document_type_4', ot_document_type_4);

        formData.append('trn_number', trn_number);
        formData.append('office_address', office_address);
        formData.append('more_info_city', more_info_city);
        formData.append('more_inf_country', more_inf_country);
        formData.append('more_info_state', more_info_state);
        formData.append('more_info_zip', more_info_zip);
        formData.append('more_info_profile_image', more_info_profile_image);
        formData.append('profile_id', profile_id);
        formData.append('server_key', server_key);
        formData.append('company_prefix', company_prefix);
        formData.append('account_type', account_type);
        formData.append('more_info_currency', more_info_currency);
        formData.append('company_profile', company_profile);
        formData.append('package', package);
        formData.append('branded_pay_page', branded_pay_page);
        formData.append('branded_email', branded_email);
        formData.append('withdraw_limit', withdraw_limit);
        formData.append('available_limit', available_limit);
        formData.append('sender_id_by_name', sender_id_by_name);
        formData.append('api_key', api_key);
        formData.append('sms_limit', sms_limit);

        formData.append('billing_plan', billing_plan);
        formData.append('add_on_charge', add_on_charge);
        formData.append('deposit', deposit);
        formData.append('convenience_fees_type', convenience_fees_type);
        formData.append('convenience_amount', convenience_amount);
        formData.append('commision_fees_type', commision_fees_type);
        formData.append('commission_amount', commission_amount);
        formData.append('withdrawal_charge_add', withdrawal_charge_add);
        formData.append('withdrawal_charge_amt', withdrawal_charge_amt);
        formData.append('payment_gateway_charge', payment_gateway_charge);
        formData.append('payement_gateway_amount', payement_gateway_amount);
        formData.append('first_billing_date', first_billing_date);  
        formData.append('end_billing_date', end_billing_date);
        formData.append('auto_renewal', auto_renewal);
        formData.append('description', description);
        formData.append('desc_in_invoice', desc_in_invoice);

        formData.append('subs_currency', subs_currency);
        formData.append('subs_term_cond', subs_term_cond);
        formData.append('checkEmail', checkEmail);
        formData.append('company_logo', company_logo);

        formData.append('payout_setup', payout_setup);
        formData.append('time_cycle', time_cycle);
        formData.append('payout_day', payout_day);

        formData.append('bank_name', bank_name);
        formData.append('bic', bic);
        formData.append('account_name', account_name);
        formData.append('iban', iban);
        formData.append('account_no', account_no);
        formData.append('b_currency', b_currency);
        formData.append('b_status', b_status);
        formData.append('_token', _token);

        formData.append('menu', menu);
        formData.append('smenu', smenu);
        formData.append('sub_menu', sub_menu);



        //TODO: Seding Ajax Requrest for creating navbar menu
        $.ajax({
            url:"../edit-process",
            method:"POST",
            data:formData,
            contentType:false,
            processData:false,
            cache:false,
            beforeSend:function()
            {
                $('.loadering').show();
                $('#save').attr('disabled',true);
            },

            success:function(data)
            {
                $('.loadering').hide();
                $('#save').removeAttr('disabled');
                console.log(data.status);

                if (data.status === true) {
                    console.log('true');
                    toastr['success'](''+data.message+'', {
                        closeButton: true,
                        tapToDismiss: false,
                    });

                    window.location.href = "../company-list";
                }else if (data.status === false) {
                    console.log('false');
                    toastr['error'](''+data.message+'', {
                      closeButton: true,
                      tapToDismiss: false,
                    });
                }
            },
            error: function (data) {
                console.log(data);
                console.log('error');
                $('.loadering').hide();
                $('#save').removeAttr('disabled');
                
                toastr['error'](''+data.message+'', {
                  closeButton: true,
                  tapToDismiss: false,
                });
              }
 
        });


    }

   });


   $('#generate_company_prefix').click(function(){
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";

          //specify the length for the new string
    var lenString = 3;
    var randomstring = '';

    //loop to select a new character in each iteration
    for (var i=0; i<lenString; i++) {
      var rnum = Math.floor(Math.random() * characters.length);
      randomstring += characters.substring(rnum, rnum+1);
    }

    //display the generated string
    $('#company_prefix').val(randomstring.toUpperCase());
});


// Deleting the document row
$('#doc_body1').delegate('.doc_delete', 'click', function()
{
    console.log('yes');
    var obj = $(this);
    obj.parent().closest('tr').remove();

});

// Deleting the document row
$('#doc_body2').delegate('.doc_delete', 'click', function()
{
    console.log('yes');
    var obj = $(this);
    obj.parent().closest('tr').remove();

});

// Deleting the document row
$('#doc_body3').delegate('.doc_delete', 'click', function()
{
    console.log('yes');
    var obj = $(this);
    obj.parent().closest('tr').remove();

});

    // Deleting the bank row
    $('body').delegate('#delete', 'click', function()
    {
        console.log('delete');
        var obj = $(this);
        obj.parent().closest('tr').remove();

    });


    //Deleting the bank from ajax code
    $('body').delegate('#delete', 'click', function()
    {
            var obj = $(this);
            var id = $(this).closest('tr').find('input[name="e_id"]').val();

            $.ajax({
                url:"../delete-bank",
                method:"post",
                data:{id, "_token": $('#token').val()},
                success:function(res)
                {
                    console.log(res);
                }
            });

    });


    $('#first_billing_date').change(function(){
        
        var d = new Date($('#first_billing_date').val());
        var year = d.getFullYear();
        var month = d.getMonth();
        var day = d.getDate();
        var end_year_date = new Date(year + 1, month, day);

        var date=convertDate(end_year_date);

        $('#end_billing_date').val(date);

        function convertDate(date) {
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString();
            var dd  = date.getDate().toString();
          
            var mmChars = mm.split('');
            var ddChars = dd.split('');
          
            return (ddChars[1]?dd:"0"+ddChars[0]) + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + yyyy;
          }

   });

    $('#auto_renewal').change(function(){
        (this.checked 
            ? $('#end_billing_date').prop('readonly','') 
            : $('#end_billing_date').prop('readonly','readonly').val('')
        )
    });


    $('input[name="payment_gateway_charge[]"]').click(function(){
        var id = $(this).data('id');

        if($(this).is(':checked')){

          $('.pga'+id).removeAttr('readonly');
          $('.pga'+id).val('');

        }else{

          $('.pga'+id).attr('readonly', 'readonly');
          $('.pga'+id).val('');

        }


    });



    $('.tax_document_check_box').click(function(){

        var check = $(this).val();

        if(check == 0){
            $('#tax_cert_button').removeClass('d-none');
            $('#trn_number').prop('readonly', 'readonly');
            $('#trn_number').val('');

        }else{
            $('#tax_cert_button').addClass('d-none');
            $('#trn_number').prop('readonly', '');
            $('#trn_number').val('');

        }
    });

    // $('.payout_setup').change(function(){

    //     var payout_setup = $(this).val();

    //     if(payout_setup == 0){

    //         $('.payout_setup_auto').addClass('d-none');

    //     }else{

    //         $('.payout_setup_auto').removeClass('d-none');

    //     }

    // });

    
    $(".doc_image").each(function() {

        var src = $(this).attr('src');
        var ext = src.split('.').pop();
        console.log(ext);
        if(ext == 'pdf'){
            $(this).attr('src', '/public/company/docs/pdf_image.png');
        }
        else if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'svg'){
    
        }

        else if(ext == 'zip'){
            $(this).attr('src', '/public/company/docs/zip.png');
        }

        else if(ext == 'doc' || ext == 'docx' || ext == 'docx'){
            $(this).attr('src', '/public/company/docs/docs.png');
        }

        else if(ext == 'txt'){
            $(this).attr('src', '/public/company/docs/file.png');
        }else{
            $(this).attr('src', '/public/company/docs/file.png');
        }
    });


    $('#billing_plan').change(function(){
        $plan_id = $(this).val();

        $('#add_on_charge').val("");
        $('#deposit').val("");

        $('#convenience_amount').val("");
        $('#commission_amount').val("");
        $('#withdrawal_charge_amt').val("");

        $('.payment_gateway_charge').each(function(){
            $(this).prop('checked',false);
        });

        $('input[name="payement_gateway_amount[]"]').each(function(){
            $(this).val("");
            $(this).attr('readonly', 'readonly');
        });


        //Seding Ajax Requrest for getting subscription plan details
        $.ajax({
            url:"../subscription_plan_details/"+$plan_id,
            method:"GET",
            contentType:false,
            processData:false,
            cache:false,
            success:function(data)
            {
                const myObj = JSON.parse(data);

                $('#add_on_charge').val(myObj.add_on_charge);
                $('#deposit').val(myObj.deposit);

                // For Convenience Fees Type
                $('#convenience_fees_type'+myObj.convenience_fees_type).prop('checked',true);
                if(myObj.convenience_fees_type == 3){
                    $('#convenience_amount').val('');
                    $('#convenience_amount').prop('readonly','readonly');
                }else{
                    $('#convenience_amount').val(myObj.convenience_fees_amount);
                    $('#convenience_amount').removeAttr('readonly');
                }

                // For Commission Fees Type
                $('#commision_fees_type'+myObj.commission_fees_type).prop('checked',true);
                if(myObj.commission_fees_type == 3){
                    $('#commission_amount').val('');
                    $('#commission_amount').prop('readonly','readonly');
                }else{
                    $('#commission_amount').val(myObj.commission_fees_amount); 
                    $('#commission_amount').removeAttr('readonly'); 
                }


                // For Withdrawal Charges Add
                $('#withdrawal_charge_add'+myObj.withdrawal_charges_add).prop('checked',true);
                if(myObj.withdrawal_charges_add == 3){
                    $('#withdrawal_charge_amt').val('');
                    $('#withdrawal_charge_amt').prop('readonly','readonly');
                }else{
                    $('#withdrawal_charge_amt').val(myObj.withdrawal_charges_amuont); 
                    $('#withdrawal_charge_amt').removeAttr('readonly');
                }
                
                            
                


                var pgc = myObj.payment_gateway_charge;

                var explode = pgc.split(',');

                $.each(explode, function(propName, propVal) {

                    $('#payment_gateway_charge'+propVal).prop('checked',true);
                    $('.pga'+propVal).removeAttr('readonly');

                });


            }

        });

    });



     // For last tab click code start

     $('.first_tab').click(function(){
        
        $('#pills-General-tab').addClass('active');
        $('#pills-KYC-tab').removeClass('active');
        $('#pills-More_Information-tab').removeClass('active');
        $('#pills-Permission-tab').removeClass('active');  
        $('#pills-Subscription-tab').removeClass('active');

    });


    $('.second_tab').click(function(){
        
        $('#pills-General-tab').removeClass('active');
        $('#pills-KYC-tab').addClass('active');
        $('#pills-More_Information-tab').removeClass('active');
        $('#pills-Permission-tab').removeClass('active');  
        $('#pills-Subscription-tab').removeClass('active');

    });


    $('.third_tab').click(function(){
        
        $('#pills-General-tab').removeClass('active');
        $('#pills-KYC-tab').removeClass('active');
        $('#pills-More_Information-tab').addClass('active');
        $('#pills-Permission-tab').removeClass('active');  
        $('#pills-Subscription-tab').removeClass('active');

    });


    $('.fourth_tab').click(function(){
        
        $('#pills-General-tab').removeClass('active');
        $('#pills-KYC-tab').removeClass('active');
        $('#pills-More_Information-tab').removeClass('active');
        $('#pills-Permission-tab').addClass('active');  
        $('#pills-Subscription-tab').removeClass('active');

    });


    $('.five_tab').click(function(){
        
        $('#pills-General-tab').removeClass('active');
        $('#pills-KYC-tab').removeClass('active');
        $('#pills-More_Information-tab').removeClass('active');
        $('#pills-Permission-tab').removeClass('active');  
        $('#pills-Subscription-tab').addClass('active');

    });

// for top tab clicking start here

    $('.first_top_tab').click(function(){
        
        $('.first_tab').addClass('active');
        $('.second_tab').removeClass('active');
        $('.third_tab').removeClass('active');
        $('.fourth_tab').removeClass('active');  
        $('.five_tab').removeClass('active');

    });


    $('.second_top_tab').click(function(){
        
        $('.first_tab').removeClass('active');
        $('.second_tab').addClass('active');
        $('.third_tab').removeClass('active');
        $('.fourth_tab').removeClass('active');  
        $('.five_tab').removeClass('active');
    });


    $('.third_top_tab').click(function(){
        
        $('.first_tab').removeClass('active');
        $('.second_tab').removeClass('active');
        $('.third_tab').addClass('active');
        $('.fourth_tab').removeClass('active');  
        $('.five_tab').removeClass('active');

    });


    $('.fourth_top_tab').click(function(){
        
        $('.first_tab').removeClass('active');
        $('.second_tab').removeClass('active');
        $('.third_tab').removeClass('active');
        $('.fourth_tab').addClass('active'); 
        $('.five_tab').removeClass('active');

    });


    $('.five_top_tab').click(function(){
        
        $('.first_tab').removeClass('active'); 
        $('.second_tab').removeClass('active');
        $('.third_tab').removeClass('active');
        $('.fourth_tab').removeClass('active');  
        $('.five_tab').addClass('active');
    });

    
    $('input[name="convenience_fees_type"]').click(function(){
        var val = $(this).val();

        if(val == 3){

            $('#convenience_amount').attr('readonly', 'readonly');
            $('#convenience_amount').val('');

        }else{
            $('#convenience_amount').removeAttr('readonly');

        }


    });


    $('input[name="commision_fees_type"]').click(function(){
        var val = $(this).val();

        if(val == 3){

            $('#commission_amount').attr('readonly', 'readonly');
            $('#commission_amount').val('');

        }else{
            $('#commission_amount').removeAttr('readonly');

        }


    });


    $('input[name="withdrawal_charge_add"]').click(function(){
        var val = $(this).val();

        if(val == 3){

            $('#withdrawal_charge_amt').attr('readonly', 'readonly');
            $('#withdrawal_charge_amt').val('');

        }else{
            $('#withdrawal_charge_amt').removeAttr('readonly');

        }


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




