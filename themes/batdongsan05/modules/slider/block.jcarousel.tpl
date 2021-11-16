<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/batdongsan05/css/owl.carousel-dt.css"/>
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/batdongsan05/css/owl.theme.default-dt.css"/>
<div class="doi-tac-box">
	<div class="cac-du-doi-tac">
			<!-- BEGIN: loop -->
			<div>
				<div class="doi-tac">
					<a href="{DATA.link}" title="{DATA.title}">
						<img class="img-other-hot" alt="{DATA.title}" src="{DATA.image}" title="{DATA.title}"  />
					</a>
				</div>
			</div>
			<!-- END: loop -->
	</div>
</div>
<script>
$('.cac-du-doi-tac').owlCarousel({
    loop:true,
	autoplay:1000,
	smartSpeed:2000,
    margin:0,
    responsiveClass:true,
	dots:false,
	nav:true,
    responsive:{
        0:{
            items:2,
            nav:true,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        },
        600:{
            items:2,
            nav:true,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        },
        1000:{
            items:6,
            nav:true,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        }
    }
})
</script>
<!-- END: main -->

