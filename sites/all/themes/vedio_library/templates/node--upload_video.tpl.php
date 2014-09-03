<?php
global $subsite_home_page_url;
?>
<script src="/sites/all/libraries/jwplayer/jwplayer.js"></script>
<script>jwplayer.key = "Guox+nuMLWKTuNNNaAnBSWq9ep4UEQMc3m+a1A=="</script>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <?php print render($title_prefix); ?>

    <div<?php print $content_attributes; ?>>
        <?php if ($title && !$page): ?>
            <header<?php print $header_attributes; ?>>
                <?php if ($title): ?>
                    <h1<?php print $title_attributes; ?>>
                        <a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a>
                    </h1>
                <?php endif; ?>
            </header>
        <?php endif; ?>
        <div class='upload-video'><?php print render($content['field_upload_video']); ?></div>
        <?php
        // Get the current child library configuration variables.
        global $library_subsite_variable;
        // Get the current child library name
        global $subsite_home_page_url;
        $video_file_name = $node->field_upload_video['und'][0]['filename'];
        $video_file_uri = $node->field_upload_video['und'][0]['uri'];
        $video_duration = video_library_get_video_duration($video_file_uri);
        ?>
        <div class="video-duration"><?php print $video_duration; ?></div>
        <div class="node-statistics"><?php print views_embed_view('node_statistics', $display_id = 'block', $node->nid); ?></div>
        <div class="node-statistics-like"><?php print views_embed_view('node_statistics', $display_id = 'block_1', $node->nid); ?></div>

        <div class='like-video'><?php print flag_create_link('lke', $node->nid) ?></div>
        <?php
        $fid = $node->field_upload_video['und'][0]['fid'];
        $is_downloadable = $node->field_download_link['und'][0]['value'];
        if (module_exists('file_download_count_extend')) {
            print file_download_create_link($fid, $video_file_name, $is_downloadable);
        }
        ?>

        <div class='recommend'><?php
            global $user;
            global $base_url;
            $url = current_path();
            $path_alias = drupal_lookup_path('alias', $url);
            $break = "%0D%0D%0D";
            $subject = $user->name . $library_subsite_variable[$subsite_home_page_url]['recommend_text'];
            $title_t = $title;
            $title_t = preg_replace('/[^A-Za-z0-9]/', ' ', $title_t);
            $body = "View the video '" . $title_t . "' here: " . $base_url . "/" . $path_alias . $break;
            //       $body = "Here is the link " . url($node_url, array('absolute' => TRUE));
            print '<a href="mailto:?Subject=' . $subject . '&body=' . $body . ' ">' . t('> Recommend to a colleague') . '</a>';
            ?></div>
        <div class='add-to-palylist'><?php print '<span>></span>' . flag_create_link('add_to_my_playlist', $node->nid) ?></div>
        <div class="share"><?php print render($content['field_share']); ?></div>




        <div class="node-author">
            <?php
            /* $author = $content['field_author'];
              $author_name = $author['#object']->field_author['und'][0]['taxonomy_term']->name;
              $node_author = user_load_by_name($author_name);
              $author_uid = $node_author->uid;
              if(!isset($author_uid)){
              $author_uid="-20";
              }
              $profile_url = mck_user_profile($author_uid); */
            $profile_url = mck_user_profile1($node->field_author['und'][0]['taxonomy_term']->name);

            print '<strong>Author:</strong><a href="' . $profile_url . '" target="_blank">' . render($content['field_author']) . '</a>';
            ?>
        </div>
        <div class="body"><?php print render($node->body['und'][0]['value']); ?></div>
        <div class="category">
            <?php
              print render($content['field_related_categories']);
            ?>
        </div>
        <?php
        $related_tags = '';
        if(isset($node->field_related_tags['und'])) {
          $related_tags .= '<h2 class="field-label">Tags: </h2>';
        }
          $related_tags .= '<ul class="field-items">';
          foreach ($node->field_related_tags['und'] as $value) {
              $tags_tid = $value['taxonomy_term']->tid;
              $tags_name = $value['taxonomy_term']->name;
              $tags_link ='<li class="field-item">' . l($tags_name, $subsite_home_page_url . '/tags',
                                                        array('query' => array('tid' => $tags_tid))) . '</li>';
              $related_tags .= $tags_link;
          }
          $related_tags .= '</ul>';
        ?>
        
        <div class="tags">
            <section class="field field-name-field-tags field-type-taxonomy-term-reference field-label-inline clearfix view-mode-full">
                <?php print $related_tags;//render($content['field_tags']); ?>
            </section></div>
        <div class='recommend-mobile'><?php
            global $user;
            global $base_url;
            $url = current_path();
            $path_alias = drupal_lookup_path('alias', $url);
            $break = "%0D%0D%0D";
            $subject = $user->name . $library_subsite_variable[$subsite_home_page_url]['recommend_text'];
            $body = "View the video '" . $title . "' here: " . $base_url . "/" . $path_alias . $break;
            //       $body = "Here is the link " . url($node_url, array('absolute' => TRUE));
            print '<a href="mailto:?Subject=' . $subject . '&body=' . $body . ' ">' . t('Recommend to a colleague') . '</a>';
            ?></div>
        <div class='add-to-palylist-mobile'><?php print flag_create_link('add_to_my_playlist', $node->nid) ?></div>
        <div class='view-comment'><p>View Comments</p></div>
        <div class="node-statistics-comment"><?php print views_embed_view('node_statistics', $display_id = 'block_2', $node->nid); ?></div>
        <?php //print render($content);   ?>
    </div>

    <?php print render($content['comments']); ?>


</article>
