<?php
#[\AllowDynamicProperties]
class dbPts {
   static public $query = '';
   static public function query($query) {
   }
   static public function insertID() {
      global $wpdb;
      return $wpdb->insert_id;
   }
   static public function numRows() {
      global $wpdb;
      return $wpdb->num_rows;
   }
   static public function prepareQuery($query) {
      global $wpdb;
      return str_replace(array(
         '#__',
         '^__',
         '@__'
      ) , array(
         $wpdb->prefix,
         PTS_DB_PREF,
         $wpdb->prefix . PTS_DB_PREF
      ) , $query);
   }
   static public function getError() {
      global $wpdb;
      return $wpdb->last_error;
   }
   static public function lastID() {
      global $wpdb;
      return $wpdb->insert_id;
   }
   static public function timeToDate($timestamp = 0) {
      if ($timestamp) {
         if (!is_numeric($timestamp)) $timestamp = dateToTimestampPts($timestamp);
         return date('Y-m-d', $timestamp);
      }
      else {
         return date('Y-m-d');
      }
   }
   static public function dateToTime($date) {
      if (empty($date)) return '';
      if (strpos($date, PTS_DATE_DL)) return dateToTimestampPts($date);
      $arr = explode('-', $date);
      return dateToTimestampPts($arr[2] . PTS_DATE_DL . $arr[1] . PTS_DATE_DL . $arr[0]);
   }
   static public function exist($table) {
      global $wpdb;
      switch ($table) {
         case 'pts_tables':
            $res = $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}pts_tables'");
         break;
         case 'pts_modules':
            $res = $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}pts_modules'");
         break;
         case 'pts_modules_type':
            $res = $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}pts_modules_type'");
         break;
         case 'pts_usage_stat':
            $res = $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}pts_usage_stat'");
         break;
      }
      return !empty($res);
   }
   static public function prepareHtml($d) {
      if (is_array($d)) {
         foreach ($d as $i => $el) {
            $d[$i] = self::prepareHtml($el);
         }
      }
      else {
         $d = esc_html($d);
      }
      return $d;
   }
   static public function prepareHtmlIn($d) {
      if (is_array($d)) {
         foreach ($d as $i => $el) {
            $d[$i] = self::prepareHtml($el);
         }
      }
      else {
         $d = wp_filter_nohtml_kses($d);
      }
      return $d;
   }
   static public function escape($data) {
      global $wpdb;
      return $wpdb->_escape($data);
   }
}
