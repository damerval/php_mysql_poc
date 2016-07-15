<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 7/14/2016
 * Time: 11:09 AM
 */

if (session_status() === PHP_SESSION_NONE){session_start();}
$_SESSION = array();

$form_submitted = $_SERVER['REQUEST_METHOD'] == 'POST';
$user_name = "";
$user_num = null;
$names = array(1 => "Philippe Damerval", 2 => "John Smith", 3 => "James Jones");

if ($form_submitted) {
  $_SESSION['user_id'] = $_POST['sel_user'];
  $_SESSION['user_name'] = $names[$_POST['sel_user']];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login choices</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" language="javascript">

    $(document).ready(function(){
      <?php
        $s = $_SESSION['user_id'] . " - " . $_SESSION['user_name'];
        if ($form_submitted) { echo "alert(\"" . $s . "\");"; }
      ?>
      $("#but_submit").on('click', function() {
        var selected_value = $("#sel_user").val();
        var submit = selected_value != null;
        if (submit) {
          $("#fmain").submit();
        } else alert ("You need to select a login before submitting.");
      });
    });

  </script>
</head>

<body>

<form name="fmain" id="fmain" action="" method="post" onsubmit="alert($('#sel_user').val(); event.preventDefault();">

  <select title="User Selector" id="sel_user" name="sel_user">
    <option disabled selected>Choose login</option>
    <option value="1">Philippe Damerval</option>
    <option value="2">John smith</option>
    <option value="3">James Jones</option>
  </select>

  <input type="button" id="but_submit" name="but_submit" value="Login">



</form>

</body>
</html>