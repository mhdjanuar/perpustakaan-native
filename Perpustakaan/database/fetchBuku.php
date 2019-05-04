<?php
  include '../connect.php';

  $output = array('data' => array() );

  $query = mysqli_query($con,'select * from buku where jumlah_buku > 0 order By kd_buku');

  while ($row = mysqli_fetch_array($query)) {
    $output['data'][] = array(
      $row['kd_buku'],
      $row['nama_buku'],
      $row['pengarang'],
      $row['penerbit'],
      $row['jumlah_buku'],
      "<button type='button' class='btn btn-success edit' id='".$row['kd_buku']."' name='button'>Edit</button>
      <button type='button' class='btn btn-danger hapus' id='".$row['kd_buku']."' name='button'>Hapus</button>"
    );
  }

  echo json_encode($output);
?>
