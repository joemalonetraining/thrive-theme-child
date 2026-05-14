<?php
/**
 * Template Name: Rifle / Pistol Training Overview
 * Template Post Type: page
 */

$rifle_pistol_overview_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($rifle_pistol_overview_stylesheet) ? filemtime($rifle_pistol_overview_stylesheet) : null
);

get_header();

$rifle_pistol_overview_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
$rifle_pistol_overview_home_url   = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : home_url('/');
?>

<div class="jm-support-page jm-rifle-pistol-training-overview-page">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($rifle_pistol_overview_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($rifle_pistol_overview_assets_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Rifle / Pistol Overview</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
	</header>

	<main class="support-main" id="top">
		<section class="rifle-pistol-overview-hero" aria-labelledby="rifle-pistol-training-overview-title">
			<div class="rifle-pistol-overview-hero-inner">
				<div class="rifle-pistol-overview-copy">
					<p class="support-eyebrow">JM Training Courses</p>
					<h1 id="rifle-pistol-training-overview-title">Rifle / Pistol Training Overview</h1>
					<p>
						The Rifle / Pistol progression is where the training path moves beyond isolated weapon systems and begins
						integrating rifle, pistol, movement, communication, decision-making, and higher-risk scenario work. These
						levels are intended for students who have already built accountable skill through the earlier pistol and
						rifle progressions.
					</p>
				</div>
			</div>
		</section>

		<section class="rifle-pistol-level-four" aria-labelledby="rifle-pistol-level-4-title">
			<div class="rifle-pistol-level-four-inner">
				<figure class="rifle-pistol-level-four-media">
					<img
						src="<?php echo esc_url($rifle_pistol_overview_assets_uri . '/rifle-pistol-level-4-overview.jpg'); ?>"
						alt="Level 4 students and instructors coordinating on the range."
						width="6016"
						height="4016"
						loading="lazy"
						decoding="async"
					>
				</figure>
				<div class="rifle-pistol-level-four-copy">
					<p class="support-eyebrow">Rifle / Pistol Level 4</p>
					<h2 id="rifle-pistol-level-4-title">Level 4 — Rifle / Pistol Integration and Small-Team Foundations</h2>
					<p>
						Level 4 begins the combined use of rifle and pistol under structured performance standards. Students work
						through transitions, positional problem-solving, specialty training events, communication, movement, use of
						cover, and the early stages of tactical and small-team decision-making. The focus is not simply switching
						between weapon systems, but understanding when and why each tool is appropriate while maintaining safety,
						accountability, and disciplined decision-making under pressure.
					</p>
					<a class="support-button" href="<?php echo esc_url(home_url('/rifle-pistol-level-4/')); ?>">Learn More / Register</a>
				</div>
			</div>
		</section>

		<section class="rifle-pistol-level-five" aria-labelledby="rifle-pistol-level-5-title">
			<div class="rifle-pistol-level-five-inner">
				<div class="rifle-pistol-level-five-copy">
					<p class="support-eyebrow">Rifle / Pistol Level 5</p>
					<h2 id="rifle-pistol-level-5-title">Level 5 — Advanced Tactical Integration and High-Risk Scenarios</h2>
					<p>
						Level 5 is the most advanced level in the JM Training progression. This level is reserved for highly capable
						professionals and deeply committed students who have demonstrated maturity, discipline, and the ability to
						perform safely under stress. Training may include night vision goggle integration, IR aiming systems,
						strobes, fog, visual and audio stress effects, simulated explosive effects, breaching concepts, and complex
						scenario-driven exercises. The focus is advanced tactics, communication, judgment, and stress-induced
						decision-making in demanding environments.
					</p>
					<a class="support-button" href="<?php echo esc_url(home_url('/rifle-pistol-level-5/')); ?>">Learn More / Register</a>
				</div>
				<div class="rifle-pistol-level-five-media rifle-pistol-placeholder-media" role="img" aria-label="Rifle / Pistol Level 5 image placeholder">
					<span>Level 5 Image Placeholder</span>
				</div>
			</div>
		</section>

		<section class="rifle-pistol-overview-final-cta" aria-labelledby="rifle-pistol-overview-final-title">
			<div class="rifle-pistol-overview-final-cta-inner">
				<p class="support-eyebrow">Combined Systems Path</p>
				<h2 id="rifle-pistol-overview-final-title">Integrate skill only after the foundation is earned.</h2>
				<p>
					Levels 4 and 5 are selective progression levels for students who can maintain safety, judgment, and performance
					while the problem becomes more complex.
				</p>
				<a class="support-button" href="<?php echo esc_url(home_url('/rifle-pistol-level-4/')); ?>">Learn More / Register</a>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
