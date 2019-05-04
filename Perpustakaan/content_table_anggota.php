<?php
include 'connect.php';

$query = mysqli_query($con,"select * from siswa");

$no = 1;

while($data = mysqli_fetch_array($query))
	{
		echo "<tr>";
		echo "<td>".$data['nis']."</td>";
		echo "<td>".$data['nama_siswa']."</td>";
		echo "<td>".$data['kelas']."</td>";
		echo "<td>".$data['jurusan']."</td>";
		echo "<td>
					<a href='content_table_anggota.php?nis=".$data['nis']."'
					nis='".$data['nis']."'
					nama='".$data['nama_siswa']."'
					kelas='".$data['kelas']."'
					jurusan='".$data['jurusan']."' class='UpdateData'>Edit</a>
			  </td>";
		echo "</tr>";
	}



if(isset($_POST['nis'])){
	 $nis = $_POST['nis'];
	 $nama_siswa = $_POST['nama'];
	 $kelas = $_POST['kelas'];
	 $jurusan= $_POST['jurusan'];

	 $sql = mysqli_query($con,"select * from siswa where nis=$nis");
	 $cek = mysqli_num_rows($sql);

	 if($cek == 1){
		$update=mysqli_query($con,"update siswa set nama_siswa='$nama_siswa',kelas='$kelas',jurusan='$jurusan' where nis=$nis");
	 }
	 else if($cek == 0){
		$insert = mysqli_query($con,"insert into siswa values($nis,'$nama_siswa','$kelas','$jurusan')");
	 }else{
		 echo 'Tidak Boleh Kosong';
	 }
}
