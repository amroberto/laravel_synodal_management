@extends('adminlte::page')

@section('title', __('Comunidades'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Comunidades') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <x-adminlte-card title="{{ __('Lista de Comunidades') }}" theme="primary" theme-mode="outline" collapsible>
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
                <a href="{{ route('admin.communities.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Adicionar Nova Comunidade') }}
                </a>
            </div>

            <table id="communities-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Nome Fantasia') }}</th>
                        <th>{{ __('Telefone') }}</th>
                        <th>{{ __('Celular') }}</th>
                        <th>{{ __('E-mail') }}</th>
                        <th>{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($communities as $community)
                        <tr>
                            <td>{{ $community->id }}</td>
                            <td>{{ $community->trade_name }}</td>
                            <td>{{ $community->comercial_phone }}</td>
                            <td>{{ $community->mobile }}</td>
                            <td>{{ $community->email }}</td>
                            <td>
                                <a href="{{ route('admin.community.edit', $community) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('Editar') }}
                                </a>
                                <form action="{{ route('admin.community.destroy', $community) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('{{ __('Tem certeza que deseja excluir esta comunidade? Esta ação não pode ser desfeita.') }}');">
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
        var table = $('#communities-table').DataTable({
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