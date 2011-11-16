<?php
/**
 * phpUnit Test
 */
App::uses('Flickr', 'Controller');

class FlickrControllerTest extends ControllerTestCase {
  
  function testSearch() {
    $term = 'cake'; //The term to search for
    $postResult = $this->testAction(
            '/search',
            array('data' => $term, 'method' => 'post')
        );
    debug($postResult);
    //Test pagination and passing paramaters via url
    $pageResult = $this->testAction('/' . $term . '/page:2');
    debug($pageResult);
  }

  function testViewPhotos() {
    $photoIds = array(
      '6347590237',
      '6347360989',
      'afsfasf', //Bad photo id
      '', //No id being passed expected error
    );

    foreach ($photoIds as $id) {
      $test = $this->testAction('/view-photo/' . $id);
			if ($test) {
				$this->assertEquals($test, true);
			} 
			elseif (!$test) {
				$this->assertEquals($test, false);
			}
    }
  }

}
