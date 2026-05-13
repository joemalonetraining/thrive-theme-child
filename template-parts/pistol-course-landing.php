<?php
/**
 * Reusable landing page for individual pistol course levels.
 */

$course = wp_parse_args(
	$args['course'] ?? [],
	[
		'level' => '',
		'title' => get_the_title(),
		'label' => '',
		'eyebrow' => 'JM Training Pistol Course',
		'time' => '8:00 AM - 5:00 PM',
		'image' => '',
		'image_width' => '',
		'image_height' => '',
		'image_alt' => '',
		'intro' => '',
		'detail' => [],
		'outcomes' => [],
		'prerequisites' => [],
		'blocks' => [],
		'cta_label' => 'Learn More / Register',
		'cta_href' => '#course-registration',
	]
);

$assets_uri       = get_stylesheet_directory_uri() . '/assets/images';
$course_image_uri = $course['image'] ? $assets_uri . '/' . $course['image'] : '';
$support_home_url = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : '#top';
?>

<div class="jm-support-page jm-pistol-course-landing">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($support_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($assets_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small><?php echo esc_html($course['level']); ?> Course</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
		<a class="support-header-cta" href="<?php echo esc_url($course['cta_href']); ?>">
			<?php echo esc_html($course['cta_label']); ?>
		</a>
	</header>

	<main class="pistol-course-main" id="top">
		<section class="pistol-course-hero" aria-labelledby="pistol-course-title">
			<?php if ($course_image_uri) : ?>
				<div class="pistol-course-hero-media" aria-hidden="true">
					<img
						src="<?php echo esc_url($course_image_uri); ?>"
						alt=""
						width="<?php echo esc_attr($course['image_width']); ?>"
						height="<?php echo esc_attr($course['image_height']); ?>"
						loading="eager"
						decoding="async"
					>
				</div>
			<?php endif; ?>
			<div class="pistol-course-hero-inner">
				<div class="pistol-course-hero-copy">
					<p class="support-eyebrow"><?php echo esc_html($course['eyebrow']); ?></p>
					<h1 id="pistol-course-title"><?php echo esc_html($course['title']); ?></h1>
					<p><?php echo esc_html($course['intro']); ?></p>
					<div class="pistol-course-actions" aria-label="Course actions">
						<a class="support-button" href="<?php echo esc_url($course['cta_href']); ?>">
							<?php echo esc_html($course['cta_label']); ?>
						</a>
						<a class="support-button support-button-secondary" href="/pistol-training-overview/">
							View Training Path
						</a>
					</div>
					<!-- This placeholder will later connect to a Gravity Forms registration flow. -->
				</div>
				<div class="pistol-course-quick-facts" aria-label="Course quick facts">
					<div>
						<span>Course Day</span>
						<strong><?php echo esc_html($course['time']); ?></strong>
					</div>
					<div>
						<span>Training Blocks</span>
						<strong>Alpha + Bravo</strong>
					</div>
					<div>
						<span>Progression</span>
						<strong><?php echo esc_html($course['label']); ?></strong>
					</div>
				</div>
			</div>
		</section>

		<section class="pistol-course-overview" aria-labelledby="pistol-course-overview-title">
			<div class="pistol-course-overview-inner">
				<div class="pistol-course-overview-copy">
					<p class="support-eyebrow">Course Overview</p>
					<h2 id="pistol-course-overview-title">What This Course Builds</h2>
					<?php foreach ($course['detail'] as $paragraph) : ?>
						<p><?php echo esc_html($paragraph); ?></p>
					<?php endforeach; ?>
				</div>
				<?php if ($course_image_uri) : ?>
					<div class="pistol-course-overview-media">
						<img
							src="<?php echo esc_url($course_image_uri); ?>"
							alt="<?php echo esc_attr($course['image_alt']); ?>"
							width="<?php echo esc_attr($course['image_width']); ?>"
							height="<?php echo esc_attr($course['image_height']); ?>"
							loading="lazy"
							decoding="async"
						>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<?php if (! empty($course['outcomes'])) : ?>
			<section class="pistol-course-section" aria-labelledby="pistol-course-outcomes-title">
				<div class="pistol-course-section-heading">
					<p class="support-eyebrow">Training Focus</p>
					<h2 id="pistol-course-outcomes-title">Primary Course Outcomes</h2>
				</div>
				<div class="pistol-course-outcomes">
					<?php foreach ($course['outcomes'] as $outcome) : ?>
						<article class="pistol-course-outcome">
							<h3><?php echo esc_html($outcome['title']); ?></h3>
							<p><?php echo esc_html($outcome['text']); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="pistol-course-section" aria-labelledby="pistol-course-blocks-title">
			<div class="pistol-course-section-heading">
				<p class="support-eyebrow">8:00 AM - 5:00 PM</p>
				<h2 id="pistol-course-blocks-title">Alpha and Bravo Blocks</h2>
			</div>
			<div class="pistol-course-blocks">
				<?php foreach ($course['blocks'] as $block) : ?>
					<article class="pistol-course-block">
						<div class="pistol-course-block-header">
							<p class="support-eyebrow"><?php echo esc_html($block['name']); ?></p>
							<strong><?php echo esc_html($block['time']); ?></strong>
						</div>
						<h3><?php echo esc_html($block['title']); ?></h3>
						<p><?php echo esc_html($block['text']); ?></p>
						<div class="pistol-course-qualification">
							<span>Qualification Required</span>
							<p><?php echo esc_html($block['qualification']); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<?php if (! empty($course['prerequisites'])) : ?>
			<section class="pistol-course-section pistol-course-readiness" aria-labelledby="pistol-course-readiness-title">
				<div>
					<p class="support-eyebrow">Student Readiness</p>
					<h2 id="pistol-course-readiness-title">Before You Register</h2>
				</div>
				<ul>
					<?php foreach ($course['prerequisites'] as $prerequisite) : ?>
						<li><?php echo esc_html($prerequisite); ?></li>
					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>

		<section class="pistol-course-final-cta" id="course-registration" aria-labelledby="pistol-course-registration-title">
			<div>
				<p class="support-eyebrow"><?php echo esc_html($course['level']); ?> Registration</p>
				<h2 id="pistol-course-registration-title">Train the standard before moving forward.</h2>
				<p>
					Registration will connect here once the Gravity Forms flow is ready. Until then, this preview keeps the
					page structure, course language, and calls to action in place for review.
				</p>
			</div>
			<a class="support-button" href="<?php echo esc_url($course['cta_href']); ?>">
				<?php echo esc_html($course['cta_label']); ?>
			</a>
		</section>
	</main>
</div>
