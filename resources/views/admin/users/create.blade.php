@extends('adminlte::page')

@section('title', __('Criar Usuário'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('Usuários') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Criar Usuário') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <x-adminlte-card title="{{ __('Criar Novo Usuário') }}" theme="primary" theme-mode="outline" collapsible>
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
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Nome -->
                    <div class="col-md-6">
                        <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Digite o nome do usuário') }}"
                            value="{{ old('name') }}" required>
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </x-slot>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </x-adminlte-input>
                    </div>

                    <!-- E-mail -->
                    <div class="col-md-6">
                        <x-adminlte-input name="email" label="{{ __('E-mail') }}" placeholder="{{ __('Digite o e-mail do usuário') }}"
                            type="email" value="{{ old('email') }}" required>
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </x-slot>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </x-adminlte-input>
                    </div>
                </div>

                <div class="row">
                    <!-- Senha -->
                    <div class="col-md-6">
                        <x-adminlte-input name="password" label="{{ __('Senha') }}" placeholder="{{ __('Digite a senha') }}"
                            type="password" required>
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </x-slot>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </x-adminlte-input>
                    </div>

                    <!-- Confirmação de Senha -->
                    <div class="col-md-6">
                        <x-adminlte-input name="password_confirmation" label="{{ __('Confirmar Senha') }}"
                            placeholder="{{ __('Confirme a senha') }}" type="password" required>
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </x-slot>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </x-adminlte-input>
                    </div>
                </div>

                <div class="row">
                    <!-- Tipo de Usuário -->
                    <div class="col-md-6">
                        <x-adminlte-select name="user_type" label="{{ __('Tipo de Usuário') }}" required>
                            <option value="" disabled selected>{{ __('Selecione o tipo de usuário') }}</option>
                            @foreach (\App\Enums\UserTypeEnum::cases() as $type)
                                <option value="{{ $type->value }}" {{ old('user_type') == $type->value ? 'selected' : '' }}>
                                    {{ __($type->name == 'ADMIN' ? 'Administrador' : ($type->name == 'READER' ? 'Leitor' : 'Usuário')) }}
                                </option>
                            @endforeach
                        </x-adminlte-select>
                        @error('user_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <x-adminlte-select name="active" label="{{ __('Status') }}" required>
                            <option value="" disabled selected>{{ __('Selecione o status') }}</option>
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('Ativo') }}</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>{{ __('Inativo') }}</option>
                        </x-adminlte-select>
                        @error('active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Botões -->
                <x-slot name="footerSlot">
                    <x-adminlte-button type="submit" theme="primary" label="{{ __('Criar Usuário') }}" icon="fas fa-save" />
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
                </x-slot>
            </form>
        </x-adminlte-card>
    </div>
@stop

@section('css')
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
        }

        .text-danger {
            font-size: 0.85rem;
        }
    </style>
@stop

@section('plugins.Bootstrap', true)
