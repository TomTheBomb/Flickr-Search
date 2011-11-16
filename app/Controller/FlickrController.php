<?php
App::uses('AppController', 'Controller');
/**
 * Flickr Controller
 */
class FlickrController extends AppController {
/**
 * Default helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Session', 'Flickr', 'Paginator');

	function search($term = null) {
    if (!empty($this->data) || !empty($term)) {
      if (!empty($this->data)) {
        $this->Flickr->set($this->data);
        if (!$this->Flickr->validates()) {
          return false;
        }
      }
      $term = !empty($term) ? $term : $this->data['Flickr']['term'];

      $page = $this->Flickr->getPage($this->params);
     
      $results = $this->Flickr->getPhotos($term, 
        Configure::read('Flickr.settings.photos_per_page'),
        $page
      );

      $this->set('results', $results);
      $this->set('term', $term);
    }
  }
  
  function viewPhoto($id = null) {
    if (!empty($id)) {
      $photo = $this->Flickr->getSpecificPhoto($id);
      if ($photo) {
        $this->set('image', $photo);
        return true;
      }
    }
    
    $this->Session->setFlash('A valid photo id should be supplied.');
    return false;
  }
  
}
