@extends('adminlte::page')

@section('title', 'Nova Comunidade')

@section('content_header')
<h1><i class="fas fa-users"></i> Criar Comunidade</h1>
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
        <h3 class="card-title">Nova Comunidade</h3>
    </div>
    <form action="{{ route('admin.communities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <!-- Dados Gerais -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="mr-2 fas fa-info-circle"></i>{{ __('Dados Gerais') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3 col-sm-12">
                            <label class="form-label" for="cnpj">{{ __('CNPJ') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" placeholder="{{ __('Digite o CNPJ') }}">
                            </div>
                            @error('cnpj')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-5 col-sm-12">
                            <label class="form-label">{{ __('Razão Social') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                <input type="text" class="form-control @error('corporate_name') is-invalid @enderror" id="corporate_name" name="corporate_name" value="{{ old('corporate_name') }}" required>
                            </div>
                            @error('corporate_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <label class="form-label">{{ __('Nome Fantasia') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                <input type="text" class="form-control @error('fantasy_name') is-invalid @enderror" id="fantasy_name" name="fantasy_name" value="{{ old('fantasy_name') }}">
                            </div>
                            @error('fantasy_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-select name="unity_type" label="{{ __('Tipo de Unidade') }}" fgroup-class="has-feedback" error-key="unity_type" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-asterisk"></i>
                                    </div>
                                </x-slot>
                                <option value="">{{ __('Selecione o tipo de unidade') }}</option>
                                @foreach (\App\Enums\UnityTypeEnum::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('unity_type') == $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <label class="form-label">{{ __('Telefone') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="{{ __('Digite o telefone') }}">
                            </div>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <label class="form-label">{{ __('Celular') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="{{ __('Digite o celular') }}">
                            </div>
                            @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-sm-12">
                            <label class="form-label">{{ __('E-mail') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Digite o e-mail') }}">
                            </div>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <label class="form-label">{{ __('Website') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="{{ __('Digite o website') }}">
                            </div>
                            @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                        <div class="mb-3 col-md-3 col-sm-12">
                            <label class="form-label">{{ __('CEP') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" value="{{ old('cep') }}" placeholder="{{ __('Digite o CEP') }}">
                            </div>
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label class="form-label">{{ __('Endereço') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-road"></i></span>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" placeholder="{{ __('Digite o endereço') }}">
                            </div>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <label class="form-label">{{ __('Número') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}" placeholder="{{ __('Digite o número') }}">
                            </div>
                            @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-3 col-sm-12">
                            <label class="form-label">{{ __('Complemento') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                <input type="text" class="form-control @error('complement') is-invalid @enderror" id="complement" name="complement" value="{{ old('complement') }}" placeholder="{{ __('Digite o complemento') }}">
                            </div>
                            @error('complement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <label class="form-label">{{ __('Bairro') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map"></i></span>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district') }}" placeholder="{{ __('Digite o bairro') }}">
                            </div>
                            @error('district')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <label class="form-label">{{ __('Cidade') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-city"></i></span>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" placeholder="{{ __('Digite a cidade') }}">
                            </div>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <label class="form-label">{{ __('Estado') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}" placeholder="{{ __('Digite o estado') }}">
                            </div>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lideranças -->
            <x-community-leadership-table />
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Salvar
            </button>
            <a href="{{ route('admin.communities.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </form>
</div>
@endsection


@section('js')

@stop
