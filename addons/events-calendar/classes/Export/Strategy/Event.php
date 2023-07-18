<?php

namespace ACA\EC\Export\Strategy;

use ACA\EC\ListScreen;
use ACP;

/**
 * Exportability class for events list screen
 * @since 1.0.2
 */
class Event extends ACP\Export\Strategy\Post {

	public function __construct( ListScreen\Event $list_screen ) {
		parent::__construct( $list_screen );
	}

	/**
	 * @since 1.0
	 * @see   ACP_Export_ExportableListScreen::ajax_export()
	 */
	protected function ajax_export(): void {
		parent::ajax_export();

		/**
		 * The Events Calender runs 'post_limits' to alter the limit for the admin list. In order for Export to work, we have to make sure the default 'WordPress' limit is used based on our query arguments
		 */
		add_filter( 'post_limits', [ $this, 'modify_posts_limit' ], 1 );
	}

	public function modify_posts_limit( $limit ): string {
		remove_filter( 'post_limits', [ 'Tribe__Events__Admin_List', 'events_search_limits' ] );

		return $limit;
	}

}