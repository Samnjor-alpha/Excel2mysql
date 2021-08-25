<?

use import\config;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once 'config/config.php';
$db = new Config();
$conn = $db->getConnection();
require_once ('./vendor/autoload.php');
include 'helpers/import.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import Spreadsheet to SQl Database</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body id="content">
    <div class="container">
        <div id="response"       class="text-center <?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
      <form action="" method="post" name="frmExcelImport" id="frmExcelImport" class="mt-2" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-8 col-sm-12">
        <div class="custom-file mb-2">
          <input type="file" accept=".xls,.xlsx"  name="file" required class="form-control custom-file-input" id="customFile">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
      </div>

      <div class=" form-group col-md-4 col-sm-12">
        <button type="submit" id="submit" name="import"
                  class="btn btn-block btn-warning">Import</button>
      </div>
      </div>
      </form>




  </div>
<div>
  <?php
  $sqlSelect = "SELECT * FROM tbl_info";
  $result = $db->select($sqlSelect);
  if (! empty($result)) {
      ?>

      <table class='tutorial-table'>
          <thead>
              <tr>
                  <th>County</th>
                  <th>Sub county</th>
                  <th>Name</th>
                  <th>Ward</th>
                  <th>village</th>
                  <th>Id no</th>
                  <th>Phone</th>

              </tr>
          </thead>
  <?php
      foreach ($result as $row) { // ($row = mysqli_fetch_array($result))
          ?>
          <tbody>
              <tr>
                  <td><?php  echo $row['county']; ?></td>
                  <td><?php  echo $row['sub_county']; ?></td>
                  <td><?php  echo $row['name']; ?></td>
                  <td><?php  echo $row['ward']; ?></td>
                  <td><?php  echo $row['village']; ?></td>
                  <td><?php  echo $row['id_no']; ?></td>
                  <td><?php  echo $row['phone']; ?></td>
              </tr>
  <?php
      }
      ?>
          </tbody>
      </table>
  <?php
  }
  ?>
</div>

  <script src="js\jquery-3.3.1.min.js"></script>
  <!-- bootstrap js file -->
    <script src="js\bootstrap.min.js"></script>
  <script src="js\script.js"></script>

  </body>
</html>
