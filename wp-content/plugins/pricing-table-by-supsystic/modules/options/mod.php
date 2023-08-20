<?php
class optionsPts extends modulePts {
   private $_tabs = array();
   private $_options = array();
   private $_optionsToCategoires = array();
   public function init() {
      dispatcherPts::addAction('afterModulesInit', array(
         $this,
         'initAllOptValues'
      ));
      dispatcherPts::addFilter('mainAdminTabs', array(
         $this,
         'addAdminTab'
      ));
   }
   public function initAllOptValues() {
      $this->getAll();
   }
   public function get($code) {
      return $this->getModel()->get($code);
   }
   public function isEmpty($code) {
      return $this->getModel()->isEmpty($code);
   }
   public function getAllowedPublicOptions() {
      $allowKeys = array(
         'add_love_link',
         'disable_autosave'
      );
      $res = array();
      foreach ($allowKeys as $k) {
         $res[$k] = $this->get($k);
      }
      return $res;
   }
   public function getAdminPage() {
      if (installerPts::isUsed()) {
         return $this->getView()->getAdminPage();
      }
      else {
         return framePts::_()->getModule('supsystic_promo')->showWelcomePage();
      }
   }
   public function addAdminTab($tabs) {
      $tabs['settings'] = array(
         'label' => __('Settings', PTS_LANG_CODE) ,
         'callback' => array(
            $this,
            'getSettingsTabContent'
         ) ,
         'fa_icon' => 'fa-gear',
         'sort_order' => 30,
      );
      return $tabs;
   }
   public function getSettingsTabContent() {
      return $this->getView()->getSettingsTabContent();
   }
   public function getTabs() {
      if (empty($this->_tabs)) {
         $this->_tabs = dispatcherPts::applyFilters('mainAdminTabs', array());
         foreach ($this->_tabs as $tabKey => $tab) {
            if (!isset($this->_tabs[$tabKey]['url'])) {
               $this->_tabs[$tabKey]['url'] = $this->getTabUrl($tabKey);
            }
         }
         uasort($this->_tabs, array(
            $this,
            'sortTabsClb'
         ));
      }
      return $this->_tabs;
   }
   public function sortTabsClb($a, $b) {
      if (isset($a['sort_order']) && isset($b['sort_order'])) {
         if ($a['sort_order'] > $b['sort_order']) return 1;
         if ($a['sort_order'] < $b['sort_order']) return -1;
      }
      return 0;
   }
   public function getTab($tabKey) {
      $this->getTabs();
      return isset($this->_tabs[$tabKey]) ? $this->_tabs[$tabKey] : false;
   }
   public function getTabContent() {
      return $this->getView()->getTabContent();
   }
   public function getActiveTab() {
      $reqTab = reqPts::getVar('tab');
      return empty($reqTab) ? 'tables' : esc_attr($reqTab);
   }
   public function getTabUrl($tab = '') {
      static $mainUrl;
      if (empty($mainUrl)) {
         $mainUrl = framePts::_()->getModule('adminmenu')->getMainLink();
      }
      return empty($tab) ? $mainUrl : $mainUrl . '&tab=' . $tab;
   }
   public function getRolesList() {
      if (!function_exists('get_editable_roles')) {
         require_once (ABSPATH . '/wp-admin/includes/user.php');
      }
      return get_editable_roles();
   }
   public function getAvailableUserRolesSelect() {
      $rolesList = $this->getRolesList();
      $rolesListForSelect = array();
      foreach ($rolesList as $rKey => $rData) {
         $rolesListForSelect[$rKey] = $rData['name'];
      }
      return $rolesListForSelect;
   }
   public function getAll() {
      if (empty($this->_options)) {
         $uploadsDir = wp_upload_dir(null, false);
         $this->_options = dispatcherPts::applyFilters('optionsDefine', array(
            'general' => array(
               'label' => __('General', PTS_LANG_CODE) ,
               'opts' => array(
                  'send_stats' => array(
                     'label' => __('Send usage statistics', PTS_LANG_CODE) ,
                     'desc' => __('Send information about what plugin options you prefer to use, this will help us to make our solution better for You.', PTS_LANG_CODE) ,
                     'def' => '0',
                     'html' => 'checkboxHiddenVal'
                  ) ,
                  'add_love_link' => array(
                     'label' => __('Show promo link', PTS_LANG_CODE),
                     'desc' => __('To promote our plugin, you can show the promo link below the table, if you don\'t want to show the promo link you can also hide it. You can completely remove the link under the table by purchasing the PRO version of the plugin. Thank you for cooperation!', PTS_LANG_CODE) ,
                     'def' => '0',
                     'html' => 'checkboxHiddenVal'
                  ) ,
                  'remove_love_link' => array(
                     'label' => __('Remove promo link', PTS_LANG_CODE),
                     'desc' => __('If you want to delete promo link below the table from HTML just check this box. Only for PRO users.', PTS_LANG_CODE) ,
                     'def' => '0',
                     'html' => 'checkboxHiddenVal',
                     'pro' => ''
                  ) ,
                  'access_roles' => array(
                     'label' => __('User with such role can use plugin', PTS_LANG_CODE) ,
                     'desc' => __('User with the next roles will have access to the whole plugin from admin area.', PTS_LANG_CODE) ,
                     'def' => 'administrator',
                     'html' => 'selectlist',
                     'options' => array(
                        $this,
                        'getAvailableUserRolesSelect'
                     ),
                     'pro' => ''
                  ) ,
                  'disable_autosave' => array(
                     'label' => __('Disable autosave in Pricing Table', PTS_LANG_CODE) ,
                     'desc' => __('By default our plugin will make autosave of all your changes that you do in Pricing Table edit screen, but you can disable this feature here. Just don\'t forget to save your Pricing Table each time you make any changes in it.', PTS_LANG_CODE) ,
                     'def' => '1',
                     'html' => 'checkboxHiddenVal'
                  ) ,
               ) ,
            ) ,
         ));
         $isPro = framePts::_()->getModule('supsystic_promo')->isPro();
         if (!$isPro) {
            $mainLink = framePts::_()->getModule('supsystic_promo')->getMainLink();
         }
         foreach ($this->_options as $catKey => $cData) {
            foreach ($cData['opts'] as $optKey => $opt) {
               $this->_optionsToCategoires[$optKey] = $catKey;
               if (isset($opt['pro']) && !$isPro) {
                  $this->_options[$catKey]['opts'][$optKey]['pro'] = $mainLink . '?utm_source=plugin&utm_medium=' . $optKey . '&utm_campaign=pricing_table';
               }
            }
         }
         $this->getModel()->fillInValues($this->_options);
      }
      return $this->_options;
   }
   public function getFullCat($cat) {
      $this->getAll();
      return isset($this->_options[$cat]) ? $this->_options[$cat] : false;
   }
   public function getCatOpts($cat) {
      $opts = $this->getFullCat($cat);
      return $opts ? $opts['opts'] : false;
   }
}
