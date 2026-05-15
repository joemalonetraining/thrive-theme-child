<?php
/**
 * Template Name: Membership Application
 * Template Post Type: page
 */

$membership_application_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($membership_application_stylesheet) ? filemtime($membership_application_stylesheet) : null
);

$membership_application_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
$membership_application_home_url   = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : home_url('/');

$membership_application_default_theme = [
	'key' => 'default',
	'class' => 'is-default',
	'eyebrow' => 'JM Training Memberships',
	'headline' => 'Membership Application',
	'intro' => 'Use one application request to start a membership conversation with JM Training. Choose the tier that best matches your current training path and the team will follow up with next steps.',
	'selected_label' => 'Membership path',
	'selected_value' => 'Select a membership tier in the form',
	'image' => 'handgun-level-0-foundations.png',
	'image_width' => '2944',
	'image_height' => '1680',
	'image_alt' => 'JM Training student receiving foundational handgun instruction.',
	'image_position' => '42% center',
];

$membership_application_themes = [
	'membership' => [
		'starter' => [
			'key' => 'starter',
			'class' => 'is-starter',
			'eyebrow' => 'Starter Program Application',
			'headline' => 'Apply for the Starter Program',
			'intro' => 'You are applying for the Starter Program, the entry point for online education, community access, recurring training touchpoints, and the JM Training advancement roadmap.',
			'selected_value' => 'The Starter Program — $62.99/mo',
			'image' => 'handgun-level-0-foundations.png',
			'image_width' => '2944',
			'image_height' => '1680',
			'image_alt' => 'JM Training student receiving foundational handgun instruction.',
			'image_position' => '42% center',
		],
		'pro' => [
			'key' => 'pro',
			'class' => 'is-pro',
			'eyebrow' => 'Pro Performance Application',
			'headline' => 'Apply for Pro Performance',
			'intro' => 'You are applying for Pro Performance, the membership tier built for more consistent range access, discounted qualification training, and priority schedule movement.',
			'selected_value' => 'Pro Performance Package — $99.99/mo',
			'image' => 'handgun-level-3-dynamic-range.png',
			'image_width' => '2848',
			'image_height' => '1530',
			'image_alt' => 'JM Training student working dynamic handgun range standards.',
			'image_position' => '48% center',
		],
		'dsu' => [
			'key' => 'dsu',
			'class' => 'is-dsu',
			'eyebrow' => 'Defensive Shooting University Application',
			'headline' => 'Apply for Defensive Shooting University',
			'intro' => 'You are applying for Defensive Shooting University, the full-path membership for included qualification courses, medical blocks, private range access, and accelerated progression.',
			'selected_value' => 'Defensive Shooting University — $199.99/mo',
			'image' => 'dsu-outdoor-rifle-movement-sunset.png',
			'image_width' => '1126',
			'image_height' => '1500',
			'image_alt' => 'JM Training students moving with rifles during a Defensive Shooting University training block.',
			'image_position' => '50% center',
		],
	],
	'course' => [
		'rifle-pistol-level-4' => [
			'key' => 'rifle-pistol-level-4',
			'class' => 'is-rifle-pistol-level-4',
			'eyebrow' => 'Rifle / Pistol Level 4 Path',
			'intro' => 'This request came from the Rifle / Pistol Level 4 path. The application keeps the same integration and small-team training context while you choose the membership tier that best supports your progression.',
			'selected_label' => 'Training path',
			'selected_value' => 'Rifle / Pistol Level 4',
			'image' => 'rifle-pistol-level-4-overview.jpg',
			'image_width' => '6016',
			'image_height' => '4016',
			'image_alt' => 'Level 4 students and instructors coordinating on the range.',
			'image_position' => '50% center',
		],
		'rifle-pistol-level-5' => [
			'key' => 'rifle-pistol-level-5',
			'class' => 'is-rifle-pistol-level-5',
			'eyebrow' => 'Rifle / Pistol Level 5 Path',
			'intro' => 'This request came from the Rifle / Pistol Level 5 path. The application preserves the advanced tactical integration, night operations, and professional standards context while you choose a membership tier.',
			'selected_label' => 'Training path',
			'selected_value' => 'Rifle / Pistol Level 5',
			'image' => 'rifle-pistol-level-5-night-ops.png',
			'image_width' => '2528',
			'image_height' => '1688',
			'image_alt' => 'Rifle student using night vision equipment in an advanced training environment.',
			'image_position' => '50% center',
		],
	],
];

