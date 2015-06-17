!(function(root, $, _, Backbone, factory)	{
	root.pkcensus = root.pkcensus || factory(root, $, _, Backbone);

	$(document).ready(function() {
		pkcensus.init($('#mapCanvas').get(0), 30.3894007, 69.3532207, (pkcensus.iOS || pkcensus.android ? 5 : 10));
	});

})(this, jQuery, _, Backbone, function(root, $, _, Backbone) {
	'use strict';

	// Global app object
	var app = {
		iOS: (new RegExp(/iP(od|ad|hone)/)).test(navigator.userAgent),
		android: (new RegExp(/(Android)/)).test(navigator.userAgent),
		iw: $('.app-content')
	};

	// Marker MVC
	var MarkerModel = Backbone.Model.extend({});
	var MarkerView = Backbone.View.extend({});
	var MarkerCollection = Backbone.Collection.extend({ model: MarkerModel });

	// District MVC
	var DistrictModel = Backbone.Model.extend({
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
			var districtMarkerModel = new MarkerModel({
				id: this.get('id'),
				marker: marker
			});

			// Setup marker events
			setupMarkerEvents(districtMarkerModel);

			// Add marker to collection
			app.markers.add(districtMarkerModel);
		}
	});

	var DistrictCollection = Backbone.Collection.extend({ model: DistrictModel });
	var DistrictView = Backbone.View.extend({
		className: 'app-content',
		template: _.template('#district-template'),
		events: {
			'click .close': 'close'
		},
		render: function() {
			this.$el.html( this.template( this.model.attributes ) );
			return this;
		},
		close: function() {
			this.$el.empty();
		}
	});

	// Add global collections
	app.markers = new MarkerCollection();
	app.districts = new DistrictCollection();

	// Get JSON data
	var getData = function(callback) {
		return $.getJSON('./bower_components/pk-census/data/census-data.json', function(data, status) {
				return callback.call(this, (status === 'success' ? data : status));
			});
	};

	// Set fetched data to models and add to collection
	var sortData = function(district) {
		return app.districts.add(new DistrictModel(district));
	};


	// Setup marker events
	var setupMarkerEvents = function(obj) {
		var marker = obj.get('marker');

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
			app.map.panBy(-100, 0);

			// Load marker info
			makeMarkerView(obj.get('id'));
		});
	};

	// Load marker info
	var makeMarkerView = function(id) {
		var _this = app;
		var marker = _this.districts.get(id);
		if ( ! _this.iw.hasClass('info-window') ) {
			_this.iw.addClass('info-window').promise().done(function()	{
				var districtView = new DistrictView();
				console.log(districtView.model);
				// return _this.setupHTML(_this, marker, info);
				// console.log(this);
			});
		}
		else {
			$('.animated').toggleClass(function() {
				if ( $(this).hasClass('fadeInUp') ) {
					return 'fadeOutDown';
				}
				else {
					return 'fadeOutLeft';
				}
			}).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				// return _this.setupHTML(_this, marker, info);
				console.log(this);
			});
		}
	};

	// init
	app.init = function(mapCanvas, lat, lng, z) {
		this.map = new google.maps.Map(mapCanvas, {
			center: new google.maps.LatLng(lat, lng),
			disableDefaultUI: true,
			zoom: z
		});

		return getData(function(data) {
		    if (data && data.length) {
		        data.map(sortData);
		    }
		});
	};

	return app;
});
