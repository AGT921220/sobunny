$(document).on("click", ".searchFilterBtn", function () {

    let ethnicity = $('#ethincity').val();
    let gender = $('#gender').val();
    let age = $('#age').val();
    let breast = $('#breasts').val();
    let cater = $('#cater').val();
    let bodyType = $('#body_type').val();
    let eyeColor = $('#eyeColor').val();
    let hairColor = $('#HairColor').val();
    let serviceType = $('#service_type').val();
    let servicing = $('#servicing').val();
    let height = $('#heights').val();

    let form = $('#searchForm');
    if (gender) {
        form.append(`<input type="hidden" name="gender_id" value="${gender}">`);
    }
    if (ethnicity) {
        form.append(`<input type="hidden" name="ethnicity_id" value="${ethnicity}">`);
    }
    if (age) {
        form.append(`<input type="hidden" name="age_id" value="${age}">`);
    }
    if (breast) {
        form.append(`<input type="hidden" name="breast_id" value="${breast}">`);
    }
    if (cater) {
        form.append(`<input type="hidden" name="cater_id" value="${cater}">`);
    }
    if (bodyType) {
        form.append(`<input type="hidden" name="body_type_id" value="${bodyType}">`);
    }
    if (eyeColor) {
        form.append(`<input type="hidden" name="eye_color_id" value="${eyeColor}">`);
    }
    if (hairColor) {
        form.append(`<input type="hidden" name="hair_color_id" value="${hairColor}">`);
    }
    if (serviceType) {
        form.append(`<input type="hidden" name="service_type_id" value="${serviceType}">`);
    }
    if (servicing) {
        form.append(`<input type="hidden" name="servicing_id" value="${servicing}">`);
    }
    if (height) {
        form.append(`<input type="hidden" name="height_id" value="${height}">`);
    }
    form.submit();
});
  