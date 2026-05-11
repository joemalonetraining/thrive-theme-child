<?php
/**
 * Template Name: JM 16-Hour Illinois CCL Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'ILCCL',
	'title' => '16-Hour Illinois CCL',
	'intro' => 'Placeholder framework for the 16-hour Illinois concealed carry course page.',
	'cta_label' => 'Reserve ILCCL Seat',
	'cta_href' => '#ghl-ilccl-signup',
	'cards' => [
		[
			'title' => 'Course Overview',
			'text' => 'Placeholder for course schedule, eligibility, required equipment, and class expectations.',
		],
		[
			'title' => 'Signup Flow',
			'text' => 'Go High Level form and payment flow will be connected here later.',
		],
	],
	'notes' => [
		'Replace #ghl-ilccl-signup with the final Go High Level 16-hour ILCCL signup URL or embedded form.',
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
