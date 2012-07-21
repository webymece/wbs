<?php
session_start();

if( empty( $_SESSION['username' ] )){
    header('location:http://weby.orz.hm');
}

require_once('/home/weby/share/lib/ConfSmarty.php');
require_once('/home/weby/share/lib/DB.php');

$smarty = new ConfSmarty();

$db = new DB('localhost', 'weby', 'mece', 'weby');

if (!$db) {
  header('location: ./error');
  exit();
}

$name  = $_POST['name'];
$desc  = $_POST['desc'];
$date  = $_POST['date'];
$join = $_POST['join'];
$presen = $_POST['presen'];
$place = $_POST['place'];
$url   = $_POST['url'];

$query = 'INSERT INTO conference ('
  . 'c_name, '
  . 'c_desc, '
  . 'c_date, '
  . 'c_place, '
  . 'c_m_join, '
  . 'c_m_presen, '
  . 'c_map_url) '
  . 'VALUES ('
  . '\'' . $name . '\', '
  . '\'' . $desc . '\', '
  . '\'' . $date . '\', '
  . '\'' . $place . '\', '
  . '\'' . $join . '\','
  . '\'' . $presen . '\','
  . '\'' . $url . '\');';

$db->query($query);

if (!$db) {
  header('location: ./error');
  exit();
}

$smarty->display('complete.tpl');
