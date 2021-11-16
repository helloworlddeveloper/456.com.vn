<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/rAF.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/ResizeSensor.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/sticky-sidebar.js"></script>
<div class="list_bds container clearfix">
	<div class="row">
		<div id="setwidth" class="col-md-24">
			[SEARCH_AJAX]
				<!-- BEGIN: loop -->
					<div class="list-bds">
						<div class="row mrglr0">
							<div class="col-sm-6 col-md-6 pddlr0">
								<!-- BEGIN: homeimg -->
									<a href="{DATA.link}" title="{DATA.title}"><img src="{DATA.homeimg}" alt="{DATA.title}" class="img-thumbnail" /></a>
								<!-- END: homeimg -->
							</div>
							<div class="col-sm-18 col-md-18 pddlr0">
								<div class="des-bds">
									<h2>
										<a href="{DATA.link}" title="{DATA.title}">{DATA.title}</a>
									</h2>
									<p class="dia_chi">
										{DATA.location}
									</p>
									<div class="row">	
									<div class="col-md-12">	
										<p>{LANG.sophong}:<strong> {DATA.sophong} </strong></p>
										<p>{LANG.soblock}: <strong> {DATA.soblock}</strong></p>
									</div>
									<div class="col-md-12">	
										<p>{LANG.chudautu}: <strong> {DATA.chudautu}</strong></p>
										<p>{LANG.sotang}: <strong> {DATA.sotang}</strong></p>
									</div>
									<div class="col-md-12">	
										<p>{LANG.area}: <strong> {DATA.dientich} </strong></p>
										<p>{LANG.socan}:<strong> {DATA.socanho}</strong></p>
									</div>
									<div class="col-md-12">	
										<p>{LANG.giaban}: <strong> {DATA.giaban}</strong></p>
										<p>{LANG.giathue}: <strong> {DATA.giathue}</strong></p>
									</div>
								</div>
								
								</div>
							</div>
						</div>
					</div>
				<!-- END: loop -->
				<!-- BEGIN: page -->
					<div class="text-center">{PAGE}</div>
				<!-- END: page -->
		</div>
	</div>
</div>

<!-- END: main -->