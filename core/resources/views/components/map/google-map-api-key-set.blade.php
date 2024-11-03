
<!-- google api key  -->
<script src="https://maps.googleapis.com/maps/api/js?key={{get_static_option('google_map_api_key')}}&libraries=places&v=3.46.0"></script>
<script>
    // Inicializa el Autocomplete
    function initialize() {
        const input = document.getElementById('autocomplete');
        const autocomplete = new google.maps.places.Autocomplete(input);
        
        // Escucha el evento de selección de lugar
        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            if (place.geometry) {
                console.log("Ubicación seleccionada:", place.formatted_address);
                console.log("Coordenadas:", place.geometry.location.lat(), place.geometry.location.lng());
            } else {
                alert("No se encontró información para esta ubicación.");
            }
        });
    }
    
    // Ejecuta initialize cuando la API de Google Maps esté lista
    google.maps.event.addDomListener(window, 'load', initialize);
</script>