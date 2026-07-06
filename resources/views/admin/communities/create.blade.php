@extends('adminlte::page')

@section('title', 'Cadastrar Comunidade')

@section('content_header')
    <h1 class="m-0">Cadastrar Comunidade</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-church"></i> Nova Comunidade
                </h3>
            </div>

            <form action="{{ route('admin.communities.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <!-- CNPJ -->
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" name="cnpj" id="cnpj"
                                   class="form-control @error('cnpj') is-invalid @enderror"
                                   placeholder="12.345.678/0001-90"
                                   value="{{ old('cnpj') }}"
                                   maxlength="18">
                        </div>
                        @error('cnpj')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Razão Social -->
                    <div class="form-group">
                        <label for="corporate_name">Razão Social <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                            </div>
                            <input type="text" name="corporate_name" id="corporate_name"
                                   class="form-control @error('corporate_name') is-invalid @enderror"
                                   value="{{ old('corporate_name') }}" required>
                        </div>
                        @error('corporate_name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nome Fantasia -->
                    <div class="form-group">
                        <label for="fantasy_name">Nome Fantasia</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-church"></i></span>
                            </div>
                            <input type="text" name="fantasy_name" id="fantasy_name"
                                   class="form-control @error('fantasy_name') is-invalid @enderror"
                                   value="{{ old('fantasy_name') }}">
                        </div>
                        @error('fantasy_name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tipo de Unidade (com UnityTypeEnum) -->
                    <div class="form-group">
                        <label for="unity_type">Tipo de Unidade <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <select name="unity_type" id="unity_type"
                                    class="form-control @error('unity_type') is-invalid @enderror" required>
                                <option value="">Selecione o tipo...</option>
                                @foreach (\App\Enums\UnityTypeEnum::cases() as $case)
                                    <option value="{{ $case->value }}"
                                        {{ old('unity_type') == $case->value ? 'selected' : '' }}>
                                        {{ $case->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('unity_type')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Telefone e Celular -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Telefone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           placeholder="(11) 2233-6655"
                                           value="{{ old('phone') }}"
                                           maxlength="15">
                                </div>
                                @error('phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Celular</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    </div>
                                    <input type="text" name="mobile" id="mobile"
                                           class="form-control @error('mobile') is-invalid @enderror"
                                           placeholder="(11) 98855-4444"
                                           value="{{ old('mobile') }}"
                                           maxlength="15">
                                </div>
                                @error('mobile')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Email e Site -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website">Site</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    </div>
                                    <input type="url" name="website" id="website"
                                           class="form-control @error('website') is-invalid @enderror"
                                           placeholder="https://exemplo.com"
                                           value="{{ old('website') }}">
                                </div>
                                @error('website')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- CEP com ViaCEP -->
                    <div class="form-group">
                        <label for="cep">CEP <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                            </div>
                            <input type="text" id="cep" name="cep"
                                   class="form-control @error('cep') is-invalid @enderror"
                                   placeholder="01042-001"
                                   value="{{ old('cep') }}"
                                   maxlength="9">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i id="cep-loading" class="fas fa-spinner fa-spin" style="display:none;"></i>
                                </span>
                            </div>
                        </div>
                        <small id="cep-error" class="text-danger" style="display:none;"></small>
                        @error('cep')
                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Endereço, Número -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input type="text" id="address" name="address"
                                       class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address') }}">
                                @error('address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="number">Número</label>
                                <input type="text" name="number" id="number"
                                       class="form-control @error('number') is-invalid @enderror"
                                       value="{{ old('number') }}">
                                @error('number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Complemento, Bairro, Cidade -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="complement">Complemento</label>
                                <input type="text" name="complement" id="complement"
                                       class="form-control @error('complement') is-invalid @enderror"
                                       value="{{ old('complement') }}">
                                @error('complement')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="district">Bairro</label>
                                <input type="text" id="district" name="district"
                                       class="form-control @error('district') is-invalid @enderror"
                                       value="{{ old('district') }}">
                                @error('district')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input type="text" id="city" name="city"
                                       class="form-control @error('city') is-invalid @enderror"
                                       value="{{ old('city') }}">
                                @error('city')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <input type="text" id="state" name="state"
                                       class="form-control @error('state') is-invalid @enderror"
                                       value="{{ old('state') }}" readonly>
                                @error('state')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('admin.communities.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                    <button type="submit" class="float-right btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Comunidade
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    <!-- Opcional: Máscaras com InputMask -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/inputmask/min/inputmask.min.css') }}">
@stop

@section('js')
<script src="{{ asset('vendor/adminlte/plugins/inputmask/min/jquery.inputmask.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Máscaras
    $('#cnpj').inputmask('99.999.999/9999-99');
    $('#phone').inputmask('(99) 9999-9999');
    $('#mobile').inputmask('(99) 99999-9999');
    $('#cep').inputmask('99999-999');

    const cepInput = document.getElementById('cep');
    const loading = document.getElementById('cep-loading');
    const errorEl = document.getElementById('cep-error');

    cepInput.addEventListener('blur', function () {
        const cep = cepInput.value.replace(/\D/g, '');
        if (cep.length !== 8) return;

        loading.style.display = 'inline-block';
        errorEl.style.display = 'none';
        errorEl.textContent = '';

        fetch('{{ route('viacep.consulta') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ cep })
        })
        .then(r => r.json())
        .then(data => {
            loading.style.display = 'none';
            if (data.erro) {
                errorEl.textContent = data.message;
                errorEl.style.display = 'block';
                limparEndereco();
                return;
            }

            document.getElementById('address').value = data.logradouro || '';
            document.getElementById('district').value = data.bairro || '';
            document.getElementById('city').value = data.localidade || '';
            document.getElementById('state').value = data.uf || '';
        })
        .catch(() => {
            loading.style.display = 'none';
            errorEl.textContent = 'Erro ao consultar o CEP.';
            errorEl.style.display = 'block';
            limparEndereco();
        });
    });

    function limparEndereco() {
        ['address', 'district', 'city', 'state'].forEach(id => {
            document.getElementById(id).value = '';
        });
    }
});
</script>
@stop