<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
 
/**
 * hook_preprocess_html
 */
function bakkevej_preprocess_html(&$variables) {
	
	/* Add Google Web Font */
	drupal_add_css('http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic', array('type' => 'external'));
	
	/**
	 * COLOR THEMES + PATTERNS
	 */
	global $user;
	$account = user_load($user->uid);
	
	// COLORS
	if(isset($account->field_user_theme[LANGUAGE_NONE][0]["value"])) {
		switch($account->field_user_theme[LANGUAGE_NONE][0]["value"]) {
		case "red":
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/color_red.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		case "green":
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/color_green.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		case "blue":
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/color_blue.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		default:
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/color_red.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		}
	}
	else {
		drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/color_red.css', array('group' => 2000, 'every_page' => TRUE, 'weight' => 100));	
	}
	// BACKGROUND PATTERNS
	if(isset($account->field_user_pattern[LANGUAGE_NONE][0]["value"])) {
		switch($account->field_user_pattern[LANGUAGE_NONE][0]["value"]) {
		case "lines":
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/bg_lines.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		case "checkers":
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/bg_checkers.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		case "circles":
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/bg_circles.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		default:
			drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/bg_lines.css', array('group' => 2000, 'every_page' => TRUE));
		break;
		}
	}
	else {
		drupal_add_css(drupal_get_path('theme', 'bakkevej') . '/css/bg_lines.css', array('group' => 2000, 'every_page' => TRUE, 'weight' => 100));	
	}
}

/**
 * hook_form_alter
 */
function bakkevej_form_alter(&$form, $form_state, $form_id) { 
	/* Login */
	if($form_id=="user_login") {
		unset($form["name"]["#title"]);
		unset($form["name"]["#description"]);
		unset($form["pass"]["#title"]);
		unset($form["pass"]["#description"]);
		$form["name"]["#attributes"]['placeholder'] = "Brugernavn";
		$form["pass"]["#attributes"]['placeholder'] = "Adgangskode";
		/*
		$form['name']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Brugernavn';}";
      $form['name']['#attributes']['onfocus'] = "if (this.value == 'Brugernavn') {this.value = '';}";
		*/
	}
	/* Calendar admin */
	if($form["#id"] == "views-exposed-form-calendar-administrator-page-5") {
		$form["combine"]["#attributes"]['placeholder'] = "Indtast søgeord";
		$form["submit"]["#value"] = "";
	}
	/* Video View */
	if($form["#id"] == "views-exposed-form-videos-page") {
		$form["submit"]["#value"] = "";
		$form["combine"]["#attributes"]['placeholder'] = "Indtast søgeord";
	}
}

function bakkevej_theme() {
	$items = array();
	// create custom user-login.tpl.php
	$items['user_login'] = array(
		'render element' => 'form',
		'path' => drupal_get_path('theme', 'bakkevej') . '/templates',
		'template' => 'user-login',
		'preprocess functions' => array(
			'bakkevej_preprocess_user_login'
		),
	);
	return $items;
}

/**
 * CALENDAR TITLES
 */
function bakkevej_date_nav_title($params) {
  $granularity = $params['granularity'];
  $view = $params['view'];
  $date_info = $view->date_info;
  $link = !empty($params['link']) ? $params['link'] : FALSE;
  $format = !empty($params['format']) ? $params['format'] : NULL;
  switch ($granularity) {
    case 'year':
      $title = $date_info->year;
      $date_arg = $date_info->year;
      break;
    case 'month':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'F Y' : 'F Y');
      $title = date_format_date($date_info->min_date, 'custom', $format);
      $date_arg = $date_info->year . '-' . date_pad($date_info->month);
      break;
    case 'day':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'l, d. F' : 'l, F j');
      $title = date_format_date($date_info->min_date, 'custom', $format);
      $date_arg = $date_info->year . '-' . date_pad($date_info->month) . '-' . date_pad($date_info->day);
      break;
    case 'week':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'W, Y' : 'F j');
      $title = t('Week @date', array('@date' => date_format_date($date_info->min_date, 'custom', $format)));
      $date_arg = $date_info->year . '-W' . date_pad($date_info->week);
      break;
  }
  if (!empty($date_info->mini) || $link) {
    // Month navigation titles are used as links in the mini view.
    $attributes = array('title' => t('View full page month'));
    $url = date_pager_url($view, $granularity, $date_arg, TRUE);
    return l($title, $url, array('attributes' => $attributes));
  }
  else {
    return $title;
  }
}

