<?php

/**
 * Fetch the census data for 2008 from Pakistan Government Census website
 * and export it as JSON formated text files
 * @version: 1.0
 * @author: hello@jabran.me
 * @package: Free Public Data (Pakistan)
 *
 */

require ('simple_html_dom.php');

define('DATAPATH', dirname(dirname(__FILE__)) . '/data');


// $filename = '/nwfp_lower_dir.json';
// $url = 'http://census.gov.pk/NWFP/DIR.htm';

// $filename = '/nwfp_bannu.json';
// $url = 'http://census.gov.pk/NWFP/BANNU.htm';

// $filename = '/nwfp_buner.json';
// $url = 'http://census.gov.pk/NWFP/BUNER.htm';

// $filename = '/nwfp_chitral.json';
// $url = 'http://census.gov.pk/NWFP/CHITRAL.htm';

// $filename = '/nwfp_hangu.json';
// $url = 'http://census.gov.pk/NWFP/HANGU.htm';

// $filename = '/nwfp_abbottabad.json';
// $url = 'http://census.gov.pk/NWFP/ABBOTTABAD.htm';

// $filename = '/nwfp_charsadda.json';
// $url = 'http://census.gov.pk/NWFP/CHARSADDA.htm';

// $filename = '/nwfp_haripur.json';
// $url = 'http://census.gov.pk/NWFP/HARIPUR.htm';

// $filename = '/nwfp_kohat.json';
// $url = 'http://census.gov.pk/NWFP/KOHAT.htm';

// $filename = '/nwfp_kohistan.json';
// $url = 'http://census.gov.pk/NWFP/KOHISTAN.htm';

// $filename = '/nwfp_malakand.json';
// $url = 'http://census.gov.pk/NWFP/MALAKAND.htm';

// $filename = '/nwfp_mardan.json';
// $url = 'http://census.gov.pk/NWFP/MARDAN.htm';

// $filename = '/nwfp_pehsaware.json';
// $url = 'http://census.gov.pk/NWFP/PESHAWARE.htm';

// $filename = '/nwfp_swabi.json';
// $url = 'http://census.gov.pk/NWFP/SWABI.htm';

// $filename = '/nwfp_tank.json';
// $url = 'http://census.gov.pk/NWFP/TANK.htm';

// $filename = '/nwfp_batagram.json';
// $url = 'http://census.gov.pk/NWFP/BATAGRAM.htm';

// $filename = '/nwfp_dera_ismail_khan.json';
// $url = 'http://census.gov.pk/NWFP/DERA%20ISMAIL%20KHAN.htm';

// $filename = '/nwfp_marwat.json';
// $url = 'http://census.gov.pk/NWFP/LAKKI%20MARWAT.htm';

// $filename = '/nwfp_mansehra.json';
// $url = 'http://census.gov.pk/NWFP/MANSEHRA.htm';

// $filename = '/nwfp_nowshera.json';
// $url = 'http://census.gov.pk/NWFP/NOWSHERA.htm';

// $filename = '/nwfp_shangla.json';
// $url = 'http://census.gov.pk/NWFP/SHANGLA.htm';

// $filename = '/nwfp_swat.json';
// $url = 'http://census.gov.pk/NWFP/SWAT.htm';

// $filename = '/nwfp_upper_dir.json';
// $url = 'http://census.gov.pk/NWFP/LOWER%20DIR.htm';

// $filename = '/nwfp_karak.json';
// $url = 'http://census.gov.pk/NWFP/KARAK.htm';

// $filename = '/punjab_attock.json';
// $url = 'http://census.gov.pk/PUNJAB/ATTOCK.htm';

// $filename = '/punjab_bhakkar.json';
// $url = 'http://census.gov.pk/PUNJAB/BHAKKAR.htm';

// $filename = '/punjab_dera_ghazi_khan.json';
// $url = 'http://census.gov.pk/PUNJAB/DERA%20GHAZI%20KHAN.htm';

// $filename = '/punjab_gujranwala.json';
// $url = 'http://census.gov.pk/PUNJAB/GUJRANWALA.htm';

// $filename = '/punjab_jhang.json';
// $url = 'http://census.gov.pk/PUNJAB/JHANG.htm';

// $filename = '/punjab_kasur.json';
// $url = 'http://census.gov.pk/PUNJAB/KASUR.htm';

// $filename = '/punjab_khushab.json';
// $url = 'http://census.gov.pk/PUNJAB/KHUSHAB.htm';

// $filename = '/punjab_layyah.json';
// $url = 'http://census.gov.pk/PUNJAB/LAYYAH.htm';

