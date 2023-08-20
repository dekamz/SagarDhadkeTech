<?php
#[\AllowDynamicProperties]
abstract class modelPts extends baseObjectPts {
   protected $_data = array();
   protected $_code = '';
   protected $_orderBy = '';
   protected $_sortOrder = '';
   protected $_groupBy = '';
   protected $_limit = '';
   protected $_where = array();
   protected $_stringWhere = '';
   protected $_selectFields = '*';
   protected $_tbl = '';
   protected $_lastGetCount = 0;
   protected $_idField = 'id';
   public function setCode($code) {
      $this->_code = $code;
   }
   public function getCode() {
      return $this->_code;
   }
   public function getModule() {
      return framePts::_()->getModule($this->_code);
   }
   protected function _setTbl($tbl) {
      $this->_tbl = $tbl;
   }
   protected function _setIdField($field) {
      $this->_idField = $field;
   }
   public function setWhere($where) {
      $this->_where = $where;
      return $this;
   }
   public function addWhere($where) {
      if (empty($this->_where) && !is_string($where)) {
         $this->setWhere($where);
      }
      elseif (is_array($this->_where) && is_array($where)) {
         $this->_where = array_merge($this->_where, $where);
      }
      elseif (is_string($where)) {
         if (!isset($this->_where['additionalCondition'])) $this->_where['additionalCondition'] = '';
         if (!empty($this->_where['additionalCondition'])) $this->_where['additionalCondition'] .= ' AND ';
         $this->_where['additionalCondition'] .= $where;
      }
      return $this;
   }
   public function setSelectFields($selectFields) {
      $this->_selectFields = $selectFields;
      return $this;
   }
   public function groupBy($groupBy) {
      $this->_groupBy = $groupBy;
      return $this;
   }
   public function getLastGetCount() {
      return $this->_lastGetCount;
   }

   public function getFromTbl($params = array()) {
      $this->_lastGetCount = 0;
      $data = $this->_retrieveData($params);
      if (!empty($data)) {
         $return = isset($params['return']) ? $params['return'] : 'all';
         switch ($return) {
            case 'one':
               $this->_lastGetCount = 1;
            break;
            case 'row':
               $data = $this->_afterGetFromTbl($data);
               $this->_lastGetCount = 1;
            break;
            default:
               foreach ($data as $i => $row) {
                  $data[$i] = $this->_afterGetFromTbl($row);
               }
               $this->_lastGetCount = count($data);
            break;
         }
      }
      $this->_clearQuery($params);
      foreach ($data as $d) {
         if (!empty($d['css'])) {
            $d['css'] = stripcslashes($d['css']);
         }
      }
      return $data;
   }
   protected function _clearQuery($params = array()) {
      $clear = isset($params['clear']) ? $params['clear'] : array();
      if (!is_array($clear)) $clear = array(
         $clear
      );
      if (empty($clear) || in_array('limit', $clear)) $this->_limit = '';
      if (empty($clear) || in_array('orderBy', $clear)) $this->_orderBy = '';
      if (empty($clear) || in_array('sortOrder', $clear)) $this->_sortOrder = '';
      if (empty($clear) || in_array('where', $clear)) $this->_where = '';
      if (empty($clear) || in_array('selectFields', $clear)) $this->_selectFields = '*';
      if (empty($clear) || in_array('groupBy', $clear)) $this->_groupBy = '';
   }
   public function getCount($params = array()) {
      $tbl = isset($params['tbl']) ? $params['tbl'] : $this->_tbl;
      $table = framePts::_()->getTable($tbl);
      $this->setSelectFields('COUNT(*) AS total');
      $this->_buildQuery($table);
      $data = (int)$table->get($this->_selectFields, $this->_where, '', 'one');
      $this->_clearQuery($params);
      return $data;
   }
   protected function _afterGetFromTbl($row) {
      return $row;
   }
   protected function _buildQuery($table = null) {
      if (!$table) $table = framePts::_()->getTable($this->_tbl);

   }
   public function removeGroup($ids) {
      if (!is_array($ids)) $ids = array(
         $ids
      );
      $ids = array_filter(array_map('intval', $ids));
      if (!empty($ids)) {
         global $wpdb;
         $ids = implode(',', array_map('absint', $ids));
         $res = $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}pts_tables WHERE id IN (%1s)", $ids));
         if ($res) {
            return true;
         }
         else $this->pushError(__('Database error detected', PTS_LANG_CODE));
      }
      else $this->pushError(__('Invalid ID', PTS_LANG_CODE));
      return false;
   }
   public function clear() {
      return $this->delete();
   }
   public function delete($params = array()) {
      if (framePts::_()->getTable($this->_tbl)->delete($params)) {
         return true;
      }
      else $this->pushError(__('Database error detected', PTS_LANG_CODE));
      return false;
   }
   public function supGetById($id) {
      global $wpdb;
      $tableName = $wpdb->prefix . "pts_" . $this->_tbl;
      $data = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM %1s WHERE id = %s", $tableName, $id) , ARRAY_A // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
      );
      foreach ($data as $key => $d) {
         if (!empty($d['css'])) {
            $data[$key]['css'] = stripcslashes($d['css']);
         }
      }
      foreach ($data as $key => $row) {
         $data[$key] = $this->_afterGetFromTbl($row);
      }
      return empty($data) ? false : array_shift($data);
   }
   public function insert($data) {
      if (!empty($data['html'])) {
         $data['html'] = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $data['html']);
      }
      $data = $this->_dataSave($data, false);
      if (!empty($data['css'])) {
         $data['css'] = addslashes($data['css']);
      }
      $id = framePts::_()->getTable($this->_tbl)->insert($data);
      if ($id) {
         return $id;
      }
      $this->pushError(framePts::_()->getTable($this->_tbl)->getErrors());
      return false;
   }
   public function updateById($data, $id = 0) {
      if (!empty($data['html'])) {
         $data['html'] = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $data['html']);
      }
      if (!$id) {
         $id = isset($data[$this->_idField]) ? (int)$data[$this->_idField] : 0;
      }
      if ($id) {
         return $this->update($data, array(
            $this->_idField => $id
         ));
      }
      else $this->pushError(__('Empty or invalid ID', PTS_LANG_CODE));
      return false;
   }
   public function update($data, $where) {
      if (!empty($data['html'])) {
         $data['html'] = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $data['html']);
      }
      $data = $this->_dataSave($data, true);
      if (!empty($data['css'])) {
         $data['css'] = addslashes($data['css']);
      }
      if (framePts::_()->getTable($this->_tbl)->update($data, $where)) {
         return true;
      }
      $this->pushError(framePts::_()->getTable($this->_tbl)->getErrors());
      return false;
   }
   protected function _dataSave($data, $update = false) {
      return $data;
   }
   public function getTbl() {
      return $this->_tbl;
   }
   public function exists($value, $field = '') {
      return framePts::_()->getTable($this->_tbl)->exists($value, $field);
   }
   public function setSimpleGetFields() {
      return $this;
   }
}
