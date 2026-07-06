@extends('adminlte::page')

@section('title', 'Editar Comunidade')

@section('content_header')
<h1><i class="fas fa-users"></i> Editar Comunidade</h1>
@endsection

@section('content')
@vite(['resources/js/app.js', 'resources/sass/app.scss'], 'http://localhost:5174')

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ session('success') }}
</div>
@endif
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Editar Comunidade</h3>
    </div>
    <form action="{{ route('admin.communities.update', $community) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <!-- Dados Gerais -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="mr-2 fas fa-info-circle"></i>{{ __('Dados Gerais') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="cnpj" label="{{ __('CNPJ') }}" fgroup-class="has-feedback" id="cnpj" value="{{ old('cnpj', $community->cnpj) }}" error-key="cnpj" igroup-size="sm" placeholder="{{ __('Digite o CNPJ') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('cnpj')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-5 col-sm-12">
                            <x-adminlte-input name="corporate_name" label="{{ __('Razão Social') }}" id="corporate_name" value="{{ old('corporate_name', $community->corporate_name) }}" fgroup-class="has-feedback" error-key="corporate_name" igroup-size="sm" placeholder="{{ __('Digite a razão social') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('corporate_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="fantasy_name" label="{{ __('Nome Fantasia') }}" id="fantasy_name" value="{{ old('fantasy_name', $community->fantasy_name) }}" fgroup-class="has-feedback" error-key="fantasy_name" igroup-size="sm" placeholder="{{ __('Digite o nome fantasia') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('fantasy_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-sm-12">
                          <x-adminlte-select name="unity_type" id="unity_type" label="Tipo de Unidade" fgroup-class="has-feedback" error-key="unity_type" igroup-size="sm" enable-old-support>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-asterisk"></i>
                                    </div>
                                </x-slot>
                                <option value="">Selecione o tipo de unidade</option>
                                @foreach (\App\Enums\UnityTypeEnum::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('unity_type', $community->unity_type) === $status->value ? 'selected' : '' }}>
                                    {{ $status->getLabels()[$status->value] }}
                                </option>
                                @endforeach
                            </x-adminlte-select>
                            @error('unity_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="phone" label="{{ __('Telefone') }}" id="phone" value="{{ old('phone', $community->phone) }}" fgroup-class="has-feedback" error-key="phone" igroup-size="sm" placeholder="{{ __('Digite o telefone') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="mobile" label="{{ __('Celular') }}" id="mobile" value="{{ old('mobile', $community->mobile) }}" fgroup-class="has-feedback" error-key="mobile" igroup-size="sm" placeholder="{{ __('Digite o celular') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="email" label="{{ __('E-mail') }}" id="email" value="{{ old('email', $community->email) }}" fgroup-class="has-feedback" error-key="email" igroup-size="sm" placeholder="{{ __('Digite o e-mail') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-sm-12">
                            <x-adminlte-input name="website" label="{{ __('Website') }}" id="website" value="{{ old('website', $community->website) }}" fgroup-class="has-feedback" error-key="website" igroup-size="sm" placeholder="{{ __('Digite o website') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informações de Endereço -->
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="mr-2 fas fa-map-marker-alt"></i>{{ __('Informações de Endereço') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="cep" label="{{ __('CEP') }}" id="cep" value="{{ old('cep', $community->cep) }}" fgroup-class="has-feedback" error-key="cep" igroup-size="sm" placeholder="{{ __('Digite o CEP') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-map-pin"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('cep')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-adminlte-input name="address" label="{{ __('Endereço') }}" id="address" value="{{ old('address', $community->address) }}" fgroup-class="has-feedback" error-key="address" igroup-size="sm" placeholder="{{ __('Digite o endereço') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-road"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="number" label="{{ __('Número') }}" id="number" value="{{ old('number', $community->number) }}" fgroup-class="has-feedback" error-key="number" igroup-size="sm" placeholder="{{ __('Digite o número') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-home"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="complement" label="{{ __('Complemento') }}" id="complement" value="{{ old('complement', $community->complement) }}" fgroup-class="has-feedback" error-key="complement" igroup-size="sm" placeholder="{{ __('Digite o complemento') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('complement')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="district" label="{{ __('Bairro') }}" id="district" value="{{ old('district', $community->district) }}" fgroup-class="has-feedback" error-key="district" igroup-size="sm" placeholder="{{ __('Digite o bairro') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-map"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('district')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="city" label="{{ __('Cidade') }}" id="city" value="{{ old('city', $community->city) }}" fgroup-class="has-feedback" error-key="city" igroup-size="sm" placeholder="{{ __('Digite a cidade') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-city"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12">
                            <x-adminlte-input name="state" label="{{ __('Estado') }}" id="state" value="{{ old('state', $community->state) }}" fgroup-class="has-feedback" error-key="state" igroup-size="sm" placeholder="{{ __('Digite o estado') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lideranças -->
            <x-community-leadership-table :community="$community" />
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
