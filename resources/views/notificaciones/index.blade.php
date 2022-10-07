@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <h1>Notificaciones Sin leer </h1>
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
             <a href="{{route('notificaciones.markAsRead')}}" class="btn  btn-warning btn-lg">marcar todas como leidas</a>
        </div>
        <div class="card-body">
            <table id="tabla1" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Descripcion del trabajo</th>
                        <th>Fecha Programada</th>
                        <th>Entregado</th>
                        <th>Marcar como leida</th>

                </thead>
                <tbody>
                    @foreach ($notificacionesSinLeer as $notificacionSinLeer)
                        <tr>
                            <td>{{ $notificacionSinLeer->data['trabajoAsignado_id'] }}</td>
                            <td>{{ $notificacionSinLeer->data['trabajo_nombre'] }}</td>
                            <td>{{ $notificacionSinLeer->data['fecha'] }}</td>
                            <td>{{ $notificacionSinLeer->data['time'] }}</td>
                            <td>
            
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  value=""   >
                                                <label class="form-check-label">Leida</label>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
<br>
<br>
<br>

{{-- notificaciones leidas --}}
<h2>Notificaciones Leidas</h2>
    <div class="card">
        <div class="card-header ">
           
        </div>
        <div class="card-body">
            <table id="tabla2" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Descripcion del trabajo</th>
                        <th>Fecha Programada</th>
                        <th>Entregado</th>
                        <th>Marcar como no leida</th>

                </thead>
                <tbody>
                    @foreach ($notificacionesleidas as $notificacionLeida)
                        <tr>
                            <td>{{ $notificacionLeida->data['trabajoAsignado_id'] }}</td>
                            <td>{{ $notificacionLeida->data['trabajo_nombre'] }}</td>
                            <td>{{ $notificacionLeida->data['fecha'] }}</td>
                            <td>{{ $notificacionLeida->data['time'] }}</td>
                            <td>
            
                                    {{-- <div class="col-sm-6">

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  value=""   >
                                                <label class="form-check-label">No Leida</label>
                                            </div>
                                        </div>
                                    </div> --}}
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
        $('#tabla1').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json',
            },
            responsive: {
                details: {
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'ui table'
                    })
                }
            }
        });

        $('#tabla2').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json',
            },
            responsive: {
                details: {
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'ui table'
                    })
                }
            }
        });
    </script>
@stop
