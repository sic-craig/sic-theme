<?php
/**
 * Trim a string to a given length
 * If trimmed, returns (length) characters - 3 with '...' appended
 *
 * @param $string
 * @param $length
 * @return string
 */
function trimString($string, $length)
{
    return (strlen($string) > $length) ? substr($string, 0, ($length - 3)) . '...' : $string;
}

/**
 * Strip editor to basic formatting options
 * and limit styling from pasted content
 *
 * @param $editor
 * @return mixed
 */
function setEditorPreferences($editor)
{
    $screen = get_current_screen();
    if ($screen->id == 'clinic') {
        $editor['block_formats'] = 'Paragraph=p; Heading=h3; Subheading=h4;';
    } else {
        $editor['block_formats'] = 'Paragraph=p; Page Heading=h2; Heading=h3; Subheading=h4;';
    }
    $editor['remove_linebreaks'] = false;
    $editor['wpautop'] = false;
    $editor['paste_remove_styles'] = true;
    $editor['paste_remove_spans'] = true;
    $editor['toolbar1'] = 'bold,italic,alignleft,aligncenter,alignright,bullist,numlist,blockquote,link,unlink,spellchecker,formatselect,code';
    $editor['paste_as_text'] = true;
    return $editor;
}
add_action('tiny_mce_before_init', 'setEditorPreferences');

/**
 * Add Custom Toolbar (should match setEditorPreferences() above
 * and remove built in 'Basic' and 'Full' toolbars, for ACF use
 *
 * @param $toolbars
 * @return mixed
 */
function setAcfEditorPreferences($toolbars)
{
    unset($toolbars['Basic']);
    unset($toolbars['Full']);
    $toolbars['Custom'] = [];
    $toolbars['Custom'][1] = [
        'bold',
        'italic',
        'alignleft',
        'aligncenter',
        'alignright',
        'bullist',
        'numlist',
        'blockquote',
        'link',
        'unlink',
        'spellchecker',
        'formatselect',
        'code'
    ];
    return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars' , 'setAcfEditorPreferences');

/**
 * Clear out commonly used bad values used in
 * phone numbers
 * @param $tel
 * @return string
 */
function cleanPhoneNumber($tel) : string
{
    return str_replace(['(', ')', '-', ' ' , '+'], '', $tel);
}

/**
 * Prettify mime types
 *
 * @param string $mime_type
 * @return string
 */
function getMimeType(string $mime_type) : string
{
    switch($mime_type) {
        case 'application/pdf':
            $output = 'PDF';
            break;
        case 'text/plain':
            $output = 'TXT';
            break;
        default:
            $output = $mime_type;
    }
    return $output;
}

/**
 * Prettify url
 *
 * @param string $permalink
 * @return string
 */
function prettifyUrl(string $permalink) : string
{
    $parts = parse_url($permalink);
    if (!$parts) {
        return false;
    }
    return $parts['host'] . $parts['path'];
}


/**
 * Add url prefix if one is not present
 *
 * @param string $url
 * @return string
 */
function prefixUrl(string $url) : string
{
    return ( (substr($url, 0, 8) == 'https://') || (substr($url, 0, 7) == 'http://') ) ? $url : 'http://' . $url;
}


/**
 * Returns path to image folder
 * with optional parameter to specify
 * specific image type folder
 *
 * @param string $dir
 * @return string
 */
function getImagePath(string $dir = '') : string
{
    if ($dir == 'svg') {
        return get_template_directory_uri() . '/assets/dist/img/svg';
    } elseif ($dir == 'icons') {
        return get_template_directory_uri() . '/assets/dist/img/icons';
    } else {
        return get_template_directory_uri() . '/assets/dist/img';
    }
}

/**
 * Bootstrap pagination
 *
 */
function wp_bs_pagination($pages = '', $range = 4)
{

    $showitems                  = ($range * 2) + 1;
    global $paged;

    if (empty($paged)) {
        $paged    = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages              = $wp_query->max_num_pages;

        if (!$pages) {
            $pages          = 1;
        }
    }

    if (1 != $pages) {
        echo '<nav aria-label="Page navigation"><ul class="pagination">';
        // echo '<nav><ul class="pagination"><li class="disabled hidden-xs"><span><span aria-hidden="true">Page '.$paged.' of '.$pages.'</span></span></li>';

        if ($paged > 2 && $paged > $range+1 && $showitems < $pages) {
            echo "<li><a href='".get_pagenum_link(1)."' aria-label='First'>&laquo;<span class='hidden-xs'> First</span></a></li>";
        }
        if ($paged > 1 && $showitems < $pages) {
            echo "<li><a href='".get_pagenum_link($paged - 1)."' aria-label='Previous'>&lsaquo;<span class='hidden-xs'> Previous</span></a></li>";
        }

        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<li class=\"active\"><span>".$i." <span class=\"sr-only\">(current)</span></span></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages) {
            echo "<li><a href=\"".get_pagenum_link($paged + 1)."\"  aria-label='Next'><span class='hidden-xs'>Next </span>&rsaquo;</a></li>";
        }

        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
            echo "<li><a href='".get_pagenum_link($pages)."' aria-label='Last'><span class='hidden-xs'>Last </span>&raquo;</a></li>";
        }

        echo "</ul></nav>";
    }
}


/**
 * Nav Walker
 * for Bootstrap 4.0.0 +
 */
class bs4_walker_nav_menu extends Walker_Nav_menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        // ul
        $indent = str_repeat("\t", $depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu dropdown-menu-right depth_$depth\">\n";
    }
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        // li a span
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        $li_attributes = '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-menu dropdown-menu-right';
        }
        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . (esc_attr($class_names) ? ' ' : '') . 'nav-item' . ($args->walker->has_children ? ' dropdown' : null) . '"';
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';
        $item_output = $args->before;
        $item_output .= ( $depth > 0 ) ? '<a ' . $attributes . '>' : '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
