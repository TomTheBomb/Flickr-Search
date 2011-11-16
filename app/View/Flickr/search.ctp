<div id="results">
  <?php if (!empty($results)) : ?>
    <?php if ($results['total'] != 0) :?>
        <div class="message">Search results for: <?php echo $term; ?></div>
          <?php echo $this->Flickr->buildHtmlPhotos($results['photo']); ?>
          <?php 
            $pageRelevant = array(
              'total' => $results['total'],
              'current_page' => $results['page'],
              'showing' => count($results['photo']),
              'term' => $term,
            );
            echo $this->Flickr->buildPagination($pageRelevant);
          ?>
    <?php else: ?>
      <div class="message">No search results for: <?php echo $term; ?></div>
    <?php endif; ?>
  <?php else: ?>
    <div class="message">Please enter a search term.</div>
	<?php endif; ?>
</div>