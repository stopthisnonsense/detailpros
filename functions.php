<?php


function divichild_enqueue_scripts() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ));
}



//you can add custom functions below this line:


function tdp_pods( $atts ) {
    $atts = shortcode_atts( [

    ], $atts );

    $params = [
        'limit' => -1,
    ];

    $tdp_detailers = pods( 'detailer' , $params );

    $tdp_classes = "tdp-detailers";

    if( get_the_ID() ) {
        $post_id = get_the_ID();
        $tdp_classes = "tdp-detailers tdp-detailers--$post_id";
    }
    // var_dump( $tdp_detailers );
    if( !isset( $tdp_detailers ) ) {
        return;
    }
    // var_dump( $tdp_detailers );
    $template = "<div class='$tdp_classes'>";
    while( $tdp_detailers->fetch() ) {

        $tdp_name = $tdp_detailers->display( 'post_title' );
        $tdp_id = $tdp_detailers->display( 'ID' );
        $tdp_instagram = $tdp_detailers->display( 'instagram' );
        $tdp_instagram_image = get_stylesheet_directory_uri() . '/images/instagram-icon.png';
        $tdp_image = get_the_post_thumbnail( $tdp_id );
        $tdp_experience = $tdp_detailers->display( 'experience' );
        $tdp_experience_excerpt = $tdp_detailers->display( 'experience_excerpt' );
        $tdp_years = $tdp_experience <= 1 ? 'Year': 'Years';

        $tdp_image_template = "<div class='tdp-detailer__image tdp-detailer__image--$tdp_id'>
            $tdp_image
        </div>";

        $tdp_name_template = "<h3 class='tdp-detailer__name tdp-detailer__name--$tdp_id'>$tdp_name</h3>";

        $tdp_instagram_template = "<a class='tdp-detailer__instagram tdp-detailer__instagram--$tdp_id' href='https://www.instagram.com/$tdp_instagram' target='blank' ><img class='tdp-detailer__icon tdp-detailer__icon--instagram' src='$tdp_instagram_image'> @$tdp_instagram</a>";

        $tdp_instagram_mobile = "<div class='tdp-detailer__instagram-mobile tdp-detailer__instagram-mobile--$tdp_id'><a class='tdp-detailer__instagram-link tdp-detailer__instagram-link--$tdp_id' href='https://www.instagram.com/$tdp_instagram'>View Instagram</a></div>";

        $tdp_experience_template = "<div class='tdp-detailer__experience tdp-detailer__experience--$tdp_id'>
            <h4>Experience</h4>
            <p>$tdp_experience $tdp_years</p>
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
            $tdp_instagram_mobile
        </div>";
    }
    $template .= "</div>";
    return $template;
}

function choose_detailers( $atts ) {
    $atts = shortcode_atts( [

    ], $atts );

    $params = [
        'limit' => -1,
    ];

    $tdp_detailers = pods( 'detailer' , $params );
    // var_dump( $tdp_detailers );
    $tdp_classes = "tdp-detailers";

    if( get_the_ID() ) {
        $post_id = get_the_ID();
        $tdp_classes = "tdp-detailers tdp-detailers--$post_id";
    }

    if( !isset( $tdp_detailers ) ) {
        return;
    }
    // var_dump( $tdp_detailers );
    $template = "<div class='$tdp_classes'>";
    while( $tdp_detailers->fetch() ) {
        $tdp_name = $tdp_detailers->display( 'post_title' );
        $tdp_slug = $tdp_detailers->display( 'post_name' );
        $tdp_slug_sanitized = esc_attr( $tdp_slug );
        $tdp_name_sanitized = esc_attr($tdp_name);
        $tdp_id = $tdp_detailers->display( 'ID' );
        $tdp_id_sanitized = $tdp_id;

        $tdp_form = $tdp_detailers->display( 'detailer_appointment_form' );
        if( !isset($tdp_form) ) {
            $tdp_form = "[ssa_booking type='$tdp_slug_sanitized']";
        }

        $tdp_instagram = $tdp_detailers->display( 'instagram' );
        $tdp_instagram_image = get_stylesheet_directory_uri() . '/images/instagram-icon.png';
        $tdp_image = get_the_post_thumbnail( $tdp_id );
        $tdp_experience = $tdp_detailers->display( 'experience' );
        $tdp_experience_excerpt = $tdp_detailers->display( 'experience_excerpt' );
        $tdp_years = $tdp_experience <= 1 ? 'Year': 'Years';

        $detailer_permalink = get_the_permalink( 1641 );
        $tdp_queries = $_SERVER['QUERY_STRING'];


        $tdp_image_template = "<div class='tdp-detailer__image tdp-detailer__image--$tdp_id'>
            $tdp_image
        </div>";

        $tdp_name_template = "<h3 class='tdp-detailer__name tdp-detailer__name--$tdp_id'>$tdp_name</h3>";

        $tdp_instagram_template = "<a href='https://www.instagram.com/$tdp_instagram' target='blank' class='tdp-detailer__instagram tdp-detailer__instagram--$tdp_id'><img class='tdp-detailer__icon tdp-detailer__icon--instagram' src='$tdp_instagram_image'> @$tdp_instagram</a>";

        $tdp_select_detailer = "<div class='tdp-detailer__select-detailer tdp-detailer__select-detailer--$tdp_id'><a class='tdp-detailer__select-detailer-link tdp-detailer__select-detailer-link--$tdp_id et_pb_button et_pb_button--bold' href='$detailer_permalink?$tdp_queries&tdp_detailer=$tdp_id'>Select Detailer</a></div>";

        $tdp_experience_template = "<div class='tdp-detailer__experience tdp-detailer__experience--$tdp_id'>
            <h4>Experience</h4>
            <p>$tdp_experience $tdp_years</p>
        </div>";

        $tdp_excerpt_template = "<div class='tdp-detailer__excerpt tdp-detailer__excerpt--$tdp_id'>
            <h4>Experience</h4>
            $tdp_experience_excerpt
        </div>";


        $template .= "
        <div class='tdp-detailer tdp-detailer--$tdp_id tdp-detailer--light' >
            $tdp_image_template
            $tdp_name_template
            $tdp_instagram_template
            $tdp_experience_template
            $tdp_excerpt_template
            $tdp_select_detailer
        </div>";
    }
    $template .= "</div>";
    return $template;

}

