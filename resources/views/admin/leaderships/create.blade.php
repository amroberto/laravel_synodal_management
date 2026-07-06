@extends('adminlte::page')

@php
use App\Enums\GenderEnum;
@endphp

@section('title', 'Nova Liderança')

@section('content_header')
<h1><i class="fas fa-users"></i> Criar Liderança</h1>
@endsection

@section('content')
@vite(['resources/js/app.js', 'resources/sass/app.scss'], 'http://laravel.test:5174')

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Nova Liderança</h3>
    </div>
    <form action="{{ route('admin.leaderships.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <!-- Dados Gerais -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="mr-2 fas fa-info-circle"></i>{{ __('Dados Gerais') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="has-feedback" error-key="name" igroup-size="sm" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('name') }}</x-slot>
                            </x-adminlte-input>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="rg" label="{{ __('RG') }}" fgroup-class="has-feedback" error-key="birthdate" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-badge"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('rg') }}</x-slot>
                            </x-adminlte-input>
                            @error('rg')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="cpf" label="{{ __('CPF') }}" fgroup-class="has-feedback" error-key="cpf" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('cpf') }}</x-slot>
                            </x-adminlte-input>
                            @error('cpf')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 col-md-2 col-sm-12">
                            <x-adminlte-input name="birthdate" label="{{ __('Data de Nascimento') }}" fgroup-class="has-feedback" error-key="birthdate" igroup-size="sm" type="date">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('birthdate') }}</x-slot>
                            </x-adminlte-input>
                            @error('birthdate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2 col-md-4 col-sm-12">
                            <x-adminlte-select name="community_id" label="{{ __('Comunidade') }}" fgroup-class="has-feedback" error-key="community_id" igroup-size="sm" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-church"></i>
                                    </div>
                                </x-slot>
                                <option value="">{{ __('Selecione a comunidade') }}</option>
                                @foreach($communities as $community)
                                <option value="{{ $community->id }}" {{ old('community_id') == $community->id ? 'selected' : '' }}>
                                    {{ $community->fantasy_name }}
                                </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="mb-2 col-md-4 col-sm-12">
                            <x-adminlte-select name="is_active" label="{{ __('Ativo') }}" fgroup-class="has-feedback" error-key="is_active" igroup-size="sm" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </x-slot>
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>{{ __('Sim') }}</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>{{ __('Não') }}</option>
                            </x-adminlte-select>
                        </div>
                        <div class="mb-2 col-md-4 col-sm-12">
                            <x-adminlte-select name="gender" label="{{ __('Gênero') }}" fgroup-class="has-feedback" error-key="gender" igroup-size="sm" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-venus-mars"></i>
                                    </div>
                                </x-slot>
                                <option value="male" {{ old('gender') == GenderEnum::MALE->value ? 'selected' : '' }}>{{ __('Masculino') }}</option>
                                <option value="female" {{ old('gender') == GenderEnum::FEMALE->value ? 'selected' : '' }}>{{ __('Feminino') }}</option>
                            </x-adminlte-select>
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="email" label="{{ __('Email') }}" fgroup-class="has-feedback" error-key="email" igroup-size="sm" type="email">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('email') }}</x-slot>
                            </x-adminlte-input>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="mobile" label="{{ __('Celular') }}" fgroup-class="has-feedback" error-key="mobile" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('mobile') }}</x-slot>
                            </x-adminlte-input>
                            @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="business_phone" label="{{ __('Telefone Comercial') }}" fgroup-class="has-feedback" error-key="business_phone" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('business_phone') }}</x-slot>
                            </x-adminlte-input>
                            @error('business_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="phone" label="{{ __('Telefone Residencial') }}" fgroup-class="has-feedback" error-key="phone" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="valueSlot">{{ old('phone') }}</x-slot>
                            </x-adminlte-input>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-adminlte-input-file name="photo" label="{{ __('Foto') }}" fgroup-class="has-feedback" error-key="photo" igroup-size="sm" accept="image/*">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>
                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Informações de Endereço -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="mr-2 fas fa-map-marker-alt"></i>{{ __('Informações de Endereço') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-2 col-sm-12">
                        <x-adminlte-input name="cep" label="{{ __('CEP') }}" fgroup-class="has-feedback" error-key="cep" igroup-size="sm">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-map-pin"></i>
                                </div>
                            </x-slot>
                            <x-slot name="valueSlot">{{ old('cep') }}</x-slot>
                        </x-adminlte-input>
                        @error('cep')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-5 col-sm-12">
                        <x-adminlte-input name="address" label="{{ __('Endereço') }}" fgroup-class="has-feedback" error-key="address" igroup-size="sm">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-road"></i>
                                </div>
                            </x-slot>
                            <x-slot name="valueSlot">{{ old('address') }}</x-slot>
                        </x-adminlte-input>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-2 col-sm-12">
                        <x-adminlte-input name="number" label="{{ __('Número') }}" fgroup-class="has-feedback" error-key="number" igroup-size="sm">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </div>
                            </x-slot>
                            <x-slot name="valueSlot">{{ old('number') }}</x-slot>
                        </x-adminlte-input>
                        @error('number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-3 col-sm-12">
                    <x-adminlte-input name="complement" label="{{ __('Complemento') }}" fgroup-class="has-feedback" error-key="complement" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-building"></i>
                            </div>
                        </x-slot>
                        <x-slot name="valueSlot">{{ old('complement') }}</x-slot>
                    </x-adminlte-input>
                    @error('complement')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-3 col-sm-12">
                    <x-adminlte-input name="district" label="{{ __('Bairro') }}" fgroup-class="has-feedback" error-key="district" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map"></i>
                            </div>
                        </x-slot>
                        <x-slot name="valueSlot">{{ old('district') }}</x-slot>
                    </x-adminlte-input>
                    @error('district')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-3 col-sm-12">
                    <x-adminlte-input name="city" label="{{ __('Cidade') }}" fgroup-class="has-feedback" error-key="city" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-city"></i>
                            </div>
                        </x-slot>
                        <x-slot name="valueSlot">{{ old('city') }}</x-slot>
                    </x-adminlte-input>
                    @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-3 col-sm-12">
                    <x-adminlte-input name="state" label="{{ __('Estado') }}" fgroup-class="has-feedback" error-key="state" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                        </x-slot>
                        <x-slot name="valueSlot">{{ old('state') }}</x-slot>
                    </x-adminlte-input>
                    @error('state')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
</div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Salvar
    </button>
    <a href="{{ route('admin.leaderships.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>
</form>
</div>
@endsection


@section('js')

@stop
