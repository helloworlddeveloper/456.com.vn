<!-- BEGIN: main -->
<style type="text/css">
#slider-customer .bx-wrapper img {
    max-width: 100%;
    display: block;
    height: 70px;
    border: 1px solid #ccc;
} 
#slider-customer .bx-wrapper .bx-viewport {
	height: 80px !important;
} 
</style>
<!-- BEGIN: load_bxslider -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MOD_FILE}/plugins/bxslider/jquery.bxslider.css" media="all"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MOD_FILE}/plugins/bxslider/jquery.bxslider.min.js"></script>
<!-- END: load_bxslider -->
<div id="slider-customer" >
    <ul id="slidercustomer"class="bxslider" style="visibility:hidden">
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
$('#slidercustomer').bxSlider({
	auto: true,
	slideWidth: 172,
    minSlides: 2,
    maxSlides: 6,
    slideMargin: 10,
	onSliderLoad: function(){
		$('#slidercustomer').css("visibility", "visible");
	}
});
</script>
<!-- END: main -->

