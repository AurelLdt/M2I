<?php get_header(); ?>

    <h1>Les annonces <?= single_term_title(); ?></h1>

    <div class="row properties">
        <?php while (have_posts()) : the_post();
            $image = wp_get_attachment_image_src(
                get_post_thumbnail_id($post->ID), 'large'
            )[0] ?? null; ?>

            <div class="col-lg-3 col-md-6 col-12">
                <img
                    class="card-img-top"
                    src="<?= $image; ?>"
                    alt="<?php the_title(); ?>"
                >
                <div class="card shadow">
                    <div class="card-body">
                        <span class="badge bg-success">
                            <?php the_terms($post->ID, 'property-type'); ?>
                        </span>
                        <span class="features">
                            <?= get_post_meta($post->ID, 'Lits', false)[0] ?? 0; ?> BEDS
                            -
                            <?= get_post_meta($post->ID, 'SDB', false)[0] ?? 0; ?> BATHS
                        </span>
                        <h5 class="card-title mt-2"><?php the_title(); ?></h5>
                        <p class="my-2">$
                            <!-- 1500 devient en 1,500.00 -->
                            <?= number_format(get_post_meta($post->ID, 'Prix', false)[0], 2); ?>
                        /wk</p>
                        <?php
                        $note = get_post_meta($post->ID, 'Note', true); // 3, 4 ou 5 ou ''
                        for ($i = 0; $i < 5; $i++) { ?>
                            <span class="star <?= ($i >= $note) ?: 'green'; ?>">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path>
                                </svg>
                            </span>
                        <?php } ?>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    </div>

<?php get_footer(); ?>
