<?php get_header(); ?>

<div class="container">
    <div id="carousel">
        <?php
        // On va récupèrer les 3 derniers articles pour notre carousel
        query_posts('posts_per_page=3'); // Ici, c'est comme un WHERE
        while (have_posts()) : the_post(); ?>
            <div>
                <?php
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0] ?? null;
                ?>
                <img class="img-fluid post-thumbnail" src="<?= $image; ?>" alt="<?php the_title(); ?>">
            </div>
        <?php endwhile; ?>
    </div>

    <?php
    // Annuler la requête précédente et retrouver le contenu de la page d'accueil
    wp_reset_query(); // Toujours le faire après une requête "custom"
    the_content(); ?>
</div>

<?php get_footer(); ?>
