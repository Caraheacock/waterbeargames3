<?php
$game_featured_image = wp_get_attachment_url(get_post_thumbnail_id($game->ID));
$game_meta = get_post_meta($game->ID, '_wbg_game', true);
$game_logo = (!empty($game_meta['logo']) ? $game_meta['logo'] : false);
?>
<div class="col <?php echo $col_classes; ?>">
    <div class="col-inner">
        <div class="circle-button pz-secondary-background"<?php echo ($game_featured_image ? ' style="background-image: url(' . $game_featured_image . ');"' : '') ?>>
            <?php if ($game_featured_image) : ?>
            <div class="pz-background-overlay pz-secondary-background"></div>
            <?php endif; ?>
            <div class="circle-button-content">
                <?php
                if ($game_logo) :
                    insert_svg(get_attached_file($game_logo));
                else :
                ?>
                <h4><?php echo get_the_title($game->ID); ?></h4>
                <?php endif; ?>
            </div>
            <a class="wbg-full-cover-link" href="<?php echo get_permalink($game->ID); ?>"></a>
        </div>
    </div>
</div>