<div class="error">
	<p><?php echo ULTIMATE_PLUGIN_NAME; ?> error: Your environment doesn't meet all of the system requirements listed below.</p>

	<ul class="ul-disc">
		<li>
			<strong>PHP <?php echo ULTIMATE_PLUGIN_REQUIRED_PHP_VERSION; ?>+</strong>
			<em>(You're running version <?php echo PHP_VERSION; ?>)</em>
		</li>

		<li>
			<strong>WordPress <?php echo ULTIMATE_PLUGIN_REQUIRED_WP_VERSION; ?>+</strong>
			<em>(You're running version <?php echo esc_html( $wp_version ); ?>)</em>
		</li>

		<?php 
		if(!empty(unserialize(ULTIMATE_PLUGIN_REQUIRED_PLUGINS))) {
			foreach (unserialize(ULTIMATE_PLUGIN_REQUIRED_PLUGINS) as $plugin) {
			?>
				<li>
					<strong><?php echo $plugin ?></strong> needs to be activated.
				</li>
			<?php
			}
		} ?>
		</ul>

	<p>If you need to upgrade your version of PHP you can ask your hosting company for assistance, and if you need help upgrading WordPress you can refer to <a href="http://codex.wordpress.org/Upgrading_WordPress">the Codex</a>.</p>
</div>