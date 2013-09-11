<article<?php print $attributes; ?>>
  <?php print $user_picture; ?>
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>  
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_event_date']);
      hide($content['field_event_category']);
      print render($content['field_event_category']);
      print render($content['field_event_date']);
      ?>
      <h2<?php print $title_attributes; ?>><?php print $title ?></h2>
      <?php

      print render($content);
    ?>
  </div>
  
  <div class="clearfix">


    <?php print render($content['comments']); ?>
  </div>
</article>