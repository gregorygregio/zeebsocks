(function($){
    $(document).ready(function(){

        var tableRows;
        var getTableRows = function(){
          if(tableRows == null)
           tableRows = $("#tabelaProdutos tbody tr");

           return tableRows;
        }


        $("#tableSearch").keyup(function(){
            //  class="product-id"
            var search = this.value.toUpperCase();
            var rows = getTableRows();
            rows.hide();
            rows.filter(function(index, line) {

              return $(line).find(".product-name").text().trim().toUpperCase().indexOf(search) > -1 || $(line).find(".product-id").text().trim().indexOf(search) > -1;
            }).show();
        });


    });
})(jQuery)
