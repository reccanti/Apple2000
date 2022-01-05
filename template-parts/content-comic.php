<?php 
  $first_link = get_webcomic_url(null, [ "relation" => "first"]);
  $prev_link = get_webcomic_url(null, [ "relation" => "previous"]);
  $next_link = get_webcomic_url(null, [ "relation" => "next"]);
  $last_link = get_webcomic_url(null, [ "relation" => "last"]);
?>

<section class="Box">
  <header class="Header">
    <h2 class="Header-inner">
      <?php printf(get_webcomic_collection_title()); ?>
    </h2>
  </header>
  <div class="Box-inner">
    <div class="Comic">
      <?php printf(get_webcomic_media("full", null, [
        "attr" => [
          "class" => "Comic-image"
        ]
      ])); ?>
      <nav class="Comic-nav ButtonGroup">
        <?php if (!is_first_webcomic()) : ?>
          <a class="button Comic-first" href="<?php echo $first_link; ?>">First</a>
        <?php endif; ?>
        <?php if (!is_previous_webcomic()) : ?>
          <a class="button Comic-prev" href="<?php echo $prev_link; ?>">Previous</a>
        <?php endif; ?>
        <?php if (!is_next_webcomic()) : ?>
          <a class="button Comic-next" href="<?php echo $next_link; ?>">Next</a>
        <?php endif; ?>
        <?php if (!is_last_webcomic()) : ?>
          <a class="button Comic-last" href="<?php echo $last_link; ?>">Last</a>
        <?php endif; ?>
      </nav>
    </div>
    <hr />
    <?php printf(get_the_title()); ?>
    <?php the_content(); ?>
  </div>
</section>