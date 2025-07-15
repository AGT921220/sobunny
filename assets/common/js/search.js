$(document).ready(function () {
  $(".searchListings").on("click", function () {
    let ethnicity = $("#search_by_ethnicity").val();
    let gender = $("#search_by_gender").val();
    let age = $("#search_by_age").val();
    let breast = $("#search_by_breasts").val();
    let cater1 = $(".cater_1").is(":checked") ? 1 : 0;
    let cater2 = $(".cater_2").is(":checked") ? 1 : 0;
    let cater3 = $(".cater_3").is(":checked") ? 1 : 0;
    let bodyType = $("#search_by_body_type").val();
    let eyeColor = $("#search_by_eye_color").val();
    let hairColor = $("#search_by_hair_color").val();
    let serviceType = $("#search_by_service_type").val();
    let servicing = $("#search_by_servicing").val();
    let height = $("#search_by_heights").val();
    let cityId = $("#search_by_city_id").val();
    let form = $("#search_listings_form");

    if (!gender) {
      Swal.fire({
        title: "Error!",
        text: "Please select Gender",
        icon: "error",
        confirmButtonText: "Ok",
      });
      return;
    }

    if (gender)
      form.append(`<input type="hidden" name="gender_id" value="${gender}">`);
    if (cityId)
      form.append(`<input type="hidden" name="city_id" value="${cityId}">`);
    if (ethnicity)
      form.append(
        `<input type="hidden" name="ethnicity_id" value="${ethnicity}">`
      );
    if (age) form.append(`<input type="hidden" name="age_id" value="${age}">`);
    if (breast)
      form.append(`<input type="hidden" name="breast_id" value="${breast}">`);
    if (cater1)
      form.append(`<input type="hidden" name="cater_1" value="${cater1}">`);
    if (cater2)
      form.append(`<input type="hidden" name="cater_2" value="${cater2}">`);
    if (cater3)
      form.append(`<input type="hidden" name="cater_3" value="${cater3}">`);
    if (bodyType)
      form.append(
        `<input type="hidden" name="body_type_id" value="${bodyType}">`
      );
    if (eyeColor)
      form.append(
        `<input type="hidden" name="eye_color_id" value="${eyeColor}">`
      );
    if (hairColor)
      form.append(
        `<input type="hidden" name="hair_color_id" value="${hairColor}">`
      );
    if (serviceType)
      form.append(
        `<input type="hidden" name="service_type_id" value="${serviceType}">`
      );
    if (servicing)
      form.append(
        `<input type="hidden" name="servicing_id" value="${servicing}">`
      );
    if (height)
      form.append(`<input type="hidden" name="height_id" value="${height}">`);
    form.submit();
  });
});

$(".triggerSearchBar").click(function () {
  $(".cateLeftContent").toggleClass("active");
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

// function loadGoogleMapsScript(callback) {
//     alert("Iniciando la carga de Google Maps...");
//     const script = document.createElement('script');
//     script.src = "https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places";
//     script.async = true;
//     script.defer = true;
//     script.onload = function() {
//         alert("Google Maps API cargado exitosamente.");
//         callback();
//     };
//     script.onerror = function() {
//         alert("Error al cargar Google Maps API.");
//     };
//     document.head.appendChild(script);
// }

// Inicializa el Autocomplete solo cuando la API esté lista
function initializeSearchText() {
  alert("Inicializando el autocompletado...");
  const input = document.getElementById("autocompleteSearchText");
  const autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener("place_changed", () => {
    const place = autocomplete.getPlace();
    console.log(place);
    if (place.geometry) {
      alert("Ubicación seleccionada: " + place.formatted_address);
      alert(
        "Coordenadas: " +
          place.geometry.location.lat() +
          ", " +
          place.geometry.location.lng()
      );
    } else {
      alert("No se encontró información para esta ubicación.");
    }
  });
}

// Espera a que el DOM esté listo antes de cargar Google Maps
// $(document).ready(function () {
//     alert("Documento listo. Cargando Google Maps...");
//     // loadGoogleMapsScript(initializeSearchText);
// });
