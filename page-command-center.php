<?php
/**
 * Template Name: JM Business Command Center
 * Template Post Type: page
 *
 * Lobby TV command center. Renders a flow diagram of "locations" (Personal,
 * then JM Training). Each block collapses its departments (for JM Training:
 * Bourbonnais, Alsip, Frankfort, ECommerce), and each department collapses
 * its KPIs. JM Training has no KPIs of its own; its color comes from the
 * share of department KPIs that are met. Every KPI is scored green / orange /
 * red against its thresholds, and the worst status rolls up through the
 * department to the block so the team sees at a glance where to look.
 *
 * Data model (edit $jm_command_center below):
 *   nodes[]            One block on the flow diagram (a "location").
 *     id               Unique slug. Used for wires and saved values.
 *     title            Big label on the block.
 *     subtitle         Small label under the title.
 *     tier             Row on the diagram, top down: 0 = start, 1, 2, ...
 *     start            true marks the first block in the flow.
 *     open             true keeps the block expanded when the board loads.
 *     parents[]        ids this block flows from (draws the wires). Keep
 *                      parents on the row directly above so wires never cross.
 *     kpis[]           KPIs owned directly by the block (optional).
 *     kpisLabel        Heading for those direct KPIs when the block also has
 *                      departments (they show as the first expandable group).
 *     departments[]    Expandable groups inside the block (optional).
 *       id, title, subtitle, kpis[]  Same shape as a block, without tiers.
 *
 *   Tap a block to open its departments; tap a department to open its KPIs.
 *   A block with KPIs and no departments opens straight to its KPIs.
 *
 *   A block or department is colored by the share of its KPIs that are met,
 *   on a continuous gradient: under 25% dark red, 25% red, 50% orange, 75%
 *   yellow, all met green, all met and exceeding bright green. Each KPI's
 *   own color slides along the same gradient by how close it is to target.
 *
 *   KPI fields:
 *       id, label      Unique slug and display label.
 *       type           'higher'  numeric, higher is better
 *                      'lower'   numeric, lower is better
 *                      'time'    clock time "HH:MM" (24h), earlier is better
 *                      'check'   yes / no
 *                      'macro'   grams so far today against a gram goal
 *       unit           Display unit, e.g. 'hrs', 'oz', 'min'.
 *       goal           'macro' only: the gram goal. Editable on screen and
 *                      remembered across days; the daily grams reset each day.
 *       direction      'macro' only: 'over' = match or beat the goal (protein),
 *                      'under' = stay under the limit (carbs, fats).
 *       green, orange  Thresholds. 'green' is the target; 'orange' is the
 *                      point where the KPI is clearly off. Every KPI grades on
 *                      a six-step scale between and beyond them:
 *                        dark red   worse than the orange threshold
 *                        red        first third of the way to target
 *                        orange     middle third
 *                        yellow     last third, almost there
 *                        green      target met
 *                        bright     20%+ past target, exceeding in a good way
 *                      For 'higher' bigger is better; for 'lower' and 'time'
 *                      smaller / earlier is better. 'check' is yes = green,
 *                      no = red. 'macro' uses the goal with direction: 'over'
 *                      grades from half the goal up to it, 'under' is green
 *                      below the limit and darkens the further over it goes.
 *       value          Today's starting value. The team can overwrite values
 *                      from the screen; overrides are saved in the browser
 *                      that displays the board, keyed by date.
 *       target         Short human description of the green target.
 */

$jm_command_center_css = '/assets/css/command-center.css';
$jm_command_center_js = '/assets/js/command-center.js';

wp_enqueue_style(
	'jm-command-center',
	get_stylesheet_directory_uri() . $jm_command_center_css,
	[],
	file_exists(get_stylesheet_directory() . $jm_command_center_css) ? filemtime(get_stylesheet_directory() . $jm_command_center_css) : null
);

wp_enqueue_script(
	'jm-command-center',
	get_stylesheet_directory_uri() . $jm_command_center_js,
	[],
	file_exists(get_stylesheet_directory() . $jm_command_center_js) ? filemtime(get_stylesheet_directory() . $jm_command_center_js) : null,
	true
);

