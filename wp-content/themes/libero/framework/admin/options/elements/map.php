<?php

if ( ! function_exists('libero_mikado_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function libero_mikado_load_elements_map() {

		libero_mikado_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => esc_html__( 'Elements', 'libero' ),
				'icon' => 'icon_genius'
			)
		);

		do_action( 'libero_mikado_options_elements_map' );

	}

	add_action('libero_mikado_options_map', 'libero_mikado_load_elements_map',9);

}

if ( ! function_exists('libero_mikado_parallax_options_map') ) {
    /**
     * Parallax options page
     */
    function libero_mikado_parallax_options_map()
    {

        $panel_parallax = libero_mikado_add_admin_panel(
            array(
                'page'  => '_elements_page',
                'name'  => 'panel_parallax',
                'title' => esc_html__( 'Parallax', 'libero' )
            )
        );

        libero_mikado_add_admin_field(array(
            'type'			=> 'onoff',
            'name'			=> 'parallax_on_off',
            'default_value'	=> 'off',
            'label' => esc_html__( 'Parallax on touch devices', 'libero' ),
            'description' => esc_html__( 'Enabling this option will allow parallax on touch devices', 'libero' ),
            'parent'		=> $panel_parallax
        ));

        libero_mikado_add_admin_field(array(
            'type'			=> 'text',
            'name'			=> 'parallax_min_height',
            'default_value'	=> '100',
            'label' => esc_html__( 'Parallax Min Height', 'libero' ),
            'description' => esc_html__( 'Set a minimum height for parallax images on small displays (phones, tablets, etc.)', 'libero' ),
            'args'			=> array(
                'col_width'	=> 3,
                'suffix'	=> 'px'
            ),
            'parent'		=> $panel_parallax
        ));

    }

    add_action('libero_mikado_options_elements_map', 'libero_mikado_parallax_options_map', 4);

}