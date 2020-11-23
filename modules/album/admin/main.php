<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */
if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];

$post = $error = [];

if($nv_Request->isset_request("submit", "post")){
    
    $post['name'] = $nv_Request->get_title('name', "post",'');
    
    if(isset($_FILES, $_FILES['avt'], $_FILES['avt']['tmp_name']) and is_uploaded_file($_FILES['avt']['tmp_name'])){
        $upload = new NukeViet\Files\Upload($admin_info['allow_files_type'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);
        $upload->setLanguage($lang_global);
        $upload_info = $upload->save_file($_FILES['avt'], NV_UPLOADS_REAL_DIR, false, $global_config['nv_auto_resize']);
    }
    
    if ($post['name'] == ''){
        $error[] = $lang_module['error_name'];
    }
    
    if (empty($error)) {
        $sql = "INSERT INTO `nv4_vi_album` ( name, avt) VALUES ( :name, :avt)";
        $s = $db->prepare($sql);
        $s->bindParam('name', $post['name']);
        $s->bindParam('avt',  $upload_info['basename']);
//         die("a");
        $s->execute();  
        $error[] = $lang_module['insert_suc'];
    }
}
//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('POST', $post);
$xtpl->assign('ERROR', implode('</br>',$error));
if(!empty($error)){
    $xtpl->parse('main.error');
}


//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
