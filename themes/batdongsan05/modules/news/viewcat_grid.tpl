<!-- BEGIN: main -->
<!-- BEGIN: viewdescription -->
<div class="news_column">
	<div class="alert alert-info clearfix">
		<h3>{CONTENT.title}</h3>
		<!-- BEGIN: image -->
		<img alt="{CONTENT.title}" src="{HOMEIMG1}" width="{IMGWIDTH1}" class="img-thumbnail pull-left imghome" />
		<!-- END: image -->
		<p class="text-justify">{CONTENT.description}</p>
	</div>
</div>
<!-- END: viewdescription -->
<div class="row">
<!-- BEGIN: viewcatloop -->
<div class="col-sm-12 col-md-8 col-xs-12 ">
	<div class="thumbnail grid-news">
		<div class="img">
			<a title="{CONTENT.title}" href="{CONTENT.link}" {CONTENT.target_blank}><img alt="{HOMEIMGALT1}" src="{HOMEIMG1}" width="{IMGWIDTH1}"/></a>
		</div>
		<div class="title">
			<h3><a class="show" href="{CONTENT.link}" {CONTENT.target_blank} <!-- BEGIN: tooltip -->data-content="{CONTENT.hometext_clean}" data-img="" data-rel="tooltip" data-placement="{TOOLTIP_POSITION}"<!-- END: tooltip --> title="{CONTENT.title}">{CONTENT.title}</a></h3>
		</div>
		<div class="des">
			{CONTENT.hometext_clean1}
		</div>
		<a class="readmore" href="{CONTENT.link}" title="">{LANG.readmore}</a>
	</div>
</div>
<!-- END: viewcatloop -->
</div>
<div class="clear">&nbsp;</div>

<!-- BEGIN: generate_page -->
<div class="text-center">
	{GENERATE_PAGE}
</div>
<!-- END: generate_page -->
<script type="text/javascript">
$(window).on('load', function() {	
	$.each( $('.thumbnail'), function(k,v){
		var height1 = $($('.thumbnail')[k]).height();
		var height2 = $($('.thumbnail')[k+1]).height();
		var height = ( height1 > height2 ? height1 : height2 );
		$($('.thumbnail')[k]).height( height );
		$($('.thumbnail')[k+1]).height( height );
	});
});
</script>
<!-- END: main -->