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

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$array_data = array();

if (empty($id)) {
    Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true));
    exit();
}

$sql = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id = ' . $id . ' AND status=1 AND status_admin=1 AND is_queue=0');
$data_content = $sql->fetch();

if (empty($data_content)) {
    $nv_redirect = nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name, true);
    redict_link($lang_module['detail_do_not_view'], $lang_module['redirect_to_back_home'], $nv_redirect);
}

$room_detail = array();
$sql = $db->query('SELECT iid, rid, num FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rooms_detail WHERE iid = ' . $id);
while ($row = $sql->fetch()) {
    $room_detail[] = $row;
}

$location = new Location();
$module_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$data_content['location'] = $location->locationString($data_content['provinceid'], $data_content['districtid'], $data_content['wardid'], ' » ', $module_url);
$data_content['addtime'] = nv_date('H:i d/m/Y', $data_content['addtime']);

$data_content['poster'] = $lang_global['guests'];
if ($data_content['admin_id'] > 0) {
    $result = $db->query('SELECT username, first_name, last_name FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $data_content['admin_id']);
    if ($result->rowCount()) {
        list ($username, $first_name, $last_name) = $result->fetch(3);
        $data_content['poster'] = nv_show_name_user($first_name, $last_name, $username);
    }
}

// Du an
$data_content['project'] = '';
if($data_content['projectid'] > 0){
    $data_content['project'] = nv_get_project($data_content['projectid']);
}


// comment
if (isset($site_mods['comment']) and isset($module_config[$module_name]['activecomm'])) {
    define('NV_COMM_ID', $data_content['id']); // ID bài viết
    define('NV_COMM_AREA', $module_info['funcs'][$op]['func_id']); // để đáp ứng comment ở bất cứ đâu không cứ là bài viết
                                                                   // check allow comemnt
    $allowed = $module_config[$module_name]['allowed_comm']; // tuy vào module để lấy cấu hình. Nếu là module news thì có cấu hình theo bài viết
    if ($allowed == '-1') {
        $allowed = $data_content['allowed_comm'];
    }
    define('NV_PER_PAGE_COMMENT', 5); // Số bản ghi hiển thị bình luận
    require_once NV_ROOTDIR . '/modules/comment/comment.php';
    $area = (defined('NV_COMM_AREA')) ? NV_COMM_AREA : 0;
    $checkss = md5($module_name . '-' . $area . '-' . NV_COMM_ID . '-' . $allowed . '-' . NV_CACHE_PREFIX);
    
    // get url comment
    $url_info = parse_url($client_info['selfurl']);
    $content_comment = nv_comment_module($module_name, $checkss, $area, NV_COMM_ID, $allowed, 1);
} else {
    $content_comment = '';
}

// So luot xem tin
$time_set = $nv_Request->get_int($module_data . '_' . $op . '_' . $id, 'session');
if (empty($time_set)) {
    $nv_Request->set_Session($module_data . '_' . $op . '_' . $id, NV_CURRENTTIME);
    $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET hitstotal=hitstotal+1 WHERE id=' . $id);
}

$catid = $data_content['catid'];
$base_url_rewrite = nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_cat[$catid]['alias'] . '/' . $data_content['alias'] . '-' . $data_content['id'] . $global_config['rewrite_exturl'], true);
if ($_SERVER['REQUEST_URI'] != $base_url_rewrite) {
    Header('Location: ' . $base_url_rewrite);
    die();
}

// lấy thông tin đơn vị ra

if($data_content['price_time'])
{
$data_content['price_time'] = $array_pricetype[$data_content['price_time']]['title'];
}
else
{
		$data_content['price_time'] = 'Thỏa thuận';
		$data_content['price'] = '';
}

// Xac dinh anh lon
$homeimgfile = $data_content['homeimgfile'];
if ($data_content['homeimgthumb'] == 1 and ! empty($homeimgfile)) {
    $data_content['homeimgthumb'] = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $homeimgfile;
    $data_content['homeimgfile'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $homeimgfile;
} elseif ($data_content['homeimgthumb'] == 2) {
    $data_content['homeimgthumb'] = $data_content['homeimgfile'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $homeimgfile;
} elseif ($data_content['homeimgthumb'] == 3) {
    $data_content['homeimgthumb'] = $data_content['homeimgfile'] = $homeimgfile;
} else {
    $data_content['homeimgthumb'] = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
}

// Hinh anh khac
$data_content['other_image'] = array();
$result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_images WHERE rows_id=' . $id);
while ($row = $result->fetch()) {
    $data_content['other_image'][] = $row;
}

// metatag image facebook
$meta_property['og:image'] = NV_MY_DOMAIN . $data_content['homeimgthumb'];

$array_keyword = array();
$key_words = array();
$_query = $db->query('SELECT a1.keyword, a2.alias FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags_id a1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_tags a2 ON a1.tid=a2.tid WHERE a1.id=' . $data_content['id']);
while ($row = $_query->fetch()) {
    $array_keyword[] = $row;
    $key_words[] = $row['keyword'];
}

if ($array_config['othertype'] == 0) {
    $where = 'id != ' . $id . ' AND catid = ' . $data_content['catid'] . ' AND status=1 AND status_admin=1 AND districtid = '.$data_content['districtid'].' AND provinceid = '.$data_content['provinceid'].' AND is_queue=0';
} elseif ($array_config['othertype'] == 3) {
    // cùng quận và giá tiền tăng 30%
    $price = $data_content['price'] + ($data_content['price'] * 30) / 100;
    $where = 'id != ' . $id . ' AND price > 0 AND wardid > 0 AND wardid = ' . $data_content['wardid'] . ' AND status=1 AND status_admin=1 AND is_queue=0 AND price <= ' . $price . ' AND price >= ' . $data_content['price'];
}

// Kiem tra luu tin
$data_content['is_user'] = 0;
$data_content['style_save'] = $data_content['style_saved'] = '';
if (defined('NV_IS_USER')) {
    $data_content['is_user'] = 1;
    $count = $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_saved WHERE itemid=' . $data_content['id'] . ' AND userid=' . $user_info['userid'])->fetchColumn();
    if ($count) {
        $data_content['style_save'] = 'style="display: none"';
    } else {
        $data_content['style_saved'] = 'style="display: none"';
    }
} else {
    $data_content['style_saved'] = 'style="display: none"';
}

$db->sqlreset()
    ->select('id, catid, title, alias, code, area, size_v, size_h, phong_ngu, phong_tam, price, addtime, admin_id, provinceid, districtid, wardid, way_id, address, structure, price_time, bodytext, homeimgfile, homeimgthumb, showprice, group_config')
    ->from(NV_PREFIXLANG . '_' . $module_data)
    ->where($where)
    ->order('ordertime DESC')
    ->limit(3);

$result = $db->query($db->sql());

$data_others = array();
while ($row = $result->fetch()) {
    $data_others[] = nv_data_show($row);
}

$checkss = md5($data_content['id'] . $client_info['session_id'] . $global_config['sitekey']);
$contents = nv_theme_bookhouse_detail($data_content, $room_detail, $array_keyword, $data_others, $checkss, $content_comment);

$page_title = $data_content['title'];
$key_words = implode(', ', $key_words);
$description = $data_content['hometext'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
