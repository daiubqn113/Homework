<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 03-05-2010
 */

if (! defined('NV_IS_MOD_SEARCH')) {
    die('Stop!!!');
}

$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_samples')
    ->where('active=1 AND (' . nv_like_logic('title', $dbkeyword, $logic) . ' OR ' . nv_like_logic('email', $dbkeyword, $logic).') ');
$num_items = $db->query($db->sql())->fetchColumn();

if ($num_items) {
    $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=detail';

    $db->select('*')
        ->limit($limit)
        ->offset(($page - 1) * $limit);
    $result = $db->query($db->sql());
    while ($row = $result->fetch()) {
        $result_array[] = array(
            'link' => $link . change_alias($row['title']).'-'.$row['id'] . $global_config['rewrite_exturl'],
            'title' => BoldKeywordInStr($row['title'], $key, $logic),
            'content' => BoldKeywordInStr($row['title'] . ' ' .$row['email'], $key, $logic)
        );
    }
}
