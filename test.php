<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/25/2016
 * Time: 9:54 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/functions/data_access.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/mysqli_prepare_dyn.php");

$sql = "select * from (select * from employee_view where LastName like 'b%') a order by LastName";

$sql_prepared = "select * from (select * from employee_view where LastName like ?) a order by LastName";

$args = [["arg_name" => "search_string", "arg_value" => "b%", "arg_type" => "s"]];

$rows = get_result_set_prepared($sql_prepared, $args);

$results_list = json_encode($rows);

$results_list = get_data();

$results_list = get_result_set_prepared_dynamic(
    "SELECT * FROM employee_view WHERE /*LastName LIKE ? /*OR */ BirthDate > ? OR JobTitle = ? ORDER BY FirstName",
    array("1985-01-01", "Production Technician - WC50"),
    "ss");

echo "<!-- " . $results_list . " -->";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Testing PHP and mysql</title>
  <link rel="stylesheet" href="js/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
  <script type="text/javascript" language="javascript" src="js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxcore.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxdata.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxbuttons.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxscrollbar.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxmenu.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxlistbox.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxdropdownlist.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxgrid.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxgrid.selection.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxgrid.columnsresize.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxgrid.filter.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxgrid.sort.js"></script>
  <script type="text/javascript" language="javascript" src="js/jqwidgets/jqxgrid.pager.js"></script>

  <script type="text/javascript" language="javascript">

    $(document).ready(function() {

      var data = [];  // Contains the JSON dataset from the php code-behind
      data = <?=(isset($results_list)?$results_list:"[]")?>;
      var source = {
        localdata: data,
        datatype: "json",
        datafields: [
          {name: "FirstName", type: "string"},
          {name: "LastName", type: "string"},
          {name: "BirthDate", type: "string"},
          {name: "JobTitle", type: "string"}]
      };
      var adapter = new $.jqx.dataAdapter(source);
      $("#test_grid").jqxGrid({
        source: adapter,
        columns: [
          {text: "First Name", datafield: "FirstName", width: 100},
          {text: "Last Name", datafield: "LastName", width: 100},
          {text: "Born", datafield: "BirthDate", width: 100},
          {text: "Title", datafield: "JobTitle", width: 250}
        ],
        width: 570, height: 450
      });

    });

  </script>

  <style type="text/css">
    * { font-family: "PT Sans", sans-serif; }
  </style>

</head>
<body>

<div id="test_grid"></div>

</body>
</html>


