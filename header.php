<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible"              content="IE=EDGE">
        <meta name="viewport"                           content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <meta name="author"                             content="<?php echo get_bloginfo('name');?>">

        <?php
        if (!function_exists('_wp_render_title_tag')) :
            function theme_slug_render_title() {
                ?>
                <title><?php wp_title( '|', true, 'right' ); ?></title>
                <?php
            }
            add_action( 'wp_head', 'theme_slug_render_title' );
        endif;
        ?>


        <?php wp_head(); ?>

    </head>

    <body <?php body_class();?>>

    <a id="page-top"></a>

    <!-- Accessibility -->
    <div class="skiplink sr-only"><a href="#accessibility" accesskey="s">Skip Navigation</a></div>

    <header>

        <?php include('partials/navbar.php');?>

    </header>

    <div id="accessibility" class="sr-only"></div>
