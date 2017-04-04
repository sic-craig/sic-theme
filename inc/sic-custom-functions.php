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
    $editor['toolbar1'] = 'bold,italic,bullist,numlist,blockquote,link,unlink,spellchecker, formatselect';
    $editor['paste_as_text'] = true;
    return $editor;
}
add_action('tiny_mce_before_init', 'setEditorPreferences');

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
        return get_template_directory_uri() . '/assets/img/svg';
    } elseif ($dir == 'icons') {
        return get_template_directory_uri() . '/assets/img/icons';
    } else {
        return get_template_directory_uri() . '/assets/img';
    }
}
