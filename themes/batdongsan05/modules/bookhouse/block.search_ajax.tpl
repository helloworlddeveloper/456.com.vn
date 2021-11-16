<!-- BEGIN: main -->
<div class="search_filter">
	<ul>
		<li class="list-filter">
			<span>{LANG.loaihinh_a}</span>
			<i class="fa fa-angle-down" aria-hidden="true"></i>
			<ul id="list-bedroom" class="popup">
				<li>
					<!-- BEGIN: loop -->
					<div>
						<input value="{row.id}" type="checkbox" name="catid_s"/> {row.title}
					</div>
						<!-- BEGIN: con -->
						<p class="content_dmcon">
							<input value="{con.id}" type="checkbox" name="catid_s"/> {con.title}
						</p>
						<!-- END: con -->
						
				
					<!-- END: loop -->
				</li>
			</ul>
		</li>
		<li class="list-filter">
			<span>{LANG.items_price} </span>
			<i class="fa fa-angle-down" aria-hidden="true"></i>
			<ul id="list-price" class="popup">
				<!-- BEGIN: language_search_vi -->
				<li>
						<input value="0-10000000" type="checkbox" name="price_spread"/>Dưới 10 triệu
				</li>
				<li>
						<input value="10000000-20000000" type="checkbox" name="price_spread"/>10 đến 20 triệu
				</li>
				<li>
						<input value="20000000-40000000" type="checkbox" name="price_spread"/>20 đến 40 triệu
				</li>
				<li>
						<input value="40000000-100000000" type="checkbox" name="price_spread"/>40 đến 100 triệu
				</li>
				<li>
						<input value="100000000-500000000" type="checkbox" name="price_spread"/>100 đến 500 triệu
				</li>
				<li>
						<input value="500000000-1000000000" type="checkbox" name="price_spread"/>500 đến 1 tỷ
				<li>
				</li>
						<input value="1000000000-3000000000" type="checkbox" name="price_spread"/>1 đến 3 tỷ
				</li>
				<li>
						<input value="3000000000-5000000000" type="checkbox" name="price_spread"/>3 đến 5 tỷ
				</li>
				<li>
						<input value="5000000000-7000000000" type="checkbox" name="price_spread"/>5 đến 7 tỷ
				</li>
				<li>
						<input value="7000000000-10000000000" type="checkbox" name="price_spread"/>7 đến 10 tỷ
				</li>
				<li>
						<input value="10000000000-20000000000" type="checkbox" name="price_spread"/>10 đến 20 tỷ
				</li>
				<li>
						<input value="20000000000-0" type="checkbox" name="price_spread"/>Trên 20 tỷ					
				</li>
				<!-- END: language_search_vi -->
				<!-- BEGIN: language_search_en -->
				<li>
						<input value="0-500" type="checkbox" name="price_spread"/>Under $500
				</li>
				<li>
						<input value="500-1000" type="checkbox" name="price_spread"/>500$ to 1000$
				</li>
				<li>
						<input value="1000-2000" type="checkbox" name="price_spread"/>1000$ to 2000$
				</li>
				<li>
						<input value="2000-5000" type="checkbox" name="price_spread"/>1000$ to 2000$
				</li>
				<li>
						<input value="5000-25000" type="checkbox" name="price_spread"/>5000$ to 25000$
				</li>
				<li>
						<input value="25000-50000" type="checkbox" name="price_spread"/>25000$ to 50000$
				</li>
				<li>
						<input value="50000-150000" type="checkbox" name="price_spread"/>50000$ to 150000$
				</li>
				<li>
						<input value="150000-275000" type="checkbox" name="price_spread"/>150000$ to 275000$
				</li>
				<li>
						<input value="275000-350000" type="checkbox" name="price_spread"/>275000$ to 350000$
				</li>
				<li>
						<input value="350000-500000" type="checkbox" name="price_spread"/>350000$ to 500000$
				</li>
				<li>
						<input value="500000-1000000" type="checkbox" name="price_spread"/>500000$ to 1000000$
				</li>
				<li>
						<input value="1000000-0" type="checkbox" name="price_spread"/>Over 1000000$
				</li>
				<!-- END: language_search_en -->
			</ul>
		</li>
		<li class="list-filter">
			<span>{LANG.way} </span>
			<i class="fa fa-angle-down" aria-hidden="true"></i>
			<ul id="list-huong" class="popup">
				<!-- BEGIN: huong -->
					<li>
						<input value="{huong.id}" type="checkbox" name="huong_bds"/> {huong.title}
					</li>
				<!-- END: huong -->
			</ul>
		</li>
		
		<li class="list-filter">
			<span>{LANG.phongkhach_a}</span> 
			<i class="fa fa-angle-down" aria-hidden="true"></i>
			<ul id="list-bedroom" class="popup">
				<li>
					<input value="1" type="checkbox" name="phong_khach"/> 1 {LANG.phong_a}
				</li>
				<li>
					<input value="2" type="checkbox" name="phong_khach"/> 2 {LANG.phong_a}
				</li>
				<li>
					<input value="3" type="checkbox" name="phong_khach"/> 3 {LANG.phong_a}
				</li>
				<li>
					<input value="4" type="checkbox" name="phong_khach"/> 4+ {LANG.phong_a}
				</li>
			</ul>
		</li>
		<li class="list-filter">
			<span>{LANG.phongngu}</span><i class="fa fa-angle-down" aria-hidden="true"></i>
			<ul id="list-bedroom" class="popup">
				<li>
					<input value="1" type="checkbox" name="phong_ngu"/> 1 {LANG.phong_a}
				</li>
				<li>
					<input value="2" type="checkbox" name="phong_ngu"/> 2 {LANG.phong_a}
				</li>
				<li>
					<input value="3" type="checkbox" name="phong_ngu"/> 3 {LANG.phong_a}
				</li>
				<li>
					<input value="4" type="checkbox" name="phong_ngu"/> 4+ {LANG.phong_a}
				</li>
			</ul>
		</li>
		<li class="list-filter">
			<span>{LANG.phongtam_a}</span> 
			<i class="fa fa-angle-down" aria-hidden="true"></i>
			<ul id="list-bedroom" class="popup">
				<li>
					<input value="1" type="checkbox" name="phong_tam"/> 1 {LANG.phong_a}
				</li>
				<li>
					<input  value="2"type="checkbox" name="phong_tam"/> 2 {LANG.phong_a}
				</li>
				<li>
					<input value="3" type="checkbox" name="phong_tam"/> 3 {LANG.phong_a}
				</li>
				<li>
					<input value="4" type="checkbox" name="phong_tam"/> 4+ {LANG.phong_a}
				</li>
			</ul>
		</li>
	</ul>
