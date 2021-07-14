<?php

class Customizer_Searchable_Dropdown_Control extends \WP_Customize_Control {

	public $options = array();

	public function enqueue() {
		wp_enqueue_script(
			'customizer-searchable-dropdown-control-js',
			$this->abs_path_to_url( dirname( __FILE__ ) . '/js/customizer-searchable-dropdown-control.js' ),
			array( 'jquery' ), rand(), true
		);
		wp_enqueue_style(
			'customizer-searchable-dropdown-control-css',
			$this->abs_path_to_url( dirname( __FILE__ ) . '/css/customizer-searchable-dropdown-control.css' ),
			array(), rand()
		);
	}

	private function render_dropdown( $options ) {
		foreach ( $options as $option ) {
			?>
            <li class="customizer-dropdown-item"><?= esc_html( $option ) ?></li>
			<?php
		}
	}

	public function render_content() {
		?>

        <label class="customize-searchable-dropdown-label">
            <div class="customize-searchable-dropdown-control-container">
                <span class="customize-control-title"><?= esc_html( $this->label ) ?></span>

				<?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?= esc_html( $this->description ) ?></span>
				<?php endif; ?>

                <input class="customizer-searchable-dropdown-input"
                       id="dropdown-<?= $this->instance_number; ?>"
                       type="text"
                       value="<?= esc_attr( $this->value() ) ?>"
                       readonly
					<?php $this->link(); ?> />

                <div class="customizer-searchable-dropdown-content" style="display: none;">
                    <input class="customizer-searchable-dropdown-search"
                           id="dropdown-search-<?= $this->instance_number; ?>" type="text"
                           placeholder="Search for fonts...">
                    <ul class="customizer-searchable-dropdown-options"
                        id="dropdown-options-dropdown-<?= $this->instance_number; ?>">
						<?php $this->render_dropdown( $this->options ) ?>
                    </ul>
                </div>
            </div>
        </label>

		<?php
	}

	/**
	 * Plugin / theme agnostic path to URL
	 *
	 * @see https://wordpress.stackexchange.com/a/264870/14546
	 *
	 * @param string $path file path
	 *
	 * @return string       URL
	 */
	private function abs_path_to_url( $path = '' ) {
		$url = str_replace(
			wp_normalize_path( untrailingslashit( ABSPATH ) ),
			site_url(),
			wp_normalize_path( $path )
		);

		return esc_url_raw( $url );
	}

}