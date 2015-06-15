(function(root, $, factory)	{
	window.pkcensus = window.pkcensus || factory(root, $);

	// DOM ready methods
	$(document).ready(function()	{

		// canvas global access
		var mapCanvas = $('#mapCanvas');

		// load map
		pkcensus.gmap.init(mapCanvas[0], 30.3894007, 69.3532207, 6, function(map)	{
			pkcensus.gmap.setMarkers();
		});
	});

})(this, jQuery, function(root, $) {
	'use strict';

	// global pkcensus object
	var pkcensus = {};

	// map initialization
	pkcensus.gmap = {
		iw: $('.app-content'),
		markers: [],
		init: function(canvas, lat, lng, zoom, callback) {
			var _this = this;

			this.canvas = canvas;
			this.defaultPosition = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
			this.zoom = typeof zoom !== 'undefined' ? parseInt(zoom) : 8;
			this.mapDefaults = {
				center: this.defaultPosition,
				zoom: this.zoom,
				zoomControl: false,
				streetViewControl: false,
				panControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
					mapTypeIds: ['census_map', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
				}
			};

			this.mapStyles = [{
					        "featureType": "administrative.country",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "administrative.province",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "administrative.locality",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "administrative.neighborhood",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "landscape.man_made",
					        "elementType": "geometry",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "landscape.natural.terrain",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "poi",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "road",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "simplified"
					            }
					        ]
					    },
					    {
					        "featureType": "transit",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "simplified"
					            }
					        ]
					    },
					    {
					        "featureType": "water",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "simplified"
					            }
					        ]
					    }
					];

			// Setup custom map type
			this.censusMap = new google.maps.StyledMapType(this.mapStyles, { name: 'Population Census' });

			// Initiate Google Maps
			var map = this.map = new google.maps.Map(this.canvas, this.mapDefaults);

			this.map.mapTypes.set('census_map', this.censusMap);
			this.map.setMapTypeId('census_map');

			window.onresize = function()	{
				// Resize map
				google.maps.event.trigger(_this.map, 'resize');

				// Set the center back to default
				if ( _this.map.getCenter() !== _this.defaultPosition )
					_this.map.setCenter( _this.defaultPosition );
			};

			google.maps.event.addListenerOnce(this.map, 'tilesloaded', function()	{
				return (callback && typeof callback === 'function') ? callback.call(this, map) : false;
			});
		},

		// setup markers
		setMarkers: function()	{
			var _this = this;
			$.getJSON('./bower_components/pk-census/data/census-data.json',
				function(json, status) {
					if (status && status === 'success') {
						for (var i = json.length - 1; i >= 0; i--) {
							var district = json[i];
							// var marker = new MarkerWithLabel({
							// 	position: new google.maps.LatLng(district.location.lat, district.location.lng),
							// 	map: _this.map,
							// 	icon: {
							// 		path: google.maps.SymbolPath.CIRCLE,
							// 		scale: 3,
							// 		strokeOpacity: 0.85,
							// 		strokeColor: '#c30'
							// 	},
							// 	labelClass: 'district-marker',
							// 	labelContent: district.title,
							// 	labelVisible: false,
							// 	labelAnchor: new google.maps.Point(-3, 34)
							// });

							var marker = new google.maps.Marker({
								position: new google.maps.LatLng(district.location.lat, district.location.lng),
								map: _this.map
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

			// add class if not exist already
			if ( ! _this.iw.hasClass('info-window') ) {
				_this.iw.addClass('info-window').promise().done(function()	{
					return _this.setupHTML(_this, marker, info);
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
					return _this.setupHTML(_this, marker, info);
				});
			}
		},

		closeIW: function()	{
			var appcontent = $('.info-window');

			if ( appcontent.length > 0 ) {
				appcontent.empty();
				appcontent.removeClass('info-window');
			}
		},

		setupHTML: function(obj, marker, info) {

			var _this = obj;

			// empty any existing contents
			var appcontent = $('.app-content').empty();

			var heading = $('<h4 />', {
				'html': '<i class="emblem-seal emblem-seal-' + info.province + '"></i> ' + info.title,
				'class': 'district-title animated fadeInRight'
			}).prependTo(appcontent);

			var area = $('<div />', {
				'class': 'district-area district-divider animated fadeInUp clearfix',
			}).insertAfter(heading);

				$('<p />', {
					'class': 'text-center district-area-figure',
					'html': info.area.value.toLocaleString('en-GB') + ' ' + info.area.unit_short
				}).appendTo(area);

			var population = $('<div />', {
				'class': 'district-population district-divider animated fadeInUp',
				'html': '<h4><i class="fa fa-male"></i> <i class="fa fa-female"></i> Population</h4> '
			}).insertAfter(area);

				var popStats = $('<dl />', { 'class': 'dl-horizontal' }).appendTo(population);

					var y1981 = $('<dt />', {
						'html': '1981'
					}).appendTo(popStats);

					$('<dd />', {
						'html': info.population.year[1981] ? info.population.year[1981].toLocaleString('en-GB') : 'N/A'
					}).appendTo(popStats);

					var y1998 = $('<dt />', {
						'html': '1998'
					}).appendTo(popStats);

					$('<dd />', {
						'html': info.population.year[1998] ? info.population.year[1998].toLocaleString('en-GB') : 'N/A'
					}).appendTo(popStats);

				var popGender = $('<div />', {
					'class': 'district-gender-ratio district-divider animated fadeInUp',
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
				'class': 'district-litracy-ratio district-divider animated fadeInUp',
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
				'class': 'district-household district-divider animated fadeInUp',
				'html': '<h4><i class="fa fa-users"></i> Household average:</h4>'
			}).insertAfter(litracyRatio);

				$('<p />', {
					'class': 'district-household-average',
					'html': info.household.size + ' persons per house'
				}).appendTo(household);

			var housing = $('<div />', {
				'class': 'district-housing district-divider animated fadeInUp',
				'html': '<h4><i class="fa fa-home"></i> Housing</h4>'
			}).insertAfter(household);

				$('<p />', {
					'html': 'Total: ' + info.housing.units.total.toLocaleString('en-GB')
				}).appendTo(housing);

				if ( info.housing.have_utilities.electricity ) {

					$('<p />', {
						'html': '<i class="fa fa-lightbulb-o"></i> Electricity: ' + info.housing.have_utilities.electricity.value.toLocaleString('en-GB') + ' &ndash; ' + info.housing.have_utilities.electricity.percentage + '%'
					}).appendTo(housing);
				}

				if ( info.housing.have_utilities.water ) {

					$('<p />', {
						'html': '<i class="fa fa-tint"></i> Water: ' + info.housing.have_utilities.water.value.toLocaleString('en-GB') + ' &ndash; ' + info.housing.have_utilities.water.percentage + '%'
					}).appendTo(housing);
				}

				if ( info.housing.have_utilities.gas ) {

					$('<p />', {
						'html': '<i class="fa fa-fire"></i> Gas: ' + info.housing.have_utilities.gas.value.toLocaleString('en-GB') + ' &ndash; ' + info.housing.have_utilities.gas.percentage + '%'
					}).appendTo(housing);
				}

			if ( info.boundary && info.boundary.path ) {
				var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
				var svgNS = svg.namespaceURI;

				svg.setAttribute('version', '1.1');
				svg.setAttribute('id', info.boundary.meta.id);
				svg.setAttribute('width', parseInt(info.boundary.meta.width) / 1.25);
				svg.setAttribute('height', parseInt(info.boundary.meta.height) / 1.25);
				svg.setAttribute('x', info.boundary.meta.x);
				svg.setAttribute('y', info.boundary.meta.y);
				svg.setAttribute('viewBox', info.boundary.meta.viewBox);
				svg.setAttribute('enable-background', 'new ' + info.boundary.meta.viewBox);
				svg.setAttribute('xml:space', 'preserved');

				var path = document.createElementNS(svgNS, 'path');

				path.setAttribute('class', 'district-boundary');
				path.setAttribute('fill', '#ffffff');
				path.setAttribute('stroke', '#006838');
				path.setAttribute('stroke-width', '1.15');
				path.setAttribute('d', info.boundary.path.join(' '));

				svg.appendChild(path);
				area[0].appendChild(svg);
				$(svg).wrap($('<div />', { 'class': 'district-svg text-center' }));
			}

			$('<button />', {
				'class': 'close clearfix',
				'html': '&times;'
			}).prependTo(appcontent).on('click', _this.closeIW);
		}

	};


	return pkcensus;
});