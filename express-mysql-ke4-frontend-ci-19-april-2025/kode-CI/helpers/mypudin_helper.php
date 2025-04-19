<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); 
/*
* Pudin S I
* najzmitea@gmail.com
* Ciamis, Jawa Barat
* https://t.me/pudin_ira
* https://instagram.com/pudin.ira
* https://www.pdn.my.id
*/
if ( ! function_exists('pdn_cek_status'))
{
	function pdn_cek_status($tatus='') {
		// if ($tatus == ''){
		// 	redirect(base_url('bo/logout'));
		// }

		if ($tatus == 'expired'){
			redirect(base_url('bo/logout'));
		}

		if ($tatus == 'gettoken'){
			redirect(base_url('bo/logout'));
		}
	}
}

// Pemanggilanya : pdn_rupiah(angkanya)
if ( ! function_exists('pdn_rupiah'))
{
	function pdn_rupiah($angka)
	{	
		$hasil_rp = "Rp ".number_format($angka,0,',','.');
		return $hasil_rp;
	}
}

// Pemanggilanya : pdn_tanggal(tanggalnya)
if ( ! function_exists('pdn_tanggal'))
{
	function pdn_tanggal($tanggal)
	{	
		$hasil_tgl = date('d-m-Y', strtotime($tanggal));
		return $hasil_tgl;
	}
}

// Pemanggilanya : pdn_titikhilang(angkanya)
if ( ! function_exists('pdn_titikhilang'))
{
	function pdn_titikhilang($angkaa)
	{	
		$hasil_nya = str_replace(".", "", $angkaa);
		return $hasil_nya;
	}
}
// Pemanggilanya : pdn_titikhilang(angkanya)

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Ahad";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}
// Pemanggilanya : nama_hari(Tanggal)