		<div class="form_lienhe">
			<i class="icon_close fa fa-times-circle" aria-hidden="true"></i>
			[FOOTER_SITE]
		</div>
		<div class="khungmo"></div>
		<script>
		$('.lien-he-ngay').click(function(){
			$('.khungmo').addClass('khungmo_fix');
			$('.form_lienhe').addClass('show');
		}); 
		
		$('.icon_close').click(function(){
			$('.khungmo').removeClass('khungmo_fix');
			$('.form_lienhe').removeClass('show');
		});
		
		$('.khungmo').click(function(){
			$('.khungmo').removeClass('khungmo_fix');
			$('.form_lienhe').removeClass('show');
		});
		
	</script>
	
        <footer id="footer">
            <div class="wraper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-24 col-sm-24 col-md-18">
							<div class="margin-bottom hidden-xs">
								<a title="{SITE_NAME}" href="{THEME_SITE_HREF}"><img src="{LOGO_SRC}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" alt="{SITE_NAME}" /></a>
							</div>
                            [MENU_FOOTER]
                        </div>
                        <div class="col-xs-24 col-sm-24 col-md-6">
							<div class="fanpage">
								[FEATURED_PRODUCT]
							</div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </footer>
        {ADMINTOOLBAR}
    
    <!-- SiteModal Required!!! -->
    <div id="sitemodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <em class="fa fa-spinner fa-spin">&nbsp;</em>
                </div>
                <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            </div>
        </div>
    </div>
    [HOTLINE_MOBILE]
	
	
	
	<script type="text/javascript">
		var contactButton = function () {
			var top = 520;
			var y = $(this).scrollTop();
			if (y > top) {
				$('#lien_he_detail #contactButton').addClass('fixed_top');
			} else {
				$('#lien_he_detail #contactButton').removeClass('fixed_top');
			}
		};
		$(window).scroll(function () {
			contactButton();
		}); 
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
