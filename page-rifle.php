<?php
/**
 * Template Name: JM Rifle Courses Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'Courses',
	'title' => 'Rifle Overview',
	'intro' => 'Placeholder framework for rifle course progression and level pages.',
	'cta_label' => 'Request Rifle Course Info',
	'cta_href' => '#ghl-course-signup',
	'cards' => [
		['title' => 'Level 0A', 'text' => 'Placeholder for Level 0A rifle course details.'],
		['title' => 'Level 0B', 'text' => 'Placeholder for Level 0B rifle course details.'],
		['title' => 'Level 1A', 'text' => 'Placeholder for Level 1A rifle course details.'],
		['title' => 'Level 1B', 'text' => 'Placeholder for Level 1B rifle course details.'],
		['title' => 'Level 2A', 'text' => 'Placeholder for Level 2A rifle course details.'],
		['title' => 'Level 2B', 'text' => 'Placeholder for Level 2B rifle course details.'],
		['title' => 'Level 3A', 'text' => 'Placeholder for Level 3A rifle course details.'],
		['title' => 'Level 3B', 'text' => 'Placeholder for Level 3B rifle course details.'],
	],
	'notes' => [
		'Replace #ghl-course-signup with the final Go High Level rifle course signup URL or embedded form.',
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
