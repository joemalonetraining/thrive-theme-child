<?php
/**
 * Template Name: Defensive Shooting University Membership
 * Template Post Type: page
 */

$membership_tier_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($membership_tier_stylesheet) ? filemtime($membership_tier_stylesheet) : null
);

$jm_membership_tier = [
	'eyebrow' => 'JM Training Membership',
	'title' => 'Defensive Shooting University',
	'label' => 'Full Path',
	'price' => '$199.99',
	'price_suffix' => '/mo',
	'badge' => 'Full Path',
	'intro' => 'Defensive Shooting University is the full-path membership for students who want the deepest access, included qualification courses, medical blocks, private range access, and accelerated progression.',
	'cta_label' => 'Enrollment Currently Open — Apply Here',
	'cta_href' => 'https://api.cavucrm.com/widget/form/rxs8Ko3LXRYXhC6jdZ2p',
	'cta_event' => 'dsu_apply_click',
	'cta_support_points' => [
		'Application takes less than 2 minutes.',
		'Immediate enrollment review.',
		'Built for serious students committed to progression.',
	],
	'show_mobile_sticky_cta' => true,
	'landing_layout' => true,
	'header_nav_items' => [
		[
			'label' => 'Benefits',
			'href' => '#benefits',
		],
		[
			'label' => 'APPLY TO DSU',
			'href' => '#final',
		],
	],
	'proof_points' => [
		'Includes everything in Pro Performance',
		'All qualification courses included, Levels 0-5',
		'Medical blocks, private range access, and accelerated progression',
	],
	'hero_background_image' => 'dsu-low-light-hero.png',
	'hero_background_position' => 'center center',
	'feature_media_heading' => 'The full path is built around applied performance.',
	'feature_media_intro' => 'DSU members are not just buying range time. The program puts students into live skill work, structured coaching, movement, light, decision-making, rifle integration, and pressure that has to be managed with discipline.',
	'feature_media' => [
		'image' => 'dsu-outdoor-rifle-movement-sunset.png',
		'width' => '1126',
		'height' => '1500',
		'alt' => 'JM Training students moving with rifles during an outdoor Defensive Shooting University training block',
		'caption' => 'Live skill work under structured coaching.',
	],
	'benefits_heading' => 'Everything in Pro, plus the full DSU path',
	'benefits' => [
		[
			'title' => 'All Qualification Courses Included',
			'text' => 'DSU includes qualification courses across Levels 0-5, removing the per-course friction for members who are committed to the full progression.',
		],
		[
			'title' => 'Medical and First Aid Blocks Included',
			'text' => 'Medical and first aid training blocks are included so defensive capability includes care, response, and responsibility after the shooting problem.',
		],
		[
			'title' => 'Private Outdoor Range Access',
			'text' => 'Members receive private access to their own outdoor range in Frankfort, IL for deeper training opportunities inside the program structure.',
		],
		[
			'title' => '$25 Gun Transfers',
			'text' => 'DSU members keep the practical transfer benefit included in the Pro tier.',
		],
		[
			'title' => '5-15% Store Savings',
			'text' => 'Receive 5-15% off firearms, ammunition, and store items based on eligible purchase categories.',
		],
		[
			'title' => 'Accelerated Progression',
			'text' => 'The membership is built for faster movement through the training pipeline while preserving standards and accountability.',
		],
	],
	'benefits_cta_heading' => 'Ready to start the full path?',
	'benefits_cta_text' => 'Apply now if you are ready for included qualification courses, medical blocks, private range access, and accountable progression.',
	'sections' => [
		[
			'eyebrow' => 'Best fit',
			'title' => 'For members committed to the complete pipeline',
			'text' => 'DSU is for students who want the strongest commitment to the JM Training system. It includes the qualification path, medical training blocks, expanded access, and the highest level of support for progression.',
			'items' => [
				'Students committed to working through Levels 0-5',
				'Members who want medical training included, not discounted',
				'People who want private outdoor range access in Frankfort',
			],
			'media' => [
				'image' => 'dsu-coached-pistol-range.png',
				'width' => '4194',
				'height' => '2470',
				'alt' => 'JM Training instructor coaching a Defensive Shooting University student during indoor pistol work',
				'caption' => 'Coached reps, movement, and accountable decision-making.',
				'position' => '46% center',
			],
		],
		[
			'eyebrow' => 'Low-light and decisions',
			'title' => 'Search, identify, decide, and stay accountable.',
			'text' => 'The full path includes work that forces members to manage light, visual information, movement, communication, and target discrimination before pressing the trigger. The standard is not just shooting in the dark. It is making responsible decisions when visibility and time are limited.',
			'media' => [
				'image' => 'dsu-low-light-pistol-search.png',
				'width' => '1504',
				'height' => '1338',
				'alt' => 'JM Training student working a pistol with a handheld light in a low-light indoor scenario',
				'caption' => 'Low-light search, identification, and accountable response.',
				'position' => '58% center',
			],
			'items' => [
				'Low-light search and navigation concepts',
				'Positive identification before engagement',
				'Accountable response under limited visibility',
			],
		],
		[
			'eyebrow' => 'Full-path integration',
			'title' => 'Rifle work becomes part of the same decision-making system.',
			'text' => 'DSU ties pistol, rifle, movement, low-light, and performance standards into one progression. Members are expected to keep building skill across platforms while maintaining the same safety, judgment, and accountability requirements.',
			'media' => [
				'image' => 'dsu-night-vision-rifle.png',
				'width' => '2528',
				'height' => '1688',
				'alt' => 'JM Training student integrating rifle and night vision equipment during Defensive Shooting University training',
				'caption' => 'Advanced rifle integration and night-vision concepts.',
				'position' => '50% center',
			],
			'items' => [
				'Rifle integration inside the broader DSU pipeline',
				'Movement, positioning, and target processing',
				'Advanced equipment concepts introduced with structure',
			],
		],
		[
			'eyebrow' => 'Training rhythm',
			'title' => 'The most complete membership for serious progression.',
			'text' => 'DSU removes the largest barriers to advancement: qualification course cost, limited access, and fragmented training. The result is a more direct path through the pipeline with firearms, medical, and scenario-based work integrated together.',
			'media' => [
				'image' => 'dsu-outdoor-pistol-fundamentals.png',
				'width' => '1802',
				'height' => '1896',
				'alt' => 'JM Training student firing a pistol outdoors during defensive handgun training',
				'caption' => 'Measurable performance standards across the full path.',
				'position' => '42% center',
			],
			'items' => [
				'All qualification courses included',
				'Medical and first aid blocks included',
				'Accelerated path through the training pipeline',
			],
		],
	],
	'final_heading' => 'Commit to the full path.',
	'final_text' => 'Submit the short enrollment application when you are ready for the full JM Training membership with included qualification courses, included medical blocks, private range access, and accelerated progression.',
];
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class('jm-dsu-membership-landing'); ?>>
<?php if (function_exists('wp_body_open')) : ?>
	<?php wp_body_open(); ?>
<?php endif; ?>
<?php get_template_part('template-parts/membership-tier-page', null, ['tier' => $jm_membership_tier]); ?>
<?php wp_footer(); ?>
</body>
</html>
