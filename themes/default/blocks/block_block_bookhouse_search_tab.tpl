<!-- BEGIN: main -->
<div class="tabs tabs_bds content_form_block">
	<form action="#" method="post" class="form-horizontal">
		<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP_NAME}" />
		<input type="hidden" name="tab_index" id="tab_index" value="0" />
		<div class="margin-bottom"><strong>{LANG.tim_kiem} </strong></div>
		<ul class="nav nav-tabs" role="tablist">
			<!-- BEGIN: tab -->
			<li role="presentation" class="{TAB.active}"><a href="#block_search_type_tab" aria-controls="block_search_type_tab" role="tab" data-toggle="tab" data-catid="{TAB.id}" data-index="{TAB.index}">{TAB.title}</a></li>
			<!-- END: tab -->
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="block_search_type_tab">
				<div class="input-group margin-bottom">
					<input type="text" value="{SEARCH.keywords}" class="form-control" name="keywords" placeholder="{LANG.keywords}">
					<span class="input-group-btn">
						<span class="button_block_search">
							<span class="btn btn-info bton_search">{LANG.search}</span>
						</span>
					</span>
				</div>
				<div class="col-sm-6 col-md-6 pd_15">
					<div class="form-group">
							<!-- BEGIN: cat -->
							<select name="catid" class="form-control tab_cat {CAT_HIDDEN}" id="search_tab_{CATID}" {DISABLED}>
								<option value="0-0">--Chọn loại hình--</option>
								<!-- BEGIN: loop -->
								<option value="{CAT.id}"{CAT.selected}>{CAT.space}{CAT.title}</option>
								<!-- END: loop -->
							</select>
							<!-- END: cat -->
					</div>
				</div>
				<div class="col-sm-6 col-md-6 pd_15">
					<!-- BEGIN: area -->
						<div class="form-group">
							<select chon="{SEARCH.area}" class="form-control" name="area">
											<option value="0-0">--Diện tích--</option>
											<option value="0-30">&lt;= 30 m2</option>
											<option value="30-50">30 - 50 m2</option>
											<option value="50-80">50 - 80 m2</option>
											<option value="80-100">80 - 100 m2</option>
											<option value="100-150">100 - 150 m2</option>
											<option value="150-200">150 - 200 m2</option>
											<option value="200-250">200 - 250 m2</option>
											<option value="250-300">250 - 300 m2</option>
											<option value="300-500">300 - 500 m2</option>
											<option value="500-0">&gt;= 500 m2</option>
								</select>
						</div>
					<!-- END: area -->
				</div>
				<div class="col-sm-6 col-md-6 pd_15">
					<!-- BEGIN: size -->
					<div class="form-group">
						<input type="text" class="form-control" name="size_v" value="{SEARCH.size_v}" placeholder="{LANG.size_v}" />
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="size_h" value="{SEARCH.size_h}" placeholder="{LANG.size_h}" />
					</div>
						<!-- END: size -->
				</div>
				<div class="col-sm-6 col-md-6 pd_15">
					<div class="form-group">
						<select chon="{SEARCH.price_spread}" name="price_spread" class="form-control">
						<option value="0">---{LANG.price_spread_c}---</option>
						<option value="0-500000000" class="advance-options">&lt; 500 triệu</option>
						<option value="500000000-800000000">500 - 800 triệu</option>
						<option value="800000000-1000000000">800 triệu - 1 tỷ</option>
						<option value="1000000000-2000000000">1 - 2 tỷ</option>
						<option value="2000000000-3000000000">2 - 3 tỷ</option>
						<option value="3000000000-5000000000">3 - 5 tỷ</option>
						<option value="5000000000-7000000000">5 - 7 tỷ</option>
						<option value="7000000000-10000000000">7 - 10 tỷ</option>
						<option value="10000000000-20000000000">10 - 20 tỷ</option>
						<option value="20000000000-30000000000">20 - 30 tỷ</option>
						<option value="30000000000-0">&gt; 30 tỷ</option>
					</select>
					</div>
				</div>
			</div> 	
			<div class="form-group">
				{LOCATION}
			</div>	
		</div>
	</form>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/default/js/bookhouse_autoNumeric-1.9.41.js"></script>

<script>
	$('.bton_search').click(function(){
		var key = $('.content_form_block input[name=keywords]').val();
		var dia_diem = '';
		var value_province = $('.content_form_block select[name=provinceid]').val();
		if(value_province > 0)
		  dia_diem = $('.content_form_block select[name=provinceid] option:selected').text();
		
		var search = key + ' ' + dia_diem ;
		
		var link = link_alias(search);
		if(link == '/')
			link = '/timkiem';
		$('.content_form_block form').attr('action', 'http://batdongsan2018.xxx' + link +'/');   
		$('.content_form_block form').submit();
		
		//alert(link);
		
	});
	
	function link_alias(title)
	{
	var html = '';
	if (title != '') {
		$.ajax({
				type : 'POST',
				async: false,
				url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=bookhouse&' + nv_fc_variable + '=main',
				data : { get_alias_title : title},
				success : function(res){
					html = res;
				}
			});
		}
		return html;
	}
	
</script>

<script>
	$(document).ready(function() {
	
		// selected
		var area = $('select[name=area]').attr('chon');
		$("select[name=area] option").each(function() {
			if($(this).val() == area)
			{
				$(this).attr('selected','selected');
			}
		});
		
		var price_spread = $('select[name=price_spread]').attr('chon');
		$("select[name=price_spread] option").each(function() {
			if($(this).val() == price_spread)
			{
				$(this).attr('selected','selected');
			}
		});
		
	
		
		// end selected
		var Options = {
			aSep : '{DES_POINT}',
			aDec : '{THOUSANDS_SEP}',
			vMin : '0',
			vMax : '999999999'
		};
		$('.price').autoNumeric('init', Options);
		$('.price').bind('blur focusout keypress keyup', function() {
			$(this).autoNumeric('get', Options);
		});

		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			$('#tab_index').val($(this).attr('data-index'));
			$('.tab_cat').addClass('hidden').attr('disabled', true);
			$('#search_tab_' + $(this).attr('data-catid')).removeClass('hidden').attr('disabled', false);
		});
	});
</script>
<!-- END: main -->

<!-- BEGIN: config -->
<tr>
	<td>{LANG.catid}</td>
	<td>
		<div style="height: 150px; overflow: scroll; border: solid 1px #ddd; padding: 10px">
			<!-- BEGIN: cat -->
			<label class="show"><input type="checkbox" name="config_catid[]" value="{CAT.id}" {CAT.checked} >{CAT.title}</label>
			<!-- END: cat -->
		</div>
	</td>
</tr>
<tr>
	<td>{LANG.price_begin}</td>
	<td><input type="number" name="config_price_begin" value="{DATA.price_begin}" class="form-control" /></td>
</tr>

<tr>
	<td>{LANG.price_end}</td>
	<td><input type="number" name="config_price_end" value="{DATA.price_end}" class="form-control" /></td>
</tr>

<tr>
	<td>{LANG.price_step}</td>
	<td><input type="number" name="config_price_step" value="{DATA.price_step}" class="form-control" /></td>
</tr>
<!-- END: config -->