<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Magazine
 */
/**
 * Doctype Hook
 * 
 * @hooked blossom_magazine_doctype
 */
do_action('blossom_magazine_doctype');
?>

<head itemscope itemtype="http://schema.org/WebSite">
    <?php
    /**
     * Before wp_head
     * 
     * @hooked blossom_magazine_head
     */
    do_action('blossom_magazine_before_wp_head');

    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

    <?php
    wp_body_open();

    /**
     * Before Header
     * 
     * @hooked blossom_magazine_page_start - 20 
     */
    do_action('blossom_magazine_before_header');

    /**
     * Header
     * 
     * @hooked blossom_magazine_header              - 20   
     */
    do_action('blossom_magazine_header');

    /**
     * Before Content
     * 
     * @hooked blossom_magazine_banner             - 15
     */
    do_action('blossom_magazine_after_header');

    /**
     * Content
     * 
     * @hooked blossom_magazine_content_start
     */
    do_action('blossom_magazine_content');