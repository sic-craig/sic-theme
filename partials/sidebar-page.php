<aside class="c-sidebar">

    <h4 class="c-sidebar__heading">
        Our clinics
    </h4>
    <ul class="c-sidebar__list">
        <li class="c-sidebar__item">
            <a class="c-sidebar__item__link" href="/clinics">
                Find a clinic
            </a>
        </li>
        <li class="c-sidebar__item c-sidebar__item--more"><small>Please visit the clinic most convenient for you</small></li>
    </ul>

</aside>

<?php
if (have_rows('sidebar_links')) :
?>
    <aside class="c-sidebar">
        <h4 class="c-sidebar__heading">
            Useful information
        </h4>
        <ul class="c-sidebar__list">
            <?php
            while (have_rows('sidebar_links')) : the_row();
            $internal = (get_sub_field('sl_external_or_internal_link') == 'internal') ? true : false;
            if (!$internal) {
                $external_link = prefixUrl(get_sub_field('sl_external_link'));
            }
            ?>
            <li class="c-sidebar__item">
                <a href="<?php echo ($internal) ? get_sub_field('sl_internal_link') : $external_link;?>" target="_blank">
                    <?php the_sub_field('sl_title');?>
                </a>
            </li>
            <?php
            wp_reset_postdata();
            endwhile;
            ?>
        </ul>
    </aside>
<?php
endif;
?>