@extends('layouts.store_front')
@section('contnet')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Shop product</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <a href="#" class="banner-link">
                        <figure><img src={{asset('store_front/images/products/pp15.jpg')}} alt=""></figure>
                    </a>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">العطورالرجالية</h1>

                    <div class="wrap-right">



                    </div>

                </div><!--end wrap shop control-->

                <div class="row">

                    <ul class="product-list grid-products equal-container">
                        @foreach ($manProducts as $product)

                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href={{route('view-product', $product->id)}} title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src={{$product->image_url}} alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href={{route('view-product', $product->id)}} class="product-name"><span>{{$product->name}}</span></a>
                                    <div class="wrap-price"><span class="product-price">{{$product->price}} $</span></div>
                                    <a data-id={{$product->id}} class="btn add-to-cart">اضافة الى السلة</a>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>

                </div>

                <div class="wrap-pagination-info">
                    <ul class="page-numbers">
                        <li><span class="page-number-item current" >1</span></li>
                        <li><a class="page-number-item" href="#" >2</a></li>
                        <li><a class="page-number-item" href="#" >3</a></li>
                        <li><a class="page-number-item next-link" href="#" >Next</a></li>
                    </ul>
                    <p class="result-count">Showing 1-8 of 12 result</p>
                </div>
            </div><!--end main products area-->









            </div><!--end sitebar-->

        </div><!--end row-->

    </div><!--end container-->

</main>
@endsection

@section('js')
<script>$id = {{$product->id}}</script>
<script>$user_id = "{{auth()->user()->id ?? null}}"</script>
<script>
    console.log('object');
   setTimeout(() => {
    $(".add-to-cart").on('click', function(event){
        event.preventDefault();
        $id = $(this).data('id')
        if($user_id){
                var $this = $(this).closest('form');
                $.post($("meta[name='BASE_URL']").attr("content") + "/addToCart", {
                _token: $("meta[name='csrf-token']").attr("content"),
                product_quantity: 1,
                id : $id,
                },
                function (response, status) {
                    window.location = $("meta[name='BASE_URL']").attr("content") + "/man-store" ;
                })
                .fail(function (response) {
                    http.fail(response.responseJSON, true);
                })
                .always(function () {
                    $this.find("button:submit").attr('disabled', false);
                    $this.find("button:submit").html(buttonText);
            });
        }else{
            window.location = $("meta[name='BASE_URL']").attr("content") + "/user-login";
        }


    });
   }, 1000);
</script>
@endsection
