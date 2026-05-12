<?php
/**
 * Template Name: Pistol Training Overview
 * Template Post Type: page
 */

get_header();

$pistol_overview_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
$pistol_overview_home_url = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : '#top';
?>

<div class="jm-support-page jm-pistol-training-overview-page">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($pistol_overview_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($pistol_overview_assets_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Course Overview</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
	</header>

	<main class="support-main" id="top">
		<section class="pistol-overview-hero" aria-labelledby="pistol-training-overview-title">
			<div class="pistol-overview-hero-inner">
				<div class="pistol-overview-copy">
					<p class="support-eyebrow">JM Training Courses</p>
					<h1 id="pistol-training-overview-title">Pistol Training Overview</h1>
					<p>
						A structured progression from safe foundational handling to applied performance under pressure.
						Each level builds on measurable standards before the student moves forward.
					</p>
				</div>
				<div class="pistol-overview-media" aria-label="Pistol instruction at JM Training">
					<img
						src="<?php echo esc_url($pistol_overview_assets_uri . '/pistol-training-overview-level-0.png'); ?>"
						alt="JM Training instructor coaching a pistol student on the indoor range"
						width="2944"
						height="1680"
						loading="eager"
						decoding="async"
					>
				</div>
			</div>
		</section>

		<section class="pistol-level-overview" aria-labelledby="pistol-level-overview-title">
			<div class="pistol-level-overview-inner">
				<div class="pistol-level-heading">
					<p class="support-eyebrow">Pistol Progression</p>
					<h2 id="pistol-level-overview-title">Move through the levels in order.</h2>
				</div>
				<div class="pistol-level-list">
					<article class="pistol-level-card">
						<span>Level 0</span>
						<h3>Foundation and Safe Operation</h3>
						<p>Build safe handling, loading, unloading, storage, transport, range conduct, and basic marksmanship.</p>
						<a class="support-button" href="<?php echo esc_url(home_url('/pistol-training-level-0/')); ?>">Learn More / Register</a>
					</article>

					<article class="pistol-level-card">
						<span>Level 1</span>
						<h3>Control and Manipulation</h3>
						<p>Develop repeatable presentation, recoil control, reloads, stoppage response, and accuracy standards.</p>
						<a class="support-button" href="<?php echo esc_url(home_url('/pistol-training-level-1/')); ?>">Learn More / Register</a>
					</article>

					<article class="pistol-level-card">
						<span>Level 2</span>
						<h3>Movement and Applied Standards</h3>
						<p>Add movement, communication, positional awareness, and accountability around other trained students.</p>
						<a class="support-button" href="<?php echo esc_url(home_url('/pistol-training-level-2/')); ?>">Learn More / Register</a>
					</article>

					<article class="pistol-level-card">
						<span>Level 3</span>
						<h3>Dynamic Problem Solving</h3>
						<p>Apply the system through more complex range problems while maintaining control, safety, and discipline.</p>
						<a class="support-button" href="<?php echo esc_url(home_url('/pistol-training-level-3/')); ?>">Learn More / Register</a>
					</article>
				</div>
				<!-- Replace the level links with Gravity Forms registration flows when those forms are ready. -->
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
