<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Detailed information about a report view file
 *
 * @author Pierre HUBERT
 */

?><div class="app-container">
	
	<!-- Page title -->
	<h2 class="page-title">
		<a href="<?php echo site_url('reports?app='.$app->id); ?>"><span class="mif-arrow-left page-title-icon"></span></a>
		Report information
	</h2>

	<!-- General informations about the report -->
	<p>Name: <?php echo $report->name; ?></p>
	<p>Date: <?php echo date ("F d Y H:i:s",$report->creation_date); ?></p>
	<p>Size: <?php echo human_filesize($report->report_size); ?></p>

	<p></p>
	<p></p>

	<!-- Report content -->
	<pre><?php echo $report->content; ?></pre>
</div>