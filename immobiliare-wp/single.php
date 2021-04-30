<?php get_header(); ?>

<div>
    <div>
        Dans <?php the_category(', '); ?>
        le <?php echo get_the_date('d F Y à H\hi'); ?>
    </div>
    <h1>
        <?php the_title(); ?>
    </h1>
    <div>
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>
