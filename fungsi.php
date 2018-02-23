<?php
$date = date('Y-m-d');
function tanggal_indo($tanggal, $cetak_hari = false)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);

	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}
$tanggal = tanggal_indo ($date, true);

$dat_server = mktime(date("G"), date("i"), date("s"), date("n"), date("j"), date("Y"));

$diff_gmt = substr(date("O",$dat_server),1,2);
$datdif_gmt = 60 * 60 * $diff_gmt;

if (substr(date("O",$dat_server),0,1) == '+') {
    $dat_gmt = $dat_server-$datdif_gmt;
    } else {
    $dat_gmt = $dat_server + $datdif_gmt;
    }
    $datdif_id = 60 * 60 * 7;
    $dat_id = $dat_gmt + $datdif_id;

$jam_skrg = date("H:i:s", $dat_id);
?>