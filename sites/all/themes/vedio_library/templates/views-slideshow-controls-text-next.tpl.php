<?php
    $tid = arg(2);
    $color = get_color_channel($tid);
?>

<span id="views_slideshow_controls_text_next_<?php print $variables['vss_id']; ?>" class="<?php print $classes; ?>">
    <a href="#" style="<?php print t("background-color:");print $color?>"><?php print t('Next'); ?></a>
</span>
