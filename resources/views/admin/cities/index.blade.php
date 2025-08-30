@extends('adminlte::page')

@section('title', __('Cidades'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Cidades') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <x-adminlte-card title="{{ __('Lista de Cidades') }}" theme="primary" theme-mode="outline" collapsible>
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

            <div class="mb-3">
                <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Adicionar Nova Cidade') }}
                </a>
            </div>

            <table id="cities-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Nome') }}</th>
                        <th>{{ __('Código IBGE') }}</th>
                        <th>{{ __('Estado') }}</th>
                        <th>{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <td>{{ $city->id }}</td>
                            <td>{{ $city->name }}</td>
                            <td>{{ $city->ibge_code }}</td>
                            <td>{{ $city->state->name ?? __('N/A') }}</td>
                            <td>
                                <a href="{{ route('admin.cities.edit', $city) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('Editar') }}
                                </a>
                                <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('{{ __('Tem certeza que deseja excluir esta cidade? Esta ação não pode ser desfeita.') }}');">
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
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@stop

@section('plugins.Datatables', true)

@section('js')
<script>
    $(document).ready(function() {
        var table = $('#cities-table').DataTable({
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