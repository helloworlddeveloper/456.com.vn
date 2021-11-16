<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}

<section class="banner">
	[HEADER]
</section>
<div class="wraper margintop">
	<div class="row">
		<div class="col-sm-24 col-md-24">
			[TOP]
			{MODULE_CONTENT}
			[BOTTOM]
		</div>
	</div>
</div>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->