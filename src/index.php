<?php

/**
 * Fetch the census data for 2008 from Pakistan Government Census website
 * and export it as JSON formated text files
 * @version: 1.0
 * @author: hello@jabran.me
 * @package: Free Public Data (Pakistan)
 *
 */

require('simple_html_dom.php');


#$filename = 'nwfp_lower_dir.json';
#$url = 'http://www.census.gov.pk/NWFP/DIR.htm';

#$filename = 'nwfp_bannu.json';
#$url = 'http://www.census.gov.pk/NWFP/BANNU.htm';

#$filename = 'nwfp_buner.json';
#$url = 'http://www.census.gov.pk/NWFP/BUNER.htm';

#$filename = 'nwfp_chitral.json';
#$url = 'http://www.census.gov.pk/NWFP/CHITRAL.htm';

#$filename = 'nwfp_hangu.json';
#$url = 'http://www.census.gov.pk/NWFP/HANGU.htm';

#$filename = 'nwfp_abbottabad.json';
#$url = 'http://www.census.gov.pk/NWFP/ABBOTTABAD.htm';

#$filename = 'nwfp_charsadda.json';
#$url = 'http://www.census.gov.pk/NWFP/CHARSADDA.htm';

#$filename = 'nwfp_haripur.json';
#$url = 'http://www.census.gov.pk/NWFP/HARIPUR.htm';

#$filename = 'nwfp_kohat.json';
#$url = 'http://www.census.gov.pk/NWFP/KOHAT.htm';

#$filename = 'nwfp_kohistan.json';
#$url = 'http://www.census.gov.pk/NWFP/KOHISTAN.htm';

#$filename = 'nwfp_malakand.json';
#$url = 'http://www.census.gov.pk/NWFP/MALAKAND.htm';

#$filename = 'nwfp_mardan.json';
#$url = 'http://www.census.gov.pk/NWFP/MARDAN.htm';

#$filename = 'nwfp_pehsaware.json';
#$url = 'http://www.census.gov.pk/NWFP/PESHAWARE.htm';

#$filename = 'nwfp_swabi.json';
#$url = 'http://www.census.gov.pk/NWFP/SWABI.htm';

#$filename = 'nwfp_tank.json';
#$url = 'http://www.census.gov.pk/NWFP/TANK.htm';

#$filename = 'nwfp_batagram.json';
#$url = 'http://www.census.gov.pk/NWFP/BATAGRAM.htm';

#$filename = 'nwfp_dera_ismail_khan.json';
#$url = 'http://www.census.gov.pk/NWFP/DERA%20ISMAIL%20KHAN.htm';

#$filename = 'nwfp_marwat.json';
#$url = 'http://www.census.gov.pk/NWFP/LAKKI%20MARWAT.htm';

##$filename = 'nwfp_mansehra.json';
##$url = 'http://www.census.gov.pk/NWFP/MANSEHRA.htm';

#$filename = 'nwfp_nowshera.json';
#$url = 'http://www.census.gov.pk/NWFP/NOWSHERA.htm';

#$filename = 'nwfp_shangla.json';
#$url = 'http://www.census.gov.pk/NWFP/SHANGLA.htm';

##$filename = 'nwfp_swat.json';
##$url = 'http://www.census.gov.pk/NWFP/SWAT.htm';

#$filename = 'nwfp_upper_dir.json';
#$url = 'http://www.census.gov.pk/NWFP/LOWER%20DIR.htm';

#$filename = 'nwfp_karak.json';
#$url = 'http://www.census.gov.pk/NWFP/KARAK.htm';

#$filename = 'punjab_attock.json';
#$url = 'http://www.census.gov.pk/PUNJAB/ATTOCK.htm';

#$filename = 'punjab_bhakkar.json';
#$url = 'http://www.census.gov.pk/PUNJAB/BHAKKAR.htm';

$filename = 'punjab_dera ghazi khan.json';
$url = 'http://www.census.gov.pk/PUNJAB/DERA GHAZI KHAN.htm';

#$filename = 'punjab_gujranwala.json';
#$url = 'http://www.census.gov.pk/PUNJAB/GUJRANWALA.htm';

#$filename = 'punjab_jhang.json';
#$url = 'http://www.census.gov.pk/PUNJAB/JHANG.htm';

