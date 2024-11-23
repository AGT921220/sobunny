$(document).ready(function () {
  // $('.aditional_cities').select2();

  $(".aditional_cities").select2({
    placeholder: "Search for cities",
    minimumInputLength: 4, // Mínimo de letras antes de hacer la consulta
    ajax: {
      url: "/api/cities-search", // Cambia a la URL que manejará la búsqueda
      dataType: "json",
      delay: 250, // Espera de 250ms para optimizar las peticiones
      data: function (params) {
        return {
          q: params.term, // Término de búsqueda enviado al servidor
        };
      },
      processResults: function (data) {
        // Mapea los resultados al formato necesario por Select2
        return {
          results: data.map((city) => ({
            id: city.id, // Valor del atributo "value"
            text: city.name, // Texto que aparecerá en la lista
          })),
        };
      },
      cache: true, // Activa caché para reducir llamadas duplicadas
    },
  });
});
