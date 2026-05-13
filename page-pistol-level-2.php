<?php
/**
 * Template Name: Pistol Level 2 - Spatial Awareness and Decision-Making
 * Template Post Type: page
 */

$pistol_course_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($pistol_course_stylesheet) ? filemtime($pistol_course_stylesheet) : null
);

$jm_pistol_course = [
	'level' => 'Pistol Level 2',
	'title' => 'Level 2 — Spatial Awareness and Decision-Making',
	'label' => 'Spatial Awareness',
	'eyebrow' => 'Pistol Level 2',
	'image' => 'pistol-training-overview-level-2.png',
	'image_width' => '2600',
	'image_height' => '1610',
	'image_alt' => 'JM Training pistol student practicing Level 2 marksmanship and target discrimination',
	'intro' => 'A pressure-building course that adds movement, target discrimination, positive identification, and decision-making to accountable pistol performance.',
	'detail' => [
		'Level 2 builds spatial awareness and decision-making under greater performance pressure. Students begin incorporating movement, higher speed and accuracy standards, positive identification, shoot/no-shoot target discrimination, and more advanced low-light work.',
		'This course asks students to process more information while preserving the core standards earned in earlier levels. The environment becomes more demanding, but the expectation remains the same: apply accurate fire only when appropriate.',
		'The goal is to improve the student’s ability to process the environment, make better decisions, communicate clearly, and keep disciplined control while the problem becomes less static.',
	],
	'outcomes' => [
		[
			'title' => 'Spatial Awareness',
			'text' => 'Build awareness around movement, positioning, target relationships, and the safety responsibilities created by changing angles.',
		],
		[
			'title' => 'Decision-Making',
			'text' => 'Practice positive identification and target discrimination standards while avoiding automatic or careless responses.',
		],
		[
			'title' => 'Applied Accuracy',
			'text' => 'Maintain accuracy and accountability as speed, distance, movement, and environmental demands increase.',
		],
	],
	'prerequisites' => [
		'Completion of Pistol Level 1 or instructor-approved equivalent experience is required.',
		'Students must demonstrate safe holster work, reliable manipulation, and controlled marksmanship before attending.',
		'Students must be able to move safely, follow commands, and maintain awareness around other students and instructors.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Movement, Positioning, and Identification',
			'text' => 'Alpha establishes the safety framework for movement, positional awareness, communication, positive identification, and the accuracy standards required before added decision pressure.',
			'qualification' => 'Students must demonstrate safe movement, disciplined muzzle and trigger control, and instructor-observed target identification before moving into Bravo scenarios.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Discrimination, Low-Light Considerations, and Pressure',
			'text' => 'Bravo layers shoot/no-shoot discrimination, higher tempo standards, and more advanced low-light considerations into the student’s pistol work while preserving accuracy and restraint.',
			'qualification' => 'Students must apply accurate fire only when appropriate, avoid no-shoot errors, and maintain safe control under Level 2 decision-making pressure.',
		],
	],
];

get_header();
get_template_part('template-parts/pistol-course-landing', null, ['course' => $jm_pistol_course]);
get_footer();
