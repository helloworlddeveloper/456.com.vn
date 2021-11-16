<!-- BEGIN: main -->
	<!-- BEGIN: loop -->	
		<div class="list-bds">
			<div class="row mrglr0">
				<div class="col-sm-9 col-md-9 pddlr0">
					<a href="{DATA.link}" title="{DATA.title}"> <img src="{DATA.imghome}" alt="{DATA.title}"/>
					</a>
				</div>
				<div class="col-sm-15 col-md-15 pddlr0">
					<div class="des-bds">
						<div class="row"> 
							<div class="col-xs-16">
								<h3><a href="{DATA.link}" title="{DATA.title}">{DATA.title}</a></h3>
							</div>
							<div class="col-xs-8">
								<span class="price11">
								<!-- BEGIN: price -->{DATA.price} <span style ="text-transform: uppercase;">{DATA.money_unit}</style>/{DATA.price_time}<!-- END: price --> 
								<!-- BEGIN: contact -->
								{LANG.contact}
								<!-- END: contact --> 
								</span>
							</div>
						</div>
						<p class="dia_chi">
							{DATA.location}
						</p>
						<p class="huong">
							{DATA.way}
						</p>
						<p class="info-bds">
								<label><em class="fa fa-bath">&nbsp;</em>{DATA.phong_tam}</label>
								<label><em class="fa fa-bed">&nbsp;</em>{DATA.phong_ngu}</label>
								<label><em class="fa fa-arrows">&nbsp;</em>{DATA.area} {LANG.m2} </label>
						</p>
						<a href="#" class="lien-he-ngay">{LANG.contact}</a>
					</div>
				</div>
			</div>
		</div>
	<!-- END: loop -->	
<!-- END: main -->