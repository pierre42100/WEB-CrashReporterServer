<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create apps form view file
 *
 * @author Pierre HUBERT
 */

//Generate an appliation key and secret
$app_key = random_string("alnum", $this->config->item("default_key_length"));
$app_secret = random_string("alnum", $this->config->item("default_key_length"));

?><div class="app-container">

	<h3>Create an application</h3>

	<form class="mb-2" action="<?php echo site_url("apps"); ?>" method="post">
		<div class="form-group">
			<label>Application name</label>
			<input placeholder="The name of the application" type="text" name="app_name" />
		</div>

		<div class="form-group">
			<label>Application description</label>
			<input placeholder="The name of the application" type="text" name="app_description" />
		</div>
		
		<div class="form-group">
			<label>Application key</label>
			<input placeholder="The key of the application" type="text" name="app_key" value="<?php echo $app_key; ?>" />
		</div>

		<div class="form-group">
			<label>Application secret</label>
			<input placeholder="The secret of the application" type="text" name="app_secret" value="<?php echo $app_secret; ?>" />
			<small class="text-muted">This key must be kept secret</small>
		</div>
		
		<div class="form-group">
			<button class="button success">Create the application</button>
		</div>
	</form>
</div>