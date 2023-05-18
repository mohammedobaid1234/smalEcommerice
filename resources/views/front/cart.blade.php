@extends('layouts.store_front')
@section('contnet')
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">

            <div class="wrap-iten-in-cart">
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                    @foreach ($orderDetails as $item)
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src={{$item->product->image_url}} alt=""></figure>
                            </div>
                            <div class="product-name">
                                <a class="link-to-product" href="#">{{$item->product->name}}</a>
                            </div>
                            <div class="price-field produtc-price"><p class="price">${{$item->product->price}}</p></div>
                            <div class="quantity">
                                <div class="quantity-input">
                                    <input type="text" name="product-quatity" value={{$item->quantity}} data-max="120" pattern="[0-9]*" >
                                    <a class="btn actions btn-increase" data-flag="1" data-id={{$item->product->id}} href="#"></a>
                                    <a class="btn actions btn-reduce" data-flag="2" data-id={{$item->product->id}} href="#"></a>
                                </div>
                            </div>
                            <div class="price-field sub-total"><p class="price">${{$item->total}}</p></div>
                            <div class="delete">
                                <a href="#" data-flag="3" data-id={{$item->product->id}} class="btn actions btn-delete" title="">
                                    <span>Delete from your cart</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">اجمالي السعر</span><b class="index">${{$total}}</b></p>
                    <p class="summary-info total-info "><span class="title"></span><b class="index"></b></p>
                </div>
                <div class="checkout-info">
                    <label class="checkbox-field">

                    </label>
                    <a class="btn btn-checkout" href="checkout.html">Check out</a>

                </div>

            </div>


        </div><!--end main content area-->
    </div><!--end container-->

</main>
@endsection
@section('js')

<script>
   setTimeout(() => {
    $(".btn-checkout").on('click', function(event){

        event.preventDefault();
        $.post($("meta[name='BASE_URL']").attr("content") + "/checkout", {
             _token: $("meta[name='csrf-token']").attr("content"),
        },
        function (response, status) {
            window.location = $("meta[name='BASE_URL']").attr("content") + "/cart";
        })
        .fail(function (response) {
            http.fail(response.responseJSON, true);
        })
        .always(function () {
            $this.find("button:submit").attr('disabled', false);
            $this.find("button:submit").html(buttonText);
        });

    });
   }, 1000);
</script>

<script>
setTimeout(() => {
    $('.actions').on('click', function (e) {
    e.preventDefault();
    $this = $(this);
    $.post($("meta[name='BASE_URL']").attr("content") + "/add-delete-form-cart", {
        _token: $("meta[name='csrf-token']").attr("content"),
        flag :$this.data('flag'),
        product_id :$this.data('id'),
    },
    function (response, status) {
        window.location = $("meta[name='BASE_URL']").attr("content") + "/cart";
    })
    .fail(function (response) {
        http.fail(response.responseJSON, true);
    })
    .always(function () {
        $this.find("button:submit").attr('disabled', false);
        $this.find("button:submit").html(buttonText);
    });
})
}, 1000);
</script>
@endsection

