<?php

/**
 * The main file which calls all the other stuff
 */
class Ultimate_Plugin {

	/**
	 * Holds all post type objects
	 *
	 * @var  array
	 */
	public $post_types;

	/**
	 * Call other modules
	 *
	 * @return  void
	 * */
	public function __construct() {

		$this->post_types = new Ultimate_Plugin_Post_Types();

	}


}
