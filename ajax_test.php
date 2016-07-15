<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/29/2016
 * Time: 11:17 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Testing PHP and mysql</title>
  <link rel="stylesheet" href="js/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

      var url = "/sample_helper.php";
      var source = {
        datatype: "json",
        datafields: [
          {name: "FirstName", type: "string"},
          {name: "LastName", type: "string"},
          {name: "BirthDate", type: "string"},
          {name: "JobTitle", type: "string"}],
        url: url
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
      $("#refresh_button").jqxButton({width: 150, height: 25});


    });

  </script>

  <style type="text/css">
    * { font-family: "PT Sans", sans-serif; }
  </style>

</head><body>

<div id="test_grid"></div>
<br>
<input type="button" id="refresh_button" value="Refresh" />

</body></html>
