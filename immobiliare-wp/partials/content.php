<div class="my-4">
    <div>
        Dans <?php the_category(', '); ?>
        le <?php echo get_the_date('d F Y à H\hi'); ?>
    </div>
    <h2>
        <?php the_title(); ?>
    </h2>
    <?php
    // On récupère l'image à la une de l'article...
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0] ?? null;

    if ($image) { ?>
        <img class="img-fluid post-thumbnail" src="<?= $image; ?>" alt="<?php the_title(); ?>">
    <?php } ?>
    <?php
        // Solution simple mais moins souple
        // the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
    <p>
        <?php echo get_the_excerpt(); ?>...
    </p>
    <a class="btn btn-primary" href="<?php the_permalink(); ?>">
        Voir l'article
    </a>
</div>

<hr />
