<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project body view file
 *
 * @author Pierre HUBERT
 */

?>
<body>
	
	<!-- Main page source -->
	<?php echo $page_src; ?>

	<!-- Scripts inclusion -->
	<script type="text/javascript" src="<?php echo path_assets("3rdparty/jquery-3.3.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo path_assets("3rdparty/metro/metro.min.js"); ?>"></script>
</body>
</html>