(function(root, factory)	{
	'user strict';
	window.pkcensus = window.pkcensus || factory;
})(this, (function() {
	
	'use strict';
	
	var pkcensus = {};


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
				disableDefaultUI: true
			};

			var map = this.map = new google.maps.Map(this.canvas, this.mapDefaults);

			google.maps.event.addListenerOnce(this.map, 'tilesloaded', function()	{
				return (callback && typeof callback === 'function') ? callback.call(this, map) : false;
			});
		},

		setMarkers: function()	{
		}
	};




	return pkcensus;
})());

// DOM ready methods
$(document).ready(function()	{

	// canvas global access
	var mapCanvas = $('#mapCanvas');

	// load map
	pkcensus.gmap.init(mapCanvas[0], 37, 70, 8, function(map)	{
		console.log(map);
	});
});