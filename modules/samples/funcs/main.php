<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_MOD_SAMPLES')) {
    die('Stop!!!');
}
$array_data = [];
$perpage = 5;
$page= $nv_Request->get_int('page', "get", 1 );

$keyword = $nv_Request->get_title('keyword', "get", '');

 $db->sqlreset()
->select('COUNT(*)')
->from(NV_PREFIXLANG . "_" .$module_data)
->where("title LIKE " . $db->quote('%'.$keyword.'%'));

$sql = $db->sql();
// die($sql);
$total = $db->query($sql)->fetchColumn();



$db->select('*')
->order("weight ASC")
->LIMIT($perpage)
->offset(($page -1) * $perpage);

$sql = $db->sql();
$result = $db->query($sql);
while($row=$result->fetch()){
    $array_data[$row['id']]=$row;
}

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$base_url = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail';

$generate_page = nv_generate_page($base_url, $total, $perpage, $page);

$page_title = $lang_module['main'];
$contents = nv_theme_samples_main($array_data, $perpage, $page, $generate_page, $keyword);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
