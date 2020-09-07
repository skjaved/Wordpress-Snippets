/** 
 * Function use to create the custom styled Google map
 * 
 * any custom style can be passed into the styles array
 * 
 * Custom styles can get from Snazzymaps plugin or you can create your own style in google maps
 * 
 * You need Google Maps API key in order to work this code
 */
// Initialize and add the mp
function initMap() {
	// Create a map object, and include the MapTypeId to add
	// to the map type control.
	var mapdiv = document.getElementById("map");
	if (mapdiv) {
		var map = new google.maps.Map(mapdiv, {
			center: { lat: 18.5522389, lng: 73.7932943 },
			zoom: 16,
			disableDefaultUI: true,
			// Add styles array
			styles: [
				{
					featureType: "all",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "administrative",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "administrative",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#444444",
						},
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "administrative.neighborhood",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "landscape",
					elementType: "all",
					stylers: [
						{
							visibility: "on",
						},
						{
							color: "#e0dfe0",
						},
					],
				},
				{
					featureType: "landscape",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "poi",
					elementType: "all",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "poi",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "poi.park",
					elementType: "geometry",
					stylers: [
						{
							color: "#a8a9a8",
						},
						{
							visibility: "on",
						},
					],
				},
				{
					featureType: "road",
					elementType: "all",
					stylers: [
						{
							saturation: -100,
						},
						{
							lightness: 45,
						},
					],
				},
				{
					featureType: "road",
					elementType: "geometry.fill",
					stylers: [
						{
							visibility: "on",
						},
						{
							color: "#5b5b5a",
						},
					],
				},
				{
					featureType: "road",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "road.highway",
					elementType: "all",
					stylers: [
						{
							visibility: "simplified",
						},
					],
				},
				{
					featureType: "road.highway",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "road.arterial",
					elementType: "labels.icon",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "transit",
					elementType: "all",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "transit",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "water",
					elementType: "all",
					stylers: [
						{
							color: "#ffffff",
						},
						{
							visibility: "on",
						},
					],
				},
				{
					featureType: "water",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
			],
		});
	} else {
		return;
	}

    // This will add custom marker on the location set on the map
	var marker = new google.maps.Marker({
		position: { lat: 18.5522389, lng: 73.7932943 },
		map: map,
		icon: "example.com/marker.svg", // url for marker icon
	});
}
/** Google Maps Ends */