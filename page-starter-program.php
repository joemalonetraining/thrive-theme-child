<?php
/**
 * Template Name: Starter Program Membership
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
	'title' => 'The Starter Program',
	'label' => 'Starter Program',
	'price' => '$62.99',
	'price_suffix' => '/mo',
	'intro' => 'The Starter Program gives members the structure, online education, community access, and recurring training touchpoints needed to start building a disciplined defensive training habit.',
	'cta_label' => 'Ask About Starter',
	'cta_href' => home_url('/membership-application/?membership=starter'),
	'proof_points' => [
		'Online Defensive Shooting University access',
		'At-your-own-pace advancement roadmap',
		'Community, events, legal seminars, and USCCA membership',
	],
	'benefits_heading' => 'Everything included in Starter',
	'benefits' => [
		[
			'title' => 'Defensive Shooting University Online Access',
			'text' => 'Use the online university to study the program material, understand the training path, and prepare for live instruction.',
		],
		[
			'title' => 'Telegram Group Chat Access',
			'text' => 'Stay connected with the JM Training member community, announcements, reminders, and training conversation.',
		],
		[
			'title' => 'At-Your-Own-Pace Roadmap',
			'text' => 'Follow a structured advancement roadmap without being forced into a fixed timeline.',
		],
		[
			'title' => 'Group Training Events',
			'text' => 'Attend group training events in Frankfort that reinforce safety, fundamentals, and disciplined progression.',
		],
		[
			'title' => 'Competition Nights',
			'text' => 'Participate in competition nights in Bourbonnais to put measurable pressure on your skills.',
		],
		[
			'title' => 'Monthly Gun Cleaning and Networking',
			'text' => 'Use the recurring monthly event to maintain equipment, ask questions, and stay connected to the program.',
		],
		[
			'title' => 'Legal and Scenario Training',
			'text' => 'Access free legal seminars and in-house scenario trainings that connect defensive skill with judgment and responsibility.',
		],
		[
			'title' => 'Try Guns and Gear Before Buying',
			'text' => 'Get hands-on exposure to different guns and gear before spending money on equipment that may not fit your needs.',
		],
		[
			'title' => 'Free USCCA Membership',
			'text' => 'Starter members receive a free USCCA membership as part of the broader responsibility and preparedness framework.',
		],
	],
	'sections' => [
		[
			'eyebrow' => 'Best fit',
			'title' => 'For students who want structure before heavy scheduling',
			'text' => 'Starter is the right entry point for members who want the JM Training roadmap, online material, community access, and recurring training opportunities without stepping into the higher-access membership tiers yet.',
			'items' => [
				'New or returning students who want a clear training path',
				'Members who want community access and recurring events',
				'Students who need flexibility while building consistency',
			],
		],
		[
			'eyebrow' => 'Training rhythm',
			'title' => 'Build the habit, then advance deliberately',
			'text' => 'This tier is built around consistent exposure, education, and accountability. Students can prepare through the online university, attend events, compete, and use the advancement roadmap to identify the next standard.',
			'items' => [
				'Online study before live training',
				'Recurring community and networking touchpoints',
				'Progression based on readiness and performance',
			],
		],
	],
	'final_heading' => 'Start with the roadmap.',
	'final_text' => 'Ask about Starter if you want the JM Training system, community, and progression structure before committing to expanded range access or included qualification courses.',
];

get_header();
get_template_part('template-parts/membership-tier-page', null, ['tier' => $jm_membership_tier]);
get_footer();