</div>

<script>
	$('.search_filter ul li input').click(function(){
		var catid = '';
		$( ".search_filter input[name=catid_s]").each(function() {
						if($(this).is(':checked')){
								if(catid =='')
									catid = $(this).val();
								else
									catid = catid + ',' + $(this).val();
							}
					});
					
		
		var phong_khach = '';
		$( ".search_filter input[name=phong_khach]").each(function() {
						if($(this).is(':checked')){
								if(phong_khach =='')
									phong_khach = $(this).val();
								else
									phong_khach = phong_khach + ',' + $(this).val();
							}
					});
					
		var phong_ngu = '';
		$( ".search_filter input[name=phong_ngu]").each(function() {
						if($(this).is(':checked')){
								if(phong_ngu =='')
									phong_ngu = $(this).val();
								else
									phong_ngu = phong_ngu + ',' + $(this).val();
							}
					});
					
					
		var phong_tam = '';
		$( ".search_filter input[name=phong_tam]").each(function() {
						if($(this).is(':checked')){
								if(phong_tam =='')
									phong_tam = $(this).val();
								else
									phong_tam = phong_tam + ',' + $(this).val();
							}
					});
					
		var huong_bds = '';
		$( ".search_filter input[name=huong_bds]").each(function() {
						if($(this).is(':checked')){
								if(huong_bds =='')
									huong_bds = $(this).val();
								else
									huong_bds = huong_bds + ',' + $(this).val();
							}
					});
		
		var price_spread = '';
		$( ".search_filter input[name=price_spread]").each(function() {
						if($(this).is(':checked')){
								if(price_spread =='')
									price_spread = $(this).val();
								else
									price_spread = price_spread + ',' + $(this).val();
							}
					});
					
					
					
		
		$.ajax({
						type: "POST",
						url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=search_ajax',
						data: {catid : catid, phong_khach : phong_khach, chonphongngu : phong_ngu, phong_tam : phong_tam, huong_bds : huong_bds, price_spread : price_spread},
						dataType: "html",
						success: function(data) { 
							$('.nhadat_main').html(data);
						}
					});
	
	});


</script>

<script>
    jQuery(document).ready(function () {
        jQuery(".list-filter").click(function () {
            jQuery(".popup").removeClass("popup-visible");
            jQuery(this).find(".popup").addClass("popup-visible");
        });
    });
</script>
<!-- END: main -->