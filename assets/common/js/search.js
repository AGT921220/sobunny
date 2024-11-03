$(document).ready(function() {
    $('.searchListings').on('click', function() {

        let ethnicity = $('#search_by_ethnicity').val();
        let gender = $('#search_by_gender').val();
        let age = $('#search_by_age').val();
        let breast = $('#search_by_breasts').val();
        let cater = $('#search_by_cater').val();
        let bodyType = $('#search_by_body_type').val();
        let eyeColor = $('#search_by_eye_color').val();
        let hairColor = $('#search_by_hair_color').val();
        let serviceType = $('#search_by_service_type').val();
        let servicing = $('#search_by_servicing').val();
        let height = $('#search_by_heights').val();

        let form = $('#search_listings_form');

        form.append(`<input type="hidden" name="gender_id" value="${gender}">`);
        form.append(`<input type="hidden" name="ethnicity_id" value="${ethnicity}">`);
        form.append(`<input type="hidden" name="age_id" value="${age}">`);
        form.append(`<input type="hidden" name="breast_id" value="${breast}">`);
        form.append(`<input type="hidden" name="cater_id" value="${cater}">`);
        form.append(`<input type="hidden" name="body_type_id" value="${bodyType}">`);
        form.append(`<input type="hidden" name="eye_color_id" value="${eyeColor}">`);
        form.append(`<input type="hidden" name="hair_color_id" value="${hairColor}">`);
        form.append(`<input type="hidden" name="service_type_id" value="${serviceType}">`);
        form.append(`<input type="hidden" name="servicing_id" value="${servicing}">`);
        form.append(`<input type="hidden" name="height_id" value="${height}">`);
        form.submit();
    });
});

$('.triggerSearchBar').click(function() {
    $('.cateLeftContent').toggleClass('active');
  });
  


//   function initialize() {
//     const input = document.getElementById('autocomplete');
//     const autocomplete = new google.maps.places.Autocomplete(input);
    
//     // Escucha el evento de selección de lugar
//     autocomplete.addListener('place_changed', () => {
//         const place = autocomplete.getPlace();
//         if (place.geometry) {
//             console.log("Ubicación seleccionada:", place.formatted_address);
//             console.log("Coordenadas:", place.geometry.location.lat(), place.geometry.location.lng());
//         } else {
//             alert("No se encontró información para esta ubicación.");
//         }
//     });
// }

// // Ejecuta initialize cuando la API de Google Maps esté lista
// google.maps.event.addDomListener(window, 'load', initialize);


function loadGoogleMapsScript(callback) {
    const script = document.createElement('script');
    script.src = "https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places";
    script.async = true;
    script.defer = true;
    script.onload = callback;
    document.head.appendChild(script);
}

// Inicializa el Autocomplete solo cuando la API esté lista
function initialize() {
    const input = document.getElementById('autocomplete');
    const autocomplete = new google.maps.places.Autocomplete(input);
    
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

// Espera a que el DOM esté listo antes de cargar Google Maps
$(document).ready(function () {
    loadGoogleMapsScript(initialize);
});