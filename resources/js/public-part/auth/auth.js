import { Notify } from './../../style/layout/notify.ts';
import { Validator } from "../../style/layout/validator.ts";

$( document ).ready(function() {
    let debug = true;

    // Global urls
    let authUri = '/auth/authenticate';

    /* Save account - Register form */
    let saveAccountUrl  = '/auth/save-account';
    /* Restart password token */
    let generateTokenUri = '/auth/generate-restart-token';
    /* Generate new password */
    let generatePasswordUri = '/auth/generate-new-password';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let signMeIn = function(){
        let email    = $("#email").val();
        let password = $("#password").val();

        let emailWrapper = $(".auth-email-wrapper");
        let passwordWrapper = $(".auth-password-wrapper");

        // Remove previous warnings
        emailWrapper.find("span").remove();
        passwordWrapper.find("span").remove();

        if(!Validator.email(email)){
            emailWrapper.append(function (){ return $("<span>").text("Uneseni email nije validan"); });
            return;
        }

        $.ajax({
            url: authUri,
            method: 'POST',
            dataType: "json",
            data: {
                email: email,
                password: password
            },
            success: function success(response) {
                let code = response['code'];

                if(code === '0000'){
                    Notify.Me([response['message'], "success"]);

                    setTimeout(function () {
                        window.location.href = response['url'];
                    }, 3000); // 3 seconds
                }else{
                    // Email warnings
                    if(code === '1101' || code === '1103'){
                        emailWrapper.append(function (){ return $("<span>").text(response['message']); });
                    }
                    // Password warnings
                    if(code === '1102' || code === '1104'){
                        passwordWrapper.find('.forgot-password').before($("<span>").text(response['message']));
                    }

                    if(code === '1105'){
                        window.location.href = response['url'];
                    }
                }
            },
            error: function (xhr) {
                Notify.Me(["Greška prilikom obrade podataka", "danger"]);
                /* Hide back */
                // loader.addClass('d-none');
            }
        });
    };

    // Sign me in button; Trigger on enter
    $(".auth-btn").click(function () { signMeIn(); });

    $(document).on('keypress',function(e) {
        if(e.which === 13) {
            if($(".auth-btn").length) signMeIn();
        }
    });

    /** ------------------------------------------------------------------------------------------------------------- */
    /**
     *  Verify 2FA
     */

    const twoFAInputs = $('.otp-input');

    let checkAndSubmit = function () {
        let code = '';
        twoFAInputs.each(function () {
            code += $(this).val();
        });
        if (code.length === 6) sendCode(code);
    }

    twoFAInputs.on('input', function () {
        this.value = this.value.replace(/\D/g, '');
        const index = twoFAInputs.index(this);
        if (this.value && index < twoFAInputs.length - 1) {
            twoFAInputs.eq(index + 1).focus();
        }
        checkAndSubmit();
    });
    twoFAInputs.on('keydown', function (e) {
        const index = twoFAInputs.index(this);
        if (e.key === 'Backspace' && !this.value && index > 0) {
            twoFAInputs.eq(index - 1).focus();
        }
    });

    $(".two-fa-btn").click(function () {
        checkAndSubmit();
    });

    let sendCode = function (code) {
        $.ajax({
            url: "/auth/verify-two-fa",
            method: 'POST',
            dataType: "json",
            data: {
                code: code
            },
            success: function (res) {
                if(res['code'] === '0000'){
                    Notify.Me([res['message'], "success"]);

                    setTimeout(function () {
                        window.location.href = res['url'];
                    }, 3000); // 3 seconds
                }else{
                    Notify.Me([res['message'], "warn"]);
                }
            },
            error: function () {
                Notify.Me(["Greška prilikom obrade podataka", "warn"]);
            }
        });
    }

    /** ------------------------------------------------------------------------------------------------------------- */
    /**
     *  Create new profile
     */
    $(".create-account-btn").click(function (){
        $.ajax({
            url: saveAccountUrl,
            method: 'POST',
            dataType: "json",
            data: { name: $(".register-name").val(), email: $(".register-email").val(), password: $(".register-password").val() },
            success: function success(response) {
                if(response['code'] === '0000'){
                    Notify.Me([response['message'], "success"]);

                    setTimeout(function () {
                        window.location.href = response['data']['url'];
                    }, 3000); // 3 seconds
                }else{
                    Notify.Me([response['message'], "warn"]);
                }
            }
        });
    });

    /* -------------------------------------------------------------------------------------------------------------- */
    /*
     *  Restart password functions
     */

    let generateToken = function(){
        let email  = $("#recovery-account-email");
        let loader = $(".loading-gif");

        if(!Validator.email(email.val())){
            Notify.Me(["Uneseni email nije validan!", "warn"]);
            return;
        }

        /* Show loading gif */
        loader.removeClass('d-none');

        $.ajax({
            url: generateTokenUri,
            method: 'POST',
            dataType: "json",
            data: {
                email: email.val()
            },
            success: function success(response) {
                let code = response['code'];

                /* Hide back */
                loader.addClass('d-none');

                if(code === '0000'){
                    Notify.Me([response['message'], "success"]);
                    email.val("");

                    setTimeout(function (){
                        if(typeof response['data']['url'] !== 'undefined') window.location = response['data']['url'];
                    }, 2000);
                }else{
                    Notify.Me([response['message'], "warn"]);
                }
            }
        });
    };
    $(".recovery-account-btn").click(function (){
        generateToken();
    });

    /**
     *  Generate new password
     */
    let generateNewPassword = function(){
        let loader = $(".loading-gif");

        let email  = $("#email");
        let password = $("#password");

        if(!Validator.email(email.val())){
            Notify.Me(["Uneseni email nije validan!", "warn"]);
            return;
        }

        /* Show loading gif */
        // loader.removeClass('d-none');

        $.ajax({
            url: generatePasswordUri,
            method: 'POST',
            dataType: "json",
            data: {
                email: email.val(),
                password: password.val(),
                token: $("#token").val()
            },
            success: function success(response) {
                let code = response['code'];

                /* Hide back */
                // loader.addClass('d-none');

                if(code === '0000'){
                    window.location = response['url'];
                }else{
                    /* If there is try to hack, redirect */
                    // if(code === '11416'){
                    //     window.location = response['data']['url'];
                    // }else Notify.Me([response['message'], "warn"]);

                    Notify.Me([response['message'], "warn"]);
                }
            }
        });
    };
    $(".new-password-btn").click(function (){
        generateNewPassword();
    });
});
