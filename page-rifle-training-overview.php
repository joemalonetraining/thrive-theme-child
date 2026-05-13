<?php
/**
 * Template Name: Rifle Training Overview
 * Template Post Type: page
 */

$rifle_overview_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($rifle_overview_stylesheet) ? filemtime($rifle_overview_stylesheet) : null
);

get_header();

$rifle_overview_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
$rifle_overview_home_url   = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : home_url('/');
?>

<div class="jm-support-page jm-rifle-training-overview-page">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($rifle_overview_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($rifle_overview_assets_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Rifle Course Overview</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
	</header>

	<main class="support-main" id="top">
		<section class="rifle-overview-hero" aria-labelledby="rifle-training-overview-title">
			<div class="rifle-overview-hero-inner">
				<div class="rifle-overview-copy">
					<p class="support-eyebrow">JM Training Courses</p>
					<h1 id="rifle-training-overview-title">Rifle Training Overview</h1>
				</div>
			</div>
		</section>

		<section class="rifle-level-zero" aria-labelledby="rifle-level-0-title">
			<div class="rifle-level-zero-inner">
				<div class="rifle-level-zero-media">
					<img
						src="<?php echo esc_url($rifle_overview_assets_uri . '/rifle-training-overview-level-0.png'); ?>"
						alt="JM Training rifle student receiving Level 0 rifle foundation instruction"
						width="2008"
						height="1604"
						loading="eager"
						decoding="async"
					>
				</div>
				<div class="rifle-level-zero-copy">
					<p class="support-eyebrow">Rifle Level 0</p>
					<h2 id="rifle-level-0-title">Level 0 — Rifle Foundation</h2>
					<p>
						Level 0 introduces safe rifle ownership, rifle nomenclature, administrative handling, loading and unloading,
						storage responsibility, supported and unsupported positions, sighting concepts, and deliberate marksmanship.
						The goal is to build a disciplined foundation before speed, movement, or added complexity are introduced.
					</p>
					<a class="support-button" href="<?php echo esc_url(home_url('/rifle-level-0/')); ?>">Learn More / Register</a>
				</div>
			</div>
		</section>

		<section class="rifle-level-one" aria-labelledby="rifle-level-1-title">
			<div class="rifle-level-one-inner">
				<div class="rifle-level-one-copy">
					<p class="support-eyebrow">Rifle Level 1</p>
					<h2 id="rifle-level-1-title">Level 1 — Control and Manipulation</h2>
					<p>
						Level 1 develops the rifle student’s ability to manage the platform with consistency. Students refine
						mounting, ready positions, recoil control, reloads, malfunction response, sling awareness, and accountable
						accuracy standards while maintaining safe muzzle discipline and deliberate target confirmation.
					</p>
					<a class="support-button" href="<?php echo esc_url(home_url('/rifle-level-1/')); ?>">Learn More / Register</a>
				</div>
				<div class="rifle-level-one-media">
					<img
						src="<?php echo esc_url($rifle_overview_assets_uri . '/rifle-training-overview-level-1.png'); ?>"
						alt="JM Training rifle student practicing Level 1 control and manipulation"
						width="3240"
						height="1812"
						loading="lazy"
						decoding="async"
					>
				</div>
			</div>
		</section>

		<section class="rifle-level-two" aria-labelledby="rifle-level-2-title">
			<div class="rifle-level-two-inner">
				<div class="rifle-level-two-media">
					<img
						src="<?php echo esc_url($rifle_overview_assets_uri . '/rifle-training-overview-level-2.png'); ?>"
						alt="JM Training rifle students practicing Level 2 movement and target processing"
						width="4324"
						height="2010"
						loading="lazy"
						decoding="async"
					>
				</div>
				<div class="rifle-level-two-copy">
					<p class="support-eyebrow">Rifle Level 2</p>
					<h2 id="rifle-level-2-title">Level 2 — Movement and Target Processing</h2>
					<p>
						Level 2 adds movement, positional transitions, target processing, communication, and higher standards for
						accuracy under pressure. Students begin applying rifle fundamentals while managing distance, angles,
						positive identification, and the discipline required to fire only when appropriate.
					</p>
					<a class="support-button" href="<?php echo esc_url(home_url('/rifle-level-2/')); ?>">Learn More / Register</a>
				</div>
			</div>
		</section>

		<section class="rifle-level-three" aria-labelledby="rifle-level-3-title">
			<div class="rifle-level-three-inner">
				<div class="rifle-level-three-copy">
					<p class="support-eyebrow">Rifle Level 3</p>
					<h2 id="rifle-level-3-title">Level 3 — Applied Rifle Integration</h2>
					<p>
						Level 3 places rifle skills into less predictable problems that demand composure, movement, communication,
						use of cover, visual processing, and responsible decision-making. The focus is not simply speed, but the
						ability to stay controlled, accurate, and accountable as the problem becomes more dynamic.
					</p>
					<a class="support-button" href="<?php echo esc_url(home_url('/rifle-level-3/')); ?>">Learn More / Register</a>
				</div>
				<div class="rifle-level-three-media">
					<img
						src="<?php echo esc_url($rifle_overview_assets_uri . '/rifle-training-overview-level-3.png'); ?>"
						alt="JM Training rifle student practicing Level 3 applied rifle integration"
						width="1146"
						height="888"
						loading="lazy"
						decoding="async"
					>
				</div>
			</div>
		</section>

		<section class="rifle-overview-final-cta" aria-labelledby="rifle-overview-final-title">
			<div class="rifle-overview-final-cta-inner">
				<p class="support-eyebrow">Rifle Training Path</p>
				<h2 id="rifle-overview-final-title">Build rifle skill with measured progression.</h2>
				<p>
					The rifle program is structured to move students from safe platform handling into controlled performance,
					movement, target processing, and applied decision-making across Levels 0 through 3.
				</p>
				<a class="support-button" href="<?php echo esc_url(home_url('/rifle-level-0/')); ?>">Learn More / Register</a>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
