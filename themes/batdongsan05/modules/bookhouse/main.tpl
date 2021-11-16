<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/rAF.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/ResizeSensor.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/batdongsan05/js/sticky-sidebar.js"></script>
<div class="list_bds container clearfix">
	<div class="row">
		<div class="col-md-24">
			[SEARCH_AJAX]
			<!-- BEGIN: viewall -->
				{DATA}
				<!-- BEGIN: page -->
					<div class="text-center">{PAGE}</div>
				<!-- END: page -->
			<!-- END: viewall -->
			<!-- BEGIN: viewcat -->			
				<!-- BEGIN: loop -->
					<div class="panel panel-default">
						<div class="panel-heading">{CAT.title}</div>
							<div class="panel-body">{DATA}</div>
					</div>
				<!-- END: loop -->
			<!-- END: viewcat -->
		</div>
	</div>
</div>
<!-- END: main -->