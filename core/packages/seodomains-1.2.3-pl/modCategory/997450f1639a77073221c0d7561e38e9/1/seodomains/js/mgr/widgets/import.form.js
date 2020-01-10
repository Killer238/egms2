Seodomains.panel.Import = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'seodomains-import-panel';
    }
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        url: Seodomains.config.connector_url,
        config: config,
        layout: 'anchor',
        fileUpload: true,
	baseParams: {
            action: 'mgr/city/import'
	},
        items: [{
            xtype: 'label',
            html: '<b>'+_('seodomains_form_file')+'</b>',
            forId: config.id + '-file-import',
            cls: 'seodomains-label',
            width: '100%'
        },{
            xtype:'modx-combo-browser',
            name: 'file-import',
            //inputType: 'file',
            allowBlank: false,
            cls: 'file-import',
            width: '100%',
            id: config.id + '-file-import',
            openTo: '/'
        },{
            xtype:'textfield',
            name: 'step-import',
            allowBlank: false,
            labelSeparator: '',
            hideLabel: true,
            cls:'hidden',
            value: '1',
            id: config.id + '-step-import',
        }],
        buttons: [{
            xtype: 'button',
            text: _('seodomains_form_start'),
            name: 'start-import',
            id: config.id + '-start-import',
            cls: 'primary-button',
            listeners: {
		click: {fn: this._startimport, scope: this}
            }
        }]
    });
    
    Seodomains.panel.Import.superclass.constructor.call(this, config);
};
var i = 1;
Ext.extend(Seodomains.panel.Import, MODx.FormPanel,{
    _startimport: function() {
        Ext.MessageBox.show({
            title: _('seodomains_form_loading'), 
            msg: _('seodomains_form_loading_text'), 
            width: 200, 
            progress: true, 
            closable: false
        });

        var cfid = this.config.id;
        var intervalID=setInterval(function() {
        Ext.getCmp(cfid).form.submit({
            url: Seodomains.config.connector_url,
            success: function(form, response){
                i = i + 1;
                var i_value = i - 1;
                //Ext.MessageBox.hide();
                //Ext.MessageBox.alert(_('success'), 'Городов добавлено: '+ i_value);
                Ext.getCmp('seodomains-import-panel-step-import').setValue(i);
                Ext.MessageBox.updateProgress(0, i_value);
            },
            failure: function(form, response){
                Ext.MessageBox.hide();
                Ext.MessageBox.alert(_('seodomains_import_header'), response.result.message);
                clearInterval(intervalID);
            }
        });
        }, 8000);
    },
});
Ext.reg('seodomains-sample-form', Seodomains.panel.Import);