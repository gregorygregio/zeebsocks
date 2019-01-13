(function($){

  function removeAcento(text) {
      text = text.toLowerCase();
      text = text.replace(new RegExp('[ÁÀÂÃ]','gi'), 'a');
      text = text.replace(new RegExp('[ÉÈÊ]','gi'), 'e');
      text = text.replace(new RegExp('[ÍÌÎ]','gi'), 'i');
      text = text.replace(new RegExp('[ÓÒÔÕ]','gi'), 'o');
      text = text.replace(new RegExp('[ÚÙÛ]','gi'), 'u');
      text = text.replace(new RegExp('[Ç]','gi'), 'c');
      return text;
    }


    $(document).ready(function(){
        var inputName = $("#inputName");
        var inputURL = $("#inputURL");
        var inputPrice = $("#inputPrice");

        inputName.blur(function () {
            if(inputURL.val() !== "")
              return;

            var nomeDoProduto = this.value;
            inputURL.val(removeAcento(nomeDoProduto.trim()).toUpperCase().replace(/ /g, "-"));
        });




        var preco = [0,0,0];
        var numberRegExp = new RegExp(/[0-9]/);
        var isNumber = function(teste){
            return numberRegExp.test(teste);
        }

        inputPrice.keyup(function(e){

            var key = e.key;
            if (isNumber(key))
              preco.push(parseInt(key));
            if (e.keyCode === 8 & preco.length > 3)
              preco.pop();

            var cents = preco.slice(-2, preco.length);
            var inteiros = preco.slice(0, -2);

            if(parseInt(inteiros.join("")) === 0)
              inteiros = [0];
            else
              while( (inteiros[0] === 0) ) inteiros.shift();

            this.value = inteiros.join("") + "." + cents.join("");
        })

        var btnAlterarImagem = $("#btnAlterarImagem");

        if(btnAlterarImagem) {
          var mainImageInput = $("#mainImage");
          var imageUpdated = $("#imageUpdated");

          btnAlterarImagem.click(function(e) {
              e.preventDefault();
              mainImageInput.show();
              btnAlterarImagem.hide();

              mainImageInput.change(function() {
                  imageUpdated.val("1");
              });
          });
        }

    });
})(jQuery)
