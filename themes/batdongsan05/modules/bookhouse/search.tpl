<!-- BEGIN: main -->

<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/rAF.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/ResizeSensor.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/sticky-sidebar.js"></script>
<!-- BEGIN: note -->
<div class="text-center">
	<div class="alert alert-info">{NOTE}</div>
</div>
<!-- END: note -->
<div class="list_bds container clearfix">
	<div class="row">
		<div id="setwidth" class="col-md-16">
			{DATA}
			<!-- BEGIN: page -->
			<div class="text-center">{PAGE}</div>
			<!-- END: page -->
		</div>
		<div class="col-md-8 ">
			<div id="sidebar">
			<div class="sidebar__inner">
			<div class="ban_do_bds">
			<script>
				window.onload = function() {
					 var mydiv = document.getElementById('setwidth');
					 var offset = mydiv.getBoundingClientRect();
					 var offsetLeft = offset.left;
					 
					$('.ban_do_bds').width($("body").width() - $("#setwidth").width() - offsetLeft - 50);
				}
			</script>
		<div class="content_maps">
	<style>#map_canvas { width:100%; height: 700px; }</style>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyA7_ZyiNQBuJxZKsoOWWNGshZx8kewMt7o"></script>
		
		<div id="map_canvas"></div>

		<script>
		var map;
		var markersArray = [];
		var image_cuahang = 'img/';
		var bounds = new google.maps.LatLngBounds();
		var loc;

		function init(){
			var mapOptions = { mapTypeId: google.maps.MapTypeId.ROADMAP };
			map =  new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
			
			<!-- BEGIN: address -->
			loc = new google.maps.LatLng({maps.maps_maplat},{maps.maps_maplng});
			bounds.extend(loc);
			addMarker(loc, '{row.title}', "active", '{row.link}', '{row.imghome}', '{NV_BASE_SITEURL}themes/{TEMPLATE}/images/map.png');
			<!-- END: address -->
			
			map.fitBounds(bounds);
			map.panToBounds(bounds);    
		}

		function addMarker(location, title, active, link, image, anh_loai) {   

			var markerIcon = {
				  url: anh_loai,
				  scaledSize: new google.maps.Size(40, 40),
				  origin: new google.maps.Point(0, 0),
				  anchor: new google.maps.Point(32,65),
				  labelOrigin: new google.maps.Point(40,33)
				};
				
			var marker = new google.maps.Marker({
				position: location,
				icon: markerIcon,
				map: map,
				title: title,
				status: active
			});
			
			var html ='<div class="content_map_main"><div class="tiede_map_main"><a href="'+ link +'">'+ title +'</a></div><div class="image_des_map"><a href="'+ link +'"><img src="'+ image +'"/></a></div></div>';
				var infowindow = new google.maps.InfoWindow({
				  content:html
				  }); 
							
				marker.addListener('click', function() {
					 infowindow.open(map, marker); 
				});
				
				
		}

		$(function(){ init(); });
		</script>
</div>

<div class="clear"></div>
					
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

		var a = new StickySidebar('#sidebar', {
			topSpacing: 0,
			bottomSpacing: 0,
			containerSelector: '.container',
			innerWrapperSelector: '.sidebar__inner'
		});
	</script>
<!-- END: main -->