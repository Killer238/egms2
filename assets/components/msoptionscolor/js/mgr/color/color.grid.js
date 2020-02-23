msoptionscolor.grid.color = function (config) {
	config = config || {};
	config.listeners = config.listeners || {};

	this.exp = new Ext.grid.RowExpander({
		expandOnDblClick: false,
		enableCaching: false,
		tpl: new Ext.XTemplate(
			'<tpl for=".">',

			'<table class="msoptionscolor-expander"><tbody>',

			'<tr>',
			'<td>',
			'{caption:this.renderCaption}',
			'</td>',
			'</tr>',

			'<tpl if="value">',
			'<tr>',
			'<td>',
			'{value}',
			'</td>',
			'</tr>',
			'</tpl>',

			'<tpl if="pattern">',
			'<tr class="modx-pb-thumb msoptionscolor-grid-thumb">',
			'<td>',
			'<img src="/{pattern}" ext:qtip="{pattern:this.renderPattern}" ext:qtitle="{image_name}" ext:qclass="msoptionscolor-qtip"/>',
			'</td>',
			'</tr>',
			'</tpl>',

			' </tbody></table>',

			'</tpl>',
			{
				compiled: true,
				renderCaption: function (value, record) {
					var title = value || '';
					var key = record['key'];
					if (msoptionscolor.tools.empty(value)) {
						title = _('msoptionscolor_' + key) || _('ms2_product_' + key) || key;
					}

					return title;
				},

				renderPattern: function (value, record) {
					return String.format('<img src={0}>', '/' + value);
				},
			}
		)
	});

	this.exp.on('beforeexpand', function (rowexpander, record, body, rowIndex) {
		record['data']['json'] = record['json'];
		record['data'] = Ext.applyIf(record['data'], record['json']);
		return true;
	});

	this.sm = new Ext.grid.CheckboxSelectionModel();

	Ext.applyIf(config, {
		id: 'msoptionscolor-grid-color',
		url: msoptionscolor.config.connector_url,
		baseParams: {
			action: 'mgr/color/getlist',
			rid: config.resource.id || 0,
			//sort: 'key',
			//dir: 'asc'
		},
		save_action: 'mgr/color/updatefromgrid',
		autosave: true,
		save_callback: this._updateRow,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		tbar: this.getTopBar(config),
		listeners: this.getListeners(config),

		sm: this.sm,
		//plugins: [this.exp],
		plugins: [],

		// ddGroup: 'dd',
		// enableDragDrop: true,

		paging: true,
		pageSize: 10,
		remoteSort: true,
		viewConfig: {
			forceFit: true,
			enableRowBody: true,
			autoFill: true,
			showPreview: true,
			scrollOffset: 0,
		},
		autoHeight: true,
		cls: 'msoptionscolor-grid',
		bodyCssClass: 'grid-with-buttons',
		stateful: false,
	});
	msoptionscolor.grid.color.superclass.constructor.call(this, config);
	this.exp.addEvents('beforeexpand', 'beforecollapse');

	/* color row */
	this.store.on('load', function (s, r, p) {
		for (var i = 0; i < this.getStore().data.length; i++) {
			var rid = this.getStore().getAt(i).get('rid');
			if (!rid) {
				this.getView().addRowClass(i, 'msoptionscolor-row-null');
				//this.getView().getRow(i).style.opacity = '.7';
			}
		}
	}, this, {scope: this});

};
Ext.extend(msoptionscolor.grid.color, MODx.grid.Grid, {
	windows: {},

	getFields: function (config) {
		var fields = msoptionscolor.config.grid_color_fields;

		return fields;
	},

	getTopBar: function (config) {
		var tbar = [];

		var component = ['create', 'update', 'left', 'key', 'spacer'];

		var add = {
			/*menu: {
				text: '<i class="icon icon-cogs"></i> ',
				menu: [{
					text: '<i class="icon icon-plus"></i> ' + _('msoptionscolor_action_create'),
					cls: 'msoptionscolor-cogs',
					handler: this.create,
					scope: this
				}]
			},*/
			create: {
				text: '<i class="icon icon-plus"></i>',
				handler: this.create,
				scope: this
			},
			update: {
				text: '<i class="icon icon-refresh"></i>',
				handler: this._updateRow,
				scope: this
			},
			left: '->',

			spacer: {
				xtype: 'spacer',
				style: 'width:1px;'
			},

			bigspacer: {
				xtype: 'spacer',
				style: 'width:5px;'
			},

			key: {
				xtype: 'msoptionscolor-combo-option-key',
				width: 170,
				name: 'key',
				addall: true,
				value: '',
				rid: config.resource.id || 0,
				listeners: {
					select: {
						fn: this._filterByCombo,
						scope: this
					},
					afterrender: {
						fn: this._filterByCombo,
						scope: this
					}
				}
			}

		};

		component.filter(function (item) {
			if (add[item]) {
				tbar.push(add[item]);
			}
		});

		var items = [];
		if (tbar.length > 0) {
			items.push(new Ext.Toolbar(tbar));
		}

		return new Ext.Panel({items: items});
	},

	getColumns: function (config) {
		//var columns = [this.exp, this.sm];
		var columns = [];
		var add = {
			rid: {
				width: 5,
				hidden: true,
			},

			key: {
				width: 10,
				sortable: true,
			},
			value: {
				width: 20,
				sortable: true,
			},
			color: {
				width: 10,
				sortable: true,
				renderer: msoptionscolor.tools.renderColor
			},
			color2: {
				width: 10,
				sortable: true,
				renderer: msoptionscolor.tools.renderColor
			},
			pattern: {
				width: 10,
				sortable: true,
				renderer: msoptionscolor.tools.renderPattern
			},
			pattern2: {
				width: 10,
				sortable: true,
				renderer: msoptionscolor.tools.renderPattern
			},

            image: {
                width: 10,
                sortable: true,
                renderer: msoptionscolor.tools.renderImage
            },
            image2: {
                width: 10,
                sortable: true,
                renderer: msoptionscolor.tools.renderImage
            },
            description: {
                width: 30,
                sortable: false,
			},
			actions: {
				width: 12,
				sortable: false,
				id: 'actions',
				renderer: msoptionscolor.tools.renderActions,

			}
		};

		var fields = this.getFields();
		fields.filter(function (field) {
			if (add[field]) {
				Ext.applyIf(add[field], {
					header: _('msoptionscolor_header_' + field),
					tooltip: _('msoptionscolor_tooltip_' + field),
					dataIndex: field
				});
				columns.push(add[field]);
			}
		});

		return columns;
	},

	getListeners: function (config) {
		return Ext.applyIf(config.listeners, {
			rowDblClick: function (grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.update(grid, e, row);
			},
			/*render: {
				fn: this.dd,
				scope: this
			}*/
		});
	},

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();
		var row = grid.getStore().getAt(rowIndex);
		var menu = msoptionscolor.tools.getMenu(row.data['actions'], this, ids);
		this.addContextMenuItem(menu);
	},

	onClick: function (e) {
		var elem = e.getTarget();
		if (elem.nodeName == 'BUTTON') {
			var row = this.getSelectionModel().getSelected();
			if (typeof(row) != 'undefined') {
				var action = elem.getAttribute('action');
				if (action == 'showMenu') {
					var ri = this.getStore().find('id', row.id);
					return this._showMenu(this, ri, e);
				} else if (typeof this[action] === 'function') {
					this.menu.record = row.data;
					return this[action](this, e);
				}
			}
		}
		return this.processEvent('click', e);
	},

	setAction: function (method, field, value) {
		var ids = this._getSelectedIds();
		if (!ids.length && (field !== 'false')) {
			return false;
		}

		MODx.Ajax.request({
			url: msoptionscolor.config.connector_url,
			params: {
				action: 'mgr/color/multiple',
				method: method,
				field_name: field,
				field_value: value,
				ids: Ext.util.JSON.encode(ids)
			},
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					},
					scope: this
				},
				failure: {
					fn: function (response) {
						MODx.msg.alert(_('error'), response.message);
					},
					scope: this
				}
			}
		})
	},

	remove: function () {
		Ext.MessageBox.confirm(
			_('msoptionscolor_action_remove'),
			_('msoptionscolor_confirm_remove'),
			function (val) {
				if (val == 'yes') {
					this.setAction('remove');
				}
			},
			this
		);
	},

	removeOption: function () {
		var ids = this._getSelectedIds();
		if (!ids.length && (field !== 'false')) {
			return false;
		}
		Ext.MessageBox.confirm(
			_('msoptionscolor_action_remove'),
			_('msoptionscolor_confirm_remove'),
			function (val) {
				if (val == 'yes') {
					MODx.Ajax.request({
						url: msoptionscolor.config.connector_url,
						params: {
							action: 'mgr/misc/option/remove',
							field_name: true,
							field_value: null,
							ids: Ext.util.JSON.encode(ids)
						},
						listeners: {
							success: {
								fn: function (response) {
									this.refresh();

									if (response.object && !msoptionscolor.tools.empty(response.object)) {
										Ext.getCmp('modx-panel-resource').msoptionscolorSetOptionValues(response.object);
									}
								},
								scope: this
							},
							failure: {
								fn: function (response) {
									MODx.msg.alert(_('error'), response.message);
								},
								scope: this
							}
						}
					})
				}
			},
			this
		);
	},


	create: function (btn, e) {

		var record = {
			rid: this.config.resource.id || '',
            key: MODx.config['msoptionscolor_default_option_key'] || ' '
        };

		var w = MODx.load({
			xtype: 'msoptionscolor-window-color',
			action: 'mgr/color/create',
			record: record,
			update: false,
			listeners: {
				success: {
					fn: function (r) {
						this.refresh();

						if (r.a && r.a.result.object && !msoptionscolor.tools.empty(r.a.result.object)) {
							Ext.getCmp('modx-panel-resource').msoptionscolorSetOptionValues(r.a.result.object);
						}

					}, scope: this
				}
			}
		});
		w.reset();
		w.setValues(record);
		w.show(e.target);
	},

	update: function (btn, e, row) {
		if (typeof(row) != 'undefined') {
			this.menu.record = row.data;
		}
		else if (!this.menu.record) {
			return false;
		}

		var record = {
			rid: this.config.resource.id || '',
			key: this.menu.record.key || '',
			value: this.menu.record.value || '',
		};

		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/color/get',
				query: Ext.util.JSON.encode(record)
			},
			listeners: {
				success: {
					fn: function (r) {
						var record = r.object;
						var w = MODx.load({
							xtype: 'msoptionscolor-window-color',
							title: _('msoptionscolor_action_update'),
							action: 'mgr/color/update',
							record: record,
							update: true,
							listeners: {
								success: {
									fn: function (r) {
										this.refresh();

										if (r.a && r.a.result.object && !msoptionscolor.tools.empty(r.a.result.object)) {
											Ext.getCmp('modx-panel-resource').msoptionscolorSetOptionValues(r.a.result.object);
										}

									}, scope: this
								}
							}
						});
						w.reset();
						w.setValues(record);
						w.show(e.target);
					}, scope: this
				}
			}
		});
	},

	duplicate: function (btn, e, row) {
		if (typeof(row) != 'undefined') {
			this.menu.record = row.data;
		}
		else if (!this.menu.record) {
			return false;
		}

		Ext.MessageBox.confirm(
			_('msoptionscolor_action_duplicate'),
			_('msoptionscolor_confirm_duplicate'),
			function (val) {
				if (val == 'yes') {
					this.setAction('duplicate');
				}
			},
			this
		);
	},

    active: function (btn, e) {
        this.setAction('setproperty', 'active', 1);
    },

    inactive: function (btn, e) {
        this.setAction('setproperty', 'active', 0);
    },

	_filterByCombo: function (cb) {
		this.getStore().baseParams[cb.name] = cb.value;
		this.getBottomToolbar().changePage(1);
	},

	_doSearch: function (tf) {
		this.getStore().baseParams.query = tf.getValue();
		this.getBottomToolbar().changePage(1);
	},

	_clearSearch: function () {
		this.getStore().baseParams.query = '';
		this.getBottomToolbar().changePage(1);
	},

	_updateRow: function () {
		this.refresh();
	},

	_getSelectedIds: function () {
		var ids = [];
		var selected = this.getSelectionModel().getSelections();

		for (var i in selected) {
			if (!selected.hasOwnProperty(i)) {
				continue;
			}
			ids.push([selected[i]['json']['product_id'], selected[i]['json']['key'], selected[i]['json']['value']]);
		}

		return ids;
	}

});
Ext.reg('msoptionscolor-grid-color', msoptionscolor.grid.color);