<div class="mkd-tabs <?php echo esc_attr($tab_class) ?> clearfix">
	<ul class="mkd-tabs-nav">
		<?php  foreach ($tabs_titles as $tab_title) {?>
			<li>
				<a href="#tab-<?php echo sanitize_title($tab_title)?>">					
					<span class="mkd-icon-frame"></span>
					<span class="mkd-tab-text-after-icon">
						<?php echo esc_attr($tab_title)?>
					</span>
				</a>
			 </li>
		<?php } ?>
	</ul> 
	<?php echo libero_mikado_remove_wpautop($content) ?>
</div>
