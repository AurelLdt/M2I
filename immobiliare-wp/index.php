<?php get_header(); ?>

    <?php
    // Si on est sur une catégorie, on affiche son titre
    if (is_category()) : ?>
        <h1><?php single_cat_title(); ?></h1>
    <?php endif; ?>

    <?php if (have_posts()) : // On vérifie s'il y a des articles
        while (have_posts()) : the_post(); // On parcours chaque article
            get_template_part('partials/content');
        endwhile;
    endif; ?>

<?php get_footer(); ?>
