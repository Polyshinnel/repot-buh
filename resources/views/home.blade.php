@extends('layout.main-layout')
@section('username', $username)
@section('page_title', $page_title)
@section('block_title', $block_title)

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Платежи за {{$today}}</h3>
                        <a href="/payments">Полный список</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">{{$payments['payment_count']}}</span>
                            <span>Количество платежей</span>
                        </p>
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">{{$payments['payment_sum']}} ₽</span>
                            <span>Сумма платежей</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="payment-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Платежи
                      </span>
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Список платежей</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Сайт</th>
                                <th>Сумма</th>
                                <th>Время</th>
                                <th>Id заказа</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($payments['items'])
                                @foreach($payments['items'] as $item)
                                    <tr>
                                        <td>{{$item['site']}}</td>
                                        <td>{{$item['sum']}} ₽</td>
                                        <td>{{$item['date']}}</td>
                                        <td>{{$item['order_id']}}</td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Возвраты за {{$today}}</h3>
                        <a href="/returning">Полный список</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">3</span>
                            <span>Количество возвратов</span>
                        </p>

                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">7000</span>
                            <span>Сумма платежей</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="returning-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Возвраты
                      </span>
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Список возвратов</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                        <tr>
                            <th>Сайт</th>
                            <th>Сумма</th>
                            <th>Время</th>
                            <th>Id заказа</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                pay.kidsberry.web
                            </td>
                            <td>525 ₽</td>
                            <td>
                                01.10.2024 10:30:31
                            </td>
                            <td>
                                Заказ beauty-Fuv5aaM57Lnw20112024200021306744
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

    @if($plot_data)
        <ul id="payment_axis" class="d-none">
            @foreach($plot_data['data_axis'] as $axis)
                <li>{{$axis}}</li>
            @endforeach
        </ul>

        <ul id="payment_value" class="d-none">
            @foreach($plot_data['data_payment'] as $data)
                <li>{{$data}}</li>
            @endforeach
        </ul>
    @endif


    <script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <script>
        function getPaymentAxis() {
            let axisArr = [];
            if($('#payment_axis').length > 0) {
                $('#payment_axis li').each(function () {
                    axisArr.push($(this).html())
                })
            }

            return axisArr;
        }

        function getPaymentData() {
            let dataArr = [];
            if($('#payment_value').length > 0) {
                $('#payment_value li').each(function () {
                    dataArr.push(parseFloat($(this).html()))
                })
            }

            return dataArr
        }

        $(function () {
            'use strict'
            let $visitorsChart = $('#payment-chart')
            let mode = 'index'
            let intersect = true
            let ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }


            let paymentLabels = getPaymentAxis();
            let paymentData = getPaymentData();
            console.log(paymentLabels)
            console.log(paymentData)
            let dataList = {
                labels: paymentLabels,
                    datasets: [
                    {
                        type: 'line',
                        data: paymentData,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                        fill: false
                        // pointHoverBackgroundColor: '#007bff',
                        // pointHoverBorderColor    : '#007bff'
                    },
                ]
            }

            let visitorsChart = new Chart($visitorsChart, {
                data: dataList,
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: 200
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })
    </script>
@endsection
