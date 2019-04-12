<?php

include_once("../../config.inc.php");
include_once('basic.class.php');
include_once(CFG_LIB_DIR . 'mysqldb.inc.php');

class Audf extends Basic {

    function actionAdd($table) {
        $post = parent::unsetArray($_POST, $arr = array('action'));
        $sql = parent::insert($post, $table);
        $objDb = new mysqldb();
        $msg = $objDb->query($sql);
        if ($msg) {
            parent::popup("添加成功！");
        } else {
            parent::popup("添加失败！");
        }
    }

    function actionUpdate($table, $frstid) {
        $post = parent::unsetArray($_POST, $arr = array('action', $frstid,'id'));
        $where = array($frstid => $_POST['id']);
        $sql = parent::update($post, $table, $where);
        $objDb = new mysqldb();
        $msg = $objDb->query($sql);
        if ($msg) {
            parent::popup("更新成功！");
        } else {
            parent::popup("更新失败！");
        }
    }

    function actionDelete($table, $frstid) {
		if(empty($_POST['ID'])) parent::popup("你没有选择要删除的纪录！");
        $strs = implode(',', $_POST['ID']);
        $sql = "delete  from  `" . $table . "` WHERE  " . $frstid . " in ($strs) ";
        $objDb = new mysqldb();
        $msg = $objDb->query($sql);
        if ($msg)
            parent::popup("删除成功！");
        else
            parent::popup("删除失败！");
    }

}

?>