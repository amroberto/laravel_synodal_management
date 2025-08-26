
@extends('adminlte::page')

   @section('title', content: 'Dashboard')

   @section('content_header')
       <h1>Dashboard</h1>
   @stop

   @section('content')
       <div class="container-fluid">
           <x-adminlte-card title="Bem-vindo(a) ao Dashboard" theme="secondary">
               <p>Este é o painel para usuários.</p>
           </x-adminlte-card>
       </div>
   @stop

   @section('js')
       <script>
           console.log('Dashboard carregado');
       </script>
   @stop