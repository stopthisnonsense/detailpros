<?php


function divichild_enqueue_scripts() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'divichild_enqueue_scripts' );


//you can add custom functions below this line:


function tdp_pods( $atts ) {
    $atts = shortcode_atts( [

    ], $atts );

    $params = [
        'limit' => -1,
    ];

    $tdp_detailers = pods( 'detailer' , $params );

    if( !isset( $tdp_detailers ) ) {
        return;
    }
    var_dump( $tdp_detailers );
    $template = "<div>";
    while( $tdp_detailers->fetch() ) {

        $tdp_name = $tdp_detailers->display( 'post_title' );
        $tdp_id = $tdp_detailers->display( 'ID' );
        $tdp_instagram = $tdp_detailers->display( 'instagram' );
        $tdp_image = get_the_post_thumbnail( $tdp_id );

        $tdp_experience = $tdp_detailers->display( 'experience' );

        $tdp_experience_excerpt = $tdp_detailers->display( 'experience_excerpt' );

        $tdp_image_template = "<div class='tdp-detailer__image tdp-detailer__image--$tdp_id'>
            $tdp_image
        </div>";

        $tdp_name_template = "<h3 class='tdp-detailer__name tdp-detailer__name--$tdp_id'>$tdp_name</h3>";

        $tdp_instagram_template = "<div class='tdp-detailer__instagram tdp-detailer__instagram--$tdp_id'><span class='et-pb-icon social-icon' style='font-size: 24px; color: #f12742'></span> $tdp_instagram</div>";

        $tdp_experience_template = "<div class='tdp-detailer__experience tdp-detailer__experience--$tdp_id'>
            <h4>Experience</h4>
            <p>$tdp_experience</p>
        </div>";

        $tdp_excerpt_template = "<div class='tdp-detailer__excerpt tdp-detailer__excerpt--$tdp_id'>
            <h4>Experience</h4>
            $tdp_experience_excerpt
        </div>";


        $template .= "
        <div class='tdp-detailer tdp-detailer--$tdp_id' >
            $tdp_image_template
            $tdp_name_template
            $tdp_instagram_template
            $tdp_experience_template
            $tdp_excerpt_template
        </div>";
    }
    $template .= "</div>";
    return $template;
}

add_shortcode( 'tdp_detailers', 'tdp_pods' );
