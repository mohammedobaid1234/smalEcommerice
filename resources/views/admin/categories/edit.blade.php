@extends('layouts.modal')

@section('contnet')
<form id="target" data-action="categories" action="" method="post" class="form-horizontal">
    @csrf
    @foreach ($languages as $lang)
        <div class="form-group row">
            <label for="" class="col-3 control-label">{{__('Name '. $lang->name)}}</label>
            <div class="col-7">
                <input required type="text" class="form-control " name="name_{{$lang->name}}" value="{{ @$item->translate($lang->name)->name}}" >
                <p class="invalid-feedback"></p>
            </div>
        </div>
    @endforeach
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Parent Category')}}</label>
        <div class="col-7">
            <select name="parent_id" class="js-example-basic-single form-select form-control ">
                <option value="">{{__('Choose Parent ...')}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if ($category->id == $item->parent_id)
                        selected
                    @endif>{{$category->name}}</option>
                @endforeach
            </select>
            <p class="invalid-feedback"></p>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-3 control-label">{{__('Status')}}</label>
        <div class="col-7">
            <select name="status" class="js-example-basic-single form-select form-control ">
                <option value="">{{__('Choose Stataus ...')}} </option>
                <option value="active" @if ('active' == $item->status)selected @endif>{{__('Active')}}</option>
                <option value="not_active" @if ('not_active' == $item->status)selected @endif>{{__('Not Active')}}</option>
            </select>
            <p class="invalid-feedback"></p>
        </div>
    </div>
    
    
    <div class="form-group row">
        <div class="col-sm-offset-2 col-7">
            <input id="btn-submit-modal" value="{{__('Add')}}" hidden type="submit" class="btn btn-primary" >
        </div>
    </div>
</form>
@endsection
@section('js')
<script>$id = {{$item->id}}</script>
<script>
    imageRemoveAndAppeared('categories', $id)

    myDropzoneForModal('categories')
  </script>
<script>
    $("button#btn-submit").on('click', function(event){
        event.preventDefault();
        var $this = $(this).parent().parent().find('form');
        fail = true;
        http.checkRequiredFelids($this);
        if(!fail){
            return true;
        }
        var buttonText = $this.find('button:submit').text();
        data = {
            _token: $("meta[name='csrf-token']").attr("content"),
            name_en: $.trim($this.find("input[name='name_en']").val()),
            name_ar: $.trim($this.find("input[name='name_ar']").val()),
            parent_id: $.trim($this.find("select[name='parent_id']").val()),
            status: $.trim($this.find("select[name='status']").val()),
        }
        $this.find("button:submit").attr('disabled', true);
        $this.find("button:submit").html('<span class="fas fa-spinner" data-fa-transform="shrink-3"></span>');

        $.ajax({
            url: $("meta[name='BASE_URL']").attr("content") + '/admin/categories/' + $id,
            type: 'PUT',
            data:data
        })
        .done(function(response) {
            successfullyResponse(response)
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