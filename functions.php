<?php
    wp_register_style(
        'main-style',
        get_template_directory_uri() . '/style.css',
        null
    );

     wp_register_style(
        'bootstrap-style',
        get_template_directory_uri() . '/css/bootstrap.min.css',
        null
    );

    wp_register_style(
        'fontello-style',
        get_template_directory_uri() . '/css/fontello.css',
        null
    );

    if( !is_admin() ) {
        wp_enqueue_style( 'bootstrap-style' );
        wp_enqueue_style( 'fontello-style' );
        wp_enqueue_style( 'main-style' );
        wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
        wp_enqueue_script('sly', get_template_directory_uri() . '/js/sly.min.js');
        wp_enqueue_script('functions', get_template_directory_uri() . '/js/functions.js');
    }
    
    function add_post_formats() {
        add_theme_support( 'post-formats', array( 'audio','video' ) );
    }

    add_theme_support( 'post-thumbnails');

    add_filter( 'get_shortlink', function( $shortlink ) {return $shortlink;} );
    
    add_action( 'after_setup_theme', 'add_post_formats' );

    function post_sub_title_boxes() {
       add_meta_box('post_sub_title', 'Post Sub-Title ', 'post_sub_title_print_box', 'post', 'normal', 'high');
    }

    add_action( 'admin_menu', 'post_sub_title_boxes' );

    function post_sub_title_print_box($post) {
        wp_nonce_field( basename( __FILE__ ), 'metabox_nonce' );
        $html .= '<input type="text" style="width: 100%"name="postsubtitlefield" placeholder="Post Sub-Title" value="' . get_post_meta($post->ID, 'post_sub_title_field',true) . '" /></label> ';
        echo $html;
    }

    add_action('media_buttons','add_shortcod_tabs_button');

    function add_shortcod_tabs_button() {
        echo '<a href="#" id="insert-my-media" class="button">Добавить шорткод вкладок</a>';
    }

    add_action('media_buttons','add_gif_button');

    function add_gif_button() {
        echo '<a href="#" id="insert-my-media" class="button">Add GIF</a>';
    }

    add_action('media_buttons','add_contacts_form_button');

    function add_contacts_form_button() {
        echo '<a href="#" id="insert-my-media" class="button">Добавить контактную форму</a>';
    }

    add_action('admin_footer','subtitle_footer_hook');

    function subtitle_footer_hook()
    {
        ?><script type="text/javascript">
        jQuery('#titlediv').after(jQuery('#post_sub_title'));
        jQuery('#post_sub_title').after(jQuery('#postimagediv'));
        jQuery('#post_sub_title').after(jQuery('#audio_post_options'));
        jQuery('#post_sub_title').after(jQuery('#video_post_options'));
        </script><?php
    }

    function gallery_post_options_boxes() {
       add_meta_box('gallery_post_options', 'Gallery Post Options', 'gallery_post_options_print_box', 'post', 'normal', 'high');
    }

    add_action( 'admin_menu', 'gallery_post_options_boxes' );
   
    function gallery_post_options_print_box($post) {
        wp_nonce_field( basename( __FILE__ ), 'metabox_nonce' );
        $html .= '<label style="font-weight:700">Gallery Images<p style="font-size:11px; font-weight:300">Upload the images for your gallery here.</p>';
        $html .= '<textarea rows="4" style="font-weight:300; width: 100%" name="audiourlfield">'. get_post_meta($post->ID, 'audio_url_field',true) . '</textarea></label>';
        echo $html;
    }

    function audio_post_options_boxes() {
       add_meta_box('audio_post_options', 'Audio Post Options', 'audio_post_options_print_box', 'post', 'normal', 'high');
    }

    add_action( 'admin_menu', 'audio_post_options_boxes' );
   
    function audio_post_options_print_box($post) {
        wp_nonce_field( basename( __FILE__ ), 'metabox_nonce' );
        $html .= '<label style="font-weight:700">Audio URL<p style="font-size:11px; font-weight:300">Copy the audio embedded URL here. (iframe, embed) or a link directly to the file</p>';
        $html .= '<textarea rows="4" style="font-weight:300; width: 100%" name="audiourlfield">'. get_post_meta($post->ID, 'audio_url_field',true) . '</textarea></label>';
        echo $html;
    }

    function video_post_options_boxes() {
       add_meta_box('video_post_options', 'Video Post Options', 'video_post_options_print_box', 'post', 'normal', 'high');
    }

    add_action( 'admin_menu', 'video_post_options_boxes' );
   
    function video_post_options_print_box($post) {
        wp_nonce_field( basename( __FILE__ ), 'metabox_nonce' );
        $html .= '<label style="font-weight:700">Video URL<p style="font-size:11px; font-weight:300">Copy the video URL here.</p>';
        $html .= '<textarea rows="1" style="font-weight:300; width: 100%" name="videourlfield">'. get_post_meta($post->ID, 'video_url_field',true) . '</textarea></label>';
        echo $html;
    }

    function show_metaboxs() {
        if ( is_admin() ) {
            $script = '<<< EOF
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $("#audio_post_options").hide();
                    $("#video_post_options").hide();
                    $("#post-format-0").click(function() {
                        $("#gallery_post_options").hide();
                        $("#audio_post_options").hide();
                        $("#video_post_options").hide();
                    });
                    $("#post-format-gallery").is(":checked") ? $("#gallery_post_options").show() : $("#gallery_post_options").hide();
                    $("#post-format-gallery").click(function() {
                        $("#gallery_post_options").toggle(this.checked);
                        $("#audio_post_options").hide();
                        $("#video_post_options").hide();
                    });
                    $("#post-format-audio").is(":checked") ? $("#audio_post_options").show() : $("#audio_post_options").hide();
                    $("#post-format-audio").click(function() {
                        $("#audio_post_options").toggle(this.checked);
                        $("#gallery_post_options").hide();
                        $("#video_post_options").hide();
                    });
                    $("#post-format-video").is(":checked") ? $("#video_post_options").show() : $("#video_post_options").hide();
                    $("#post-format-video").click(function() {
                        $("#video_post_options").toggle(this.checked);
                        $("#gallery_post_options").hide();
                        $("#audio_post_options").hide();
                    });
                });
            </script>
            EOF';

        echo $script;
        }
    }

    add_action('admin_footer', 'show_metaboxs');

    function post_options_boxes() {
        add_meta_box('post_options', 'Post options', 'post_options_print_box', 'post', 'side', 'default');
    }
     
    add_action( 'admin_menu', 'post_options_boxes' );
    
    function post_options_print_box($post) {
        wp_nonce_field( basename( __FILE__ ), 'metabox_nonce' );
        $case = get_post_meta($post->ID, 'layout_field',true);
    ?>    
        <label for="layout_field" style="font-weight:700">Layout</label><br>
        <p style="font-size:11px">Select the page layout</p>
        <select name="layoutfield" id="layout_field" class="postbox">
    <?php
        if ($case =='') {
            echo '<option value="" selected="selected">- Выбрать -</option>';}
            else {echo '<option value="">- Выбрать -</option>';}
        if ($case =='left') {  
            echo '<option value="left" selected="selected">Left Sidebar</option>';}
            else {echo '<option value="left">Left Sidebar</option>';}
        if ($case =='right') {  
            echo '<option value="right" selected="selected">Right Sidebar</option>';}
            else {echo '<option value="right">Right Sidebar</option>';}
        if ($case =='no') {  
            echo '<option value="no" selected="selected">No Sidebar</option>';}
            else {echo '<option value="no">No Sidebar</option>';}
        $case = get_post_meta($post->ID, 'featured_image_field',true);
    ?>
        </select>
        <label for="featured_image_field" style="font-weight:700">Featured Image Display</label><br>
        <p style="font-size:11px">How to display the featured image</p>
        <select name="featuredimagefield" id="featured_image_field" class="postbox">
    <?php
        if ($case =='') {
            echo '<option value="" selected="selected">- Выбрать -</option>';}
            else {echo '<option value="">- Выбрать -</option>';}
        if ($case =='normal') {
            echo '<option value="normal" selected="selected">Изображение на ширину поста</option>';}
            else {echo '<option value="normal">Изображение на ширину поста</option>';}
        if ($case =='large') {
            echo '<option value="large" selected="selected">Большое изображение над постом и сайдбаром</option>';}
            else {echo '<option value="large">Большое изображение над постом и сайдбаром</option>';}
        if ($case =='full-screen') {
            echo '<option value="full-screen" selected="selected">Full Screen</option>';}
            else {echo '<option value="full-screen">Full Screen</option>';}
        if ($case =='full-screen-title') {
            echo '<option value="full-screen-title" selected="selected">Full Screen title</option>';}
            else {echo '<option value="full-screen-title">Full Screen title</option>';}
        if ($case =='full-screen-title-author') {
            echo '<option value="full-screen-title-author" selected="selected">Full Screen title & author</option>';}
            else {echo '<option value="full-screen-title-author">Full Screen title & author</option>';}
        if ($case =='hide') {
            echo '<option value="hide" selected="selected">Hide Image</option>';}
            else {echo '<option value="hide">Hide Image</option>';}
    ?>
        </select>
     
    <?php
        $html .= '<label for="full_screen_title_color" style="font-weight:700">Full Screen Title Color</label><br>';
        $html .= '<p style="font-size:11px">Only works if "Full Screen with large title" is on</p>';
        $html .= '<input type="color" name="color" value="' . get_post_meta($post->ID, 'full_screen_title_color',true) . '" /> Выбрать цвет<br> ';

        $html .= '<p style="font-size:11px">Only works if "Full Screen with large title" is on</p>';
        $html .= '<label><input type="checkbox" name="title3dtext"';
        $html .= (get_post_meta($post->ID, 'title_3d_text',true) == 'on') ? ' checked="checked"' : '';
        $html .= '> Full Screen Title 3D Text</label><br><br>';

        $html .= '<label><input type="checkbox" name="disableimagecomments"';
        $html .= (get_post_meta($post->ID, 'disable_image_comments',true) == 'on') ? ' checked="checked"' : '';
        $html .= '> Disable image comments</label>';
       
        echo $html;

    }

    function featured_image_options_boxes() {
        add_meta_box('featured_image_options', 'Featured Image Options', 'featured_image_options_print_box', 'post', 'side', 'default');
    }
     
    add_action( 'admin_menu', 'featured_image_options_boxes' );
    
    function featured_image_options_print_box($post) {
        wp_nonce_field( basename( __FILE__ ), 'metabox_nonce' );
    
        $html .= '<label style="font-weight:700">Image Author<p style="font-size:11px; font-weight:300">The name of the images author/website</p>';
        $html .= '<input style="font-weight:300" type="text" name="imageauthorfield" value="' . get_post_meta($post->ID, 'image_author_field',true) . '" /></label><br><br> ';
        
        $html .= '<label style="font-weight:700">Image Source<p style="font-size:11px; font-weight:300">A link to the images author/website</p>';
        $html .= '<input style="font-weight:300" type="text" name="imagesourcefield" value="' . get_post_meta($post->ID, 'image_source_field',true) . '" /></label> ';
       
        echo $html;

    }
     
    function post_options_save_box_data ( $post_id ) {
        // проверяем, пришёл ли запрос со страницы с метабоксом
        if ( !isset( $_POST['metabox_nonce'] )
        || !wp_verify_nonce( $_POST['metabox_nonce'], basename( __FILE__ ) ) )
            return $post_id;
        // проверяем, является ли запрос автосохранением
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
            return $post_id;
        // проверяем, права пользователя, может ли он редактировать записи
        if ( !current_user_can( 'edit_post', $post_id ) )
            return $post_id;
        // теперь также проверим тип записи 
        $post = get_post($post_id);
        if ($post->post_type == 'post') {
            update_post_meta($post_id, 'post_sub_title_field', esc_attr($_POST['postsubtitlefield']));
            update_post_meta($post_id, 'audio_url_field', esc_attr($_POST['audiourlfield']));
            update_post_meta($post_id, 'video_url_field', esc_attr($_POST['videourlfield']));
            update_post_meta($post_id, 'layout_field', $_POST['layoutfield']);
            update_post_meta($post_id, 'featured_image_field', $_POST['featuredimagefield']);
            update_post_meta($post_id, 'full_screen_title_color', $_POST['color']);
            update_post_meta($post_id, 'title_3d_text', $_POST['title3dtext']);
            update_post_meta($post_id, 'disable_image_comments', $_POST['disableimagecomments']);
            update_post_meta($post_id, 'image_author_field', esc_attr($_POST['imageauthorfield']));
            update_post_meta($post_id, 'image_source_field', esc_attr($_POST['imagesourcefield']));
        }
        return $post_id;
    }
     
    add_action('save_post', 'post_options_save_box_data');

    add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );
    function appthemes_add_quicktags() {
        if ( wp_script_is('quicktags') ){
    ?>
        <script type="text/javascript">
        QTags.addButton( 'eg_spoiler', 'Spoiler', '<spoiler>', '</spoiler>', 's', 'spoiler');
        </script>
    <?php
        }
    }

    function my_revisions_to_keep( $revisions ) {
        return 0;
    }
    add_filter( 'wp_revisions_to_keep', 'my_revisions_to_keep' );
    
?>