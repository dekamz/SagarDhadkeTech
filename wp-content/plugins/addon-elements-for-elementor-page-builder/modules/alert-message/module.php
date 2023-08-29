<?php

namespace WTS_EAE\Modules\AlertMessage;

use WTS_EAE\Base\Module_Base;

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'AlertMessage',
		];
	}

	public function get_name() {
		return 'eae-alert-message';
	}

}