$jm_command_center = [
	'brand' => [
		'name' => 'JM Training',
		'board' => 'Business Command Center',
		'logo' => get_stylesheet_directory_uri() . '/assets/images/jm-logo.png',
	],
	'settings' => [
		'autoTourSeconds' => 12,
		'refreshSeconds' => 60,
		'tierLabels' => ['Start', 'Company'],
	],
	'nodes' => [
		[
			'id' => 'personal',
			'title' => 'Personal',
			'subtitle' => 'Daily foundation',
			'tier' => 0,
			'start' => true,
			'open' => true,
			'parents' => [],
			'departments' => [
				[
					'id' => 'sleep',
					'title' => 'Sleep',
					'subtitle' => 'Hours last night',
					'kpis' => [
						[
							'id' => 'sleep',
							'label' => 'Sleep',
							'type' => 'higher',
							'unit' => 'hrs',
							'green' => 7,
							'orange' => 4,
							'value' => 7.5,
							'target' => '7+ hours',
						],
					],
				],
				[
					'id' => 'wake-up',
					'title' => 'Wake Up',
					'subtitle' => 'No snooze',
					'kpis' => [
						[
							'id' => 'wake-up',
							'label' => 'Wake Up',
							'type' => 'check',
							'unit' => '',
							'green' => 1,
							'orange' => 1,
							'value' => true,
							'target' => 'No snooze',
						],
					],
				],
				[
					'id' => 'hydrate',
					'title' => 'Hydrate',
					'subtitle' => 'Water goal',
					'kpis' => [
						[
							'id' => 'hydrate',
							'label' => 'Hydrate',
							'type' => 'check',
							'unit' => '',
							'green' => 1,
							'orange' => 1,
							'value' => true,
							'target' => 'Water goal hit',
						],
					],
				],
				[
					'id' => 'read',
					'title' => 'Read',
					'subtitle' => 'Daily reading',
					'kpis' => [
						[
							'id' => 'read',
							'label' => 'Read',
							'type' => 'check',
							'unit' => '',
							'green' => 1,
							'orange' => 1,
							'value' => true,
							'target' => 'Read today',
						],
					],
				],
				[
					'id' => 'pray',
					'title' => 'Pray',
					'subtitle' => 'Daily prayer',
					'kpis' => [
						[
							'id' => 'pray',
							'label' => 'Pray',
							'type' => 'check',
							'unit' => '',
							'green' => 1,
							'orange' => 1,
							'value' => true,
							'target' => 'Prayed today',
						],
					],
				],
				[
					'id' => 'exercise',
					'title' => 'Exercise',
					'subtitle' => 'Training session',
					'kpis' => [
						[
							'id' => 'exercise',
							'label' => 'Exercise',
							'type' => 'check',
							'unit' => '',
							'green' => 1,
							'orange' => 1,
							'value' => false,
							'target' => 'Trained today',
						],
					],
				],
				[
					'id' => 'nutrition',
					'title' => 'Nutrition',
					'subtitle' => 'Macro goals',
					'kpis' => [
						[
							'id' => 'protein',
							'label' => 'Protein',
							'type' => 'macro',
							'direction' => 'over',
							'unit' => 'g',
							'goal' => 180,
							'value' => 142,
							'target' => 'Match or beat the goal',
						],
						[
							'id' => 'carbs',
							'label' => 'Carbs',
							'type' => 'macro',
							'direction' => 'under',
							'unit' => 'g',
							'goal' => 250,
							'value' => 262,
							'target' => 'Stay under the limit',
						],
						[
							'id' => 'fats',
							'label' => 'Fats',
							'type' => 'macro',
							'direction' => 'under',
							'unit' => 'g',
							'goal' => 70,
							'value' => 48,
							'target' => 'Stay under the limit',
						],
					],
				],
			],
		],
		[
			'id' => 'company',
			'title' => 'JM Training',
			'subtitle' => 'Company',
			'tier' => 1,
			'open' => true,
			'parents' => ['personal'],
			'departments' => [
				[
					'id' => 'bourbonnais',
					'title' => 'Bourbonnais',
					'subtitle' => 'Range & classroom',
					'kpis' => [
					[
						'id' => 'gross-revenue',
						'label' => 'Gross Revenue',
						'type' => 'higher',
						'unit' => '$ / day',
						'green' => 2000,
						'orange' => 1000,
						'value' => 1650,
						'target' => '$2,000 a day',
					],
					[
						'id' => 'sprint-conversion',
						'label' => '1-1 to Sprint',
						'type' => 'higher',
						'unit' => '% converted',
						'green' => 80,
						'orange' => 40,
						'value' => 70,
						'target' => '80% of 1-1 training converts to a 12-week sprint',
					],
					[
						'id' => 'staff-cost',
						'label' => 'Staff Schedule',
						'type' => 'lower',
						'unit' => '% of last wk rev',
						'green' => 20,
						'orange' => 30,
						'value' => 18,
						'target' => 'Under 20% of previous week gross revenue',
					],
					],
				],
				[
					'id' => 'alsip',
					'title' => 'Alsip',
					'subtitle' => 'CCL classroom',
					'kpis' => [
					[
						'id' => 'ccl-16-seats',
						'label' => '16 Hr CCL Seats Sold',
						'type' => 'higher',
						'unit' => '/ day',
						'green' => 2,
						'orange' => 1,
						'value' => 2,
						'target' => '2 seats a day',
					],
					[
						'id' => 'ccl-3-seats',
						'label' => '3 Hr CCL Seats Sold',
						'type' => 'higher',
						'unit' => '/ day',
						'green' => 2,
						'orange' => 1,
						'value' => 1,
						'target' => '2 seats a day',
					],
					[
						'id' => 'ccl-seats-filled',
						'label' => 'CCL Seats Filled',
						'type' => 'higher',
						'unit' => 'of 30 seats',
						'green' => 24,
						'orange' => 12,
						'value' => 21,
						'target' => '24 of 30 seats (80% of capacity)',
					],
					[
						'id' => 'community-conversions',
						'label' => 'JMT Community Conversions',
						'type' => 'higher',
						'unit' => '% of attendees',
						'green' => 60,
						'orange' => 30,
						'value' => 50,
						'target' => '60% of 16 Hr and 3 Hr CCL attendees join',
					],
					[
						'id' => 'alsip-gross-sales',
						'label' => 'Total Gross Sales',
						'type' => 'higher',
						'unit' => '$ / day',
						'green' => 500,
						'orange' => 250,
						'value' => 430,
						'target' => '$500 a day',
					],
					],
				],
				[
					'id' => 'frankfort',
					'title' => 'Frankfort',
					'subtitle' => 'Outdoor range',
					'kpis' => [
					[
						'id' => 'events-booked',
						'label' => 'Events Booked',
						'type' => 'higher',
						'unit' => 'next 30 days',
						'green' => 6,
						'orange' => 3,
						'value' => 4,
						'target' => '6+ events',
					],
					[
						'id' => 'private-sessions',
						'label' => 'Private Sessions',
						'type' => 'higher',
						'unit' => 'this month',
						'green' => 8,
						'orange' => 4,
						'value' => 3,
						'target' => '8+ sessions',
					],
					[
						'id' => 'range-ready',
						'label' => 'Range Ready',
						'type' => 'check',
						'unit' => '',
						'green' => 1,
						'orange' => 1,
						'value' => true,
						'target' => 'Berms, targets, gear checked',
					],
					],
				],
				[
					'id' => 'ecommerce',
					'title' => 'ECommerce',
					'subtitle' => 'Website & online store',
					'kpis' => [
					[
						'id' => 'site-public',
						'label' => 'Website Public',
						'type' => 'check',
						'unit' => '',
						'green' => 1,
						'orange' => 1,
						'value' => true,
						'target' => 'Site is live and visible to the public',
					],
					[
						'id' => 'seo-top-5',
						'label' => 'Google SEO Top 5',
						'type' => 'check',
						'unit' => '',
						'green' => 1,
						'orange' => 1,
						'value' => false,
						'target' => 'Top 5 on the Google search page for firearms training',
					],
					[
						'id' => 'online-sales-500',
						'label' => '$500 Gross Sales',
						'type' => 'check',
						'unit' => '',
						'green' => 1,
						'orange' => 1,
						'value' => false,
						'target' => '$500 in gross sales today',
					],
					],
				],
			],
		],
	],
];

