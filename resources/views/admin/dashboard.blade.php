@extends('adminlte::page')

@section('title', 'Dashboard Administrativo')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard Administrativo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Bem-vindo ao Dashboard Administrativo</h3>
        </div>
        <div class="card-body">
            <p>Este é o dashboard para administradores.</p>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
@stop

@section('js')
    <script>
        console.log('Dashboard Admin carregado');
    </script>
@stop