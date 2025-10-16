@extends('adminlte::page')

@section('title', 'Editar Comunidade')

@section('content_header')
    <h1><i class="fas fa-users"></i> Editar Comunidade</h1>
@endsection

@section('content')
    @vite(['resources/js/app.js', 'resources/sass/app.scss']) <!-- Carrega assets do Vite -->

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
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>{{ __('Dados Gerais') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mb-3">
                                <label class="form-label">{{ __('CNPJ') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj" value="{{ old('cnpj', $community->document) }}" placeholder="{{ __('Digite o CNPJ') }}">
                                </div>
                                @error('cnpj')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Razão Social') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    <input type="text" class="form-control @error('corporate_name') is-invalid @enderror" id="corporate_name" name="corporate_name" value="{{ old('corporate_name', $community->corporate_name) }}" required>
                                </div>
                                @error('corporate_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Nome Fantasia') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    <input type="text" class="form-control @error('fantasy_name') is-invalid @enderror" id="fantasy_name" name="fantasy_name" value="{{ old('fantasy_name', $community->fantasy_name) }}">
                                </div>
                                @error('fantasy_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-3">
                                <x-adminlte-select name="unity_type" label="{{ __('Tipo de Unidade') }}" fgroup-class="has-feedback" error-key="unity_type" igroup-size="sm">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-asterisk"></i>
                                        </div>
                                    </x-slot>
                                    <option value="">{{ __('Selecione o tipo de unidade') }}</option>
                                    @foreach (\App\Enums\UnityTypeEnum::cases() as $status)
                                        <option value="{{ $status->value }}" {{ old('unity_type', $community->unity_type) == $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Telefone') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $community->phone) }}" placeholder="{{ __('Digite o telefone') }}">
                                </div>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Celular') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile', $community->mobile) }}" placeholder="{{ __('Digite o celular') }}">
                                </div>
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-3">
                                <label class="form-label">{{ __('E-mail') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $community->email) }}" placeholder="{{ __('Digite o e-mail') }}">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Website') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $community->website) }}" placeholder="{{ __('Digite o website') }}">
                                </div>
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
                        <h3 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i>{{ __('Informações de Endereço') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mb-3">
                                <label class="form-label">{{ __('CEP') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                    <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" value="{{ old('cep', $community->address->postal_code ?? '') }}" placeholder="{{ __('Digite o CEP') }}">
                                </div>
                                @error('cep')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Endereço') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-road"></i></span>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $community->address->street ?? '') }}" placeholder="{{ __('Digite o endereço') }}">
                                </div>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Número') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $community->address->address_number ?? '') }}" placeholder="{{ __('Digite o número') }}">
                                </div>
                                @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Complemento') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    <input type="text" class="form-control @error('complement') is-invalid @enderror" id="complement" name="complement" value="{{ old('complement', $community->address->complement ?? '') }}" placeholder="{{ __('Digite o complemento') }}">
                                </div>
                                @error('complement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Bairro') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map"></i></span>
                                    <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district', $community->address->neighborhood ?? '') }}" placeholder="{{ __('Digite o bairro') }}">
                                </div>
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Estado (UF)') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                    <select class="form-control @error('state_id') is-invalid @enderror" id="state_id" name="state_id">
                                        <option value="">{{ __('Selecione o estado') }}</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state_id', $community->address->city->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                                {{ $state->abbreviation }} - {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 col-sm-12 mb-3">
                                <label class="form-label">{{ __('Cidade') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id">
                                        <option value="">{{ __('Selecione o estado antes') }}</option>
                                        @if(old('state_id', $community->address->city_id ?? ''))
                                            @foreach(\App\Models\City::where('state_id', old('state_id', $community->address->city->state_id ?? ''))->get() as $city)
                                                <option value="{{ $city->id }}" {{ old('city_id', $community->address->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('city_id')
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
    <script>
        $(document).ready(function() {
            // Depuração: Verificar se jQuery e máscaras estão carregados
            console.log('jQuery carregado:', typeof $ !== 'undefined');
            console.log('jquery.mask carregado:', typeof $.fn.mask !== 'undefined');

            // Aplicar máscaras
            try {
                $('#cnpj').mask('00.000.000/0000-00');
                $('#cep').mask('00000-000');
                $('#phone').mask('(00) 0000-0000');
                $('#mobile').mask('(00) 00000-0000');
                console.log('Máscaras aplicadas com sucesso');
            } catch (e) {
                console.error('Erro ao aplicar máscaras:', e);
            }

            // Configurar CSRF para requisições AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Consultar CNPJ
            $('#cnpj').on('blur', function() {
                let cnpj = $(this).val().replace(/\D/g, '');
                console.log('Consultando CNPJ:', cnpj);
                if (cnpj.length !== 14) {
                    console.warn('CNPJ inválido (menos de 14 dígitos)');
                    return;
                }
                $.ajax({
                    url: '{{ route('cnpj.lookup') }}',
                    type: 'GET',
                    data: { cnpj: cnpj },
                    dataType: 'json',
                    success: function(data) {
                        console.log('Resposta CNPJ:', data);
                        if (data.error) {
                            alert('Erro: ' + data.error);
                            return;
                        }
                        $('#corporate_name').val(data.corporate_name || '');
                        $('#fantasy_name').val(data.fantasy_name || '');
                        $('#email').val(data.email || '');
                        $('#phone').val(data.phone || '');
                        $('#cep').val(data.cep || '');
                        $('#address').val(data.address || '');
                        $('#district').val(data.district || '');
                        $('#number').val(data.number || '');
                        $('#complement').val(data.complement || '');
                        if (data.state_id) {
                            $('#state_id').val(data.state_id).trigger('change');
                            if (data.city_id) {
                                setTimeout(() => {
                                    $('#city_id').val(data.city_id);
                                    console.log('Cidade definida:', data.city_id);
                                }, 500); // Aguarda carregamento de cidades
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error('Erro ao consultar CNPJ:', xhr.responseJSON?.error || xhr.statusText);
                        alert('Erro ao consultar CNPJ: ' + (xhr.responseJSON?.error || 'Falha na requisição'));
                    }
                });
            });

            // Consultar CEP
            $('#cep').on('blur', function() {
                let cep = $(this).val().replace(/\D/g, '');
                console.log('Consultando CEP:', cep);
                if (cep.length !== 8) {
                    console.warn('CEP inválido (menos de 8 dígitos)');
                    return;
                }
                $.ajax({
                    url: '{{ route('cep.lookup') }}',
                    type: 'GET',
                    data: { cep: cep },
                    dataType: 'json',
                    success: function(data) {
                        console.log('Resposta CEP:', data);
                        if (data.error) {
                            alert('Erro: ' + data.error);
                            return;
                        }
                        $('#address').val(data.address || '');
                        $('#district').val(data.district || '');
                        $('#complement').val(data.complement || '');
                        if (data.state_id) {
                            $('#state_id').val(data.state_id).trigger('change');
                            if (data.city_id) {
                                setTimeout(() => {
                                    $('#city_id').val(data.city_id);
                                    console.log('Cidade definida:', data.city_id);
                                }, 500); // Aguarda carregamento de cidades
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error('Erro ao consultar CEP:', xhr.responseJSON?.error || xhr.statusText);
                        alert('Erro ao consultar CEP: ' + (xhr.responseJSON?.error || 'Falha na requisição'));
                    }
                });
            });

            // Carregar cidades ao mudar estado
            $('#state_id').on('change', function() {
                let stateId = $(this).val();
                console.log('Estado selecionado:', stateId);
                $('#city_id').empty().append('<option value="">Selecione a cidade</option>');
                if (stateId) {
                    $.ajax({
                        url: '{{ route('states.cities', ['state_id' => ':stateId']) }}'.replace(':stateId', stateId),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log('Cidades carregadas:', data);
                            $.each(data, function(index, city) {
                                $('#city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                            // Reaplicar city_id para modo edição
                            let initialCityId = '{{ old('city_id', $community->address->city_id ?? '') }}';
                            if (initialCityId) {
                                $('#city_id').val(initialCityId);
                            }
                        },
                        error: function(xhr) {
                            console.error('Erro ao carregar cidades:', xhr.responseJSON?.error || xhr.statusText);
                            $('#city_id').append('<option value="">Erro ao carregar cidades</option>');
                        }
                    });
                }
            });

            // Carregar cidades iniciais para modo edição
            let initialStateId = '{{ old('state_id', $community->address->city->state_id ?? '') }}';
            if (initialStateId) {
                $('#state_id').val(initialStateId).trigger('change');
            }
        });
    </script>
@endsection