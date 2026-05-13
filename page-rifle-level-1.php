<?php
/**
 * Template Name: Rifle Level 1 - Control and Manipulation
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
	'level' => 'Rifle Level 1',
	'title' => 'Level 1 — Control and Manipulation',
	'label' => 'Control and Manipulation',
	'eyebrow' => 'Rifle Level 1',
	'image' => 'rifle-training-overview-level-1.png',
	'image_width' => '3240',
	'image_height' => '1812',
	'image_alt' => 'JM Training rifle student practicing Level 1 control and manipulation',
	'intro' => 'A focused rifle development course for students building repeatable platform control, manipulation, and accountable accuracy at a higher tempo.',
	'cta_href' => home_url('/rifle-level-1/'),
	'overview_href' => home_url('/rifle-training-overview/'),
	'detail' => [
		'Rifle Level 1 turns foundational rifle handling into repeatable control. Students refine mounting, ready positions, sight management, recoil management, reloads, malfunction response, sling awareness, and accuracy standards.',
		'The course is built around consistency. Students learn to manage the rifle without letting pace outrun safety, target confirmation, or shot accountability.',
		'The goal is to help students perform core rifle manipulations with discipline while preserving the safety and marksmanship standards required for later movement and decision-making work.',
	],
	'outcomes' => [
		[
			'title' => 'Repeatable Rifle Control',
			'text' => 'Improve mount, ready positions, recoil management, sight recovery, and accountable shot delivery.',
		],
		[
			'title' => 'Core Manipulation',
			'text' => 'Develop safer reloads, malfunction response, sling management, and platform operation under instructor-observed standards.',
		],
		[
			'title' => 'Performance Discipline',
			'text' => 'Maintain safety and accuracy as time, repetition, and task demands increase.',
		],
	],
	'prerequisites' => [
		'Completion of Rifle Level 0 or instructor-approved equivalent experience is required.',
		'Students must already understand safe loading, unloading, verification, and rifle range conduct.',
		'Students must arrive prepared to work from instructor-approved equipment and accept correction throughout the course.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Rifle Control, Ready Positions, and Accuracy',
			'text' => 'Alpha reinforces safety and handling standards, then develops mount, ready positions, recoil management, sighting consistency, and deliberate accuracy expectations.',
			'qualification' => 'Students must demonstrate safe rifle control, disciplined ready positions, and instructor-observed accuracy accountability before moving into Bravo manipulation work.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Reloads, Malfunctions, and Applied Standards',
			'text' => 'Bravo introduces more demanding repetitions around reloads, stoppage response, sling awareness, and higher-tempo platform management while preserving safety and accuracy.',
			'qualification' => 'Students must maintain muzzle and trigger discipline while safely completing Level 1 rifle manipulation standards before receiving completion credit.',
		],
	],
];

get_header();
get_template_part('template-parts/course-landing', null, ['course' => $jm_rifle_course]);
get_footer();
