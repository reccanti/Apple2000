<?php 

  // create links
  $first_link = get_webcomic_url(null, [ "relation" => "first"]);
  $prev_link  = get_webcomic_url(null, [ "relation" => "previous"]);
  $next_link  = get_webcomic_url(null, [ "relation" => "next"]);
  $last_link  = get_webcomic_url(null, [ "relation" => "last"]);

  // create icons  
  $first_icon = file_get_contents(get_template_directory() . '/css/img/icons/DoubleArrowBack.svg');
  $prev_icon  = file_get_contents(get_template_directory() . '/css/img/icons/ArrowBack.svg');
  $next_icon  = file_get_contents(get_template_directory() . '/css/img/icons/ArrowForward.svg');
  $last_icon  = file_get_contents(get_template_directory() . '/css/img/icons/DoubleArrowForward.svg');

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
          <a class="button Comic-first" href="<?php echo $first_link; ?>">
            <span class="Icon">
              <?php echo $first_icon ?>
            </span>
          </a>
        <?php endif; ?>
        <?php if (!is_previous_webcomic()) : ?>
          <a class="button Comic-prev" href="<?php echo $prev_link; ?>">
            <span class="Icon">
              <?php echo $prev_icon ?>
            </span>
          </a>
        <?php endif; ?>
        <?php if (!is_next_webcomic()) : ?>
          <a class="button Comic-next" href="<?php echo $next_link; ?>">
            <span class="Icon">
              <?php echo $next_icon ?>
            </span>
          </a>
        <?php endif; ?>
        <?php if (!is_last_webcomic()) : ?>
          <a class="button Comic-last" href="<?php echo $last_link; ?>">
            <span class="Icon">
              <?php echo $last_icon ?>
            </span>
          </a>
        <?php endif; ?>
      </nav>
    </div>
    <hr />
    <h3><?php printf(get_the_title()); ?></h3>
    <?php the_content(); ?>
  </div>
</section>