msoptionscolor.tools.getMenu = function (actions, grid, selected) {
	var menu = [];
	var cls, icon, title, action = '';

	for (var i in actions) {
		if (!actions.hasOwnProperty(i)) {
			continue;
		}

		var a = actions[i];
		if (!a['menu']) {
			if (a == '-') {
				menu.push('-');
			}
			continue;
		} else if (menu.length > 0 && (/^sep/i.test(a['action']))) {
			menu.push('-');
			continue;
		}

		if (selected.length > 1) {
			if (!a['multiple']) {
				continue;
			} else if (typeof(a['multiple']) == 'string') {
				a['title'] = a['multiple'];
			}
		}

		cls = a['cls'] ? a['cls'] : '';
		icon = a['icon'] ? a['icon'] : '';
		title = a['title'] ? a['title'] : a['title'];
		action = a['action'] ? grid[a['action']] : '';

		menu.push({
			handler: action,
			text: String.format(
				'<span class="{0}"><i class="x-menu-item-icon {1}"></i>{2}</span>',
				cls, icon, title
			)
		});
	}

	return menu;
};


msoptionscolor.tools.renderActions = function (value, props, row) {
	var res = [];
	var cls, icon, title, action, item = '';
	for (var i in row.data.actions) {
		if (!row.data.actions.hasOwnProperty(i)) {
			continue;
		}
		var a = row.data.actions[i];
		if (!a['button']) {
			continue;
		}

		cls = a['cls'] ? a['cls'] : '';
		icon = a['icon'] ? a['icon'] : '';
		action = a['action'] ? a['action'] : '';
		title = a['title'] ? a['title'] : '';

		item = String.format(
			'<li class="{0}"><button class="btn btn-default {1}" action="{2}" title="{3}"></button></li>',
			cls, icon, action, title
		);

		res.push(item);
	}

	return String.format(
		'<ul class="msoptionscolor-row-actions">{0}</ul>',
		res.join('')
	);
};


msoptionscolor.tools.handleChecked = function (checkbox) {
	var workCount = checkbox.workCount;
	if (!!!workCount) {
		workCount = 1;
	}
	var hideLabel = checkbox.hideLabel;
	if (!!!hideLabel) {
		hideLabel = false;
	}
	var disableWork = checkbox.disableWork;
	if (disableWork == undefined) {
		disableWork = true;
	}

	var checked = checkbox.getValue();
	var nextField = checkbox.nextSibling();

	for (var i = 0; i < workCount; i++) {
		if (checked) {
			nextField.show().enable();
		}
		else {
			if (disableWork) {
				nextField.hide().disable();
			}
			else {
				nextField.hide();
			}
		}
		nextField.hideLabel = hideLabel;
		nextField = nextField.nextSibling();
	}
	return true;
};


msoptionscolor.tools.arrayIntersect = function (array1, array2) {
	var result = array1.filter(function (n) {
		return array2.indexOf(n) !== -1;
	});

	return result;
};

msoptionscolor.tools.inArray = function (needle, haystack) {
	for (key in haystack) {
		if (haystack[key] == needle) return true;
	}

	return false;
};


msoptionscolor.tools.renderReplace = function (value, replace, color) {
	if (!value) {
		return '';
	} else if (!replace) {
		return value;
	}
	if (!color) {
		return String.format('<span>{0}</span>', replace);
	}
	return String.format('<span class="msoptionscolor-render-replace" style="color: #{1}">{0}</span>', replace, color);
};

msoptionscolor.tools.renderColor = function (value, props, row) {
	if (value) {
		var i = msoptionscolor.tools.invertColor(value);
		return String.format('<div style="width: 45px;  border-radius: 3px; padding: 5px;margin: -5px; border: 1px solid #E4E4E4;background: #' + value + ';color: #' + i + ';"><span>&nbsp;' + value + '</span></div>');
	}
	return String.format('<span class="red">{0}</span>', _('no'));
};


msoptionscolor.tools.renderPattern = function (value, props, row) {
	if (value) {
		return String.format('<div style="width: 45px;  border-radius: 3px; padding: 5px;margin: -5px;height: 15px;border: 1px solid #E4E4E4;background-image: url(/' + value + ')"></div>');
	}
	return String.format('<span class="red">{0}</span>', _('no'));
};

msoptionscolor.tools.renderImage = function (value, props, row) {
    if (value) {
        return String.format('<div style="width: 45px;  border-radius: 3px; padding: 5px;margin: -5px;height: 15px;border: 1px solid #E4E4E4;background-image: url(' + value + ')"></div>');
    }
    return String.format('<span class="red">{0}</span>', _('no'));
};


msoptionscolor.tools.empty = function (value) {
	return (typeof(value) == 'undefined' || value == 0 || value === null || value === false || (typeof(value) == 'string' && value.replace(/\s+/g, '') == '') || (typeof(value) == 'object' && value.length == 0));
};


msoptionscolor.tools.hexToDec = function (hex) {
	var s = hex.split('');
	return ( ( msoptionscolor.tools.getHCharPos(s[0]) * 16 ) + msoptionscolor.tools.getHCharPos(s[1]) );
};


msoptionscolor.tools.decToHex = function (n) {
	var HCHARS = '0123456789ABCDEF';
	n = parseInt(n, 10);
	n = ( !isNaN(n)) ? n : 0;
	n = (n > 255 || n < 0) ? 0 : n;
	return HCHARS.charAt(( n - n % 16 ) / 16) + HCHARS.charAt(n % 16);
};


msoptionscolor.tools.hexToRgb = function (hex) {
	return [msoptionscolor.tools.hexToDec(hex.substr(0, 2)), msoptionscolor.tools.hexToDec(hex.substr(2, 2)), msoptionscolor.tools.hexToDec(hex.substr(4, 2))];
};


msoptionscolor.tools.rgbToHex = function (r, g, b) {
	if (r instanceof Array) {
		return msoptionscolor.tools.rgbToHex.call(this, r[0], r[1], r[2]);
	}
	return msoptionscolor.tools.decToHex(r) + msoptionscolor.tools.decToHex(g) + msoptionscolor.tools.decToHex(b);
};


msoptionscolor.tools.getHCharPos = function (c) {
	if (!c) {
        c = '';
	}
	var HCHARS = '0123456789ABCDEF';
	return HCHARS.indexOf(c.toUpperCase());
};


msoptionscolor.tools.invert = function (r, g, b) {
	if (r instanceof Array) {
		return msoptionscolor.tools.invert.call(this, r[0], r[1], r[2]);
	}
	return [255 - r, 255 - g, 255 - b];
};


msoptionscolor.tools.invertColor = function (color) {
	return msoptionscolor.tools.rgbToHex(msoptionscolor.tools.invert(msoptionscolor.tools.hexToRgb(color)));
};

