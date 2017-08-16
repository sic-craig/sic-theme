<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible"              content="IE=EDGE">
        <meta name="viewport"                           content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <meta name="author"                             content="<?php echo get_bloginfo('name');?>">
        <title><?php wp_title('|', true, 'right'); ?></title>

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
