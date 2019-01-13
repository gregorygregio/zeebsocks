(function ($) {
    $(document).ready(function () {
        $("#cpf").keyup(function () {
            this.value = VMasker.toPattern(this.value, "999.999.999-99");
        });
    });
})(jQuery);

