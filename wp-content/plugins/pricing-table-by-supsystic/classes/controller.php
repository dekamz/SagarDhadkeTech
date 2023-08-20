<?php
#[\AllowDynamicProperties]
abstract class controllerPts {
   protected $_models = array();
   protected $_views = array();
   protected $_task = '';
   protected $_defaultView = '';
   protected $_code = '';
   public function __construct($code) {
      $this->setCode($code);
      $this->_defaultView = $this->getCode();
   }
   public function init() {
   }
   protected function _onBeforeInit() {
   }
   protected function _onAfterInit() {
   }
   public function setCode($code) {
      $this->_code = $code;
   }
   public function getCode() {
      return $this->_code;
   }
   public function exec($task = '') {
      if (method_exists($this, $task)) {
         $this->_task = $task;
         return $this->$task();
      }
      return null;
   }
   public function getView($name = '') {
      if (empty($name)) $name = $this->getCode();
      if (!isset($this->_views[$name])) {
         $this->_views[$name] = $this->_createView($name);
      }
      return $this->_views[$name];
   }
   public function getModel($name = '') {
      if (!$name) $name = $this->_code;
      if (!isset($this->_models[$name])) {
         $this->_models[$name] = $this->_createModel($name);
      }
      return $this->_models[$name];
   }
   protected function _createModel($name = '') {
      if (empty($name)) $name = $this->getCode();
      $parentModule = framePts::_()->getModule($this->getCode());
      $className = '';
      if (importPts($parentModule->getModDir() . 'models' . DS . $name . '.php')) {
         $className = toeGetClassNamePts($name . 'Model');
      }
      if ($className) {
         $model = new $className();
         $model->setCode($this->getCode());
         return $model;
      }
      return NULL;
   }
   protected function _createView($name = '') {
      if (empty($name)) $name = $this->getCode();
      $parentModule = framePts::_()->getModule($this->getCode());
      $className = '';
      if (importPts($parentModule->getModDir() . 'views' . DS . $name . '.php')) {
         $className = toeGetClassNamePts($name . 'View');
      }
      if ($className) {
         $view = new $className();
         $view->setCode($this->getCode());
         return $view;
      }
      return NULL;
   }
   public function display($viewName = '') {
      $view = NULL;
      if (($view = $this->getView($viewName)) === NULL) {
         $view = $this->getView();
      }
      if ($view) {
         $view->display();
      }
   }
   public function __call($name, $arguments) {
      $model = $this->getModel();
      if (method_exists($model, $name)) return $model->$name($arguments[0]);
      else return false;
   }
   public function getPermissions() {
      return array();
   }
   public function getModule() {
      return framePts::_()->getModule($this->getCode());
   }
   protected function _prepareModelBeforeListSelect($model) {
      return $model;
   }
   public function removeGroup() {
      $res = new responsePts();
      if ($this->getModel()->removeGroup(reqPts::getVar('listIds', 'post'))) {
         $res->addMessage(__('Done', PTS_LANG_CODE));
      }
      else $res->pushError($this->getModel()->getErrors());
      $res->ajaxExec();
   }
   public function clear() {
      $res = new responsePts();
      if ($this->getModel()->clear()) {
         $res->addMessage(__('Done', PTS_LANG_CODE));
      }
      else $res->pushError($this->getModel()->getErrors());
      $res->ajaxExec();
   }
   protected function _prepareListForTbl($data) {
      return $data;
   }
   protected function _prepareSearchField($searchField) {
      return $searchField;
   }
   protected function _prepareSearchString($searchString) {
      return $searchString;
   }
   protected function _prepareSortOrder($sortOrder) {
      return $sortOrder;
   }
}
