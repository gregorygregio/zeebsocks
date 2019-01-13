var consultaFrete = (function($){

    return {
      'getLocationByZipCode': function(zipcode, cb){
            var currentOrigin = location.origin
            var pathToApi = "/user/address/" + zipcode;
            $.get(currentOrigin + pathToApi, cb);
      }
    };
})(jQuery)