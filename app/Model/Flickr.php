<?php
App::uses('AppModel', 'Model');
/**
 * Flickr Model
 */
class Flickr extends AppModel {
	public $name = 'Flickr';
	public $useTable = false;
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'term' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a tag to search for.',
				'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
  
  /**
   * Grabs photos based off a search term/s using he
   * phpFlickr class.
   *
   * @params
   *  string $term - The item/s to search for
   *  int $limit - The amount of items per page
   *  int $page - The page number to display (handy for custom queries)
   */
  function getPhotos($term, $limit = 10, $page = 1) {
    App::import('Vendor', 'phpFlickr/phpFlickr');
    $flickr =& new phpFlickr(Configure::read('Flickr.settings.key'));
    $results = $flickr->photos_search(
      array('tags' => $term, 'tag_mode' => 'any', 'per_page' => $limit, 'page' => $page)
    );

		foreach ($results['photo'] as $key => $result) {
			$results['photo'][$key]['square_image_url'] = $flickr->buildPhotoURL($result, 'square');
      $results['photo'][$key]['large_image_url'] = $flickr->buildPhotoURL($result, 'large');
		}

		return $results;
  }
  /**
   * Builds a url to a specific sized image based off the photo_id
   * @params
   *  string $id - The photo Id
   * @return
   *  array $photo - Includes information related to the image
   */
  function getSpecificPhoto($id) {
    App::import('Vendor', 'phpFlickr/phpFlickr');
    $flickr =& new phpFlickr(Configure::read('Flickr.settings.key'));
    return $flickr->photos_getSizes($id);
  }
  
  /**
   * Grabs the page number to be used in combination with $this->getPhotos()
   *
   * @params
   *  array - $this->params;
   * @return
   *  int - The page number currently being looked at
   */
  function getPage($params) {
    if (isset($params['named']['page'])) {
      return is_array($params['named']['page']) ? $params['named']['page'][0] : $params['named']['page']; //Ensure we only send one result
    }
    return 1;
  }
}
