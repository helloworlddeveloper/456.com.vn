<!-- BEGIN: main -->
<p class="text-center mgb_30"><strong><i>{LANG.info_block}</i></strong></p>
<div class="block_new_items_list">
	<div class="row">
		<!-- BEGIN: newloop -->
			<div class="col-md-6 col-sm-12" {clear}>
					<div class="thumbnail">
						<div class="img">
							<a title="{blocknew_items.title}" href="{blocknew_items.link}">
								<img src="{blocknew_items.imgurl}" alt="{blocknew_items.title}" width="100%" class="img-thumbnail" />
							</a>
						</div>
						<div class="item-detail">
							<h3><a title="{blocknew_items.title}" href="{blocknew_items.link}" style="color: {blocknew_items.color}">{blocknew_items.title}</a></h3>
							<p class="dia_chi">{blocknew_items.location}</p>
							<p class="info_bds">
								<label>
									<em class="fa fa-bath">&nbsp;</em>	
									{blocknew_items.phong_tam}
								</label>
								<label>
									<em class="fa fa-bed">&nbsp;</em>	
									{blocknew_items.phong_ngu}
								</label>
								<label>
									<em class="fa fa-arrows">&nbsp;</em> 
									{blocknew_items.area} {LANG.m2}</sup> 
								</label>
								<span class="pull-right">
									{blocknew_items.price}&nbsp;<span style="text-transform: uppercase;">{blocknew_items.money_unit} </span>/{blocknew_items.price_time}
								</span>	
							</p>
						</div>
					</div>
			</div>
		<!-- END: newloop -->
	</div>
</div>
<!-- END: main -->