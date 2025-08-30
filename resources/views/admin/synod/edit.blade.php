@extends('adminlte::page')

@section('title', __('Editar Sinodo'))

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"><i class="mr-2 fas fa-building"></i>{{ __('Editar Sinodo') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mr-1 fas fa-tachometer-alt"></i>{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><i class="mr-1 fas fa-cog"></i>{{ __('Configurações') }}</li>
                <li class="breadcrumb-item active"><i class="mr-1 fas fa-building"></i>{{ __('Sinodo') }}</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
@if (session('success'))
<x-adminlte-alert theme="success" title="{{ __('Sucesso') }}" icon="fas fa-check-circle" dismissable>
    {{ session('success') }}
</x-adminlte-alert>
@endif

@if ($errors->any())
<x-adminlte-alert theme="danger" title="{{ __('Erros de Validação') }}" icon="fas fa-exclamation-triangle" dismissable>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</x-adminlte-alert>
@endif

<x-adminlte-card title="{{ __('Dados do Sínodo') }}" theme="primary" icon="fas fa-building" collapsible>
    <form action="{{ route('admin.synod.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="corporate_name" label="{{ __('Razão Social') }}" value="{{ old('corporate_name', $synod->corporate_name) }}" required fgroup-class="has-feedback" error-key="corporate_name" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-building"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-6">
                <x-adminlte-input name="trade_name" label="{{ __('Nome Fantasia') }}" value="{{ old('trade_name', $synod->trade_name) }}" required fgroup-class="has-feedback" error-key="trade_name" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-store"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <x-adminlte-input name="cnpj" label="{{ __('CNPJ') }}" value="{{ old('cnpj', $synod->cnpj) }}" required fgroup-class="has-feedback" error-key="cnpj" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-4">
                <x-adminlte-input name="email" label="{{ __('E-mail') }}" type="email" value="{{ old('email', $synod->email) }}" fgroup-class="has-feedback" error-key="email" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-4">
                <x-adminlte-input name="website" label="{{ __('Website') }}" type="url" value="{{ old('website', $synod->website) }}" fgroup-class="has-feedback" error-key="website" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-globe"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="phone" label="{{ __('Telefone') }}" value="{{ old('phone', $synod->phone) }}" fgroup-class="has-feedback" error-key="phone" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-6">
                <x-adminlte-input name="cellphone" label="{{ __('Celular/WhatsApp') }}" value="{{ old('cellphone', $synod->cellphone) }}" fgroup-class="has-feedback" error-key="cellphone" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <x-adminlte-input name="cep" label="{{ __('CEP') }}" value="{{ old('cep', $synod->cep) }}" fgroup-class="has-feedback" error-key="cep" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-8">
                <x-adminlte-input name="address" label="{{ __('Endereço') }}" value="{{ old('address', $synod->address) }}" fgroup-class="has-feedback" error-key="address" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-road"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-2">
                <x-adminlte-input name="number" label="{{ __('Número') }}" value="{{ old('number', $synod->number) }}" fgroup-class="has-feedback" error-key="number" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-home"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <x-adminlte-input name="complement" label="{{ __('Complemento') }}" value="{{ old('complement', $synod->complement) }}" fgroup-class="has-feedback" error-key="complement" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-3">
                <x-adminlte-input name="district" label="{{ __('Bairro') }}" value="{{ old('district', $synod->district) }}" fgroup-class="has-feedback" error-key="district" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-map"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-4">
                <x-adminlte-input name="city" label="{{ __('Cidade') }}" value="{{ old('city', $synod->city) }}" fgroup-class="has-feedback" error-key="city" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-city"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-2">
                <x-adminlte-input name="state" label="{{ __('Estado') }}" value="{{ old('state', $synod->state) }}" fgroup-class="has-feedback" error-key="state" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-flag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><i class="mr-1 fas fa-image"></i>{{ __('Logo Atual') }}</label>
                    @if ($synod->logo && Storage::disk('public')->exists($synod->logo))
                    <div class="mb-3 card card-light card-outline">
                        <div class="text-center card-body">
                            <img src="{{ Storage::url($synod->logo) }}" alt="Logo da União Paroquial" class="rounded shadow-sm img-fluid" style="max-width: 200px; max-height: 200px; object-fit: contain;">
                        </div>
                    </div>
                    @else
                    <p class="text-muted"><i class="mr-1 fas fa-info-circle"></i>{{ __('Nenhuma logo carregada ou arquivo não encontrado') }}</p>
                    @endif
                    <x-adminlte-input name="logo" label="{{ __('Nova Logo') }}" type="file" accept="image/*" fgroup-class="has-feedback" error-key="logo" igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('Salvar') }}" icon="fas fa-save" class="btn-lg" />
            </div>
        </div>
    </form>
</x-adminlte-card>
@endsection

@section('css')
<style>
    .card {
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-check {
        margin-bottom: 0.5rem;
    }

</style>
@stop

@section('js')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        // Máscaras
        $('#cnpj').mask('00.000.000/0000-00');
        $('#rg').mask('00.000.000-0');
        $('#phone').mask('(00) 0000-0000');
        $('#cellphone').mask('(00) 00000-0000');
        $('#cep').mask('00000-000');
        $('#amount').mask('000.000,00', {
            reverse: true
        });

        // Validação do CPF
        $('#cpf').on('blur', function() {
            const cpf = $(this).val().replace(/\D/g, '');
            if (cpf.length !== 11) {
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
                $(this).after('<div class="invalid-feedback">O CPF deve ter 11 dígitos.</div>');
            } else {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        // ViaCEP
        $('#cep').on('blur', function() {
            const cep = $(this).val().replace(/\D/g, '');
            if (cep.length === 8) {
                $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                    if (!data.erro) {
                        $('#address').val(data.logradouro);
                        $('#district').val(data.bairro);
                        $('#city').val(data.localidade);
                        $('#state').val(data.uf);
                        $('#cep').removeClass('is-invalid');
                    } else {
                        $('#cep').addClass('is-invalid');
                        $('#cep').next('.invalid-feedback').remove();
                        $('#cep').after('<div class="invalid-feedback">CEP inválido.</div>');
                    }
                }).fail(function() {
                    $('#cep').addClass('is-invalid');
                    $('#cep').next('.invalid-feedback').remove();
                    $('#cep').after('<div class="invalid-feedback">Erro ao consultar CEP.</div>');
                });
            } else {
                $('#cep').addClass('is-invalid');
                $('#cep').next('.invalid-feedback').remove();
                $('#cep').after('<div class="invalid-feedback">CEP deve ter 8 dígitos.</div>');
            }
        });

        // Normalizar campos antes do envio
        $('form').on('submit', function() {
            $('#cpf').val($('#cpf').val().replace(/\D/g, ''));
            $('#rg').val($('#rg').val().replace(/\D/g, ''));
            $('#phone').val($('#phone').val().replace(/\D/g, ''));
            $('#cellphone').val($('#cellphone').val().replace(/\D/g, ''));
            $('#cep').val($('#cep').val().replace(/\D/g, ''));
            $('#amount').val($('#amount').val().replace(/\D/g, '').replace(',', '.'));
        });
    });

</script>
@stop
