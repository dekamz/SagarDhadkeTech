<?php

namespace WTS_EAE\Modules\AnythingCarousel;

use WTS_EAE\Base\Module_Base;

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'AnythingCarousel',
		];
	}

	public function get_name() {
		return 'eae-anythingcarousel';
	}

}
