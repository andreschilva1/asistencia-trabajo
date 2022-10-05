@extends('adminlte::page')

@section('title', 'trabajos_asignados')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Editar Trabajo</h3>
        </div>

        <div class="card-body">
            <form action="{{route('trabajos_asignados.update',$trabajo_asignado)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Trabajo</label>
                            <select name="trabajo" id="trabajo" class="form-control">
                                <option value="{{$trabajo_asignado->trabajos_id}}">{{$trabajo_asignado->trabajos->nombre}}</option>
                                @foreach($trabajos as $trabajo)
                                <option value="{{$trabajo->id}}">{{$trabajo->nombre}}</option>
                                @endforeach
                            </select>
                            @error('trabajo')
                            <small>*{{ $message }}</small>
                            <br><br>
                        @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cliente</label>
                            <select name="cliente" id="cliente" class="form-control">
                                <option value="{{$trabajo_asignado->clientes_id}}">{{$old_cliente->name}}</option>
                                @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->name}}</option>
                                @endforeach
                            </select>
                            @error('cliente')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tecnico</label>
                            <select name="tecnico" id="tecnico" class="form-control">
                                <option value="{{$trabajo_asignado->tecnicos_id}}">{{$trabajo_asignado->users->name}}</option>
                                @foreach($tecnicos as $tecnico)
                                <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                                @endforeach
                            </select>
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
                                <input type="date" class="form-control" name="fecha"  value="{{old('fecha',$trabajo_asignado->Fecha)}}">
                                @error('fecha')
                                <small>*{{ $message }}</small>
                                <br><br>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>hora</label>
                            <select name="hora" id="hora" class="form-control">
                                <option value="{{$trabajo_asignado->horas_id}}">{{$trabajo_asignado->horas->horaInicio.' - '.$trabajo_asignado->horas->horaFin}}</option>
                                @foreach($horas as $hora)
                                <option value="{{$hora->id}}">{{$hora->horaInicio.'-'.$hora->horaFin}}</option>
                                @endforeach
                            </select>
                            @error('hora')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="{{$trabajo_asignado->estado}}">{{$trabajo_asignado->estado}}</option>
                                <option value="Asignado">Asignado</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Completado">Completado</option>
                            </select>
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
                                    <label for="latitud">Latitud</label>
                                    <input type="text" name="latitud" id="latitud" class="form-control" value="{{old('latitud',$trabajo_asignado->latitud)}}" >
                                    @error('latitud')
                                        <small>*{{ $message }}</small>
                                        <br><br>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="longitud">Longitud</label>
                                    <input type="text" name="longitud" id="longitud" class="form-control" value="{{old('longitud',$trabajo_asignado->longitud)}}" >
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
                    <button type="submit" class="btn btn-dark btn-lg">Asignar</button>
                    <a class="btn btn-danger btn-lg" href="{{route('trabajos_asignados.index')}}">Volver</a>
                </div>

            </form>
        </div>

    </div>
    <button type="button" id="obtener_ubicacion" class="btn btn-dark"></button>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- <script>
    function initMap() {
        var latitud = -17.84530282996219;
        var longitud = -63.159622804077145;

        coordenadas = {
            lng: longitud,
            lat: latitud
        }

        generarMapa(coordenadas);
    }

    function generarMapa(coordenadas) {
        var mapa = new google.maps.Map(document.getElementById('mapa'),{
            zoom: 12,
            center: new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
        });
        
        marcador = new google.maps.Marker({
            map: mapa,
            draggable: true,
            position: new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
        });

        marcador.addListener('drag',function(event){
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
            
        })
        marcador.addListener('click', function() {
          mapa.setZoom(8);
          mapa.setCenter(marcador.getPosition());
        });
        
    }
</script> --}}
<script>
   
    function initMap() {
      var myOptions = {
          zoom:14,
          center:new google.maps.LatLng(-17.7817528,-63.1810015),
          mapTypeId: google.maps.MapTypeId.ROADMAP
          
      };
      
      var map = new google.maps.Map(document.getElementById('mapa'),myOptions)
      
      var pin = new google.maps.Marker({
      position:new google.maps.LatLng(-17.7817528,-63.1810015),
      map:map,
      animation: google.maps.Animation.DROP,
      });
  
      map.addListener('click',function(event){
          pin.setPosition(event.latLng);
          document.getElementById("latitud").value=event.latLng.lat() ;
          document.getElementById("longitud").value=event.latLng.lng();
      });
  
  
      infoWindow = new google.maps.InfoWindow();
  
      /* const locationButton = document.createElement("button"); */
      const locationButton = document.getElementById("obtener_ubicacion");
  
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
  
              infoWindow.setPosition(pos);
              infoWindow.setContent("Ubicacion Actual.");
              infoWindow.open(map);
              map.setCenter(pos);
              pin.setPosition(pos);
              document.getElementById("latitud").value=pos.lat ;
              document.getElementById("longitud").value=pos.lng;
  
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
  </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZH368gsA1Bnnn0BcY7SJBHpxeD2j5gG8&language=es-419&callback=initMap"></script>
@stop
