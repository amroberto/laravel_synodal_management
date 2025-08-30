@extends('adminlte::page')

@section('title', __('Editar Usuário'))

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('Usuários') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Editar') }}</li>
    </ol>
</nav>
@stop

@section('content')
<div class="container-fluid">
    <x-adminlte-card title="{{ __('Atualizar Usuário') }}" theme="primary" theme-mode="outline" collapsible>
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

        <form action="{{ route('admin.users.update', $user) }}" method="POST" id="update-user-form">
            @csrf
            @method('PUT')

            <!-- Informações Pessoais -->
            <h5 class="mt-4 mb-3">{{ __('Informações Pessoais') }}</h5>
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" value="{{ old('name', $user->name) }}" required igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="email" label="{{ __('E-mail') }}" type="email" value="{{ old('email', $user->email) }}" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('Tipo de Usuário') }}</label>
                    <div class="form-group">
                        @foreach ($userTypes as $userType)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input user-type-radio" type="radio" name="user_type" id="user_type_{{ $userType->value }}" value="{{ $userType->value }}" {{ old('user_type', $user->user_type) === $userType->value ? 'checked' : '' }}>
                            <label class="form-check-label" for="user_type_{{ $userType->value }}">
                                {{ $userType->label() }}
                            </label>
                        </div>
                        @endforeach
                        @error('user_type')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <x-adminlte-select name="is_active" label="{{ __('Status') }}" required>
                        <option value="" disabled {{ old('is_active', $user->is_active) === null ? 'selected' : '' }}>{{ __('Selecione o status') }}</option>
                        <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>{{ __('Ativo') }}</option>
                        <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>{{ __('Inativo') }}</option>
                    </x-adminlte-select>
                    @error('is_active')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Botões -->
            <div class="mt-4">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('Atualizar') }}" icon="fas fa-save" id="submit-button" />
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Voltar') }}
                </a>
            </div>
        </form>
    </x-adminlte-card>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-check-inline {
        margin-right: 1rem;
    }

    .form-group label {
        font-weight: 600;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }

    .select2-container--default .select2-selection--multiple {
        min-height: 60px;
        /* Aumenta a altura do campo multiselect */
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .select2-container--default .select2-results__options {
        max-height: 300px;
        /* Aumenta a altura do dropdown para exibir mais opções */
    }

</style>
@stop

@section('plugins.JqueryMask', true)
@section('plugins.Select2', true)

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        // Alternar visibilidade do campo communities
        function toggleCommunitiesField() {
            const userType = $('input[name="user_type"]:checked').val();
        }
    });

</script>
@stop
