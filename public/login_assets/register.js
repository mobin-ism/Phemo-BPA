var SnippetRegister = function() {
    $("#m_login");
    var t = function() {
        $("#m_login_signin_submit").click(function(t) {
            t.preventDefault();
            var e = $(this),
                a = $("#register-form");
            a.validate({
                rules: {
                    name: {
                        required: !0
                    },
                    email: {
                        required: !0,
                        email: !0
                    },
                    password: {
                        required: !0
                    },
                    confirm_password: {
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
    SnippetRegister.init()
});