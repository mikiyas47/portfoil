<?php
/**
 * Miki Portfolio theme functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function miki_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'miki-portfolio' ),
	) );
}
add_action( 'after_setup_theme', 'miki_setup' );

function miki_enqueue_assets() {
	wp_enqueue_style( 'miki-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'miki-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3' );
	wp_enqueue_style( 'miki-style', get_stylesheet_uri(), array(), '1.0' );
	wp_enqueue_style( 'miki-main', get_template_directory_uri() . '/assets/css/main.css', array( 'miki-style' ), '1.0' );
	wp_enqueue_script( 'miki-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'miki_enqueue_assets' );

/**
 * Register widget area for the footer (optional use)
 */
function miki_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'miki-portfolio' ),
		'id'            => 'footer-1',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'miki_widgets_init' );

/**
 * Customizer: lets the site owner edit all portfolio content
 * from Appearance > Customize without touching code.
 */
/**
 * Central list of every editable text field, its default value,
 * which customizer section it lives in, and its label.
 * miki_opt() below reads defaults from this same array, so the
 * front end always shows real content even before anyone opens
 * the Customizer.
 */
function miki_field_defaults() {
	return array(
		// Hero
		'miki_name'       => array( 'default' => 'Mikiyas', 'section' => 'miki_hero', 'label' => 'First Name (highlighted in hero)' ),
		'miki_role'       => array( 'default' => 'Software Engineer', 'section' => 'miki_hero', 'label' => 'Role / Title' ),
		'miki_tagline'    => array( 'default' => 'Software Engineering graduate passionate about creating innovative web and mobile solutions that turn ideas into reality through code.', 'section' => 'miki_hero', 'label' => 'Tagline' ),

		// About
		'miki_about_intro' => array( 'default' => 'I am a Software Engineering graduate from Debremarkos University, dedicated to creating innovative solutions through clean, practical code.', 'section' => 'miki_about', 'label' => 'About Intro' ),
		'miki_education'   => array( 'default' => 'Graduated in Software Engineering from Debremarkos University, with a focus on web development, software architecture, and real-world application design.', 'section' => 'miki_about', 'label' => 'Education' ),
		'miki_experience'  => array( 'default' => 'Experienced in building web and mobile projects, with hands-on work across front-end, back-end, database, and modern development frameworks.', 'section' => 'miki_about', 'label' => 'Experience' ),
		'miki_goals'       => array( 'default' => 'Focused on growing as a professional software engineer, building scalable applications, and contributing to meaningful digital products.', 'section' => 'miki_about', 'label' => 'Goals' ),
		'miki_interests'   => array( 'default' => "Beyond coding, I'm passionate about problem-solving, continuous learning, and collaborating with other developers to create meaningful applications.", 'section' => 'miki_about', 'label' => 'Interests' ),
		'miki_skills'      => array( 'default' => 'HTML, CSS, JavaScript, React, PHP, Java, Laravel, NodeJS, MySQL, PostgreSQL', 'section' => 'miki_about', 'label' => 'Skills (comma separated)' ),

		// Contact
		'miki_email'    => array( 'default' => 'mikishemels@gmail.com', 'section' => 'miki_contact', 'label' => 'Email' ),
		'miki_telegram' => array( 'default' => 'https://t.me/Mikesh7', 'section' => 'miki_contact', 'label' => 'Telegram URL' ),
		'miki_github'   => array( 'default' => 'https://github.com/mikiyas47', 'section' => 'miki_contact', 'label' => 'GitHub URL' ),
	);
}

function miki_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'miki_hero', array( 'title' => __( 'Hero Section', 'miki-portfolio' ), 'priority' => 30 ) );
	$wp_customize->add_section( 'miki_about', array( 'title' => __( 'About Section', 'miki-portfolio' ), 'priority' => 31 ) );
	$wp_customize->add_section( 'miki_contact', array( 'title' => __( 'Contact Section', 'miki-portfolio' ), 'priority' => 32 ) );

	foreach ( miki_field_defaults() as $id => $args ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $args['default'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $args['label'],
			'section' => $args['section'],
			'type'    => 'text',
		) );
	}

	// Profile image (image control needs the class)
	$wp_customize->add_setting( 'miki_profile_image', array( 'default' => get_template_directory_uri() . '/assets/images/profile.jpg' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'miki_profile_image', array(
		'label'   => __( 'Profile Photo', 'miki-portfolio' ),
		'section' => 'miki_hero',
	) ) );
}
add_action( 'customize_register', 'miki_customize_register' );

