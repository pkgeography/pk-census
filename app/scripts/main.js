(function(root, factory)	{
	window.pkcensus = window.pkcensus || factory;
})(this, (function() {
	'use strict';

	// indexOf support for legacy browsers
	if (typeof Array.prototype.indexOf !== 'undefined') {
		Array.prototype.indexOf = function(item) {
			var that = this;
			for (var i = 0; i < that.length; i++) {
				if (that[i] === item) {
					return i;
				}
			}
			return -1;
		};
	}
	
	// global pkcensus object
	var pkcensus = {};

	// map initialization
	pkcensus.gmap = {
		iw: null,
		markers: [],
		init: function(canvas, lat, lng, zoom, callback) {
			this.canvas = canvas;
			this.defaultPosition = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
			this.zoom = typeof zoom !== 'undefined' ? parseInt(zoom) : 8;
			this.mapDefaults = {
				center: this.defaultPosition,
				zoom: this.zoom,
				disableDefaultUI: true,
				styles: [{
						    "featureType": "administrative.country",
						    "elementType": "labels",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  },{
						    "featureType": "road",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  },{
						    "featureType": "landscape.man_made",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  },{
						    "featureType": "poi",
						    "elementType": "labels",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  },{
						    "featureType": "administrative.province",
						    "elementType": "labels",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  },{
						    "featureType": "administrative.neighborhood",
						    "elementType": "labels",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  },{
						    "featureType": "administrative.locality",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  },{
						    "featureType": "administrative.country",
						    "elementType": "geometry.stroke",
						    "stylers": [
						      { "weight": 1 }
						    ]
						  },{
						    "featureType": "water",
						    "elementType": "labels",
						    "stylers": [
						      { "visibility": "off" }
						    ]
						  }
						]
			};

			var map = this.map = new google.maps.Map(this.canvas, this.mapDefaults);

			google.maps.event.addListenerOnce(this.map, 'tilesloaded', function()	{
				return (callback && typeof callback === 'function') ? callback.call(this, map) : false;
			});
		},

		// setup markers
		setMarkers: function()	{
			var _this = this;
			$.getJSON('scripts/census-data-combined.json', 
				function(json, status) {
					if (status && status === 'success') {
						for (var i = json.length - 1; i >= 0; i--) {
							var district = json[i];
							var marker = new MarkerWithLabel({
								position: new google.maps.LatLng(district.location.lat, district.location.lng),
								map: _this.map,
								icon: {
									path: google.maps.SymbolPath.CIRCLE,
									scale: 3,
									strokeOpacity: 0.85,
									strokeColor: '#c30'
								},
								labelClass: 'district-marker',
								labelContent: district.title,
								labelVisible: false,
								labelAnchor: new google.maps.Point(-3, 34)
							});

							_this.markers.push(marker);

							google.maps.event.addListener(marker, 'mouseover', function() {
								this.set('labelVisible', true);
							});

							google.maps.event.addListener(marker, 'mouseout', function() {
								this.set('labelVisible', false);
							});

							google.maps.event.addListener(marker, 'click', function()	{
								
								if (_this.iw) {
									_this.iw.close();
								}

								_this.iw = new google.maps.InfoWindow();

								// setup contents here but with adhoc method
								var content = $('<div />', {
									'class': 'col-sm-12 district-info-window',
									'html': district.title
								});

								_this.iw.setContent(content[0]);
								_this.iw.open(_this.map, this);
							});
						}
					}
			});
		}

	};




	return pkcensus;
})());

// DOM ready methods
$(document).ready(function()	{
	'use strict';

	// canvas global access
	var mapCanvas = $('#mapCanvas');

	// load map
	pkcensus.gmap.init(mapCanvas[0], 30.3894007, 69.3532207, 6, function(map)	{
		// console.log(map);
		pkcensus.gmap.setMarkers();
	});
});