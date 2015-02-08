<?php

function ace_theme_selector_options(){
	$current_user = wp_get_current_user();
	$theme = get_user_meta( $current_user->ID, 'ecsl-ace-editor-theme', true );

	$available_themes = apply_filters( 'ecsl_available_ace_themes', array(
		array(
			'label' => __( 'Bright' ),
			'options' => array(
				'ace/theme/chrome' => __( 'Chrome' ),
				'ace/theme/clouds' => __( 'Clouds' ),
				'ace/theme/crimson_editor' => __( 'Crimson Editor' ),
				'ace/theme/dawn' => __( 'Dawn' ),
				'ace/theme/dreamweaver' => __( 'Dreamweaver' ),
				'ace/theme/eclipse' => __( 'Eclipse' ),
				'ace/theme/github' => __( 'GitHub' ),
				'ace/theme/solarized_light' => __( 'Solarized Light' ),
				'ace/theme/textmate' => __( 'TextMate' ),
				'ace/theme/tomorrow' => __( 'Tomorrow' ),
				'ace/theme/xcode' => __( 'XCode' ),
				'ace/theme/kuroir' => __( 'Kuroir' ),
				'ace/theme/katzenmilch' => __( 'KatzenMilch' ),
			),
		),
		array(
			'label' => __( 'Dark' ),
			'options' => array(
				'ace/theme/ambiance' => __( 'Ambiance' ),
				'ace/theme/chaos' => __( 'Chaos' ),
				'ace/theme/clouds_midnight' => __( 'Clouds Midnight' ),
				'ace/theme/cobalt' => __( 'Cobalt' ),
				'ace/theme/idle_fingers' => __( 'idle Fingers' ),
				'ace/theme/kr_theme' => __( 'krTheme' ),
				'ace/theme/merbivore' => __( 'Merbivore' ),
				'ace/theme/merbivore_soft' => __( 'Merbivore Soft' ),
				'ace/theme/mono_industrial' => __( 'Mono Industrial' ),
				'ace/theme/monokai' => __( 'Monokai' ),
				'ace/theme/pastel_on_dark' => __( 'Pastel on dark' ),
				'ace/theme/solarized_dark' => __( 'Solarized Dark' ),
				'ace/theme/terminal' => __( 'Terminal' ),
				'ace/theme/tomorrow_night' => __( 'Tomorrow Night' ),
				'ace/theme/tomorrow_night_blue' => __( 'Tomorrow Night Blue' ),
				'ace/theme/tomorrow_night_bright' => __( 'Tomorrow Night Bright' ),
				'ace/theme/tomorrow_night_eighties' => __( 'Tomorrow Night 80s' ),
				'ace/theme/twilight' => __( 'Twilight' ),
				'ace/theme/vibrant_ink' => __( 'Vibrant Ink' ),
			),
		),
	) );

	$output = '';
	foreach ( $available_themes as $theme_group ){
		$options = $theme_group['options'];
		$output .= "<optgroup label='{$theme_group['label']}' >";

		foreach ( $options as $value => $name ){
			$selected = selected( $theme, $value, false );
			$output .= "<option value='$value' $selected >$name</option>";
		}
		$output .= "</optgroup>";
	}
	return $output;
}