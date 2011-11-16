<div id="viewer">
<?php if (isset($image)) : ?>
  <div class="image-container">
    <div class="image">
      <a href="<?php echo $image[count($image) - 1]['source']; ?>">
        <img src="<?php echo $image[count($image) - 2]['source']; ?>" alt="Large Image" title="Large Image"/> 
      </a>
    </div>
  </div>
<?php endif; ?>
</div>
