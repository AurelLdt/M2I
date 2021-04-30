<?php get_header(); ?>

    <h1>Mes projets</h1>

    <div class="row projects">
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                    <?php $image = wp_get_attachment_image_src(
                        get_post_thumbnail_id($post->ID), 'large'
                    )[0] ?? null; ?>
                    <img
                        class="card-img-top"
                        src="<?= $image; ?>"
                        alt="<?php the_title(); ?>"
                    >
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php the_title(); ?></h5>
                        <p class="mb-0">
                            Nom du client: <?= get_post_meta($post->ID, 'Nom du client', true); ?>
                        </p>
                        <p class="mb-0">
                            Type de projet: <?= get_post_meta($post->ID, 'Type de projet', true); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php get_footer(); ?>
