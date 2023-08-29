<?php
namespace WTS_EAE;

use WPML_Elementor_Module_With_Items;

class WPML_EAE_Comparison_Table_Plan_One extends WPML_Elementor_Module_With_Items {

	public function get_items_field() {
		return 'feature_items_1';
	}

	public function get_fields() {
		return [ 'feature_text'];
	}

	protected function get_title( $field ) {

		switch ( $field ) {

			case 'feature_text':
				return esc_html__( 'Comparison Table: Feature Text', 'wts-eae' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {

		switch ( $field ) {
			case 'feature_text':
				return 'LINE';

			default:
				return '';
		}
	}
}
