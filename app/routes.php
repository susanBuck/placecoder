<?php

/*
Cases:

Image too big
Image too small


Navigate into /sites/placecoder
Run this command to start the server: php artisan server

*/



/*-------------------------------------------------------------------------------------------------
# https://github.com/masterexploder/PHPThumb/wiki/Basic-Usage

0 600x471 = 1.127   Holding Chips Ahoy
1 587x800 = .73375  Looking to the left
2 480/320 = 1.5     Hand on desk
3 600/230 = 2.6086  Hand up

-------------------------------------------------------------------------------------------------*/
Route::get('/{w}/{h}', function($w, $h) {

	$debug = 1;

	$s3     = 'http://placegrace.s3.amazonaws.com/';
	
	$ratio  = abs($w/$h);
	
	$images = Array(1.127,.73375,1.5,2.6086);
		
	sort($images);
	
	$closest     = abs($ratio - $images[0]);
	$closest_key = 0;
	
	echo "Closest to start:".$closest."[".$closest_key."]<br>";
	
	foreach($images as $k => $r) {
		
		$difference = abs($ratio - $r);
		
		if($debug) {
			echo "Difference:".$difference."<br>";	
		}
		
		
		if($difference < $closest) {
			$closest     = $r;
			$closest_key = $k;
			
			echo "Update clsosest:".$closest."[".$k."]<br>";
		}
	}
	
	
	if($debug) {
		echo "size:".$w.'x'.$h.'<br>';
		echo "ratio:".$ratio."<br>";
		krumo($images);
		
		echo "Closest:".$closest.'['.$closest_key.']';
	}

	$image = array_pull($images,$closest_key);

	if(!$debug) {
		
		$options['resizeUp'] = true;
		$thumb = new PHPThumb\GD($s3.'grace-hopper-'.$closest_key.'.png', $options);
		//$thumb->resize($w,$h);
		$thumb->adaptiveResize($w,$h);
		$thumb->show();
	}

})->where(array('w' => '[0-9]+', 'h' => '[0-9]+'));


/*-------------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------------*/
Route::get('/', function() {

	$words = [
		'mind your nanoseconds', 
		'Life was simple before World War II',
		'ask for forgiveness',
		'Mark I',
		'Amazing Grace',
		'pioneer',
		'picoseconds',
		'octal digits',
		'51 feet long, 8 feet high, 8 feet deep',
		'Mark II',
		'Mark III',
		'badass',
		'I seem to do a lot of retiring',
		'retired from the Navy for the first time',
		'40 years in computing',
		'power of the brain',
		'debugging',
		'moth',
		'72 Words of Storage',
		'three aditions a second',
		'After that, we had systems.',
		'UNIVAC I',
		'operational compiler',
		'progenitor',
		'COBOL',
		'Naval Data Automation Command',
		'admiral',
		'We shouldn\'t be trying for bigger computers',
		'counter-clockwise',
		'We need to feed it through a processor',
		'A human must turn information into intelligence',
		'no computer will ever ask a new question',
		'anybody half my age',
		'You manage things, you lead people',
		'ran the MBAs out of Washington.',
		'Navy',
		'doctorate in Mathematics',
		'Yale',
		'Harvard',
		'get permission',
		'programming is',
		'we said it had bugs in it.',
		'cut off a nanosecond and send it over to me.',
		'running compiler',
		'computers could only do arithmetic',
		'they could not do programs.',
		'humans are allergic to change',
		
		];

	shuffle($words);
	
	$words = implode(' ',$words);
	$words = ucfirst($words);

	return View::make('index')
		->with('words', $words);
});