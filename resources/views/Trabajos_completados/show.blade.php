@extends('adminlte::page')

@section('title', 'trabajos_completados')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Detalles de la Asistencia</h3>
        </div>

        <div class="card-body">
            <form >
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Trabajo</label>
                            <input type="text" value="{{$trabajo_completado->trabajos->nombre}}" name="trabajo" id="trabajo" class="form-control" disabled>
                            @error('trabajo')
                            <small>*{{ $message }}</small>
                            <br><br>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cliente</label>
                            <input type="text" value="{{$cliente->name}}" name="cliente" id="cliente" class="form-control" disabled>
                            @error('cliente')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tecnico</label>
                            <input type="text"  value="{{$trabajo_completado->users->name}}" name="tecnico" id="tecnico" class="form-control" disabled>
                            @error('tecnico')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Fecha</label>
                                <input type="date" class="form-control" name="fecha"  value="{{old('fecha',$trabajo_completado->Fecha)}}" disabled>
                                @error('fecha')
                                <small>*{{ $message }}</small>
                                <br><br>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>hora</label>
                            <input type="text" value="{{$trabajo_completado->control_asistencias->horaInicio .' - '. $trabajo_completado->control_asistencias->horaFin}}" name="hora" id="hora" class="form-control"disabled>
                            @error('hora')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Estado</label>
                            <input type="button" value="{{$trabajo_completado->estado}}" name="estado" id="estado" class="form-control btn btn-success" disabled>
                            @error('estado')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Ubicacion</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="latitud"></label>
                                    <input type="text" name="latitud" id="latitud" class="form-control" value="{{$trabajo_completado->control_asistencias->latitud}}" hidden>
                                    <input type="number" name="latitud_cliente" id="latitud2" class="form-control" value="{{$trabajo_completado->latitud}}" hidden>                                    @error('latitud')
                                        <small>*{{ $message }}</small>
                                        <br><br>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="longitud"></label>
                                    <input type="text" name="longitud" id="longitud" class="form-control" value="{{$trabajo_completado->control_asistencias->longitud}}" hidden>
                                    <input type="number" name="longitud_cliente" id="longitud2" class="form-control" value="{{$trabajo_completado->longitud}}" hidden>
                                    @error('longitud')
                                        <small>*{{ $message }}</small>
                                        <br><br>
                                    @enderror
                                    
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div  id="mapa" style="width: 100%; height: 400px;"  ></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    
                   <a href="{{ route('trabajos_completados.index') }}" class="btn  btn-danger btn-lg">Volver</a>
                    
                </div>

            </form>
           
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZH368gsA1Bnnn0BcY7SJBHpxeD2j5gG8&language=es-419&callback=initMap"></script>


    <script>

let map, infoWindow;

function initMap() {
    latCliente= document.getElementById("latitud2").value;
    longCliente = document.getElementById("longitud2").value;

    latTecnico= document.getElementById("latitud").value;
    longTecnico = document.getElementById("longitud").value;
    
  map = new google.maps.Map(document.getElementById("mapa"), {
    center:new google.maps.LatLng(latCliente,longCliente),
    zoom: 13,
  });

  const svgMarker = {
    path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
    fillColor: "blue",
    fillOpacity: 0.6,
    strokeWeight: 0,
    rotation: 0,
    scale: 2,
    anchor: new google.maps.Point(15, 30),
  };

  marcadorCliente = new google.maps.Marker({
    map: map,
    position: new google.maps.LatLng(latCliente,longCliente),
  }); 

  marcadorTecnico = new google.maps.Marker({
    map: map,
    position: new google.maps.LatLng(latTecnico,longTecnico),
    icon:svgMarker,
  }); 

  mark = new google.maps.Marker({
    map: map,
    draggable: true,
    position: { lat: -34.397, lng: 150.644 },
    icon:svgMarker,
  });

  infoWindowCliente = new google.maps.InfoWindow();
  infoWindowTecnico = new google.maps.InfoWindow();

  infoWindowCliente.setPosition(new google.maps.LatLng(latCliente,longCliente));
  infoWindowCliente.setContent("Ubicacion Cliente.");
  infoWindowCliente.open(map);  

infoWindowTecnico.setPosition(new google.maps.LatLng(latTecnico,longTecnico));
infoWindowTecnico.setContent("Ubicacion Tecnico.");
infoWindowTecnico.open(map);  

}



function roundToTwo(num) {
    return +(Math.round(num + "e+7")  + "e-7");
}



window.initMap = initMap;  
    </script>
@stop
