@extends('adminlte::page')

@section('title', 'trabajos_completados')

@section('content_header')
    <h1>Mis Trabajos Completados</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
@stop



@section('content')


    <div class="card">
        <div class="card-header ">
            {{-- <a href="{{ route('trabajos_asignados.crear') }}" class="btn  btn-warning btn-lg">Asignar Nuevo Trabajo</a> --}}
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
                <thead>
                    <tr>
                        <th>Trabajo</th>
                        <th>Cliente</th>
                        <th>Tecnico</th>
                        <th>Fecha </th>
                        <th>hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($trabajos_completados as $trabajo_completado)
                        <tr>
                            <td>{{ $trabajo_completado->trabajos->nombre }}</td>
                            <td>{{ $trabajo_completado->name }}</td>
                            <td>{{ $trabajo_completado->users->name }}</td>
                            <td>{{ $trabajo_completado->Fecha}}</td>
                            <td>{{ $trabajo_completado->control_asistencias->horaInicio }}</td>
                            <td>{{ $trabajo_completado->control_asistencias->horaFin}}</td>
                            <td>
                                <button class="btn btn-success btn-sm" disabled>{{ $trabajo_completado->estado}}</button>
                            </td>
                            <td>

                                <a href="{{route('trabajos_completados_tecnicos.show', $trabajo_completado)}}" class="btn btn-dark btn-sm">Ver Detalles<a>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $('#example').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json',
            },     
        });
        
    </script>


@stop