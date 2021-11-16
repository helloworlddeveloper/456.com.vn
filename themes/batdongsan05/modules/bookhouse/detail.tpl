<!-- BEGIN: main -->
<div id="detail">
	
	<!-- BEGIN: image -->
	<div id="slider" class="flexslider">	
		<ul class="slides">
			<!-- BEGIN: loop -->
				<li><img src="{IMAGE}" alt="" /></li>
			<!-- END: loop -->
		</ul>
	</div>
	<!-- END: image -->
	<div class="wraper">
		<div class="row">
			<div class="col-md-18">
				<div class="address-top">
					<!-- BEGIN: code -->
						{DATA.code}*
					<!-- END: code -->
					<!-- BEGIN: address -->
						{ADDRESS}
					<!-- END: address -->
				</div>	
				<div class="title">
					<h1>{DATA.title} </h1>
				</div>
				<div class="info-box">
				<div class="row">
					<div class="col-md-6 col-xs-24">
						<div class="info">
							<!-- BEGIN: area -->
								{LANG.area}: <strong>{DATA.area} {LANG.m2}</strong>
							<!-- END: area -->
						</div>
					</div>
					<div class="col-md-7 col-xs-24">
						<div class="info">
							{LANG.price}:
							<strong>{DATA.price} <span style="text-transform: uppercase;">{DATA.money_unit} </span>/{DATA.price_time}</strong>
						</div>
					</div>
					<div class="col-md-7 col-xs-24">
						<div class="info">
							{LANG.loaihinh_a}: <strong><a href="{DATA.cat_link}"
							title="{DATA.cat_title}"> {DATA.cat_title}</a></strong>
						</div>
					</div>
					<div class="col-md-4 col-xs-24">
						<div class="rooms info">
							<i class="fa fa-bath" aria-hidden="true"></i><strong>{DATA.phong_tam}</strong>
							<i class="fa fa-bed" aria-hidden="true"></i><strong>{DATA.phong_ngu}</strong>
						</div>
					</div>
					<div class="col-md-24 col-xs-24">
						<div class="info">
							<!-- BEGIN: project -->
								{LANG.project}:<strong>
								<a href="{DATA.linkduan}" title="{DATA.duan}">{DATA.duan}</a>
								</strong>
							<!-- END: project -->
						</div>
					</div>
				</div>
			</div>
			
				<div class="title-des">
					{LANG.gioithieu_d}
				</div>
				<div class="description">
					<br>
					<h2>{DATA.hometext} </h2>
					<hr>
					{DATA.bodytext}
				</div>
				
				<div class="info-basic">
					<div class="title">
						{LANG.info_d}
					</div>
						<div class="content">
							<div class="row">
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{LANG.area}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{DATA.area} {LANG.m2}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{LANG.phongngu}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{DATA.phong_ngu}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
									
										<div class="col-md-16 col-xs-14 mrgl-15">
											{LANG.cd}
										</div>
										<div class="col-md-8 col-xs-10 mrgl-15">
											{LANG.capnhat}
										</div>
									
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{LANG.phongtam_a}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{DATA.phong_tam}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{LANG.cr}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{LANG.capnhat}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{LANG.thue_ban}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{DATA.price} <span style="text-transform: uppercase;">{DATA.money_unit} </span>/{DATA.price_time}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{LANG.noi_that}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{noi_that_daydu}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{LANG.tien_ich}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{tien_ich_daydu}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="info-basic">
					<div class="title">
						{LANG.noi_that}
					</div>
					<div class="content">
						<div class="row">
							<!-- BEGIN: noi_that -->
								<div class="col-md-12">
									<div class="clearfix">
										<div class="border-bottom">
											<div class="col-md-16 col-xs-14 mrgl-15">
												{noi_that.title}
											</div>
											<div class="col-md-8 col-xs-10 mrgl-15">
												{checked}
											</div>
										</div>
									</div>
								</div>
							<!-- END: noi_that -->
						</div>
					</div>
				</div>
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
		
			<div id="lien_he_detail" class="col-md-6">
				[LIEN_HE]
			</div>		
		</div>	
		<!-- BEGIN: other -->
			<div class="title">
				{LANG.other}
			</div>
			<div class="row">	
				<!-- BEGIN: loop -->
				<div class="col-sm-12 col-md-6 col-xs-12">
					<div class="thumbnail grid-news">
						<div class="img">
							<a title="{OTHER.title}" href="{OTHER.link}"><img alt="{OTHER.title}" src="{OTHER.imghome}" class="img-thumbnail"></a>
						</div>
						<div class="item-detail">
							<h3><a title="{OTHER.title}" href="{OTHER.link}" style="color: ">{OTHER.title}</a></h3>
							<p class="dia_chi">
								{OTHER.location}
							</p>
							<p class="info_bds">
								<label>
									<em class="fa fa-bath">&nbsp;</em>	
									{OTHER.phong_tam}
								</label>
								<label>
									<em class="fa fa-bed">&nbsp;</em>	
									{OTHER.phong_ngu}
								</label>
								<label>
									<em class="fa fa-arrows">&nbsp;</em>	
									{OTHER.area} {LANG.m2}
								</label>
								<span class="pull-right">
									{OTHER.price}  {DATA.money_unit}/{OTHER.price_time}
								</span>			
						</p></div>
					</div>
				</div>
				<!-- END: loop -->
			</div>
		<!-- END: other -->
		</div>	
	</div>	
</div>	
				
<link rel="stylesheet" href="/themes/batdongsan05/css/flexslider.css" type="text/css" media="screen" />
<script defer src="/themes/batdongsan05/js/jquery.flexslider-min.js"></script>

<script>
  
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

<!-- END: main -->