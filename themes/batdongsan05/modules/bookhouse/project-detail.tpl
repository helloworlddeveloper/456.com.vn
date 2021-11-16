<!-- BEGIN: main -->
<div id="detail" class="project-detail">
	<div id="slider" class="flexslider">	
		<ul class="slides">
			<!-- BEGIN: image -->
                <!-- BEGIN: loop_img -->
                    <li>
                        <img src="{IMG}" alt="{DATA.title}">
                    </li>
                <!-- END: loop_img -->
			<!-- END: image -->
		</ul>
	</div>
	<div class="wraper">
		<div class="row">
			<div class="col-md-18">
				<h1 class="m-bottom">{DATA.title}</h1>
				{DATA.location}
				<hr>
					<div class="row">	
						<div class="col-md-6">	
							<p>{LANG.sophong}:  <strong> {DATA.sophong} </strong> </p>
							<p>{LANG.soblock}: <strong> {DATA.soblock}</strong></p>
						</div>
						<div class="col-md-6">	
							<p>{LANG.chudautu}: <strong> {DATA.chudautu}</strong></p>
							<p>{LANG.sotang}: <strong> {DATA.sotang}</strong></p>
						</div>
						<div class="col-md-6">	
							<p>{LANG.area}: <strong> {DATA.dientich}</strong></p>
							<p>{LANG.socan}: <strong> {DATA.socanho}</strong></p>
						</div>
						<div class="col-md-6">	
							<p>{LANG.giaban}: <strong> {DATA.giaban}</strong></p>
							<p>{LANG.giathue}: <strong> {DATA.giathue}</strong></p>
						</div>
					</div>
				<hr>
                <ul class="nav nav-tabs">
                    <li class="tab-li"><a data-toggle="tab" aria-expanded="false" href="#menu_1">{LANG.items_hometext}</a></li>
                    <li class="tab-li"><a data-toggle="tab" aria-expanded="false" href="#menu_2">{LANG.detail_info}</a></li>
                    <li class="tab-li"><a data-toggle="tab" aria-expanded="false" href="#menu_3">{LANG.tien_ich}</a></li>
              
                </ul>
                <div class="tab-content"> 
					<!-- BEGIN: descriptionhtml -->
                    <div id="menu_1" class="tab_list tab-pane fade">
						<h2>{DATA.description}</h2>
						<div id="mieuta" class="mieuta">
							<div style="height:100%">
								<div style="height: 86%;padding:15px;overflow: hidden;">
									{DATA.descriptionhtml}
								</div>
							</div>
							<div class="text_morong"> 
								<a id="click_xt" href="#">>>> <span>{LANG.xemthem}</span></a>
							</div>
						</div>
							<script> 
		$(document).ready(function(){
			var flag = true;
			$("#click_xt span").click(function(){
				if(flag)
				{
					$("#mieuta").animate({
							height: '100%',
					});
					$(this).text('Thu gọn');
					flag = false;
				}
				else{
					$("#mieuta").animate({
							height: '250px',
					});
					$(this).text('Xem thêm');
					flag = true;
				}
			});
			
			
		});
	</script>  
						
                    </div>
					<!-- END: descriptionhtml -->
					<div id="menu_2" class="tab-pane fade">
						<div class="info-basic row">
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.dientichxd}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.dientichxd}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.thoigianxd}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.thoigianxd}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.thoigiangn}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.thoigiangn}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.sophong}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.sophong}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.vondautu}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.vondautu}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.soblock}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.soblock}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.sotang}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.sotang}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.socan}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.socanho}
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.khonggianxanh}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.khonggianxanh}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.matdo}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.matdo}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.dientichcanho}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.dientich}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.chudautu}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.chudautu}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.phiquanly}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.phiquanly}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.phixemay}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.giuxemay}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="clearfix">
									<div class="border-bottom">
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.phioto}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{DATA.giuoto}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="menu_3" class="tab-pane fade">
						<div class="info-basic">
							<div class="title">
								{LANG.tien_ich}
							</div>
							<div class="content">
								<div class="row">
									<!-- BEGIN: tien_ich -->
										<div class="col-md-12">
											<div class="clearfix">
												<div class="border-bottom">
													<div class="col-md-16 col-xs-14 mrgl-15">
														{tien_ich.title}
													</div>
													<div class="col-md-8 col-xs-10 mrgl-15">
														{checked}
													</div>
												</div>
											</div>
										</div>
									<!-- END: tien_ich -->
								</div>
							</div>
						</div>
					</div>
                </div>
                <ul class="nav nav-tabs">
                    <!-- BEGIN: head_title -->
                    <li class="tab-lili"><a data-toggle="tab" aria-expanded="false" href="#menu{TYPE.id}">{TYPE.title}</a></li>
                    <!-- END: head_title -->
                </ul>
                <div class="tab-content">
                    <!-- BEGIN: type -->    
                    <div id="menu{TYPE.id}" class="tab_list1 tab-pane fade">
                        <div id="main_div_{TYPE.id}">{OTHER}</div>
                    </div>
                    <!-- END: type -->
                </div>
			</div>
			<div id="lien_he_detail" class="col-md-6">
				[LIEN_HE]
			</div>		
			
		</div>
	</div>

<link rel="stylesheet" href="/themes/batdongsan05/css/flexslider.css" type="text/css" media="screen" />
<script defer src="/themes/batdongsan05/js/jquery.flexslider-min.js"></script>

<script>
    $(".tab_list:first").addClass("active in");
    $(".tab-li:first").addClass("active");
	
	$(".tab_list1:first").addClass("active in");
    $(".tab-lili:first").addClass("active");
	
  jQuery(window).on("load", function() {
  // The slider being synced must be initialized first
  jQuery('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: true,
    itemWidth: 90,
    itemMargin: 5,
    asNavFor: '#slider'
  });

  jQuery('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 450,
	itemMargin:10,
    sync: "#carousel"
  });
});
  jQuery(document).ready(function() {
    jQuery(".fancybox-thumb").fancybox({
      prevEffect  : 'elastic',
      nextEffect  : 'elastic',
      helpers : {
        title : {
          type: 'outside'
        },
        thumbs  : {
          width : 100,
          height  : 100
        }
      }
    });
  });
</script>

</div>
<!-- END: main -->


<!-- BEGIN: list -->
{DATA}
<!-- BEGIN: generate_page -->
<div class="text-center">{PAGE}</div>
<!-- END: generate_page -->
<!-- END: list -->
