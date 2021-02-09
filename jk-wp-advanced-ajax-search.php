<?php defined('ABSPATH') || exit;

class jk_wp_advanced_ajax_search
{

    public function ajax_handler()
    {

        wp_reset_postdata();

        $args = array(
            's' => $_POST['query'],
            'ignore_sticky_posts' => true,
            'posts_per_page' => 5,
            'order' => 'DESC',
            'post_type' => 'post',
            'orderby' => 'rand'
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) :

            while ($the_query->have_posts()) : $the_query->the_post();



            endwhile;

        else: ?>

            <li class="empty-message">

                <?php echo esc_html__('We did not find any article that matches this search. Try using other search criteria...', 'jk-core'); ?>

            </li>

        <?php

        endif;

        die();

    }

    public function ajax_init()
    {

        add_action('wp_ajax_nopriv_jk_advanced_ajax_search', [$this, 'ajax_handler']);

        add_action('wp_ajax_jk_advanced_ajax_search', [$this, 'ajax_handler']);

    }

}
