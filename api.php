<?php
// AMBIL API KEY DISINI : 
// https://api.xavi3r.id

$api_key = "xxxxxxxxxxxxx";
$nominal = isset($_GET['nominal']) ? $_GET['nominal'] : '';

function Mutasi_OVO($api_key, $nominal = 0) { // Untuk mengambil data mutasi OVO dengan filter jumlah nominal
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://api.xavi3r.id/apiv1/mutasi/ovo");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,'api_key='.$api_key.'&quantity='.$nominal);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec ($ch);
  curl_close ($ch);
  return $result;
}

function Mutasi_BCA($api_key, $nominal = 0) { // Untuk mengambil data mutasi Bank BCA dengan filter jumlah nominal
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://api.xavi3r.id/apiv1/mutasi/bca");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,'api_key='.$api_key.'&quantity='.$nominal);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec ($ch);
  curl_close ($ch);
  return $result;
}

function Info_BCA_OVO($api_key) { // Untuk mengambil data saldo, nama rek, nomor ovo
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://api.xavi3r.id/apiv1/info");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,'api_key='.$api_key);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec ($ch);
  curl_close ($ch);
  return $result;
}

// CONTOH PENGGUNAAN

$get_info = Info_BCA_OVO($api_key);
$data = json_decode($get_info,true);

$norek_bca = $data['data']['BCA']['rekening'];
$saldo_bca = $data['data']['BCA']['balance'];

$nama_ovo = $data['data']['OVO']['nama'];
$no_ovo = $data['data']['OVO']['number'];
$saldo_ovo = $data['data']['OVO']['balance'];
?>

<!--CONTOH PENGGUNAAN-->

<p><h3>Info BCA</h3>
<?php echo $norek_bca; ?> - Rp. <?php echo number_format($saldo_bca); ?></p>

<hr>
<p><h3>Info OVO</h3>
<?php echo $nama_ovo."/".$no_ovo; ?> - Rp. <?php echo number_format($saldo_ovo); ?></p>
