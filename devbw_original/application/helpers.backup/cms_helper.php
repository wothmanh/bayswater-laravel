<?php

	function clean_tag_htmlspc($str)
	{
		$str_t = strip_tags ($str);
		return htmlspecialchars($str_t);
	}

	function paginate_it($url, $per_page, $total_rows, $sgmnt, $additional) 
	{
		$ci                          =& get_instance();
		if ($additional == 'rqs') {
			$config["reuse_query_string"] = TRUE;
		}
		$config['base_url'] = base_url().$url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';  
        $config['uri_segment'] = $sgmnt;

        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

        $ci->pagination->initialize($config); 
        $str_links = $ci->pagination->create_links();

        $data['page'] =  ($ci->uri->segment($sgmnt)) ? $ci->uri->segment($sgmnt) : 0;
        $data['links'] =  explode('&nbsp;',$str_links );
        $data['per_page'] =  $config['per_page'];
        return $data;
	}




	function img_type($filename, $text_to_add) 
	{
		$extension_pos = strrpos($filename, '.'); 
		$thumb = substr($filename, 0, $extension_pos) . $text_to_add . substr($filename, $extension_pos);
		return $thumb;
	}

	function short_text($input, $maxWords, $maxChars) 
	{
	    $words = preg_split('/\s+/', $input);
	    $words = array_slice($words, 0, $maxWords);
	    $words = array_reverse($words);
	    $chars = 0;
	    $truncated = array();
	    while(count($words) > 0)
	    {
	        $fragment = trim(array_pop($words));
	        $chars += strlen($fragment);
	        if($chars > $maxChars) break;
	        $truncated[] = $fragment;
	    }
	    $result = implode(' ', $truncated);
	    return strip_tags($result . ($input == $result ? ' '  : ' ...'));
	}

	function mondo_eng($ptime) 
	{
	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return '0 Second';
	    }

	    $a = array( 12 * 30 * 24 * 60 * 60  =>  'Year',
	                30 * 24 * 60 * 60       =>  'Month',
	                24 * 60 * 60            =>  'Day',
	                60 * 60                 =>  'Hour',
	                60                      =>  'Minute',
	                1                       =>  'Second'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
	        }
	    }
	}


	function mondo_arb($ptime)
	{
	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return '0 ثانيه';
	    }

	    $a = array( 12 * 30 * 24 * 60 * 60  =>  'سنة',
	                30 * 24 * 60 * 60       =>  'شهر',
	                24 * 60 * 60            =>  'يوم',
	                60 * 60                 =>  'ساعة',
	                60                      =>  'دقيقة',
	                1                       =>  'ثانيه'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' مضت';
	        }
	    }
	}




function add_meta_title ($string)
{
	$CI =& get_instance();
	$CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit ($uri)
{
	return anchor($uri, '<i class="fa fa-edit"></i>');
}

function btn_delete ($uri)
{
	return anchor($uri, '<i class="fa fa-remove"></i>', array(
		'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
	));
}

function article_link($article){
	return 'article/' . intval($article->id) . '/' . e($article->slug);
}
function article_links($articles){
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '</li>';
	}
	$string .= '</ul>';
	return $string;
}

function get_excerpt($article, $numwords = 50){
	$string = '';
	$url = article_link($article);
	$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
	$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
	return $string;
}

function limit_to_numwords($string, $numwords){
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function e($string){
	return htmlentities($string);
}

function get_menu ($array, $child = FALSE)
{
	$CI =& get_instance();
	$str = '';
	
	if (count($array)) {
		$str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
		
		foreach ($array as $item) {
			
			$active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
			if (isset($item['children']) && count($item['children'])) {
				$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
				$str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '">' . e($item['title']);
				$str .= '<b class="caret"></b></a>' . PHP_EOL;
				$str .= get_menu($item['children'], TRUE);
			}
			else {
				$str .= $active ? '<li class="active">' : '<li>';
				$str .= '<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
			}
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ul>' . PHP_EOL;
	}
	
	return $str;
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}