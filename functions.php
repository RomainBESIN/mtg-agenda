<?php
/**
 * Astra child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

 /**
 * Adding via filter or you can directly add in a template file
 */
add_action( 'event_manager_event_filters_search_events_end', 'filter_by_region_field' );
function filter_by_region_field() { ?>

<div class="wpem-row">
 <div class="wpem-col">
	 <div class="wpem-form-group">
			 <div class="search_event_types">
			 <label for="search_event_types" class="wpem-form-label"><?php _e( 'region', 'event_manager' ); ?></label>
			 <select name="filter_by_region" class="event-manager-filter">
				 <option value=""><?php _e( 'Region', 'event_manager' ); ?></option>
				 <option value="co"><?php _e( 'corse', 'event_manager' ); ?></option>
				 <option value="no"><?php _e( 'nord', 'event_manager' ); ?></option>
				 <option value="bour"><?php _e( 'bourgogne', 'event_manager' ); ?></option>
				 <option value="paca"><?php _e( 'paca', 'event_manager' ); ?></option>
			 </select>
		 </div>
	 </div>
 </div>
</div>
<?php 
}

/**
* This code gets your posted field and modifies the event search query
*/
add_filter( 'event_manager_get_listings', 'filter_by_region_field_query_args', 10, 2 );
function filter_by_region_field_query_args( $query_args, $args ) {
 if ( isset( $_POST['form_data'] ) ) {
	 parse_str( $_POST['form_data'], $form_data );
	 // If this is set, we are filtering by country
	 if ( ! empty( $form_data['filter_by_region'] ) ) {
		 $event_region = sanitize_text_field( $form_data['filter_by_region'] );
		 $query_args['meta_query'][] = array(
					 'key'     => '_event_region',
					 'value'   => $event_region,
					 );
	 }
 }
 return $query_args;
}

