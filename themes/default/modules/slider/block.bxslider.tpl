<!-- BEGIN: main -->
<!-- BEGIN: load_bxslider -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MOD_FILE}/plugins/bxslider/jquery.bxslider.css" media="all"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MOD_FILE}/plugins/bxslider/jquery.bxslider.min.js"></script>
<!-- END: load_bxslider -->
<div id="nvslider{BLOCKID}" >
    <ul id="slider{BLOCKID}"class="bxslider" style="visibility:hidden">
		<!-- BEGIN: loop -->
        <li>
            <a href="{DATA.link}" title="{DATA.title}">
                <img alt="{DATA.title}" src="{DATA.image}" title="{DATA.title}"  />
            </a>
        </li>
		<!-- END: loop -->
	</ul>
</div>
<script type="text/javascript">
$('#slider{BLOCKID}').bxSlider({auto: true, adaptiveHeight: true, mode: 'horizontal', onSliderLoad: function(){
	$('#slider{BLOCKID}').css("visibility", "visible");
}});
</script>
<!-- END: main -->

