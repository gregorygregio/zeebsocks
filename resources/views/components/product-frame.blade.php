<a href="{{ url("/product/" . $product->url_id) }}">
  <div class="product-frame product-exibition">
      <div class="product-name">
        {{$product->name}}
      </div>
      <div class="product-price">
        {{$product->price}}
      </div>
      <img src="{{ $product->getProductImagesPath() }}" />
  </div>
</a>
