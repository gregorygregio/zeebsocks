(function ($) {
    $(document).ready(function() {
        //phoneInput
        var birthInput = $("#birthInput");

        var setMask = function (inputId, mask) {
            $("#" + inputId).keyup(function () {
                this.value = VMasker.toPattern(this.value, mask);
            });
        }

        setMask("birthInput", "99/99/9999");

        $("#phoneInput").keyup(function () {
            var value = this.value;
            var mask = "(99) 9999-9999";
            if(value.length >= 15)
                mask = "(99) 99999-9999"
            this.value = VMasker.toPattern(value, mask);
        });

        $("#profileForm").submit(function () {
            var date = birthInput.val().split("/");
            birthInput.attr("readonly", "readonly");
            birthInput.val( date[2] + "-" + date[1] + "-" + date[0] );
        });
    });
})(jQuery);