<?php
/**
 * Title: Testimonial Element
 *
 * Description: Defines custom post type "testimonial".
 *                Defines action to be done when element "testimonial" is active.
 *
 * Please do not edit this file. This file is part of the CyberChimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// Don't load directly
if( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( !class_exists( 'CyberChimpsTestimonial' ) ) {
	class CyberChimpsTestimonial {

		protected static $instance;
		public $options;

		/* Static Singleton Factory Method */
		public static function instance() {
			if( !isset( self::$instance ) ) {
				$className      = __CLASS__;
				self::$instance = new $className;
			}

			return self::$instance;
		}

		/**
		 * Initializes plugin variables and sets up WordPress hooks/actions.
		 *
		 * @return void
		 */
		protected function __construct() {
			add_action( 'testimonial', array( $this, 'render_display' ) );
			$this->options = get_option( 'cyberchimps_options' );
			add_action( 'init', array( $this, 'cyberchimps_init_testimonial_post_type' ) );
		}

		//Define Custom post type
		function cyberchimps_init_testimonial_post_type() {

			/*
			 * configure your meta box
			 */

                        $directory_uri = get_template_directory_uri();


			$page_fields = array(
				array(
                    'name'    => __( 'Testimonial Section Title', 'cyberchimps_core' ),
                    'desc'    => '',
                    'id'      => 'ir_testimonial_title',
                    'type'    => 'text',
					'class'   => ''
				),
				array(
					'type'    => 'single_image',
					'id'      => 'testimonial_background',
					'desc'    => __('Best suited image size is 1280px * 375px', 'cyberchimps_core'),
					'name'    => __( 'Testimonial Background', 'cyberchimps_core' ),
					'class'   => ''
				),
                array(
                    'name'    => __( 'First Testimonial Image', 'cyberchimps_core' ),
                    'desc'    => __( 'Enter URL or upload file', 'cyberchimps_core' ),
                    'id'      => 'cyberchimps_blog_testimonial_image_one',
                    'type'    => 'single_image',
					'class'   => '',
                    ),
                            array(
                    'name'    => __( 'First Testimonial Author Name', 'cyberchimps_core' ),
                    'id'      => 'cyberchimps_blog_client_one',
					'class'   => '',
                    'type'    => 'text'
                    ),
                            array(
                                        'name'    => __( 'First Testimonial about the Author', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_blog_client_abt_one',
                                        'type'    => 'text',
					'class'   => ''

                                ),
                            array(
                                        'name'    => __( 'First Testimonial Text', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_testimonial_one_text',
                                        'type'    => 'textarea',
					'class'   => ''

                                ),
                            array(
                                        'name'    => __( 'Second Testimonial Image', 'cyberchimps_core' ),
                                        'desc'    => __( 'Enter URL or upload file', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_blog_testimonial_image_two',
                                        'type'    => 'single_image',
					'class'   => ''

                                ),
                            array(
                                        'name'    => __( 'Second Testimonial Author Name', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_blog_client_two',
                                        'type'    => 'text',
					'class'   => ''

                                ),
                            array(
                                        'name'    => __( 'Second Testimonial about the Author', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_blog_client_abt_two',
                                        'type'    => 'text',
                                        'section' => 'cyberchimps_testimonial_section',
                                        'heading' => 'cyberchimps_blog_heading',
					'class'   => ''
                                ),
                            array(
                                        'name'    => __( 'Second Testimonial Text', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_testimonial_two_text',
                                        'type'    => 'textarea',
                                        'section' => 'cyberchimps_testimonial_section',
                                        'heading' => 'cyberchimps_blog_heading',
					'class'   => ''
                                ),
                            array(
                                        'name'    => __( 'Third Testimonial Image', 'cyberchimps_core' ),
                                        'desc'    => __( 'Enter URL or upload file', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_blog_testimonial_image_three',
                                        'type'    => 'single_image',
                                        'section' => 'cyberchimps_testimonial_section',
                                        'heading' => 'cyberchimps_blog_heading',
					'class'   => ''
                                ),
                            array(
                                        'name'    => __( 'Third Testimonial Author Name', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_blog_client_three',
                                        'type'    => 'text',
                                        'section' => 'cyberchimps_testimonial_section',
                                        'heading' => 'cyberchimps_blog_heading',
					'class'   => ''
                                ),
                            array(
                                        'name'    => __( 'Third Testimonial about the Author', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_blog_client_abt_three',
                                        'type'    => 'text',
                                        'section' => 'cyberchimps_testimonial_section',
                                        'heading' => 'cyberchimps_blog_heading',
					'class'   => ''
                                ),
                            array(
                                        'name'    => __( 'Third Testimonial Text', 'cyberchimps_core' ),
                                        'id'      => 'cyberchimps_testimonial_three_text',
                                        'type'    => 'textarea',
                                        'section' => 'cyberchimps_testimonial_section',
                                        'heading' => 'cyberchimps_blog_heading',
					'class'   => ''
                                ),



			);
			/*
			 * configure your meta box
			 */
			$page_config = array(
				'id'             => 'testimonial_options', // meta box id, unique per meta box
				'title'          => __( 'Testimonial Options', 'cyberchimps_core' ), // meta box title
				'pages'          => array( 'page' ), // post types, accept custom post types as well, default is array('post'); optional
				'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
				'priority'       => 'high', // order of meta box: high (default), low; optional
				'fields'         => apply_filters( 'cyberchimps_testimonial_metabox_fields', $page_fields, 'testimonial' ), // list of meta fields (can be added by field arrays)
				'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
				'use_with_theme' => true //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
			);

			/*
			 * Initiate your meta box
			 */
			$page_meta = new Cyberchimps_Meta_Box( $page_config );
		}

		/**
		 * Puts markup for testimonial
		 *
		 * @return void
		 */
		public function render_display() {

			// Get the default image of carousel
			$custombackground = cyberchimps_get_option('testimonial_background');

			if( is_page() ) {
				$customcategory = get_post_meta( get_the_ID(), 'testimonial_category', true );
				$custombackground = get_post_meta( get_the_ID(), 'testimonial_background', true );

				if($custombackground == ""){
					?>
					<style type="text/css" media="all">
						#testimonial_section{
							background : url("<?php echo $custombackground; ?>") no-repeat scroll 0 0 / cover;
						}
					</style>
					<?php
				}
			}

			else {

				$customcategory_obj     = ( isset( $this->options['testimonial_categories'] ) ) ? get_term( $this->options['testimonial_categories'], 'testimonial_categories' ) : '';
				$customcategory     = ( isset( $this->options['testimonial_categories'] ) ) ? $customcategory_obj->slug : '';
				$custombackground        = $this->options['testimonial_background'];
			}

				$args = array(
					'numberposts'         => -1,
					'offset'              => 0,
					'testimonial_categories' => $customcategory,
					'testimonial_background' => $custombackground,
					'orderby'             => 'post_date',
					'order'               => 'ASC',
					'post_type'           => 'testimonial_posts',
					'post_status'         => 'publish',
					'suppress_filters'    => false
				);

				$testimonial_posts = get_posts( $args );
			?>
			<div class="container">
				<div id="testimonial_container" class="row">
					<div id="testimonial" class="col-lg-12">
						<div id="gallery-testimonial" class="carousel slide portfolio-section" data-ride="carousel">

							<?php

							if( $testimonial_posts ) {
								$slide_counter1 = 1; ?>
								 <div role="listbox" class="carousel-inner">

							<?php	foreach( $testimonial_posts as $post ) {

									/* Post-specific variables */
									$image    = get_post_meta( $post->ID, 'testimonial_post_image', true );
									$title    = $post->post_title;
									$testimonial_author    = get_post_meta( $post->ID, 'testimonial_author_name', true );
									$testimonial_text    = get_post_meta( $post->ID, 'testimonial_text', true );
							?>

									<div class="testimonial_main_div item <?php echo ( $slide_counter1 == 1 ) ? "active" : ""; ?>">
		                                <div class="testimonial_img col-lg-12 "><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"/></div>
										<div class="testimonial_author col-lg-12">
											<?php echo $testimonial_author; ?>
										</div>
										<div class="testimonial_text col-lg-12">
											<?php echo $testimonial_text; ?>
										</div>
									</div>

									<?php
									$slide_counter1++;
} // end of foreach
?>

								</div> <!-- end of carousel-inner-->
								<a class="carousel-control left slider-left" href="#gallery-testimonial" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								</a>
								<a class="carousel-control right slider-right" href="#gallery-testimonial" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
						<?php	} ?>

						</div>	<!-- .es-carousel -->
					</div>	<!-- #carousel -->
				</div><!-- #container -->
			</div><!-- end of .container -->
		<?php
		}
	}
}
CyberChimpsTestimonial::instance();
