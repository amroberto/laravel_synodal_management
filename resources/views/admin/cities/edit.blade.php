@extends('adminlte::page')

@section('title', __('Cidades'))

@section('content_header')
<h1>{{ __('Editar Cidade') }}</h1>
@stop

@section('content')
<form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="mr-2 fas fa-city"></i>{{ __('Editar Cidade') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-6 col-md-6 col-sm-12">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $city->name) }}" required>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="text-danger small" />
                </div>
                <div class="mb-3 col-md-3 col-sm-12">
                    <label for="ibge_code" class="form-label">{{ __('Código IBGE') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-code"></i></span>
                        <input type="text" class="form-control" id="ibge_code" name="ibge_code" value="{{ old('ibge_code', $city->ibge_code) }}" required>
                    </div>
                    <x-input-error :messages="$errors->get('abbreviation')" class="text-danger small" />
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="country_id" class="form-label">{{ __('State') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                        <select id="country_id" name="country_id" class="form-control">
                            @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ (old('state_id', $city->state_id) == $state->id) ? 'selected' : '' }}>
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
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
