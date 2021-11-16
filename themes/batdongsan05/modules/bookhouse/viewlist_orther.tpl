<!-- BEGIN: main -->
<div class="content_block_tin_home">
	<div class="title_qltine">{TITLE}</div>
			<!-- BEGIN: loop -->		
						<div class="item_blocktin">
							<div class="image_blocktin col-xs-8 col-sm-6 col-md-5">
								<a title="{DATA.title}" href="{DATA.link}">
									<img src="{DATA.imghome}" alt="{DATA.title}"/>
								</a>
							</div>
							<div class="nd_blocktin col-xs-16 col-sm-18 col-md-19">
								<div class="row">
									<div class="tieude_blocktin col-sm-18 col-md-18"><a style="color:{ma_mau}" title="{DATA.title}" href="{DATA.link}">{DATA.title}</a>
									<!-- BEGIN: image -->	
									<img src="{image_block}"/>
									<!-- END: image -->	
									</div>
									<div class="col-sm-6 col-md-6">
										<div class="gia_blocktin text-right">
										 <!-- BEGIN: price --><span class="gia_tinrao">{DATA.price} {DATA.price_time}<span><!-- END: price -->
										 <!-- BEGIN: contact --><span class="gia_tinrao">{LANG.contact}</span><!-- END: contact --> 
										 </div>
									</div>
								</div>
								
								<div class="vitri_blocktin">{DATA.location}</div>
								<div class="dt_blocktin">
									<img src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/nha-dat/icon-dien-tich.png"/>
									{DATA.area} m<sup>2</sup>
								</div>
								<div class="des_blocktin">{DATA.hometext}</div>
								
								<div class="date_blocktin"><span>Ngày đăng: </span>{DATA.ordertime}</div>
								
							</div>
						</div>
	<!-- END: loop -->
		
</div>
<!-- END: main -->
