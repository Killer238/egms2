msoptionscolor.window.color = function (config) {
	config = config || {record: {}};
	config.listeners = config.listeners || {};

	Ext.applyIf(config, {
		update: false,
		title: _('create'),
		width: 500,
		autoHeight: true,
		url: msoptionscolor.config.connector_url,
		action: 'mgr/color/update',
		fields: this.getFields(config),
		keys: this.getKeys(config),
		listeners: this.getListeners(config),
		cls: 'msoptionscolor-panel-color',
		bodyStyle: 'padding-top: 0px;',
	});

	msoptionscolor.window.color.superclass.constructor.call(this, config);

    this.on('afterrender', function () {
        Ext.each(this.fp.getForm().items.items, function (t) {
            if (!t.name) {
                return true;
            }
            if (
                msoptionscolor.config.window_color_fields.indexOf(t.name) >= 0 ||
                msoptionscolor.config.window_color_fields.indexOf(t.name.replace(/(_)/, "")) >= 0
            ) {
                return true;
            }
            else {
                t.disable().hide();
            }
        });

    });

};
Ext.extend(msoptionscolor.window.color, MODx.Window, {

	getKeys: function (config) {
		return [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}];
	},

	getFields: function (config) {
		return [{
			layout: 'form',
			defaults: {border: false, anchor: '100%'},
			items: [{
				xtype: 'hidden',
				name: 'rid'
			}, {
				xtype: 'textfield',
				fieldLabel: _('msoptionscolor_name'),
				name: 'name'
			}, {
				layout: 'column',
				border: false,
				items: [{
					columnWidth: 0.5,
					layout: 'form',
					defaults: {border: false, anchor: '100%'},
					items: [{
						xtype: 'msoptionscolor-combo-option-key',
						fieldLabel: _('msoptionscolor_key'),
						name: 'key',
						rid: config.record.rid || 0,
						allowBlank: false,
						listeners: {
							afterrender: {
								fn: function (r) {
									this.handleChangeType(0);
								},
								scope: this
							},
							select: {
								fn: function (r) {
									this.handleChangeType(1);
								},
								scope: this
							}
						}
					}, {
						xtype: 'colorpickerfield',
						fieldLabel: _('msoptionscolor_color'),
						name: 'color',
						hiddenName: 'color'
					}, {
						xtype: 'colorpickerfield',
						fieldLabel: _('msoptionscolor_color'),
						name: 'color2',
						hiddenName: 'color2'
					}]
				}, {
					columnWidth: 0.5,
					layout: 'form',
					defaults: {border: false, anchor: '100%'},
					items: [{
						xtype: 'msoptionscolor-combo-option-values',
						fieldLabel: _('msoptionscolor_value'),
						name: 'value',
						rid: config.record.rid,
						allowBlank: false
					}, {
						xtype: 'msoptionscolor-combo-browser',
						fieldLabel: _('msoptionscolor_pattern'),
						name: 'pattern',
					}, {
						xtype: 'msoptionscolor-combo-browser',
						fieldLabel: _('msoptionscolor_pattern'),
						name: 'pattern2',
					}]
				}]
			}, {
                layout: 'column',
                border: false,
                items: [{
                    columnWidth: 0.5,
                    layout: 'form',
                    defaults: {border: false, anchor: '100%'},
                    items: [{
                        xtype: 'msoptionscolor-combo-product-image',
                        fieldLabel: _('msoptionscolor_image'),
                        name: 'image',
                        rid: config.record.rid,
                        custm: true,
                        clear: true,
                        allowBlank: true
                    }]
                },{
                    columnWidth: 0.5,
                    layout: 'form',
                    defaults: {border: false, anchor: '100%'},
                    items: [{
                        xtype: 'msoptionscolor-combo-product-image',
                        fieldLabel: _('msoptionscolor_image'),
                        name: 'image2',
                        rid: config.record.rid,
                        custm: true,
                        clear: true,
                        allowBlank: true
                    }]
                }]
			}, {
                xtype: 'textarea',
                name: 'description',
                fieldLabel: _('msoptionscolor_description'),
                cls: 'modx-richtext',
                anchor: '100%',
                height: '100px',
                allowBlank: true,
            }]
		}];
	},

	getListeners: function (config) {
		return Ext.applyIf(config.listeners, {
			beforeSubmit: {
				fn: function () {
					//this.saveField();
				}, scope: this
			}
		});
	},

	handleChangeType: function (change) {
		var f = this.fp.getForm();
		var _key = f.findField('key');
		var _value = f.findField('value');

		_value.getStore().baseParams.key = _key.getValue();

		if (1 == change) {
			_value.setValue();
			_value.store.load();
		}
		if (!!_value.pageTb) {
			_value.pageTb.show();
		}
	},

	loadDropZones: function () {

	}

});
Ext.reg('msoptionscolor-window-color', msoptionscolor.window.color);
