<?php

App::uses('Flickr', 'Model');

class FlickrTestCase extends CakeTestCase {
    //overwrite configure::reads to cause erorrs
    public function setup() {
       parent::setUp();
       $this->Flickr = ClassRegistry::init('Flickr');
    }

    function testGetPhotos() {
			$result = $this->Flickr->getPhotos('test', 3, 2);
			//Alter the result as the array changes due to people adding photos on a regular basis
			$newResult = array(
				'page' => $result['page'],
				'photo_count' => count($result['photo']),
			);
			
			$expected = array(
				'page' => 2, //Page 2 was set as a paramter
				'photo_count' => 3, // Max photos of 3 sent as paramter
			);
				
			$this->assertEquals($newResult, $expected);
    }

    function testGetSpecificPhoto() {
			$result = $this->Flickr->GetSpecificPhoto('6349353462'); //Photo Id
			$expected[] = array(
				'label' => 'Square',
				'width' => 75,
				'height' => 75,
				'source' => 'http://farm7.static.flickr.com/6111/6349353462_69a9c55f6b_s.jpg',
				'url' => 'http://www.flickr.com/photos/44967227@N06/6349353462/sizes/sq/',
				'media' => 'photo',
			);
			
			
			$this->assertEquals($result[0], $expected); //Less testing
    }

    function testGetPage() {
			$data['named']['page'][] = 3; //We should be getting this number as it's the first in the array
			//Add extra keys for testing
			$data['named']['page'][] = 32;
			$data['named']['page'][] = 6;
			$result = $this->Flickr->getPage($data);
			$expected = 3;
			
			$this->assertEquals($result, $expected);
    }
}

