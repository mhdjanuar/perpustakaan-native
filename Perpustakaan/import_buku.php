<?php
$conn = mysqli_connect("localhost","root","","perpustakaan_v2");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
    
    
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $kd_buku = "";
                if(isset($Row[0])) {
                    $kd_buku = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                $kd_rak = "";
                if(isset($Row[1])) {
                    $kd_rak = mysqli_real_escape_string($conn,$Row[1]);
                }

                $nama_buku = "";
                if(isset($Row[2])) {
                    $nama_buku = mysqli_real_escape_string($conn,$Row[2]);
                }

                $penerbit = "";
                if(isset($Row[3])) {
                    $penerbit = mysqli_real_escape_string($conn,$Row[3]);
                }
                
                $jumlah_buku = "";
                if(isset($Row[4])) {
                    $jumlah_buku = mysqli_real_escape_string($conn,$Row[4]);
                }

                

                if (!empty($kd_buku) || !empty($kd_rak) || !empty($nama_buku) || !empty($penerbit) || !empty($jumlah_buku)) {
                    $query = "insert into buku(kd_buku,kd_rak,nama_buku,penerbit,jumlah_buku) values('".$kd_buku."','".$kd_rak."','".$nama_buku."','".$penerbit."','".$jumlah_buku."')";
                    $result = mysqli_query($conn, $query);
                
                    if (! empty($result)) {
                        $type = "success";
                        $message = "Excel Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                    }
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}
?>

<!DOCTYPE html>
<html>    
<head>
<style>    
body {
	font-family: Arial;
	width: 550px;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
    border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
</head>

<body>
    <h2>Import Excel File into MySQL Database using PHP</h2>
    
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Import</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
         
<?php
    $result = mysqli_query($conn, "SELECT * FROM buku");

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>Kode Buku</th>
                <th>Kode Rak</th>
                <th>Nama Buku</th>
                <th>Penerbit</th>
                <th>Jumlah Buku</th>

            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['kd_buku']; ?></td>
            <td><?php  echo $row['kd_rak']; ?></td>
            <td><?php  echo $row['nama_buku']; ?></td>
            <td><?php  echo $row['penerbit']; ?></td>
            <td><?php  echo $row['jumlah_buku']; ?></td>
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
?>

</body>
</html>