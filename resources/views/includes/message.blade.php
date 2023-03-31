 <!-- Muestra mensaje que se realizo con éxito la subida de datos al servidor -->
 @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
 @endif