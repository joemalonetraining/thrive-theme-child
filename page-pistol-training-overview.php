<?php
/**
 * Template Name: Pistol Training Overview
 * Template Post Type: page
 */

$pistol_overview_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($pistol_overview_stylesheet) ? filemtime($pistol_overview_stylesheet) : null
);

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
				</div>
			</div>
		</section>

		<section class="pistol-level-zero" aria-labelledby="pistol-level-0-title">
			<div class="pistol-level-zero-inner">
				<div class="pistol-level-zero-media">
					<img
						src="<?php echo esc_url($pistol_overview_assets_uri . '/pistol-training-overview-level-0.png'); ?>"
						alt="JM Training pistol student receiving Level 0 handgun instruction"
						width="2944"
						height="1680"
						loading="eager"
						decoding="async"
					>
				</div>
				<div class="pistol-level-zero-copy">
					<p class="support-eyebrow">Pistol Level 0</p>
					<h2 id="pistol-level-0-title">Level 0 — Foundation</h2>
					<p>
						Level 0 is the foundation of the pistol training path. This course introduces the student to handgun safety,
						basic handgun nomenclature, how a handgun works, safe handling, storage and daily responsibility, proper grip,
						stance, basic marksmanship, and an introductory holster draw. The goal is to help students understand how to
						live with a handgun safely, handle it responsibly, and begin building the skill to draw and fire without
						endangering themselves or innocent people.
					</p>
					<!-- This placeholder will later connect to a Gravity Forms registration flow. -->
					<a class="support-button" href="#">Learn More / Register</a>
				</div>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