get_header();
?>

<div class="jm-command-center" data-jm-command-center>
	<header class="cc-topbar">
		<a class="cc-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="JM Training home">
			<img class="cc-brand-logo" src="<?php echo esc_url($jm_command_center['brand']['logo']); ?>" alt="JM Training logo">
			<span class="cc-brand-text">
				<strong><?php echo esc_html($jm_command_center['brand']['name']); ?></strong>
				<small><?php echo esc_html($jm_command_center['brand']['board']); ?></small>
			</span>
		</a>

		<div class="cc-summary" data-cc-summary aria-live="polite">
			<span class="cc-summary-pill is-red"><b data-cc-count-red>0</b> Red</span>
			<span class="cc-summary-pill is-orange"><b data-cc-count-orange>0</b> Orange</span>
			<span class="cc-summary-pill is-green"><b data-cc-count-green>0</b> Green</span>
		</div>

		<div class="cc-clock" aria-label="Current date and time">
			<strong data-cc-time>--:--</strong>
			<small data-cc-date>Loading</small>
		</div>

		<div class="cc-controls">
			<button type="button" class="cc-button" data-cc-tour aria-pressed="false">Auto Tour</button>
			<button type="button" class="cc-button" data-cc-fullscreen>TV Mode</button>
		</div>
	</header>

	<main class="cc-main">
		<section class="cc-flow" aria-label="Business flow diagram">
			<svg class="cc-connectors" data-cc-connectors aria-hidden="true" focusable="false"></svg>
			<div class="cc-tiers" data-cc-tiers></div>
		</section>

		<aside class="cc-attention" data-cc-attention aria-label="Indicators that need attention">
			<h2 class="cc-attention-title">Needs Attention</h2>
			<ol class="cc-attention-list" data-cc-attention-list></ol>
			<p class="cc-attention-empty" data-cc-attention-empty hidden>Everything is green. Keep it there.</p>
		</aside>
	</main>

	<footer class="cc-legend" aria-label="Status color legend">
		<span class="cc-legend-scale" aria-label="Status color scale, worst to best">
			<i data-status="red-deep" title="Far off"></i>
			<i data-status="red" title="Needs attention"></i>
			<i data-status="orange" title="Slipping"></i>
			<i data-status="yellow" title="Almost there"></i>
			<i data-status="green" title="On target"></i>
			<i data-status="green-bright" title="Exceeding"></i>
		</span>
		<span class="cc-legend-item">Far off</span>
		<span class="cc-legend-item cc-legend-arrow" aria-hidden="true">&rarr;</span>
		<span class="cc-legend-item">On target</span>
		<span class="cc-legend-item cc-legend-arrow" aria-hidden="true">&rarr;</span>
		<span class="cc-legend-item">Exceeding</span>
		<span class="cc-legend-note">Blocks color by the share of KPIs met: 25% red, 50% orange, 75% yellow, all met green. Tap a block to open it.</span>
	</footer>

	<div class="cc-focus" data-cc-focus hidden role="dialog" aria-modal="true" aria-labelledby="cc-focus-title">
		<div class="cc-focus-panel">
			<header class="cc-focus-header">
				<div>
					<p class="cc-focus-eyebrow" data-cc-focus-subtitle></p>
					<h2 id="cc-focus-title" data-cc-focus-title></h2>
				</div>
				<button type="button" class="cc-button cc-button-close" data-cc-focus-close aria-label="Close">Close</button>
			</header>
			<div class="cc-focus-kpis" data-cc-focus-kpis></div>
			<footer class="cc-focus-footer">
				<button type="button" class="cc-button" data-cc-focus-edit>Log Today's Numbers</button>
				<button type="button" class="cc-button cc-button-quiet" data-cc-focus-reset>Reset to Defaults</button>
				<span class="cc-focus-saved" data-cc-focus-saved hidden>Saved on this screen</span>
			</footer>
		</div>
	</div>
</div>

<script id="jm-command-center-config" type="application/json"><?php echo wp_json_encode($jm_command_center); ?></script>

<?php
get_footer();
