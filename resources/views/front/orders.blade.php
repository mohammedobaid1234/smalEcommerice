@extends('layouts.store_front')
@section('css')
<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
</style>
@endsection
@section('contnet')
<br>
<br>
<br>
  <div class="projects p-20 bg-white rad-10 m-20">

    <div class="responsive-table">
        <table class="fs-15 w-full">
            <thead>
                <tr>
                    <td>التفاصيل</td>
                    <td>تاريخ الطلب</td>
                    <td>السعر الكلي</td>
                    <td>الكمية </td>
                    <td>المنتج </td>
                    <td>المدينة</td>
                    <td>البريد الالكتروني</td>
                    <td>رقم الجوال </td>
                    <td>الاسم  </td>
                    <td>الصورة </td>
                    <td> id</td>

                </tr>
            </thead>
            <tbody>

                @foreach ($userOrders as $order)
                    <tr>
                        <td><a data-action="destroy" data-id={{$order['details_id']}} class="btn btn-xs red tooltips" ><i style="color:#000" class="fa fa-times" ></a></td>
                        <td>{{$order['created_at']}}/td>
                        <td>{{$order['product_total']}}$</td>
                        <td>{{$order['product_quantity']}}</td>
                        <td>{{$order['product_total']}}</td>
                        <td>{{$order['user_address']}}</td>
                        <td>{{$order['user_email']}}</td>
                        <td>{{$order['user_mobile_no']}}</td>
                        <td>{{$order['user_name']}}</td>
                        <td ><?php echo '<a href="'.$order['product_image'].'" target="_blank"><img src="'.$order['product_image'].'" width="50px" height="50px" style="border-radius: 10% !important;"></a></td>'?>
                        <td >{{$order['order_id']}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- End Project Table -->
</div>
</div>
<br>
<br>
<br>
@endsection

@section('js')
<script>
    setTimeout(() => {
    $('a[data-action="destroy"]').on('click', function (e) {
        e.preventDefault();
        $id =$(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",

            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $("meta[name='BASE_URL']").attr("content") + '/order-details-delete/' + $id,
                    type: 'DELETE',
                    data:{
                        _token: $("meta[name='csrf-token']").attr("content"),
                    }
                })
                .done(function(response) {
                    // http.success({ 'message': response.message });
                    window.location.reload();
                })
                .fail(function(response){
                http.fail(response.responseJSON, true);
                })
            } else {
                swal("Your imaginary file is safe!");
            }
            });
    });

    }, 1000);
</script>
@endsection
