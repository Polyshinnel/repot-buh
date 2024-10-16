@extends('layout.main-layout')
@section('username', $username)
@section('page_title', $page_title)
@section('block_title', $block_title)

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Дата платежа</th>
                            <th>Сумма платежа</th>
                            <th>Сайт</th>
                            <th>Id заказа</th>
                            <th>Id Платежной системы</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($payments)
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment['payment_date']}}</td>
                                        <td>{{$payment['payment_sum']}}</td>
                                        <td>{{$payment['site']}}</td>
                                        <td>{{$payment['order_id']}}</td>
                                        <td>{{$payment['payment_id']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Дата платежа</th>
                            <th>Сумма платежа</th>
                            <th>Сайт</th>
                            <th>Id заказа</th>
                            <th>Id Платежной системы</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

    <!-- DataTables  & Plugins -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/jszip/jszip.min.js"></script>
    <script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
