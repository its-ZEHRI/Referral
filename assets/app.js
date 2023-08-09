$(document).ready(function () {

    $(this).on('click', '#close_error', function () {
        $('#error').removeClass('show')
    })

    $(this).on('click', '#validate', function (event) {
        $('#loader_wrapper').removeClass('d-none')
        event.preventDefault()

        if ($('#number').val() == '') {
            $('#loader_wrapper').addClass('d-none')
            // Swal.fire(
            //     'Validation Error',
            //     'Enter Phone number!',
            //     'error'
            // )
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Enter Phone number!',
                backdrop: '#eee'
            })
            return;
        }
        // $('.otp-pop-up').removeClass('d-none');
        // $('#otp-1').focus()

        var formdata = {
            'company_id': $('#company_id').val(),
            'country_id': $('#country_id').val(),
            'mobile': $('#number').val(),
            'op': 'validate_mobile'
        }
        console.log(formdata)
        $.ajax({
            type: 'POST',
            url: `processor/ajaxprocessor.php`,
            data: formdata,
            success: function (response) {
                const resp = JSON.parse(response);
                // JSON.stringify(objToArray(json_data))
                console.log(resp.status)
                console.log(resp)
                if (resp.code == 200 && resp.status == 'success') {
                    $('#user_registration_identifier').val(resp.data.user.user_registration_identifier)
                    $('.otp-pop-up').removeClass('d-none');
                    $('#loader_wrapper').addClass('d-none')
                    $('#otp-1').focus()

                }
                else {
                    $('#loader_wrapper').addClass('d-none')
                    // Swal.fire(
                    //     'Validation Error!',
                    //     resp.message,
                    //     'error'
                    // )
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: resp.message,
                        backdrop: '#eee'
                    })
                    
                }
            },
            error: function (response) {
                $('#loader_wrapper').addClass('d-none')
                console.log(response)
                alert(response)
            },
        })
    })

    $(this).on('input', '#otp-1', function (event) {
        $('#otp-2').focus()
    })
    $(this).on('input', '#otp-2', function (event) {
        $('#otp-3').focus()
    })
    $(this).on('input', '#otp-3', function (event) {
        $('#otp-4').focus()
    })

    $(this).on('input', '#otp-4', function (event) {
        event.preventDefault()
        var formdata = {
            'otp': $('#otp-1').val() + $('#otp-2').val() + $('#otp-3').val() + $('#otp-4').val(),
            'user_registration_identifier': $('#user_registration_identifier').val(),
            'company_id': $('#company_id').val(),
            'op': 'verify_otp'
        }
        // console.log(formdata);
        $('#loader_wrapper').removeClass('d-none')

        $.ajax({
            type: 'POST',
            url: `processor/ajaxprocessor.php`,
            data: formdata,
            success: function (response) {
                console.log(response)
                const resp = JSON.parse(response);
                // JSON.stringify(objToArray(json_data))
                console.log(resp);
                console.log(resp)
                console.log(resp.status)

                if (resp.code == 200 && resp.status == 'success') {
                    // Swal.fire(
                    //     'Completed',
                    //     'Mobile Number Verification Complete!',
                    //     'success'
                    // )
                    Swal.fire({
                        icon: 'success',
                        title: 'Completed',
                        text: 'Mobile Number Verification Complete!',
                        backdrop: '#eee'
                    })

                    $('#validate').addClass('d-none')
                    $('#verified_text').removeClass('d-none')
                }
                else {
                    // Swal.fire(
                    //     'Error',
                    //     resp.message,
                    //     'success'
                    // )
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: resp.message,
                        backdrop: '#eee'
                    })
                }
                $('#loader_wrapper').addClass('d-none')
                $('.otp-pop-up').addClass('d-none');
                $('#opt-1').val('')
                $('#opt-2').val('')
                $('#opt-3').val('')
                $('#opt-4').val('')
            },
            error: function (response) {
                // $('.otp-pop-up').removeClass('d-none');
                // alert(response)
                console.log(response);
            },
        })
    })


    // form submit
    $(this).on('click', '#submit_form', function (event) {
        event.preventDefault()

        $('#loader_wrapper').removeClass('d-none')

        if ($('#password').val() == '') {
            // Swal.fire(
            //     'Validation Error',
            //     'Password Field is required!',
            //     'error'
            // )
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Password Field is required!',
                backdrop: '#eee'
            })
            $('#loader_wrapper').addClass('d-none')
            return;
        }
        if ($('#email').val() == '') {
            // Swal.fire(
            //     'Validation Error',
            //     'Password Field is required!',
            //     'error'
            // )
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Email Field is required!',
                backdrop: '#eee'
            })
            $('#loader_wrapper').addClass('d-none')
            return;
        }

        if ($('#password').val() != $('#c_password').val()) {
            // Swal.fire(
            //     'Validation Error',
            //     'Password confirmation does not match!',
            //     'error'
            // )
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Password confirmation does not match!',
                backdrop: '#eee'
            })
            $('#loader_wrapper').addClass('d-none')
            return;
        }

        const radioButtons = document.getElementsByName('gender');
        console.log(radioButtons);
        let selectedValue;
        for (let i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                selectedValue = radioButtons[i].value;
                break;
            }
        }
        if (selectedValue == null) {
            // Swal.fire(
            //     'Validation Error',
            //     'Select your gender !',
            //     'error'
            // )
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Select your gender !',
                backdrop: '#eee'
            })
            $('#loader_wrapper').addClass('d-none')
            return;
        }


        var formdata = {
            'company_id': $('#company_id').val(),
            'user_registration_identifier': $('#user_registration_identifier').val(),
            'password': $('#password').val(),
            'email': $('#email').val(),
            'c_password': $('#c_password').val(),
            'gender': selectedValue,
            'birthdate': $('#birthdate').val(),
            'op': 'form_submit'
        }

        $.ajax({
            type: 'POST',
            url: `processor/ajaxprocessor.php`,
            data: formdata,
            success: function (response) {
                const resp = JSON.parse(response);
                $('#loader_wrapper').addClass('d-none')
                if (resp.code == 200 && resp.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Your Account has been registered Thanks!',
                        backdrop: '#eee',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        window.location.href = "/Referral/refpoints.php";
                        location.reload();
                    })
                }
                else {
                    // Swal.fire(
                    //     'Error',
                    //     resp.message,
                    //     'error'
                    // )
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text:  resp.message,
                        backdrop: '#eee'
                    })

                }
            },
            error: function (response) {
                $('#loader_wrapper').addClass('d-none')
                console.log(response)
                alert(response)
            },
        })
    })


    // send invitation form
    $(this).on('click', '#send_invitation_btn', function (event) {
        // event.preventDefault()
        var formdata = {
            'sender_number': $('#sender_number').val(),
            'receiver_number': $('#receiver_number').val(),
            'done': 0,
            'op': 'send_invitation'
        }

        $.ajax({
            type: 'POST',
            url: `../processor/ajaxprocessor.php`,
            data: formdata,
            success: function (response) {
                const resp = JSON.parse(response);
                console.log(resp);
                if (resp.code == 200 && resp.status == 'success') {
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: resp.message,
                        backdrop: '#eee'
                    })
                }
                $('#sender_number').val('')
                $('#receiver_number').val('')
            },
            error: function (response) {
                console.log(response);
            },
        })
    })


})
