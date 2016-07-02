<?php


$connect = mysqli_connect("localhost","devbawang","MataMerah1945");
$select_db = mysqli_select_db('amsys');

$pilihKomo = "SELECT * FROM info_harga";
$eksKomo = mysqli_query($pilihKomo);
$jumlahData = mysqli_num_rows($eksKomo);
echo $eksKomo;
// while ($dataKomo=mysqli_fetch_assoc($eksKomo)) {
// 	echo $eksKomo['harga_kg']."<br />";
// }


?>