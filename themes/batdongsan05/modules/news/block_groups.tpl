<!-- BEGIN: main -->
<div class="row">
	<!-- BEGIN: loop -->
	<div class="col-md-8 col-sm-8">
		<div class="item_new">
		<!-- BEGIN: img -->
		<a href="{ROW.link}" title="{ROW.title}" {ROW.target_blank} ><img src="{ROW.thumb}" alt="{ROW.title}" width="{ROW.blockwidth}" style="height:190px" class="img-thumbnail"/></a>
		<!-- END: img -->
			<div class="panel-body">
				<h3><a {TITLE} class="show" href="{ROW.link}">{ROW.title_clean}</a></h3>
				<p>
					{ROW.hometext_clean}
				</p>
				<a {TITLE} class="pull-right text_xemthem" href="{ROW.link}">Xem thêm</a>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- END: loop -->
</div>
<!-- END: main -->