/**
 * TEXTAREAS
 */
function bakkevej_textarea($variables) {
  $element = $variables['element'];
  $element['#attributes']['name'] = $element['#name'];
  $element['#attributes']['id'] = $element['#id'];
  $element['#attributes']['cols'] = $element['#cols'];
  $element['#attributes']['rows'] = 8;
  _form_set_class($element, array('form-textarea'));
 
  $wrapper_attributes = array(
    'class' => array('form-textarea-wrapper'),
  );
 
  // Add resizable behavior.
  if (!empty($element['#resizable'])) {
    $wrapper_attributes['class'][] = 'resizable';
  }
 
  $output = '<div' . drupal_attributes($wrapper_attributes) . '>';
  $output .= '<textarea' . drupal_attributes($element['#attributes']) . '>' . check_plain($element['#value']) . '</textarea>';
  $output .= '</div>';
  return $output;
}

/**
 * MAIN MENU
 */
function bakkevej_menu_link(array $variables) {
		
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
       
  switch($element["#title"]) {
  	case "Kalender":
  		$class = "menu-calendar";
  		if(in_array("active",$element['#attributes']['class']) || in_array("active-trail",$element['#attributes']['class'])) $class .= "-active";
		$element["#localized_options"]["attributes"]["class"][] = $class;
  	break;
  	case "Video":
  		$class = "menu-video";
  		if(in_array("active",$element['#attributes']['class']) || in_array("active-trail",$element['#attributes']['class'])) $class .= "-active";
		$element["#localized_options"]["attributes"]["class"][] = $class;  	
	break;
  	case "Profil":
  		$class = "menu-home";
  		if(in_array("active",$element['#attributes']['class']) || in_array("active-trail",$element['#attributes']['class'])) $class .= "-active";
		$element["#localized_options"]["attributes"]["class"][] = $class;  	
	break;
  	case "Indstillinger":
  		$class = "menu-settings";
  		if(in_array("active",$element['#attributes']['class']) || in_array("active-trail",$element['#attributes']['class'])) $class .= "-active";
		$element["#localized_options"]["attributes"]["class"][] = $class;  	
	break;
  }
    
  if(isset($element["#bid"]) && $element["#bid"]["module"]=="menu_block" && $element["#original_link"]["depth"] == 1) {
	if($element["#title"]=="Indstillinger" && $element["#bid"]["delta"]==2) {
		$element['#localized_options']["fragment"] = "settings";
		$element['#localized_options']["external"] = true;
	}
	$output = l("", $element['#href'], $element['#localized_options']);
  }
  else {
  	$output = l($element['#title'], $element['#href'], $element['#localized_options']);
  }
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";  

}

/**
 * FIELDS
 */
function bakkevej_preprocess_field(&$vars) {

  // Add line breaks to plain text textareas.
  if (
    // Make sure this is a text_long field type.
    $vars['element']['#field_type'] == 'text_with_summary'
    // Check that the field's format is set to null, which equates to plain_text.
    && $vars['element']['#items'][0]['format'] == null
  ) {
    $vars['items'][0]['#markup'] = nl2br($vars['items'][0]['#markup']);
  }

	/* Pictogram */
	switch($vars["field_name_css"]) {
		case "field-event-category":
			
			$term = $vars['element']['#items'][0]['taxonomy_term'];
			$text = $term->field_cat_machine_name[LANGUAGE_NONE][0]['value'];
			
			$vars["items"][0]["#markup"] = "";
			$vars["classes_array"][] = "picto-large";
			$vars["classes_array"][] = "picto-large-".$text;
		break;
	}
	
	/* Dato label */
	if($vars["field_name_css"]=="field-event-date") {
		$vars["label"] = "Tid";
	}
}