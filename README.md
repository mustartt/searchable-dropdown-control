# searchable-dropdown-control

A searchable dropdown for wordpress customizer control

## Screenshot

What it looks like in the Wordpress Customizer

![Screenshot](https://i.imgur.com/nVjCVXD.png)

## Example Usage

Include in `functions.php` if the package is installed under `inc`
```php
if ( class_exists( 'WP_Customize_Control' ) ) {
	require_once dirname( __FILE__ ) . '/inc/searchable-dropdown-control/searchable-dropdown-control.php';
}
```

Usage for `customizer.php`
```php
$wp_customize->add_setting(
    'font',
    array(
        'default'           => 'Roboto',
        'sanitize_callback' => function ( $value ) {
            return $value;
        }
    )
);

$wp_customize->add_control(
    new Customizer_Searchable_Dropdown_Control(
        $wp_customize,
        'font',
        array(
            'label'    => 'Select Font',
            'section'  => 'fonts',
            'settings' => 'font',
            'options'  => array(
                'Roboto', 'Arial', 'Helvetica', 'Calibri'
            )
        )
    )
);
```
