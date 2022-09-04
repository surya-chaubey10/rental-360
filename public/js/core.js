$(document).on("submit", ".myForm", function (e) {
    e.preventDefault();

    const form = $(this);
    var form_data = new FormData();
    var toast = toastr;
    const id_form = $(this).attr("id");
    var url = $(this).attr("action");
    if (!url) {
        var url = URL + PATH;
    }

    var fields = $(this).serializeArray();

    $("form#" + id_form + " input:file").each(function () {
        if ($(this).attr("multiple")) {
            files = new Array();
            fs = $(this).prop("files");
            for ($x = 0; $x <= fs.length; $x++) {
                form_data.append($(this).attr("name"), fs[$x]);
            }
        } else {
            files = $(this).prop("files")[0];
            form_data.append($(this).attr("name"), files);
        }
    });

    $(fields).each(function (index, data) {
        form_data.append(data.name, data.value);
    });

    // NProgress.start();
    form.find('button[type="submit"]').addClass("loadingi");

    axios
        .post(url, form_data)
        .then((res) => {
            if (res.data.status == "success") {
                toastr.success(res.data.message);
            }

            if (res.data.status == "successRedirect") {
                toastr.success(res.data.message);
                setTimeout(function () {
                    window.location = res.data.redirect;
                }, 1000);
            }

            if (res.data.status == "error") {
                toastr.error(res.data.message);
            }

            if (res.data.status == "errorRedirect") {
                toastr.success(res.data.message);
                setTimeout(function () {
                    window.location = res.data.redirect;
                }, 2000);
            }

            if (res.data.status == "redirect") {
                window.location = res.data.message;
            }
            form.find('button[type="submit"]').removeClass("loadingi");
            // NProgress.done();
        })
        .catch(function (e) {
            if (e.response != "undefined") {
                if (e.response.status == 500) {
                    if (e.response.data.message) {
                        toast.error(e.response.data.message);
                    } else {
                        toast.error(e.response.statusText);
                    }
                }

                if (e.response.status == 422) {
                    if (e.response.data.errors.password.length) {
                        for (
                            let i = 0;
                            i < e.response.data.errors.password.length;
                            i++
                        ) {
                            toast.error(e.response.data.errors.password[i]);
                        }
                    }

                    if (e.response.data.errors.email.length) {
                        toast.error(
                            e.response.data.errors.email[0] +
                                " or your profile is disapproved."
                        );
                    } else {
                        toast.error(e.response.data.message);
                    }
                }
            }

            form.find('button[type="submit"]').removeClass("loadingi");
            // NProgress.done();
        });
    form.find('button[type="submit"]').removeClass("loadingi");
});

function formValidate(form) {
    rf = form.find("#required").val();

    if (!rf) {
        return true;
    }
    rf = rf.replace("[]", "");
    rf = rf.split(",");
    errors = false;
    fields = new Array();
    $.each(rf, function (i) {
        input = "#" + rf[i];
        input_bar = form.find(input);

        if (!input_bar) {
            return;
        }
        myVal = input_bar.val();
        if (!myVal) {
            label = $(input_bar).parent().find("label");
            $(input_bar).parent().addClass("invalid");
            $(input_bar).parent().find(".invalid_text").remove();
            if (label.text() != "") {
                $(input_bar)
                    .parent()
                    .append(
                        '<p class="invalid_text">' +
                            label.text() +
                            " is required" +
                            "</p>"
                    );
            } else {
                label = $(input_bar).parent().parent().find("label");
                if (label.text() != "") {
                }
            }
            errors = true;
        } else {
            $(input_bar).parent().removeClass("invalid");
            $(input_bar).parent().find(".invalid_text").remove();
        }
    });

    if (errors) {
        return false;
    }

    return true;
}
