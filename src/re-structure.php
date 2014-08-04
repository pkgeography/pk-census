<?php

define('DATAPATH', dirname(dirname(__FILE__)) . '/data');

$file = file_get_contents(DATAPATH . '/islamabad.json');

$file = strtolower($file);

$file = str_replace('  ', ' ', $file);

$file = preg_replace('/([a-z]+) ([a-z]+)/', '$1_$2', $file);

$file = preg_replace('/([a-z]+) ([a-z]+)/', '$1_$2', $file);

$file = preg_replace('/([0-9]+) (%)/', '$1$2', $file);

$data = json_decode($file);

echo '<pre>';
print_r($data);
echo '</pre>';

$o = array();

$o['title'] = ucfirst($data->title);
$o['area'] = '';
$o['population'] = '';
$o['administration'] = '';
$o['litracy_ratio'] = '';
$o['growth_rate'] = '';
$o['household'] = '';
$o['housing'] = '';
