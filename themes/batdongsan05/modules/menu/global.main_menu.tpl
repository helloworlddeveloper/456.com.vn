<!-- BEGIN: tree -->
<li>
	<!-- BEGIN: icon -->
	<img src="{MENUTREE.icon}" />&nbsp;
	<!-- END: icon -->
	<a title="{MENUTREE.note}" href="{MENUTREE.link}" {MENUTREE.target}>{MENUTREE.title_trim}</a>
	<!-- BEGIN: tree_content -->
	<ul class="wsmenu-submenu-sub">
		{TREE_CONTENT}
	</ul>
	<!-- END: tree_content -->
</li>
<!-- END: tree -->
<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{BLOCK_THEME}/css/webslidemenu.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{BLOCK_THEME}/js/webslidemenu.js"></script>

<nav class="wsmenu clearfix">
	<ul class="mobile-sub wsmenu-list">
		<li>
			<a title="{LANG.Home}" href="{THEME_SITE_HREF}"><span class="visible-xs">{LANG.Home}</span></a>
		</li>
		<!-- BEGIN: loopcat1 -->
		<li>
			<!-- BEGIN: icon -->
			<img src="{CAT1.icon}" />&nbsp;
			<!-- END: icon -->
			<a {CAT1.class} title="{CAT1.note}" href="{CAT1.link}" {CAT1.target}><i aria-hidden="true"></i>{CAT1.title_trim}</a>
			<!-- BEGIN: cat2 -->
				<ul class="wsmenu-submenu">
					{HTML_CONTENT}
				</ul>
			<!-- END: cat2 -->
		</li>
		<!-- END: loopcat1 -->
	</ul>
</nav>
<!-- END: main -->