<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Applications list view file
 *
 * @author Pierre HUBERT
 */

?><div class="app-container">
	<table class="table">

		<!-- Table head -->
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Description</th>
				<th>Key</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			
			<?php

				//Process the list of applications
				foreach ($list as $app) {
					?><tr>
						
						<td><?php echo $app->id; ?></td>
						<td><?php echo $app->name; ?></td>
						<td><?php echo $app->description; ?></td>
						<td><?php echo $app->key; ?></td>

						<!-- Actions -->
						<td>

							<!-- Open reports -->
							<a href="<?php echo site_url("reports?app=".$app->id); ?>" class="button success"><span class="mif-file-text"></span></a>

						</td>

					</tr><?php
				}

			?>

		</tbody>
	</table>
</div>

<p style="text-align: center;">URL to push reports: <?php echo site_url("api/v1/push"); ?></p><?php