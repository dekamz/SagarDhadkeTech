<?php
#[\AllowDynamicProperties]
class framePts {
   private $_modules = array();
   private $_tables = array();
   private $_allModules = array();
   private $_inPlugin = false;
   private $_scripts = array();
   private $_scriptsInitialized = false;
   private $_styles = array();
   private $_stylesInitialized = false;
   private $_scriptsVars = array();
   private $_mod = '';
   private $_action = '';
   private $_res = null;
   public function __construct() {
      $this->_res = toeCreateObjPts('response', array());
   }
   static public function getInstance() {
      static $instance;
      if (!$instance) {
         $instance = new framePts();
      }
      return $instance;
   }
   static public function _() {
      return self::getInstance();
   }
   public function parseRoute() {
      $pl = reqPts::getVar('pl');
      if ($pl == PTS_CODE) {
         $mod = reqPts::getMode();
         if ($mod) $this->_mod = $mod;
         $action = reqPts::getVar('action');
         if ($action) $this->_action = $action;
      }
   }
   public function setMod($mod) {
      $this->_mod = $mod;
   }
   public function getMod() {
      return $this->_mod;
   }
   public function setAction($action) {
      $this->_action = $action;
   }
   public function getAction() {
      return $this->_action;
   }
   protected function _extractModules() {
      global $wpdb;
      if (dbPts::exist("pts_modules")) {
         $activeModules = $wpdb->get_results("SELECT sup_m.*, sup_m_t.label as type_name FROM {$wpdb->prefix}pts_modules as sup_m INNER JOIN {$wpdb->prefix}pts_modules_type sup_m_t ON sup_m_t.id = sup_m.type_id ORDER BY id ASC", ARRAY_A);
         if ($activeModules) {
            foreach ($activeModules as $m) {
               $code = $m['code'];
               $moduleLocationDir = PTS_MODULES_DIR;
               if (!empty($m['ex_plug_dir'])) {
                  $moduleLocationDir = utilsPts::getExtModDir($m['ex_plug_dir']);
               }
               if (is_dir($moduleLocationDir . $code)) {
                  $this->_allModules[$m['code']] = 1;
                  if ((bool)$m['active']) {
                     importClassPts($code . strFirstUp(PTS_CODE) , $moduleLocationDir . $code . DS . 'mod.php');
                     $moduleClass = toeGetClassNamePts($code);
                     if (class_exists($moduleClass)) {
                        $this->_modules[$code] = new $moduleClass($m);
                        if (is_dir($moduleLocationDir . $code . DS . 'tables')) {
                           $this->_extractTables($moduleLocationDir . $code . DS . 'tables' . DS);
                        }
                     }
                  }
               }
            }
         }
      }
   }
   protected function _initModules() {
      if (!empty($this->_modules)) {
         foreach ($this->_modules as $mod) {
            $mod->init();
         }
      }
   }
   public function init() {
      reqPts::init();
      $this->_extractTables();
      $this->_extractModules();
      $this->_initModules();
      dispatcherPts::doAction('afterModulesInit');
      modInstallerPts::checkActivationMessages();
      $this->_execModules();
      add_action('init', array(
         $this,
         'addScripts'
      ));
      add_action('init', array(
         $this,
         'addStyles'
      ));
      register_activation_hook(PTS_DIR . DS . PTS_MAIN_FILE, array(
         'utilsPts',
         'activatePlugin'
      ));
      register_uninstall_hook(PTS_DIR . DS . PTS_MAIN_FILE, array(
         'utilsPts',
         'deletePlugin'
      ));
      register_deactivation_hook(PTS_DIR . DS . PTS_MAIN_FILE, array(
         'utilsPts',
         'deactivatePlugin'
      ));
      add_action('init', array(
         $this,
         'connectLang'
      ));
   }
   public function connectLang() {
      load_plugin_textdomain(PTS_LANG_CODE, false, PTS_PLUG_NAME . '/languages/');
   }
   public function checkPermissions($code, $action) {
      if ($this->havePermissions($code, $action)) return true;
      else {
         exit(_e('You have no permissions to view this page', PTS_LANG_CODE));
      }
   }
   public function havePermissions($code, $action) {
      $res = true;
      $mod = $this->getModule($code);
      $action = strtolower($action);
      if ($mod) {
         $permissions = $mod->getController()->getPermissions();
         if (!empty($permissions)) {
            if (isset($permissions[PTS_METHODS]) && !empty($permissions[PTS_METHODS])) {
               foreach ($permissions[PTS_METHODS] as $method => $permissions) {
                  $permissions[PTS_METHODS][strtolower($method) ] = $permissions;
               }
               if (array_key_exists($action, $permissions[PTS_METHODS])) {
                  $currentUserPosition = framePts::_()->getModule('user')->getCurrentUserPosition();
                  if ((is_array($permissions[PTS_METHODS][$action]) && !in_array($currentUserPosition, $permissions[PTS_METHODS][$action])) || (!is_array($permissions[PTS_METHODS][$action]) && $permissions[PTS_METHODS][$action] != $currentUserPosition)) {
                     $res = false;
                  }
               }
            }
            if (isset($permissions[PTS_USERLEVELS]) && !empty($permissions[PTS_USERLEVELS])) {
               $postNonceVerify = !empty($_POST['pts_nonce']) ? wp_verify_nonce($_POST['pts_nonce'], 'pts_nonce') : false;
               $getNonceVerify = !empty($_GET['pts_nonce']) ? wp_verify_nonce($_GET['pts_nonce'], 'pts_nonce') : false;
               if (!$postNonceVerify && !$getNonceVerify) {
                  $res = false;
                  return $res;
               }
               $currentUserPosition = framePts::_()->getModule('user')->getCurrentUserPosition();
               if (is_multisite() && is_admin() && is_super_admin()) {
                  $currentUserPosition = PTS_ADMIN;
               }
               foreach ($permissions[PTS_USERLEVELS] as $userlevel => $methods) {
                  if (is_array($methods)) {
                     $lowerMethods = array_map('strtolower', $methods);
                     if (in_array($action, $lowerMethods)) {
                        if ($currentUserPosition != $userlevel) $res = false;
                        break;
                     }
                  } else {
                     $lowerMethod = strtolower($methods);
                     if ($lowerMethod == $action) {
                        if ($currentUserPosition != $userlevel) $res = false;
                        break;
                     }
                  }
               }
            }
         }
      }
      return $res;
   }
   public function getRes() {
      return $this->_res;
   }
   public function execAfterWpInit() {
      $this->_doExec();
   }
   protected function _execOnlyAfterWpInit() {
      $res = false;
      $mod = $this->getModule($this->_mod);
      $action = strtolower($this->_action);
      if ($mod) {
         $permissions = $mod->getController()->getPermissions();
         if (!empty($permissions)) {
            if (isset($permissions[PTS_METHODS]) && !empty($permissions[PTS_METHODS])) {
               foreach ($permissions[PTS_METHODS] as $method => $permissions) {
                  $permissions[PTS_METHODS][strtolower($method) ] = $permissions;
               }
               if (array_key_exists($action, $permissions[PTS_METHODS])) {
                  $res = true;
               }
            }
            if (isset($permissions[PTS_USERLEVELS]) && !empty($permissions[PTS_USERLEVELS])) {
               $res = true;
            }
         }
      }
      return $res;
   }
   protected function _execModules() {
      if ($this->_mod) {
         $mod = $this->getModule($this->_mod);
         if ($mod && $this->_action) {
            if ($this->_execOnlyAfterWpInit()) {
               add_action('init', array(
                  $this,
                  'execAfterWpInit'
               ));
            } else {
               $this->_doExec();
            }
         }
      }
   }
   protected function _doExec() {
      $mod = $this->getModule($this->_mod);
      if ($mod && $this->checkPermissions($this->_mod, $this->_action)) {
         switch (reqPts::getVar('reqType')) {
            case 'ajax':
               add_action('wp_ajax_' . $this->_action, array(
                  $mod->getController() ,
                  $this->_action
               ));
               add_action('wp_ajax_nopriv_' . $this->_action, array(
                  $mod->getController() ,
                  $this->_action
               ));
            break;
            default:
               $this->_res = $mod->exec($this->_action);
            break;
         }
      }
   }
   protected function _extractTables($tablesDir = PTS_TABLES_DIR) {
      $mDirHandle = opendir($tablesDir);
      while (($file = readdir($mDirHandle)) !== false) {
         if (is_file($tablesDir . $file) && $file != '.' && $file != '..' && strpos($file, '.php')) {
            $this->_extractTable(str_replace('.php', '', $file) , $tablesDir);
         }
      }
   }
   protected function _extractTable($tableName, $tablesDir = PTS_TABLES_DIR) {
      importClassPts('noClassNameHere', $tablesDir . $tableName . '.php');
      $this->_tables[$tableName] = tablePts::_($tableName);
   }
   public function extractTables($tablesDir) {
      if (!empty($tablesDir)) $this->_extractTables($tablesDir);
   }
   public function exec() {
   }
   public function getTables() {
      return $this->_tables;
   }
   public function getTable($tableName) {
      if (empty($this->_tables[$tableName])) {
         $this->_extractTable($tableName);
      }
      return $this->_tables[$tableName];
   }
   public function getModules($filter = array()) {
      $res = array();
      if (empty($filter)) $res = $this->_modules;
      else {
         foreach ($this->_modules as $code => $mod) {
            if (isset($filter['type'])) {
               if (is_numeric($filter['type']) && $filter['type'] == $mod->getTypeID()) $res[$code] = $mod;
               elseif ($filter['type'] == $mod->getType()) $res[$code] = $mod;
            }
         }
      }
      return $res;
   }

