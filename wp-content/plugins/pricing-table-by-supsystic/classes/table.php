<?php
#[\AllowDynamicProperties]
abstract class tablePts {
   protected $_id = '';
   protected $_table = '';
   protected $_fields = array();
   protected $_alias = '';
   protected $_join = array();
   protected $_limit = '';
   protected $_order = '';
   protected $_group = '';
   protected $_errors = array();
   protected $_escape = false;
   protected $_limitFrom = '';
   protected $_limitTo = '';
   static public function getInstance($table = '') {
      static $instances = array();
      if (!$table) {
         throw new Exception('Unknown table [' . $table . ']');
      }
      if (!isset($instances[$table])) {
         $class = 'table' . strFirstUp($table) . strFirstUp(PTS_CODE);
         if (class_exists($class)) $instances[$table] = new $class();
         else $instances[$table] = NULL;
      }
      return $instances[$table];
   }
   static public function _($table = '') {
      return self::getInstance($table);
   }
   public function getTable($transform = false) {
      if ($transform) return dbPts::prepareQuery($this->_table);
      else return $this->_table;
   }
   public function setTable($table) {
      $this->_table = $talbe;
   }
   public function getID() {
      return $this->_id;
   }
   public function setID($id) {
      $this->_id = $id;
   }
   public function getAll($fields = '*') {
      return $this->get($fields);
   }
   public function supGetById($id, $fields = '*', $return = 'row') {
      $condition = 'WHERE ' . $this->_alias . '.' . $this->_id . ' = "' . (int)$id . '"';
      return $this->get($fields, $condition, NULL, $return);
   }
   public function insert($data) {
      return $this->store($data);
   }
   protected function _addField($name, $html = 'text', $type = 'other', $default = '', $label = '', $maxlen = 0, $dbAdapt = '', $htmlAdapt = '', $description = '') {
      $this->_fields[$name] = toeCreateObjPts('fieldPts', array(
         $name,
         $html,
         $type,
         $default,
         $label,
         $maxlen,
         $dbAdapt,
         $htmlAdapt,
         $description
      ));
      return $this;
   }
   public function addField() {
      $args = func_get_args();
      return call_user_func_array(array(
         $this,
         '_addField'
      ) , $args);
   }
   public function getFields() {
      return $this->_fields;
   }
   public function getField($name) {
      return $this->_fields[$name];
   }
   public function exists($value, $field = '') {
      if (!$field) $field = $this->_id;
      global $wpdb;
      $res = $wpdb->get_var($wpdb->prepare('SELECT * FROM wp_pts_modules WHERE %1s = %s', $field, $value));
      return $res;
   }
   protected function _addError($error) {
      if (is_array($error)) $this->_errors = array_merge($this->_errors, $error);
      else $this->_errors[] = $error;
   }
   public function getErrors() {
      return $this->_errors;
   }
   protected function _clearErrors() {
      $this->_errors = array();
   }
   public function prepareInput($d = array()) {
      $ignore = isset($d['ignore']) ? $d['ignore'] : array();
      foreach ($this->_fields as $key => $f) {
         if ($f->type == 'tinyint') {
            if ($d[$key] == 'true') $d[$key] = 1;
            if (empty($d[$key]) && !in_array($key, $ignore)) {
               $d[$key] = 0;
            }
         }
         if ($f->type == 'date') {
            if (empty($d[$key]) && !in_array($key, $ignore)) {
               $d[$key] = '0000-00-00';
            }
            elseif (!empty($d[$key])) {
               $d[$key] = dbPts::timeToDate($d[$key]);
            }
         }
      }
      $d[$this->_id] = isset($d[$this->_id]) ? intval($d[$this->_id]) : 0;
      return $d;
   }
   public function prepareOutput($d = array()) {
      $ignore = isset($d['ignore']) ? $d['ignore'] : array();
      foreach ($this->_fields as $key => $f) {
         switch ($f->type) {
            case 'date':
               if ($d[$key] == '0000-00-00' || empty($d[$key])) $d[$key] = '';
               else {
                  $d[$key] = date(PTS_DATE_FORMAT, dbPts::dateToTime($d[$key]));
               }
               break;
            case 'int':
            case 'tinyint':
               if ($d[$key] == 'true') $d[$key] = 1;
               if ($d[$key] == 'false') $d[$key] = 0;
               $d[$key] = (int)$d[$key];

               break;
            }
         }
         $d[$this->_id] = isset($d[$this->_id]) ? intval($d[$this->_id]) : 0;
         return $d;
      }
      public function install($d = array()) {
      }
      public function uninstall($d = array()) {
      }
      public function activate() {
      }
      public function getLastInsertID() {
      }
      public function adaptHtml($val) {
         return htmlspecialchars($val);
      }
}
?>
