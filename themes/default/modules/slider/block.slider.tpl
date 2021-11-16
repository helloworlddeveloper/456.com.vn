<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/owl.carousel.css"/>
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/owl.theme.default.css"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/owl.carousel.min.js"></script>
<div class="owl-carousel">
	<!-- BEGIN: loop -->
	<div>
		<a href="" title="{DATA.title}">
			<img class="img-responsive" alt="{DATA.title}" src="{DATA.image}">
		</a>
		<div class="col-md-6 text-middle-main-top hidden-xs">
			<h2 class="multipurpose">{DATA.title}</h2><p>
			{DATA.description}</p><a href="{DATA.link}" class="btn btn-readmore">Xem chi tiết</a>
		</div>
	</div>
	<!-- END: loop -->
</div>
<script>
$('.owl-carousel').owlCarousel({
    loop:true,
	autoplay:1000,
	smartSpeed:2000,
    margin:0,
    responsiveClass:true,
	dots:false,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        }
    }
})
</script>
<!-- END: main --> 