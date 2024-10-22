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
                        <div class="d-flex">
                            <div class="pay-sum d-flex flex-column">
                                <span class="text-bold text-lg">{{$payments['payment_sum']}} ₽</span>
                                <span>Сумма платежей</span>
                            </div>
                            <div class="pay-index ml-3">
                                @if($payment_percent > 0)
                                    <span class="text-success">
                                      <i class="fas fa-arrow-up"></i> {{$payment_percent}}%
                                    </span>
                                @else
                                    <span class="text-danger">
                                      <i class="fas fa-arrow-down"></i> {{$payment_percent}}%
                                    </span>
                                @endif

                            </div>
                        </div>
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
                                <th>Ссылка на заказ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($payments['items'])
                                @foreach($payments['items'] as $item)
                                    <tr>
                                        <td>{{$item['site']}}</td>
                                        <td>{{$item['sum']}} ₽</td>
                                        <td>{{$item['date']}}</td>
                                        <td>
                                            @if($item['link'] != 'Пусто')
                                                <a href="{{$item['link']}}">Ссылка</a>
                                            @else
                                                <p>Заказ beauty</p>
                                            @endif
                                        </td>
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
                        <h3 class="card-title">Платежи месяц по сайтам</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="payment-site" height="260"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Сумма
                      </span>
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Список возвратов за месяц</h3>
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
                            @if($returnings)
                                @foreach($returnings as $returning)
                                    <tr>
                                        <td>{{$returning['site']}}</td>
                                        <td>{{$returning['payment_sum']}}</td>
                                        <td>{{$returning['payment_date']}}</td>
                                        <td>{{$returning['order_id']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if(!$returnings)
                        <p class="mt-2 ml-4">К сожалению данных нет</p>
                    @endif
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

    @if($siteColumnPlot)
        <ul id="site_axis" class="d-none">
            @foreach($siteColumnPlot['sites'] as $site)
                <li>{{$site}}</li>
            @endforeach
        </ul>
        <ul id="site_sum" class="d-none">
            @foreach($siteColumnPlot['sum'] as $sum)
                <li>{{$sum}}</li>
            @endforeach
        </ul>
    @endif

    <script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <script>
        function getPaymentAxis(selector) {
            let axisArr = [];
            let list = $(selector)
            if(list.length > 0) {
                list.find('li').each(function () {
                    axisArr.push($(this).html())
                })
            }

            return axisArr;
        }

        function getPaymentData(selector) {
            let dataArr = [];
            let list = $(selector)
            if(list.length > 0) {
                list.find('li').each(function () {
                    dataArr.push($(this).html())
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


            let paymentLabels = getPaymentAxis('#payment_axis');
            let paymentData = getPaymentData('#payment_value');
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



            let sitLabels = getPaymentAxis('#site_axis');
            let siteData = getPaymentData('#site_sum');


            let $paymentSitesChart = $('#payment-site');
            let salesChart = new Chart($paymentSitesChart, {
                type: 'bar',
                data: {
                    labels: sitLabels,
                    datasets: [
                        {
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: siteData
                        }
                    ]
                },
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
