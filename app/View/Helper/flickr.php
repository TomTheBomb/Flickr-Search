<?php
/**
 * The purpose of this helper is to assist with the display of images
 * and functionality. 
 * Using the phpFlicker class pager or Pagination component isn't suitable at this stage.
 */
class FlickrHelper extends AppHelper {
  
  /**
   * Builds photos into a nice structured format based off
   * data pulled from the phpFlickr class.
   * @params
   *  array $data - Photo data related to the search term
   * @return
   *  string $photos - HTML format data ready for output
   */
  function buildHtmlPhotos($data) {
    $photos = null;
    foreach ($data as $photo) {
      $image = '<img src="' . $photo['square_image_url'] .'" title="' . $photo['title'] . '" alt="' . $photo['title'] .'" />';
      $photos .= '<div class="image-container"><div class="image">' . '<a href="/view-photo/' . $photo['id'] . '" target="_blank">' . $image . '</a></div></div>';
    }
    return $photos;
  }
  
  /** 
   * Puts together links and a summary of result counts
   * @params
   *  array $pagedata - Information related to the search
   * @return
   *  string - A well formed HTML string containg prev, next links
   *    and page count details
   */
  function buildPagination($pageData) {
    $currentPage = $pageData['current_page'];
    $total = $pageData['total'];
    $perPage = $pageData['showing'];
    $term = $pageData['term'];
    
    $previous = '<a class="previous" href="/' . $term . '/page:' . ($currentPage - 1) . '">Previous</a> ';
    $next = ' <a class="next" href="/' . $term . '/page:' . ($currentPage + 1) . '">Next</a>';

		if ($perPage == 0) {
			$perPage = Configure::read('Flickr.settings.photos_per_page') - 1;
		}

    $middle = '<span>Page <strong>' . $currentPage . '</strong> of ' . ceil($total / $perPage) . '</span>';
    if ($currentPage == 1) {
      return '<div class="page-list">' . $middle .  $next . '</div>'; 
    } 
    elseif ($currentPage == $total) {
      return '<div class="page-list">' . $previous . $middle . '</div>';
    }

    return '<div class="page-list">' . $previous . $middle .  $next . '</div>'; 
  }
}