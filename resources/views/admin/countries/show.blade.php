@extends('adminlte::page')

@section('title', __('Editar País'))

@section('content')
    <div class="container-fluid">
        <x-adminlte-card title="{{ __('Detalhes do País') }}" theme="primary" theme-mode="outline" collapsible>
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

            <form>
                @csrf
                <!-- Informações do País -->
                <h5 class="mt-4 mb-3">{{ __('Informações do País') }}</h5>
                <div class="row">
                    <div class="col-mb-3 col-md-3 col-sm-6">
                        <strong><i class="fas fa-id-badge"></i> {{ __('ID:') }}</strong>
                        <p class="text-muted">{{ $country->id }}</p>
                    </div>
                    <div class="col-mb-3 col-md-3 col-sm-6">
                        <strong><i class="fas fa-flag"></i> {{ __('Nome:') }}</strong>
                        <p class="text-muted">{{ $country->name }}</p>
                    </div>
                    <div class="col-mb-3 col-md-3 col-sm-6">
                        <strong><i class="fas fa-map"></i> {{ __('Code:') }}</strong>
                        <p class="text-muted">{{ $country->code }}</p>
                    </div>
                </div>

                <!-- Botões -->
                <div class="mt-4">
                    <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Voltar') }}
                    </a>
                    <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> {{ __('Editar País') }}
                    </a>
                </div>
            </form>
        </x-adminlte-card>
    </div>
@stop