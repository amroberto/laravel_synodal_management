@extends('adminlte::page')

@section('title', __('Cadastrar País'))

@section('content_header')
<h1 class="m-0 text-dark">{{ __('Cadastrar País') }}</h1>
@stop
@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.countries.index') }}">{{ __('Países') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Cadastrar País') }}</li>
        </ol>
    </nav>
    <!-- Alertas -->
    @if (session('success'))
    <x-adminlte-alert theme="success" title="{{ __('Sucesso') }}" dismissable>
        {{ session('success') }}
    </x-adminlte-alert>
    @elseif (session('error'))
    <x-adminlte-alert theme="danger" title="{{ __('Erro') }}" dismissable>
        {{ session('error') }}
    </x-adminlte-alert>
    @endif

    <form action="{{ route('admin.countries.store') }}" method="POST">
        @csrf
        <x-adminlte-card>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="mr-2 fas fa-info-circle"></i>{{ __('Informações Gerais') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label class="form-label">{{ __('Nome') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Digite o nome do País') }}" required>
                            </div>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label class="form-label">{{ __('Code') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map"></i></span>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="name" name="name" value="{{ old('code') }}" placeholder="{{ __('Digite o código do País') }}" required>
                            </div>
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botões -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-sm"><i class="mr-1 fas fa-save"></i> {{ __('Salvar') }}</button>
                <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary btn-sm"><i class="mr-1 fas fa-arrow-left"></i> {{ __('Voltar') }}</a>
            </div>
        </x-adminlte-card>
    </form>
</div>
@stop

@section('css')
    <style>
        .card {
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .row div {
            margin-bottom: 10px;
        }
        .btn-sm {
            margin-right: 5px;
        }
    </style>
@stop

@section('js')
@stop
