<?php
error_reporting(E_ALL);

	$connect = mysqli_connect("localhost","devbawang","MataMerah1945");
	// $connect = mysqli_connect("localhost","root","");
	$select_db = mysqli_select_db($connect, 'amsys_db');
	// $select_db = mysqli_select_db($connect, "dialdb_server");
	$tanggal = date('m'); 
	$tahun = date('Y');
	$data = curl_init();
	$url = 'http://infopangan.jakarta.go.id/api/price/series_by_commodity?public=1&cid=12&m='.$tanggal.'&y='.$tahun;
	
	curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($data, CURLOPT_URL, $url);

	$hasil = curl_exec($data);
	
	curl_close($data);
	$decode = json_decode($hasil, true);
	// print_r($decode);

	echo "<p style=color:red>".$decode['data']['0']['series'][1]."</p>";
	$num=0;
	$prosesKomo=null;
	foreach ($decode['data'] as $data) {
		$num++;
		$num2=0;
		foreach ($data['series'] as $data2) {

			$num2++;
			$idKomo = "1";
			$yearKomo = $tahun;
			$monthKomo = $tanggal;
			$dateKomo = $yearKomo."-".$monthKomo."-".$num2;
			$priceKomo = $data['series'][$num2].',00';
			$createKomo =  date("Y-m-d H:i:s");
			$pasar = $data['name'];

			$cekData = "SELECT * FROM info_harga where tanggal='$dateKomo' AND pasar='$pasar'";
			$ekscekData = mysqli_query($connect, $cekData);
			$dataInsert = mysqli_fetch_assoc($ekscekData);
			
			
			if($dataInsert<=0){
				$insertKomo = "INSERT INTO info_harga (komoditas_id,tanggal,harga_kg,pasar,created_at,updated_at,user_id,sumber) values('$idKomo','$dateKomo','$priceKomo','$pasar','$createKomo','$createKomo','1','www.infopangan.jakarta.go.id') ";
				$prosesKomo = mysqli_query($connect, $insertKomo);

				echo "telah berhasil data ".$idKomo." - ".$dateKomo." - ".$priceKomo." - ".$createKomo." - ".$pasar." di insert <br/>";

			}else{
				continue;
			}

		}

	}


?>