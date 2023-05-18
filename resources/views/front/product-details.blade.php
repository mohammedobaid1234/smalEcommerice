@extends('layouts.store_front')
@section('contnet')
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>detail</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery">
                          <ul>

                            <li data-thumb="assets/images/products/digital_18.jpg">
                                <img src={{$product->image_url}} alt="product thumbnail" />
                            </li>


                          </ul>
                        </div>
                    </div>
                    <div class="detail-info">
                        <div class="product-rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <a href="#" class="count-review">(05 review)</a>
                        </div>
                        <h2 class="product-name">{{$product->name}}</h2>
                        <div class="short-desc">

                                <h4>{{$product->description}}</h4>


                        </div>

                        <div class="wrap-price"><span class="product-price">{{$product->price}} $</span></div>
                        <div class="stock-info in-stock">
                            <p class="availability">Availability: <b>In Stock</b></p>
                        </div>
                        <div class="quantity">
                            <span>Quantity:</span>
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" >

                                <a class="btn btn-reduce" href="#"></a>
                                <a class="btn btn-increase" href="#"></a>
                            </div>
                        </div>
                        <div class="wrap-butons">
                            <a href="" id="cart_btn" class="btn add-to-cart">Add to Cart</a>
                        </div>
                    </div>
                    <div class="advance-info">

                        <div class="tab-contents">

                            <div class="tab-content-item " id="add_infomation">

                            </div>
                            <div class="tab-content-item " id="review">

                                <div class="wrap-review-form">

                                    <div id="comments">

                                    </div><!-- #comments -->

                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">



                                            </div><!-- .comment-respond-->
                                        </div><!-- #review_form -->
                                    </div><!-- #review_form_wrapper -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget widget-our-services ">
                    <div class="widget-content">
                        <ul class="our-services">

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">التوصيل مجانا</b>
                                        <span class="subtitle">عند شرائك بقيمة 500</span>

                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">عرض خاص</b>
                                        <span class="subtitle">الحصول على هدية!</span>

                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- Categories widget-->
            </div><!--end sitebar-->


                </div>
            </div>

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
    $("#cart_btn").on('click', function(event){
        event.preventDefault();
        if($user_id){
                var $this = $(this).closest('form');
                $.post($("meta[name='BASE_URL']").attr("content") + "/addToCart", {
                _token: $("meta[name='csrf-token']").attr("content"),
                product_quantity: $("input[name='product-quatity']").val(),
                id : $id,
                },
                function (response, status) {
                    window.location = $("meta[name='BASE_URL']").attr("content") + "/" ;
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

