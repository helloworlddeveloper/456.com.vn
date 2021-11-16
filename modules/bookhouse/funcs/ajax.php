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

if ($nv_Request->isset_request('refresh', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $checkss = $nv_Request->get_title('checkss', 'post', '');
    
    if (empty($id) or empty($checkss) or ! defined('NV_IS_USER')) {
        die('NO_' . $lang_module['error_unknow']);
    }
    
    if ($checkss == md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $id) and $array_config['refresh_allow']) {
        $count_refresh = nv_count_refresh($module_name);
        $count_refresh_free = nv_count_refresh_free($module_name);
        
        if ($count_refresh_free > 0) {
            $currentdate = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
            try {
                $db->query('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_refresh(userid, count, free, free_time) VALUES(' . $user_info['userid'] . ', ' . $count_refresh . ', ' . ($array_config['refresh_free'] - 1) . ', ' . $currentdate . ')');
            } catch (Exception $e) {
                $refresh = $db->query('SELECT free, free_time FROM ' . NV_PREFIXLANG . '_' . $module_data . '_refresh WHERE userid=' . $user_info['userid'])->fetch();
                if ($refresh['free_time'] == $currentdate) {
                    $free = $refresh['free'] - 1;
                } else {
                    $free = $array_config['refresh_free'] - 1;
                }
                $db->exec('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_refresh SET free=' . $free . ', free_time=' . $currentdate . ' WHERE userid=' . $user_info['userid']);
            }
            $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET ordertime=' . NV_CURRENTTIME . ' WHERE id=' . $id);
            die('OK');
        } elseif ($count_refresh > 0) {
            try {
                $db->query('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_refresh(userid, count) VALUES(' . $user_info['userid'] . ', ' . ($count_refresh - 1) . ')');
            } catch (Exception $e) {
                $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_refresh SET count=count-1 WHERE userid=' . $user_info['userid']);
            }
            $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET ordertime=' . NV_CURRENTTIME . ' WHERE id=' . $id);
            die('OK');
        } else {
            die('NO_' . $lang_module['refresh_error']);
        }
    }
    
    die('NO_' . $lang_module['error_unknow']);
}

