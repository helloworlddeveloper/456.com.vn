<!-- BEGIN: main -->
<div class="pt-5 pb-5">
	<div class="row">
		<!-- BEGIN: loop -->
		<div class="col-md-4">
			<div class="icon_h">
				<!-- BEGIN: image_only --><img title="{ROW.title}" src="{ROW.image}" class="img-thumbnail"><!-- END: image_only -->
				<!-- BEGIN: image_link --><a href="{ROW.link}" title="{ROW.title}"<!-- BEGIN: target --> target="{ROW.target}"<!-- END: target -->><img src="{ROW.image}" title="{ROW.title}" class="img-thumbnail"></a><!-- END: image_link -->
			</div>
			
			<!-- BEGIN: title_text --><h3>{ROW.title}</h3><!-- END: title_text -->
			<!-- BEGIN: title_link --><h3><a href="{ROW.link}" title="{ROW.title}"<!-- BEGIN: target --> target="{ROW.target}"<!-- END: target -->>{ROW.title}</a></h3><!-- END: title_link -->
			<p class=""> 
				{ROW.description} 
			</p>
		</div>
		<!-- END: loop -->
	</div>
</div>
<!-- END: main -->