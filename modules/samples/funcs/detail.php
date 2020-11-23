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

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = [];

$array_mod_title[] = array(
    'title' => $lang_module['main'],
    'link' => nv_url_rewrite(NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=main', true)
);

$id= $nv_Request->get_int('id','post, get', 0);

if ($id>0) {
    $sql="SELECT * FROM `nv4_vi_samples` WHERE id = ".$id;
    $result =$db->query($sql);
    if(!$row = $result->fetch() ){
        nv_redirect_location(NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=main');
    }
    $page_title= $row['title'];
    
    $array_mod_title[] = array(
        'title' => $page_title= $row['title'],
        'link' => nv_url_rewrite(NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail&amp;id=' .$row['id'], true)
    );
    
}else {
    nv_redirect_location(NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=main');
}


//------------------
// Viết code vào đây
//------------------

$contents = nv_theme_samples_detail($row);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
