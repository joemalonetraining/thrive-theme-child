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
		<section class="support-hero" aria-labelledby="pistol-training-overview-title">
			<div class="support-hero-inner">
				<h1 id="pistol-training-overview-title">Pistol Training Overview</h1>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
