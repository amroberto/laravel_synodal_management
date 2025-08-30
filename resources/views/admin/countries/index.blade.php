@extends('adminlte::page')

@section('title', __('Países'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('Países') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Países') }}</li>
        </ol>
    </nav>
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
    <x-adminlte-card>
        <div class="mb-3">
            <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> {{ __('Adicionar Novo País') }}
            </a>
        </div>
        <table id="countries-table" class="table table-bordered table-hover w-100">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Nome') }}</th>
                    <th>{{ __('Código') }}</th>
                    <th>{{ __('Ações') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{ $country->id }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->code }}</td>
                        <td>
                                <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('Editar') }}
                                </a>
                                <form action="{{ route('admin.countries.destroy', $country) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('{{ __('Tem certeza que deseja excluir este País? Esta ação não pode ser desfeita.') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> {{ __('Excluir') }}
                                    </button>
                                </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-adminlte-card>
</div>
@stop

@section('plugins.Datatables', true)

@section('js')
<script>
    $(document).ready(function() {
        var table = $('#countries-table').DataTable({
            language: {
                emptyTable: "Nenhum registro encontrado"
                , info: "Mostrando de _START_ até _END_ de _TOTAL_ registros"
                , infoEmpty: "Mostrando 0 até 0 de 0 registros"
                , infoFiltered: "(Filtrados de _MAX_ registros)"
                , lengthMenu: "Mostrar _MENU_ registros"
                , loadingRecords: "Carregando..."
                , processing: "Processando..."
                , search: "Pesquisar"
                , zeroRecords: "Nenhum registro encontrado"
                , paginate: {
                    next: "Próximo"
                    , previous: "Anterior"
                }
            }
            , autoWidth: false,
            responsive: true,
        });

        // Ajusta as colunas após a inicialização
        table.columns.adjust().draw();
    });

</script>
@stop

@section('css')
    <style>
        .card {
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@stop