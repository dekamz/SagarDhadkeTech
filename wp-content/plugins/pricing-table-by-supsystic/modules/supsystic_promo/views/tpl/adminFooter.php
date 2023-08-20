<div class="supsysticOverviewACFormOverlay">
		<form method="post" id="overview-ac-form" class="supsysticOverviewACForm">
			<div class="supsysticOverviewACTitle">
				<div class="supsysticOverviewACClose"><i class="fa fa-times" aria-hidden="true"></i></div>
				<a href="https://supsystic.com/" target="_blank"><img src="<?php echo PTS_PLUGINS_URL .'/'. PTS_PLUG_NAME;?>/modules/supsystic_promo/img/supsystic-logo-small.png"></a><br>
				<b>PRO plugins</b> and <b>amazing gifts</b>!
			</div>
			<?php
			global $current_user;
			$userName = $current_user->user_firstname.' '.$current_user->user_lastname;
			$userEmail = $current_user->user_email;
			?>
			<label>Name *</label>
			<input type="text" name="username" value="<?php echo $userName;?>">
			<label>Email *</label>
			<input type="text" name="email" value="<?php echo $userEmail;?>">
			<button id="subscribe-btn" type="submit" class="button button-primary button-hero">
					<i class="fa fa-check-square" aria-hidden="true"></i>
					Subscribe
			</button>
			<?php wp_nonce_field('pts_nonce', 'pts_nonce'); ?>
			<div class="button button-primary button-hero supsysticOverviewACBtn supsysticOverviewACBtnRemind"><i class="fa fa-hourglass-half" aria-hidden="true"></i> Remind me tomorrow</div>
			<div class="button button-primary button-hero supsysticOverviewACBtn supsysticOverviewACBtnDisable"><i class="fa fa-times" aria-hidden="true"></i> Do not disturb me again</div>
			<div class="supsysticOverviewACFormNotification" style="color: red; float: left; display:none;">Fields with * are required to fill</div>
		</form>
		<div class="clear"></div>
</div>
<div id="supsysticOverviewACFormDialog" hidden>
			<div class="on-error" style="display:none">
					<p>Some errors occurred while sending mail please send your message trough this contact form:</p>
					<p><a href="https://supsystic.com/plugins/#contact" target="_blank">https://supsystic.com/plugins/#contact</a></p>
			</div>
			<div class="message"></div>
</div>
