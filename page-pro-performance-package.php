<?php
/**
 * Template Name: Pro Performance Package Membership
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
	'title' => 'Pro Performance Package',
	'label' => 'Pro Performance',
	'price' => '$99.99',
	'price_suffix' => '/mo',
	'intro' => 'The Pro Performance Package adds members-only range access, discounted qualification training, equipment savings, and priority schedule access for students who are ready to train more consistently.',
	'cta_label' => 'Ask About Pro',
	'cta_href' => 'https://api.cavucrm.com/widget/form/gJBjLouVXzI3MZWperI0',
	'proof_points' => [
		'Includes everything in Starter',
		'Members-only open range access',
		'50% off qualification courses, Levels 0-5',
	],
	'benefits_heading' => 'Everything in Starter, plus Pro access',
	'benefits' => [
		[
			'title' => 'Members-Only Open Range Access',
			'text' => 'Use dedicated member range blocks to build consistency outside formal classes while staying inside the JM Training standards culture.',
		],
		[
			'title' => 'Open Range Schedule',
			'text' => 'Members-only open range access is listed as Tuesday through Thursday from 12-8pm and Friday from 12-5pm.',
		],
		[
			'title' => '50% Off Qualification Courses',
			'text' => 'Qualification courses across Levels 0-5 are discounted by 50%, helping committed students advance without paying full course cost each time.',
		],
		[
			'title' => 'Discounted Medical Blocks',
			'text' => 'Medical and first aid training blocks are discounted so members can build lifesaving capability alongside firearms skill.',
		],
		[
			'title' => '$25 Gun Transfers',
			'text' => 'Pro members receive $25 gun transfers as part of the practical store and ownership benefits.',
		],
		[
			'title' => 'Limited In-Store Savings',
			'text' => 'Receive 5% off limited in-store items including firearms, ammunition, and accessories.',
		],
		[
			'title' => 'Priority Schedule Access',
			'text' => 'Get priority access to the training schedule so your progression can stay active and deliberate.',
		],
	],
	'sections' => [
		[
			'eyebrow' => 'Best fit',
			'title' => 'For members who are ready to train regularly',
			'text' => 'Pro is built for students who want more than online access and occasional events. It creates a practical rhythm around range time, discounted coursework, medical training access, and schedule priority.',
			'items' => [
				'Students actively working through the qualification path',
				'Members who need regular range access to maintain progress',
				'People who want discounts without moving into the full DSU path',
			],
		],
		[
			'eyebrow' => 'Training rhythm',
			'title' => 'More reps, more access, more accountability',
			'text' => 'The biggest shift from Starter to Pro is access. Members can train more frequently, reduce course cost, and keep their schedule moving with priority access.',
			'items' => [
				'Member range access Tuesday through Friday',
				'Half-price qualification courses, Levels 0-5',
				'Discounted medical and first aid training blocks',
			],
		],
	],
	'final_heading' => 'Add the access that keeps progress moving.',
	'final_text' => 'Ask about Pro if you already know you need more range time, discounted qualifications, and priority access to the JM Training schedule.',
];

get_header();
get_template_part('template-parts/membership-tier-page', null, ['tier' => $jm_membership_tier]);
get_footer();
