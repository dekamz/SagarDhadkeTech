<div class="wrap">
    <div class="supsystic-plugin">
        <?php /*?><header class="supsystic-plugin">
            <h1><?php echo PTS_WP_PLUGIN_NAME?></h1>
        </header><?php */?>
		<?php echo $this->breadcrumbs?>
        <section class="supsystic-content">
            <nav class="supsystic-navigation supsystic-sticky <?php dispatcherPts::doAction('adminMainNavClassAdd')?>">
                <ul>
					<?php foreach($this->tabs as $tabKey => $tab) { ?>
						<?php if(isset($tab['hidden']) && $tab['hidden']) continue;?>
						<li class="<?php echo (($this->activeTab == $tabKey || in_array($tabKey, $this->activeParentTabs)) ? 'active' : '')?>">
							<a href="<?php echo $tab['url']?>">
								<?php if(isset($tab['fa_icon'])) { ?>
									<i class="fa <?php echo $tab['fa_icon']?>"></i>
								<?php } elseif(isset($tab['wp_icon'])) { ?>
									<i class="dashicons-before <?php echo $tab['wp_icon']?>"></i>
								<?php } elseif(isset($tab['icon'])) { ?>
									<i class="<?php echo $tab['icon']?>"></i>
								<?php }?>
								<?php echo $tab['label']?>
							</a>
						</li>
					<?php }?>
                </ul>
            </nav>
            <div class="supsystic-container supsystic-<?php echo $this->activeTab?>">
				<?php //dispatcherPts::doAction('discountMsg');?>
				<?php echo $this->content?>
                <div class="clear"></div>
            </div>
            <div class="supsystic-footer-wrapper">
              <div class="supsystic-footer-add-review">Add your <a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/popup-by-supsystic?filter=5#postform">★★★★★</a> on wordpress.org</div>
              <a href="https://supsystic.com/" target="_blank"><img src="<?php echo PTS_PLUGINS_URL .'/'. PTS_PLUG_NAME;?>/modules/supsystic_promo/img/supsystic-logo-small.png"></a>
              <div class="supsystic-footer-plugin-version">Pricing Table by Supsystic Version: <?php echo PTS_VERSION?></div>
            </div>
        </section>
    </div>
</div>
<!--Option available in PRO version Wnd-->
<div id="ptsOptInProWnd" style="display: none;" title="<?php _e('Improve Free version', PTS_LANG_CODE)?>">
	<p>
		<?php printf(__('Please be advised that this option is available only in <a target="_blank" href="%s">PRO version</a>. You can <a target="_blank" href="%s" class="button">Get PRO</a> today and get this and other PRO option for your Pricing Tables!', PTS_LANG_CODE), $this->mainLink, $this->mainLink)?>
	</p>
</div>
