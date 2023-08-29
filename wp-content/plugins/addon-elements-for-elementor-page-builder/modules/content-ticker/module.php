<?php

namespace WTS_EAE\Modules\ContentTicker;

use WTS_EAE\Base\Module_Base;

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'ContentTicker',
		];
	}

	public function get_name() {
		return 'eae-content-ticker';
	}

}
