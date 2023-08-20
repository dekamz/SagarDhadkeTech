<?php
class tablesModelPts extends modelPts {
   private $_linksReplacement = array();
   public function __construct() {
      $this->_setTbl('tables');
   }
   private function _getLinksReplacement() {
      if (empty($this->_linksReplacement)) {
         $this->_linksReplacement = array(
            'modUrl' => array(
               'url' => $this->getModule()->getModPath() ,
               'key' => 'PTS_MOD_URL'
            ) ,
            'siteUrl' => array(
               'url' => PTS_SITE_URL,
               'key' => 'PTS_SITE_URL'
            ) ,
            'assetsUrl' => array(
               'url' => $this->getModule()->getAssetsUrl() ,
               'key' => 'PTS_ASSETS_URL'
            ) ,
            'oldAssets' => array(
               'url' => $this->getModule()->getOldAssetsUrl() ,
               'key' => 'PTS_OLD_ASSETS_URL'
            ) ,
         );
      }
      return $this->_linksReplacement;
   }
   public function createFromTpl($d = array()) {
      $d['label'] = isset($d['label']) ? trim($d['label']) : '';
      $d['original_id'] = isset($d['original_id']) ? (int)$d['original_id'] : 0;
      if (!empty($d['label'])) {
         if (!empty($d['original_id'])) {
            $original = $this->supGetById($d['original_id']);
            framePts::_()->getModule('supsystic_promo')->getModel()->saveUsageStat('create_from_tpl.' . strtolower(str_replace(' ', '-', $original['label'])));
            unset($original['id']);
            $original['label'] = $d['label'];
            $original['original_id'] = $d['original_id'];
            return $this->insertFromOriginal($original);
         }
         else $this->pushError(__('Please select Table template from list below', PTS_LANG_CODE));
      }
      else $this->pushError(__('Please enter Name', PTS_LANG_CODE) , 'label');
      return false;
   }
   public function insertFromOriginal($original) {
      global $wpdb;
      $tableName = $wpdb->prefix . "pts_tables";
      $data = $this->_dataSave($original, false);
      $unique_id = $data['unique_id'];
      $label = $data['label'];
      $original_id = $data['original_id'];
      $params = $data['params'];
      $html = $data['html'];
      $css = $data['css'];
      $res = $wpdb->insert($tableName, array(
         'unique_id' => $unique_id,
         'label' => $label,
         'original_id' => $original_id,
         'params' => $params,
         'html' => $html,
         'css' => $css,
      ));
      if ($res) {
         return $wpdb->insert_id;;
      }
      return false;
   }
   public function supInsert($data) {
      global $wpdb;
      $tableName = $wpdb->prefix . "pts_tables";
      $data = $this->_dataSave($data, false);
      $unique_id = $data['unique_id'];
      $label = $data['label'];
      $original_id = $data['original_id'];
      $params = $data['params'];
      $html = $data['html'];
      $css = $data['css'];
      $res = $wpdb->insert($tableName, array(
         'unique_id' => $unique_id,
         'label' => $label,
         'original_id' => $original_id,
         'params' => $params,
         'html' => $html,
         'css' => $css,
      ));
      if ($res) {
         return $wpdb->insert_id;;
      }
      return false;
   }
   public function supUpdate($d = array()) {
      global $wpdb;
      $data = $this->_dataSave($d);
      $html = !empty($data['html']) ? $data['html'] : '';
      $css = !empty($data['css']) ? $data['css'] : '';
      $params = !empty($data['params']) ? $data['params'] : '';
      $id = !empty($d['id']) ? sanitize_text_field($d['id']) : '';
      $tableName = $wpdb->prefix . "pts_tables";
      $data_update = array(
         'html' => $html,
         'css' => $css,
         'params' => $params
      );
      $data_where = array(
         'id' => $id
      );
      $res = $wpdb->update($tableName, $data_update, $data_where);
      if ($res) {
         dispatcherPts::doAction('afterTableUpdate', $d);
      }
      return $res;
   }
   public function remove($id) {
      $id = (int)$id;
      if ($id) {
         global $wpdb;
         $tableName = $wpdb->prefix . "pts_tables";
         $data_where = array(
            'id' => $id
         );
         $res = $wpdb->delete($tableName, $data_where);
         if ($res) {
            return true;
         }
         else $this->pushError(__('Database error detected', PTS_LANG_CODE));
      }
      else $this->pushError(__('Invalid ID', PTS_LANG_CODE));
      return false;
   }
   public function getSimpleList($where = array() , $params = array()) {
      if ($where) $this->setWhere($where);
      return $this->setSelectFields('id, label, original_id, img, is_pro')->getFromTbl($params);
   }
   public function clear() {
      if (framePts::_()->getTable($this->_tbl)->delete(array(
         'additionalCondition' => 'original_id != 0'
      ))) {
         return true;
      }
      else $this->pushError(__('Database error detected', PTS_LANG_CODE));
      return false;
   }
   public function save($d = array()) {
      global $wpdb;
      $data = $this->_dataSave($d);
      $html = !empty($data['html']) ? $data['html'] : '';
      $css = !empty($data['css']) ? $data['css'] : '';
      $params = !empty($data['params']) ? $data['params'] : '';
      $id = !empty($d['id']) ? sanitize_text_field($d['id']) : '';
      $tableName = $wpdb->prefix . "pts_tables";
      $data_update = array(
         'html' => $html,
         'css' => $css,
         'params' => $params
      );
      $data_where = array(
         'id' => $id
      );
      $res = $wpdb->update($tableName, $data_update, $data_where);
      if ($res) {
         dispatcherPts::doAction('afterTableUpdate', $d);
      }
      return $res;
   }
   public function getTplsList() {
      global $wpdb;
      $data = $wpdb->get_results("SELECT id, label, original_id, img, is_pro FROM {$wpdb->prefix}pts_tables as sup_tables WHERE original_id = 0 ", ARRAY_A);
      foreach ($data as $key => $row) {
         $data[$key] = $this->_afterGetFromTbl($row);
      }
      return $data;
   }
   protected function _afterGetFromTbl($row) {
      static $imgsPath = false;
      if (!$imgsPath) {
         $imgsPath = $this->getModule()->getAssetsUrl() . 'img/prev/';
      }
      $row['params'] = isset($row['params']) && !empty($row['params']) ? utilsPts::unserialize(base64_decode($row['params']) , true) : array();
      $row['params'] = $this->_afterDbReplace($this->_afterDbParams($row['params']));
      $row = $this->_afterDbReplace($row);
      $row['img_url'] = isset($row['img']) && !empty($row['img']) ? $imgsPath . $row['img'] : $imgsPath . strtolower(str_replace(array(
         ' ',
         '.'
      ) , '-', $row['label'])) . '.jpg';
      $row['id'] = (int)$row['id'];
      $row['original_id'] = (int)$row['original_id'];
      $row['sort_order'] = isset($row['sort_order']) ? (int)$row['sort_order'] : 0;
      if (!isset($row['session_id'])) {
         $row['session_id'] = mt_rand(1, 999999);
      }
      if (!isset($row['view_id'])) {
         $row['view_id'] = 'ptsBlock_' . $row['session_id'];
      }
      $row['cat_code'] = 'price_table';
      return $row;
   }
   private function _afterDbParams($params) {
      if (empty($params)) return $params;
      if (is_array($params)) {
         foreach ($params as $k => $v) {
            $params[$k] = $this->_afterDbParams($v);
         }
         return $params;
      }
      else return stripslashes($params);
   }
   protected function _beforeDbReplace($data) {
      static $replaceFrom, $replaceTo;
      if (is_array($data)) {
         foreach ($data as $k => $v) {
            $data[$k] = $this->_beforeDbReplace($v);
         }
      }
      else {
         if (!$replaceFrom) {
            $this->_getLinksReplacement();
            foreach ($this->_linksReplacement as $k => $rData) {
               if ($k == 'oldAssets') { // Replace old assets urls - to new one
                  $replaceFrom[] = $rData['url'];
                  $replaceTo[] = '[' . $this->_linksReplacement['assetsUrl']['key'] . ']';
               }
               else {
                  $replaceFrom[] = $rData['url'];
                  $replaceTo[] = '[' . $rData['key'] . ']';
               }
            }
         }
         $data = str_replace($replaceFrom, $replaceTo, $data);
      }
      return $data;
   }
   protected function _afterDbReplace($data) {
      static $replaceFrom, $replaceTo;
      if (is_array($data)) {
         foreach ($data as $k => $v) {
            $data[$k] = $this->_afterDbReplace($v);
         }
      }
      else {
         if (!$replaceFrom) {
            $this->_getLinksReplacement();
            $replaceFrom[] = '[' . $this->_linksReplacement['modUrl']['key'] . ']';
            $replaceTo[] = '[' . $this->_linksReplacement['assetsUrl']['key'] . ']';
            $replaceFrom[] = $this->_linksReplacement['oldAssets']['url'];
            $replaceTo[] = $this->_linksReplacement['assetsUrl']['url'];
            foreach ($this->_linksReplacement as $k => $rData) {
               $replaceFrom[] = '[' . $rData['key'] . ']';
               $replaceTo[] = $rData['url'];
            }
         }
         $data = str_replace($replaceFrom, $replaceTo, (string)$data);
      }
      return $data;
   }
   protected function _dataSave($data, $update = false) {
      $data = $this->_beforeDbReplace($data);
      if (isset($data['params'])) {
         if (isset($data['remove_old_html']) && $data['remove_old_html']) {
            unset($data['remove_old_html']);
            if (isset($data['params']['old_html'])) {
               unset($data['params']['old_html']);
            }
         }
         $data['params'] = base64_encode(utilsPts::serialize($data['params']));
      }
      return $data;
   }
   protected function _escTplData($data) {
      if (isset($data['label'])) $data['label'] = dbPts::prepareHtmlIn($data['label']);
      if (isset($data['html'])) $data['html'] = dbPts::escape($data['html']);
      if (isset($data['css'])) $data['css'] = dbPts::escape($data['css']);
      return $data;
   }
   public function generateUniqueId() {
      $uid = utilsPts::getRandStr(8);
      error_log('generateUniqueId');
      if (framePts::_()->getTable($this->_tbl)->get('COUNT(*) AS total', array(
         'unique_id' => $uid,
         'original_id' => 0
      ) , '', 'one')) {
         return $this->generateUniqueId();
      }
      return $uid;
   }
   public function updateLabel($d = array()) {
      $d['id'] = isset($d['id']) ? (int)sanitize_text_field($d['id']) : 0;
      if (!empty($d['id'])) {
         $d['label'] = isset($d['label']) ? strip_tags(trim($d['label'])) : '';
         if (stripos('script', $d['label']) !== false) {
            $d['label'] = 'Pricing Table ID ' . $d['id'];
         }
         if (!empty($d['label'])) {
            global $wpdb;
            $label = !empty($d['label']) ? $d['label'] : '';
            $id = !empty($d['id']) ? sanitize_text_field($d['id']) : '';
            $tableName = $wpdb->prefix . "pts_tables";
            $data_update = array(
               'label' => $label
            );
            $data_where = array(
               'id' => $id
            );
            $res = $wpdb->update($tableName, $data_update, $data_where);
            return $res;
         }
         else $this->pushError(__('Name can not be empty', PTS_LANG_CODE));
      }
      else $this->pushError(__('Invalid ID', PTS_LANG_CODE));
      return false;
   }
   public function changeTpl($d = array()) {
      global $wpdb;
      $d['id'] = isset($d['id']) ? (int)$d['id'] : 0;
      $d['new_tpl_id'] = isset($d['new_tpl_id']) ? (int)$d['new_tpl_id'] : 0;
      if ($d['id'] && $d['new_tpl_id']) {
         $currentTable = $this->supGetById($d['id']);
         $newTpl = $this->supGetById($d['new_tpl_id']);
         if (!empty($currentTable['params']['option_name_input']['val'])) {
            $newTpl['params']['option_name_input']['val'] = $currentTable['params']['option_name_input']['val'];
         }
         framePts::_()->getModule('supsystic_promo')->getModel()->saveUsageStat('change_to_tpl.' . strtolower(str_replace(' ', '-', $newTpl['label'])));
         $newTpl['original_id'] = $newTpl['id'];
         $newTpl['id'] = $currentTable['id'];
         $newTpl['label'] = $currentTable['label'];
         $newTpl['params']['old_html']['val'] = $currentTable['html'];
         $newTpl = dispatcherPts::applyFilters('tableChangeTpl', $newTpl, $currentTable);
         $data = $this->_dataSave($newTpl, true);
         $tableName = $wpdb->prefix . "pts_tables";
         $data_update = array(
            'original_id' => $data['original_id'],
            'label' => $data['label'],
            'params' => $data['params'],
            'html' => $data['html'],
            'css' => $data['css']
         );
         $data_where = array(
            'id' => $newTpl['id']
         );
         $res = $wpdb->update($tableName, $data_update, $data_where);
         return $res;
      }
      else $this->pushError(__('Provided data was corrupted', PTS_LANG_CODE));
      return false;
   }
   public function setSimpleGetFields() {
      $this->setSelectFields('id, label, date_created, sort_order, original_id');
      return parent::setSimpleGetFields();
   }
   public function saveAsCopy($d = array()) {
      $d['copy_label'] = isset($d['copy_label']) ? trim($d['copy_label']) : '';
      $d['id'] = isset($d['id']) ? (int)$d['id'] : 0;
      if (!empty($d['copy_label'])) {
         if (!empty($d['id'])) {
            $original = $this->supGetById($d['id']);
            unset($original['id']);
            $original['label'] = $d['copy_label'];
            return $this->insertFromOriginal($original);
         }
         else $this->pushError(__('Where is ID?', PTS_LANG_CODE));
      }
      else $this->pushError(__('Please enter Name', PTS_LANG_CODE) , 'copy_label');
      return false;
   }
   public function getFullByIdList($list) {
      global $wpdb;
      $data = array();
      foreach ($list as $row) {
         $res = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pts_tables WHERE id = %s", $row) , ARRAY_A);
         $data[] = $this->_afterGetFromTbl($res[0]);
      }
      return $data;
   }
   public function getTotalCountBySearch($search) {
      global $wpdb;
      if (!empty($search)) {
         $count = (int)$wpdb->get_var("SELECT COUNT(*) AS total FROM {$wpdb->prefix}pts_tables WHERE original_id != 0 AND " . $wpdb->prepare("(id = %s OR label = %s)", $search, $search));
      }
      else {
         $count = (int)$wpdb->get_var("SELECT COUNT(*) AS total FROM {$wpdb->prefix}pts_tables WHERE original_id != 0");
      }
      return $count;
   }
   public function getListForTblBySearch($search, $limitStart, $rowsLimit) {
      global $wpdb;
      if (!empty($search)) {
         $data = $wpdb->get_results("SELECT id, label, date_created FROM {$wpdb->prefix}pts_tables WHERE original_id != 0 AND " . $wpdb->prepare(" (id = %s OR label = %s) ORDER BY id ASC LIMIT %1s,%1s", $search, $search, (int)$limitStart, (int)$rowsLimit) , ARRAY_A);
      }
      else {
         $data = $wpdb->get_results("SELECT id, label, date_created FROM {$wpdb->prefix}pts_tables WHERE original_id != 0 " . $wpdb->prepare(" ORDER BY id ASC LIMIT %1s,%1s", (int)$limitStart, (int)$rowsLimit) , ARRAY_A);
      }
      return $data;
   }
}
