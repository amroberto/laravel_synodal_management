@extends('adminlte::page')

@section('title', __('Configurações do Sistema'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Configurações do Sistema') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <x-adminlte-card title="{{ __('Configurações do Sistema') }}" theme="primary" theme-mode="outline" collapsible>
            <p>{{ __('Aqui você pode gerenciar as configurações do sistema.') }}</p>
            <!-- Adicione mais conteúdo de configuração conforme necessário -->
        </x-adminlte-card>
    </div>
@stop