if ($nv_Request->isset_request('save', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $mod = $nv_Request->get_title('mod', 'post', '');
    
    if (empty($id) or ! defined('NV_IS_USER')) {
        die('NO_' . $lang_module['error_save_rows']);
    }
    
    $count = $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetchColumn();
    if ($count) {
        try {
            if ($mod == 'add') {
                $db->query('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_saved (userid, itemid) VALUES(' . $user_info['userid'] . ', ' . $id . ')');
                die('OK_' . $lang_module['item_save_success']);
            } elseif ($mod == 'remove') {
                $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_saved WHERE userid=' . $user_info['userid'] . ' AND itemid=' . $id);
                die('OK_' . $lang_module['item_save_remove_success']);
            }
        } catch (Exception $e) {
            //
        }
    }
    die('NO_' . $lang_module['error_save_rows']);
}

if ($nv_Request->isset_request('saved_delete', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $checkss = $nv_Request->get_title('checkss', 'post', '');
    
    if (! empty($id) and $checkss == md5($global_config['sitekey'] . '-' . $id)) {
        nv_delete_saved($id);
        die('OK');
    } else {
        die('NO_' . $lang_module['saved_delete_error']);
    }
} elseif ($nv_Request->isset_request('saved_delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);
    $checkss = $nv_Request->get_title('checkss', 'post', '');
    
    if (! empty($array_id) and $checkss == md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . NV_CACHE_PREFIX)) {
        foreach ($array_id as $id) {
            nv_delete_saved($id);
        }
        die('OK');
    }
    die('NO');
}

if ($nv_Request->isset_request('buy_refresh', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $number = $nv_Request->get_int('number', 'post', 0);
    $checksum = $nv_Request->get_title('checksum', 'post', '');
    
    if (! defined('NV_IS_USER') or empty($checksum) or empty($number)) {
        die('NO_' . $lang_module['error_unknow']);
    }
    
    if ($checksum == md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $id . '-' . $number)) {
        $count = nv_count_refresh($module_name);
        try {
            // thêm thành viên vào bảng _refresh, nếu có rồi thì cập nhật
            $db->query('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_refresh(userid, count) VALUES(' . $user_info['userid'] . ', ' . $number . ')');
        } catch (Exception $e) {
            $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_refresh SET count=count + ' . $number . ' WHERE userid=' . $user_info['userid']);
        }
        
        $nv_Cache->delMod($module_name);
        
        die('OK_' . sprintf($lang_module['refresh_success'], intval($count) + $number));
    }
    
    die('NO_' . $lang_module['error_unknow']);
}

if ($nv_Request->isset_request('buy_group', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $time = $nv_Request->get_int('time', 'post', 0);
    $groupid = $nv_Request->get_int('groupid', 'post', 0);
    $checksum = $nv_Request->get_title('checksum', 'post', '');
    
    if (empty($id) or empty($checksum) or empty($groupid) or empty($time)) {
        die('NO_' . $lang_module['error_unknow']);
    }
    
    if ($checksum == md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $id . '-' . $time)) {
        // taikhoan
        require (NV_ROOTDIR . "/modules/taikhoan/check.transaction.class.php");
        $module_send = $module_name;
        $postid = intval($id);
        $userid = $user_info['userid'];
        
        $tk_check = new TK_check_transaction($module_send, $postid, $userid);
        if (! $tk_check->check_tracsaction()) {
            die($lang_module['payment_error']);
        }
        
        try {
            $exptime = NV_CURRENTTIME + ($time * 86400);
            if (nv_item_group($groupid, $id, 0, $exptime)) {
                
                // Cập nhật độ ưu tin cho tin bđs
                $array_prior = array();
                $result = $db->query('SELECT bid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE id=' . $id);
                while (list ($bid) = $result->fetch(3)) {
                    $array_prior[] = $array_groups[$bid]['prior'];
                }
                
                $prior = ! empty($array_prior) ? max($array_prior) : 0;
                $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET prior=' . $prior . ' WHERE id=' . $id);
                
                $nv_Cache->delMod($module_name);
                
                die('OK');
            }
        } catch (Exception $e) {
            $exptime = $db->query('SELECT exptime FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE bid=' . $groupid)->fetchColumn();
            if ($exptime == 0 or $exptime < NV_CURRENTTIME) {
                $exptime = NV_CURRENTTIME + ($time * 86400);
            } else {
                $exptime = $exptime + ($time * 86400);
            }
            $exptime = $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_block SET exptime=' . $exptime . ' WHERE bid=' . $groupid);
            
            $nv_Cache->delMod($module_name);
            
            die('OK_' . $lang_module['upgrade_success']);
        }
    }
    
    die('NO_' . $lang_module['error_unknow']);
}

if ($nv_Request->isset_request('upgrade_group', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $time = $nv_Request->get_int('time', 'post', 0);
    $groupid = $nv_Request->get_int('groupid', 'post', 0);
    $checksum = $nv_Request->get_title('checksum', 'post', '');
    
    // nếu mod là nâng cấp tài khoản thì productid lấy bằng groupid
    if ($mod == 'upgrade_group') {
        $id = $groupid;
    }
    
    if (empty($id) or empty($checksum) or empty($groupid) or empty($time)) {
        die('NO_' . $lang_module['error_unknow']);
    }
    
    if ($checksum == md5($global_config['sitekey'] . '-' . $user_info['userid'] . '-' . $id . '-' . $time)) {
        
        // taikhoan
        require (NV_ROOTDIR . "/modules/taikhoan/check.transaction.class.php");
        $module_send = $module_name;
        $postid = intval($id);
        $userid = $user_info['userid'];
        
        $tk_check = new TK_check_transaction($module_send, $postid, $userid);
        if (! $tk_check->check_tracsaction()) {
            die($lang_module['payment_error']);
        }
        
        // thêm thành viên vào nhóm
        $exptime = NV_CURRENTTIME + ($time * 86400);
        try {
            $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_users_groups(userid, groupid, exptime) VALUES(:userid, :groupid, ' . $exptime . ')');
            $stmt->bindParam(':userid', $user_info['userid'], PDO::PARAM_INT);
            $stmt->bindParam(':groupid', $groupid, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_users_groups WHERE userid=' . $user_info['userid'])->fetch();
            if ($row['exptime'] > NV_CURRENTTIME) {
                if ($row['groupid'] == $groupid) {
                    // neu gia han thi cong don thoi gian
                    $exptime = $row['exptime'] + ($time * 86400);
                } else {
                    // neu nang cap thi tinh toan thoi gian chuyen doi
                    $number = ((($row['exptime'] - NV_CURRENTTIME) * $array_config['upgrade_group_percent']) / 100);
                    $exptime = NV_CURRENTTIME + ($time * 86400) + $number;
                }
            }
            $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_users_groups SET groupid = :groupid, exptime = ' . $exptime . ' WHERE userid=:userid');
            $stmt->bindParam(':userid', $user_info['userid'], PDO::PARAM_INT);
            $stmt->bindParam(':groupid', $groupid, PDO::PARAM_STR);
            $stmt->execute();
        }
        die('OK_' . $lang_module['upgrade_success']);
    }
    
    die('NO_' . $lang_module['error_unknow']);
}

if ($nv_Request->isset_request('getType', 'post, get')) {
    $catid = $nv_Request->get_int('catid', 'post, get', 0);
    
    $array_type = array();
    $result = $db->query('SELECT id, title FROM ' . NV_PREFIXLANG . '_' . $module_data . '_type t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_type_catid t2 ON t1.id=t2.typeid WHERE t1.status=1 AND t2.catid=' . $catid . ' ORDER BY t1.weight');
    while ($row = $result->fetch()) {
        $array_type[$row['id']] = $row;
    }
    
    die(json_encode($array_type));
}

if ($nv_Request->isset_request('getTypeCat', 'post, get')) {
    $typeid = $nv_Request->get_int('typeid', 'post, get', 0);
    
    $array_catid = array();
    $result = $db->query('SELECT catid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_type_catid WHERE typeid=' . $typeid);
    while (list ($catid) = $result->fetch(3)) {
        $array_catid[] = $catid;
    }
    
    $array_cat_tmp = array();
    if (! empty($array_cat)) {
        foreach ($array_cat as $catid => $value) {
            
            $value['space'] = '';
            if ($value['lev'] > 0) {
                for ($i = 1; $i <= $value['lev']; $i ++) {
                    $value['space'] .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            
            if (in_array($catid, $array_catid)) {
                $array_cat_tmp[$catid] = array(
                    'id' => $catid,
                    'title' => $value['title'],
                    'space' => $value['space']
                );
            }
        }
    }
    
    die(json_encode($array_cat_tmp));
}

if ($nv_Request->isset_request('getcat', 'post')) {
    $typeid = $nv_Request->get_int('typeid', 'post', 0);
    
    if (empty($typeid)) {
        die();
    }
    
    $array_catid = array();
    $result = $db->query('SELECT catid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_type_catid WHERE typeid=' . $typeid);
    while (list ($catid) = $result->fetch(3)) {
        $array_catid[] = $catid;
    }
    
    $html = '';
    $listcat = nv_listcats(0, 0, $array_catid);
    $html .= '<option value="">---' . $lang_module['cat_chose'] . '---</option>';
    if (! empty($listcat)) {
        foreach ($listcat as $cat) {
            $html .= '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
        }
    }
    die($html);
}

if ($nv_Request->isset_request('getpricetype', 'post')) {
    $typeid = $nv_Request->get_int('typeid', 'post', 0);
    
    if (empty($typeid)) {
        die();
    }
    
    $html = '';
    $array_pricetype = nv_get_pricetype($typeid);
    $html .= '<option value="">---' . $lang_module['pricetype_select'] . '---</option>';
    if (! empty($array_pricetype)) {
        foreach ($array_pricetype as $pricetype) {
            $html .= '<option value="' . $pricetype['id'] . '">' . $pricetype['title'] . '</option>';
        }
    }
    die($html);
}

if ($nv_Request->isset_request('getprojects', 'post')) {
    $type = $nv_Request->get_title('type', 'post', '');
    $value = $nv_Request->get_int('value', 'post', 0);
    
    if (empty($type) or empty($value)) {
        die();
    }
    
    $array = array(
        'provinceid' => 0,
        'districtid' => 0,
        'wardid' => 0
    );
    $array[$type] = $value;
    $array_project = nv_get_projetcs($array['provinceid'], $array['districtid'], $array['wardid']);
    
    $html = '<option value="">---' . $lang_module['projetc_select'] . '---</option>';
    if (! empty($array_project)) {
        foreach ($array_project as $index => $value) {
            $html .= '<option value="' . $index . '">' . $value['title'] . '</option>';
        }
    }
    die($html);
}
