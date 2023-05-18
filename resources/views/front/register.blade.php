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
                        <div class="register-form form-item ">
                            <form class="form-stl" action="#" name="frm-login" method="get" >
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">انشاء حساب</h3>
                                    <h4 class="form-subtitle">المعلومات الشخصية</h4>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-name">الاسم</label>
                                    <input type="text" id="frm-name" name="name" placeholder="الاسم*">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-email">البريد الالكتروني</label>
                                    <input type="email" id="frm-email" name="email" placeholder="البريد الاللكتروني">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-mobile_no">رقم الجوال</label>
                                    <input type="email" id="frm-mobile_no" name="mobile_no" placeholder="رقم الجوال">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-mobile_no">العنوان</label>
                                    <input type="email" id="frm-address" name="address" placeholder="العنوان ">
                                </fieldset>

                                <fieldset class="wrap-title">
                                    <h3 class="form-title">معلومات تسجيل الدخول</h3>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half left-item ">
                                    <label for="frm-password">كلمة المرور *</label>
                                    <input type="text" id="frm-password" name="password" placeholder="كلمة المرور">
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half ">
                                    <label for="frm-confirm_password">تأكيد كلمة المرور *</label>
                                    <input type="text" id="frm-confirm_password" name="confirm_password" placeholder="تأكيد كلمة المرور">
                                </fieldset>
                                <input type="submit" id="btn-submit" class="btn btn-sign" value="تسجيل" name="register">
                            </form>
                        </div>
                    </div>
                </div><!--end main products area-->
            </div>
        </div><!--end row-->

    </div><!--end container-->

</main>
@endsection
@section('js')

<script>
   setTimeout(() => {
    $("#btn-submit").on('click', function(event){
        var $this = $(this).closest('form');
        event.preventDefault();
        $.post($("meta[name='BASE_URL']").attr("content") + "/user-register", {
        _token: $("meta[name='csrf-token']").attr("content"),
        name: $.trim($this.find("input[name='name']").val()),
        email: $.trim($this.find("input[name='email']").val()),
        address: $.trim($this.find("input[name='address']").val()),
        mobile_no: $.trim($this.find("input[name='mobile_no']").val()),
        password: $.trim($this.find("input[name='password']").val()),
        confirm_password: $.trim($this.find("input[name='confirm_password']").val()),
        },
        function (response, status) {
            window.location = $("meta[name='BASE_URL']").attr("content") + "/";
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
@endsection
