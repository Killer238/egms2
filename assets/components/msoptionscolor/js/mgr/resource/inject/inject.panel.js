msoptionscolor.panel.ResourceInject = function (config) {
	config = config || {};

	if (!config.update) {
		config.update = true;
	}

	Ext.apply(config, {
		id: 'msoptionscolor-panel-resource-inject',
		cls: 'msoptionscolor-panel-resource-inject',
		bodyCssClass: 'main-wrapper',
		forceLayout: true,
		deferredRender: false,
		autoHeight: true,
		border: false,
		items: this.getMainItems(config)
	});

	msoptionscolor.panel.ResourceInject.superclass.constructor.call(this, config);
};
Ext.extend(msoptionscolor.panel.ResourceInject, MODx.Panel, {

	getMainItems: function (config) {

		return [{
			xtype: 'panel',
			layout: 'fit',
			items: [{
				xtype: 'msoptionscolor-grid-color',
				resource: msoptionscolor.config.resource
			}]
		}];
	}

});

Ext.reg('msoptionscolor-panel-resource-inject', msoptionscolor.panel.ResourceInject);

