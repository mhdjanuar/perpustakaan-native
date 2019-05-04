<?php
  include '../connect.php';

  if(isset($_GET['edit'])){
    $kode = $_GET['kdBuku'];
    $getByNis = mysqli_query($con,"select * from buku where kd_buku = '$kode' ");
    $row = mysqli_fetch_array($getByNis);

    // echo $row['kd_'];
    echo json_encode($row);
  }
  else if (isset($_GET['simpan'])) {
    $kode = $_POST['kodeBuku'];
    $nama = $_POST['nama'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $jumlah = $_POST['JumlahBuku'];

    $getBykode = mysqli_query($con,"select * from buku where kd_buku = '$kode' ");
    $cekKode = mysqli_num_rows($getBykode);
    if($cekKode != 0){
      $updateBuku = mysqli_query($con,"update buku set nama_buku = '$nama', penerbit = '$penerbit', pengarang = '$pengarang', jumlah_buku = '$jumlah' where kd_buku = $kode");
    }
    else{
      $insertBuku = mysqli_query($con,"insert into buku values('$kode','','$nama','$penerbit','$pengarang','$jumlah')");
    }
  }
  else if(isset($_GET['hapus'])){
    $kode = $_GET['kode'];
    $deleteBuku = mysqli_query($con,"delete from buku where kd_buku = $kode ");
  }
?>
