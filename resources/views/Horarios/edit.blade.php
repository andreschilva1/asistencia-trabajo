@extends('adminlte::page')

@section('title', 'Horarios')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">actualizar Horarios</h3>
        </div>

        <div class="card-body">
            <form action="{{route('horas.update', $hora)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Hora de inicio</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" value="{{old('hora_inicio',$hora->horaInicio)}}" required>
                            @error('hora_inicio')
                            <small>*{{ $message }}</small>
                            <br><br>
                             @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Hora Final</label>
                            <input type="time" name="hora_final" id="hora_final" value="{{old('hora_final',$hora->horaFin)}}" required>
                            @error('hora_final')
                            <small>*{{ $message }}</small>
                            <br><br>
                             @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-dark btn-lg">Guardar</button>
                    <a class="btn btn-danger btn-lg" href="{{route('horas.index')}}">Volver</a>
                </div>

            </form>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
