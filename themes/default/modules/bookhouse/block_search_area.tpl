<!-- BEGIN: main -->
<div class="block_search_area">
	<form action="{NV_BASE_SITEURL}" method="get" class="form-horizontal">
		<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP_NAME}" />
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">{LOCATION}</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<input type="text" class="form-control" name="keywords" placeholder="{LANG.keywords}">
			</div>
		</div>
		<button type="submit" name="search" class="btn btn-primary">{LANG.search}</button>
	</form>
</div>
<!-- END: main -->