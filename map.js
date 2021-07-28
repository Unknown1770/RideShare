//set map options
var myLatLng = {lat: 51.5, lng: -0.1};
var mapOptions = {
    center: myLatLng,
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP

};
/*
//create autocomplete objects
var input1 = document.getElementById("departure");
var input2 = document.getElementById("destination");
//var input3 = document.getElementById("departure2");
//var input4 = document.getElementById("destination2");
var options = {
    types: ['(cities)']   
}
var autocomplete1 = new google.maps.places.Autocomplete(input1, options);
var autocomplete2 = new google.maps.places.Autocomplete(input2, options);
//var autocomplete3 = new google.maps.places.Autocomplete(input3, options);
//var autocomplete4 = new google.maps.places.Autocomplete(input4, options);

//create a DirectionsService object to use the route method and get a result for our request
var directionsService = new google.maps.DirectionsService();
*/
//onload:

google.maps.event.addDomListener(window, 'load', initialize);

//initialize: draw map in the #googleMap div
function initialize() {
    //create a DirectionsRenderer object which we will use to display the route
    directionsDisplay = new google.maps.DirectionsRenderer();
    //create map
    map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);
    //bind the DirectionsRenderer to the map
    directionsDisplay.setMap(map);
}//end of initialize

//Calculate route when selecting autocomplete:
google.maps.event.addListener(autocomplete1, 'place_changed', calcRoute);
google.maps.event.addListener(autocomplete2, 'place_changed', calcRoute);

// Calculate Route:  
function calcRoute() {
    var start = $('#departure').val();
    var end = $('#destination').val();
    var request = {
        origin:start, 
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.IMPERIAL,
        durationInTraffic: false,   
        avoidHighways: false,   
        avoidTolls: false,
    };
    if(start && end){
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }else{ 
                initialize();
            }
        });
    }
}