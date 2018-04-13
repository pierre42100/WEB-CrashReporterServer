<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application bar view file
 *
 * @author Pierre HUBERT
 */

?><header class="topbar topbar-expand-sm">
    <a href="<?php echo site_url(); ?>" class="topbar-brand fg-white border bd-white border-radius pr-2 pl-2">CrashReporter</a>
    <ul class="topbar-menu ml-2-sm">
        <li><a href="<?php echo site_url('apps'); ?>">Applications</a></li>
    </ul>
    <ul class="topbar-menu d-none d-flex-md" style="margin-left: auto">
        <li><?php echo $user->name; ?></li>
        <li><a href="<?php echo site_url('login?logout=y'); ?>">Logout</a></li>
    </ul>

   
</header>