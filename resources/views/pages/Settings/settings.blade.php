@extends('layout.main-layout')
@section('username', $username)
@section('page_title', $page_title)
@section('block_title', $block_title)

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="/settings/add"><button type="button" class="btn btn-primary">Добавить сайт</button></a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список сайтов</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Поиск">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Адрес сайта</th>
                            <th>Платежная система</th>
                            <th>Id магазина</th>
                            <th>Api ключ</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($settings_list)
                                @foreach($settings_list as $setting)
                                    <tr>
                                        <td>{{$setting['id']}}</td>
                                        <td>{{$setting['site_addr']}}</td>
                                        <td>{{$setting['payment']}}</td>
                                        <td>{{$setting['shop_id']}}</td>
                                        <td>{{$setting['api_key']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
@endsection
