<?php
#[\AllowDynamicProperties]
class reqPts {
   static protected $_requestData;
   static protected $_requestMethod;
   static protected $_allowedHtml;
   static public function init() {
   }
   static public function startSession() {
      if (!utilsPts::isSessionStarted()) {
         session_start();
      }
   }
   static public function supStrRgbToHex($color) {
    preg_match_all("/\((.+?)\)/", $color, $matches);
    if (!empty($matches[1][0])) {
     $rgb = explode(',', $matches[1][0]);
     $size = count($rgb);
     if ($size == 3 || $size == 4) {
       if ($size == 4) {
         $alpha = array_pop($rgb);
         $alpha = floatval(trim($alpha));
         $alpha = ceil(($alpha * (255 * 100)) / 100);
         array_push($rgb, $alpha);
       }

       $result = '#';
       foreach ($rgb as $row) {
         $result .= str_pad(dechex(trim($row)), 2, '0', STR_PAD_LEFT);
       }

       return $result;
     }
    }

    return false;
    }
   static public function sanitizeString($str) {
      $allowedHtml = self::getAllowedHtml();
      if (!empty($str) && is_string($str)) {
        $str = htmlspecialchars_decode($str);

        $re = '/rgb\s*\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\)/';
        $str = preg_replace_callback(
        $re,
        function($m) {
			       return self::supStrRgbToHex($m[0]);
        },
        $str);

        $re = '/rgba\s*\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*,\d*(?:\.\d+)?\)/';
        $str = preg_replace_callback(
        $re,
        function($m) {
			       return self::supStrRgbToHex($m[0]);
        },
        $str);

        $str = wp_kses($str, $allowedHtml);
      }
      return $str;
   }
   static public function getAllowedHtml() {
      if (empty(self::$_allowedHtml)) {
         $allowedHtml = wp_kses_allowed_html();

         $newAllowedHtml = array( 'li' => array( 'style' => 1, 'class' => 1, 'id' => 1, ) , 'ul' => array( 'style' => 1, 'class' => 1, 'id' => 1, ) , 'ol' => array( 'style' => 1, 'class' => 1, 'id' => 1, ) , 'i' => array( 'style' => 1, 'class' => 1, 'id' => 1, ) , 'img' => array( 'src' => 1, 'style' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'class' => 1, 'alt' => 1, 'border' => 1, ) , 'video' => array( 'src' => 1, 'style' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'class' => 1, 'poster' => 1, 'autoplay' => 1, 'controls' => 1, 'crossorigin' => 1, 'autobuffer' => 1, 'buffered' => 1, 'played' => 1, 'loop' => 1, 'muted' => 1, 'preload' => 1, ) , 'track' => array( 'src' => 1, 'kind' => 1, 'label' => 1, 'srclang' => 1, ) , 'source' => array( 'src' => 1, 'type' => 1, ) , 'audio' => array( 'src' => 1, 'style' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'class' => 1, 'autoplay' => 1, 'controls' => 1, 'crossorigin' => 1, 'loop' => 1, 'muted' => 1, 'preload' => 1, ) , 'iframe' => array( 'src' => 1, 'style' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'class' => 1, 'title' => 1, 'allow' => 1, 'allowfullscreen' => 1, 'allowpaymentrequest' => 1, 'csp' => 1, 'height' => 1, 'loading' => 1, 'name' => 1, 'referrerpolicy' => 1, 'sandbox' => 1, 'srcdoc' => 1, ) , );

         $allowedDiv = array( 'div' => array( 'data-number' => 1, 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'title' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-enb-color' => 1, 'data-enb-schedule' => 1, 'data-schedule-from' => 1, 'data-schedule-to' => 1, 'data-enb-badge' => 1, 'data-badge-badge_txt_color' => 1, 'data-badge-badge_bg_color' => 1, 'data-badge-badge_name' => 1, 'data-badge-badge_pos' => 1, 'data-old-number' => 1, 'data-selected-number' => 1, 'data-switch-type' => 1, 'data-toggle-0' => 1, 'data-toggle-1' => 1, 'data-toggle-2' => 1, 'data-toggle-3' => 1, 'data-toggle-4' => 1, 'data-toggle-5' => 1, 'data-toggle-6' => 1, 'data-toggle-7' => 1, 'data-toggle-8' => 1, 'data-toggle-9' => 1, 'data-toggle-10' => 1, ) , 'small' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ), 'span' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'pre' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'p' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'br' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'hr' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'hgroup' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'h1' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'h2' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'h3' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'h4' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'h5' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'h6' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'ul' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'ol' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'li' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'dl' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'dt' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'dd' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'strong' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'em' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'b' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'i' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'u' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'img' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'a' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'link' => 1, 'rel' => 1, 'href' => 1, 'target' => 1, ) , 'abbr' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'address' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'blockquote' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'area' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'audio' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'video' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'form' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'action' => 1, 'target' => 1, 'method' => 1, ) , 'fieldset' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'label' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'input' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'value' => 1, 'type' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'name' => 1, 'src' => 1, 'border' => 1, 'alt' => 1, 'name' => 1, 'maxlength' => 1, ) , 'textarea' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'caption' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'table' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'tbody' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'td' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'tfoot' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'th' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'thead' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'tr' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'iframe' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'select' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, ) , 'option' => array( 'style' => 1, 'title' => 1, 'align' => 1, 'class' => 1, 'width' => 1, 'height' => 1, 'id' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'data-type' => 1, 'data-el' => 1, 'data-color' => 1, 'data-icon' => 1, 'data-bgcolor-elements' => 1, 'data-bgcolor-to' => 1, 'data-mce-style' => 1, 'selected' => 1, 'data-number' => 1, 'value' => 1, ) , 'sup' => array( ) , 'sub' => array( ) , );

         $allowedHtml = array_merge($allowedHtml, $allowedDiv);
         self::$_allowedHtml = array_merge($allowedHtml, $newAllowedHtml);
      }
      return self::$_allowedHtml;
   }

   static public function sanitize_array(&$array, $parentKey = '') {
      $allowed = '<div>,<span>,<pre>,<p>,<small>,<br>,<hr>,<hgroup>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,
        <ul>,<ol>,<li>,<dl>,<dt>,<dd>,<strong>,<em>,<b>,<i>,<u>,
        <img>,<a>,<abbr>,<address>,<blockquote>,<area>,<audio>,<video>,
        <form>,<fieldset>,<label>,<input>,<textarea>,
        <caption>,<table>,<tbody>,<td>,<tfoot>,<th>,<thead>,<tr>,
        <iframe>,<select>,<option>';
      foreach ($array as $key => &$value) {
         // $keys = array(
         //    'txt_item_html',
         //    'img_item_html',
         //    'icon_item_html',
         //    'new_cell_html',
         //    'new_column_html'
         // );
         // if ((in_array($parentKey, $keys) && $key == 'val') || $key == 'html') {
         //    $re = '/data-toggle-[0-9]+=\\\\"(.*?)\\\\"/m';
         //    $newValue = preg_replace_callback($re, function ($matches) {
         //       $patterns[0] = '/</';
         //       $patterns[1] = '/>/';
         //       $replacements[1] = '&lt;';
         //       $replacements[0] = '&gt;';
         //       $string = preg_replace($patterns, $replacements, $matches[0]);
         //       return $string;
         //    }
         //    , $value);
         //    $value = $newValue;
         //    $value = strip_tags($value, $allowed);
         //    $value = self::sanitizeString($value);
         // }
         // else {
            if (!is_array($value)) {
               $value = self::sanitizeString($value);
            } else {
               $parentKey = $key;
               self::sanitize_array($value, $parentKey);
            }
         //}
      }
      return $array;
   }

   static public function getVar($name, $from = 'all', $default = NULL) {
      $from = strtolower($from);
      if ($from == 'all') {
         if (isset($_GET[$name])) {
            $from = 'get';
         }
         elseif (isset($_POST[$name])) {
            $from = 'post';
         }
      }

      switch ($from) {
         case 'get':
            if (isset($_GET[$name])) {
               if (is_array($_GET[$name])) {
                  return self::sanitize_array($_GET[$name]);
               }
               else {
                  return sanitize_text_field($_GET[$name]);
               }
            }
         break;
         case 'post':
            if (isset($_POST[$name])) {
               if (is_array($_POST[$name])) {
                  return self::sanitize_array($_POST[$name]);
               }
               else {
                  return sanitize_text_field($_POST[$name]);
               }
            }
         break;
         case 'session':
            if (isset($_SESSION[$name])) {
               if (is_array($_SESSION[$name])) {
                  return self::sanitize_array($_SESSION[$name]);
               }
               else {
                  return sanitize_text_field($_SESSION[$name]);
               }
            }
         break;
         case 'server':
            if (isset($_SERVER[$name])) {
               if (is_array($_SERVER[$name])) {
                  return self::sanitize_array($_SERVER[$name]);
               }
               else {
                  return sanitize_text_field($_SERVER[$name]);
               }
            }
         break;
         case 'cookie':
            if (isset($_COOKIE[$name])) {
               $value = sanitize_text_field($_COOKIE[$name]);
               if (strpos($value, '_JSON:') === 0) {
                  $value = utilsPts::jsonDecode(sanitize_text_field($value), array_pop(explode('_JSON:', sanitize_text_field($value))));
               }
               if (is_array($value)) {
                  $value = sanitize_array($value);
               }
               else if (is_string($value)) {
                  $value = sanitize_text_field($value);
               }
               return $value;
            }
            break;
         }
         return $default;
   }
   static public function isEmpty($name, $from = 'all') {
      $val = self::getVar($name, $from);
      return empty($val);
   }
   static public function setVar($name, $val, $in = 'input', $params = array()) {
      $in = strtolower($in);
      if (is_array($val)) {
         $val = $this->sanitize_array($val);
      }
      else {
         $val = sanitize_text_field($val);
      }
      switch ($in) {
         case 'get':
            $_GET[$name] = $val;
         break;
         case 'post':
            $_POST[$name] = $val;
         break;
         case 'session':
            $_SESSION[$name] = $val;
         break;
         case 'cookie':
            $expire = isset($params['expire']) ? time() + $params['expire'] : 0;
            $path = isset($params['path']) ? $params['path'] : '/';
            if (is_array($val) || is_object($val)) {
               $saveVal = '_JSON:' . utilsPts::jsonEncode($val);
            }
            else {
               $saveVal = $val;
            }
            setcookie($name, $saveVal, $expire, $path);
         break;
      }
   }
   static public function clearVar($name, $in = 'input', $params = array()) {
      $in = strtolower($in);
      switch ($in) {
         case 'get':
            if (isset($_GET[$name])) unset($_GET[$name]);
            break;
         case 'post':
            if (isset($_POST[$name])) unset($_POST[$name]);
            break;
         case 'session':
            if (isset($_SESSION[$name])) unset($_SESSION[$name]);
            break;
         case 'cookie':
            $path = isset($params['path']) ? $params['path'] : '/';
            setcookie($name, '', time() - 3600, $path);
            break;
         }
      }
      static public function get($what) {
         $what = strtolower($what);
         switch ($what) {
            case 'get':
               if (is_array($_GET)) {
                  return self::sanitize_array($_GET);
               }
               else {
                  return sanitize_text_field($_GET);
               }
            break;
            case 'post':
               if (is_array($_POST)) {
                  return self::sanitize_array($_POST);
               }
               else {
                  return sanitize_text_field($_POST);
               }
            break;
            case 'session':
               if (is_array($_SESSION)) {
                  return self::sanitize_array($_SESSION);
               }
               else {
                  return sanitize_text_field($_SESSION);
               }
            break;
         }
         return NULL;
      }
      static public function getMethod() {
         if (!self::$_requestMethod) {
            self::$_requestMethod = strtoupper(self::getVar('method', 'all', $_SERVER['REQUEST_METHOD']));
         }
         return self::$_requestMethod;
      }
      static public function getAdminPage() {
         $pagePath = self::getVar('page');
         if (!empty($pagePath) && strpos($pagePath, '/') !== false) {
            $pagePath = explode('/', $pagePath);
            return str_replace('.php', '', $pagePath[count($pagePath) - 1]);
         }
         return false;
      }
      static public function getRequestUri() {
         return $_SERVER['REQUEST_URI'];
      }
      static public function getMode() {
         $mod = '';
         if (!($mod = self::getVar('mod'))) //Frontend usage
         $mod = self::getVar('page'); //Admin usage
         return $mod;
      }
   }