// $filename = '/punjab_mandibahauddin.json';
// $url = 'http://census.gov.pk/PUNJAB/MANDI%20BAHAUDDIN.htm';

// $filename = '/punjab_multan.json';
// $url = 'http://census.gov.pk/PUNJAB/MULTAN.htm';

// $filename = '/punjab_narowal.json';
// $url = 'http://census.gov.pk/PUNJAB/NAROWAL.htm';

// $filename = '/punjab_pakpattan.json';
// $url = 'http://census.gov.pk/PUNJAB/PAKPATTAN.htm';

// $filename = '/punjab_rajanpur.json';
// $url = 'http://census.gov.pk/PUNJAB/RAJANPUR.htm';

// $filename = '/punjab_sargodha.json';
// $url = 'http://census.gov.pk/PUNJAB/SARGODHA.htm';

// $filename = '/punjab_sheikhupura.json';
// $url = 'http://census.gov.pk/PUNJAB/SHEIKHUPURA.htm';

// $filename = '/punjab_toba_tek_singh.json';
// $url = 'http://census.gov.pk/PUNJAB/TOBA%20TEK%20SINGH.htm';

// $filename = '/punjab_hafizabad.json';
// $url = 'http://census.gov.pk/PUNJAB/HAFIZABAD.htm';

// $filename = '/punjab_bahawalnagar.json';
// $url = 'http://census.gov.pk/PUNJAB/BAHAWALNAGAR.htm';

// $filename = '/punjab_chakwal.json';
// $url = 'http://census.gov.pk/PUNJAB/CHAKWAL.htm';

// $filename = '/punjab_faisalabad.json';
// $url = 'http://census.gov.pk/PUNJAB/FAISALABAD.htm';

// $filename = '/punjab_gujrat.json';
// $url = 'http://census.gov.pk/PUNJAB/GUJRAT.htm';

// $filename = '/punjab_jhelum.json';
// $url = 'http://census.gov.pk/PUNJAB/JHELUM.htm';

// $filename = '/punjab_khanewal.json';
// $url = 'http://census.gov.pk/PUNJAB/KHANEWAL.htm';

// $filename = '/punjab_lahore.json';
// $url = 'http://census.gov.pk/PUNJAB/LAHORE.htm';

// $filename = '/punjab_lodhran.json';
// $url = 'http://census.gov.pk/PUNJAB/LODHRAN.htm';

// $filename = '/punjab_mianwali.json';
// $url = 'http://census.gov.pk/PUNJAB/MIANWALI.htm';

// $filename = '/punjab_muzaffargarh.json';
// $url = 'http://census.gov.pk/PUNJAB/MUZAFFARGARH.htm';

// $filename = '/punjab_okara.json';
// $url = 'http://census.gov.pk/PUNJAB/OKARA.htm';

// $filename = '/punjab_rahim_yar_khan.json';
// $url = 'http://census.gov.pk/PUNJAB/RAHIM%20YAR%20KHAN.htm';

// $filename = '/punjab_rawalpindi.json';
// $url = 'http://census.gov.pk/PUNJAB/RAWALPINDI.htm';

// $filename = '/punjab_sahiwal.json';
// $url = 'http://census.gov.pk/PUNJAB/SAHIWAL.htm';

// $filename = '/punjab_sialkot.json';
// $url = 'http://census.gov.pk/PUNJAB/SIALKOT.htm';

// $filename = '/punjab_vehari.json';
// $url = 'http://census.gov.pk/PUNJAB/VEHARI.htm';

// $filename = '/punjab_bahawalpur.json';
// $url = 'http://census.gov.pk/PUNJAB/BAHAWALPUR.htm';

// $filename = '/sindh_karachi.json';
// $url = 'http://census.gov.pk/SINDH/KARACHI.htm';

// $filename = '/sindh_dadu.json';
// $url = 'http://census.gov.pk/SINDH/DADU.htm';

// $filename = '/sindh_hyderabad.json';
// $url = 'http://census.gov.pk/SINDH/HYDERABAD.htm';

// $filename = '/sindh_khairpur.json';
// $url = 'http://census.gov.pk/SINDH/KHAIRPUR.htm';

// $filename = '/sindh_mirpur_khas.json';
// $url = 'http://census.gov.pk/SINDH/MIRPUR%20KHAS.htm';

// $filename = '/sindh_nawabshah.json';
// $url = 'http://census.gov.pk/SINDH/NAWABSHAH.htm';

// $filename = '/sindh_shikarpur.json';
// $url = 'http://census.gov.pk/SINDH/SHIKARPUR.htm';

