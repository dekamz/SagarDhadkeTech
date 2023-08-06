function openFbPopup(url, width, height, callBack) {
    var top = top || screen.height / 2 - height / 2,
        left = left || screen.width / 2 - width / 2,
        win = window.open(
            url,
            "",
            "location=1,status=1,resizable=yes,width=" +
            width +
            ",height=" +
            height +
            ",top=" +
            top +
            ",left=" +
            left
        );

    function check() {
        if (!win || win.closed != false) {
            callBack();
        } else {
            setTimeout(check, 100);
        }
    }

    setTimeout(check, 100);
}

function connectPinterest(obj) {

    var url = "https://appfb.premiumaddons.com/auth/pinterest";

    openFbPopup(
        url, 670, 520,
        function () {
            jQuery.ajax({
                type: "GET",
                url: socialSettings.ajaxurl,
                dataType: "JSON",
                data: {
                    action: "get_pinterest_token",
                    security: socialSettings.nonce
                },
                success: function (res) {

                    if (res.success) {

                        var accessToken = res.data;

                        pinterestToken = accessToken;

                        jQuery(obj)
                            .parents(".elementor-control-pinterest_login")
                            .nextAll(".elementor-control-access_token")
                            .find("textarea")
                            .val(accessToken)
                            .trigger("input");

                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    );

    return false;
}

function connectPinterestInit(obj) {

    if (!obj) return;

    connectPinterest(obj);
}
