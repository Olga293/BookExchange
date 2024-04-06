//персональный API-ключ
var token = "c2bdda6fca709b1e0d03b817d0729919d5f3cc15";

function showPostalCode(suggestion) {
    $("#postal_code").val(suggestion.data.postal_code);
}

function clearPostalCode(suggestion) {
    $("#postal_code").val("");
}

$("#address").suggestions({
    token: token,
    type: "ADDRESS",
    onSelect: showPostalCode,
    onSelectNothing: clearPostalCode,
    constraints: {
        locations: { country: "*" }
    }
});








