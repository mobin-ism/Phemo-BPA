var SnippetLogin = function() {
    $("#m_login");
    var t = function() {
        $("#m_login_signin_submit").click(function(t) {
            t.preventDefault();
            var e = $(this),
                a = $(".m-login__form");
            a.validate({
                rules: {
                    email: {
                        required: !0,
                        email: !0
                    },
                    password: {
                        required: !0
                    }
                }
            }), a.valid() && (e.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function () {
                a.submit();
            }), 2000);
        })
    };
    return {
        init: function() {
            t()
        }
    }
}();
jQuery(document).ready(function() {
    SnippetLogin.init()
});