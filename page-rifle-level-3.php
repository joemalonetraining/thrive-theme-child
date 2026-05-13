<?php
/**
 * Template Name: Rifle Level 3 - Applied Rifle Integration
 * Template Post Type: page
 */

$rifle_course_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($rifle_course_stylesheet) ? filemtime($rifle_course_stylesheet) : null
);

$jm_rifle_course = [
	'course_family' => 'rifle',
	'level' => 'Rifle Level 3',
	'title' => 'Level 3 — Applied Rifle Integration',
	'label' => 'Applied Integration',
	'eyebrow' => 'Rifle Level 3',
	'image_placeholder' => 'Rifle Level 3 Image Placeholder',
	'intro' => 'An advanced rifle integration course that places platform control, movement, communication, and target processing into less predictable problems.',
	'cta_href' => home_url('/rifle-level-3/'),
	'overview_href' => home_url('/rifle-training-overview/'),
	'detail' => [
		'Rifle Level 3 places rifle skills into less predictable problems that demand composure, movement, communication, use of cover, visual processing, and responsible decision-making.',
		'This level integrates the standards built across Levels 0 through 2 into more complex rifle problems. Students must process information, move efficiently, communicate, and maintain accountable performance while conditions become less clean.',
		'The goal is not simply to run the rifle faster. The goal is to remain controlled, accurate, and adaptable while making responsible decisions under pressure.',
	],
	'outcomes' => [
		[
			'title' => 'Adaptive Rifle Problem-Solving',
			'text' => 'Apply earned rifle fundamentals to less predictable problems where the correct response depends on processing the environment.',
		],
		[
			'title' => 'Communication and Positioning',
			'text' => 'Maintain composure, communication, safe movement, and useful positioning as pressure and complexity increase.',
		],
		[
			'title' => 'Integrated Accountability',
			'text' => 'Combine target processing, movement, cover, and performance standards without abandoning safety or judgment.',
		],
	],
	'prerequisites' => [
		'Completion of Rifle Level 2 or instructor-approved equivalent experience is required.',
		'Students must demonstrate mature rifle handling, safe movement, reliable manipulation, and decision-making discipline.',
		'Students must be physically and mentally prepared for a demanding course day with elevated stress and instructor evaluation.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Applied Movement, Cover, and Communication',
			'text' => 'Alpha builds the safety and performance framework for applied rifle problems, movement, positioning, communication, use of cover, and visual processing under stress.',
			'qualification' => 'Students must maintain safe rifle control, communicate clearly, move with purpose, and demonstrate instructor-observed composure before moving into Bravo integration.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Integrated Rifle Problems and Accountability',
			'text' => 'Bravo combines movement, target processing, communication, use of cover, and performance standards into adaptive rifle problems that are less clean and less predictable.',
			'qualification' => 'Students must make accountable decisions, preserve safety, avoid inappropriate target engagement, and meet Level 3 rifle performance standards under pressure.',
		],
	],
];

get_header();
get_template_part('template-parts/course-landing', null, ['course' => $jm_rifle_course]);
get_footer();
