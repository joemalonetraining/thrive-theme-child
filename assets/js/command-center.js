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

	const STATUS_RANK = { red: 0, orange: 1, green: 2 };
	const STATUS_WORD = { red: 'Needs attention', orange: 'Slipping', green: 'On target' };
	const STATUS_BADGE = { red: 'Attention', orange: 'Slipping', green: 'On target' };

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

	const scoreKpi = (kpi, value, goal) => {
		const type = kpi.type || 'higher';

		if (type === 'check') {
			return toBoolean(value) ? 'green' : 'red';
		}

		if (type === 'macro') {
			const grams = Number(value);
			const target = Number(goal);

			if (isBlank(value) || Number.isNaN(grams) || Number.isNaN(target)) {
				return 'red';
			}

			return grams >= target ? 'green' : 'red';
		}

		if (type === 'time') {
			const minutes = timeToMinutes(value);

			if (Number.isNaN(minutes)) {
				return 'orange';
			}

			if (minutes <= timeToMinutes(kpi.green)) {
				return 'green';
			}

			return minutes <= timeToMinutes(kpi.orange) ? 'orange' : 'red';
		}

		const number = Number(value);

		if (isBlank(value) || Number.isNaN(number)) {
			return 'orange';
		}

		const green = Number(kpi.green);
		const orange = Number(kpi.orange);

		if (type === 'lower') {
			if (number <= green) {
				return 'green';
			}

			return number <= orange ? 'orange' : 'red';
		}

		if (number >= green) {
			return 'green';
		}

		return number >= orange ? 'orange' : 'red';
	};

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

		return Number.isInteger(number) ? String(number) : number.toFixed(1);
	};

	const formatValue = (kpi, value, goal) => {
		if (kpi.type === 'check') {
			return toBoolean(value) ? 'Yes' : 'No';
		}

		if (kpi.type === 'macro') {
			return scoreKpi(kpi, value, goal) === 'green' ? 'Yes' : 'No';
		}

		if (kpi.type === 'time') {
			return formatTime(value);
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

		return kpi.unit || '';
	};

	const worstOf = (statuses) => {
		if (statuses.includes('red')) {
			return 'red';
		}

		return statuses.includes('orange') ? 'orange' : 'green';
	};

	const countStatuses = (items) => {
		const counts = { red: 0, orange: 0, green: 0 };
		items.forEach((item) => {
			counts[item.status] += 1;
		});
		return counts;
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
					const status = scoreKpi(kpi, value, goal);

					return {
						kpi,
						value,
						goal,
						status,
						display: formatValue(kpi, value, goal),
						unit: unitFor(kpi, value, goal),
						overridden: hasOverride || hasGoal,
					};
				});

				const evaluatedGroup = {
					group,
					nodeId: node.id,
					kpis,
					counts: countStatuses(kpis),
					status: worstOf(kpis.map((item) => item.status)),
					overridden: kpis.some((item) => item.overridden),
				};

				groupIndex.set(group.key, evaluatedGroup);
				return evaluatedGroup;
			});

			const allKpis = groups.flatMap((group) => group.kpis);

			return {
				node,
				groups,
				kpiCount: allKpis.length,
				counts: countStatuses(allKpis),
				status: worstOf(allKpis.map((item) => item.status)),
			};
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

	const renderDepartment = (evaluatedGroup) => {
		const open = isOpen(evaluatedGroup.group.key);
		const dept = create('div', 'cc-dept');
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
		status.appendChild(create('span', 'cc-node-badge', STATUS_BADGE[evaluatedGroup.status]));
		status.appendChild(renderCounts(evaluatedGroup.counts));
		status.appendChild(create('span', 'cc-dept-hint', `${evaluatedGroup.kpis.length} KPI${evaluatedGroup.kpis.length === 1 ? '' : 's'}`));
		status.appendChild(chevron());
		toggle.appendChild(status);
		dept.appendChild(toggle);

		if (open) {
			const body = create('div', 'cc-dept-body');
			body.appendChild(renderKpiGrid(evaluatedGroup));
			dept.appendChild(body);
		}

		return dept;
	};

	const renderNode = (entry) => {
		const { node, groups, counts, status } = entry;
		const open = isOpen(node.id);
		const direct = groups.length === 1 && groups[0].group.own;

		const block = create('article', 'cc-node');
		block.dataset.status = status;
		block.dataset.node = node.id;
		block.dataset.open = String(open);

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
		statusColumn.appendChild(create('span', 'cc-node-badge', STATUS_BADGE[status]));
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
				groups.forEach((group) => list.appendChild(renderDepartment(group)));
				body.appendChild(list);
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
					const nodeEl = renderNode(state.nodes.get(node.id));

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
				svg.appendChild(drop);
			});

			if (connected) {
				const dot = document.createElementNS(namespace, 'circle');
				dot.setAttribute('cx', String(childX));
				dot.setAttribute('cy', String(childTop));
				dot.setAttribute('r', '6');
				dot.dataset.status = status;
				svg.appendChild(dot);
			}
		});
	};

	const renderAttention = (state) => {
		el.attentionList.replaceChildren();

		const items = [];
		state.groups.forEach((evaluatedGroup) => {
			evaluatedGroup.kpis.forEach((item) => {
				if (item.status !== 'green') {
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

		const target = el.tiers.querySelector(`[data-group="${groupKey}"]`) || el.tiers.querySelector(`[data-node="${evaluatedGroup.nodeId}"]`);

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
		el.focus.querySelector('.cc-focus-panel').dataset.status = evaluatedGroup.status;
		el.focusTitle.textContent = evaluatedGroup.group.title;
		el.focusSubtitle.textContent = `${evaluatedGroup.group.own ? evaluatedGroup.group.subtitle : nodeEntry.node.title} · ${STATUS_WORD[evaluatedGroup.status]}`;
		el.focusSaved.hidden = !evaluatedGroup.overridden;
		el.focusEdit.textContent = editing ? 'Save' : "Log Today's Numbers";
		el.focusKpis.replaceChildren();

		evaluatedGroup.kpis.forEach((item) => {
			const card = create('div', 'cc-focus-kpi');
			card.dataset.status = item.status;
			card.dataset.kpi = item.kpi.id;
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
					goalField.appendChild(create('span', null, `Goal (${item.kpi.unit || 'g'})`));
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
				? `Goal: ${formatNumber(item.goal)} ${item.kpi.unit || 'g'} · Today: ${formatNumber(item.value)} ${item.kpi.unit || 'g'}`
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
