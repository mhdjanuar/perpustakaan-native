<?php
  include '../connect.php';

  $output = array('data' => array() );

  $query = mysqli_query($con,'select * from siswa');

  while ($row = mysqli_fetch_array($query)) {
    $output['data'][] = array(
      $row['nis'],
      $row['nama_siswa'],
      $row['kelas'],
      $row['jurusan'],
      "<button type='button' class='btn btn-success edit' id='".$row['nis']."' name='button'>Edit</button>
      <button type='button' class='btn btn-danger hapus' id='".$row['nis']."' name='button'>Hapus</button>"
    );
  }

  echo json_encode($output);
?>
