<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Reports list page view file
 *
 * @author Pierre HUBERT
 */

?>
<div class="app-container">
	
	<!-- Page title -->
	<h2 class="page-title">
		<a href="<?php echo site_url('apps'); ?>"><span class="mif-arrow-left page-title-icon"></span></a>
		Reports for <?php echo $app->name; ?>
	</h2>

	<table class="table">
		
		<!-- Table head -->
		<thead>
		<tr>
			<th>Name</th>
			<th>Creation date</th>
			<th>Size</th>
			<th>Actions</th>
		</tr>
		</thead>

		<!-- Table body -->
		<tbody>
		<?php

		//Process the content of the table
		foreach ($list as $report) {
			?><tr>
				<td><?php echo substr($report->name, 0, 10); ?></td>
				<td><?php echo date ("F d Y H:i:s",$report->creation_date); ?></td>
				<td><?php echo human_filesize($report->report_size); ?></td>

				<!-- Report action -->
				<td>
					
					<!-- Delete the report -->
					<a class="button alert" href="<?php echo site_url('reports?app='.$app->id.'&delete_report='.$report->name); ?>"><span class="mif-bin"></span></a>

				</td>

			</tr><?php
		}

		?>
		</tbody>
	</table>

</div>