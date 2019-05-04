<?php
  include '../connect.php';

  if (isset($_GET['hapus'])) {
    $nis = $_GET['nis'];
    $delete = mysqli_query($con,'delete from siswa where nis = "'.$nis.'" ');
  }
  else if(isset($_GET['edit'])){
    $nis = $_GET['nis'];
    $getByNis = mysqli_query($con,'select * from siswa where nis = "'.$nis.'" ');
    $data = mysqli_fetch_array($getByNis);
    echo json_encode($data);
  }
  else if (isset($_GET['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    $takeNis = mysqli_query($con,"select * from siswa where nis = '$nis' ");
    $cekNis = mysqli_num_rows($takeNis);
    if ($cekNis != 0) {
      $update = mysqli_query($con,"update siswa set nama_siswa = '$nama', kelas = '$kelas', jurusan = '$jurusan' where nis = '$nis' ");
    }
    else {
      $insert = mysqli_query($con,"insert into siswa values('$nis','$nama','$kelas','$jurusan')");
    }
  }
?>
