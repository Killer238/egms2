Seodomains.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        cls: 'container',
        items: [{
            html: '<h2>'+_('seodomains')+'</h2>'
        }, {
            xtype: 'modx-tabs',
            items: [{
                title: _('seodomains_panel_main'),
                items: [{
                    html: _('seodomains_panel_main_desc'), 
                    cls: 'panel-desc',
                },{
                    xtype: 'panel',
                    cls: 'container',
                    items: [{
                        xtype: 'seodomains-grid-city'
                    }]
                }]
            },{
                title: _('seodomains_panel_multiload'),
                items: [{
                    html: _('seodomains_panel_multiload_desc'), 
                    cls: 'panel-desc',
                },{
                    xtype: 'panel',
                    cls: 'container',
                    items: [{
                        xtype: 'seodomains-sample-form'
                    }]
                }]
            }]
        }]
    });
    Seodomains.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(Seodomains.panel.Home, MODx.Panel);
Ext.reg('seodomains-panel-home', Seodomains.panel.Home);