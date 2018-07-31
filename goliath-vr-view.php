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

    //wp_register_script( 'google-vrview', plugins_url( '/js/vrview.min.js', __FILE__ ), array(), '2.0', true );
    wp_register_script( 'uevent', plugins_url('/node_modules/uevent/uevent.js', __FILE__ ), array(), '3.4.0', true );
    wp_register_script( 'd.js', plugins_url('/node_modules/d.js/lib/D.js', __FILE__ ), array(), '3.4.0', true );
    wp_register_script( 'dot', plugins_url('/node_modules/dot/doT.js', __FILE__ ), array(), '3.4.0', true );
    wp_register_script( 'three', plugins_url('/node_modules/three/build/three.js', __FILE__ ), array(), '3.4.0', true );
    wp_register_script( 'photo-sphere-viewer-js', plugins_url('/node_modules/photo-sphere-viewer/dist/photo-sphere-viewer.js', __FILE__ ), array( 'uevent', 'd.js', 'dot', 'three'), '3.4.0', true );
    wp_register_style( 'photo-sphere-viewer-css', 'https://cdn.jsdelivr.net/npm/photo-sphere-viewer@3.4.0/dist/photo-sphere-viewer.min.css' );

    wp_register_script( 'goliath-vrview', plugins_url( '/js/scripts.js', __FILE__ ), array( 'photo-sphere-viewer-js' ), '20180208', true );
}


add_shortcode( 'vrview', 'gvv_do_vrview_shortcode' );

function gvv_do_vrview_shortcode ( $attr ){

    if( isset( $attr['url'] ) && ! empty( $attr['url'] ) ){

        wp_enqueue_script( 'goliath-vrview' );
        wp_enqueue_style( 'photo-sphere-viewer-css' );

        $image_url = esc_attr( $attr['url'] );
        $uniq_id = uniqid( 'gvv-' );

        return "<div id='{$uniq_id}' class='gvv-vrview' data-image-url='{$image_url}'></div>";
    }

}