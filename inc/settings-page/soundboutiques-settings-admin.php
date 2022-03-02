<?php
global $SoundBoutiqueSettings; // we'll need this below
?>
<div class="wrap">
    <h2>SoundBoutiques Settings</h2>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    	<?php $SoundBoutiqueSettings->the_nonce(); ?>
    	<table class="form-table">
			<tbody>
				<tr>
					<th scope="row" valign="top">Favorite Color</th>
					<td>
						<label>
							<input class="widefat" type="text" name="<?php echo $SoundBoutiqueSettings->get_field_name('favorite_color'); ?>" value="<?php echo $SoundBoutiqueSettings->get_setting('favorite_color'); ?>" />
						</label>
					</td>
				</tr>

				<tr>
					<th scope="row" valign="top">Favorite Array</th>
					<td>
						<label>
							<input class="widefat" type="text" name="<?php echo $SoundBoutiqueSettings->get_field_name('favorite_array'); ?>" value="<?php echo $SoundBoutiqueSettings->get_setting('favorite_array'); ?>" />
						</label>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top">Favorite Checkbox</th>
					<td>
						<label>
							<input type="hidden" name="<?php echo $SoundBoutiqueSettings->get_field_name('favorite_checkbox'); ?>" value="no" />
							<input type="checkbox" name="<?php echo $SoundBoutiqueSettings->get_field_name('favorite_checkbox'); ?>" value="yes" <?php if ( $SoundBoutiqueSettings->get_setting('favorite_checkbox') == "yes") echo 'checked="checked"'; ?> />	Check this box, son!
						</label>
					</td>
				</tr>
			</tbody>
    	</table>
    	<input class="button-primary" type="submit" value="Save Settings" />
    </form>
</div>
