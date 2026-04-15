import { Notify } from './../../../../style/layout/notify.ts';

$(document).ready(function (){
    /**
     *  Change light status
     */
    let setStatusUrl = '/api/hotel/rooms/lights/set-status';

    $(".light").click(function (){
        let light = $(this);

        let id = $(this).data('id');
        let address = $(this).data('address');
        let status = $(this).data('status');

        $.ajax({
            url: setStatusUrl,
            method: "POST",
            dataType: "json",
            data: {
                id: id,
                address: address,
                status: status
            },
            success: function success(response) {
                let code = response['code'];

                if(code === '0000'){
                    let newStatus = response.data.status;

                    if (newStatus === 1) {
                        light.addClass("active");
                    } else {
                        light.removeClass("active");
                    }

                    // Optional: update data-status
                    light.data('status', newStatus);
                }else{
                    Notify.Me([response['message'], "warn"]);
                }
                console.log(response, typeof response['link']);
            },
            error: function (event){
                $(".loading").fadeOut();
            }
        });
    })
});
