<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 7/14/2016
 * Time: 11:09 AM
 */


session_start();
$_SESSION = array();

$form_submitted = $_SERVER['REQUEST_METHOD'] == 'POST';
$user_name = "";
$user_num = null;
$names = array(1 => "Philippe Damerval", 2 => "John Smith", 3 => "James Jones");

if ($form_submitted) {
  $_SESSION['user_id'] = $_POST['sel_user'];
  $_SESSION['user_name'] = $names[$_POST['sel_user']];
  header("Location: grid.html");
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
      if ($form_submitted) {
        echo "alert(\"" . $_SESSION['user_id'] . " - " . $_SESSION['user_name'] . "\");";
      }
    ?>
    $("#but_submit").on('click', function() {
      if ($("#sel_user").val() != null) {
        $("#fmain").submit();
      } else alert ("You need to select a login before submitting.");
    });
  });

  </script>
</head>

<body>

<form name="fmain" id="fmain" method="post" onsubmit="alert($('#sel_user').val(); event.preventDefault();">

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