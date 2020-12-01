if($(".contact").length) {

    let map;
    function initMap(Lat, Lng) {
        map = new google.maps.Map(document.getElementById("contact-map"), {
            center: {
                lat: Lat,
                lng: Lng
            },
            zoom: 17
        });
    }

    let ferganaMapLat = 40.374569,
        ferganaMapLng = 71.787051;
    initMap(ferganaMapLat, ferganaMapLng);


    $(".contact .my-accardion").on("click", ".accardion-item .accardion-item__content .content-item", function(){
        let getMapLat = parseInt($(this).attr("data-lat"));
        let getMapLng = parseInt($(this).attr("data-lng"));
        initMap(getMapLat, getMapLng);
    });

}