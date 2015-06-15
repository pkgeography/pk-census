!(function(root, $, _, Backbone, factory)	{
	root.pkcensus = root.pkcensus || factory(root, $, _, Backbone);

	$(document).ready(function() {
		pkcensus.init($('#mapCanvas').get(0), 30.3894007, 69.3532207, 10);
	});

})(this, jQuery, _, Backbone, function(root, $, _, Backbone) {
	'use strict';

	// Global app object
	var app = {};

	// Marker MVC
	var markerModel = Backbone.Model.extend({});
	var markerView = Backbone.View.extend({});
	var markerCollection = Backbone.Collection.extend({ model: markerModel });

	// District MVC
	var districtModel = Backbone.Model.extend({
		initialize: function() {
			var latlng = this.get('location');
			var marker = new MarkerWithLabel({
				position: new google.maps.LatLng(latlng.lat, latlng.lng),
				map: app.map,
				title: this.get('title'),
				labelContent: this.get('title'),
				labelClass: 'district-marker',
				labelVisible: false,
				labelAnchor: new google.maps.Point(-6, 36),
				icon: {
					path: google.maps.SymbolPath.CIRCLE,
					scale: 6,
					strokeOpacity: 0.85,
					strokeColor: '#008000'
				}
			});

			// Add marker to marker model
			var districtMarkerModel = new markerModel({
				id: this.get('id'),
				marker: marker
			});

			// Setup marker events
			setupMarkerEvents(districtMarkerModel);

			// Add marker to collection
			app.markers.add(districtMarkerModel);
		}
	});

	var districtView = Backbone.View.extend({});
	var districtCollection = Backbone.Collection.extend({ model: districtModel });

	// Add global collections
	app.markers = new markerCollection();
	app.districts = new districtCollection();

	// Get JSON data
	var getData = function(callback) {
		return $.getJSON('./bower_components/pk-census/data/census-data.json', function(data, status) {
				return callback.call(this, (status === 'success' ? data : status));
			});
	};

	// Set fetched data to models and add to collection
	var sortData = function(data) {
		if (data && data.length) {
			for(var i = 0; i < data.length; i++) {
				var district = new districtModel(data[i]);
				app.districts.add(district);
			}
		}
	};


	// Setup marker events
	var setupMarkerEvents = function(markerModel) {
		var marker = markerModel.get('marker');

		// Listen to mouse over event
		google.maps.event.addListener(marker, 'mouseover', function() {
			this.set('labelVisible', true);
		});

		// Listen to mouse out event
		google.maps.event.addListener(marker, 'mouseout', function() {
			this.set('labelVisible', false);
		});

		// Listen to click event
		google.maps.event.addListener(marker, 'click', function() {
			if ( app.map.getCenter().equals(this.getPosition()) ) return;
			app.map.panTo(this.getPosition());
			app.map.setZoom(9);
		});
	};

	// init
	app.init = function(mapCanvas, lat, lng, z) {
		this.map = new google.maps.Map(mapCanvas, {
			center: new google.maps.LatLng(lat, lng),
			disableDefaultUI: true,
			zoom: z
		});

		return getData(sortData);
	};

	return app;
});