<?php get_header();

/* JE FAIS MON INTEGRATION HTML...

Sur cette page, on va récupèrer l'image à la une de la page.
On affiche cette image sur toute la largeur juste en dessous du menu
avec une hauteur fixe (environ 300px).
Par dessus l'image, on affiche le titre de la page (centré verticalement
et horizontalement). */

?>

</div> <!-- fin du .container -->

<div class="banner">
    <?php
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0] ?? null;

    if ($image) { ?>
        <img class="img-fluid post-thumbnail" src="<?= $image; ?>" alt="<?php the_title(); ?>">
    <?php } ?>

    <h1 class="text-center">
        <?php the_title(); ?>
    </h1>
</div>

<div class="container">
    <?php the_content(); // Le contenu de la page

get_footer(); ?>
