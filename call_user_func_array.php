<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/28/2016
 * Time: 1:45 PM
 */

function multiply() {
  $result_value = 1;

  if(func_num_args() > 0) {

    foreach (func_get_args() as $arg) {
      if (is_numeric($arg)) {
        $result_value *= $arg;
      }
    }
  } else return "You need to include at least one operand!";

  return "Multiplication result: " . $result_value;
}


echo multiply("a", "b", 0.23, 4.65, 12, -9, 123);

echo "<br/>";

echo call_user_func_array('multiply', array("a", "b", 0.23, 4.65, 12, -9, 123));