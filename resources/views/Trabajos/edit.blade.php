@extends('adminlte::page')

@section('title', 'Trabajos')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Registrar Trabajo</h3>
        </div>


        <form class="form-horizontal" action="{{ route('trabajos.update',$trabajo) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name = "nombre" id="nombre" value="{{ old('nombre',$trabajo->nombre) }}" required>
                        @error('nombre')
                            <br>
                                <small>*{{$message}}</small>
                            <br>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                    <div class="col-sm-10">
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="2"
                                value="{{ old('descripcion',$trabajo->descripcion) }}"  required>{{$trabajo->descripcion}}</textarea>
                        @error('descripcion')
                            <br>
                                <small>*{{$message}}</small>
                            <br>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-sm-2 col-form-label">categoria</label>
                    <div class="col-sm-10">
                        <select name="categoria" id="select-categoria" class="form-control">
                            <option name = 'categoria' value="{{old('categoria',$trabajo->categorias->id)}}">{{$trabajo->categorias->nombre}}</option>
                            @foreach($categorias as $categoria)    
                                <option name = 'categoria' value="{{$categoria->id}}" required>{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <br>
                                <small>*{{$message}}</small>
                            <br>
                        @enderror
                    </div>
                </div>
                

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-dark">guardar</button>
                <a class="btn btn-danger" href="{{ route('trabajos.index') }}">Volver</a>
            </div>

        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