   public function getModule($code) {
      return (isset($this->_modules[$code]) ? $this->_modules[$code] : NULL);
   }
   public function inPlugin() {
      return $this->_inPlugin;
   }
   public function addScript($handle, $src = '', $deps = array() , $ver = false, $in_footer = false, $vars = array()) {
      $src = empty($src) ? $src : uriPts::_($src);
      if (!$ver) $ver = PTS_VERSION;
      if ($this->_scriptsInitialized) {
         wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
      }
      else {
         $this->_scripts[] = array(
            'handle' => $handle,
            'src' => $src,
            'deps' => $deps,
            'ver' => $ver,
            'in_footer' => true,
            'vars' => $vars
         );
      }
   }
   public function addScripts() {
      if (!empty($this->_scripts)) {
         foreach ($this->_scripts as $s) {
            wp_enqueue_script($s['handle'], $s['src'], $s['deps'], $s['ver'], $s['in_footer']);

            if ($s['vars'] || isset($this->_scriptsVars[$s['handle']])) {
               $vars = array();
               if ($s['vars']) $vars = $s['vars'];
               if ($this->_scriptsVars[$s['handle']]) $vars = array_merge($vars, $this->_scriptsVars[$s['handle']]);
               if ($vars) {
                  foreach ($vars as $k => $v) {
                     $v = is_array($v) ? $v : array($v);
                     wp_localize_script($s['handle'], $k, $v);
                  }
               }
            }
         }
         $this->_scripts = array();
      }
      $this->_scriptsInitialized = true;
   }
   public function addJSVar($script, $name, $val) {
      if ($this->_scriptsInitialized) {
        $val = is_array($val) ? $val : array($val);
         wp_localize_script($script, $name, $val);
      }
      else {
         $this->_scriptsVars[$script][$name] = $val;
      }
   }
   public function getScripts() {
      return $this->_scripts;
   }
   public function getStyles() {
      return $this->_styles;
   }
   public function getJSVars() {
      return $this->_scriptsVars;
   }
   public function setStylesInitialized($val) {
      $this->_stylesInitialized = $val;
   }
   public function setScriptsInitialized($val) {
      $this->_scriptsInitialized = $val;
   }
   public function addStyle($handle, $src = false, $deps = array() , $ver = false, $media = 'all') {
      $src = empty($src) ? $src : uriPts::_($src);
      if (!$ver) $ver = PTS_VERSION;
      if ($this->_stylesInitialized) {
         wp_enqueue_style($handle, $src, $deps, $ver, $media);
      }
      else {
         $this->_styles[] = array(
            'handle' => $handle,
            'src' => $src,
            'deps' => $deps,
            'ver' => $ver,
            'media' => $media
         );
      }
   }
   public function addStyles() {
      if (!empty($this->_styles)) {
         foreach ($this->_styles as $s) {
            wp_enqueue_style($s['handle'], $s['src'], $s['deps'], $s['ver'], $s['media']);
         }
         $this->_styles = array();
      }
      $this->_stylesInitialized = true;
   }
   public function loadPlugins() {
      require_once (ABSPATH . 'wp-includes/pluggable.php');
   }
   public function loadWPSettings() {
      require_once (ABSPATH . 'wp-settings.php');
   }
   public function loadLocale() {
      require_once (ABSPATH . 'wp-includes/locale.php');
   }
   public function moduleActive($code) {
      return isset($this->_modules[$code]);
   }
   public function moduleExists($code) {
      if ($this->moduleActive($code)) return true;
      return isset($this->_allModules[$code]);
   }
   public function isTplEditor() {
      $tplEditor = reqPts::getVar('tplEditor');
      return (bool)$tplEditor;
   }
   public function isAdminPlugOptsPage() {
      $page = reqPts::getVar('page');
      if (is_admin() && strpos((string)$page, framePts::_()->getModule('adminmenu')
         ->getMainSlug()) !== false) return true;
      return false;
   }
   public function isAdminPlugPage() {
      if ($this->isAdminPlugOptsPage()) {
         return true;
      }
      return false;
   }
   public function licenseDeactivated() {
      return (!$this->getModule('license') && $this->moduleExists('license'));
   }
   public function savePluginActivationErrors() {
      update_option(PTS_CODE . '_plugin_activation_errors', ob_get_contents());
   }
   public function getActivationErrors() {
      return get_option(PTS_CODE . '_plugin_activation_errors');
   }
}
