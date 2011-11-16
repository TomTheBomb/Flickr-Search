<div class="logo">
  <h1><a href="/">Flickr Search</a></h1>
</div>
   
<div id="search">
   <?php 
    echo $this->Form->create('Flickr', array('url' => '/'));
    echo $this->Form->text('term');
    echo $this->Form->button('Search', array('type'=> 'submit'));
    echo $this->Form->end();
  ?>
</div>