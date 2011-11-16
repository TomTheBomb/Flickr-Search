<?php
/**
 * phpUnit Test to ensure Flickr Helper functions return correct data
 * @todo - Prefill data to return positive results
 */
App::uses('FlickrHelper', 'Helper');
App::uses('View', 'View');

class FlickrHelperTest extends CakeTestCase {

  public function setUp() {
    parent::setUp();
    $view = new View();
		debug($view);
		exit;
    $this->Flickr = new FlickrHelper($view);
  }

  public function testBuildHtmlPhotos() {
    $images[] = array(
      'square_image_url' => 'http://farm7.static.flickr.com/6111/6349353462_69a9c55f6b_s.jpg',
      'large_image_url' => 'http://farm7.static.flickr.com/6111/6349353462_69a9c55f6b_b.jpg',
      'title' => 'Its coming back....',
      'id' => '6349353462',
    );

    $images[] = array(
      'square_image_url' => 'http://farm7.static.flickr.com/6056/6349355254_134801296d_s.jpg',
      'large_image_url' => 'http://farm7.static.flickr.com/6056/6349355254_134801296d_b.jpg',
      'title' => 'photo.JPG',
      'id' => '6349355254',
    );

    $result = $this->Flickr->buildHtmlPhotos($images);
    $this->assertContains('<img src=', $result); //Check to see if an image exists
    $this->assertContains('<div class="image-container"><div class="image">', $result); //Ensure the structure matches CSS/HTML
  }

  public function testBuildPagination() {
    $data = array(
      'current_page' => '4',
      'total' => '10',
      'showing' => '70',
      'id' => '2424',
    );
  
    $result = $this->Flickr->buildPagination($data);
    $this->assertContains('Page of', $result);
    $this->assertContains('Previous', $result);
    $this->assertContains('Next', $result);
  }

}
