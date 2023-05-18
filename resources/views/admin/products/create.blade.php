@extends('layouts.app')
@section('contnet')
<form id="target" action="{{route('products.store')}}" method="post" class="form-horizontal">
    @csrf
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">{{__('Name')}}</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control " name="name" >
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">{{__('type')}}</label>
        <div class="col-sm-10">

           <select name="type"  class="form-control ">
            <option value="1">رجالي</option>
            <option value="2">نسائي</option>
           </select>

            <p class="invalid-feedback"></p>
        </div>
    </div>



    <div class="form-group">
        <label for="" class="col-sm-2 control-label">{{__('Description')}}</label>
        <div class="col-sm-10">
            <Textarea class="form-control " name="description"></Textarea>
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">{{__('Is New')}}</label>
        <div class="col-sm-10">
            <input type="checkbox" class="form-check-input" name="is_new" id="" value="1" >

            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">{{__('price')}}</label>
        <div class="col-sm-10">

            <input required type="text" class="form-control " name="price" >

                    <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input id="btn-submit" value="{{__('Add')}}" type="submit" class="btn btn-primary" >
        </div>
    </div>
</form>
@endsection
@section('js')
<script>$id = ''</script>
<script>
    myDropzone('products')
</script>
<script>


    $("#btn-submit").on('click', function(event){
    event.preventDefault();
    var $this = $(this).closest('form');
    fail = true;
    http.checkRequiredFelids($this);
    if(!fail){
        return true;
    }
    var buttonText = $this.find('button:submit').text();
    data = {
        _token: $("meta[name='csrf-token']").attr("content"),
        name: $.trim($this.find("input[name='name']").val()),
        type: $.trim($this.find("select[name='type']").val()),
        is_new:$("input[name='is_new']").is(':checked') ? 1 : null,
       price: $.trim($this.find("input[name='price']").val()),
        description: $.trim($this.find("textarea[name='description']").val()),
    }
    $this.find("button:submit").attr('disabled', true);
    $this.find("button:submit").html('<span class="fas fa-spinner" data-fa-transform="shrink-3"></span>');

    $.post($("meta[name='BASE_URL']").attr("content") + "/admin/products", data,
    function (response, status) {
        successfullyResponse(response)
        http.success({ 'message': response.message });
        window.location.reload();
    })
    .fail(function (response) {
        http.fail(response.responseJSON, true);
    })
    .always(function () {
        $this.find("button:submit").attr('disabled', false);
        $this.find("button:submit").html(buttonText);
    });
});

</script>

@endsection
