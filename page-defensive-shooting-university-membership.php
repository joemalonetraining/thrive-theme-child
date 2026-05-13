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
	'cta_label' => 'Ask About DSU',
	'cta_href' => 'mailto:support@joemalonetraining.com?subject=Defensive%20Shooting%20University%20Membership%20Inquiry',
	'proof_points' => [
		'Includes everything in Pro Performance',
		'All qualification courses included, Levels 0-5',
		'Medical blocks, private range access, and accelerated progression',
	],
	'media_heading' => 'The full path is built around applied performance.',
	'media_intro' => 'DSU members are not just buying range time. The program puts students into live skill work: movement, low-light search problems, pistol performance, rifle integration, and pressure that has to be managed with discipline.',
	'media' => [
		[
			'image' => 'dsu-outdoor-rifle-movement-sunset.png',
			'width' => '1126',
			'height' => '1500',
			'alt' => 'JM Training students moving with rifles during an outdoor Defensive Shooting University training block',
			'caption' => 'Movement and rifle work under outdoor range conditions.',
		],
		[
			'image' => 'dsu-low-light-pistol-search.png',
			'width' => '1504',
			'height' => '1338',
			'alt' => 'JM Training student working a pistol with a handheld light in a low-light indoor scenario',
			'caption' => 'Low-light search, identification, and pistol handling.',
		],
		[
			'image' => 'dsu-outdoor-pistol-fundamentals.png',
			'width' => '1802',
			'height' => '1896',
			'alt' => 'JM Training student firing a pistol outdoors during defensive handgun training',
			'caption' => 'Outdoor pistol performance with accountable fundamentals.',
		],
		[
			'image' => 'dsu-night-vision-rifle.png',
			'width' => '2528',
			'height' => '1688',
			'alt' => 'JM Training student integrating rifle and night vision equipment during Defensive Shooting University training',
			'caption' => 'Advanced rifle integration and night-vision concepts.',
		],
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
		],
		[
			'eyebrow' => 'Training rhythm',
			'title' => 'The most complete membership for serious progression',
			'text' => 'DSU removes the largest barriers to advancement: qualification course cost, limited access, and fragmented training. The result is a more direct path through the pipeline with firearms, medical, and scenario-based work integrated together.',
			'items' => [
				'All qualification courses included',
				'Medical and first aid blocks included',
				'Accelerated path through the training pipeline',
			],
		],
	],
	'final_heading' => 'Commit to the full path.',
	'final_text' => 'Ask about DSU if you want the full JM Training membership with included qualification courses, included medical blocks, private range access, and accelerated progression.',
];

get_header();
get_template_part('template-parts/membership-tier-page', null, ['tier' => $jm_membership_tier]);
get_footer();
