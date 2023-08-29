<?php

namespace WTS_EAE\Modules\AdvanceButton;

use WTS_EAE\Base\Module_Base;

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'AdvanceButton',
		];
	}

	public function get_name() {
		return 'eae-advance-button';
	}

}
