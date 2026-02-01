import { Notify } from './../../../style/layout/notify.ts';

$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let updatePrivacySettingsUri = '/system/users/my-profile/two-fa/deactivate';

    $(".ps-toggle").click(function (){
        $(this).toggleClass('active');
        let state = 'off';

        if ($(this).hasClass('active')) {
            // If user activates switch, redirect to QR generated code
            window.location.href = '/system/users/my-profile/two-fa/setup';
        }else{
            $.ajax({
                url: updatePrivacySettingsUri,
                method: 'POST',
                dataType: "json",
                data: {
                    state: state
                },
                success: function success(response) {
                    Notify.Me([response['message'], "success"]);
                }
            });
        }
    })
});
