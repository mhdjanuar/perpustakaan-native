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
          
                $no = "";
                if(isset($Row[0])) {
                    $name = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                $judulbuku = "";
                if(isset($Row[1])) {
                    $judulbuku = mysqli_real_escape_string($conn,$Row[1]);
                }

                $pengarang = "";
                if(isset($Row[2])) {
                    $pengarang = mysqli_real_escape_string($conn,$Row[2]);
                }

                $penerbit = "";
                if(isset($Row[3])) {
                    $penerbit = mysqli_real_escape_string($conn,$Row[3]);
                }
                
                $sumber = "";
                if(isset($Row[4])) {
                    $sumber = mysqli_real_escape_string($conn,$Row[4]);
                }

                $tglterima = "";
                if(isset($Row[5])) {
                    $tglterima = mysqli_real_escape_string($conn,$Row[5]);
                }

                $jumlah = "";
                if(isset($Row[6])) {
                    $jumlah = mysqli_real_escape_string($conn,$Row[6]);
                }

                $harga = "";
                if(isset($Row[7])) {
                    $harga = mysqli_real_escape_string($conn,$Row[7]);
                }

                $penerbit = "";
                if(isset($Row[8])) {
                    $keterangan = mysqli_real_escape_string($conn,$Row[8]);
                }

                if (!empty($no) || !empty($judulbuku) || !empty($pengarang) || !empty($penerbit) || !empty($sumber) || !empty($tglterima) || !empty($jumlah) || !empty($harga) || !empty($ket)) {
                    $query = "insert into perpustakaan_v2(no,judulbuku,pengarang,penerbit,sumber,tglterima,jumlah,harga,ket) values('".$no."','".$judulbuku."','".$pengarang."','".$penerbit."','".$sumber."','".$tglterima."','".$jumlah."','".$harga."','".$ket."')";
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
    $result = mysqli_query($conn, "SELECT * FROM perpustakaan_v2");

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Sumber</th>
                <th>Tanggal Penerimaan</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Keterangan</th>

            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['no']; ?></td><td>
            <td><?php  echo $row['judulbuku']; ?></td>
            <td><?php  echo $row['pengarang']; ?></td>
            <td><?php  echo $row['penerbit']; ?></td>
            <td><?php  echo $row['sumber']; ?></td>
            <td><?php  echo $row['tglterima']; ?></td>
            <td><?php  echo $row['jumlah']; ?></td>
            <td><?php  echo $row['harga']; ?></td>
            <td><?php  echo $row['ket']; ?></td>            
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