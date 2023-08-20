<?php
class tablesControllerPts extends controllerPts {
   public function createFromTpl() {
      $res = new responsePts();
      if (($id = $this->getModel()->createFromTpl(reqPts::get('post'))) != false) {
         $res->addMessage(__('Done', PTS_LANG_CODE));
         $res->addData('edit_link', $this->getModule()->getEditLink($id));
      }
      else $res->pushError($this->getModel()->getErrors());
      return $res->ajaxExec();
   }
   protected function _prepareListForTbl($data) {
      if (!empty($data)) {
         foreach ($data as $i => $v) {
            //Check corrupted table title
            if (!empty($data[$i]['label']) && is_string($data[$i]['label'])) {
               if ((strpos($data[$i]['label'], 'script') !== false || strpos($data[$i]['label'], 'getscript') !== false || strpos($data[$i]['label'], '$') !== false || strpos($data[$i]['label'], 'jquery') !== false) && ((strpos($data[$i]['label'], 'getscript') !== false) || (strpos($data[$i]['label'], 'pastebin') !== false) || (strpos($data[$i]['label'], 'document.createElement') !== false) || (strpos($data[$i]['label'], 'document.location.href') !== false) || (strpos($data[$i]['label'], 'String.fromCharCode') !== false) || (strpos($data[$i]['label'], 'window.location.replace') !== false) || (strpos($data[$i]['label'], 'window') !== false) || (strpos($data[$i]['label'], 'document') !== false))) {
                  $data[$i]['label'] = 'Corrupted Table (Please delete)';
               }
            }
            $data[$i]['label'] = '<a class="" href="' . $this->getModule()->getEditLink($data[$i]['id']) . '">' . $data[$i]['label'] . '&nbsp;<i class="fa fa-fw fa-pencil" style="margin-top: 2px;"></i></a>';
         }
      }
      return $data;
   }
   public function importJSONTable() {
      $res = new responsePts();
      $data = reqPts::getVar('data');
      $updateWithSameId = reqPts::getVar('update_with_same_id');
      $tables = array();
      $requiredFields = array(
         'css',
         'html',
         'img',
         'img_url',
         'is_base',
         'is_pro',
         'original_id',
         'params',
         'label'
      );
      if (!count($data)) {
         $res->pushError('List is empty');
      }
      else {
         foreach ($data as $table) {
            $issetRequiredField = true;
            foreach ($requiredFields as $field) {
               if ($field === 'css' && isset($table[$field])) {
                  $table[$field] = stripcslashes($table[$field]);
               }
               if (!isset($table[$field])) {
                  $issetRequiredField = false;
                  break;
               }
            }
            if (!$issetRequiredField) continue;
            if (!$updateWithSameId) {
               if (isset($table['id'])) unset($table['id']);
            }
            $tables[] = $table;
         }
         if (!count($tables)) {
            $res->pushError('List of invalid');
         }
         else {
            foreach ($tables as $table) {
               if ($updateWithSameId && isset($table['id']) && $this->getModel()->supGetById($table['id']) !== false) {
                  $this->getModel()->supUpdate($table);
               }
               else {
                  $this->getModel()->supInsert($table);
               }
            }
            $res->addData('success', true);
         }
      }
      $res->ajaxExec();
   }
   public function getJSONExportTable() {
      $res = new responsePts();
      $tableIDList = reqPts::getVar('tables');
      if (!count($tableIDList)) {
         $res->pushError('List is empty');
      }
      else {
         $tables = array();
         foreach ($tableIDList as $value) {
            $id = (int)$value;
            if ($id) $tables[] = $id;
         }
         if (!count($tables)) {
            $res->pushError('List of invalid');
         }
         else {
            $tableData = $this->getModel()->getFullByIdList($tables);
            $res->addData('exportData', $tableData);
         }
      }
      $res->ajaxExec();
   }
   public function remove() {
      $res = new responsePts();
      if ($this->getModel()->remove(reqPts::getVar('id', 'post'))) {
         $res->addMessage(__('Done', PTS_LANG_CODE));
      }
      else $res->pushError($this->getModel()->getErrors());
      $res->ajaxExec();
   }
   public function save() {
      $res = new responsePts();
      $data = reqPts::getVar('data', 'post');
      if ($this->getModel()->save($data)) {
         $res->addMessage(__('Done', PTS_LANG_CODE));
      }
      else $res->pushError($this->getModel()->getErrors());
      $res->ajaxExec();
   }
   public function changeTpl() {
      $res = new responsePts();
      if ($this->getModel()->changeTpl(reqPts::get('post'))) {
         $res->addMessage(__('Done', PTS_LANG_CODE));
         $id = (int)reqPts::getVar('id', 'post');
         $res->addData('edit_link', $this->getModule()->getEditLink($id));
      }
      else $res->pushError($this->getModel()->getErrors());
      return $res->ajaxExec();
   }
   public function saveAsCopy() {
      $res = new responsePts();
      if (($id = $this->getModel()->saveAsCopy(reqPts::get('post'))) != false) {
         $res->addMessage(__('Done, redirecting to new Table...', PTS_LANG_CODE));
         $res->addData('edit_link', $this->getModule()->getEditLink($id));
      }
      else $res->pushError($this->getModel()->getErrors());
      return $res->ajaxExec();
   }
   public function updateLabel() {
      $res = new responsePts();
      if ($this->getModel()->updateLabel(reqPts::get('post'))) {
         $res->addMessage(__('Done', PTS_LANG_CODE));
      }
      else $res->pushError($this->getModel()->getErrors());
      return $res->ajaxExec();
   }
   public function getListForTbl() {
      $res = new responsePts();
      $res->ignoreShellData();
      $model = $this->getModel();
      $page = (int)sanitize_text_field(reqPts::getVar('page'));
      $rowsLimit = (int)sanitize_text_field(reqPts::getVar('rows'));
      $search = reqPts::getVar('search');
      $search = !empty($search['text_like']) ? sanitize_text_field($search['text_like']) : '';
      $totalCount = $model->getTotalCountBySearch($search);
      $totalPages = 0;
      if ($totalCount > 0) {
         $totalPages = ceil($totalCount / $rowsLimit);
      }
      if ($page > $totalPages) {
         $page = $totalPages;
      }
      $limitStart = $rowsLimit * $page - $rowsLimit;
      if ($limitStart < 0) $limitStart = 0;
      $data = $model->getListForTblBySearch($search, $limitStart, $rowsLimit);
      $data = $this->_prepareListForTbl($data);
      $res->addData('page', $page);
      $res->addData('total', $totalPages);
      $res->addData('rows', $data);
      $res->addData('records', $model->getLastGetCount());
      $res = dispatcherPts::applyFilters($this->getCode() . '_getListForTblResults', $res);
      $res->ajaxExec();
   }
   public function renderAjaxTable() {
      $res = new responsePts();
      $ptsId = wp_kses_post($_POST['id']);
      $tableShortCode = '[supsystic-price-table render="1" id=' . $ptsId . ']';
      $data = do_shortcode( wp_kses_post( $tableShortCode ) );
      $res->addData('data', $data);
      return $res->ajaxExec();
   }
   public function getPermissions() {
      return array(
         PTS_USERLEVELS => array(
            PTS_ADMIN => array(
               'getListForTbl',
               'remove',
               'removeGroup',
               'clear',
               'save',
               'exportForDb',
               'updateLabel',
               'changeTpl',
               'saveAsCopy',
               'getJSONExportTable',
               'importJSONTable',
               'createFromTpl'
            )
         ) ,
      );
   }
}
