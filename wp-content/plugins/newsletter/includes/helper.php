<?php
if (!defined('ABSPATH')) exit;

function tnp_post_thumbnail_src($post, $size = 'thumbnail') {
    $media = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
    if (strpos($media[0], 'http') !== 0) $media[0] = 'http:' . $media[0];
    return $media[0];
}

function tnp_post_excerpt($post, $lenght = 30) {
    if (empty($post->post_excerpt)) {
        $excerpt = wp_strip_all_tags(strip_shortcodes($post->post_content));
        $excerpt = wp_trim_words($excerpt, $lenght);
    } else {
        $excerpt = wp_trim_words($post->post_excerpt, $length);
    }
    return $excerpt;
}

function tnp_post_permalink($post) {
    return get_permalink($post->ID);
}

function tnp_post_content($post) {
    return $post->post_content;
}

function tnp_post_title($post) {
    return $post->post_title;
}

function tnp_post_date($post, $format = null) {
    if (empty($format)) {
        $format = get_option('date_format');
    }
    return mysql2date($format, $post->post_date);
}
