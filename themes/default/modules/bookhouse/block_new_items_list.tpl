<!-- BEGIN: main -->
<div class="block_new_items_list">
	<!-- BEGIN: newloop -->
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="image pull-left" style="width: {THUMB_WIDTH}px; height: {THUMB_HEIGHT}px; overflow: hidden">
				<a title="{blocknew_items.title}" href="{blocknew_items.link}">
					<img src="{blocknew_items.imgurl}" alt="{blocknew_items.title}" width="{THUMB_WIDTH}" class="img-thumbnail" />
				</a>
			</div>
			<div class="item-detail">
				<ul>
					<li><h2><a title="{blocknew_items.title}" href="{blocknew_items.link}" style="color: {blocknew_items.color}">{blocknew_items.title}</a></h2></li>
					<li><label><em class="fa fa-tag">&nbsp;</em>{LANG.price}:</label> {blocknew_items.price}</li>
					<li>
						<label><em class="fa fa-area-chart">&nbsp;</em>{LANG.area}:</label>
						<!-- BEGIN: area -->
						{blocknew_items.area} m<sup>2</sup>
						<!-- END: area -->
						<!-- BEGIN: size -->
						<!-- BEGIN: content -->
						{blocknew_items.size_h} x {blocknew_items.size_v} m
						<!-- END: content -->
						<!-- END: size -->
					</li>
					<li><label><em class="fa fa-map-marker">&nbsp;</em>{LANG.items_location}:</label> {blocknew_items.location}</li>
				</ul>				
			</div>
		</div>
	</div>
	<!-- END: newloop -->
</div>
<!-- END: main -->