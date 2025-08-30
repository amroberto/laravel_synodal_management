@extends('adminlte::page')

@section('title', __('Cargos'))

@section('content_header')
<h1 class="m-0 text-dark">{{ __('Editar Cargo') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.positions.index') }}">{{ __('Cargos') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Editar Cargo') }}</li>
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
    <!-- Formulário -->
    <form action="{{ route('admin.positions.update', $position) }}" method="POST">
        @csrf
        @method('PUT')
        <x-adminlte-card title="{{ __('Editar Cargo') }}" theme="primary" collapsible>
            <!-- Informações Gerais -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="mr-2 fas fa-info-circle"></i>{{ __('Editar Cargo') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label class="form-label">{{ __('Nome') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $position->name) }}" placeholder="{{ __('Digite o nome do Cargo') }}" required>
                            </div>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                     <!-- Botões -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
                        <a href="{{ route('admin.positions.index') }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
                    </div>
                </div>
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
