Seodomains.panel.Resource = function (config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'seodomains-panel-resource',
        autoHeight: true,
        layout: 'form',
        anchor: '99%',
        items: [{
            xtype: 'seodomains-grid-resource',
            cls: 'main-wrapper',
            record: config.record
        }]
    });
    Seodomains.panel.Resource.superclass.constructor.call(this, config);
};
Ext.extend(Seodomains.panel.Resource, MODx.Panel);
Ext.reg('seodomains-panel-resource', Seodomains.panel.Resource);
