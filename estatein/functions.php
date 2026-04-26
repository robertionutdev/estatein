<?php

// THEME SETUP
function estatein_theme_setup() {
    add_theme_support('title-tag'); // for yoast to control the title
    add_theme_support('post-thumbnails'); // featured images
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery']);
}
add_action('after_setup_theme', 'estatein_theme_setup');


// ENQUEUE Assets
function estatein_enqueue_assets() {

    // Google Fonts
    wp_enqueue_style(
        'estatein-fonts',
        'https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap',
        [],
        null
    );

    // Bootstrap
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
    );

    // Swiper
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'
    );

    // Theme CSS
    wp_enqueue_style(
        'estatein-global',
        get_template_directory_uri() . '/assets/css/global.css'
    );

    wp_enqueue_style(
        'estatein-homepage',
        get_template_directory_uri() . '/assets/css/homepage.css'
    );


    // JS

    // Bootstrap
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );

    // Swiper
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        null,
        true
    );

    // Main JS
    wp_enqueue_script(
        'estatein-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['swiper'],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'estatein_enqueue_assets');


// Resgister menus
function estatein_register_menus() {
    register_nav_menus([
        'primary' => 'Primary Menu',
        'footer_home' => 'Footer - Home',
        'footer_about' => 'Footer - About',
        'footer_properties' => 'Footer - Properties',
        'footer_services' => 'Footer - Services',
        'footer_contact' => 'Footer - Contact',
    ]);
}
add_action('init', 'estatein_register_menus');


// Register Custom post types

// Properties
function estatein_register_properties_cpt() {
    register_post_type('property', [
        'label' => 'Properties',
        'public' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'properties'],
    ]);
}
add_action('init', 'estatein_register_properties_cpt');


// Testimonials
function estatein_register_testimonials_cpt() {
    register_post_type('testimonial', [
        'label' => 'Testimonials',
        'public' => true,
        'menu_icon' => 'dashicons-testimonial',
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'rewrite' => ['slug' => 'testimonials'],
    ]);
}
add_action('init', 'estatein_register_testimonials_cpt');


// Register carbon fields
use Carbon_Fields\Carbon_Fields;

add_action('after_setup_theme', function () {
    Carbon_Fields::boot();
});


