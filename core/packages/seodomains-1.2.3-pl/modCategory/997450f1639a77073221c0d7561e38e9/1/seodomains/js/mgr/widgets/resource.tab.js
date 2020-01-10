setTimeout(function () {
    Ext.override(MODx.panel.Resource, {
        getParentFields: MODx.panel.Resource.prototype.getFields,

        getFields: function (config) {
            var parentFields = this.getParentFields.call(this,config);

            for(var i in parentFields){
                var item = parentFields[i];

                if(item.id == 'modx-resource-tabs' || item.id == 'modx-tabs'){
                    if(config.resource > 0){
                        item.items.push({
                            id: 'seodomains-resource-tab'
                            ,autoHeight: true
                            ,title: _('seodomains_resource_tab')
                            ,layout: 'anchor'
                            ,anchor: '100%'
                            ,items: [{
                                html: '<p>'+_('seodomains_resource_tab_desc')+'</p>'
                                ,bodyCssClass: 'panel-desc'
                                ,border: false
                            },{
                                xtype: 'seodomains-panel-resource',
                                anchor: '99%',
                                record: config.record
                            }]
                        });
                    }
                }
            }

            return parentFields;
        }
    });
}, 10);