// $filename = '/sindh_tharparkar.json';
// $url = 'http://census.gov.pk/SINDH/THARPARKAR.htm';

// $filename = '/sindh_umarkot.json';
// $url = 'http://census.gov.pk/SINDH/UMARKOT.htm';

// $filename = '/sindh_badin.json';
// $url = 'http://census.gov.pk/SINDH/BADIN.htm';

// $filename = '/sindh_ghotki.json';
// $url = 'http://census.gov.pk/SINDH/GHOTKI.htm';

// $filename = '/sindh_jaccobabad.json';
// $url = 'http://census.gov.pk/SINDH/JACCOBABAD.htm';

// $filename = '/sindh_larkana.json';
// $url = 'http://census.gov.pk/SINDH/LARKANA.htm';

// $filename = '/sindh_naushahro_feroz.json';
// $url = 'http://census.gov.pk/SINDH/NAUSHAHRO%20FEROZ.htm';

// $filename = '/sindh_sanghar.json';
// $url = 'http://census.gov.pk/SINDH/SANGHAR.htm';

// $filename = '/sindh_sukkar.json';
// $url = 'http://census.gov.pk/SINDH/SUKKAR.htm';

// $filename = '/sindh_thatta.json';
// $url = 'http://census.gov.pk/SINDH/THATTA.htm';

// $filename = '/balochistan/zhob.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/ZHOB.htm';

// $filename = '/balochistan/quetta.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/QUETTA.htm';

// $filename = '/balochistan/sibbi.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/SIBBI.htm';

#$filename = '/balochistan/pishan.json';
#$url = 'http://census.gov.pk/BALOCHISTAN/PISHAN.htm';

// $filename = '/balochistan/ziarat.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/ZIARAT.htm';

#$filename = '/balochistan/panjur.json';
#$url = 'http://census.gov.pk/BALOCHISTAN/PANJUR.htm';

// $filename = '/balochistan/nasirabad.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/NASIRABAD.htm';

// $filename = '/balochistan/musakhel.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/MUSAKHEL.htm';

// $filename = '/balochistan/mastung.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/MASTUNG.htm';

// $filename = '/balochistan/loralai.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/LORALI.htm';

// $filename = '/balochistan/lasbela.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/LASBELA.htm';

// $filename = '/balochistan/kohlu.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/KOHLUI.htm';

// $filename = '/balochistan/killa_saifullah.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/KILLA%20SAIFULLAH.htm';

// $filename = '/balochistan/killa_abdullah.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/KILLA%20ABDULLAH.htm';

// $filename = '/balochistan/khuzdar.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/KHUZDAR.htm';

// $filename = '/balochistan/kharan.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/KHARAN.htm';

// $filename = '/balochistan/kech.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/KECH.htm';

// $filename = '/balochistan/kalat.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/KALAT.htm';

#$filename = '/balochistan/jhal_magsi.json';
#$url = 'http://census.gov.pk/BALOCHISTAN/JHAL%20MAGSI.htm';

// $filename = '/balochistan/jaffarabad.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/JAFFARABAD.htm';

// $filename = '/balochistan/gwadar.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/GWADAR.htm';

// $filename = '/balochistan/dera_bugti.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/DERA%20BUGTI.htm';

// $filename = '/balochistan/chagai.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/CHAGAI.htm';

// $filename = '/balochistan/bolan.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/BOLAN.htm';

// $filename = '/balochistan/barkhan.json';
// $url = 'http://census.gov.pk/BALOCHISTAN/BARKHAN.htm';

$filename = '/balochistan/awaran.json';
$url = 'http://census.gov.pk/BALOCHISTAN/AWARAN.htm';

$html = file_get_html($url);

	$i = 0;

	foreach ($html->find('tr') as $dataRows) {
		foreach($dataRows->find('td') as $dataCells)	{
			if ( isset($dataCells->attr['class']) )	{
				if(empty($dataCells->plaintext))
					continue;
				$data[] = $dataCells->plaintext;
			}
		}
	}

	$data = json_encode($data);
	$data = preg_replace('/\\\u00a0/', '', $data);
	$data = preg_replace('/  /', ' ', $data);
	$dataNow = json_decode($data);

	array_unshift($dataNow, 'Title');
	unset($dataNow[40]);

	foreach ($dataNow as $key) {
		$i++;
		if ( $i % 2 )
			$keys[] = trim($key);
		else
			$values[] = trim($key);
	}

	$result = array_combine($keys, $values);
	$result = json_encode($result, JSON_PRETTY_PRINT);

	// file_put_contents(DATAPATH . $filename, $result);
	header('Content-type: application/json');
	echo $result;