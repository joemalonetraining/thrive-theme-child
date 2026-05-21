<?php
/**
 * Support-page JM Training navigation framework.
 */
?>
<nav class="desktop-nav jm-site-nav" aria-label="Program sections">
	<details class="nav-dropdown">
		<summary>IL CCL</summary>
		<div class="nav-dropdown-menu">
			<a href="<?php echo esc_url(home_url('/register-for-16-hour-il-conceal-carry/')); ?>">16-Hour Illinois CCL</a>
			<a href="<?php echo esc_url(home_url('/register-for-3-hour-il-conceal-carry-renewal/')); ?>">3-Hour Renewal</a>
		</div>
	</details>

	<a href="<?php echo esc_url(home_url('/calendar/')); ?>">Calendar</a>
	<a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a>

	<details class="nav-dropdown">
		<summary>Store</summary>
		<div class="nav-dropdown-menu">
			<a href="#">Firearms &amp; Gear</a>
			<a href="#">Clothing</a>
			<a href="#">Ammo</a>
		</div>
	</details>

	<details class="nav-dropdown">
		<summary>Courses</summary>
		<div class="nav-dropdown-menu">
			<a href="<?php echo esc_url(home_url('/pistol-training-overview/')); ?>">Pistol</a>
			<a href="<?php echo esc_url(home_url('/rifle-training-overview/')); ?>">Rifle</a>
			<a href="<?php echo esc_url(home_url('/rifle-pistol-training-overview/')); ?>">Rifle &amp; Pistol</a>
		</div>
	</details>

	<a href="<?php echo esc_url(home_url('/free-tips/')); ?>">Blog</a>
	<a href="https://lighthearted-sunshine-7b3213.netlify.app/?view=event-display">Leaderboard</a>
	<a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Us</a>
</nav>