// function tdp_select_date_time() {
//     $query_strings = $_GET['car_type'];
//     $all_queries = $_SERVER['QUERY_STRING'];
//     if( $query_strings ) {
//         return do_shortcode( "[ssa_booking type=$query_strings]" );
//     }

//     return do_shortcode( '[ssa_booking]' );
// }

function date_picker_filter($params, $fields, $form ) {
    if( $form->id == 9 ) {
        // var_dump($fields);
        if( $_GET['tdp_detailer'] ) {
            $tdp_detailer = pods( 'detailer', $_GET['tdp_detailer'] );

            $tdp_detail_params = [
                'days' => ['sunday','monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
                'items_to_iterate' => [ 'start_time', 'end_time' ]
            ];

            $tdp_detailer_availability= [];
            $constructor_id = 0;
            foreach( $tdp_detail_params['days'] as $day ) {

                    $tdp_start_time = $tdp_detailer->display( $day . '_start_time' );
                    $tdp_end_time = $tdp_detailer->display( $day . '_end_time' );
                    $time_constructor = [
                        'id' => $constructor_id++,
                        'day' => $day,
                        'availability' => $tdp_detailer->display( $day . '_availability' ),
                        'start_time' => $tdp_start_time,
                        'end_time' => $tdp_end_time,
                    ];
                    $constructed_availability[] = $time_constructor;
            }
            // var_dump( $constructed_availability );

        }
        foreach($fields as $field) {
            if( $field->field_key == '25d7z' ) {
                // var_dump( $field );
            }
            if( $field->field_key == '4tpwh' ) {
                // var_dump( $field );
            }
        }
        // add_filter( 'frm_date_field_options', 'add_blackout_dates', 30, 2 );

        function add_blackout_dates( $selectable, $args ) {

            if( $args['field']->field_key  == '4tpwh' ) {
                $selectable = '( ';
                foreach( $constructed_availability as $available ) {

                    if( $available['available'] != 'Available' ) {
                        $available_id = $available['id'];
                        $selectable .= "day != $available_id";
                    }
                }
                $selectable .= ' )';
                // var_dump( $selectable );
            }

            return $selectable;
        }



        function frm_black_out_weekends( $selectable, $args ) {
            if ( $args['field']->field_key == 'pcm7rl3' ) { //replace pcm7rl3 with your field key
                $selectable = '(day != 0 && day != 6)'; //where 0 & 6 are the days of the week
            }
            return $selectable;
        }
    }
}


/* ACTIONS, Shortcodes and filters  */
add_action( 'wp_enqueue_scripts', 'divichild_enqueue_scripts' );

add_shortcode( 'tdp_detailers', 'tdp_pods' );

add_shortcode( 'select_date_time', 'tdp_select_date_time' );

add_shortcode( 'select_detailers', 'choose_detailers' );

add_action('frm_display_form_action', 'date_picker_filter', 8, 3);
