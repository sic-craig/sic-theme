<article class="c-content printable">
    <div id="spacer"></div>
    <?php
    the_content();
    ?>
</article>
<?php
if (have_rows('faqs')) :
?>
<article class="faqs">
    <h3 class="sr-only">FAQ's</h3>
    <?php
    $i = 0;
    while (have_rows('faqs')) : the_row();
        ?>
        <a class="collapse-trigger collapse-trigger--faqs" href="#faq-<?php echo $i;?>" data-toggle="collapse" aria-expanded="false" aria-controls="faq-<?php echo $i;?>">
            <h4 class="collapse-tigger__text">
                <?php the_sub_field('faqs_question');?>
            </h4>
        </a>
        <div class="collapse collapse-trigger__wrap" id="faq-<?php echo $i;?>">
            <p class="collapse-trigger__content"><?php the_sub_field('faqs_answer');?></p>
        </div>
        <?php
    $i++;
    endwhile;
    ?>
</article>
<?php
endif;
?>

<?php
if (have_rows('pa_attachments')) :
    ?>
    <ul class="c-attachments">
        <?php
        while (have_rows('pa_attachments')) : the_row();
            $attachment = get_sub_field('pa_attachments_attachment');

            $mime_type = getMimeType($attachment['mime_type']);
            ?>
            <li class="c-attachment">
                <a class="c-attachment__link" target="_blank" href="<?php echo $attachment['url'];?>"><?php echo $attachment['title'];?>
                    &nbsp;(<?php echo $mime_type;?>)
                </a>
            </li>

            <?php
        endwhile;
        ?>
    </ul>
    <?php
endif;
?>
