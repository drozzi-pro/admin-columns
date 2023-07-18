<?php

namespace ACA\WC\Column\ShopOrder;

use AC;
use ACA\WC\Editing;
use ACA\WC\Filtering;
use ACA\WC\Search;
use ACP;

/**
 * @since 1.1
 */
class Status extends AC\Column
	implements ACP\Sorting\Sortable, ACP\Editing\Editable, ACP\Filtering\Filterable, ACP\Search\Searchable {

	public function __construct() {
		$this->set_type( 'order_status' )
		     ->set_original( true );
	}

	public function get_value( $id ) {
		return null;
	}

	public function get_raw_value( $post_id ) {
		return wc_get_order( $post_id )->get_status();
	}

	protected function register_settings() {
		$width = $this->get_setting( 'width' );

		$width->set_default( 150 );
		$width->set_default( 'px', 'width_unit' );
	}

	public function sorting() {
		return new ACP\Sorting\Model\Post\PostField( 'post_status' );
	}

	public function editing() {
		return new Editing\ShopOrder\Status();
	}

	public function filtering() {
		return new Filtering\ShopOrder\Status( $this );
	}

	public function search() {
		return new ACP\Search\Comparison\Post\Status( $this->get_post_type() );
	}

	public function get_order_status_options() {
		return wc_get_order_statuses();
	}

}