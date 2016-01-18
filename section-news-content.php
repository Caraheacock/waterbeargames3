<?php
$args = array(
    'offset'            => 0,
    'posts_per_page'    => 4,
    'post_type'         => 'news'
);
$news_stories = get_posts($args);

$args = array(
    'meta_query' => array(
        array(
            'key' => 'wbg_news_featured',
            'value' => 'on',
        )
    ),
    'offset'            => 0,
    'posts_per_page'    => 1,
    'post_type'         => 'news'
);
$featured_story = get_posts($args);

if (empty($featured_story)) {
    $featured_story = $news_stories[0];
} else {
    $featured_story = $featured_story[0];
}

$featured_story_featured_image = wp_get_attachment_url(get_post_thumbnail_id($featured_story->ID));
$featured_story_meta = get_post_meta($featured_story->ID, 'wbg_news', true);

$featured_story_link = get_permalink($featured_story->ID);
$featured_story_target = '';
if (!empty($featured_story_meta['link']) && empty($featured_story_meta['local'])) {
    $featured_story_link = $featured_story_meta['link'];
    $featured_story_target = ' target="_blank"';
}
?>
<div class="row puzzle-columns-content">
    <div class="column xs-span12 sm-span9 sm-center md-span6 lg-uncenter puzzle-featured-story">
        <div class="column-inner puzzle-news-section-headline">
            <h3>Featured Story</h3>
        </div>
        <div class="column-inner puzzle-story">
            <div class="puzzle-story-image"<?php echo ($featured_story_featured_image ? ' style="background-image: url(' . $featured_story_featured_image . ');"' : '') ?>>
                <a class="puzzle-full-cover-link" href="<?php echo $featured_story_link; ?>"<?php echo $featured_story_target; ?>></a>
            </div>
            <div class="puzzle-story-content">
                <h3><?php echo $featured_story->post_title; ?></h3>
                <?php if (!empty($featured_story_meta['media'])) : ?>
                <h4><?php echo $featured_story_meta['media']; ?></h4>
                <?php endif; ?>
                <h5><?php echo date('F j, Y', strtotime($featured_story->post_date)); ?></h5>
                <a class="wbg-button" href="<?php echo $featured_story_link; ?>"<?php echo $featured_story_target; ?>>View Story</a>
            </div>
        </div>
    </div>
    <div class="column xs-span12 lg-span6">
        <div class="column-inner puzzle-news-section-headline">
            <h3>Recently</h3>
        </div>
        <div class="row puzzle-stories">
        <?php
        foreach ($news_stories as $news_story) :
            $news_featured_image = wp_get_attachment_url(get_post_thumbnail_id($news_story->ID));
            $news_meta = get_post_meta($news_story->ID, 'wbg_news', true);
            
            $news_link = get_permalink($news_story->ID);
            $target = '';
            if (!empty($news_meta['link']) && empty($news_meta['local'])) {
                $news_link = $news_meta['link'];
                $target = ' target="_blank"';
            }
            ?>
            <div class="column xs-span12 sm-span6">
                <div class="column-inner puzzle-story">
                    <div class="puzzle-story-image"<?php echo ($news_featured_image ? ' style="background-image: url(' . $news_featured_image . ');"' : '') ?>>
                        <a class="puzzle-full-cover-link" href="<?php echo $news_link; ?>"<?php echo $target; ?>></a>
                    </div>
                    <div class="puzzle-story-content">
                        <h4><?php echo $news_story->post_title; ?></h4>
                        <h6>
                            <?php echo (!empty($news_meta['media']) ? $news_meta['media'] . '<br />' : ''); ?>
                            <?php echo date('F j, Y', strtotime($news_story->post_date)); ?>
                        </h6>
                        <a class="wbg-button wbg-button-small" href="<?php echo $news_link; ?>"<?php echo $target; ?>>View Story</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="column xs-span12">
        <div class="column-inner">
            <a class="wbg-button" href="/news">View All News Stories</a>
        </div>
    </div>
</div>