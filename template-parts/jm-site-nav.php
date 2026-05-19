<?php
/**
 * Support-page JM Training navigation framework.
 */
?>
<nav class="desktop-nav jm-site-nav" aria-label="Program sections">
	<details class="nav-dropdown">
		<summary>IL CCL</summary>
		<div class="nav-dropdown-menu">
			<a href="<?php echo esc_url(home_url('/16-hour-illinois-ccl/')); ?>">16-Hour Illinois CCL</a>
			<a href="<?php echo esc_url(home_url('/register-for-3-hour-il-conceal-carry-renewal/')); ?>">3-Hour Renewal</a>
		</div>
	</details>

	<a href="<?php echo esc_url(home_url('/calendar/')); ?>">Calendar</a>
	<a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a>

	<details class="nav-dropdown">
		<summary>Courses</summary>
		<div class="nav-dropdown-menu">
			<a href="<?php echo esc_url(home_url('/pistol-training-overview/')); ?>">Pistol</a>
			<a href="<?php echo esc_url(home_url('/rifle-training-overview/')); ?>">Rifle</a>
			<a href="<?php echo esc_url(home_url('/rifle-pistol-training-overview/')); ?>">Rifle &amp; Pistol</a>
		</div>
	</details>

	<a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
	<a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Us</a>
</nav>
