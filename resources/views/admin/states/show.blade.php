@extends('adminlte::page')

@section('title', __('Detalhes do Estado'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.states.index') }}">{{ __('Estados') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Detalhes') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <x-adminlte-card title="{{ __('Detalhes do Estado') }}" theme="primary" theme-mode="outline" collapsible>
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
                <!-- Informações do Estado -->
                <h5 class="mt-4 mb-3">{{ __('Informações do Estado') }}</h5>
                <div class="row">
                    <div class="col-md-4">
                        <x-adminlte-input name="name" label="{{ __('Nome do Estado') }}" value="{{ $state->name }}"
                            disabled igroup-size="sm">
                            <x-slot name="prependSlot">
                                <div class="input-group-text"><i class="fas fa-flag"></i></div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input name="abbreviation" label="{{ __('Abreviação') }}" value="{{ $state->abbreviation }}"
                            disabled igroup-size="sm">
                            <x-slot name="prependSlot">
                                <div class="input-group-text"><i class="fas fa-font"></i></div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>

                <!-- Botões -->
                <div class="mt-4">
                    <a href="{{ route('admin.states.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Voltar') }}
                    </a>
                    <a href="{{ route('admin.states.edit', $state) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> {{ __('Editar Estado') }}
                    </a>
                </div>
            </form>
        </x-adminlte-card>
    </div>
@stop
