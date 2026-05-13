<?php
/**
 * Reusable landing page for individual course levels.
 */

$course = wp_parse_args(
	$args['course'] ?? [],
	[
		'course_family' => 'pistol',
		'level' => '',
		'title' => get_the_title(),
		'label' => '',
		'eyebrow' => 'JM Training Course',
		'time' => '8:00 AM - 5:00 PM',
		'image' => '',
		'image_width' => '',
		'image_height' => '',
		'image_alt' => '',
		'image_placeholder' => '',
		'intro' => '',
		'detail' => [],
		'outcomes' => [],
		'prerequisites' => [],
		'blocks' => [],
		'cta_label' => 'Learn More / Register',
		'cta_href' => home_url('/pistol-training-overview/'),
		'overview_href' => home_url('/pistol-training-overview/'),
	]
);

$course_family    = sanitize_html_class($course['course_family']);
$assets_uri        = get_stylesheet_directory_uri() . '/assets/images';
$course_image_uri  = $course['image'] ? $assets_uri . '/' . $course['image'] : '';
$placeholder_label = $course['image_placeholder'] ?: trim($course['level'] . ' Image Placeholder');
$support_home_url  = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : home_url('/');

$course_root_classes = sprintf(
	'jm-support-page jm-course-landing jm-%1$s-course-landing',
	$course_family
);
?>

<div class="<?php echo esc_attr($course_root_classes); ?>">
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

	<main class="course-main pistol-course-main" id="top">
		<section class="course-hero pistol-course-hero" aria-labelledby="course-title">
			<div class="course-hero-media pistol-course-hero-media course-placeholder" aria-hidden="true">
				<?php if ($course_image_uri) : ?>
					<img
						src="<?php echo esc_url($course_image_uri); ?>"
						alt=""
						width="<?php echo esc_attr($course['image_width']); ?>"
						height="<?php echo esc_attr($course['image_height']); ?>"
						loading="eager"
						decoding="async"
					>
				<?php else : ?>
					<span><?php echo esc_html($placeholder_label); ?></span>
				<?php endif; ?>
			</div>
			<div class="course-hero-inner pistol-course-hero-inner">
				<div class="course-hero-copy pistol-course-hero-copy">
					<p class="support-eyebrow"><?php echo esc_html($course['eyebrow']); ?></p>
					<h1 id="course-title"><?php echo esc_html($course['title']); ?></h1>
					<p><?php echo esc_html($course['intro']); ?></p>
					<div class="course-actions pistol-course-actions" aria-label="Course actions">
						<a class="support-button" href="<?php echo esc_url($course['cta_href']); ?>">
							<?php echo esc_html($course['cta_label']); ?>
						</a>
						<a class="support-button support-button-secondary" href="<?php echo esc_url($course['overview_href']); ?>">
							View Training Path
						</a>
					</div>
					<!-- This placeholder will later connect to a Gravity Forms registration flow. -->
				</div>
				<div class="course-quick-facts pistol-course-quick-facts" aria-label="Course quick facts">
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

		<section class="course-overview pistol-course-overview" aria-labelledby="course-overview-title">
			<div class="course-overview-inner pistol-course-overview-inner">
				<div class="course-overview-copy pistol-course-overview-copy">
					<p class="support-eyebrow">Course Overview</p>
					<h2 id="course-overview-title">What This Course Builds</h2>
					<?php foreach ($course['detail'] as $paragraph) : ?>
						<p><?php echo esc_html($paragraph); ?></p>
					<?php endforeach; ?>
				</div>
				<div class="course-overview-media pistol-course-overview-media course-placeholder" role="img" aria-label="<?php echo esc_attr($course_image_uri ? $course['image_alt'] : $placeholder_label); ?>">
					<?php if ($course_image_uri) : ?>
						<img
							src="<?php echo esc_url($course_image_uri); ?>"
							alt="<?php echo esc_attr($course['image_alt']); ?>"
							width="<?php echo esc_attr($course['image_width']); ?>"
							height="<?php echo esc_attr($course['image_height']); ?>"
							loading="lazy"
							decoding="async"
						>
					<?php else : ?>
						<span><?php echo esc_html($placeholder_label); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<?php if (! empty($course['outcomes'])) : ?>
			<section class="course-section pistol-course-section" aria-labelledby="course-outcomes-title">
				<div class="course-section-heading pistol-course-section-heading">
					<p class="support-eyebrow">Training Focus</p>
					<h2 id="course-outcomes-title">Primary Course Outcomes</h2>
				</div>
				<div class="course-outcomes pistol-course-outcomes">
					<?php foreach ($course['outcomes'] as $outcome) : ?>
						<article class="course-outcome pistol-course-outcome">
							<h3><?php echo esc_html($outcome['title']); ?></h3>
							<p><?php echo esc_html($outcome['text']); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="course-section pistol-course-section" aria-labelledby="course-blocks-title">
			<div class="course-section-heading pistol-course-section-heading">
				<p class="support-eyebrow">8:00 AM - 5:00 PM</p>
				<h2 id="course-blocks-title">Alpha and Bravo Blocks</h2>
			</div>
			<div class="course-blocks pistol-course-blocks">
				<?php foreach ($course['blocks'] as $block) : ?>
					<article class="course-block pistol-course-block">
						<div class="course-block-header pistol-course-block-header">
							<p class="support-eyebrow"><?php echo esc_html($block['name']); ?></p>
							<strong><?php echo esc_html($block['time']); ?></strong>
						</div>
						<h3><?php echo esc_html($block['title']); ?></h3>
						<p><?php echo esc_html($block['text']); ?></p>
						<div class="course-qualification pistol-course-qualification">
							<span>Qualification Required</span>
							<p><?php echo esc_html($block['qualification']); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<?php if (! empty($course['prerequisites'])) : ?>
			<section class="course-section course-readiness pistol-course-section pistol-course-readiness" aria-labelledby="course-readiness-title">
				<div>
					<p class="support-eyebrow">Student Readiness</p>
					<h2 id="course-readiness-title">Before You Register</h2>
				</div>
				<ul>
					<?php foreach ($course['prerequisites'] as $prerequisite) : ?>
						<li><?php echo esc_html($prerequisite); ?></li>
					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>

		<section class="course-final-cta pistol-course-final-cta" aria-labelledby="course-registration-title">
			<div>
				<p class="support-eyebrow"><?php echo esc_html($course['level']); ?> Registration</p>
				<h2 id="course-registration-title">Train the standard before moving forward.</h2>
				<p>
					Registration will connect here once the Gravity Forms flow is ready. Until then, this page keeps the
					course structure, imagery, and calls to action in place for review.
				</p>
			</div>
			<a class="support-button" href="<?php echo esc_url($course['cta_href']); ?>">
				<?php echo esc_html($course['cta_label']); ?>
			</a>
		</section>
	</main>
</div>
