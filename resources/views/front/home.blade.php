@extends('layouts.store_front')
@section('contnet')
<main id="main">
    <div class="container">

        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                <div class="item-slide">
                    <img src={{asset('store_front/images/products/pp16.jpg')}} alt="" class="img-slide">
                    <div class="slide-info slide-1">

                    </div>
                </div>
                <div class="item-slide">
                    <img src={{asset('store_front/images/products/pp11.jpg')}} alt="" class="img-slide">
                    <div class="slide-info slide-2">

                    </div>
                </div>
                <div class="item-slide">
                    <img src={{asset('store_front/images/products/pp15.jpg')}} alt="" class="img-slide">
                    <div class="slide-info slide-3">

                    </div>
                </div>
            </div>
        </div>

        <!--BANNER-->
        <div class="wrap-banner style-twin-default">
            <div class="banner-item">
                <a href="#" class="link-banner banner-effect-1">
                    <figure><img src={{asset('store_front/images/products/pp67.jpeg')}} alt="" width="580" height="190"></figure>
                </a>
            </div>
            <div class="banner-item">
                <a href="#" class="link-banner banner-effect-1">
                    <figure><img src={{asset('store_front/images/products/pp60.jpeg')}} alt="" width="580" height="190"></figure>
                </a>
            </div>
        </div>

        <!--On Sale-->
        <div class="wrap-show-advance-info-box style-1 has-countdown">
            <h3 class="title-box">New</h3>
            <div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                @foreach ($newProducts as $product)
                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href={{route('view-product', $product->id)}} title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src={{$product->image_url}} width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item sale-label">new</span>
                            </div>
                            <div class="wrap-btn">
                                <a href={{route('view-product', $product->id)}} class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>{{$product->name }}  || {{$product->description}}</span></a>
                            <div class="wrap-price"><span class="product-price">{{$product->price}} $</span></div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>



        <!--Product Categories-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Product Categories</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src={{asset('store_front/images/products/pp6.jpg')}} width="1170" height="240" alt=""></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class=" tab-control">
                        <a href="#fashion_1a" class="tab-control-item active">Women</a>
                        <a href="#fashion_1b" class="tab-control-item">Man</a>
                    </div>
                    <div class="tab-contents">

                        <div class="tab-content-item active" id="fashion_1a">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                @foreach ($womanProducts as $product)

                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href={{route('view-product', $product->id)}} title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure><img src={{$product->image_url}} width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                        </a>
                                        {{-- <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                        </div> --}}
                                        <div class="wrap-btn">
                                            <a href={{route('view-product', $product->id)}} class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{$product->name }}  || {{$product->description}}</span></a>
                                        <div class="wrap-price"><span class="product-price">{{$product->price}} $</span></div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="tab-content-item" id="fashion_1b">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @foreach ($manProducts as $product)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href={{route('view-product', $product->id)}} title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure><img src={{$product->image_url}} width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                        </a>

                                        <div class="wrap-btn">
                                            <a href={{route('view-product', $product->id)}} class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{$product->name }}  || {{$product->description}}</span></a>
                                        <div class="wrap-price"><span class="product-price">{{$product->price}} $</span></div>
                                    </div>
                                </div>
                                @endforeach



                            </div>
                        </div>
        </div>

    </div>

</main>
@endsection
