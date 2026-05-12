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

		<section class="pistol-level-one" aria-labelledby="pistol-level-1-title">
			<div class="pistol-level-one-inner">
				<div class="pistol-level-one-copy">
					<p class="support-eyebrow">Pistol Level 1</p>
					<h2 id="pistol-level-1-title">Level 1 — Control and Manipulation</h2>
					<p>
						Level 1 moves beyond basic handling into repeatable pistol control. Students refine grip, presentation,
						sight management, trigger control, recoil management, reloads, and clearing common stoppages while
						maintaining strict muzzle and trigger discipline. The goal is to help students build safe, accountable
						gun handling at a higher tempo and begin performing core manipulations without sacrificing accuracy or
						awareness.
					</p>
					<!-- This placeholder will later connect to a Gravity Forms registration flow. -->
					<a class="support-button" href="#">Learn More / Register</a>
				</div>
				<div class="pistol-level-one-media">
					<img
						src="<?php echo esc_url($pistol_overview_assets_uri . '/pistol-training-overview-level-1.png'); ?>"
						alt="JM Training pistol student practicing Level 1 control and manipulation"
						width="2908"
						height="1826"
						loading="lazy"
						decoding="async"
					>
				</div>
			</div>
		</section>

		<section class="pistol-level-two" aria-labelledby="pistol-level-2-title">
			<div class="pistol-level-two-inner">
				<div class="pistol-level-two-media">
					<img
						src="<?php echo esc_url($pistol_overview_assets_uri . '/pistol-training-overview-level-2.png'); ?>"
						alt="JM Training pistol student practicing Level 2 marksmanship and target discrimination"
						width="2600"
						height="1610"
						loading="lazy"
						decoding="async"
					>
				</div>
				<div class="pistol-level-two-copy">
					<p class="support-eyebrow">Pistol Level 2</p>
					<h2 id="pistol-level-2-title">Level 2 — Spatial Awareness and Decision-Making</h2>
					<p>
						Level 2 builds spatial awareness and decision-making under greater performance pressure. Students begin
						incorporating movement, higher speed and accuracy standards, positive identification, shoot/no-shoot target
						discrimination, and more advanced low-light work. The goal is to improve the student’s ability to process the
						environment, make better decisions, and apply accurate fire only when appropriate.
					</p>
					<!-- This placeholder will later connect to a Gravity Forms registration flow. -->
					<a class="support-button" href="#">Learn More / Register</a>
				</div>
			</div>
		</section>

		<section class="pistol-level-three" aria-labelledby="pistol-level-3-title">
			<div class="pistol-level-three-inner">
				<div class="pistol-level-three-copy">
					<p class="support-eyebrow">Pistol Level 3</p>
					<h2 id="pistol-level-3-title">Level 3 — Asymmetry and Stress Integration</h2>
					<p>
						Level 3 is where the pistol progression shifts from isolated skill-building into adaptive problem-solving.
						Students are placed under greater stress, less predictable conditions, and more asymmetric shooting problems
						that require them to process information, move efficiently, communicate, use cover, and make accurate decisions
						under pressure. This level begins integrating multi-domain response concepts: movement, positioning, visual
						processing, target discrimination, low-light considerations, and performance standards that demand both speed
						and accountability. The goal is not just to shoot faster, but to remain composed, accurate, and adaptable when
						the problem is no longer clean or predictable.
					</p>
					<!-- This placeholder will later connect to a Gravity Forms registration flow. -->
					<a class="support-button" href="#">Learn More / Register</a>
				</div>
				<div class="pistol-level-three-media">
					<img
						src="<?php echo esc_url($pistol_overview_assets_uri . '/pistol-training-overview-level-3.png'); ?>"
						alt="JM Training pistol students practicing Level 3 asymmetry and stress integration"
						width="1605"
						height="980"
						loading="lazy"
						decoding="async"
					>
				</div>
			</div>
		</section>

		<section class="pistol-overview-final-cta" aria-labelledby="pistol-overview-final-title">
			<div class="pistol-overview-final-cta-inner">
				<p class="support-eyebrow">Pistol Training Path</p>
				<h2 id="pistol-overview-final-title">Build the foundation before the pressure rises.</h2>
				<p>
					The pistol program is designed to move students from safe ownership and responsible handling into accountable
					performance across Levels 0 through 3.
				</p>
				<!-- This placeholder will later connect to a Gravity Forms registration flow. -->
				<a class="support-button" href="#">Learn More / Register</a>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
