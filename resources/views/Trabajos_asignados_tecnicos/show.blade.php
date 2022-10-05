@extends('adminlte::page')

@section('title', 'trabajos_asignados')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Detalles del Trabajo</h3>
        </div>

        <div class="card-body">
            <form action="{{route('control_asistencias.create',$trabajo_asignado)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Trabajo</label>
                            <input type="text" value="{{$trabajo_asignado->trabajos->nombre}}" name="trabajo" id="trabajo" class="form-control" disabled>
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
                            <input type="text"  value="{{$trabajo_asignado->users->name}}" name="tecnico" id="tecnico" class="form-control" disabled>
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
                                <input type="date" class="form-control" name="fecha"  value="{{old('fecha',$trabajo_asignado->Fecha)}}" disabled>
                                @error('fecha')
                                <small>*{{ $message }}</small>
                                <br><br>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>hora</label>
                            <input type="text" value="{{$trabajo_asignado->horas->horaInicio .' - '. $trabajo_asignado->horas->horaFin}}" name="hora" id="hora" class="form-control"disabled>
                            @error('hora')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Estado</label>
                            @if ($trabajo_asignado->estado == "Asignado")
                                <input type="button" value="{{$trabajo_asignado->estado}}" name="estado" id="estado" class="form-control btn btn-warning" disabled>
                            @elseif($trabajo_asignado->estado == "En Proceso")
                                <input type="button" value="{{$trabajo_asignado->estado}}" name="estado" id="estado" class="form-control btn btn-danger" disabled>
                             @endif
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
                                    <input type="text" name="latitud" id="latitud" class="form-control" value="" hidden>
                                    <input type="number" name="latitud_cliente" id="latitud2" class="form-control" value="{{$trabajo_asignado->latitud}}" hidden>                                    @error('latitud')
                                        <small>*{{ $message }}</small>
                                        <br><br>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="longitud"></label>
                                    <input type="text" name="longitud" id="longitud" class="form-control" value="" hidden>
                                    <input type="number" name="longitud_cliente" id="longitud2" class="form-control" value="{{$trabajo_asignado->longitud}}" hidden>
                                    <input type="text" name="es_ubicacion_cercana" id="es_ubicacion_cercana" class="form-control" value = "0" hidden>
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
                    
                    @if ($trabajo_asignado->estado == 'Asignado')
                        <button type="submit" class="btn btn-dark btn-lg" id="btn1" disabled >Comenzar</button>  
                    @elseif($trabajo_asignado->estado == 'En Proceso')
                            
                    <button type="submit" class="btn btn-danger btn-lg" id="btn1" disabled>Terminar</button>
                        
                    @endif

                    
                    
                    {{-- <button type="submit" class="btn btn-danger btn-lg" id="terminar" disabled>Terminar</button> --}}
                   {{--  <a class="btn btn-danger btn-lg" id="terminar" href="{{route('trabajos_asignados.index')}}" >Terminar</a> --}}
                </div>

            </form>
           
        </div>
        <button type="button" id="btn2" class="btn btn-dark"></button>
        <button type="button" id="btn3" class="btn btn-dark">comprobar que este cerca</button>
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
  infoWindowCliente = new google.maps.InfoWindow();
  infoWindowCliente.setPosition(new google.maps.LatLng(latCliente,longCliente) );
  infoWindowCliente.setContent("Ubicacion del cliente.");
  infoWindowCliente.open(map);

  mark = new google.maps.Marker({
    map: map,
    draggable: true,
    position: { lat: -34.397, lng: 150.644 },
    icon:svgMarker,
  });

  infoWindowTecnico = new google.maps.InfoWindow();

  /* const locationButton = document.createElement("button"); */
const locationButton = document.getElementById("btn2");
const buttonComenzar = document.getElementById('btn1');
const comprobarCercania = document.getElementById('btn3');
const esUbicacionCercana = document.getElementById('es_ubicacion_cercana');


  locationButton.textContent = "Obtener Mi Ubicacion";
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          infoWindowTecnico.setPosition(pos);
          infoWindowTecnico.setContent("Ubicacion Actual.");
          infoWindowTecnico.open(map);
          map.setCenter(pos);
          mark.setPosition(pos);
          document.getElementById("latitud").value=roundToTwo(pos.lat) ;
          document.getElementById("longitud").value= roundToTwo(pos.lng);

         
          if (compararUbicaciones(latCliente,longCliente,pos.lat,pos.lng, 0.002)) {
            buttonComenzar.disabled = false;
            esUbicacionCercana.value = 1;
          }
          console.log(compararUbicaciones(latCliente,longCliente,pos.lat,pos.lng, 0.002));
	      /* var bounds = new google.maps.LatLng(
            -17.8028544,-63.16032);
            var bounds2 = new google.maps.LatLng(
                roundToTwo(-17.8015468),roundToTwo(-63.16232));

          num = 12.3456987;
          bounds.equals(bounds2);            
          console.log("latitud",bounds.lng());
          console.log("longitud",bounds.toUrlValue(6)); */

          
         /*  console.log(compararUbicaciones(bounds,bounds2,0.0002));  */

        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });

  mark.addListener('dragend',function (event) {
    document.getElementById("latitud").value= roundToTwo(mark.getPosition().lat());
    document.getElementById("longitud").value= roundToTwo(mark.getPosition().lng());

  });

comprobarCercania.addEventListener("click",function (event) {
    if (compararUbicaciones(latCliente,longCliente,mark.getPosition().lat(),mark.getPosition().lng(), 0.002)) {
            buttonComenzar.disabled = false;
            esUbicacionCercana.value = 1;
          }
});
  
/* buttonComenzar.addEventListener("click",() =>{
    buttonComenzar.disabled = true;
    buttonTerminar.disabled = false;

}); */
}

function compararUbicaciones(lat1,long1,lat2,long2,rango) {
  /*  lat1 =LatLngDestino.lat();
   lat2 =LatLngOrigen.lat();
   long1=LatLngDestino.lng();
   long2=LatLngOrigen.lng(); */
    if (((lat1 == lat2) && (long1 == long2))||
    (((lat1  <= (lat2 + rango) )&& (lat1 >= (lat2 - rango)))&&
     ((long1 <= (long2+rango))&&(long1 >= (long2-rango)))))
     {
        return true;
    }
    return false;
}

function roundToTwo(num) {
    return +(Math.round(num + "e+7")  + "e-7");
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}

window.initMap = initMap;  
    </script>
@stop
