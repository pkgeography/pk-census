<?php

define('DATAPATH', dirname(dirname(__FILE__)) . '/data');

$filename = DATAPATH . '/sindh/unknown.json';

$file = file_get_contents($filename);

$file = strtolower($file);

$file = str_replace('  ', ' ', $file);

$file = str_replace('-', '_', $file);

$file = preg_replace('/([a-z]+) ([a-z]+)/', '$1_$2', $file);

$file = preg_replace('/([a-z]+) ([a-z]+)/', '$1_$2', $file);

$file = preg_replace('/([0-9]+) (%)/', '$1$2', $file);

$file = str_replace(' (males_per 100 females)', '', $file);

$file = str_replace(' (10 +)', '', $file);

$file = str_replace('sub_divisions', 'tehsils', $file);

$file = str_replace('cda', 'town_committees', $file);

$file = preg_replace('/(rate) \(([0-9]+) [-_] ([0-9]+)\)/', '$1', $file);

$data = json_decode($file);

// echo '<pre>'; print_r($data); echo '</pre>'; return;

$o = array();

$title = substr($data->title, 0, strpos($data->title, '_at_'));
$title = implode(' ', explode('_', $title));

$o['title'] = ucwords($title);

$o['area']['value'] = floatval($data->area);
$o['area']['unit_long'] = 'square kilometers';
$o['area']['unit_short'] = 'Sq. Kms';

$population = (array) $data->population;

foreach ($population as $key => $value) {
	$o['population']['year'][$key] = intval($value);
}

$o['population']['gender']['male']['percentage'] = floatval($data->male);
$o['population']['gender']['female']['percentage'] = floatval($data->female);

$o['population']['ratio']['type'] = 'males per 100 females';
$o['population']['ratio']['value'] = floatval($data->sex_ratio);

$o['population']['density']['value'] = floatval($data->population_density);
$o['population']['density']['unit_long'] = 'per square kilometers';
$o['population']['density']['unit_short'] = 'per Sq. Kms';

$urban_pop = preg_match('/[0-9]+/', $data->urban_population, $urban_pop_match);
$urban_per = preg_match('/\(([0-9\.]+)%\)/', $data->urban_population, $urban_per_match);

$o['population']['urban']['percentage'] = floatval($urban_per_match[1]);
$o['population']['urban']['value'] = intval($urban_pop_match[0]);

$rural_pop = preg_match('/[0-9]+/', $data->rural_population, $rural_pop_match);
$rural_per = preg_match('/\(([0-9\.]+)%\)/', $data->rural_population, $rural_per_match);

$o['population']['rural']['percentage'] = floatval($rural_per_match[1]);
$o['population']['rural']['value'] = intval($rural_pop_match[0]);

if (property_exists($data, 'union_councils'))
	$o['administration']['union_councils'] = intval($data->union_councils);

if (property_exists($data, 'town_committees'))
	$o['administration']['town_committees'] = intval($data->town_committees);

if (property_exists($data, 'municipal_committees'))
	$o['administration']['municipal_committees'] = intval($data->municipal_committees);

if (property_exists($data, 'cantonment'))
	$o['administration']['cantonment'] = intval($data->cantonment);

if (property_exists($data, 'tehsils'))
	$o['administration']['tehsils'] = intval($data->tehsils);

$o['administration']['mauzas'] = intval($data->mauzas);

$o['litracy_ratio']['age'] = '10+';
$o['litracy_ratio']['percentage'] = floatval($data->literacy_ratio);

$o['growth_rate']['type'] = 'average';
$o['growth_rate']['percentage'] = floatval($data->average_annual_growth_rate);
$o['growth_rate']['year']['from'] = 1981;
$o['growth_rate']['year']['to'] = 1998;

$o['household']['type'] = 'average';
$o['household']['size'] = floatval($data->average_household_size);

$o['housing']['units']['total'] = intval($data->total_housing_units);

$pacca_val = preg_match('/([0-9]+) ?\(/', $data->pacca_housing_units, $pacca_val_match);
$pacca_per = preg_match('/\(([0-9\.]+)%\)/', $data->pacca_housing_units, $pacca_per_match);

$o['housing']['units']['pacca']['value'] = intval($pacca_val_match[1]);
$o['housing']['units']['pacca']['percentage'] = floatval($pacca_per_match[1]);

$electric_val = preg_match('/([0-9]+) ?\(/', $data->housing_units_having_electricity, $electric_val_match);
$electric_per = preg_match('/\(([0-9\.]+)%\)/', $data->housing_units_having_electricity, $electric_per_match);

$o['housing']['have_utilities']['electricity']['value'] = intval($electric_val_match[1]);
$o['housing']['have_utilities']['electricity']['percentage'] = floatval($electric_per_match[1]);

$water_val = preg_match('/([0-9]+) ?\(/', $data->housing_units_having_piped_water, $water_val_match);
$water_per = preg_match('/\(([0-9\.]+)%\)/', $data->housing_units_having_piped_water, $water_per_match);

$o['housing']['have_utilities']['water']['type'] = 'piped';
$o['housing']['have_utilities']['water']['value'] = intval($water_val_match[1]);
$o['housing']['have_utilities']['water']['percentage'] = floatval($water_per_match[1]);

$gas_val = preg_match('/([0-9]+) ?\(/', $data->housing_units_using_gas_for_cooking, $gas_val_match);
$gas_per = preg_match('/\(([0-9\.]+)%\)/', $data->housing_units_using_gas_for_cooking, $gas_per_match);

$o['housing']['have_utilities']['gas']['value'] = intval($gas_val_match[1]);
$o['housing']['have_utilities']['gas']['percentage'] = floatval($gas_per_match[1]);

header('Content-Type: application/json');

file_put_contents($filename, json_encode($o, JSON_PRETTY_PRINT));

// echo file_get_contents($filename);
echo json_encode($o, JSON_PRETTY_PRINT);