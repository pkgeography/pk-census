<?php

/**
 * Combine all census data
 * 
 * Use this file is recommended to automatically combine all census
 * data in `/data` directory.
 * 
 * In case any data is updated in `/data` directory, it is best
 * to run this file to output a updated combined data and then save 
 * that into `/data/census-data-combined.json`.
 * 
 * This file will automatically exclude the directories and empty files.
 * 
 * @author: Jabran Rafique <hello@jabran.me>
 * @license: MIT License
 *
 *	The MIT License (MIT)
 *
 * Copyright (c) 2014 Jabran Rafique <hello@jabran.me>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */


define('DIRPATH', dirname(__DIR__) . '/data');

$data = array();

$dirs = array(
	DIRPATH,
	DIRPATH . '/balochistan',
	DIRPATH . '/nwfp',
	DIRPATH . '/punjab',
	DIRPATH . '/sindh'
);

foreach ($dirs as $dir) {
	$in_dir = scandir($dir);

	foreach ($in_dir as $dor) {

		// Exclude census-data-combined.json data
		if ( $dor === 'census-data-combined.json' ) continue;

		if ( strpos($dor, '.json') && filesize($dir . '/' . $dor) !== 0 ) {
			$data[] = json_decode(file_get_contents($dir . '/' . $dor), true);
		}
	}
}

header('Content-type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);