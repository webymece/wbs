<?php
session_start();

if(empty($_SESSION['username'])){
    header('Location: http://weby.orz.hm/');
}



require_once('/home/weby/share/lib/ConfSmarty.php');
require_once('/home/weby/share/lib/DB.php');

$smarty = new ConfSmarty();

$db = new DB('localhost', 'weby', 'mece', 'weby');

if (!$db) {
  header('location: ./error');
  exit();
}

$query = 'select * from conference order by c_id desc;';

$db->query($query);

if (!$db) {
  header('location: ./error');
  exit();
}

$data = $db->fetch();

if (!$data) {
  header('location: ./error.php');
  exit();
}

$db->close();

$smarty->assign('all_list', $data);

$smarty->display('regist.tpl');
