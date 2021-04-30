<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        // Sur l'accueil: Agence Plaza
        // Sur A propos: A propos - Agence Plaza
        // Sur Demande devis: Demande devis - Agence Plaza
        wp_title('-', true, 'right').bloginfo('name'); ?>
    </title>

    <!-- Ajoute les CSS de WordPress et des plugins -->
    <?php wp_head(); ?>
</head>
<body>
    <!-- <h1>Type de page actuelle: <?php echo get_post_type(); ?></h1> -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-center" href="<?= home_url(); ?>">
                <?php
                    $logoId = get_theme_mod('custom_logo');
                    $logoImg = wp_get_attachment_image_url($logoId, 'full');

                // On affiche le logo s'il existe ou le nom du site
                if ($logoImg) { ?>
                    <img height="75" src="<?= $logoImg; ?>" alt="<?php bloginfo('name'); ?>" />
                <?php } else {
                    bloginfo('name');
                } ?>

                <span class="site-description"><?php bloginfo('description'); ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                // On affiche le menu attaché à l'emplacement 'main-menu'
                wp_nav_menu([
                    'theme_location' => 'main-menu',
                    'depth' => 2, // Profondeur du menu
                    'container' => false, // On supprime la div générée par WP
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'navbarSupportedContent',
                    'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'walker' => new WP_Bootstrap_Navwalker()
                ]);

                // En PHP, une recherche ressemble à ça
                // $result1 = SELECT * FROM product WHERE name LIKE "%iphone%"
                // $result2 = SELECT * FROM smartphone WHERE name LIKE "%iphone%"
                ?>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" name="s" placeholder="Search" value="<?= $_GET['s'] ?? ''; ?>">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
