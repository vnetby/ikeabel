<?php

add_action('wp_ajax_get_calc_settings', 'get_cacl_settings_ajax');
add_action('wp_ajax_nopriv_get_calc_settings', 'get_cacl_settings_ajax');

add_action('wp_ajax_parse_site', 'parse_site');
add_action('wp_ajax_nopriv_parse_site', 'parse_site');

add_action('wp_ajax_send_order_data', 'send_order_data');
add_action('wp_ajax_nopriv_send_order_data', 'send_order_data');

require(dirname(__FILE__) . '/inc/globals.php');



if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Настройки доставки и калькулятора',
		'menu_title'	=> 'Доставка',
		'menu_slug' 	=> 'shipping_settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'icon_url' => 'dashicons-archive'
	));
}






function send_order_data()
{
	$data = json_decode(stripslashes($_POST['data']), true);
	$sets = get_calc_settings();

	$name    = get_from_array($data, 'name');
	$phone   = get_from_array($data, 'phone');
	$email   = get_from_array($data, 'email');
	$address = get_from_array($data, 'address');

	$errors = [];

	if (!$name) $errors[]    = 'name';
	if (!$phone) $errors[]   = 'phone';
	if (!$email) $errors[]   = 'email';
	if (!$address) $errors[] = 'address';

	if (count($errors)) {
		the_response_json(['type' => 'error', 'inputs' => $errors, 'msg' => $sets['MESS']['required_field']]);
	}

	ob_start();
	require(dirname(__FILE__) . '/calculator-templates/template_email_admin.php');
	$admin_email = ob_get_clean();

	ob_start();
	require(dirname(__FILE__) . '/calculator-templates/template_email_client.php');
	$client_email = ob_get_clean();


	$headers = "From: " . $sets['admin_email'] . "\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	mail($sets['admin_email'], "Заказ с сайта", $admin_email, $headers);
	mail($email, "Детали заказа", $client_email, $headers);

	the_response_json(['type' => 'success']);
	exit;
}






function the_response_json($arr)
{
	echo json_encode($arr);
	exit;
}






function parse_site()
{
	$id_product   = $_POST['link'];
  $res          = array();
  $res['error'] = '0';


  $sets = get_calc_settings();
  $course = (float) $sets['course'];

  $url = urldecode($id_product);


  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  $output = curl_exec($curl);
  curl_close($curl);

  if (!$output) {
    $res['error'] = 1;
    echo json_encode($res);
    exit;
  }

  preg_match("/<[\s]*script[\s]*type[\s]*=[\s]*\"[\s]*application\/ld\+json[\s]*\"[\s]*>(.*?)<\/script>/us", $output, $matches);

  if (!isset($matches[1])) {
    $res['error'] = 1;
    echo json_encode($res);
    exit;
  }

  try {
    $data = json_decode(trim($matches[1]), true);
  } catch (Exception $e) {
    $res['error'] = 1;
    echo json_encode($res);
    exit;
  }

	// print_r ($data);
	// exit;

  $offers = get_from_array($data, 'offers');
  $ruPrice = get_from_array($offers, 'price');
	if (!$ruPrice) {
		$ruPrice = get_from_array($offers, 'lowPrice');
	}
  if ($ruPrice) {
    $res['cost'] = round((float) $ruPrice * $course, 2);
  }
  $res['name'] = get_from_array($data, 'name');

  $images = get_from_array($data, 'image');

  if (is_array($images)) {
    if (isset ($images[0])) {
      $res['image'] = $images[0];
    }
  }

  $res['prodId'] = get_from_array($data,'sku');


  // $doc = new DOMDocument();
  // libxml_use_internal_errors(true);
  //
  // $doc->loadHTML($output);
  // $metas = $doc->getElementsByTagName('meta');


  // foreach ($metas as $meta) {
  //
  //   if ($meta->getAttribute('itemprop') === 'price') {
  //     $str = $meta->getAttribute('content');
  //     $res['cost']  = round((int) $str * $course, 2);
  //   }
  //
  //   if ($meta->getAttribute('itemprop') === 'name') {
  //     $str = $meta->getAttribute('content');
  //     if ($str === 'IKEA') continue;
  //     $res['name']  = $str;
  //   }
  //
  //   if ($meta->getAttribute('itemprop') === 'image') {
  //     $res['image'] = $meta->getAttribute('content');
  //   }
  //
  //   if ($meta->getAttribute('itemprop') === 'productID') {
  //     $res['prodId'] = $meta->getAttribute('content');
  //   }
  // }

  if (empty($res['cost']) || empty($res['name'])) {
    $res['error'] = '1';
    echo json_encode($res);
    exit;
  }

  if (empty($res['image'])) {
    $res['image'] = 'images/noimage.png';
  }

  $res['quantity'] = $_POST['number'];

  $res['total'] = round((int) $res['quantity'] * $res['cost'], 2);

  $res['link'] = $_POST['link'];
  // print_r ($res);
  // exit;
  echo json_encode($res);
  exit;
}





function get_cacl_settings_ajax()
{
	$settings = get_calc_settings();
	if (!$settings) exit;
	echo json_encode($settings);
	exit;
}




function get_calc_settings()
{
	$tarifs = get_field('ship_tarifs', 'option');
	$settings = get_field('calc_settings', 'option');
	$mess = get_field('calc_messages', 'option');

	if (!is_array($tarifs) || !is_array($settings) || !is_array($settings))  return false;

	$settings['prices'] = [];
	$settings['prices']['ikeai_shipping_price_start'] = array_column($tarifs, 'from');
	$settings['prices']['ikeai_shipping_price_end'] = array_column($tarifs, 'to');
	$settings['prices']['ikeai_shipping_price_percent'] = array_column($tarifs, 'percent');

	$settings['MESS'] = $mess;

	$settings['SRC'] = CURRENT_SRC;
	return $settings;
}


function ikea_get_tarifs()
{
	$tarifs = get_field('ship_tarifs', 'options');
	if (!is_array($tarifs)) return false;
	return $tarifs;
}






function get_page_head_sets(&$post)
{
	$head = get_field('page_header', $post->ID);
	$title = false;
	$subtitle = false;
	$bg = false;
	if ($head) {
		$title = get_from_array($head, 'title');
		$subtitle = get_from_array($head, 'subtitle');
		$bg = get_from_array($head, 'bg');
	}
	$title = $title ? $title : $post->post_title;
	$bg = $bg ? $bg : get_the_post_thumbnail_url($post->ID);
	return [
		'title' => $title,
		'subtitle' => $subtitle,
		'breadcrumbs' => true,
		'bg' => $bg
	];
}
