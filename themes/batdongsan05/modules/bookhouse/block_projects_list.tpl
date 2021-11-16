<!-- BEGIN: main -->
<div class="block_new_items_list">
    <div class="row">
        <!-- BEGIN: loop -->
        <div class="col-md-6 col-sm-12" {clear}>
			<div class="thumbnail">
				<!-- BEGIN: homeimg -->
				<div class="img">
					<a href="{DATA.link}" title="{DATA.title}">
						<img width="100%"  class="img-thumbnail" src="{DATA.homeimg}" alt="{DATA.title}" />
					</a>
				</div> 
				<!-- END: homeimg -->
				<div class="item-detail">
					<h3>
						<a href="{DATA.link}" title="{DATA.title}">{DATA.title}</a>
					</h3> 
					<p class="dia_chi">
						{DATA.location}
					</p>			
					<p>{LANG.socan}:<strong> {DATA.socanho}</strong></p>
					<p>{LANG.sophong}: <strong> {DATA.sophong} </strong></p>					
					<p>{LANG.giaban}: <strong> {DATA.giaban}</strong></p>
					<p>{LANG.giathue}: <strong> {DATA.giathue}</strong></p>			
				</div>
			</div>
		</div>
        <!-- END: loop -->
    </div>
</div>
<!-- END: main -->