use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Start CARBON FIELDS
add_action('carbon_fields_register_fields', function () {

    // Create special tab HERO SECTION
    Container::make('post_meta', 'Hero Section')
        ->where('post_id', '=', get_option('page_on_front'))
        ->add_fields([

           
            // HERO
            Field::make('text', 'hero_title', 'Hero Title'),
            Field::make('text', 'hero_description', 'Hero Description'),

            // HERO BUTTONS
            Field::make('complex', 'hero_buttons', 'Hero Buttons')
                ->set_layout('tabbed-horizontal')
                ->set_min(2)
                ->set_max(2)
                ->add_fields([
                    Field::make('text', 'text', 'Button Text'),
                    Field::make('text', 'link', 'Button Link'),
                    Field::make('select', 'style', 'Button Style')
                        ->add_options([
                            'outline' => 'Outline',
                            'brand' => 'Brand',
                        ]),
                ]),

            // STAT BOXES
            Field::make('complex', 'hero_stats', 'Hero Stats')
                ->set_layout('tabbed-horizontal')
                ->set_min(3)
                ->set_max(3)
                ->add_fields([
                    Field::make('text', 'number', 'Number'),
                    Field::make('text', 'text', 'Text'),
                ]),


            // HERO BOXES
            Field::make('complex', 'hero_boxes', 'Hero Boxes')
                ->set_layout('tabbed-horizontal')
                ->set_min(4)
                ->set_max(4)
                ->add_fields([
                    Field::make('image', 'icon', 'Icon'),
                    Field::make('text', 'text', 'Text'),
                    Field::make('text', 'link', 'Link'),
                ]),

        ]);

    // Register fields for Title/Description/Buttons for other sections of Homepage
    Container::make('post_meta', 'Sections')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([

        // FEATURED PROPERTIES
        Field::make('html', 'featured_label')
            ->set_html('<h2 style="margin-top:20px;"><strong>Featured Properties</strong></h2>'),

        Field::make('text', 'featured_title', 'Title'),
        Field::make('textarea', 'featured_description', 'Description'),

        Field::make('text', 'featured_btn_text', 'Button Text'),
        Field::make('text', 'featured_btn_link', 'Button Link'),


        // TESTIMONIALS
        Field::make('html', 'testimonials_label')
            ->set_html('<h2 style="margin-top:20px;"><strong>What Our Clients Say</strong></h2>'),

        Field::make('text', 'testimonials_title', 'Title'),
        Field::make('textarea', 'testimonials_description', 'Description'),

        Field::make('text', 'testimonials_btn_text', 'Button Text'),
        Field::make('text', 'testimonials_btn_link', 'Button Link'),


         // FAQ
        Field::make('html', 'faq_label')
            ->set_html('<h2 style="margin-top:20px;"><strong>FAQ</strong></h2>'),

        Field::make('text', 'faq_title', 'Title'),
        Field::make('textarea', 'faq_description', 'Description'),

        Field::make('text', 'faq_btn_text', 'Button Text'),
        Field::make('text', 'faq_btn_link', 'Button Link'),


        Field::make('complex', 'faq_items', 'FAQ Listing')
            ->set_layout('tabbed-horizontal')
            ->set_header_template('<%- question %>')
            ->add_fields([

                Field::make('text', 'question', 'Question'),
                Field::make('textarea', 'answer', 'Answer'),

            ]),

    ]);

    // Custom fields for properties CPT
    Container::make('post_meta', 'Property Details')
    ->where('post_type', '=', 'property')
    ->add_fields([

        Field::make('text', 'property_price', 'Price'),
        Field::make('textarea', 'property_short_desc', 'Short Description'),
        Field::make('text', 'property_bedrooms', 'Bedrooms'),
        Field::make('text', 'property_bathrooms', 'Bathrooms'),
        Field::make('text', 'property_area', 'Area (sq ft)'),
        Field::make('text', 'property_build_year', 'Build Year'),
        Field::make('select', 'property_type', 'Property Type')
            ->add_options([
                'villa' => 'Villa',
                'apartment' => 'Apartment',
                'house' => 'House',
                'townhouse' => 'Townhouse',
            ]),

        Field::make('text', 'property_location', 'Location'),

        Field::make('media_gallery', 'property_gallery', 'Gallery'),

        // KEY FEATURES (REPEATER)
        Field::make('complex', 'property_features', 'Key Features')
            ->set_layout('tabbed-horizontal')
            ->set_header_template('<%- text || "Feature" %>')
            ->add_fields([
                Field::make('text', 'text', 'Feature'),
            ]),

    ]);


    // Custom fields for testimonials CPT
    Container::make('post_meta', 'Testimonial Details')
    ->where('post_type', '=', 'testimonial')
    ->add_fields([

        // Rating
        Field::make('select', 'testimonial_rating', 'Rating')
            ->add_options([
                '1' => '1 Star',
                '2' => '2 Stars',
                '3' => '3 Stars',
                '4' => '4 Stars',
                '5' => '5 Stars',
            ]),

        // Name
        Field::make('text', 'testimonial_name', 'Person Name'),

        // Location
        Field::make('text', 'testimonial_location', 'Location'),

    ]);

    // Add custom fields for footer - Admin Footer Settings
    Container::make('theme_options', 'Footer Settings')
        ->add_fields([

            // CTA
            Field::make('text', 'footer_cta_title', 'CTA Title'),
            Field::make('textarea', 'footer_cta_desc', 'CTA Description'),
            Field::make('text', 'footer_cta_btn_text', 'CTA Button Text'),
            Field::make('text', 'footer_cta_btn_link', 'CTA Button Link'),

            // Footer Logo
            Field::make('image', 'footer_logo', 'Footer Logo'),

            // Socials
            Field::make('text', 'facebook_link', 'Facebook'),
            Field::make('text', 'linkedin_link', 'LinkedIn'),
            Field::make('text', 'twitter_link', 'Twitter'),
            Field::make('text', 'youtube_link', 'YouTube'),

            // Terms
            Field::make('text', 'terms_link', 'Terms Link'),

        ]);

    // Add Top bar customisation and contact button - Admin Header Settings
    Container::make('theme_options', 'Header Settings')
        ->add_fields([

            Field::make('text', 'topbar_text', 'Top Bar Text'),
            Field::make('text', 'topbar_link_text', 'Top Bar Link Text'),
            Field::make('text', 'topbar_link_url', 'Top Bar Link URL'),
            Field::make('checkbox', 'topbar_visible', 'Show Top Bar'),
            Field::make('text', 'header_contact_text', 'Contact Button Text'),
            Field::make('text', 'header_contact_link', 'Contact Button Link'),

    ]);

});

// Remove <p> from contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');


// Remove <li> for primary menu
add_filter('wp_nav_menu_items', function($items, $args) {

    if ($args->theme_location === 'primary') {
        return preg_replace('/<li[^>]*>(.*?)<\/li>/', '$1', $items);
    }

    return $items;

}, 10, 2);