#$filename = 'punjab_kasur.json';
#$url = 'http://www.census.gov.pk/PUNJAB/KASUR.htm';

#$filename = 'punjab_khushab.json';
#$url = 'http://www.census.gov.pk/PUNJAB/KHUSHAB.htm';

#$filename = 'punjab_layyah.json';
#$url = 'http://www.census.gov.pk/PUNJAB/LAYYAH.htm';

#$filename = 'punjab_mandibahauddin.json';
#$url = 'http://www.census.gov.pk/PUNJAB/MANDI BAHAUDDIN.htm';

#$filename = 'punjab_multan.json';
#$url = 'http://www.census.gov.pk/PUNJAB/MULTAN.htm';

#$filename = 'punjab_narowal.json';
#$url = 'http://www.census.gov.pk/PUNJAB/NAROWAL.htm';

#$filename = 'punjab_pakpattan.json';
#$url = 'http://www.census.gov.pk/PUNJAB/PAKPATTAN.htm';

#$filename = 'punjab_rajanpur.json';
#$url = 'http://www.census.gov.pk/PUNJAB/RAJANPUR.htm';

#$filename = 'punjab_sargodha.json';
#$url = 'http://www.census.gov.pk/PUNJAB/SARGODHA.htm';

#$filename = 'punjab_sheikhupura.json';
#$url = 'http://www.census.gov.pk/PUNJAB/SHEIKHUPURA.htm';

#$filename = 'punjab_toba tek singh.json';
#$url = 'http://www.census.gov.pk/PUNJAB/TOBA TEK SINGH.htm';

#$filename = 'punjab_hafizabad.json';
#$url = 'http://www.census.gov.pk/PUNJAB/HAFIZABAD.htm';

#$filename = 'punjab_bahawalnagar.json';
#$url = 'http://www.census.gov.pk/PUNJAB/BAHAWALNAGAR.htm';

#$filename = 'punjab_chakwal.json';
#$url = 'http://www.census.gov.pk/PUNJAB/CHAKWAL.htm';

#$filename = 'punjab_faisalabad.json';
#$url = 'http://www.census.gov.pk/PUNJAB/FAISALABAD.htm';

#$filename = 'punjab_gujrat.json';
#$url = 'http://www.census.gov.pk/PUNJAB/GUJRAT.htm';

#$filename = 'punjab_jhelum.json';
#$url = 'http://www.census.gov.pk/PUNJAB/JHELUM.htm';

#$filename = 'punjab_khanewal.json';
#$url = 'http://www.census.gov.pk/PUNJAB/KHANEWAL.htm';

#$filename = 'punjab_lahore.json';
#$url = 'http://www.census.gov.pk/PUNJAB/LAHORE.htm';

#$filename = 'punjab_lodhran.json';
#$url = 'http://www.census.gov.pk/PUNJAB/LODHRAN.htm';

#$filename = 'punjab_mianwali.json';
#$url = 'http://www.census.gov.pk/PUNJAB/MIANWALI.htm';

#$filename = 'punjab_muzaffargarh.json';
#$url = 'http://www.census.gov.pk/PUNJAB/MUZAFFARGARH.htm';

#$filename = 'punjab_okara.json';
#$url = 'http://www.census.gov.pk/PUNJAB/OKARA.htm';

#$filename = 'punjab_rahim yar khan.json';
#$url = 'http://www.census.gov.pk/PUNJAB/RAHIM YAR KHAN.htm';

#$filename = 'punjab_rawalpindi.json';
#$url = 'http://www.census.gov.pk/PUNJAB/RAWALPINDI.htm';

#$filename = 'punjab_sahiwal.json';
#$url = 'http://www.census.gov.pk/PUNJAB/SAHIWAL.htm';

#$filename = 'punjab_sialkot.json';
#$url = 'http://www.census.gov.pk/PUNJAB/SIALKOT.htm';

#$filename = 'punjab_vehari.json';
#$url = 'http://www.census.gov.pk/PUNJAB/VEHARI.htm';

#$filename = 'punjab_bahawalpur.json';
#$url = 'http://www.census.gov.pk/PUNJAB/BAHAWALPUR.htm';

#$filename = 'sindh_karachi.json';
#$url = 'http://www.census.gov.pk/SINDH/KARACHI.htm';

#$filename = 'sindh_dadu.json';
#$url = 'http://www.census.gov.pk/SINDH/DADU.htm';

