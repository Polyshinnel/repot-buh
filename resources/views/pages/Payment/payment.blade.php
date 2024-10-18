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
                    <div class="table-toolbar"></div>
                    <table id="payment-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Дата платежа</th>
                            <th>Сумма платежа</th>
                            <th>Комиссия</th>
                            <th>Сайт</th>
                            <th>Id заказа</th>
                            <th>Id Платежной системы</th>
                            <th>Ссылка</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($payments)
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment['payment_date']}}</td>
                                        <td>{{$payment['payment_sum']}}</td>
                                        <td>{{$payment['commission']}}</td>
                                        <td>{{$payment['site']}}</td>
                                        <td>{{$payment['order_id']}}</td>
                                        <td>{{$payment['payment_id']}}</td>
                                        <td>
                                            @if($payment['link'] == 'Пусто')
                                                <p>Заказ Beauty</p>
                                            @else
                                                <a href="{{$payment['link']}}">Ссылка</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Дата платежа</th>
                            <th>Сумма платежа</th>
                            <th>Комиссия</th>
                            <th>Сайт</th>
                            <th>Id заказа</th>
                            <th>Id Платежной системы</th>
                            <th>Ссылка</th>
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
        // $(function () {
        //     $('#payment-table').DataTable({
        //         "responsive": true, "lengthChange": false, "autoWidth": false,
        //         "buttons": ["excel", "print"],
        //         "paginate": {
        //             "first": 'First page',
        //             "next": 'Следующая',
        //             "previous": 'Предыдущая'
        //         }
        //
        //     })
        // });
        let table = $('#payment-table').DataTable({
            buttons: [
               'excel', 'print'
            ],
            order: [[0, 'desc']],
            pageLength: 100,
            lengthChange: false,
            oLanguage: {
                oPaginate: {
                    sFirst: "Первая", // This is the link to the first page
                    sPrevious: "Пред.", // This is the link to the previous page
                    sNext: "След.", // This is the link to the next page
                    sLast: "Последняя" // This is the link to the last page
                }
            }
        });
        table.buttons().container().appendTo('#payment-table_wrapper .col-md-6:first');
        $('#payment-table_wrapper .col-md-6:first').addClass('d-flex align-items-center')
        $('#payment-table_wrapper .col-md-6:nth-child(2)').addClass('d-flex align-items-center justify-content-end')
    </script>
@endsection
