<?php
/**
 * Template Name: JM Pistol Courses
 * Template Post Type: page
 */

get_header();

$pistol_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
$pistol_home_url   = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : '#top';
?>

<div class="jm-support-page jm-pistol-page">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($pistol_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($pistol_assets_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Handgun Training Progression</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
		<a class="support-header-cta" href="#ghl-course-signup">Request Course Info</a>
	</header>

	<main class="pistol-main" id="top">
		<section class="pistol-hero" aria-labelledby="pistol-page-title">
			<div class="pistol-hero-inner">
				<p class="support-eyebrow">JM Training Courses</p>
				<h1 id="pistol-page-title">Handgun Training Progression</h1>
				<p>
					Foundational ownership. Measurable standards. Controlled development from Level 0 through Level 3.
				</p>
				<div class="pistol-actions" aria-label="Pistol training calls to action">
					<a class="support-button" href="#pistol-levels">View Training Path</a>
					<a class="support-button support-button-secondary" href="#ghl-course-signup">Request Course Info</a>
				</div>
				<!-- Replace #ghl-course-signup with the final Go High Level pistol course signup URL or embedded form. -->
			</div>
		</section>

		<section class="pistol-blocks" aria-labelledby="training-blocks-title">
			<div class="pistol-blocks-inner">
				<div class="pistol-blocks-copy">
					<p class="support-eyebrow">Structured Development</p>
					<h2 id="training-blocks-title">Training Blocks</h2>
					<p>
						Each course level is divided into structured training blocks such as Alpha, Bravo, Charlie, and Delta.
						Some levels contain multiple blocks. Each block narrows the focus, develops specific competencies, and
						prepares the student for the next standard.
					</p>
					<p>
						Students progress through increasingly advanced material inside each level without being rushed past the
						work that matters. Blocks also give students a clear way to revisit, measure, and refine specific skills
						before advancing.
					</p>
				</div>
				<div class="pistol-blocks-card" aria-label="Training block examples">
					<span>Alpha</span>
					<span>Bravo</span>
					<span>Charlie</span>
					<span>Delta</span>
					<strong>Progression is built through measurable repetitions and layered competency, not rushed exposure.</strong>
				</div>
			</div>
		</section>

		<section class="pistol-levels" id="pistol-levels" aria-label="Pistol training levels">
			<article class="pistol-level-section level-0">
				<div class="pistol-level-media">
					<img
						src="<?php echo esc_url($pistol_assets_uri . '/handgun-level-0-foundations.png'); ?>"
						alt="Instructor coaching a new handgun student on the indoor range"
						width="2944"
						height="1680"
						loading="eager"
						decoding="async"
					>
				</div>
				<div class="pistol-level-content">
					<p class="support-eyebrow">Level 0</p>
					<h2>Safe Ownership and Foundational Handling</h2>
					<p>
						Level 0 is where responsible handgun ownership becomes disciplined handling. Students learn safety,
						nomenclature, storage, transport, carry considerations, and the accountability that comes with possessing
						a firearm.
					</p>
					<p>
						The work stays controlled. Students build safe operation, basic marksmanship, and lawful defensive
						application under instruction before adding speed or complexity.
					</p>
					<ul>
						<li>Safe handling, storage, travel, and range conduct</li>
						<li>Handgun nomenclature, loading, unloading, and verification</li>
						<li>Carry responsibility, decision-making, and safe operation under stress</li>
					</ul>
				</div>
			</article>

			<article class="pistol-level-section level-1 is-reversed">
				<div class="pistol-level-media">
					<img
						src="<?php echo esc_url($pistol_assets_uri . '/handgun-level-1-manipulation.png'); ?>"
						alt="Student reloading a handgun on an indoor firing line"
						width="2908"
						height="1826"
						loading="lazy"
						decoding="async"
					>
				</div>
				<div class="pistol-level-content">
					<p class="support-eyebrow">Level 1</p>
					<h2>Manipulation and Consistency</h2>
					<p>
						Level 1 turns basic handling into repeatable work. Students refine presentation, recoil management,
						reloads, stoppage response, and accuracy standards with a clear expectation for consistency.
					</p>
					<ul>
						<li>Repeatable grip, presentation, and sight management</li>
						<li>Reloads, basic stoppages, and structured repetitions</li>
						<li>Performance standards that expose weak fundamentals</li>
					</ul>
				</div>
			</article>

			<article class="pistol-level-section level-2">
				<div class="pistol-level-media">
					<img
						src="<?php echo esc_url($pistol_assets_uri . '/handgun-level-2-line-training.png'); ?>"
						alt="Indoor handgun class training together on a firing line"
						width="3190"
						height="1726"
						loading="lazy"
						decoding="async"
					>
				</div>
				<div class="pistol-level-content">
					<p class="support-eyebrow">Level 2</p>
					<h2>Movement, Line Work, and Applied Standards</h2>
					<p>
						Level 2 adds movement, communication, positional awareness, and accountability around other trained
						people. The student must keep control while solving problems in a more demanding environment.
					</p>
					<ul>
						<li>Movement with safe muzzle and trigger discipline</li>
						<li>Structured line work and pressure-based standards</li>
						<li>Decision-making without abandoning fundamentals</li>
					</ul>
				</div>
			</article>

			<article class="pistol-level-section level-3 is-reversed">
				<div class="pistol-level-media">
					<img
						src="<?php echo esc_url($pistol_assets_uri . '/handgun-level-3-dynamic-range.png'); ?>"
						alt="Outdoor handgun training with dynamic range problem solving"
						width="2848"
						height="1530"
						loading="lazy"
						decoding="async"
					>
				</div>
				<div class="pistol-level-content">
					<p class="support-eyebrow">Level 3</p>
					<h2>Dynamic Problem Solving</h2>
					<p>
						Level 3 applies the system in a more complex range environment. Students work through movement,
						transitions, timing, visual processing, and lawful defensive decision-making while maintaining safety and
						control.
					</p>
					<ul>
						<li>Applied movement and target discrimination</li>
						<li>Standards that require control under pressure</li>
						<li>Problem-solving built on earned fundamentals</li>
					</ul>
				</div>
			</article>
		</section>

		<section class="pistol-final-cta" id="ghl-course-signup" aria-labelledby="pistol-signup-title">
			<div>
				<p class="support-eyebrow">Pistol Levels 0-3</p>
				<h2 id="pistol-signup-title">Begin the progression with standards.</h2>
				<p>
					Use this route if you want structured handgun development from safe ownership through applied performance.
				</p>
			</div>
			<a class="support-button" href="#ghl-course-signup">Request Course Info</a>
			<!-- Insert the final Go High Level course form or payment flow here. -->
		</section>
	</main>
</div>

<?php get_footer(); ?>
