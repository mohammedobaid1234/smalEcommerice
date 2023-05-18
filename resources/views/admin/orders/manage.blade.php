@extends('layouts.app')
@section('contnet')
<div class="content">
    <table class="table table-bordered data-table" style="width: 100%">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>{{__('User Name')}}</th>
                <th>{{__('Address')}}</th>
                <th>{{__('Total')}}</th>
                <th>{{__('Created At')}}</th>
                <th width="100px">{{__('Actions')}}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
@section('js')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script>
    $(function () {
        var table = $('.data-table').DataTable({
        searching: false,
          processing: true,
          serverSide: true,
          dom: '<"dt-top-container"<B><"dt-center-in-div"l><f>r>t<"dt-filter-spacer"><ip>',

          ajax: {
            url:  "{{ route('orders.manage') }}",
            data: function (d) {
                d.vendor_id = $('select[name="vendor_id"]').val()
            }

          },
          columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },
              {data: 'id', name: 'id'},
              {data: 'user.name', name: 'user.name', defaultContent: "__"},
              {data: 'user.address', name: 'user.address', defaultContent: "__"},
              {data: 'total', name: 'total', defaultContent: "__"},
              {data: 'created_at', name: 'created_at', defaultContent: "__"},
              {data: 'action', name: 'action', orderable: false, searchable: false , defaultContent: "__"},

          ],
        });
        changeStatusForAdmin('orders');

        setTimeout(() => {
            $('.data-table tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data().order_details,row.data())).show();
                tr.addClass('shown');
            }
        });
        }, 1000);
        function format(d,data1) {
            data = '';
            result = '';
            if(d != null){
                d.forEach(element => {
                    console.log((element.quantity) * (element.price));
                    data += '<tr>';
                        data += `<td> ${element.product.id} </td>`;
                        data += `<td> ${element.product.name} </td>` ;
                        data += `<td> ${element.quantity} </td>` ;
                        data += `<td> ${element.price} </td>`  ;
                        data += `<td> ${(element.quantity) * (element.price)} </td>`  ;
                    data += '</tr>';
                });
                result += `
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>{{__('Product id')}}</th>
                            <th>{{__('Product Name')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Total')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                       ${data}
                    </tbody>
                </table>
                `;
            }
            return result;
        }
        $('input').on('change', function(e) {
            table.draw();
            e.preventDefault();
        });
        $('select').on('change', function(e) {
            table.draw();
            e.preventDefault();
        });

    });
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

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
                    url: $("meta[name='BASE_URL']").attr("content") + '/admin/orders/delete-order/' + $id,
                    type: 'DELETE',
                    data:{
                        _token: $("meta[name='csrf-token']").attr("content"),
                    }
                })
                .done(function(response) {
                    http.success({ 'message': response.message });
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

