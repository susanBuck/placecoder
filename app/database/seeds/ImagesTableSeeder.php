<?php

class ImagesTableSeeder extends Seeder {
	
	public function run() {
		DB::table('breeds')->insert(array(
			array(
				'id' => 1,
				
			)
		));
		
	}
	
}