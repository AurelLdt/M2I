<?php get_header(); ?>

    <h1><?php single_cat_title(); ?></h1>

    <?php if (have_posts()) : // On vérifie s'il y a des articles
        while (have_posts()) : the_post(); // On parcours chaque article
            // Comme un require mais spécifique à WordPress
            get_template_part('partials/content'); // content.php
        endwhile;
    endif; ?>

<?php get_footer(); ?>
