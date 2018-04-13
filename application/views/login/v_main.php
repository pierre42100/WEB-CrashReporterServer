<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login page main view file
 *
 * @author Pierre HUBERT
 */

//Check for error or success message
$error = isset($error) ? $error : false;
$success = isset($success) ? $success : false;

?>

<!-- Page stylesheet -->
<style>
.login-form {
	width: 370px;
	height: auto;
	top: 50%;
	margin-top: -160px;
}

.login-form .button-group {
	display: none;
}
</style>

<form class="login-form bg-white p-6 mx-auto border bd-default win-shadow" data-role="validator"
 action="<?php echo site_url("login"); ?>"
 method="post"
 data-clear-invalid="2000"
 data-on-error-form="invalidForm"
 data-on-validate-form="validateForm">

	<span class="mif-vpn-lock mif-4x place-right" style="margin-top: -10px;"></span>
	<h2 class="text-light">CrashReporter</h2>
	<hr class="thin mt-4 mb-4 bg-white">

	<!-- Display error message (if any) -->
	<?php if($error) echo "<div class='remark alert'>",$error,"</div>"; ?>

	<!-- Display success message (if any) -->
	<?php if($success) echo "<div class='remark success'>",$success,"</div>"; ?>

	<div class="form-group">
		<input type="text" data-role="input" name="email" data-prepend="<span class='mif-envelop'>" placeholder="Enter your email..." data-validate="required email" />
	</div>
	<div class="form-group">
		<input type="password" data-role="input" name="password" data-prepend="<span class='mif-key'>" placeholder="Enter your password..." data-validate="required minlength=6" />
	</div>
	<div class="form-group mt-10">
		<button class="button">Login</button>
	</div>
</form>

<!-- Update body classes -->
<script type="text/javascript">
	document.body.className = "h-vh-100 bg-brandColor2";
</script>