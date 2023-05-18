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
                                    <input type="text" id="frm-name" name="name" placeholder="الاسم*" value="{{$user->name}}">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-email">البريد الالكتروني</label>
                                    <input type="email" id="frm-email" name="email" placeholder="البريد الاللكتروني" value="{{$user->email}}">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-mobile_no">رقم الجوال</label>
                                    <input type="email" id="frm-mobile_no" name="mobile_no" placeholder="رقم الجوال" value="{{$user->mobile_no}}">
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-mobile_no">العنوان</label>
                                    <input type="email" id="frm-address" name="address" placeholder="العنوان " value="{{$user->address}}">
                                </fieldset>
                                <input type="submit" id="btn-submit" class="btn btn-sign" value="تعديل" name="register">
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
        $.post($("meta[name='BASE_URL']").attr("content") + "/user-update-profile", {
        _token: $("meta[name='csrf-token']").attr("content"),
        name: $.trim($this.find("input[name='name']").val()),
        email: $.trim($this.find("input[name='email']").val()),
        address: $.trim($this.find("input[name='address']").val()),
        mobile_no: $.trim($this.find("input[name='mobile_no']").val()),
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
