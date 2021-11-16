<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 13 Aug 2014 00:24:32 GMT
 */
if (! defined('NV_IS_MOD_BOOKHOUSE'))
    die('Stop!!!');

/**
 *
 * nv_theme_viewhome()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @param mixed $viewtype
 * @return
 *
 */
function nv_theme_viewhome($array_data, $generate_page = '', $viewtype = 'viewlist')
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config, $array_cat;

    $xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
    $xtpl->assign('TEMPLATE', $module_info['template']);

    if ($array_config['display_data'] == 0) {
        // Hiển thị tất
		
	

        $xtpl->assign('DATA', call_user_func('nv_theme_' . $viewtype, $array_data));
	
		// XUẤT RA DANH SÁCH BẢN ĐỒ
		foreach($array_data as $row)
		{
			if(!empty($row['maps']))
			{ 
				$xtpl->assign('row', $row);
				$xtpl->assign('maps', $row['maps']);
				$xtpl->parse('main.address');
			}
		}

        if (! empty($generate_page)) {
            $xtpl->assign('PAGE', $generate_page);
            $xtpl->parse('main.viewall.page');
        }
        $xtpl->parse('main.viewall');
    } elseif ($array_config['display_data'] == 1) {
        // Hiển thị theo chủ đề
        if (! empty($array_data)) {
            foreach ($array_data as $catid => $catdata) {
                if (! empty($catdata['data'])) {
                    $xtpl->assign('CAT', $array_cat[$catid]);
                    $xtpl->assign('DATA', call_user_func('nv_theme_' . $viewtype, $catdata['data']));
                    $xtpl->parse('main.viewcat.loop');
                }
            }
        }
        $xtpl->parse('main.viewcat');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 *
 * nv_theme_viewcat()
 *
 * @param mixed $array_data
 * @return
 *
 */
function nv_theme_viewcat($array_data, $generate_page = '', $viewtype = 'viewgrid')
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config, $catid, $array_cat;

    $xtpl = new XTemplate('viewcat.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('CAT', $array_cat[$catid]);

	$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
    $xtpl->assign('TEMPLATE', $module_info['template']);

    if (! empty($array_data)) {
        $xtpl->assign('DATA', call_user_func('nv_theme_' . $viewtype, $array_data));
        // XUẤT RA DANH SÁCH BẢN ĐỒ
		foreach($array_data as $row)
		{
			if(!empty($row['maps']))
			{//print_r($row);die;
				$xtpl->assign('row', $row);
				$xtpl->assign('maps', $row['maps']);
				$xtpl->parse('main.address');
			}
		}
        if (! empty($generate_page)) {
            $xtpl->assign('PAGE', $generate_page);
            $xtpl->parse('main.page');
        }
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 *
 * nv_theme_viewlocation()
 *
 * @param mixed $array_data
 * @return
 *
 */
function nv_theme_viewlocation($array_data, $location_info, $generate_page = '', $viewtype = 'viewlist')
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config, $catid, $array_cat;

    $xtpl = new XTemplate('viewlocation.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('LOCATION', $location_info);

    if (! empty($array_data)) {
        $xtpl->assign('DATA', call_user_func('nv_theme_' . $viewtype, $array_data));

        if (! empty($generate_page)) {
            $xtpl->assign('PAGE', $generate_page);
            $xtpl->parse('main.page');
        }
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 *
 * nv_theme_viewlist()
 *
 * @param mixed $array_data
 * @return
 *
 */
function nv_theme_viewlist($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config;


    $xtpl = new XTemplate('viewlist.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('THUMB_WIDTH', $array_config['thumb_width']);


    if (! empty($array_data)) {
        foreach ($array_data as $items) {
            $items['size'] = '';
            if ($array_config['sizetype'] == 0) {
                $items['size'] = $items['area'];
            } elseif ($array_config['sizetype'] == 1) {
                if (! empty($items['size_v']) and ! empty($items['size_h'])) {
                    $items['size'] = $items['size_h'] . 'x' . $items['size_v'];
                }
            }

            $xtpl->assign('DATA', $items);

            if (! empty($items['size'])) {
                if ($array_config['sizetype'] == 0) {
                    $xtpl->parse('main.loop.size_0');
                } elseif ($array_config['sizetype'] == 1) {
                    $xtpl->parse('main.loop.size_1');
                }
            }

            if ($array_config['view_on_main']) {
                $xtpl->parse('main.loop.view_on_main_content');
                $xtpl->parse('main.loop.view_on_main_link');
            } else {
                $xtpl->parse('main.loop.link');
            }

            if ($items['showprice']) {
                $xtpl->parse('main.loop.price');
            } else {
                $xtpl->parse('main.loop.contact');
            }

            $xtpl->parse('main.loop');
        }
    }

    if ($array_config['sizetype'] == 0) {
        $xtpl->parse('main.area');
    } elseif ($array_config['sizetype'] == 1) {
        $xtpl->parse('main.size');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 *
 * nv_theme_viewlist_simple()
 *
 * @param mixed $array_data
 * @return
 *
 */
function nv_theme_viewlist_simple($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config;

    $xtpl = new XTemplate('viewlist_simple.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    if (! empty($array_data)) {
        foreach ($array_data as $items) {
            if ($items['showprice']) {
                $items['price'] = nv_price_format($items['price']);
            }

            $xtpl->assign('DATA', $items);

            if ($array_config['sizetype'] == 0) {
                $xtpl->parse('main.loop.area');
            } elseif ($array_config['sizetype'] == 1) {
                if (! empty($items['size_v']) and ! empty($items['size_h'])) {
                    $xtpl->parse('main.loop.size.content');
                }
                $xtpl->parse('main.loop.size');
            }

            if ($array_config['view_on_main']) {
                $xtpl->parse('main.loop.view_on_main_content');
                $xtpl->parse('main.loop.view_on_main_link');
            } else {
                $xtpl->parse('main.loop.link');
            }

            if ($items['showprice']) {
                $xtpl->parse('main.loop.price');
            } else {
                $xtpl->parse('main.loop.contact');
            }

            $xtpl->parse('main.loop');
        }
    }

    if ($array_config['sizetype'] == 0) {
        $xtpl->parse('main.area');
    } elseif ($array_config['sizetype'] == 1) {
        $xtpl->parse('main.size');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 *
 * nv_theme_viewgrid()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @return
 *
 */
function nv_theme_viewgrid($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config;

    $xtpl = new XTemplate('viewgrid.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('thumb_width', $array_config['thumb_width']);
    $xtpl->assign('thumb_height', $array_config['thumb_height']);
    $xtpl->assign('CONTACT_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=contact');

    if (! empty($array_data)) {

		//print_r($array_data); die;

        foreach ($array_data as $items) {

            $items['title1'] = nv_clean60($items['title'], 70);
            $xtpl->assign('DATA', $items);

            //print_r($array_data);die;
            if ($items['showprice']) {
                $xtpl->parse('main.loop.price');
            } else {
                $xtpl->parse('main.loop.contact');
            }

            $xtpl->parse('main.loop');
			if(!empty($items['address']))
				$xtpl->parse('main.loop_dd');
        }
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_bookhouse_detail()
 *
 * @param mixed $array_data
 * @return
 *
 */
function nv_theme_bookhouse_detail($array_data, $room_detail, $array_keyword, $data_others, $checkss, $content_comment)
{
    global $global_config, $module_name, $module_file, $module_upload, $lang_module, $lang_global, $module_config, $module_info, $array_cat, $listroom, $client_info, $my_footer, $array_config, $array_way, $array_legal, $array_money_unit, $location_array_config, $module_data, $db;

    $array_data['cat_title'] = $array_cat[$array_data['catid']]['title'];
    $array_data['cat_link'] = $array_cat[$array_data['catid']]['link'];
    if (! empty($array_data['way_id'])) {
        $array_data['way'] = $array_way[$array_data['way_id']]['title'];
    }
    if (! empty($array_data['legal_id'])) {
        $array_data['legal'] = $array_legal[$array_data['legal_id']]['title'];
    }

   $array_data['price'] = nv_price_format($array_data['price'], $array_data['price_time']);
   
	$array_data['duan'] = $array_data['project']['title'];
	$array_data['linkduan'] = $array_data['project']['link'];

    $array_data['money_unit'] = $array_money_unit[$array_data['money_unit']];

    // google maps
    $is_maps = 0;
    if (! empty($array_data['maps']) and $array_config['allow_maps'] and ! empty($array_config['maps_appid'])) {
        $is_maps = 1;
        $array_data['maps'] = unserialize($array_data['maps']);
    }

    $image = array();
    if (! empty($array_data['homeimgfile'])) {
        $image[] = $array_data['homeimgfile'];
    }

    if (! empty($array_data['other_image'])) {
        foreach ($array_data['other_image'] as $otherimage_i) {
            if (! empty($otherimage_i['homeimgfile']) and file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $otherimage_i['homeimgfile'])) {
                $otherimage_i['homeimgfile'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $otherimage_i['homeimgfile'];
                $image[] = $otherimage_i['homeimgfile'];
            }
        }
    }
   // die(NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl = new XTemplate('detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('MODULE_FILE', $module_file);
    $xtpl->assign('CONTACT_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=contact');
    $xtpl->assign('SELFURL', $client_info['selfurl']);
    $xtpl->assign('CHECKSS', $checkss);
    $xtpl->assign('CAPTCHA_REFRESH', $lang_global['captcharefresh']);
    $xtpl->assign('CAPTCHA_REFR_SRC', NV_BASE_SITEURL . 'images/refresh.png');
    $xtpl->assign('SELFURL', $client_info['selfurl']);
    $xtpl->assign('DATA', $array_data);

	//print_r($lang_global['daydu']);die;

	// lấy danh sách nội thất ra
		$ds_noithat = $db->query('SELECT * FROM '. NV_PREFIXLANG . '_' . $module_data . '_furniture ORDER BY id DESC')->fetchAll();
		$noi_that_daydu = $lang_global['daydu'];
		if(!empty($ds_noithat))
		{
			$mang_noithat = explode(',',$array_data['noi_that']);
			foreach($ds_noithat as $ti)
			{
				if(in_array($ti['id'],$mang_noithat))
				$xtpl->assign( 'checked', '<i class="fa fa-check"></i>');
				else
				{
					$xtpl->assign( 'checked', '<i class="fa fa-times"></i>');
					$noi_that_daydu = $lang_global['1phan'];
				}
				$xtpl->assign( 'noi_that', $ti );
				$xtpl->parse( 'main.noi_that' );
			}

		}
		$xtpl->assign('noi_that_daydu', $noi_that_daydu);

	// lấy danh sách tiện ích ra
	$ds_tienich = $db->query('SELECT * FROM '. NV_PREFIXLANG . '_' . $module_data . '_convenient ORDER BY id DESC')->fetchAll();

$tien_ich_daydu = $lang_global['daydu'];

if(!empty($ds_tienich))
{
	$mang_tienich = explode(',',$array_data['tien_ich']);
	foreach($ds_tienich as $ti)
	{

		if(in_array($ti['id'],$mang_tienich))
			$xtpl->assign( 'checked', '<i class="fa fa-check"></i>');
		else
		{
			$xtpl->assign( 'checked', '<i class="fa fa-times"></i>');
			$tien_ich_daydu = $lang_global['1phan'];
		}
		$xtpl->assign( 'tien_ich', $ti );
		$xtpl->parse( 'main.tien_ich' );
	}
}
$xtpl->assign('tien_ich_daydu', $tien_ich_daydu);

    if (! empty($array_data['project'])) {
        $xtpl->parse('main.project');
    }

    if (! empty($array_data['way_id'])) {
        $xtpl->parse('main.way');
    }

    if (! empty($array_data['legal_id'])) {
        $xtpl->parse('main.legal');
    }

    if (! empty($array_data['front'])) {
        $xtpl->parse('main.front');
    }

    if (! empty($array_data['road'])) {
        $xtpl->parse('main.road');
    }

    if (! empty($image)) {
        foreach ($image as $image_i) {
            $xtpl->assign('IMAGE', $image_i);
            $xtpl->parse('main.image.loop');
            $xtpl->parse('main.image.loop1');
        }

        $my_footer .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/js/' . $module_file . '_jssor.core.js"></script>';
        $my_footer .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/js/' . $module_file . '_jssor.utils.js"></script>';
        $my_footer .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/js/' . $module_file . '_jssor.slider.js"></script>';
        $my_footer .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/js/' . $module_file . '_slide_config.js"></script>';

        $xtpl->parse('main.image');
    }

    if ($array_data['showprice'] and $array_data['price'] > 0) {
        $xtpl->parse('main.price');
    } else {
        $xtpl->parse('main.contact');
    }

    if ($array_config['sizetype'] == 0 and ! empty($array_data['area'])) {
        $xtpl->parse('main.area');
    } elseif ($array_config['sizetype'] == 1 and ! empty($array_data['size_v']) and ! empty($array_data['size_h'])) {
        $xtpl->parse('main.size');
    }

    if (! empty($array_data['code'])) {
        $xtpl->parse('main.code');
    }

    if (! empty($array_data['structure'])) {
        $xtpl->parse('main.structure');
    }

    if (! empty($array_data['type'])) {
        $xtpl->parse('main.type');
    }

    // Comment
    if (! empty($content_comment)) {
        $xtpl->assign('COMMENT', $content_comment);
        $xtpl->parse('main.comment');
    }

    if (! empty($room_detail)) {
        foreach ($room_detail as $room) {

            $xtpl->assign('ROOM', array(
                'title' => $listroom[$room['rid']]['title'],
                'num' => $room['num']
            ));
            $xtpl->parse('main.room.loop');
        }
        $xtpl->parse('main.room');
    }

    if (! empty($array_keyword)) {
        foreach ($array_keyword as $i => $value) {
            $xtpl->assign('KEYWORD', $value['keyword']);
            $xtpl->assign('LINK_KEYWORDS', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=tag/' . urlencode($value['alias']));
            $xtpl->parse('main.keywords.loop');
        }
        $xtpl->parse('main.keywords');
    }

    if (defined('NV_IS_MODADMIN')) {
        $xtpl->assign('EDIT_URL', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=items&amp;edit&amp;id=' . $array_data['id']);
        $xtpl->parse('main.adminlink');
    }

    if ($is_maps) {
        $array_data['maps']['maps_appid'] = $array_config['maps_appid'];
        $xtpl->assign('MAPS', $array_data['maps']);
        $xtpl->parse('main.google_maps_title');
        $xtpl->parse('main.google_maps_div');
    }

    if (! empty($data_others)) {
		//print_r($data_others);die;
        //$hmtl = nv_theme_viewcat($data_others);
		 foreach ($data_others as $items) {
			$xtpl->assign('OTHER', $items);
			$xtpl->parse('main.other.loop');
		 }
		$xtpl->parse('main.other');
    }

    if (! empty($array_data['location'])) {
        $address = $array_data['location'];
        $xtpl->assign('ADDRESS', $address);
        $xtpl->parse('main.address');
    }

    if ($array_config['allow_contact_info']) {
        $xtpl->parse('main.contact_info');
    }

    if ($array_config['itemsave']) {
        $xtpl->parse('main.save');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_viewcat_column()
 *
 * @param mixed $array_data
 * @param mixed $view
 * @return
 *
 */
function nv_theme_viewcat_column($array_data, $view, $generate_page)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config;

    $xtpl = new XTemplate('viewcat_column.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('thumb_width', $array_config['thumb_width']);
    $xtpl->assign('thumb_height', $array_config['thumb_height']);

    if (! empty($array_data)) {
        foreach ($array_data as $items) {
            $items['title1'] = nv_clean60($items['title'], 40);
            if ($items['showprice']) {
                $items['price'] = nv_price_format($items['price'], $items['price_time']);
            }

            $xtpl->assign('DATA', $items);

            if ($items['showprice']) {
                $xtpl->parse('main.loop.price');
            } else {
                $xtpl->parse('main.loop.contact');
            }

            $xtpl->parse('main.loop');
        }
    }

    if (! empty($generate_page)) {
        $xtpl->assign('PAGE', $generate_page);
        $xtpl->parse('main.page');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_bookhouse_search()
 *
 * @param mixed $array_data
 * @return
 *
 */
function nv_theme_bookhouse_search($array_data, $is_search, $generate_page, $viewtype = 'viewgrid')
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_config;

    $xtpl = new XTemplate('search.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('OP_NAME', $op);
    $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
    $xtpl->assign('TEMPLATE', $module_info['template']);
    $xtpl->assign('OP_NAME', $op);

    if (! empty($array_data)) {
        $xtpl->assign('DATA', call_user_func('nv_theme_' . $viewtype, $array_data));

		// XUẤT RA DANH SÁCH BẢN ĐỒ
		foreach($array_data as $row)
		{
			if(!empty($row['maps']))
			{//print_r($row);die;
				$xtpl->assign('row', $row);
				$xtpl->assign('maps', $row['maps']);
				$xtpl->parse('main.address');
			}
		}

        if (! empty($generate_page)) {
            $xtpl->assign('PAGE', $generate_page);
            $xtpl->parse('main.page');
        }
    }

    if ($is_search) {
        $xtpl->assign('NOTE', $lang_module['search_result']);
        $xtpl->parse('main.note');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * redict_link()
 *
 * @param mixed $lang_view
 * @param mixed $lang_back
 * @param mixed $nv_redirect
 * @return
 *
 */
function redict_link($lang_view, $lang_back, $nv_redirect)
{
    $contents = "<div class=\"text-center\">";
    $contents .= $lang_view . "<br /><br />\n";
    $contents .= "<em class=\"fa fa-spinner fa-spin fa-4x\">&nbsp;</em><br /><br />\n";
    $contents .= "<a href=\"" . $nv_redirect . "\">" . $lang_back . "</a>";
    $contents .= "</div>";
    $contents .= "<meta http-equiv=\"refresh\" content=\"2;url=" . $nv_redirect . "\" />";
    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents);
    include NV_ROOTDIR . '/includes/footer.php';
    exit();
}

/**
 * nv_theme_market_saved()
 *
 * @param mixed $array_data
 * @param mixed $page
 * @return
 *
 */
function nv_theme_market_saved($array_data, $page)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_market_cat, $catid, $lang_global, $user_info;

    $xtpl = new XTemplate('saved.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('ACTION_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=ajax');
    $xtpl->assign('CHECKSS', md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . NV_CACHE_PREFIX));

    if (! empty($array_data)) {
        foreach ($array_data as $data) {
            $xtpl->assign('DATA', $data);
            $xtpl->parse('main.loop');
        }
    }

    if (! empty($page)) {
        $xtpl->assign('PAGE', $page);
        $xtpl->parse('main.page');
    }

    $array_action = array(
        'delete_list_id' => $lang_global['delete']
    );

    foreach ($array_action as $key => $value) {
        $xtpl->assign('ACTION', array(
            'key' => $key,
            'value' => $value
        ));
        $xtpl->parse('main.action');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_payment()
 *
 * @param mixed $array_info
 * @param mixed $array_option
 * @param mixed $mod
 * @param mixed $all
 * @return
 *
 */
function nv_theme_payment($array_info, $array_option, $mod, $all)
{
    global $global_config, $module_name, $module_file, $lang_module, $lang_global, $module_config, $module_info, $op, $array_config, $user_info, $array_groups, $group_list, $array_time_unit;

    if (empty($array_info)) {
        $array_info['id'] = 0;
        $array_info['title'] = $lang_module['payment_' . $mod];
    }

    $template = $all ? 'payment_all' : 'payment';

    $xtpl = new XTemplate($template . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('USER_INFO', $user_info);
    $xtpl->assign('INFO', $array_info);
    $xtpl->assign('MONEY_UNIT', $array_config['money_unit']);
    $xtpl->assign('MOD', $mod);
    $xtpl->assign('URL_ITEM', nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['items'], true));

    if ($all) {
        if (! empty($array_option['group'])) {

            $count = sizeof($array_option['group']);
            if ($mod == 'group') {
                $count += 1;
            }
            $xtpl->assign('COL_CLASS', nv_caculate_bootstrap_grid($count));

            foreach ($array_option['group'] as $index => $value) {

                $xtpl->assign('GROUP', $mod == 'group' ? $array_groups[$index] : array(
                    'bid' => $index,
                    'title' => $group_list[$index]['title'],
                    'description' => $group_list[$index]['description']
                ));

                $i = 0;
                foreach ($value as $option) {
                    if ($mod == 'upgrade_group') {
                        $array_info['id'] = $index;
                    }
                    $option['tokenkey'] = md5($array_info['id'] . $option['price_sale'] . 'VND');
                    $option['checksum'] = md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $array_info['id'] . '-' . $option['time']);
                    $option['selected'] = '';
                    if ($i == 0) {
                        $option['selected'] = 'selected="selected"';
                        $xtpl->assign('FIRST', array(
                            'number' => isset($option['number']) ? $option['number'] : 0,
                            'price' => $option['price_sale'],
                            'price_discount' => $option['price_sale'],
                            'tokenkey' => $option['tokenkey'],
                            'checksum' => $option['checksum']
                        ));
                    }
                    $option['price_format'] = nv_number_format($option['price']);
                    $xtpl->assign('OPTION', $option);
                    $xtpl->parse('main.group.option');
                    $i ++;
                }

                $xtpl->parse('main.group');
            }
        }

        if (! empty($array_option['refresh'])) {
            $i = 0;
            foreach ($array_option['refresh'] as $option) {
                $option['tokenkey'] = md5($array_info['id'] . $option['price_sale'] . 'VND');
                $option['checksum'] = md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $array_info['id'] . '-' . $option['number']);
                $option['checked'] = '';
                if ($i == 0) {
                    $option['checked'] = 'checked="checked"';
                    $xtpl->assign('FIRST', array(
                        'number' => isset($option['number']) ? $option['number'] : 0,
                        'price_sale' => $option['price_sale'],
                        'tokenkey' => $option['tokenkey'],
                        'checksum' => $option['checksum']
                    ));
                }
                $option['price_format'] = nv_number_format($option['price']);
                $option['price_discount'] = ! empty($option['price_discount']) ? nv_number_format($option['price_discount']) : '';
                $xtpl->assign('OPTION', $option);
                $xtpl->parse('main.refresh.option');
                $i ++;
            }
            $xtpl->parse('main.refresh');
        }
    } else {
        if (! empty($array_option)) {

            if ($mod == 'group') {
                $xtpl->assign('GROUP', $array_groups);
            } elseif ($mod == 'upgrade_group') {
                $xtpl->assign('GROUP', $array_info);
            }

            $i = 0;
            foreach ($array_option as $option) {
                $option['tokenkey'] = md5($array_info['id'] . $option['price_sale'] . 'VND');
                if ($mod == 'refresh') {
                    $option['checksum'] = md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $array_info['id'] . '-' . $option['number']);
                } elseif ($mod == 'group' or $mod == 'upgrade_group') {
                    $option['checksum'] = md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $array_info['id'] . '-' . $option['time']);
                }

                $option['checked'] = '';
                if ($i == 0) {
                    $option['checked'] = 'checked="checked"';
                    $xtpl->assign('FIRST', array(
                        'number' => isset($option['number']) ? $option['number'] : 0,
                        'price' => $option['price'],
                        'price_sale' => $option['price_sale'],
                        'tokenkey' => $option['tokenkey'],
                        'checksum' => $option['checksum']
                    ));
                }

                $option['price_format'] = nv_number_format($option['price']);
                $option['price_discount'] = ! empty($option['price_discount']) ? nv_number_format($option['price_discount']) : '';
                $option['unit'] = $array_time_unit[$option['unit']];

                $xtpl->assign('OPTION', $option);

                if (! empty($option['price_discount'])) {
                    $xtpl->parse('main.' . $mod . '.option.discount');
                }

                $xtpl->parse('main.' . $mod . '.option');
                $i ++;
            }
            $xtpl->parse('main.' . $mod);
        }
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 *
 * nv_theme_upgrade()
 *
 * @param mixed $mod
 * @param mixed $array_data
 * @param mixed $content
 * @return
 *
 */
function nv_theme_upgrade($mod, $array_data, $content)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info;

    $xtpl = new XTemplate('upgrade.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('DATA', $array_data);
    $xtpl->assign('CONTENT', $content);
    $xtpl->assign('MOD', $mod);

    if ($mod == 'group') {
        $xtpl->parse('main.rowinfo');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 *
 * nv_theme_bookhouse_projects()
 *
 * @param mixed $mod
 * @param mixed $array_data
 * @param mixed $content
 * @return
 *
 */
function nv_theme_bookhouse_projects($array_data, $generate_page = '')
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info;

    $xtpl = new XTemplate('projects.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('TEMPLATE', $module_info['template']);
	

    if (!empty($array_data)) {
        foreach ($array_data as $data) {
            $xtpl->assign('DATA', $data);
            if (!empty($data['homeimg'])) {
                $xtpl->parse('main.loop.homeimg');
            }
            $xtpl->parse('main.loop');
        }
		
    }
	
	//print_r($array_data);die;
	// XUẤT RA DANH SÁCH BẢN ĐỒ
		foreach($array_data as $row)
		{	
			if(!empty($row['maps']))
			{ 
				$xtpl->assign('row', $row);
				$xtpl->assign('maps', $row['maps']);
				$xtpl->parse('main.address');
			}
		}
	

    if (!empty($generate_page)) {
        $xtpl->assign('PAGE', $generate_page);
        $xtpl->parse('main.page');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}


/**
 *
 * nv_theme_bookhouse_project_detail()
 *
 * @param mixed $mod
 * @param mixed $array_data
 * @param mixed $content
 * @return
 *
 */
function nv_theme_bookhouse_project_detail($array_data, $array_rows)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_type ;

    $xtpl = new XTemplate('project-detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('DATA', $array_data);

    if (!empty($array_data['image'])) {
        $xtpl->parse('main.image');
    }
	
    if (!empty($array_data['descriptionhtml'])) {
        $xtpl->parse('main.descriptionhtml');
    }	
    if (!empty($array_rows)) {
        foreach ($array_rows as $typeid => $rows) {
			$tabs_content =  nv_theme_viewlist($rows) ;
			if (!empty($tabs_content)) {
				$xtpl->assign('TYPE', $array_type[$typeid]);
				$xtpl->assign('TABS_CONTENT', $tabs_content);
				if ($i == 0) {
                    $xtpl->parse('main.type.tabs_title.active');
                    $xtpl->parse('main.type.tabs_content.active');
                }
				$xtpl->parse('main.type.tabs_title');
                $xtpl->parse('main.type.tabs_content');
			}
			$i++;
        }
		$xtpl->parse('main.type');
    }
	
    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_bookhouse_project_detail_other($array_data, $generate_page)
{
    global $db, $module_data, $module_info, $module_file;
	
    $xtpl = new XTemplate('project-detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('DATA', nv_theme_viewgrid($array_data));
	
	
    if (!empty($generate_page)) {
        $xtpl->assign('PAGE', $generate_page);
        $xtpl->parse('list.generate_page');
    }

    $xtpl->parse('list');
    return $xtpl->text('list');
}

/**
 *
 * nv_theme_viewtag()
 *
 * @param mixed $array_data
 * @return
 *
 */
function nv_theme_viewtag($description, $key_words, $bodytext, $array_data, $generate_page = '', $viewtype = 'viewgrid')
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $array_config, $catid, $array_cat;

    $xtpl = new XTemplate('viewtag.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('TITLE', $key_words);

    if (!empty($description)) {
        $xtpl->assign('DESCRIPTION', $description);
        $xtpl->parse('main.description');
    }
	
	if (!empty($description)) {
        $xtpl->assign('bodytext', $bodytext);
        $xtpl->parse('main.bodytext');
    }
	
	

    if (!empty($array_data)) {
        $xtpl->assign('DATA', call_user_func('nv_theme_' . $viewtype, $array_data));

        if (!empty($generate_page)) {
            $xtpl->assign('PAGE', $generate_page);
            $xtpl->parse('main.page');
        }
    }
	
	// XUẤT RA DANH SÁCH BẢN ĐỒ
		foreach($array_data as $row)
		{
			if(!empty($row['maps']))
			{//print_r($row);die;
				$xtpl->assign('row', $row);
				$xtpl->assign('maps', $row['maps']);
				$xtpl->parse('main.address');
			}
		}

    $xtpl->parse('main');
    return $xtpl->text('main');
}
