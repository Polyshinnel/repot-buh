@extends('layout.main-layout')
@section('username', $username)
@section('page_title', $page_title)
@section('block_title', $block_title)

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Настройки платежной системы</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="/settings/create">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="site-addr">Адрес сайта</label>
                            <select class="form-control" id="site-addr" name="site_id">
                                @foreach($sites as $site)
                                    <option value="{{$site['id']}}">{{$site['site_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_id">Платежная система</label>
                            <select class="form-control" id="payment_id" name="payment_id">
                                @foreach($payment as $item)
                                    <option value="{{$item['id']}}">{{$item['payment_name']}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shop_id">Shop Id</label>
                            <input type="text" class="form-control" id="shop_id" name="shop_id" placeholder="Shop Id">
                        </div>
                        <div class="form-group">
                            <label for="api_key">Api Key</label>
                            <input type="text" class="form-control" id="api_key" name="api_key" placeholder="Api Key">
                        </div>
                        <div class="form-group">
                            <label for="database_name">Database</label>
                            <input type="text" class="form-control" id="database_name" name="database_name" placeholder="Paolareinas">
                        </div>
                        <div class="form-group">
                            <label for="order_prefix">Prefix</label>
                            <input type="text" class="form-control" id="order_prefix" name="order_prefix" placeholder="pr">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
