<?php
  $data = file_get_contents('php://input');
  header("Location: http://pureivan.com/Results?data=".rawurlencode($data));
?>
