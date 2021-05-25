<?php
/**
 * The template for Candidate Detail
 */
global $author, $current_user, $cs_plugin_options, $cs_notification, $jobcareer_options;  // $jobcareer_options getting from theme if it exist
if ( ! function_exists('cs_candidates_bosy_class') ) {
    add_filter('body_class', 'cs_candidates_bosy_class');

    function cs_candidates_bosy_class($classes) {
        $classes[] = 'cs-candidate-detail';
        return $classes;
    }

}
$cs_phone_number = get_user_meta($author, 'cs_phone_number', true);
$cs_user_data = get_userdata($author);
$cs_user_name = $cs_user_data->display_name;
$cs_uniq = rand(11111111, 99999999);
cs_set_post_views($cs_user_data->ID);
do_action('jobhunt_shaun_update_cand_notification', $cs_user_data->ID);
get_header();
cs_visualnav_sidemenu(); // add sidemenue effect script files
$custom_addon_active = false;
$custom_addon_active = apply_filters('jobhunt_custom_addon_depedency', $custom_addon_active);

/*
 *  login user detail
 */
?>
    <div class="main-section">
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="post-1 post type-post status-publish format-standard hentry category-uncategorized">
                    <!-- alert for complete theme -->
                    <div class="cs_alerts" ></div>
                    <?php
                    $login_user_name = '';
                    $login_user_email = '';
                    $login_user_phone = '';
                    $cs_emp_funs = new cs_employer_functions();
                    if ( is_user_logged_in() ) {
                        $login_user_name = $current_user->display_name;
                        $login_user_email = $current_user->user_email;
                        $login_user_phone = get_user_meta($current_user->ID, 'cs_contact_information', true);
                    }
                    $cs_emp_funs = new cs_employer_functions();
                    $cs_candidate_switch = isset($cs_plugin_options['cs_candidate_switch']) ? $cs_plugin_options['cs_candidate_switch'] : '';

                    $cs_candidate_view = true;
                    if ( $cs_candidate_switch == 'on' ) {
                        $cs_candidate_view = false;
                        if ( is_user_logged_in() && $cs_emp_funs->is_employer() && $cs_emp_funs->cs_check_emp_resume($cs_user_data->ID) ) {
                            $cs_candidate_view = true;
                        } else {
                            $cs_candidate_view = false;
                        }

                        // check if this candidate apply a job and owner of that job need to view the profile of this candidate
                        if ( check_candidate_applications($cs_user_data->ID) > 0 ) {
                            $cs_candidate_view = true;
                        }
                        // check if you this is your own profile
                        if ( is_user_logged_in() ) {
                            $user_profile_id = get_current_user_id();
                            if ( (isset($user_profile_id)) && $cs_user_data->ID == $user_profile_id ) {
                                $cs_candidate_view = true;
                            }
                        }

                        // Candidate view profile hook
                        $cs_candidate_view = apply_filters('jobhunt_view_candidate_all_employer', $cs_candidate_view);
                    }
                    $cs_candidate_view = apply_filters('jobhunt_chech_user_authorized', $cs_candidate_view, $current_user->ID);
                    if ( $cs_candidate_view == true ) {
                        // candidate default var
                        $cs_candidate_address = get_user_meta($cs_user_data->ID, 'cs_post_loc_address', true);
                        $cs_candidate_web_http = $cs_user_data->user_url;
                        $cs_candidate_web = preg_replace('#^https?://#', '', $cs_candidate_web_http);
                        $candidate_img = get_user_meta($cs_user_data->ID, 'user_img', true);
                        $candidate_img = cs_get_img_url($candidate_img, 'cs_media_4');

                        if ( ! cs_image_exist($candidate_img) || $candidate_img == "" ) {
                            $candidate_img = esc_url(wp_jobhunt::plugin_url() . 'assets/images/img-not-found16x9.jpg');
                        }
                        // gettting candidate cover image
                        $cs_candidate_cover_employer_img = get_user_meta($cs_user_data->ID, 'cover_user_img', true);
                        $cs_candidate_cover_employer_img = cs_get_img_url($cs_candidate_cover_employer_img, '');
                        $cs_candidate_cv = get_user_meta($cs_user_data->ID, "cs_candidate_cv", true);

                        $cs_candidate_emp_username = $cs_user_data->ID;
                        $cs_candidate_job_title = get_user_meta($cs_user_data->ID, 'cs_job_title', true);
                        $cs_candidate_facebook = get_user_meta($cs_user_data->ID, 'cs_facebook', true);
                        $cs_candidate_twitter = get_user_meta($cs_user_data->ID, 'cs_twitter', true);
                        $cs_candidate_linkedin = get_user_meta($cs_user_data->ID, 'cs_linkedin', true);
                        $cs_candidate_google_plus = get_user_meta($cs_user_data->ID, 'cs_google_plus', true);
                        // get education list
                        $cs_get_edu_list = get_user_meta($cs_user_data->ID, 'cs_edu_list_array', true);
                        $cs_edu_titles = get_user_meta($cs_user_data->ID, 'cs_edu_title_array', true);
                        $cs_edu_from_dates = get_user_meta($cs_user_data->ID, 'cs_edu_from_date_array', true);
                        $cs_edu_to_dates = get_user_meta($cs_user_data->ID, 'cs_edu_to_date_array', true);
                        $cs_edu_institutes = get_user_meta($cs_user_data->ID, 'cs_edu_institute_array', true);
                        $cs_edu_descs = get_user_meta($cs_user_data->ID, 'cs_edu_desc_array', true);
                        // get experience list
                        $cs_get_exp_list = get_user_meta($cs_user_data->ID, 'cs_exp_list_array', true);
                        $cs_exp_titles = get_user_meta($cs_user_data->ID, 'cs_exp_title_array', true);
                        $cs_exp_from_dates = get_user_meta($cs_user_data->ID, 'cs_exp_from_date_array', true);
                        $cs_exp_to_dates = get_user_meta($cs_user_data->ID, 'cs_exp_to_date_array', true);
                        $cs_exp_to_presents = get_user_meta($cs_user_data->ID, 'cs_exp_to_present_array', true);
                        $cs_exp_companys = get_user_meta($cs_user_data->ID, 'cs_exp_company_array', true);
                        $cs_exp_descs = get_user_meta($cs_user_data->ID, 'cs_exp_desc_array', true);
                        // get portfolio list
                        $cs_get_port_list = get_user_meta($cs_user_data->ID, 'cs_port_list_array', true);
                        $cs_image_titles = get_user_meta($cs_user_data->ID, 'cs_image_title_array', true);
                        $cs_image_uploads = get_user_meta($cs_user_data->ID, 'cs_image_upload_array', true);
                        // get awards list
                        $cs_get_award_list = get_user_meta($cs_user_data->ID, 'cs_award_list_array', true);
                        $cs_award_names = get_user_meta($cs_user_data->ID, 'cs_award_name_array', true);
                        $cs_award_years = get_user_meta($cs_user_data->ID, 'cs_award_year_array', true);
                        $cs_award_descs = get_user_meta($cs_user_data->ID, 'cs_award_description_array', true);
                        // get video
                        $cs_video_url = get_user_meta($cs_user_data->ID, 'cs_video_url', true);
                        //$cs_video_url = (is_array($cs_video_url))? $cs_video_url : array();
                        // get skills list
                        $cs_get_skill_list = get_user_meta($cs_user_data->ID, 'cs_skills_list_array', true);
                        $cs_skill_titles = get_user_meta($cs_user_data->ID, 'cs_skill_title_array', true);
                        $cs_skill_percentages = get_user_meta($cs_user_data->ID, 'cs_skill_percentage_array', true);
                        $cs_header_creds = cs_header_cover_style('candidate', $cs_candidate_cover_employer_img, '0');
                        $cs_header_style = isset($cs_header_creds[0]) ? $cs_header_creds[0] : '';
                        $cs_header_paralax_class = isset($cs_header_creds[1]) ? ' ' . $cs_header_creds[1] : '';
                        $cs_candidate_default_cover_style = isset($jobcareer_options['cs_candidate_default_cover_style']) ? $jobcareer_options['cs_candidate_default_cover_style'] . '-view' : '';
                        $display_name = $cs_user_data->display_name;
                        $display_name = apply_filters('dairyjobs_split_name', $display_name, $cs_user_data->ID);
                        $check_pkg = apply_filters('jobhunt_hide_contact_details', $display_name, $cs_user_data->ID);

                        ?>
                        <!-- Main Start -->
                        <div class="main-section">
                            <div class="page-section">
                                <div class="candidate-header<?php echo esc_html($cs_header_paralax_class) ?> <?php echo esc_html($cs_candidate_default_cover_style) ?>"<?php echo ($cs_header_style != '' ? ' style="' . $cs_header_style . ' background-repeat: no-repeat; background-size: cover;  "' : '') ?>>
                                    <div class="<?php if ( isset($cs_plugin_options['cs_plugin_single_container']) && $cs_plugin_options['cs_plugin_single_container'] == 'on' ) echo 'container' ?>">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="cs-profile">
                                                    <?php
                                                    $plugin_action = false;
                                                    $plugin_action = apply_filters('jobhunt_digitalmarketing_depedency', $plugin_action);
                                                    if ( ! $plugin_action ) {
                                                        ?>
                                                        <div class="cs-media">
                                                            <figure> <img src="<?php echo esc_url($candidate_img); ?>" alt=""><?php do_action('jobhunt_append_with_title', $cs_user_data->ID); ?> </figure>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="info">
                                                        <div class="title"><h3><?php echo $display_name; ?></h3>
                                                            <?php
                                                            do_action('jobhunt_celine_display_name', $cs_user_data->ID);
                                                            ?>
                                                        </div>
                                                        <?php if ( isset($cs_candidate_job_title) && $cs_candidate_job_title != '' ) {
                                                            ?><div class="join-date"><span><?php echo esc_html($cs_candidate_job_title); ?></span></div>
                                                            <?php
                                                        }
                                                        $remove_html = false;
                                                        $remove_html = apply_filters('jobhunt_remove_content', $remove_html, $cs_user_data->ID);
                                                        if ( ! $remove_html ) {
                                                            ?>
                                                            <div class="cs-profile-contact-info">
                                                                <ul>
                                                                    <?php if($check_pkg != '0') {
                                                                        if ( $cs_candidate_facebook != '' ) { ?>
                                                                            <li><a href="<?php echo esc_url($cs_candidate_facebook); ?>" data-original-title="<?php esc_html_e("facebook", 'jobhunt'); ?>"><i class="icon-facebook7"></i></a></li>
                                                                            <?php
                                                                        }
                                                                        if ( $cs_candidate_twitter != '' ) {
                                                                            ?>
                                                                            <li><a href="<?php echo esc_url($cs_candidate_twitter); ?>" data-original-title="<?php esc_html_e("twitter", 'jobhunt'); ?>"><i class="icon-twitter6"></i></a></li>
                                                                            <?php
                                                                        }
                                                                        if ( $cs_candidate_linkedin != '' ) {
                                                                            ?>
                                                                            <li><a href="<?php echo esc_url($cs_candidate_linkedin); ?>" data-original-title="<?php esc_html_e("linkedin", 'jobhunt'); ?>"><i class="icon-linkedin4"></i></a></li>
                                                                            <?php
                                                                        }
                                                                        if ( $cs_candidate_google_plus != '' ) {
                                                                            ?>
                                                                            <li><a href="<?php echo esc_url($cs_candidate_google_plus); ?>" data-original-title="<?php esc_html_e("google", 'jobhunt'); ?>"><i class="icon-googleplus7"></i></a></li>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <li>
                                                                        <form action="https://visumify.com/wp-content/pdf.php" method="POST" id="QRPDF" target="blank">
                                                                        <!--<form action="http://localhost/test.php" method="POST" id="QRPDF" target="blank">-->
                                                                            <input type="hidden" name="phone" value="<?php print_r($cs_phone_number);?>">
                                                                            <input type="hidden" name="email" value="<?php print_r($cs_user_data->data->user_email);?>">
                                                                            <input type="hidden" name="name" value="<?php echo $display_name;?>">
                                                                            <input type="hidden" name="link">
                                                                            <input type="hidden" name="designation" value="<?php echo esc_html($cs_candidate_job_title); ?>">
                                                                            <script>
                                                                                document.getElementsByName("link").item(0).value=window.location.href;
                                                                            </script>
                                                                            <button type="submit" style="background-color: #55A747; border: none; border-radius: 25px; font-size: 13px; padding: 3px 10px;">Download PDF</button>
                                                                        </form>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                    $cs_candidate_cv = apply_filters('jobhunt_modified_cv', $cs_candidate_cv, $cs_user_data); //custom

                                                                    $display_candidate_contact_details = 'yes';
                                                                    $display_candidate_contact_details = apply_filters('jobhunt_candidate_contact_details_for_employers', $display_candidate_contact_details);

                                                                    if ( $display_candidate_contact_details == 'yes' ) {
                                                                        if ( isset($cs_candidate_cv) && $cs_candidate_cv != '' ) {
                                                                            do_action('jobhunt_download_cv_link', $cs_candidate_cv, $cs_user_data->ID);
                                                                        }
                                                                    }
                                                                    do_action('jobhunt_candidate_options', $cs_user_data->ID);
                                                                    ?>
                                                                </ul>
                                                            </div>

                                                        <?php } ?>

                                                    </div>
                                                    <div class="post-options">
                                                        <?php do_action('jobhunt_candidate_page_right_data', $cs_user_data); ?>
                                                        <?php
                                                        do_action('jobhunt_unlock_button');
                                                        ?>
                                                        <ul>
                                                            <?php
                                                            $html = 'yes';
                                                            $dairyjobs_employer_remove_nav = apply_filters('dairyjobs_employer_contactform', $html);
                                                            if ($dairyjobs_employer_remove_nav == 'no') {
                                                                $comma = '';
                                                            } else {
                                                                $comma = ',';
                                                            } ?>
                                                            <li><i class="icon-clock-o"></i><?php esc_html_e('Member Since', 'jobhunt') ?><?php echo $comma; ?><?php echo date_i18n(get_option('date_format'), strtotime($cs_user_data->user_registered)); ?></li>
                                                            <?php
                                                            $display_candidate_contact_details = 'yes';
                                                            $display_candidate_contact_details = apply_filters('jobhunt_candidate_contact_details_for_employers', $cs_user_data->ID, $display_candidate_contact_details);

                                                            if ( $display_candidate_contact_details == 'yes' ) {
                                                                $cs_candidate_address = apply_filters('jobhunt_candidate_address_frontend', $cs_candidate_address, $cs_user_data->ID);
                                                                if ( $cs_candidate_address != '' ) {
                                                                    echo '<li><i class="icon-location6"></i>' . $cs_candidate_address . '</li>';
                                                                } else {
                                                                    $cs_candidate_address = apply_filters('jobhunt_show_optional_address_frontend', '', $cs_user_data->ID);
                                                                    if ( $cs_candidate_address != '' ) {
                                                                        echo '<li><i class="icon-location6"></i>' . $cs_candidate_address . '</li>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php
                                                $remove_html = false;
                                                $remove_html = apply_filters('jobhunt_remove_content', $remove_html, $cs_user_data->ID);
                                                if ( ! $remove_html ) {
                                                    ?>
                                                    <div class="profile-nav">
                                                        <nav>
                                                            <ul>
                                                                <li><a href="#about"><?php esc_html_e('About', 'jobhunt') ?></a></li>
                                                                <?php if ( isset($cs_get_edu_list) && is_array($cs_get_edu_list) && count($cs_get_edu_list) > 0 ) { ?>
                                                                    <li><a href="#education"> <?php esc_html_e("Education", "jobhunt"); ?></a></li>
                                                                <?php } ?>

                                                                <?php if ( isset($cs_get_exp_list) && is_array($cs_get_exp_list) && count($cs_get_exp_list) > 0 ) { ?>
                                                                    <li><a href="#experience"> <?php esc_html_e("Work Experience", "jobhunt"); ?></a></li>
                                                                <?php } ?>
                                                                <?php if ( isset($cs_get_port_list) && is_array($cs_get_port_list) && count($cs_get_port_list) > 0 && ! $custom_addon_active ) { ?>
                                                                    <li><a href="#portfolio"> <?php esc_html_e("Portfolio", "jobhunt"); ?></a></li>
                                                                <?php } ?>
                                                                <?php if ( isset($cs_get_skill_list) && is_array($cs_get_skill_list) && count($cs_get_skill_list) > 0 ) { ?>
                                                                    <li><a href="#skills"> <?php esc_html_e("Professional Skills", "jobhunt"); ?></a></li>
                                                                <?php } ?>
                                                                <?php if ( isset($cs_video_url)) { ?>
                                                                    <li><a href="#video-section"> <?php esc_html_e("Video", "jobhunt"); ?></a></li>
                                                                <?php } ?>
                                                                <?php if ( isset($cs_get_award_list) && is_array($cs_get_award_list) && count($cs_get_award_list) > 0 ) { ?>
                                                                    <li><a href="#awards-houners"> <?php esc_html_e("Awards", "jobhunt"); ?></a></li>
                                                                <?php } ?>

                                                                <?php do_action('jobhunt_user_fields_frontend_tab_ui', $cs_user_data->ID); ?>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page-section">
                                <div class="<?php if ( isset($cs_plugin_options['cs_plugin_single_container']) && $cs_plugin_options['cs_plugin_single_container'] == 'on' ) echo 'container' ?>">
                                    <div class="row">
                                        <?php
                                        $scetion_class = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
                                        $user_description = $cs_user_data->description;
                                        $remove_html = false;
                                        $remove_html = apply_filters('jobhunt_remove_content', $remove_html, $cs_user_data->ID);
                                        if ( $remove_html ) {
                                            $scetion_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                                            $scetion_class = apply_filters('jobhunt_section_class', $scetion_class);
                                            $user_description = apply_filters('jobhunt_trim_description', $user_description);
                                        }
                                        ?>

                                        <div class="<?php echo ($scetion_class); ?>">
                                            <div class="sections">
                                                <div id="about">
                                                    <?php
                                                    $remove_html = false;
                                                    $remove_html = apply_filters('jobhunt_remove_content', $remove_html, $cs_user_data->ID);
                                                    if ( ! $remove_html ) {
                                                        ?>
                                                        <div class="jobs-detail-listing">
                                                            <ul class="row">
                                                                <?php
                                                                $cs_candidate_cus_fields = get_option("cs_candidate_cus_fields");
                                                                if ( is_array($cs_candidate_cus_fields) && sizeof($cs_candidate_cus_fields) > 0 ) {

                                                                    $custom_field_box = 1;
                                                                    foreach ( $cs_candidate_cus_fields as $cus_field ) {
                                                                        $data = '';
                                                                        if ( $cus_field['meta_key'] != '' ) {
                                                                            $data = get_user_meta($cs_user_data->ID, $cus_field['meta_key'], true);
                                                                            // empty check of value
                                                                            if ( $cus_field['label'] != '' ) {

                                                                                if ( $data != "" ) {
                                                                                    ?>
                                                                                    <li class="col-lg-4 col-md-4 col-sm-6">
                                                                                        <div class="listing-inner">
                                                                                            <?php
                                                                                            if ( isset($cus_field['fontawsome_icon']) && $cus_field['fontawsome_icon'] != '' ) {
                                                                                                echo '<i class="' . $cus_field['fontawsome_icon'] . '"></i>';
                                                                                            }
                                                                                            ?>
                                                                                            <div class="cs-text">
                                                                                                <?php if ( $cus_field['label'] <> "" ) { ?> <span><?php echo esc_html($cus_field['label']); ?></span> <?php } ?>
                                                                                                <strong>
                                                                                                    <?php
                                                                                                    // check the data is array or not
                                                                                                    if ( is_array($data) && ! empty($data) ) {
                                                                                                        $data_flage = 1;
                                                                                                        foreach ( $data as $datavalue ) {

                                                                                                            if ( $cus_field['type'] == 'dropdown' ) {
                                                                                                                $options = $cus_field['options']['value'];
                                                                                                                if ( isset($options) ) {
                                                                                                                    $finded_array = array_search($datavalue, $options);
                                                                                                                    $datavalue = isset($finded_array) ? $cus_field['options']['label'][$finded_array] : '';
                                                                                                                }
                                                                                                                echo esc_html($datavalue);
                                                                                                            } else {
                                                                                                                echo esc_html($datavalue);
                                                                                                            }


                                                                                                            if ( $data_flage != count($data) ) {
                                                                                                                echo ", ";
                                                                                                            }
                                                                                                            $data_flage ++;
                                                                                                        }
                                                                                                    } else {

                                                                                                        if ( $cus_field['type'] == 'dropdown' ) {
                                                                                                            $options = $cus_field['options']['value'];
                                                                                                            if ( isset($options) ) {
                                                                                                                $finded_array = array_search($data, $options);
                                                                                                                $data = isset($finded_array) ? $cus_field['options']['label'][$finded_array] : '';
                                                                                                            }
                                                                                                            echo esc_html($data);
                                                                                                        } else {
                                                                                                            echo esc_html($data);
                                                                                                        }
                                                                                                    }
                                                                                                    ?>

                                                                                                </strong>
                                                                                            </div>
                                                                                        </div>

                                                                                    </li>

                                                                                    <?php
                                                                                    $custom_field_box ++;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                $htmll = apply_filters('jobhunt_show_gender_bday_frontend', '', $cs_user_data->ID);
                                                                echo $htmll;
                                                                ?>

                                                            </ul>
                                                        </div>

                                                        <?php
                                                    }
                                                    echo $user_description;
                                                    ?>
                                                </div>
                                                <?php
                                                do_action('jobhunt_cv_documents_list', $author);
                                                // get all candidate switches from plugin options
                                                $cs_education_switch = isset($cs_plugin_options['cs_education_switch']) ? $cs_plugin_options['cs_education_switch'] : '';
                                                $cs_experience_switch = isset($cs_plugin_options['cs_experience_switch']) ? $cs_plugin_options['cs_experience_switch'] : '';
                                                $cs_portfolio_switch = isset($cs_plugin_options['cs_portfolio_switch']) ? $cs_plugin_options['cs_portfolio_switch'] : '';
                                                $cs_skills_switch = isset($cs_plugin_options['cs_skills_switch']) ? $cs_plugin_options['cs_skills_switch'] : '';
                                                $cs_award_switch = isset($cs_plugin_options['cs_award_switch']) ? $cs_plugin_options['cs_award_switch'] : '';

                                                $remove_html = false;
                                                $remove_html = apply_filters('jobhunt_remove_content', $remove_html, $cs_user_data->ID);
                                                if ( ! $remove_html ) {
                                                    if ( $cs_education_switch == 'on' ) {
                                                        if ( isset($cs_get_edu_list) && is_array($cs_get_edu_list) && count($cs_get_edu_list) > 0 ) {
                                                            ?>
                                                            <div id="education" class="panel-inner">
                                                                <div class="inner">
                                                                    <div class="cs-element-title cs-color csborder-color">
                                                                        <i class="icon-graduation"></i>
                                                                        <h4><?php esc_html_e('Education', 'jobhunt') ?></h4>
                                                                    </div>
                                                                    <div class="cs-education">
                                                                        <ul>
                                                                            <?php
                                                                            $cs_award_counter = 0;
                                                                            foreach ( $cs_get_edu_list as $award_list ) {
                                                                                if ( isset($award_list) && $award_list <> '' ) {
                                                                                    $counter_extra_feature = $extra_feature_id = $award_list;
                                                                                    $cs_edu_title = isset($cs_edu_titles[$cs_award_counter]) ? $cs_edu_titles[$cs_award_counter] : '';
                                                                                    $cs_edu_from_date = isset($cs_edu_from_dates[$cs_award_counter]) ? $cs_edu_from_dates[$cs_award_counter] : '';
                                                                                    $cs_edu_to_date = isset($cs_edu_to_dates[$cs_award_counter]) ? $cs_edu_to_dates[$cs_award_counter] : '';
                                                                                    $cs_edu_institute = isset($cs_edu_institutes[$cs_award_counter]) ? $cs_edu_institutes[$cs_award_counter] : '';
                                                                                    $cs_edu_desc = isset($cs_edu_descs[$cs_award_counter]) ? $cs_edu_descs[$cs_award_counter] : '';
                                                                                    ?>
                                                                                    <li>
                                                                                        <div class="cs-title">
                                                                                            <h6><?php if ( isset($cs_edu_title) ) echo esc_attr($cs_edu_title); ?><input type="hidden" form="QRPDF" name="education_title[]" value="<?php if ( isset($cs_edu_title) ) echo esc_attr($cs_edu_title); ?>"></h6><span><?php echo date('Y', strtotime($cs_edu_from_date)); ?> - <?php echo date('Y', strtotime($cs_edu_to_date)); ?></span><input type="hidden" form="QRPDF" name="date[]" value="<?php echo date('Y', strtotime($cs_edu_from_date)) ." - ".date('Y', strtotime($cs_edu_to_date)); ?>">
                                                                                            <span class="cs-institute"><?php if ( isset($cs_edu_institute) ) echo esc_attr($cs_edu_institute); ?></span> <input type="hidden" form="QRPDF" name="university_name[]" value="<?php if ( isset($cs_edu_institute) ) echo esc_attr($cs_edu_institute)?>">
                                                                                        </div>
                                                                                        <div class="education-detail">

                                                                                            <p><?php if ( isset($cs_edu_desc) ) echo force_balance_tags($cs_edu_desc); ?></p>
                                                                                        </div>
                                                                                    </li>

                                                                                    <?php
                                                                                }
                                                                                $cs_award_counter ++;
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    if ( $cs_experience_switch == 'on' ) {
                                                        if ( isset($cs_get_exp_list) && is_array($cs_get_exp_list) && count($cs_get_exp_list) > 0 ) {
                                                            ?>
                                                            <section id="experience">
                                                                <div class="cs-element-title cs-color csborder-color">
                                                                    <i class="icon-briefcase4"></i>
                                                                    <h4><?php esc_html_e('Work Experience', 'jobhunt') ?></h4>
                                                                </div>
                                                                <div class="timeline">
                                                                    <ul>
                                                                        <?php
                                                                        $cs_award_counter = 0;
                                                                        foreach ( $cs_get_exp_list as $award_list ) {
                                                                            if ( isset($award_list) && $award_list <> '' ) {
                                                                                $counter_extra_feature = $extra_feature_id = $award_list;
                                                                                $cs_exp_title = isset($cs_exp_titles[$cs_award_counter]) ? $cs_exp_titles[$cs_award_counter] : '';
                                                                                $cs_exp_from_date = isset($cs_exp_from_dates[$cs_award_counter]) ? $cs_exp_from_dates[$cs_award_counter] : '';
                                                                                $cs_exp_to_date = isset($cs_exp_to_dates[$cs_award_counter]) ? $cs_exp_to_dates[$cs_award_counter] : '';
                                                                                $cs_exp_to_present = isset($cs_exp_to_presents[$cs_award_counter]) ? $cs_exp_to_presents[$cs_award_counter] : '';
                                                                                $cs_exp_company = isset($cs_exp_companys[$cs_award_counter]) ? $cs_exp_companys[$cs_award_counter] : '';
                                                                                $cs_exp_desc = isset($cs_exp_descs[$cs_award_counter]) ? $cs_exp_descs[$cs_award_counter] : '';

                                                                                $from_year = '';
                                                                                $to_year = '';
                                                                                $from_date_year = date_i18n('d-m-Y', strtotime($cs_exp_from_date));

                                                                                $from_year = $from_date_year;

                                                                                $to_date_year = date_i18n('d-m-Y', strtotime($cs_exp_to_date));
                                                                                if ( $cs_exp_to_present == 'on' )
                                                                                    $to_year = esc_html__('Present', 'jobhunt');
                                                                                else
                                                                                    $to_year = $to_date_year;
                                                                                ?>
                                                                                <li>
                                                                                    <div class="cs-title">
                                                                                    <span>
                                                                                        <?php
                                                                                        if ( $to_year == $from_year ) {
                                                                                            echo esc_html($from_year);
                                                                                            echo "<input type='hidden' form='QRPDF' name='work_date[]' value='$from_year'>";
                                                                                        } else {
                                                                                            echo esc_html($from_year) . " - " . esc_html($to_year);
                                                                                            echo "<input type='hidden' form='QRPDF' name='work_date[]' value='$from_year - $to_year'>";
                                                                                        }
                                                                                        ?>
                                                                                    </span>
                                                                                        <?php if ( isset($cs_exp_title) ) echo '<h6>' . esc_html($cs_exp_title) . '</h6>'; ?>
                                                                                        <input type="hidden" form="QRPDF" name="work_title[]" value="<?php if ( isset($cs_exp_title) ) echo esc_html($cs_exp_title) ?>">
                                                                                        <input type="hidden" form="QRPDF" name="work_desc[]" value="<?php  if ( isset($cs_exp_desc) ) echo strip_tags(force_balance_tags($cs_exp_desc)); ?>">
                                                                                    </div>
                                                                                    <div class="cs-text">
                                                                                        <?php if ( isset($cs_exp_desc) ) echo '<p>' . force_balance_tags($cs_exp_desc) . '</p>'; ?>
                                                                                    </div>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                            $cs_award_counter ++;
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </section>
                                                            <?php
                                                        }
                                                    }
                                                    if ( $cs_portfolio_switch == 'on' && ! $custom_addon_active ) {
                                                        if ( isset($cs_get_port_list) && is_array($cs_get_port_list) && count($cs_get_port_list) > 0 ) {
                                                            ?>
                                                            <section id="portfolio">
                                                                <div class="cs-element-title cs-color csborder-color">
                                                                    <i class="icon-pictures5"></i>
                                                                    <h4><?php esc_html_e('Portfolio', 'jobhunt') ?></h4>
                                                                </div>
                                                                <div class="cs-gallry">
                                                                    <div class="row">
                                                                        <?php
                                                                        $cs_award_counter = 0;
                                                                        foreach ( $cs_get_port_list as $award_list ) {
                                                                            if ( isset($award_list) && $award_list <> '' ) {
                                                                                $counter_extra_feature = $extra_feature_id = $award_list;
                                                                                $cs_image_title = isset($cs_image_titles[$cs_award_counter]) ? $cs_image_titles[$cs_award_counter] : '';
                                                                                $cs_image_upload = isset($cs_image_uploads[$cs_award_counter]) ? $cs_image_uploads[$cs_award_counter] : '';
                                                                                if ( ! cs_image_exist($cs_image_upload) ) {
                                                                                    $cs_image_upload_thumb = cs_get_portfolio_img_url($cs_image_upload, 'cs_media_5');
                                                                                    if ( $cs_image_upload_thumb == '' || ! cs_image_exist($cs_image_upload_thumb) ) {
                                                                                        $cs_image_upload_thumb = esc_url(wp_jobhunt::plugin_url() . 'assets/images/img-not-found16x9.jpg');
                                                                                    }
                                                                                    $cs_image_upload_larg = cs_get_portfolio_img_url($cs_image_upload, 'full');
                                                                                    if ( $cs_image_upload_larg == '' || ! cs_image_exist($cs_image_upload_larg) ) {
                                                                                        $cs_image_upload_larg = esc_url(wp_jobhunt::plugin_url() . 'assets/images/img-not-found16x9.jpg');
                                                                                    }
                                                                                } else {
                                                                                    $cs_image_upload_thumb = $cs_image_upload;
                                                                                    $cs_image_upload_larg = $cs_image_upload;
                                                                                }
                                                                                if ( $cs_image_title != '' || $cs_image_upload != '' ) {
                                                                                    ?>

                                                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 thumb">
                                                                                        <div class="cs-media">
                                                                                            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo esc_html($cs_image_title); ?>"
                                                                                               data-caption="<?php echo esc_html($cs_image_title); ?>"
                                                                                               data-image="<?php echo esc_url($cs_image_upload_larg); ?>" data-target="#image-gallery">
                                                                                                <img class="img-responsive" src="<?php echo esc_url($cs_image_upload_thumb); ?>" alt="<?php echo esc_html($cs_image_title); ?>">
                                                                                            </a>

                                                                                        </div>
                                                                                        <?php do_action('jobhunt_portfolio_frontend_view', $cs_user_data->ID, $cs_award_counter); ?>
                                                                                    </div>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            $cs_award_counter ++;
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only"><?php esc_html_e('Close', 'jobhunt') ?></span></button>
                                                                            <h4 class="modal-title" id="image-gallery-title"></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <img id="image-gallery-image" class="img-responsive" src="">
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                                                <button type="button" class="btn btn-primary" id="show-previous-image"><?php esc_html_e('Previous', 'jobhunt') ?></button>
                                                                            </div>

                                                                            <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 text-justify" id="image-gallery-caption">
                                                                                <?php esc_html_e('This text will be overwritten by jQuery', 'jobhunt') ?>
                                                                            </div>

                                                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                                                <button type="button" id="show-next-image" class="btn btn-default"><?php esc_html_e('Next', 'jobhunt') ?></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    if ( $cs_skills_switch == 'on' ) {
                                                        if ( isset($cs_get_skill_list) && is_array($cs_get_skill_list) && count($cs_get_skill_list) > 0 ) {
                                                            ?>
                                                            <section id="skills">
                                                                <div class="cs-element-title cs-color csborder-color">
                                                                    <i class="icon-graph"></i>
                                                                    <h4> <?php esc_html_e('Professional Skills', 'jobhunt') ?></h4>
                                                                </div>
                                                                <?php
                                                                $cs_award_counter = 0;
                                                                foreach ( $cs_get_skill_list as $award_list ) {
                                                                    if ( isset($award_list) && $award_list <> '' ) {
                                                                        $counter_extra_feature = $extra_feature_id = $award_list;
                                                                        $cs_skill_title = isset($cs_skill_titles[$cs_award_counter]) ? $cs_skill_titles[$cs_award_counter] : '';
                                                                        $cs_skill_percentage = isset($cs_skill_percentages[$cs_award_counter]) ? $cs_skill_percentages[$cs_award_counter] : '';
                                                                        ?>
                                                                        <div class="progress-info">
                                                                            <h6><?php if ( isset($cs_skill_title) ) echo esc_html($cs_skill_title); ?></h6>
                                                                            <input type="hidden" form="QRPDF" name="skills[]" value="<?php if ( isset($cs_skill_title) ) echo esc_html($cs_skill_title); ?>">
                                                                            <small> <?php if ( isset($cs_skill_percentage) ) echo preg_replace('/[^0-9]/', '', $cs_skill_percentage) . '%'; ?></small>
                                                                        </div>
                                                                        <div class="progress skill-bar">
                                                                            <div class="progress-bar progress-bar-success cs-bgcolor" role="progressbar" aria-valuenow="<?php echo preg_replace('/[^0-9]/', '', $cs_skill_percentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    $cs_award_counter ++;
                                                                }
                                                                ?>
                                                            </section>
                                                            <?php
                                                        }
                                                    }

                                                    if ( isset($cs_video_url) && ! empty($cs_video_url)  ) {
                                                        ?>
                                                        <div class="panel-inner" id="video-section">
                                                            <div class="inner">
                                                                <div class="cs-element-title cs-color csborder-color">
                                                                    <i class="icon-film4"></i>
                                                                    <h4><?php esc_html_e('Videos', 'jobhunt') ?></h4>
                                                                </div>
                                                                <div class="cs-profile-awards">
                                                                    <ul>
                                                                        <?php
                                                                        $embed_code = wp_oembed_get($cs_video_url);
                                                                        print_r($embed_code);
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }


                                                    if ( $cs_award_switch == 'on' ) {
                                                        if ( isset($cs_get_award_list) && is_array($cs_get_award_list) && count($cs_get_award_list) > 0 ) {
                                                            ?>
                                                            <div class="panel-inner" id="awards-houners">
                                                                <div class="inner">
                                                                    <div class="cs-element-title cs-color csborder-color">
                                                                        <i class="icon-trophy5"></i>
                                                                        <h4><?php esc_html_e('Awards', 'jobhunt') ?></h4>
                                                                    </div>
                                                                    <div class="cs-profile-awards">
                                                                        <ul>
                                                                            <?php
                                                                            $cs_award_counter = 0;
                                                                            foreach ( $cs_get_award_list as $award_list ) {
                                                                                if ( isset($award_list) && $award_list <> '' ) {

                                                                                    $counter_extra_feature = $extra_feature_id = $award_list;
                                                                                    $cs_award_name = isset($cs_award_names[$cs_award_counter]) ? $cs_award_names[$cs_award_counter] : '';
                                                                                    $cs_award_year = isset($cs_award_years[$cs_award_counter]) ? $cs_award_years[$cs_award_counter] : '';
                                                                                    $cs_award_description = isset($cs_award_descs[$cs_award_counter]) ? $cs_award_descs[$cs_award_counter] : '';
                                                                                    ?>
                                                                                    <li>
                                                                                        <div class="cs-title">
                                                                                            <span><?php echo date('Y', strtotime($cs_award_year)); ?></span>
                                                                                            <h6><?php echo esc_html($cs_award_name); ?></h6>
                                                                                        </div>
                                                                                        <div class="award-detail">
                                                                                            <p><?php echo esc_html($cs_award_description); ?></p>
                                                                                        </div>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                $cs_award_counter ++;
                                                                            }
                                                                            ?>

                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                do_action('jobhunt_user_fields_frontend_ui', $cs_user_data->ID);
                                                do_action('jobhunt_resume_buttons', $cs_user_data->ID);
                                                ?>
                                            </div>
                                        </div>

                                        <?php
                                        $display_candidate_contact_details = 'yes';
                                        $display_candidate_contact_details = apply_filters('jobhunt_candidate_contact_details_for_employers', $display_candidate_contact_details);
                                        $remove_html = false;
                                        $remove_html = apply_filters('jobhunt_remove_content', $remove_html, $cs_user_data->ID);
                                        if($check_pkg != '0') {
                                            if ( $remove_html == false ) {
                                                if ( $display_candidate_contact_details == 'yes' ) {
                                                    ?>

                                                    <aside class="col-lg-4 col-md-4 col-sm-6 col-xs-12 section-sidebar">
                                                        <div class="employer-contact-form">
                                                            <h5><?php printf(esc_html__("Contact %s", "jobhunt"), $cs_user_name); ?></h5>
                                                            <div class="cs-profile-contact-detail" data-adminurl="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-cap="recaptcha7">
                                                                <form id="ajaxcontactform" action="#" method="post" enctype="multipart/form-data">
                                                                    <div id="ajaxcontact-response" class=""></div>
                                                                    <div class="input-filed">
                                                                        <i class="icon-user9"></i>
                                                                        <input  id="ajaxcontactname" name="ajaxcontactname" type="text" placeholder="<?php esc_html_e('Enter your Name', 'jobhunt') ?>*" value="<?php if ( isset($login_user_name) ) echo esc_html($login_user_name); ?>" required>
                                                                    </div>
                                                                    <div class="input-filed">
                                                                        <i class="icon-envelope4"></i>
                                                                        <input  id="ajaxcontactemail" name="ajaxcontactemail" type="text" placeholder="<?php esc_html_e('Email Address', 'jobhunt') ?>*" value="<?php if ( isset($login_user_email) ) echo sanitize_email($login_user_email); ?>" required>
                                                                    </div>
                                                                    <div class="input-filed">
                                                                        <i class="icon-mobile4"></i>
                                                                        <input  id="ajaxcontactphone" name="ajaxcontactphone" type="text" placeholder="<?php esc_html_e('Phone Number', 'jobhunt') ?>" value="<?php if ( isset($login_user_phone) ) echo esc_html($login_user_phone); ?>">
                                                                    </div>
                                                                    <div class="input-filed">
                                                                        <textarea id="ajaxcontactcontents" name="ajaxcontactcontents"  placeholder="<?php esc_html_e('Message should have more than 50 characters', 'jobhunt') ?>"></textarea>
                                                                    </div>
                                                                    <?php
                                                                    $cs_terms_policy_switch = isset($cs_plugin_options['cs_terms_policy_switch'])  ? $cs_plugin_options['cs_terms_policy_switch']  : '';
                                                                    $cs_terms_condition     = isset($cs_plugin_options['jobhunt_cand_term_page'])  ? $cs_plugin_options['jobhunt_cand_term_page']  : '';
                                                                    if ( $cs_terms_policy_switch == 'on' && $cs_terms_condition != '' ) {
                                                                        ?>
                                                                        <div class="term-conditions input-filed">
                                                                            <div class="terms">
                                                                                <label><input type="checkbox" name="cs_contact_terms" id="cs_contact_terms" value="on">
                                                                                    <?php esc_html_e('You accepts our', 'jobhunt') ?>
                                                                                    <a target="_blank" href="<?php echo esc_url(get_permalink($cs_terms_condition)) ?>"> <?php esc_html_e('Terms and Conditions', 'jobhunt') ?></a>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    $cs_sitekey = isset($cs_plugin_options['cs_sitekey']) ? $cs_plugin_options['cs_sitekey'] : '';
                                                                    $cs_secretkey = isset($cs_plugin_options['cs_secretkey']) ? $cs_plugin_options['cs_secretkey'] : '';
                                                                    cs_google_recaptcha_scripts();
                                                                    ?>
                                                                    <script>

                                                                        var recaptcha7;
                                                                        var cs_multicap = function () {

                                                                            recaptcha7 = grecaptcha.render('recaptcha7', {
                                                                                'sitekey': '<?php echo ($cs_sitekey); ?>', //Replace this with your Site key
                                                                                'theme': 'light'
                                                                            });
                                                                        };

                                                                    </script>
                                                                    <?php
                                                                    $cs_captcha_switch = isset($cs_plugin_options['cs_captcha_switch']) ? $cs_plugin_options['cs_captcha_switch'] : '';
                                                                    if ( $cs_captcha_switch == 'on' ) {
                                                                        echo '<div class="input-holder recaptcha-reload" id="recaptcha7_div">';
                                                                        echo cs_captcha('recaptcha7');
                                                                        echo '</div>';
                                                                    }
                                                                    ?>
                                                                    <div class="profile-contact-btn submit-btn" data-candidateid="<?php echo esc_html($cs_user_data->ID); ?>">
                                                                        <div id="main-cs-loader" class="loader_class"></div>
                                                                        <input type="submit" id="candidate_contactus"  name="candidate_contactus"  class="cs-bgcolor" value="<?php esc_html_e('Send Request', 'jobhunt'); ?>">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </aside>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <?php do_action('jobhunt_sidebar_notification', $cs_user_data->ID); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            jQuery(document).ready(function () {
                                jQuery('.progress .progress-bar').css("width",
                                    function () {
                                        return jQuery(this).attr("aria-valuenow") + "%";
                                    }
                                )
                            });
                        </script>
                        <script>
                            jQuery(document).ready(function () {
                                loadGallery(true, 'a.thumbnail');
                                //This function disables buttons when needed
                                function disableButtons(counter_max, counter_current) {
                                    jQuery('#show-previous-image, #show-next-image').show();
                                    if (counter_max == counter_current) {
                                        jQuery('#show-next-image').hide();
                                    } else if (counter_current == 1) {
                                        jQuery('#show-previous-image').hide();
                                    }
                                }
                                /**
                                 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
                                 * @param setClickAttr  Sets the attribute for the click handler.
                                 */
                                function loadGallery(setIDs, setClickAttr) {
                                    var current_image,
                                        selector,
                                        counter = 0;
                                    jQuery('#show-next-image, #show-previous-image').click(function () {
                                        if (jQuery(this).attr('id') == 'show-previous-image') {
                                            current_image--;
                                        } else {
                                            current_image++;
                                        }
                                        selector = jQuery('[data-image-id="' + current_image + '"]');
                                        updateGallery(selector);
                                    });
                                    function updateGallery(selector) {
                                        var $sel = selector;
                                        current_image = $sel.data('image-id');
                                        jQuery('#image-gallery-caption').text($sel.data('caption'));
                                        jQuery('#image-gallery-title').text($sel.data('title'));
                                        jQuery('#image-gallery-image').attr('src', $sel.data('image'));
                                        disableButtons(counter, $sel.data('image-id'));
                                    }
                                    if (setIDs == true) {
                                        jQuery('[data-image-id]').each(function () {
                                            counter++;
                                            jQuery(this).attr('data-image-id', counter);
                                        });
                                    }
                                    jQuery(setClickAttr).on('click', function () {
                                        updateGallery(jQuery(this));
                                    });
                                }
                            });
                        </script>
                        <!-- Main End -->
                    <?php
                    } else {
                    ?>
                        <div id="main">
                            <div class="main-section">
                                <section class="candidate-profile">
                                    <div class="<?php if ( isset($cs_plugin_options['cs_plugin_single_container']) && $cs_plugin_options['cs_plugin_single_container'] == 'on' ) echo 'container' ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="unauthorized">
                                                    <h1>
                                                        <?php
                                                        $authorized_text = 'You are not <span>authorized</span>.';
                                                        $authorized_text = apply_filters('jobhunt_user_authorized_text', $authorized_text);

                                                        _e($authorized_text, 'jobhunt');
                                                        ?>
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </article>
            </main>
        </div>
    </div>
<?php
get_footer();
