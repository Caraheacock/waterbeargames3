<?php get_header(); ?>
<section>
    <div class="pz-row">
        <div class="column xs-12<?php if (is_active_sidebar('main-sidebar')) echo ' lg-8'; ?>">
            <div class="col-inner">
                <?php if (have_posts()) : ?>
                    <h2><?php _e('Tag:', 'water-bear-games'); ?> <?php single_tag_title(); ?></h2>
                    <h4><?php echo pluralize($wp_query->found_posts, 'post'); ?> <?php _e('tagged as', 'water-bear-games'); ?> &quot;<?php echo single_tag_title(); ?>&quot;</h4>
                    <?php
                    while (have_posts()) {
                        the_post();
                        get_template_part('theme/loops/loop');
                    }
                
                    get_template_part('theme/partials/pagination');
                    ?>
                <?php else : ?>
                    <h2><?php _e('No results', 'water-bear-games'); ?></h2>
                    <p><?php _e('Sorry, no posts tagged as:', 'water-bear-games'); ?> &quot;<?php echo single_tag_title(); ?>&quot;.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php if (is_active_sidebar('main-sidebar')) get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>