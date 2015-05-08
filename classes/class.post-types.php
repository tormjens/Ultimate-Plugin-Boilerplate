<?php

/**
 * Sets up post types and meta boxes
 */
class Ultimate_Plugin_Post_Types {

	/**
	 * Holds all post type objects
	 *
	 * @var  array
	 */
	private $post_types = [];

	/**
	 * Holds all taxonomy objects
	 *
	 * @var  array
	 */
	private $taxonomies = [];

	/**
	 * Add post types and meta boxes
	 *
	 * @return  void
	 * */
	public function __construct() {

		// add post types
		$this->add_post_types();

		// add taxonomies
		$this->add_taxonomies();

	}

	/**
	 * Adds post types
	 *
	 * @return  void
	 * @link   https://github.com/gizburdt/cuztom/wiki/Post-Types
	 * */
	public function add_post_types() {

		$this->post_types['book'] = new Cuztom_Post_Type( 'Book', array(
		    'has_archive' => true,
		    'supports' => array( 'title', 'editor', 'thumbnail' )
		) );

		// add meta boxes
		$this->add_meta_boxes();

	}

	/**
	 * Adds meta boxes
	 * 
	 * @return void
	 * @link https://github.com/gizburdt/cuztom/wiki/Meta-Boxes
	 */
	public function add_meta_boxes() {

		$this->post_types['book']->add_meta_box( 
		   	'meta_box_id',
		   	'Page Head', 
		    array(
		        array(
		            'name'          => 'bighead',
		            'label'         => 'Page Heading',
		            'description'   => 'Add a large Concise Heading',
		            'type'          => 'text'
		         ),
		         array(
		            'name'          => 'bigdescription',
		            'label'         => 'Page Description',
		            'description'   => 'Add a large Concise sub Heading',
	            	'type'          => 'textarea'
	         	)
	      	)
	   	);

	}

	/**
	 * Adds taxonomies
	 * 
	 * @return void
	 * @link https://github.com/gizburdt/cuztom/wiki/Taxonomies
	 */
	public function add_taxonomies() {
		$this->taxonomies['genre'] = new Cuztom_Taxonomy( 'Genre', 'book' );

		$this->add_taxonomy_meta_boxes();
	}

	/**
	 * Taxonomy meta boxes
	 *
	 * @return void
	 * @link https://github.com/gizburdt/cuztom/wiki/Term-Meta
	 **/
	public function add_taxonomy_meta_boxes() {
		$this->taxonomies['genre']->add_term_meta (
	        array(
	            array(
	                'name'        => 'genre_image',
	                'label'       => 'Author Image',
	                'description' => 'Featured Author Image',
	                'type'        => 'image'
	            )
	        )
	    );
	}

}
