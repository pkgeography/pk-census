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
		iw: $('.app-container'),
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
							_this.setMarkerInfo(_this, marker, district);
						}
					}
			});
		},

		// setup marker info
		setMarkerInfo: function(obj, marker, info) {
			var _this = obj;
			google.maps.event.addListener(marker, 'mouseover', function() {
				this.set('labelVisible', true);
			});

			google.maps.event.addListener(marker, 'mouseout', function() {
				this.set('labelVisible', false);
			});

			google.maps.event.addListener(marker, 'click', function()	{
				return _this.loadMarkerInfo(_this, this, info);
			});
		},

		loadMarkerInfo: function(obj, marker, info) {
			var _this = obj;

			// toggle class if not already
			if ( _this.iw.hasClass('col-sm-12') )
				_this.iw.toggleClass('col-sm-12 col-sm-4');

			// add class if not exist already
			if ( ! _this.iw.hasClass('info-window') )
				_this.iw.addClass('info-window');

			var appcontent = $('.app-content');

			// empty any existing contents
			appcontent.empty();

			var heading = $('<h3 />', {
				'html': info.title,
				'class': 'district-title'
			}).prependTo(appcontent);

			var area = $('<div />', {
				'class': 'district-area district-divider',
				'html': '<h4><i class="fa fa-flag"></i>  Area</h4><p>' + info.area.value.toLocaleString() + ' ' + info.area.unit_short + '</p>'
			}).insertAfter(heading);

			var population = $('<div />', {
				'class': 'district-population district-divider',
				'html': '<h4><i class="fa fa-smile-o"></i> Population</h4> '
			}).insertAfter(area);

				var popStats = $('<dl />', { 'class': 'dl-horizontal' }).appendTo(population);

					var y1981 = $('<dt />', {
						'html': '1981'
					}).appendTo(popStats);

					$('<dd />', {
						'html': info.population.year[1981] ? info.population.year[1981].toLocaleString() : 'N/A'
					}).appendTo(popStats);

					var y1998 = $('<dt />', {
						'html': '1998'
					}).appendTo(popStats);

					$('<dd />', {
						'html': info.population.year[1998] ? info.population.year[1998].toLocaleString() : 'N/A'
					}).appendTo(popStats);

				var popGender = $('<div />', {
					'class': 'district-gender-ratio district-divider',
					'html': '<strong>Gender ratio:</strong>'
				}).insertAfter(popStats);

					$('<div />', {
						'class': 'progress-bar',
						'role': 'progressbar',
						'aria-valuenow': info.population.gender.male.percentage,
						'aria-valuemin': '0',
						'aria-valuemax': '100',
						'html': '<i class="fa fa-male"></i> ' + info.population.gender.male.percentage + '%'
					}).css('width', info.population.gender.male.percentage + '%')
						.appendTo(popGender).wrap( $('<div />', { 'class': 'progress progress-gender-ratio' }) );

					$('<div />', {
						'class': 'progress-bar progress-bar-success',
						'role': 'progressbar',
						'aria-valuenow': info.population.gender.female.percentage,
						'aria-valuemin': '0',
						'aria-valuemax': '100',
						'html': '<i class="fa fa-female"></i> ' + info.population.gender.female.percentage + '%'
					}).css('width', info.population.gender.female.percentage + '%')
						.appendTo(popGender).wrap( $('<div />', { 'class': 'progress progress-gender-ratio' }) );

					$('<p />', {
						'html': '<i class="fa fa-info-circle"></i> ' + info.population.ratio.value + ' ' + info.population.ratio.type
					}).appendTo(popGender);

					$('<p />', {
						'html': '<i class="fa fa-info-circle"></i> ' + info.population.density.value + ' persons ' + info.population.density.unit_short
					}).appendTo(popGender);

				var urbanRural = $('<div />', {
					'class': 'district-urban-rural',
					'html': '<h4><i class="fa fa-building"></i> Urban / Rural ratio</h4>'
				}).insertAfter(popGender);

					$('<div />', {
						'class': 'progress-bar progress-bar-danger',
						'role': 'progressbar',
						'aria-valuenow': info.population.urban.percentage,
						'aria-valuemin': '0',
						'aria-valuemax': '100',
						'html': '<i class="fa fa-building"></i> Urban ' + info.population.urban.percentage + '%'
					}).css('width', info.population.urban.percentage + '%')
						.appendTo(urbanRural).wrap( $('<div />', { 'class': 'progress progress-urban-rural' }) );

					$('<div />', {
						'class': 'progress-bar progress-bar-warning',
						'role': 'progressbar',
						'aria-valuenow': info.population.rural.percentage,
						'aria-valuemin': '0',
						'aria-valuemax': '100',
						'html': '<i class="fa fa-home"></i> Rural ' + info.population.rural.percentage + '%'
					}).css('width', info.population.rural.percentage + '%')
						.appendTo(urbanRural).wrap( $('<div />', { 'class': 'progress progress-urban-rural' }) );

			var litracyRatio = $('<div />', {
				'class': 'district-litracy-ratio district-divider',
				'html': '<h4><i class="fa fa-graduation-cap"></i> Litracy ratio:</h4>'
			}).insertAfter(population);

				$('<div />', {
					'class': 'progress-bar progress-bar-success',
					'role': 'progressbar',
					'aria-valuenow': info.litracy_ratio.percentage,
					'aria-valuemin': '0',
					'aria-valuemax': '100',
					'html': 'Age ' + info.litracy_ratio.age + ' | ' + info.litracy_ratio.percentage + '%'
				}).css('width', info.litracy_ratio.percentage + '%')
					.appendTo(litracyRatio).wrap( $('<div />', { 'class': 'progress progress-litracy-ratio' }) );

			var household = $('<div />', {
				'class': 'district-household district-divider',
				'html': '<h4><i class="fa fa-users"></i> Household average:</h4>'
			}).insertAfter(litracyRatio);

				$('<p />', {
					'class': 'district-household-average',
					'html': info.household.size + ' persons per house'
				}).appendTo(household);

			var housing = $('<div />', {
				'class': 'district-housing district-divider',
				'html': '<h4><i class="fa fa-home"></i> Housing</h4>'
			}).insertAfter(household);

				$('<p />', {
					'html': 'Total: ' + info.housing.units.total.toLocaleString()
				}).appendTo(housing);

				$('<p />', {
					'html': '<i class="fa fa-lightbulb-o"></i> Electricity: ' + info.housing.have_utilities.electricity.value.toLocaleString() + ' &ndash; ' + info.housing.have_utilities.electricity.percentage + '%'
				}).appendTo(housing);

				$('<p />', {
					'html': '<i class="fa fa-tint"></i> Water: ' + info.housing.have_utilities.water.value.toLocaleString() + ' &ndash; ' + info.housing.have_utilities.water.percentage + '%'
				}).appendTo(housing);

				$('<p />', {
					'html': '<i class="fa fa-fire"></i> Gas: ' + info.housing.have_utilities.gas.value.toLocaleString() + ' &ndash; ' + info.housing.have_utilities.gas.percentage + '%'
				}).appendTo(housing);


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