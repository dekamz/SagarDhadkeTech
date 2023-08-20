<?php
class pagesPts extends modulePts {
   public function isLogin() {
      return (basename($_SERVER['SCRIPT_NAME']) == 'wp-login.php' || strpos($_SERVER['REQUEST_URI'], '/login/') === 0); 
   }
}
