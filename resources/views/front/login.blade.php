@extends('layouts.store_front')
@section('contnet')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><span></span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="login-form form-item form-stl">
                            <form name="frm-login">
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">تسجيل الدخول</h3>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-uname">عنوان البريد الالكتروني</label>
                                    <input type="text" id="frm-login-uname" name="email" placeholder="ادخل البريد الالكتروني">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-pass">كلمة المرور:</label>
                                    <input type="password" id="frm-login-pass" name="password" placeholder="************">
                                </fieldset>

                                <fieldset class="wrap-input">
                                    <label class="remember-field">
                                        <input class="frm-input " name="rememberme" id="rememberme" value="forever" type="checkbox"><span>  </span>
                                    </label>
                                    <a class="link-function left-position" href="#" title="Forgotten password?">تذكر كلمة المرر </a>
                                </fieldset>
                                <input type="submit" class="btn btn-submit" id="btn-submit" value="دخول" name="submit">
                            </form>
                            <a class="link-function left-position" href={{route('user-register')}} title="Forgotten password?">تسجيل جديد </a>
                        </div>
                    </div>
                </div><!--end main products area-->
            </div>
        </div><!--end row-->

    </div><!--end container-->

</main>
@endsection
@section('js')
    <script src="{{ asset('/core/login_front.js') }}"></script>

@endsection
