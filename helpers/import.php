<?
if (isset($_POST["import"])) {

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 0; $i <= $sheetCount; $i ++) {
            $county = "";
            if (isset($spreadSheetAry[$i][0])) {
                $county = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
            $subcounty = "";
            if (isset($spreadSheetAry[$i][1])) {
                $subcounty = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }

            $ward = "";
            if (isset($spreadSheetAry[$i][0])) {
                $ward = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }
            $village = "";
            if (isset($spreadSheetAry[$i][1])) {
                $village = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }
            $name = "";
            if (isset($spreadSheetAry[$i][0])) {
                $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
            }
            $idno = "";
            if (isset($spreadSheetAry[$i][1])) {
                $idno = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }
            $phone = "";
            if (isset($spreadSheetAry[$i][0])) {
                $phone = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }

            if (! empty($county) || ! empty($subcounty)|| ! empty($ward)|| ! empty($village)|| ! empty($name) ||! empty($idno)|| ! empty($phone)) {
                // $query = "insert into tbl_info(county,sub_county,ward,village,name,id_no,phone) values(?,?,?,?,?,?,?,?)";
                // $paramType = "ss";
                // $paramArray = array(
                //     $county,
                //     $subcounty,
                //     $ward,
                //     $village,
                //     $name,
                //     $idno,
                //     $phone
                // );
                $query = "insert into tbl_info(county,sub_county,ward,village,name,id_no,phone) values('" . $county . "','" . $subcounty . "','" . $ward . "','" . $village . "','" . $name . "','" . $idno . "','" . $phone . "')";
                // $insertId = $db->insert($query, $paramType, $paramArray);



                if (mysqli_query($conn, $query)) {
                    $type = "success";
                    $message = "Excel Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing Excel Data";
                }
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}
?>
