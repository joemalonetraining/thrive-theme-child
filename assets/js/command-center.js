(() => {
	const root = document.querySelector('[data-jm-command-center]');
	const configNode = document.getElementById('jm-command-center-config');

	if (!root || !configNode) {
		return;
	}

	let config;

	try {
		config = JSON.parse(configNode.textContent);
	} catch (error) {
		console.error('JM Command Center: config JSON could not be parsed.', error);
		return;
	}

	const settings = Object.assign(
		{
			autoTourSeconds: 12,
			refreshSeconds: 60,
			tierLabels: ['Start', 'Company', 'Locations'],
		},
		config.settings || {}
	);

	const nodes = Array.isArray(config.nodes) ? config.nodes : [];

	/* Six grades, worst to best. Every KPI lands on one of these and the
	   worst grade inside a department or block colors the whole thing. */
	const STATUS_RANK = { 'red-deep': 0, red: 1, orange: 2, yellow: 3, green: 4, 'green-bright': 5 };
	const STATUS_WORD = {
		'red-deep': 'Far off target',
		red: 'Needs attention',
		orange: 'Slipping',
		yellow: 'Almost there',
		green: 'On target',
		'green-bright': 'Exceeding',
	};
	const STATUS_BADGE = {
		'red-deep': 'Attention',
		red: 'Attention',
		orange: 'Slipping',
		yellow: 'Close',
		green: 'On target',
		'green-bright': 'Exceeding',
	};
	const isGood = (level) => STATUS_RANK[level] >= STATUS_RANK.green;
	/* Summary pills keep three buckets: red, orange (incl. yellow), green. */
	const bucketOf = (level) => (isGood(level) ? 'green' : STATUS_RANK[level] <= STATUS_RANK.red ? 'red' : 'orange');

	/* Colors are continuous. A KPI's color follows its score; a department
	   or block's color follows the share of its KPIs that are met. */
	const LEVEL_RGB = {
		'red-deep': [142, 20, 20],
		red: [214, 58, 58],
		orange: [224, 127, 0],
		yellow: [201, 154, 0],
		green: [31, 157, 85],
		'green-bright': [15, 184, 79],
	};

	/* KPI score axis: 0 = clearly off, 1 = target met, 1.2 = exceeding. */
	const KPI_STOPS = [
		[-0.5, 'red-deep'],
		[0, 'red'],
		[0.33, 'orange'],
		[0.66, 'yellow'],
		[1, 'green'],
		[1.2, 'green-bright'],
	];

	/* Rollup axis: share of KPIs met. 25% red, 50% orange, 75% yellow, all
	   met green, all met and exceeding bright green. */
	const ROLLUP_STOPS = [
		[0, 'red-deep'],
		[0.25, 'red'],
		[0.5, 'orange'],
		[0.75, 'yellow'],
		[1, 'green'],
		[1.2, 'green-bright'],
	];

	const blend = (stops, x) => {
		if (Number.isNaN(x)) {
			x = 0.5;
		}

		if (x <= stops[0][0]) {
			return LEVEL_RGB[stops[0][1]];
		}

		for (let i = 1; i < stops.length; i += 1) {
			const [x1, level1] = stops[i];

			if (x <= x1) {
				const [x0, level0] = stops[i - 1];
				const t = (x - x0) / (x1 - x0);
				const a = LEVEL_RGB[level0];
				const b = LEVEL_RGB[level1];
				return [0, 1, 2].map((k) => Math.round(a[k] + (b[k] - a[k]) * t));
			}
		}

		return LEVEL_RGB[stops[stops.length - 1][1]];
	};

	const paintOf = (stops, x) => {
		const [r, g, b] = blend(stops, x);
		return { color: `rgb(${r}, ${g}, ${b})`, soft: `rgba(${r}, ${g}, ${b}, 0.12)` };
	};

	const applyPaint = (element, paint) => {
		element.style.setProperty('--cc-status', paint.color);
		element.style.setProperty('--cc-status-soft', paint.soft);
	};

	const levelFromRatio = (ratio, exceeding) => {
		if (ratio >= 1) {
			return exceeding ? 'green-bright' : 'green';
		}

		if (ratio >= 0.75) {
			return 'yellow';
		}

		if (ratio >= 0.5) {
			return 'orange';
		}

		return ratio >= 0.25 ? 'red' : 'red-deep';
	};

	const el = {
		tiers: root.querySelector('[data-cc-tiers]'),
		connectors: root.querySelector('[data-cc-connectors]'),
		attention: root.querySelector('[data-cc-attention]'),
		attentionList: root.querySelector('[data-cc-attention-list]'),
		attentionEmpty: root.querySelector('[data-cc-attention-empty]'),
		countRed: root.querySelector('[data-cc-count-red]'),
		countOrange: root.querySelector('[data-cc-count-orange]'),
		countGreen: root.querySelector('[data-cc-count-green]'),
		time: root.querySelector('[data-cc-time]'),
		date: root.querySelector('[data-cc-date]'),
		tourButton: root.querySelector('[data-cc-tour]'),
		fullscreenButton: root.querySelector('[data-cc-fullscreen]'),
		focus: root.querySelector('[data-cc-focus]'),
		focusTitle: root.querySelector('[data-cc-focus-title]'),
		focusSubtitle: root.querySelector('[data-cc-focus-subtitle]'),
		focusKpis: root.querySelector('[data-cc-focus-kpis]'),
		focusClose: root.querySelector('[data-cc-focus-close]'),
		focusEdit: root.querySelector('[data-cc-focus-edit]'),
		focusReset: root.querySelector('[data-cc-focus-reset]'),
		focusSaved: root.querySelector('[data-cc-focus-saved]'),
	};

	/* ------------------------------------------------------------ Storage */

	const todayKey = () => {
		const now = new Date();
		const month = String(now.getMonth() + 1).padStart(2, '0');
		const day = String(now.getDate()).padStart(2, '0');
		return `${now.getFullYear()}-${month}-${day}`;
	};

	const storageKey = () => `jm-command-center:${todayKey()}`;

	const readOverrides = () => {
		try {
			const raw = window.localStorage.getItem(storageKey());
			return raw ? JSON.parse(raw) : {};
		} catch (error) {
			return {};
		}
	};

	const writeOverrides = (overrides) => {
		try {
			window.localStorage.setItem(storageKey(), JSON.stringify(overrides));
			return true;
		} catch (error) {
			return false;
		}
	};

	/* Macro gram goals are settings, not daily values: they persist across
	   days in their own key while the daily grams reset with the date. */
	const goalsKey = 'jm-command-center:goals';

	const readGoals = () => {
		try {
			const raw = window.localStorage.getItem(goalsKey);
			return raw ? JSON.parse(raw) : {};
		} catch (error) {
			return {};
		}
	};

	const writeGoals = (goals) => {
		try {
			window.localStorage.setItem(goalsKey, JSON.stringify(goals));
			return true;
		} catch (error) {
			return false;
		}
	};

	/* ------------------------------------------------------------ Scoring */

	const timeToMinutes = (value) => {
		if (typeof value !== 'string') {
			return NaN;
		}

		const match = value.trim().match(/^(\d{1,2}):(\d{2})$/);

		if (!match) {
			return NaN;
		}

		return Number(match[1]) * 60 + Number(match[2]);
	};

	const toBoolean = (value) => {
		if (typeof value === 'string') {
			return ['1', 'true', 'yes', 'done'].includes(value.trim().toLowerCase());
		}

		return Boolean(value);
	};

	const isBlank = (value) => value === '' || value === null || value === undefined;

	/* Score: 1 means the target is met, 0 means the KPI sits at its "clearly
	   off" threshold, below 0 is worse than that, above 1 is beating it. */
	const levelFromScore = (score) => {
		if (Number.isNaN(score)) {
			return 'red';
		}

		if (score >= 1.2) {
			return 'green-bright';
		}

		if (score >= 1) {
			return 'green';
		}

		if (score >= 0.66) {
			return 'yellow';
		}

		if (score >= 0.33) {
			return 'orange';
		}

		return score >= 0 ? 'red' : 'red-deep';
	};

	const rangeScore = (value, target, off, higherIsBetter) => {
		if (target === off) {
			return (higherIsBetter ? value >= target : value <= target) ? 1 : -1;
		}

		return higherIsBetter ? (value - off) / (target - off) : (off - value) / (off - target);
	};

	/* Numeric score for a KPI. 1 = target met, 0 = clearly off threshold,
	   below 0 worse than that, 1.2+ exceeding in a good way. */
	const kpiScore = (kpi, value, goal) => {
		const type = kpi.type || 'higher';

		if (type === 'check') {
			return toBoolean(value) ? 1 : 0;
		}

		if (type === 'macro') {
			const grams = Number(value);
			const target = Number(goal);

			if (isBlank(value) || Number.isNaN(grams) || Number.isNaN(target) || target <= 0) {
				return 0;
			}

			if (kpi.direction === 'under') {
				/* Stay under the limit: green below it, comfortably under is
				   bright, and the further over the darker the red. */
				if (grams <= target * 0.9) {
					return 1.2;
				}

				if (grams <= target) {
					return 1 + ((target - grams) / (target * 0.1)) * 0.2;
				}

				return rangeScore(grams, target, target * 1.5, false);
			}

			/* Match or beat the goal: grade from half the goal up to it. */
			return rangeScore(grams, target, target * 0.5, true);
		}

		if (type === 'time') {
			const minutes = timeToMinutes(value);

			if (Number.isNaN(minutes)) {
				return 0.5;
			}

			return rangeScore(minutes, timeToMinutes(kpi.green), timeToMinutes(kpi.orange), false);
		}

		const number = Number(value);

		if (isBlank(value) || Number.isNaN(number)) {
			return 0.5;
		}

		return rangeScore(number, Number(kpi.green), Number(kpi.orange), type !== 'lower');
	};

	const clampScore = (score) => Math.max(-1, Math.min(1.5, Number.isNaN(score) ? 0.5 : score));

	const scoreKpi = (kpi, value, goal) => levelFromScore(clampScore(kpiScore(kpi, value, goal)));

	const formatTime = (value) => {
		const minutes = timeToMinutes(value);

		if (Number.isNaN(minutes)) {
			return '--';
		}

		const hours24 = Math.floor(minutes / 60) % 24;
		const mins = String(minutes % 60).padStart(2, '0');
		const hours12 = hours24 % 12 === 0 ? 12 : hours24 % 12;
		return `${hours12}:${mins} ${hours24 < 12 ? 'AM' : 'PM'}`;
	};

	const formatNumber = (value) => {
		const number = Number(value);

		if (isBlank(value) || Number.isNaN(number)) {
			return '--';
		}

		return Number.isInteger(number)
			? number.toLocaleString('en-US')
			: number.toLocaleString('en-US', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
	};

	/* A unit that starts with "$" moves the dollar sign onto the number:
	   "$ / day" shows as "$1,650" with "/ day" beneath. */
	const isMoney = (kpi) => typeof kpi.unit === 'string' && kpi.unit.trim().startsWith('$');

	const formatValue = (kpi, value, goal) => {
		if (kpi.type === 'check') {
			return toBoolean(value) ? 'Yes' : 'No';
		}

		if (kpi.type === 'macro') {
			return isGood(scoreKpi(kpi, value, goal)) ? 'Yes' : 'No';
		}

		if (kpi.type === 'time') {
			return formatTime(value);
		}

		if (isMoney(kpi) && !isBlank(value) && !Number.isNaN(Number(value))) {
			return `$${formatNumber(value)}`;
		}

		return formatNumber(value);
	};

	const unitFor = (kpi, value, goal) => {
		if (kpi.type === 'check' || kpi.type === 'time') {
			return '';
		}

		if (kpi.type === 'macro') {
			return `${formatNumber(value)} / ${formatNumber(goal)} ${kpi.unit || 'g'}`;
		}

		if (isBlank(value) || Number.isNaN(Number(value))) {
			return 'No data';
		}

		if (isMoney(kpi)) {
			return kpi.unit.trim().slice(1).trim();
		}

		return kpi.unit || '';
	};

	const countStatuses = (items) => {
		const counts = { red: 0, orange: 0, green: 0 };
		items.forEach((item) => {
			counts[bucketOf(item.status)] += 1;
		});
		return counts;
	};

	/* Rollup for a department or block: the share of KPIs met sets the color.
	   All met and exceeding on average lifts it toward bright green. */
	const rollup = (kpis) => {
		const total = kpis.length;
		const met = kpis.filter((item) => isGood(item.status)).length;
		const ratio = total === 0 ? 1 : met / total;
		const average = total === 0 ? 1 : kpis.reduce((sum, item) => sum + item.score, 0) / total;
		const rollScore = ratio >= 1 ? 1 + Math.max(0, Math.min(0.2, average - 1)) : ratio;
		const exceeding = ratio >= 1 && rollScore >= 1.2;

		return {
			met,
			total,
			ratio,
			status: levelFromRatio(ratio, exceeding),
			paint: paintOf(ROLLUP_STOPS, rollScore),
		};
	};

	/* A "group" is one expandable set of KPIs: either a block's own KPIs or
	   one of its departments. Its key doubles as the storage key. */
	const groupsOf = (node) => {
		const groups = [];

		if (Array.isArray(node.kpis) && node.kpis.length > 0) {
			groups.push({
				key: node.id,
				id: node.id,
				title: node.kpisLabel || node.title,
				subtitle: node.kpisLabel ? '' : node.subtitle || '',
				kpis: node.kpis,
				own: true,
			});
		}

		(node.departments || []).forEach((department) => {
			groups.push({
				key: `${node.id}/${department.id}`,
				id: department.id,
				title: department.title,
				subtitle: department.subtitle || '',
				kpis: department.kpis || [],
				own: false,
			});
		});

		return groups;
	};

	const evaluate = () => {
		const overrides = readOverrides();
		const goals = readGoals();
		const groupIndex = new Map();

		const entries = nodes.map((node) => {
			const groups = groupsOf(node).map((group) => {
				const saved = overrides[group.key] || {};
				const savedGoals = goals[group.key] || {};
				const kpis = group.kpis.map((kpi) => {
					const hasOverride = Object.prototype.hasOwnProperty.call(saved, kpi.id);
					const hasGoal = Object.prototype.hasOwnProperty.call(savedGoals, kpi.id);
					const value = hasOverride ? saved[kpi.id] : kpi.value;
					const goal = kpi.type === 'macro' ? (hasGoal ? savedGoals[kpi.id] : kpi.goal) : undefined;
					const score = clampScore(kpiScore(kpi, value, goal));
					const status = levelFromScore(score);

					return {
						kpi,
						value,
						goal,
						score,
						status,
						paint: paintOf(KPI_STOPS, score),
						display: formatValue(kpi, value, goal),
						unit: unitFor(kpi, value, goal),
						overridden: hasOverride || hasGoal,
					};
				});

				const evaluatedGroup = Object.assign(
					{
						group,
						nodeId: node.id,
						kpis,
						counts: countStatuses(kpis),
						overridden: kpis.some((item) => item.overridden),
					},
					rollup(kpis)
				);

				groupIndex.set(group.key, evaluatedGroup);
				return evaluatedGroup;
			});

			const allKpis = groups.flatMap((group) => group.kpis);

			return Object.assign(
				{
					node,
					groups,
					kpiCount: allKpis.length,
					counts: countStatuses(allKpis),
				},
				rollup(allKpis)
			);
		});

		return { nodes: new Map(entries.map((entry) => [entry.node.id, entry])), groups: groupIndex };
	};

	/* ------------------------------------------------------------ Open / closed state */

	const openSet = new Set();

	nodes.forEach((node) => {
		if (node.open) {
			openSet.add(node.id);

			const groups = groupsOf(node);

			if (groups.length === 1) {
				openSet.add(groups[0].key);
			}
		}
	});

	const isOpen = (key) => openSet.has(key);

	const setOpen = (key, open) => {
		if (open) {
			openSet.add(key);
		} else {
			openSet.delete(key);
		}
	};

	/* ------------------------------------------------------------ Rendering */

	const create = (tag, className, text) => {
		const element = document.createElement(tag);

		if (className) {
			element.className = className;
		}

		if (text !== undefined) {
			element.textContent = text;
		}

		return element;
	};

	const chevron = () => {
		const icon = create('span', 'cc-chevron');
		icon.setAttribute('aria-hidden', 'true');
		icon.innerHTML =
			'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>';
		return icon;
	};

	/* "6/9 met" on anything with several KPIs; the plain status word when
	   there is only one KPI to meet. */
	const metLabel = (entry) => {
		if (entry.total <= 1) {
			return STATUS_WORD[entry.status];
		}

		const percent = Math.round(entry.ratio * 100);
		return `${entry.met}/${entry.total} met · ${percent}%${entry.status === 'green-bright' ? ' · Exceeding' : ''}`;
	};

	const badgeLabel = (entry) => {
		if (entry.total <= 1) {
			return STATUS_BADGE[entry.status];
		}

		if (entry.ratio >= 1) {
			return STATUS_BADGE[entry.status];
		}

		return `${entry.met}/${entry.total} met`;
	};

	const renderCounts = (counts) => {
		const row = create('span', 'cc-node-counts');

		['red', 'orange', 'green'].forEach((key) => {
			if (counts[key] === 0) {
				return;
			}

			const pill = create('span', 'cc-node-count');
			pill.dataset.status = key;
			pill.setAttribute('title', `${counts[key]} ${key}`);
			pill.appendChild(create('i'));
			pill.appendChild(document.createTextNode(String(counts[key])));
			row.appendChild(pill);
		});

		return row;
	};

	const renderKpi = (item) => {
		const kpiEl = create('div', 'cc-kpi');
		kpiEl.dataset.status = item.status;
		kpiEl.dataset.kpi = item.kpi.id;
		applyPaint(kpiEl, item.paint);

		kpiEl.appendChild(create('span', 'cc-kpi-label', item.kpi.label));
		kpiEl.appendChild(create('span', 'cc-kpi-target', item.kpi.target || ''));

		const value = create('span', 'cc-kpi-value', item.display);

		if (item.kpi.type === 'check' || item.kpi.type === 'time' || item.kpi.type === 'macro') {
			value.classList.add('is-text');
		}

		if (item.unit) {
			value.appendChild(create('small', null, item.unit));
		}

		kpiEl.appendChild(value);
		return kpiEl;
	};

	const renderKpiGrid = (evaluatedGroup) => {
		const wrap = create('div', 'cc-kpi-panel');
		const grid = create('div', 'cc-node-kpis');
		evaluatedGroup.kpis.forEach((item) => grid.appendChild(renderKpi(item)));
		wrap.appendChild(grid);

		const actions = create('div', 'cc-kpi-actions');
		const log = create('button', 'cc-link-button', "Log today's numbers");
		log.type = 'button';
		log.dataset.ccLog = evaluatedGroup.group.key;
		actions.appendChild(log);

		if (evaluatedGroup.overridden) {
			actions.appendChild(create('span', 'cc-kpi-saved', 'Saved on this screen'));
		}

		wrap.appendChild(actions);
		return wrap;
	};

	const renderDepartmentPanel = (evaluatedGroup) => {
		const panel = create('div', 'cc-dept-panel');
		panel.dataset.status = evaluatedGroup.status;
		panel.dataset.panel = evaluatedGroup.group.key;
		applyPaint(panel, evaluatedGroup.paint);

		const heading = create('div', 'cc-dept-panel-heading');
		heading.appendChild(create('span', 'cc-dept-panel-title', evaluatedGroup.group.title));
		heading.appendChild(create('span', 'cc-dept-panel-status', metLabel(evaluatedGroup)));
		panel.appendChild(heading);
		panel.appendChild(renderKpiGrid(evaluatedGroup));
		return panel;
	};

	/* tile = true lays the department out as a tile in a wide block; its KPIs
	   then render in a panel under the tiles instead of inside the row. */
	const renderDepartment = (evaluatedGroup, tile) => {
		const open = isOpen(evaluatedGroup.group.key);
		const dept = create('div', 'cc-dept');
		applyPaint(dept, evaluatedGroup.paint);

		if (tile) {
			dept.classList.add('is-tile');
		}
		dept.dataset.status = evaluatedGroup.status;
		dept.dataset.group = evaluatedGroup.group.key;
		dept.dataset.open = String(open);

		const toggle = create('button', 'cc-dept-toggle');
		toggle.type = 'button';
		toggle.dataset.ccToggleGroup = evaluatedGroup.group.key;
		toggle.setAttribute('aria-expanded', String(open));

		const text = create('span', 'cc-dept-text');
		text.appendChild(create('span', 'cc-dept-title', evaluatedGroup.group.title));

		if (evaluatedGroup.group.subtitle) {
			text.appendChild(create('span', 'cc-dept-subtitle', evaluatedGroup.group.subtitle));
		}

		toggle.appendChild(text);

		const status = create('span', 'cc-dept-status');
		const single = evaluatedGroup.kpis.length === 1 ? evaluatedGroup.kpis[0] : null;

		if (single) {
			/* One KPI: show its value right on the row so the board still
			   reads at a glance while the row is closed. */
			const value = create('span', 'cc-dept-value', single.display);
			value.dataset.status = single.status;
			applyPaint(value, single.paint);

			if (single.unit) {
				value.appendChild(create('small', null, single.unit));
			}

			status.appendChild(value);
		} else {
			status.appendChild(create('span', 'cc-node-badge', badgeLabel(evaluatedGroup)));
			status.appendChild(renderCounts(evaluatedGroup.counts));
			status.appendChild(create('span', 'cc-dept-hint', `${evaluatedGroup.kpis.length} KPIs`));
		}

		status.appendChild(chevron());
		toggle.appendChild(status);
		dept.appendChild(toggle);

		if (open && !tile) {
			const body = create('div', 'cc-dept-body');
			body.appendChild(renderKpiGrid(evaluatedGroup));
			dept.appendChild(body);
		}

		return dept;
	};

	const renderNode = (entry, wide) => {
		const { node, groups, counts, status } = entry;
		const open = isOpen(node.id);
		const direct = groups.length === 1 && groups[0].group.own;

		const block = create('article', 'cc-node');
		block.dataset.status = status;
		block.dataset.node = node.id;
		block.dataset.open = String(open);
		applyPaint(block, entry.paint);

		if (node.start) {
			block.classList.add('is-start');
		}

		const toggle = create('button', 'cc-node-toggle');
		toggle.type = 'button';
		toggle.dataset.ccToggleNode = node.id;
		toggle.setAttribute('aria-expanded', String(open));

		const titles = create('span', 'cc-node-text');
		titles.appendChild(create('span', 'cc-node-title', node.title));

		if (node.subtitle) {
			titles.appendChild(create('span', 'cc-node-subtitle', node.subtitle));
		}

		toggle.appendChild(titles);

		const statusColumn = create('span', 'cc-node-status');
		statusColumn.appendChild(create('span', 'cc-node-badge', badgeLabel(entry)));
		statusColumn.appendChild(renderCounts(counts));

		const departmentCount = groups.filter((group) => !group.group.own).length;
		const hintParts = [];

		if (departmentCount > 0) {
			hintParts.push(`${departmentCount} department${departmentCount === 1 ? '' : 's'}`);
		}

		hintParts.push(`${entry.kpiCount} KPI${entry.kpiCount === 1 ? '' : 's'}`);
		statusColumn.appendChild(create('span', 'cc-node-hint', hintParts.join(' · ')));
		statusColumn.appendChild(chevron());
		toggle.appendChild(statusColumn);
		block.appendChild(toggle);

		if (open) {
			const body = create('div', 'cc-node-body');

			if (direct) {
				body.appendChild(renderKpiGrid(groups[0]));
			} else {
				const list = create('div', 'cc-depts');

				if (wide) {
					list.classList.add('is-grid');
				}

				groups.forEach((group) => list.appendChild(renderDepartment(group, wide)));
				body.appendChild(list);

				if (wide) {
					groups
						.filter((group) => isOpen(group.group.key))
						.forEach((group) => body.appendChild(renderDepartmentPanel(group)));
				}
			}

			block.appendChild(body);
		}

		return block;
	};

	const renderTiers = (state) => {
		el.tiers.replaceChildren();

		const tiers = new Map();
		nodes.forEach((node) => {
			const tier = Number(node.tier) || 0;

			if (!tiers.has(tier)) {
				tiers.set(tier, []);
			}

			tiers.get(tier).push(node);
		});

		[...tiers.keys()]
			.sort((a, b) => a - b)
			.forEach((tier) => {
				const row = create('section', 'cc-tier');
				row.dataset.tier = String(tier);

				const members = tiers.get(tier);

				if (members.length === 1) {
					row.classList.add('is-single');
				}

				if (el.tiers.childElementCount === 0) {
					row.classList.add('is-first');
				}

				const label = settings.tierLabels[tier] || `Tier ${tier + 1}`;
				row.setAttribute('aria-label', label);
				row.appendChild(create('p', 'cc-tier-label', label));

				const list = create('div', 'cc-tier-nodes');
				members.forEach((node) => {
					const nodeEl = renderNode(state.nodes.get(node.id), members.length === 1);

					if (members.length > 1) {
						nodeEl.classList.add('is-compact');
					}

					list.appendChild(nodeEl);
				});
				row.appendChild(list);

				el.tiers.appendChild(row);
			});
	};

	/* Wires descend: from a parent's bottom edge down to a rail between the
	   rows, along the rail, then down into the child's top edge. The rail is
	   neutral; the final drop takes the child's status color. */
	const renderConnectors = (state) => {
		const svg = el.connectors;
		svg.replaceChildren();

		if (window.getComputedStyle(svg).display === 'none') {
			return;
		}

		const bounds = svg.getBoundingClientRect();
		svg.setAttribute('viewBox', `0 0 ${bounds.width} ${bounds.height}`);

		const rectFor = (id) => {
			const target = el.tiers.querySelector(`[data-node="${id}"]`);
			return target ? target.getBoundingClientRect() : null;
		};

		const namespace = 'http://www.w3.org/2000/svg';
		const round = (value) => Math.round(value * 10) / 10;

		nodes.forEach((node) => {
			const to = rectFor(node.id);

			if (!to) {
				return;
			}

			const childX = round(to.left + to.width / 2 - bounds.left);
			const childTop = round(to.top - bounds.top);
			const status = state.nodes.get(node.id).status;
			let connected = false;

			(node.parents || []).forEach((parentId) => {
				const from = rectFor(parentId);

				if (!from || from.bottom > to.top) {
					return;
				}

				connected = true;
				const parentX = round(from.left + from.width / 2 - bounds.left);
				const parentBottom = round(from.bottom - bounds.top);
				const railY = round(parentBottom + (childTop - parentBottom) / 2);

				const rail = document.createElementNS(namespace, 'path');
				rail.setAttribute('d', `M ${parentX} ${parentBottom} V ${railY} H ${childX}`);
				svg.appendChild(rail);

				const drop = document.createElementNS(namespace, 'path');
				drop.setAttribute('d', `M ${childX} ${railY} V ${childTop}`);
				drop.dataset.status = status;
				applyPaint(drop, state.nodes.get(node.id).paint);
				svg.appendChild(drop);
			});

			if (connected) {
				const dot = document.createElementNS(namespace, 'circle');
				dot.setAttribute('cx', String(childX));
				dot.setAttribute('cy', String(childTop));
				dot.setAttribute('r', '6');
				dot.dataset.status = status;
				applyPaint(dot, state.nodes.get(node.id).paint);
				svg.appendChild(dot);
			}
		});
	};

	const renderAttention = (state) => {
		el.attentionList.replaceChildren();

		const items = [];
		state.groups.forEach((evaluatedGroup) => {
			evaluatedGroup.kpis.forEach((item) => {
				if (!isGood(item.status)) {
					items.push({ evaluatedGroup, item });
				}
			});
		});

		items.sort((a, b) => STATUS_RANK[a.item.status] - STATUS_RANK[b.item.status]);

		const totals = { red: 0, orange: 0, green: 0 };
		state.nodes.forEach((entry) => {
			totals.red += entry.counts.red;
			totals.orange += entry.counts.orange;
			totals.green += entry.counts.green;
		});

		el.countRed.textContent = String(totals.red);
		el.countOrange.textContent = String(totals.orange);
		el.countGreen.textContent = String(totals.green);

		el.attention.classList.toggle('is-clear', items.length === 0);
		el.attentionEmpty.hidden = items.length > 0;

		items.forEach(({ evaluatedGroup, item }) => {
			const nodeEntry = state.nodes.get(evaluatedGroup.nodeId);
			const li = create('li');
			const button = create('button', 'cc-attention-item');
			button.type = 'button';
			button.dataset.status = item.status;
			button.dataset.ccJump = evaluatedGroup.group.key;
			applyPaint(button, item.paint);

			const value = create('span', 'cc-attention-value', item.display);

			if (item.kpi.type === 'check' || item.kpi.type === 'macro') {
				value.classList.add('is-text');
			}

			button.appendChild(value);

			const text = create('span', 'cc-attention-text');
			text.appendChild(create('span', 'cc-attention-label', item.kpi.label));

			const meta = create('span', 'cc-attention-meta');
			const where = evaluatedGroup.group.own
				? nodeEntry.node.title
				: `${nodeEntry.node.title} · ${evaluatedGroup.group.title}`;
			meta.appendChild(create('b', null, where));
			const detail = item.kpi.type === 'macro' ? item.unit : item.kpi.target;
			meta.appendChild(document.createTextNode(detail ? ` · ${detail}` : ''));
			text.appendChild(meta);
			button.appendChild(text);

			li.appendChild(button);
			el.attentionList.appendChild(li);
		});
	};

	/* When more items need attention than fit on screen, glide the strip so
	   every item gets seen without anyone touching the TV. */
	let marqueeTimer = null;
	let marqueeDirection = 1;

	const startMarquee = () => {
		if (marqueeTimer) {
			window.clearInterval(marqueeTimer);
			marqueeTimer = null;
		}

		el.attentionList.scrollLeft = 0;

		if (el.attentionList.scrollWidth <= el.attentionList.clientWidth + 4) {
			return;
		}

		let pauseTicks = 40;
		marqueeTimer = window.setInterval(() => {
			if (pauseTicks > 0) {
				pauseTicks -= 1;
				return;
			}

			const list = el.attentionList;
			const max = list.scrollWidth - list.clientWidth;
			list.scrollLeft += marqueeDirection;

			if (list.scrollLeft >= max - 1 || list.scrollLeft <= 0) {
				marqueeDirection *= -1;
				pauseTicks = 40;
			}
		}, 40);
	};

	let state = evaluate();
	let nodeObserver = null;

	const observeNodes = () => {
		if (typeof ResizeObserver !== 'function') {
			return;
		}

		if (nodeObserver) {
			nodeObserver.disconnect();
		}

		nodeObserver = new ResizeObserver(() => scheduleConnectors());
		nodeObserver.observe(el.tiers);
		el.tiers.querySelectorAll('.cc-node').forEach((nodeEl) => nodeObserver.observe(nodeEl));
	};

	let connectorFrame = null;

	function scheduleConnectors() {
		if (connectorFrame) {
			window.cancelAnimationFrame(connectorFrame);
		}

		connectorFrame = window.requestAnimationFrame(() => {
			connectorFrame = null;
			renderConnectors(state);
		});
	}

	const renderBoard = () => {
		renderTiers(state);
		observeNodes();
		scheduleConnectors();
	};

	const renderAll = () => {
		state = evaluate();
		renderBoard();
		renderAttention(state);
		window.requestAnimationFrame(startMarquee);
	};

	/* ------------------------------------------------------------ Expand / collapse */

	const toggleNode = (nodeId) => {
		const entry = state.nodes.get(nodeId);

		if (!entry) {
			return;
		}

		const open = !isOpen(nodeId);
		setOpen(nodeId, open);

		if (open && entry.groups.length === 1) {
			setOpen(entry.groups[0].group.key, true);
		}

		renderBoard();
	};

	const toggleGroup = (groupKey) => {
		setOpen(groupKey, !isOpen(groupKey));
		renderBoard();
	};

	const revealGroup = (groupKey) => {
		const evaluatedGroup = state.groups.get(groupKey);

		if (!evaluatedGroup) {
			return;
		}

		setOpen(evaluatedGroup.nodeId, true);
		setOpen(groupKey, true);
		renderBoard();

		const target = el.tiers.querySelector(`[data-panel="${groupKey}"]`) || el.tiers.querySelector(`[data-group="${groupKey}"]`) || el.tiers.querySelector(`[data-node="${evaluatedGroup.nodeId}"]`);

		if (target && typeof target.scrollIntoView === 'function') {
			target.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
		}
	};

	/* ------------------------------------------------------------ Focus dialog (logging) */

	let focusedGroupKey = null;
	let editing = false;

	const renderFocus = () => {
		const evaluatedGroup = state.groups.get(focusedGroupKey);

		if (!evaluatedGroup) {
			return;
		}

		const nodeEntry = state.nodes.get(evaluatedGroup.nodeId);
		const panel = el.focus.querySelector('.cc-focus-panel');
		panel.dataset.status = evaluatedGroup.status;
		applyPaint(panel, evaluatedGroup.paint);
		el.focusTitle.textContent = evaluatedGroup.group.title;
		el.focusSubtitle.textContent = `${evaluatedGroup.group.own ? evaluatedGroup.group.subtitle : nodeEntry.node.title} · ${metLabel(evaluatedGroup)}`;
		el.focusSaved.hidden = !evaluatedGroup.overridden;
		el.focusEdit.textContent = editing ? 'Save' : "Log Today's Numbers";
		el.focusKpis.replaceChildren();

		evaluatedGroup.kpis.forEach((item) => {
			const card = create('div', 'cc-focus-kpi');
			card.dataset.status = item.status;
			card.dataset.kpi = item.kpi.id;
			applyPaint(card, item.paint);
			card.appendChild(create('span', 'cc-focus-kpi-label', item.kpi.label));

			if (editing) {
				if (item.kpi.type === 'check') {
					const toggle = create('button', 'cc-focus-toggle');
					toggle.type = 'button';
					toggle.dataset.input = 'check';
					const done = toBoolean(item.value);
					toggle.setAttribute('aria-pressed', String(done));
					toggle.textContent = done ? 'Yes' : 'No';
					toggle.addEventListener('click', () => {
						const next = toggle.getAttribute('aria-pressed') !== 'true';
						toggle.setAttribute('aria-pressed', String(next));
						toggle.textContent = next ? 'Yes' : 'No';
					});
					card.appendChild(toggle);
				} else if (item.kpi.type === 'macro') {
					const fields = create('div', 'cc-focus-macro');

					const goalField = create('label', 'cc-focus-field');
					goalField.appendChild(create('span', null, `${item.kpi.direction === 'under' ? 'Limit' : 'Goal'} (${item.kpi.unit || 'g'})`));
					const goalInput = create('input');
					goalInput.type = 'number';
					goalInput.min = '0';
					goalInput.step = 'any';
					goalInput.dataset.input = 'macro-goal';
					goalInput.value = isBlank(item.goal) ? '' : String(item.goal);
					goalField.appendChild(goalInput);

					const todayField = create('label', 'cc-focus-field');
					todayField.appendChild(create('span', null, `Today so far (${item.kpi.unit || 'g'})`));
					const todayInput = create('input');
					todayInput.type = 'number';
					todayInput.min = '0';
					todayInput.step = 'any';
					todayInput.dataset.input = 'macro-value';
					todayInput.value = isBlank(item.value) ? '' : String(item.value);
					todayField.appendChild(todayInput);

					fields.appendChild(goalField);
					fields.appendChild(todayField);
					card.appendChild(fields);
				} else {
					const input = create('input');
					input.type = item.kpi.type === 'time' ? 'time' : 'number';
					input.dataset.input = item.kpi.type === 'time' ? 'time' : 'number';
					input.step = 'any';
					input.value = isBlank(item.value) ? '' : String(item.value);
					input.setAttribute('aria-label', `${item.kpi.label} value`);
					card.appendChild(input);
				}
			} else {
				const value = create('span', 'cc-focus-kpi-value', item.display);

				if (item.unit) {
					value.appendChild(create('small', null, item.unit));
				}

				card.appendChild(value);
				card.appendChild(create('span', 'cc-focus-kpi-status', STATUS_WORD[item.status]));
			}

			const targetText = item.kpi.type === 'macro'
				? `${item.kpi.direction === 'under' ? 'Stay under' : 'Match or beat'} ${formatNumber(item.goal)} ${item.kpi.unit || 'g'} · Today: ${formatNumber(item.value)} ${item.kpi.unit || 'g'}`
				: item.kpi.target ? `Target: ${item.kpi.target}` : '';
			card.appendChild(create('span', 'cc-focus-kpi-target', targetText));
			el.focusKpis.appendChild(card);
		});
	};

	const openFocus = (groupKey, startEditing) => {
		if (!state.groups.has(groupKey)) {
			return;
		}

		focusedGroupKey = groupKey;
		editing = Boolean(startEditing);
		renderFocus();
		el.focus.hidden = false;

		const first = editing ? el.focusKpis.querySelector('[data-input]') : null;
		(first || el.focusClose).focus();
	};

	const closeFocus = () => {
		el.focus.hidden = true;
		focusedGroupKey = null;
		editing = false;
	};

	const saveFocus = () => {
		const evaluatedGroup = state.groups.get(focusedGroupKey);

		if (!evaluatedGroup) {
			return;
		}

		const overrides = readOverrides();
		const goals = readGoals();
		const saved = Object.assign({}, overrides[focusedGroupKey] || {});
		const savedGoals = Object.assign({}, goals[focusedGroupKey] || {});

		el.focusKpis.querySelectorAll('[data-kpi]').forEach((card) => {
			const goalControl = card.querySelector('[data-input="macro-goal"]');
			const todayControl = card.querySelector('[data-input="macro-value"]');

			if (goalControl && todayControl) {
				savedGoals[card.dataset.kpi] = goalControl.value === '' ? '' : Number(goalControl.value);
				saved[card.dataset.kpi] = todayControl.value === '' ? '' : Number(todayControl.value);
				return;
			}

			const control = card.querySelector('[data-input]');

			if (!control) {
				return;
			}

			if (control.dataset.input === 'check') {
				saved[card.dataset.kpi] = control.getAttribute('aria-pressed') === 'true';
			} else if (control.dataset.input === 'time') {
				saved[card.dataset.kpi] = control.value;
			} else {
				saved[card.dataset.kpi] = control.value === '' ? '' : Number(control.value);
			}
		});

		overrides[focusedGroupKey] = saved;
		goals[focusedGroupKey] = savedGoals;
		writeOverrides(overrides);
		writeGoals(goals);
		editing = false;
		renderAll();
		renderFocus();
	};

	el.focusEdit.addEventListener('click', () => {
		if (editing) {
			saveFocus();
			return;
		}

		editing = true;
		renderFocus();
		const first = el.focusKpis.querySelector('[data-input]');

		if (first) {
			first.focus();
		}
	});

	el.focusReset.addEventListener('click', () => {
		if (!focusedGroupKey) {
			return;
		}

		const overrides = readOverrides();
		const goals = readGoals();
		delete overrides[focusedGroupKey];
		delete goals[focusedGroupKey];
		writeOverrides(overrides);
		writeGoals(goals);
		editing = false;
		renderAll();
		renderFocus();
	});

	el.focusClose.addEventListener('click', closeFocus);

	el.focus.addEventListener('click', (event) => {
		if (event.target === el.focus) {
			closeFocus();
		}
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && !el.focus.hidden) {
			closeFocus();
		}
	});

	/* ------------------------------------------------------------ Board clicks */

	root.addEventListener('click', (event) => {
		if (el.focus.contains(event.target)) {
			return;
		}

		const nodeToggle = event.target.closest('[data-cc-toggle-node]');

		if (nodeToggle) {
			stopTour();
			toggleNode(nodeToggle.dataset.ccToggleNode);
			return;
		}

		const groupToggle = event.target.closest('[data-cc-toggle-group]');

		if (groupToggle) {
			stopTour();
			toggleGroup(groupToggle.dataset.ccToggleGroup);
			return;
		}

		const log = event.target.closest('[data-cc-log]');

		if (log) {
			stopTour();
			openFocus(log.dataset.ccLog, true);
			return;
		}

		const jump = event.target.closest('[data-cc-jump]');

		if (jump) {
			stopTour();
			revealGroup(jump.dataset.ccJump);
		}
	});

	/* ------------------------------------------------------------ Auto tour */

	let tourTimer = null;
	let tourIndex = -1;
	let savedOpen = null;

	const tourStep = () => {
		if (nodes.length === 0) {
			return;
		}

		tourIndex = (tourIndex + 1) % nodes.length;
		openSet.clear();

		const node = nodes[tourIndex];
		setOpen(node.id, true);
		groupsOf(node).forEach((group) => setOpen(group.key, true));
		renderBoard();
	};

	const startTour = () => {
		if (tourTimer) {
			return;
		}

		savedOpen = new Set(openSet);
		el.tourButton.setAttribute('aria-pressed', 'true');
		tourIndex = -1;
		tourStep();
		tourTimer = window.setInterval(tourStep, Math.max(4, Number(settings.autoTourSeconds) || 12) * 1000);
	};

	function stopTour() {
		if (!tourTimer) {
			return;
		}

		window.clearInterval(tourTimer);
		tourTimer = null;
		el.tourButton.setAttribute('aria-pressed', 'false');

		if (savedOpen) {
			openSet.clear();
			savedOpen.forEach((key) => openSet.add(key));
			savedOpen = null;
		}
	}

	el.tourButton.addEventListener('click', () => {
		if (tourTimer) {
			stopTour();
			renderBoard();
		} else {
			startTour();
		}
	});

	/* ------------------------------------------------------------ TV mode */

	el.fullscreenButton.addEventListener('click', () => {
		if (document.fullscreenElement) {
			document.exitFullscreen();
			return;
		}

		if (root.requestFullscreen) {
			root.requestFullscreen().catch(() => {});
		}
	});

	document.addEventListener('fullscreenchange', () => {
		el.fullscreenButton.textContent = document.fullscreenElement ? 'Exit TV Mode' : 'TV Mode';
		scheduleConnectors();
	});

	/* ------------------------------------------------------------ Clock */

	const tickClock = () => {
		const now = new Date();
		el.time.textContent = now.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
		el.date.textContent = now.toLocaleDateString([], {
			weekday: 'long',
			month: 'long',
			day: 'numeric',
		});
	};

	tickClock();
	window.setInterval(tickClock, 15000);

	/* ------------------------------------------------------------ Boot */

	renderAll();

	window.addEventListener('resize', scheduleConnectors);

	if (document.fonts && document.fonts.ready) {
		document.fonts.ready.then(scheduleConnectors);
	}

	let lastDay = todayKey();
	window.setInterval(() => {
		const day = todayKey();

		if (day !== lastDay) {
			lastDay = day;
			renderAll();
		}
	}, Math.max(15, Number(settings.refreshSeconds) || 60) * 1000);
})();
