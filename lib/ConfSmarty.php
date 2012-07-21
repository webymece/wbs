<?php
require_once('/usr/share/php/smarty/libs/Smarty.class.php');

class ConfSmarty extends Smarty {

  function ConfSmarty () {
    $this->smarty();

    $this->template_dir = "/home/weby/share/htdocs/templates";
    $this->compile_dir = "/home/weby/share/htdocs/templates_c";
    $this->config_dir = "/home/weby/share/htdocs/configs";
    $this->cache_dir = "/home/weby/share/htdocs/cache";

    //$this->caching = true;
    
    //$smarty->debugging = true;
  }

}
