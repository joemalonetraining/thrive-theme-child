<?php
/**
 * Template Name: JM Rifle / Pistol Courses Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'Courses',
	'title' => 'Rifle / Pistol Overview',
	'intro' => 'Placeholder framework for integrated rifle and pistol course progression.',
	'cta_label' => 'Request Rifle / Pistol Course Info',
	'cta_href' => '#ghl-course-signup',
	'cards' => [
		['title' => 'Level 4A', 'text' => 'Placeholder for Level 4A rifle / pistol course details.'],
		['title' => 'Level 4B', 'text' => 'Placeholder for Level 4B rifle / pistol course details.'],
		['title' => 'Level 4C', 'text' => 'Placeholder for Level 4C rifle / pistol course details.'],
		['title' => 'Level 5A', 'text' => 'Placeholder for Level 5A rifle / pistol course details.'],
		['title' => 'Level 5B', 'text' => 'Placeholder for Level 5B rifle / pistol course details.'],
		['title' => 'Level 5C', 'text' => 'Placeholder for Level 5C rifle / pistol course details.'],
	],
	'notes' => [
		'Replace #ghl-course-signup with the final Go High Level rifle / pistol course signup URL or embedded form.',
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
