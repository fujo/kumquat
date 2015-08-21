/*

@renardsuper
https://learn.jquery.com/code-organization/concepts/

*/
;(function($){

	FastClick.attach(document.body); // instantiate FastClick 

	console.log(app_globals);

	var 	APP 	= 	APP || {},
	 		$win 	= 	$(window),
			$doc	=	$(document),

			Modernizr = window.Modernizr,
    		isTouch = Modernizr.touch && navigator.userAgent.match(/(iPhone|iPod|iPad)|BlackBerry|Android/);

			APP = {

		_: function () {

			this.cookie._();
			this.autoscroll._();
			this.loading._();
			this.magnificpopup._();
			this.flexslider._();
			this.ajax._();
			this.mainNav._();
			this.sectionHero._();
			this.parallax._();
			this.helpers._();

			this.googleMap._();

		},

		cookie : {

			_: function() {
				
				var name 		= 'app',
					value 		= -1,
					expires		= 1, 		// days
					path 		= '';		// page path

				Cookies.set( name , value, { expires: expires, path: path });

			}

		},

		autoscroll : {

			options : {
				animScrollSpeed: 1000,
				easing: "easeInOutQuint"
			},

			_: function() {

				var self = this,
					options = this.options;

				this.$h = $(app_globals.url_hash);

				if(this.$h.length){
					$('html, body').animate({scrollTop: self.$h.position().top }, options.animScrollSpeed, options.easing);
				}
			
			}

		},

		loading : {

			_: function() {
				$('#container').imagesLoaded( function() {
  					$('body').addClass('loaded');
  					APP.helpers.vivus._(); // draw the fox
				});
			}

		},

		magnificpopup : {

			_: function() {

				var self = this;

				$('.magnificpopup').each(function() {

					var self = this;

				    $(this).magnificPopup({
				        delegate: 'a', 
				        type: 'image',
				        closeOnContentClick: false, 
				        closeOnBgClick: false,
				        showCloseBtn: true,
				        closeMarkup: '<a class="btn icn close">close</a>',
				        gallery: {
				        	enabled:true
				        },
				        callbacks: {
				        	open: function() {
						      $('a.btn.close').on('click', function(){
						      	$.magnificPopup.close();
						      })
						    }
				        }
				    });
				});


			}
		},

		ajax : {
			_: function(){

				var self = this;

				this.$as 			= $('a.ajax');
				this.$overlay 		= $('#overlay');
				this.scrollTopPos	= 0;
				this.$content		= $('.content');

				this.$as.on('click', function(e){
					e.preventDefault();
					var $this = $(this);
					href = $this.attr("href");
					self.scrollTopPos = $doc.scrollTop();
					self._load(href);
				})

			},
			_load: function(href) {

				var self = this;

				$('body').removeClass('loaded');
				this.$overlay.load( href + " .content", function(data) {
				  	//alert( "Load was performed."+ data );
					$('body').addClass('loaded');	
				  	self.$overlay.css({'position': 'absolute' });
				  	$doc.scrollTop(0);
				  	self._initClose();
				})
				.addClass('show')
				.offset().top;

				//APP.loading._();

				this.$content.height(0).css({'overflow': 'hidden'});

			},
			_initClose: function() {

				var self = this;

				this.$btnC = this.$overlay.find('.close');
				this.$btnC.on('click', function(e){
					e.preventDefault();
					self.$overlay.removeClass('show').css({'position': 'fixed' });
					self.$content.removeAttr('style');
					$doc.scrollTop(self.scrollTopPos);
				})

			}
		},

		flexslider : {
			_: function() {

				var self = this;

				  $('.flexslider').flexslider({
				    	animation: "slide",
				    	controlsContainer: $(".custom-controls-container"),
				    	customDirectionNav: $(".custom-navigation a"),
			    	    animationLoop: true,
			    	    smoothHeight: true
				    	    /*
						    itemWidth: 210,
						    itemMargin: 5,
						    minItems: 1,
						    maxItems: 2
						    */
				  });
				
			}

		},

		mainNav : {
			_: function(){
				var self = this;
				this.$m = $('#mainNavWrapper');
				this.$t = $('.hamburger');
				this.$t.on('click', function(e){
					e.preventDefault();
					$this = $(this);
					$this.toggleClass('active');
					self._open();
				});
			},
			_open: function(el){
				var self = this;
				this.$m.toggleClass('open');

				this.$hrefs = this.$m.find('a');

				this.$hrefs.on('click', function(){
					self._close();
				})
			},
			_close: function(){
				this.$m.removeClass('open');
				this.$t.removeClass('active');
			}
		},

		sectionHero : {
			_: function(){

				var fadeStart=0, 
					fadeUntil=$win.height();

				$win.on("load resize scroll", function(e){
					//$("#hero").outerHeight( $win.height() );
					///////
    				if($win.scrollTop() == 0) $(".bounce").addClass("start");
    				else $(".bounce").removeClass("start");
    				//////

				});
			}
		},

		/* 

		parallax 

		*/

		parallax : {  
			options : {
				speed: 0.04
			},
			_: function(){
				var self = this;
				this.$els = $('.parallax');
				this.$els.each(function(){
					var $el = $(this);
					$win.on("scroll", function(e){
				    	var scrolled = $win.scrollTop() - $el.position().top;
	    				$el.css('background-position', '50% ' + (50 + scrolled * self.options.speed ) + '%');
					});
				})
			}
		},

		/* 

		interactive and css things 

		*/

		helpers : {

			_: function() {
				this.placeholders._();
				this.fixHeader._();
				this.scrollDown._();
				this.scrollHome._();
				this.winHeight._();
				this.fader._();
				this.jumbotron._();

			},

			placeholders : {
				_: function() {

					$('input, textarea').placeholder();

				}

			},

			vivus : {
				_: function() {
					if ( !$('#fox').length ) return;
					new Vivus('fox', {type: 'delayed', duration: 100});
				}

			},

			fixHeader : {
				_: function() {
					var self = this;
					this.$h = $('header');
					$doc.on('scroll load resize' , function() {
					    var top = $(this).scrollTop();
					    //console.log(top);
					    // if statement to do changes
					    // hide().css({'top':-30}).show()
					    //top >= $win.height() ? 
					    top >= 200 ? 
						    self.$h.addClass('fixme').animate({top:0}, 'slow', 'swing') 
					    : 	self.$h.removeClass('fixme');
					});
				}
			},

			scrollDown : {
				options : {
					animScrollSpeed: 1000,
					easing: "easeInOutQuint"
				},
				_: function() {
					this.$sfm = $('.scrollDown');
					if ( !this.$sfm.length ) return;
					var options = this.options;
					this.$sfm.on('click', function(e){
						e.preventDefault();
						var  $wH = $win.height();
						$('html, body').animate({scrollTop: $wH }, options.animScrollSpeed, options.easing);
					});
				}
			},

			scrollHome : {
				options : {
					animScrollSpeed: 1000,
					easing: "easeInOutQuint"
				},
				_: function() {
					this.$sfm = $('.scrollHome');
					if(this.$sfm.length < 1) return;
					var options = this.options;
					this.$sfm.on('click', function(e){
						e.preventDefault();
						$('html, body').animate({scrollTop: 0 }, options.animScrollSpeed, options.easing);
					});
				}
			},

			winHeight : {
				_: function() {

					this.$as = $('.winHeight');
					this.$as.css({
						'height':$win.height(),
						'min-height':$win.height()
					});

				}
			},

			fader : {
				options : { 
				},
				_: function() {
					var self 	= 	this;
					this.$fs 	= 	$('.fade');
					if(this.$fs.length < 1){ return false };
					$doc.on('scroll', function(){
						self.$fs.each(function(){
							var $this = $(this);
							self._fade($this);
						})	
					});

				},
				_fade: function (O) {
					var oXP 	= O.offset().top,
						docXP 	= $doc.scrollTop(), 
						opacity;
					oXP > docXP ? opacity = ((oXP - docXP * 100) / oXP ) * - 0.01 : opacity = 1 ;
					O.css({ 'opacity': 1 - opacity })
				}
			},

			jumbotron : {
				options : { 
				},
				_: function() {
					var self 	= 	this;
					this.$j 	= 	$('.jumbotron');
					this.posX;
					if(this.$j.length < 1){ return false };
					this._init(); // position in the screen
					$doc.on('load scroll resize', function(){
						var top = self.posX - $doc.scrollTop() * - 0.5 ;
						self.$j.css({ 'top': top })
					});
				},
				_init: function() {
					this.posX = ($win.height() / 2 ) - (this.$j.outerHeight() / 2) ;
					this.$j.css({ 'top' : this.posX });
				}
			}

		},

		/*

		Google Map

		*/

		googleMap : {

			options : {
				mapOptions: {
					//center: { lat: app_globals.lat, lng: app_globals.lng },
					zoom: 14,
					//minZoom:5,
					disableDefaultUI: true,
					panControl: true,
					keyboardShortcuts: true,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL 
						},
					rotateControl: false,
					streetViewControl: false,
					draggable: true,
					panControl: false,
					scrollwheel: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					//styles:[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"30"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"gamma":"0.00"},{"lightness":"74"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"3"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
					//styles:[{"stylers":[{"visibility":"simplified"}]},{"stylers":[{"color":"#131314"}]},{"featureType":"water","stylers":[{"color":"#131313"},{"lightness":7}]},{"elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":25}]}]
        			styles:[{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] }, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] }, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 }, {"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] }, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] }, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] }, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#8dc63f"}, {"visibility": "on"} ] } ] 
        		}

			},

			_: function() {

				var options = this.options, self = this;

				this.map;
				this.marker;
				this.markers = new Array();

				this.map = new google.maps.Map(document.getElementById('map-canvas'), options.mapOptions);
				google.maps.event.addDomListener(window, 'load');

				$.each( app_globals.markers, function( index, value ){
    				var myLatlng = new google.maps.LatLng(value.lat ,value.lng );
					self._addMarker(myLatlng, 'title');
					//console.log(index);
				});

				this._fitToMarkers();



			},
			_addMarker: function(myLatlng,title) {

				var iconSVG = {
					path: 'M259.9,198.9c-5.5,9.5-14.5,9.5-20,0L163.7,67.3c-5.5-9.5-19-17.3-30-17.3H19.8c-11,0-15.5,7.8-10,17.3l105,181.5c5.5,9.5,14.5,25.1,20,34.6l105,181.5c5.5,9.5,14.5,9.5,20,0l105-181.5c5.5-9.5,14.5-25.1,20-34.6L490,67.3c5.5-9.5,1-17.3-10-17.3H366.1c-11,0-24.5,7.8-30,17.3L259.9,198.9z',
					fillColor: '#fff',
					fillOpacity: 1,
					scale: 0.2,
					strokeColor: '#000',
					strokeWeight: 2,
					anchor: new google.maps.Point(250,500),
					//origin: new google.maps.Point(100000000,0)
				};

				this.marker = new google.maps.Marker({
				     position: myLatlng,
				     title: title,
				     icon: iconSVG
				});

				this.marker.setMap(this.map);
				this.markers.push(this.marker); 
				
			},

			_fitToMarkers: function() {

				var self = this;
				var markers = this.markers;
				var bounds = new google.maps.LatLngBounds();

				for(i=0;i<markers.length;i++) {
					bounds.extend(markers[i].getPosition());
				}
				// only 1 marker?
				if( this.markers.length == 1 ) {
					// set center of map
				    this.map.setCenter( bounds.getCenter() );
				    this.map.setZoom( 14 );
				} else {
					// fit to bounds
					this.map.fitBounds( bounds );
				}
				// responsiv the map
				google.maps.event.addDomListener(window, 'resize', function() { self.map.setCenter(bounds.getCenter());});

			}

		},
		/* 

		Google Analytics 

		*/
		googleAnalytics : {

			options : {

			},
			_: function(){

			}

		}     

	};


	APP._();
})( jQuery );