$has_membership_param = isset($_GET['membership']);
$requested_membership = $has_membership_param ? sanitize_key(wp_unslash($_GET['membership'])) : '';
$requested_course     = isset($_GET['course']) ? sanitize_key(wp_unslash($_GET['course'])) : '';
$application_theme    = $membership_application_default_theme;

if ($has_membership_param) {
	if (isset($membership_application_themes['membership'][$requested_membership])) {
		$application_theme = wp_parse_args($membership_application_themes['membership'][$requested_membership], $membership_application_default_theme);
	}
} elseif ($requested_course && isset($membership_application_themes['course'][$requested_course])) {
	$application_theme = wp_parse_args($membership_application_themes['course'][$requested_course], $membership_application_default_theme);
}

$application_classes = [
	'jm-support-page',
	'jm-membership-application-page',
	sanitize_html_class($application_theme['class']),
];

/*
 * Gravity Forms setup:
 * - Create one form in WP Admin titled "Membership Application".
 * - The shared form currently uses Gravity Form ID 6.
 * - Add a required "Select Your Membership" field with options:
 *   The Starter Program — $62.99/mo, Pro Performance Package — $99.99/mo,
 *   Defensive Shooting University — $199.99/mo.
 * - Collect First Name, Last Name, Email, Phone, Date of Birth,
 *   Preferred Training Location, Firearms Experience Level,
 *   Current Membership Status, Notes / Questions, and a consent checkbox
 *   acknowledging this is an application/request, not automatic enrollment.
 * - If Gravity Forms dynamic population is enabled, set the membership field
 *   parameter name to "membership" and allow values: starter, pro, dsu.
 */
$membership_application_form_shortcode = '[gravityform id="6" title="false" description="false" ajax="true"]';

$render_membership_application_hero = static function ($theme) use ($membership_application_assets_uri) {
	?>
	<section class="membership-application-hero" aria-labelledby="membership-application-title">
		<figure class="membership-application-hero-media">
			<img
				src="<?php echo esc_url($membership_application_assets_uri . '/' . ltrim($theme['image'], '/')); ?>"
				alt=""
				width="<?php echo esc_attr($theme['image_width']); ?>"
				height="<?php echo esc_attr($theme['image_height']); ?>"
				style="object-position: <?php echo esc_attr($theme['image_position']); ?>;"
				loading="eager"
				decoding="async"
			>
		</figure>
		<div class="membership-application-hero-inner">
			<div class="membership-application-copy">
				<p class="support-eyebrow"><?php echo esc_html($theme['eyebrow']); ?></p>
				<h1 id="membership-application-title"><?php echo esc_html($theme['headline']); ?></h1>
				<p><?php echo esc_html($theme['intro']); ?></p>
				<div class="membership-application-context" aria-label="<?php echo esc_attr($theme['selected_label']); ?>">
					<span><?php echo esc_html($theme['selected_label']); ?></span>
					<strong><?php echo esc_html($theme['selected_value']); ?></strong>
				</div>
			</div>
		</div>
	</section>
	<?php
};

get_header();
?>

<div class="<?php echo esc_attr(implode(' ', $application_classes)); ?>">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($membership_application_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($membership_application_assets_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Membership application</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
		<a class="support-header-cta" href="<?php echo esc_url(home_url('/memberships/')); ?>">
			Compare Memberships
		</a>
	</header>

	<main class="membership-application-main">
		<?php $render_membership_application_hero($application_theme); ?>

		<section class="membership-application-form-section" aria-labelledby="membership-application-form-title">
			<div class="membership-application-form-inner">
				<aside class="membership-application-form-summary">
					<p class="support-eyebrow">One application</p>
					<h2 id="membership-application-form-title">Select your membership and send the request.</h2>
					<p>
						This form is the intake path for Starter, Pro Performance, and Defensive Shooting University. A JM
						Training team member reviews the request before enrollment is confirmed.
					</p>
				</aside>

				<div class="membership-application-form-panel">
					<?php echo do_shortcode($membership_application_form_shortcode); ?>
				</div>
			</div>
		</section>
	</main>
</div>

<?php
get_footer();
