<?php
#[\AllowDynamicProperties]
abstract class helperPts {
   protected $_code = '';
   protected $_module = '';
   public function __construct($code) {
      $this->setCode($code);
   }
   public function init() {
   }
   public function setCode($code) {
      $this->_code = $code;
   }
   public function getCode() {
      return $this->_code;
   }
}
