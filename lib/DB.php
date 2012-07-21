<?php

class DB {
  var $connect;
  var $result;

  function __construct($server, $user, $passwd, $db) {
    $this->connect = mysqli_connect($server, $user, $passwd, $db);
    if (!$this->connect) {
      error_log('[error] DB.php Connect error ('.mysqli_connect_errno().') '
		. mysqli_connect_error());
      return FALSE;
    }
    return TRUE;
  }

  function close() {
    mysqli_close($this->connect);
  }

  function query($sql_query) {
    mysqli_real_escape_string($this->connect, $sql_query);
    $this->result = mysqli_query($this->connect, $sql_query);
    if (!$this->result) {
      error_log('[error] DB.php Query execution error.');
      return FALSE;
    }
    return TRUE;
  }

  function fetch() {
    $data = array();
    if (!$this->result or $this->result === TRUE) {
      error_log('[error] DB.php Fetch execution error.');
      return FALSE;
    }
    while ($row = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
      $data[] = $row;
    }
    return $data;
  }
}
