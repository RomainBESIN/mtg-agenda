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
 * filter region
 */
add_action( 'event_manager_event_filters_search_events_end', 'filter_by_region_field' );
function filter_by_region_field() { ?>

<div class="wpem-row">
 <div class="wpem-col">
	 <div class="wpem-form-group">
			 <div class="search_event_types">
			 <label for="search_event_types" class="wpem-form-label"><?php _e( 'region', 'event_manager' ); ?></label>
			 <select name="filter_by_region" class="event-manager-filter">
				 <option value=""><?php _e( 'Toutes les régions', 'event_manager' ); ?></option>
				 <option value="Auvergne-Rhône-Alpes"><?php _e( 'Auvergne-Rhône-Alpes', 'event_manager' ); ?></option>
				 <option value="Bourgogne-Franche-Comté"><?php _e( 'Bourgogne-Franche-Comté', 'event_manager' ); ?></option>
				 <option value="Bretagne"><?php _e( 'Bretagne', 'event_manager' ); ?></option>
				 <option value="Centre-Val de Loire"><?php _e( 'Centre-Val de Loire', 'event_manager' ); ?></option>
				 <option value="Corse"><?php _e( 'Corse', 'event_manager' ); ?></option>
				 <option value="Grand Est"><?php _e( 'Grand Est', 'event_manager' ); ?></option>
				 <option value="Hauts-de-France"><?php _e( 'Hauts-de-France', 'event_manager' ); ?></option>
				 <option value="Île-de-France"><?php _e( 'Île-de-France', 'event_manager' ); ?></option>
				 <option value="Normandie"><?php _e( 'Normandie', 'event_manager' ); ?></option>
				 <option value="Nouvelle-Aquitaine"><?php _e( 'Nouvelle-Aquitaine', 'event_manager' ); ?></option>
				 <option value="Occitanie"><?php _e( 'Occitanie', 'event_manager' ); ?></option>
				 <option value="Pays de la Loire"><?php _e( 'Pays de la Loire', 'event_manager' ); ?></option>
				 <option value="Provence-Alpes-Côte d Azur"><?php _e( 'Provence-Alpes-Côte d Azur', 'event_manager' ); ?></option>
				 <option value="Régions ultramarines françaises"><?php _e( 'Régions ultramarines françaises', 'event_manager' ); ?></option>
			 </select>
		 </div>
	 </div>
 </div>
</div>
<?php 
}

/**
* This code gets your posted field and modifies the event search query pour region
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

/**
 * filter format
 */
add_action( 'event_manager_event_filters_search_events_end', 'filter_by_format_field' );
function filter_by_format_field() { ?>

<div class="wpem-row">
 <div class="wpem-col">
	 <div class="wpem-form-group">
			 <div class="search_event_types">
			 <label for="search_event_types" class="wpem-form-label"><?php _e( 'format', 'event_manager' ); ?></label>
			 <select name="filter_by_format" class="event-manager-filter">
				 <option value=""><?php _e( 'Tous les formats', 'event_manager' ); ?></option>
				 <option value="Duel Commander"><?php _e( 'Duel Commander', 'event_manager' ); ?></option>
				 <option value="Standard"><?php _e( 'Standard', 'event_manager' ); ?></option>
				 <option value="Vintage"><?php _e( 'Vintage', 'event_manager' ); ?></option>
				 <option value="Pauper"><?php _e( 'Pauper', 'event_manager' ); ?></option>
				 <option value="Legacy"><?php _e( 'Legacy', 'event_manager' ); ?></option>
				 <option value="Modern"><?php _e( 'Modern', 'event_manager' ); ?></option>
				 <option value="Limité"><?php _e( 'Limité', 'event_manager' ); ?></option>
				 <option value="Pioneer"><?php _e( 'Pioneer', 'event_manager' ); ?></option>
				 <option value="Old school"><?php _e( 'Old school', 'event_manager' ); ?></option>
				 <option value="Tiny leader"><?php _e( 'Tiny leader', 'event_manager' ); ?></option>
				 <option value="Modern DC"><?php _e( 'Modern DC', 'event_manager' ); ?></option>
			 </select>
		 </div>
	 </div>
 </div>
</div>
<?php 
}

/**
* This code gets your posted field and modifies the event search query pour format
*/
add_filter( 'event_manager_get_listings', 'filter_by_format_field_query_args', 10, 2 );
function filter_by_format_field_query_args( $query_args, $args ) {
 if ( isset( $_POST['form_data'] ) ) {
	 parse_str( $_POST['form_data'], $form_data );
	 // If this is set, we are filtering by format
	 if ( ! empty( $form_data['filter_by_format'] ) ) {
		 $event_format = sanitize_text_field( $form_data['filter_by_format'] );
		 $query_args['meta_query'][] = array(
					 'key'     => '_event_format',
					 'value'   => $event_format,
					 );
	 }
 }
 return $query_args;
}


