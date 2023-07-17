<?php
/**
 * Plugin Name:Moai Academy
 * Description:Multiple courses offers.
 * Version: 1.0.0
 * Author:Bilal Ahmed  
 */

 
defined('ABSPATH') or die();


function saificontactform_custom_scripts(){
    // Enqueue jQuery Validate plugin
    wp_enqueue_script('custommoaiaca-jquery',plugins_url('js/jquery-3.6.1.min.js',__FILE__),'','3.7.0',true);
    wp_enqueue_script('jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js', array('jquery'), '1.19.3', true);
    wp_enqueue_script('moaiaca-script',plugins_url('js/custom.js',__FILE__),[],'','all');
    wp_enqueue_style('custom-bootstrap',plugins_url('css/bootstrap.min.css',__FILE__),[],'','all');
    wp_enqueue_style('multi-step1-css',plugins_url('css/style.css',__FILE__),[],'','all');
   
    }
    add_action('wp_enqueue_scripts','saificontactform_custom_scripts' );



//admin enque scripts


function moai_academy_admincontact_scripts()    
    {
   
 wp_enqueue_script('moaiacademy-admin-jquery',plugins_url('js/jquery-3.7.0.min.js',__FILE__),'','3.7.0',true);

 wp_enqueue_script('moaiaca-admin-js',plugins_url('admin/admin.js',__FILE__),[],'','all');

 wp_enqueue_style('moaiaca_stylesheet',plugins_url('admin/admin.css',__FILE__),[],'','all');
  
    
   }
      add_action('admin_enqueue_scripts','moai_academy_admincontact_scripts');


//pages create on plugin activation

    
register_activation_hook( __FILE__, 'moai_beauty_coures_for' );
    
    function moai_beauty_coures_for() {
        // Array of page data (title, content, template, etc.) for multiple pages
        $pages = array(
            array(
                'title'     => 'which course you interested in?',
                'content'   => '[course_interested]',
                'template'  => '', // Template name or file path
                'parent'    => 0, // Optional parent page ID
            ),
            array(
                'title'     => 'select a session',
                'content'   => '[session-select]',
                'template'  => '', // Template name or file path
                'parent'    => 0, // Optional parent page ID
            ),
            array(
                'title'     => 'Confirm your enrollment',
                'content'   => '[enrollment]',
                'template'  => '', // Template name or file path
                'parent'    => 0, // Optional parent page ID
            ),
            array(
                'title'     => 'Privacy Policy',
                'content'   => '',
                'template'  => '', // Template name or file path
                'parent'    => 0, // Optional parent page ID
            ),
        );

            foreach ( $pages as $page ) {
                $page_exists = get_page_by_title( $page['title'] );
        
                // Create the page if it doesn't exist
                if ( ! $page_exists ) {
                     wp_insert_post( array(
                        'post_title'     => $page['title'],
                        'post_content'   => $page['content'],
                        'post_status'    => 'publish',
                        'post_type'      => 'page',
                        'post_parent'    => $page['parent'],
                        'page_template'  => $page['template'],
                    ) );
        
                    // Optionally, you can set custom fields or perform other actions on the created page
                    // For example:
                    // update_post_meta( $new_page_id, 'custom_field_name', 'custom_field_value' );
                }
            }
        }

    



    include("includes/customposttype.php");
    include("includes/coursecontent.php");
    


    ?>