@extends('adminlte::page')

@section('title', __('Usuários'))

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Usuários') }}</li>
    </ol>
</nav>
@stop

@section('content')
<div class="container-fluid">
    <x-adminlte-card title="{{ __('Lista de Usuários') }}" theme="secondary" theme-mode="outline" collapsible maximizable>

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

        <!-- Botão de Adicionar --> 
        <div class="mb-3">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> {{ __('Adicionar Usuário') }}
            </a>
        </div>

        <!-- Tabela -->
        <div class="table-responsive">
            <table id="users" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">{{ __('ID') }}</th>
                        <th scope="col">{{ __('Nome') }}</th>
                        <th scope="col">{{ __('E-mail') }}</th>
                        <th scope="col">{{ __('Tipo de Usuário') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email ?? '-' }}</td>
                        <td>
                            @switch($user->user_type->value)
                            @case(\App\Enums\UserTypeEnum::ADMIN->value)
                            <span class="badge bg-success">{{ __('Administrador') }}</span>
                            @break
                            @case(\App\Enums\UserTypeEnum::READER->value)
                            <span class="badge bg-warning text-dark">{{ __('Leitor') }}</span>
                            @break
                            @case(\App\Enums\UserTypeEnum::USER->value)
                            <span class="badge bg-primary">{{ __('Usuário') }}</span>
                            @break
                            @default
                            <span class="badge bg-secondary">{{ __('Desconhecido') }}</span>
                            @endswitch
                        </td>
                        <td>
                            <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->is_active ? __('Ativo') : __('Inativo') }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-info btn-xs" title="{{ __('Editar Usuário') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-xs" title="{{ __('Excluir Usuário') }}" data-toggle="modal" data-target="#deleteModal-{{ $user->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button type="button" class="btn btn-xs {{ $user->is_active ? 'btn-warning' : 'btn-success' }}" title="{{ $user->is_active ? __('Desativar Usuário') : __('Ativar Usuário') }}" data-toggle="modal" data-target="#toggleActiveModal-{{ $user->id }}">
                                <i class="fas {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                            </button>

                            <!-- Modal de Confirmação de Exclusão -->
                            <x-adminlte-modal id="deleteModal-{{ $user->id }}" title="{{ __('Confirmar Exclusão') }}" theme="danger" icon="fas fa-trash" size="sm">
                                <p>{{ __('Tem certeza que deseja excluir o usuário') }} <strong>{{ $user->name }}</strong>?</p>
                                <x-slot name="footerSlot">
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-adminlte-button type="submit" theme="danger" label="{{ __('Excluir') }}" />
                                    </form>
                                    <x-adminlte-button theme="secondary" label="{{ __('Cancelar') }}" data-dismiss="modal" />
                                </x-slot>
                            </x-adminlte-modal>

                            <!-- Modal de Confirmação de Ativação/Desativação -->
                            <x-adminlte-modal id="toggleActiveModal-{{ $user->id }}" title="{{ $user->is_active ? __('Desativar Usuário') : __('Ativar Usuário') }}" theme="{{ $user->is_active ? 'warning' : 'success' }}" icon="fas {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }}" size="sm">
                                <p>{{ $user->is_active ? __('Tem certeza que deseja desativar o usuário') : __('Tem certeza que deseja ativar o usuário') }} <strong>{{ $user->name }}</strong>?</p>
                                <x-slot name="footerSlot">
                                    <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <x-adminlte-button type="submit" theme="{{ $user->is_active ? 'warning' : 'success' }}" label="{{ $user->is_active ? __('Desativar') : __('Ativar') }}" />
                                    </form>
                                    <x-adminlte-button theme="secondary" label="{{ __('Cancelar') }}" data-dismiss="modal" />
                                </x-slot>
                            </x-adminlte-modal>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('Nenhum usuário encontrado') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-adminlte-card>
</div>
@stop

@section('css')
<style>
    .table {
        width: 100%;
        margin-bottom: 0;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.4em 0.6em;
    }

    .btn-xs i {
        font-size: 0.85rem;
    }

    /* Garantir visibilidade do botão */
    #create-user-btn {
        display: inline-block !important;
        visibility: visible !important;
    }

</style>
@stop

@section('plugins.Datatables', true)
@section('plugins.Bootstrap', true)

@section('js')
<script>
    $(document).ready(function() {
        $('#users').DataTable({
            language: {
                emptyTable: "{{ __('Nenhum registro encontrado') }}"
                , info: "{{ __('Mostrando de _START_ até _END_ de _TOTAL_ registros') }}"
                , infoEmpty: "{{ __('Mostrando 0 até 0 de 0 registros') }}"
                , infoFiltered: "{{ __('(Filtrados de _MAX_ registros)') }}"
                , lengthMenu: "{{ __('Mostrar _MENU_ registros') }}"
                , loadingRecords: "{{ __('Carregando...') }}"
                , processing: "{{ __('Processando...') }}"
                , search: "{{ __('Pesquisar') }}"
                , zeroRecords: "{{ __('Nenhum registro encontrado') }}"
                , paginate: {
                    next: "{{ __('Próximo') }}"
                    , previous: "{{ __('Anterior') }}"
                }
            }
            , responsive: true
            , autoWidth: false
            , columnDefs: [{
                    width: '5%'
                    , targets: 0
                }, // ID
                {
                    width: '25%'
                    , targets: 1
                }, // Nome
                {
                    width: '25%'
                    , targets: 2
                }, // E-mail
                {
                    width: '15%'
                    , targets: 3
                }, // Tipo de Usuário
                {
                    width: '15%'
                    , targets: 4
                }, // Status
                {
                    width: '15%'
                    , targets: 5
                } // Ações
            ]
            , order: [
                [0, 'asc']
            ] // Ordenar por ID por padrão
        });

        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Log para depuração
        console.log('Botão Create User visível:', $('#create-user-btn').is(':visible'));
    });

</script>
@stop
