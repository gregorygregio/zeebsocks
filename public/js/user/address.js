

(function ($) {
    $(document).ready(function () {
        var inputCEP = $('input[name=zipcode]');
        var inputAddress = $('input[name=address]');
        var inputBairro = $('input[name=bairro]');
        var inputCity = $('input[name=city]');
        var inputState = $('input[name=state]');
        var inputCountry = $('input[name=country]');

        var inputNumero = $('input[name=number]');
        var inputComplemento = $('input[name=complement]');

        var cepPreenchido = inputCEP.val() !== "";
        var numeroPreenchido = inputNumero.val() !== "";


        var checkEnableBtnSalvar = function(){
            if(numeroPreenchido && cepPreenchido)
                $("#btnSalvar").removeAttr('disabled');
            else
                $("#btnSalvar").attr('disabled', 'disabled');
        }


        inputCEP.removeAttr("readonly").blur(function () {

            cepPreenchido = false;
            checkEnableBtnSalvar();

            consultaFrete.getLocationByZipCode(this.value, function (response) {
                    if(response.error){
                        $("#formAlert").text(response.error).show();
                        setTimeout(function () {
                            $("#formAlert").slideUp(300)
                        }, 3000);
                        return;
                    }

                    inputAddress.val(response.logradouro.trim());
                    inputBairro.val(response.bairro.trim());
                    inputCity.val(response.cidade.trim());
                    inputState.val(response.uf.trim());
                    inputCountry.val("BRA");
                    cepPreenchido = true;
                    checkEnableBtnSalvar();
            });
        }).focus();


        inputCEP.keyup(function () {
            this.value = VMasker.toPattern(this.value, "99999-999");
        });


        inputNumero.removeAttr("readonly").blur(function () {
            numeroPreenchido = false;
            if(this.value !== "")
                numeroPreenchido = true;

            checkEnableBtnSalvar();
        });


        inputComplemento.removeAttr("readonly");
    });
    
})(jQuery)