#$filename = 'sindh_hyderabad.json';
#$url = 'http://www.census.gov.pk/SINDH/HYDERABAD.htm';

#$filename = 'sindh_khairpur.json';
#$url = 'http://www.census.gov.pk/SINDH/KHAIRPUR.htm';

#$filename = 'sindh_mirpur khas.json';
#$url = 'http://www.census.gov.pk/SINDH/MIRPUR KHAS.htm';

#$filename = 'sindh_nawabshah.json';
#$url = 'http://www.census.gov.pk/SINDH/NAWABSHAH.htm';

#$filename = 'sindh_shikarpur.json';
#$url = 'http://www.census.gov.pk/SINDH/SHIKARPUR.htm';

#$filename = 'sindh_tharparkar.json';
#$url = 'http://www.census.gov.pk/SINDH/THARPARKAR.htm';

#$filename = 'sindh_umarkot.json';
#$url = 'http://www.census.gov.pk/SINDH/UMARKOT.htm';

#$filename = 'sindh_badin.json';
#$url = 'http://www.census.gov.pk/SINDH/BADIN.htm';

#$filename = 'sindh_ghotki.json';
#$url = 'http://www.census.gov.pk/SINDH/GHOTKI.htm';

#$filename = 'sindh_jaccobabad.json';
#$url = 'http://www.census.gov.pk/SINDH/JACCOBABAD.htm';

#$filename = 'sindh_larkana.json';
#$url = 'http://www.census.gov.pk/SINDH/LARKANA.htm';

#$filename = 'sindh_naushahro feroz.json';
#$url = 'http://www.census.gov.pk/SINDH/NAUSHAHRO FEROZ.htm';

#$filename = 'sindh_sanghar.json';
#$url = 'http://www.census.gov.pk/SINDH/SANGHAR.htm';

#$filename = 'sindh_sukkar.json';
#$url = 'http://www.census.gov.pk/SINDH/SUKKAR.htm';

#$filename = 'sindh_thatta.json';
#$url = 'http://www.census.gov.pk/SINDH/THATTA.htm';

#$filename = 'balochistan_zhob.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/ZHOB.htm';

#$filename = 'balochistan_quetta.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/QUETTA.htm';

#$filename = 'balochistan_sibbi.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/SIBBI.htm';

#$filename = 'balochistan_pishan.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/PISHAN.htm';

#$filename = 'balochistan_ziarat.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/ZIARAT.htm';

#$filename = 'balochistan_panjur.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/PANJUR.htm';

#$filename = 'balochistan_nasirabad.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/NASIRABAD.htm';

#$filename = 'balochistan_musakhel.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/MUSAKHEL.htm';

#$filename = 'balochistan_mastung.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/MASTUNG.htm';

#$filename = 'balochistan_lorali.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/LORALI.htm';

#$filename = 'balochistan_lasbela.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/LASBELA.htm';

#$filename = 'balochistan_kohlui.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/KOHLUI.htm';

#$filename = 'balochistan_killa saifullah.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/KILLA SAIFULLAH.htm';

#$filename = 'balochistan_killa abdullah.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/KILLA ABDULLAH.htm';

#$filename = 'balochistan_khuzdar.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/KHUZDAR.htm';

#$filename = 'balochistan_kharan.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/KHARAN.htm';

#$filename = 'balochistan_kech.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/KECH.htm';

#$filename = 'balochistan_kalat.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/KALAT.htm';

#$filename = 'balochistan_jhal magsi.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/JHAL MAGSI.htm';

#$filename = 'balochistan_jaffarabad.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/JAFFARABAD.htm';

#$filename = 'balochistan_gwadar.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/GWADAR.htm';

#$filename = 'balochistan_dera bugti.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/DERA BUGTI.htm';

#$filename = 'balochistan_chagai.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/CHAGAI.htm';

#$filename = 'balochistan_bolan.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/BOLAN.htm';

#$filename = 'balochistan_barkha.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/BARKHAN.htm';

#$filename = 'balochistan_awara.json';
#$url = 'http://www.census.gov.pk/BALOCHISTAN/AWARAN.htm';

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
			$keys[] = $key;
		else
			$values[] = $key;
	}

	$result = array_combine($keys, $values);
	$result = json_encode($result);

	header('Content-type: application/json');
	file_put_contents($filename, $result);
	echo $result;
