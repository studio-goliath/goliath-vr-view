<?php
/**
 * Plugin Name: Goliath VR View
 * Description: Display 360 image
 * Author: Studio Goliath
 * Author URI: https://www.studio-goliath.com/
 * Version: 1.0
 */


add_action( 'wp_enqueue_scripts', 'gvv_enqueue_scripts' );

function gvv_enqueue_scripts(){

    wp_register_script( 'google-vrview', 'https://storage.googleapis.com/vrview/2.0/build/vrview.min.js', array(), '2.0', true );
    wp_register_script( 'goliath-vrview', plugins_url( '/js/scripts.js', __FILE__ ), array( 'google-vrview' ), '20180208', true );
}


add_shortcode( 'vrview', 'gvv_do_vrview_shortcode' );

function gvv_do_vrview_shortcode ( $attr ){

    if( isset( $attr['image'] ) && ! empty( $attr['image'] ) ){

        wp_enqueue_script( 'goliath-vrview' );

        $image_id = intval( $attr['image'] );
        $image_full_url = esc_attr( wp_get_attachment_url( $image_id ) );
        $uniq_id = uniqid( 'gvv' );

        return "<div id='{$uniq_id}' class='gvv-vrview' data-image-url='{$image_full_url}'></div>";
    }

}