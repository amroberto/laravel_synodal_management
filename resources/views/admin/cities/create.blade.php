@extends('adminlte::page')

@section('title', __('Cadastrar Cidade'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('Cadastrar Cidade') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">{{ __('Cidades') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Cadastrar') }}</li>
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
    <form action="{{ route('admin.states.store') }}" method="POST">
        @csrf
<div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="mr-2 fas fa-city"></i>{{ __('Criar Cidade') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-6 col-md-6 col-sm-12">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="text-danger small" />
                </div>
                <div class="mb-3 col-md-3 col-sm-12">
                    <label for="ibge_code" class="form-label">{{ __('Código IBGE') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-code"></i></span>
                        <input type="text" class="form-control" id="ibge_code" name="ibge_code" required>
                    </div>
                    <x-input-error :messages="$errors->get('ibge_code')" class="text-danger small" />
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="country_id" class="form-label">{{ __('State') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                        <select id="state_id" name="state_id" class="form-control">
                            <option value="">{{ __('Selecione um estado') }}</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ (old('state_id') == $state->id) ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('state_id')" class="text-danger small" />
                </div>
            </div>
        </div>
    </div>
    <!-- Botões -->
    <div class="card card-outline">
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="mr-1 fas fa-save"></i> {{ __('Salvar') }}</button>
            <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary"><i class="mr-1 fas fa-arrow-left"></i> {{ __('Voltar') }}</a>
        </div>
    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@stop