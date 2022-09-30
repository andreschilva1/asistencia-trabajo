@extends('adminlte::page')

@section('title', 'trabajos_asignados_tecnicos')

@section('content_header')
    <h1>Mis Trabajos Asignados</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
@stop



@section('content')
   {{--  <div class="card">
        
    </div> --}}

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
                        <th>Fecha Programada</th>
                        <th>Hora de Inicio</th>
                        <th>Hora Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($trabajos_asignados as $trabajo_asignado)
                        <tr>
                            <td>{{ $trabajo_asignado->trabajos->nombre }}</td>
                            <td>{{ $trabajo_asignado->name }}</td>
                            <td>{{ $trabajo_asignado->users->name }}</td>
                            <td>{{ $trabajo_asignado->Fecha}}</td>
                            <td>{{ $trabajo_asignado->horas->horaInicio }}</td>
                            <td>{{ $trabajo_asignado->horas->horaFin}}</td>
                            <td><button class="btn btn-danger btn-sm" disabled>{{ $trabajo_asignado->estado}}</button></td>
                            <td>

                                <a href="{{route('trabajos_asignados_tecnicos.show', $trabajo_asignado)}}" class="btn btn-dark btn-sm">Ver Detalles<a>

                                <form {{-- action="{{route('trabajos_asignados.destroy', $trabajo_asignado)}}" --}} >
                                    @csrf
                                    {{-- @method('put') --}}
                                    {{-- <button class="btn btn-danger btn-sm" onclick="return confirm('¿ESTÁ SEGURO DE BORRAR?')" value="Borrar">Terminar Trabajo</button>  --}}
                                    {{-- @can('eliminar usuario')
                                    @endcan --}}
                                </form>
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