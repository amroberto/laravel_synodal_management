@extends('adminlte::page')

@section('title', __('Editar Estado'))

@section('content_header')
<h1>{{ __('Editar Estado') }}</h1>
@stop

@section('content')
<form action="{{ route('admin.states.update', $state->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="mr-2 fas fa-user"></i>{{ __('Editar Estado') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-6 col-md-6 col-sm-12">
                    <label for="name" class="form-label">{{ __('Nome Completo') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $state->name) }}" required>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="text-danger small" />
                </div>
                <div class="mb-3 col-md-3 col-sm-12">
                    <label for="name" class="form-label">{{ __('UF') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map"></i></span>
                        <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{ old('abbreviation', $state->abbreviation) }}" required>
                    </div>
                    <x-input-error :messages="$errors->get('abbreviation')" class="text-danger small" />
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="country_id" class="form-label">{{ __('País') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        <select id="country_id" name="country_id" class="form-control">
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ (old('country_id', $state->country_id) == $country->id) ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('country_id')" class="text-danger small" />
                </div>
            </div>
        </div>
    </div>
    <!-- Botões -->
    <div class="card card-outline">
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="mr-1 fas fa-save"></i> {{ __('Salvar') }}</button>
            <a href="{{ route('admin.states.index') }}" class="btn btn-secondary"><i class="mr-1 fas fa-arrow-left"></i> {{ __('Voltar') }}</a>
        </div>
    </div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