/**
 * Projects custom post type — manage each project from wp-admin
 * just like a normal post, with a GitHub link field.
 */
function miki_register_project_cpt() {
	register_post_type( 'project', array(
		'labels' => array(
			'name'          => __( 'Projects', 'miki-portfolio' ),
			'singular_name' => __( 'Project', 'miki-portfolio' ),
			'add_new_item'  => __( 'Add New Project', 'miki-portfolio' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-portfolio',
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'projects' ),
	) );
}
add_action( 'init', 'miki_register_project_cpt' );

function miki_project_meta_box() {
	add_meta_box( 'miki_project_url', __( 'Project Link', 'miki-portfolio' ), 'miki_project_meta_box_html', 'project', 'side' );
}
add_action( 'add_meta_boxes', 'miki_project_meta_box' );

function miki_project_meta_box_html( $post ) {
	$value = get_post_meta( $post->ID, '_miki_project_url', true );
	wp_nonce_field( 'miki_save_project_meta', 'miki_project_meta_nonce' );
	echo '<label for="miki_project_url_field">' . esc_html__( 'GitHub / live URL', 'miki-portfolio' ) . '</label>';
	echo '<input type="url" id="miki_project_url_field" name="miki_project_url_field" value="' . esc_attr( $value ) . '" style="width:100%;margin-top:6px;" placeholder="https://github.com/username/repo" />';
}

function miki_save_project_meta( $post_id ) {
	if ( ! isset( $_POST['miki_project_meta_nonce'] ) || ! wp_verify_nonce( $_POST['miki_project_meta_nonce'], 'miki_save_project_meta' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( isset( $_POST['miki_project_url_field'] ) ) {
		update_post_meta( $post_id, '_miki_project_url', esc_url_raw( $_POST['miki_project_url_field'] ) );
	}
}
add_action( 'save_post', 'miki_save_project_meta' );

/**
 * Seed three example projects on theme activation so the
 * site isn't empty on first install.
 */
function miki_seed_projects() {
	if ( get_option( 'miki_projects_seeded' ) ) return;

	$projects = array(
		array(
			'title'   => 'Class Management System',
			'content' => 'A comprehensive system for managing class schedules, student records, and academic resources efficiently.',
			'url'     => 'https://github.com/mikiyas47/Class-Managment-System',
		),
		array(
			'title'   => 'Smart Parking System',
			'content' => 'An IoT-based solution for real-time parking spot detection and management to reduce traffic congestion.',
			'url'     => 'https://github.com/mikiyas47/smart_parking_system',
		),
		array(
			'title'   => 'Food Delivery System',
			'content' => 'A user-friendly platform for ordering food online, featuring restaurant listings and order tracking.',
			'url'     => 'https://github.com/mikiyas47/Food_Delivery',
		),
		array(
			'title'   => 'Network Marketing Management System',
			'content' => 'A mobile-focused management system for network marketing teams, including placement trees, contacts, products, earnings, and rank tracking.',
			'url'     => 'https://github.com/mikiyas47/NetGrow',
		),
	);

	foreach ( $projects as $p ) {
		$id = wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_content' => $p['content'],
			'post_type'    => 'project',
			'post_status'  => 'publish',
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_miki_project_url', $p['url'] );
		}
	}

	update_option( 'miki_projects_seeded', 1 );
}
add_action( 'after_switch_theme', 'miki_seed_projects' );

/**
 * Small helper to echo a customizer text setting safely,
 * falling back to the field's registered default so the
 * page never renders blank text.
 */
function miki_opt( $key ) {
	$defaults = miki_field_defaults();
	$fallback = isset( $defaults[ $key ] ) ? $defaults[ $key ]['default'] : '';
	echo esc_html( get_theme_mod( $key, $fallback ) );
}
