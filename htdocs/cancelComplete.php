<?php
session_start();

if( empty( $_SESSION['username'] )){
    header('Location: http://weby.orz.hm');
}

require_once('/home/weby/share/lib/ConfSmarty.php');
require_once('/home/weby/share/lib/DB.php');

$smarty = new ConfSmarty();

$db = new DB('localhost', 'weby', 'mece', 'weby');

if (!$db) {
  header('location: ./error');
  exit();
}

$u_id = $_POST['u_id'];

$query = 'DELETE from usr where u_id = '.$u_id;

$db->query($query);

if (!$db) {
  header('location: ./error');
  exit();
}

$smarty->display('cancelComplete.tpl');
