Ext.override(MODx.panel.Resource,{
    getParentFields: MODx.panel.Resource.prototype.getFields,

    getFields: function(config) {

        var parentFields = this.getParentFields.call(this, config);

        for(var i in parentFields){
            var item = parentFields[i];
            console.log(i);
            if(item.id == 'modx-resource-tabs'){
                item.items.push({
                    id: 'delivery-tab'
                    ,autoHeight: true
                    ,title: 'title delivery tab'
                    ,layout: 'form'
                    ,anchor: '100%'
                    ,items: [{
                        html:'<p>my content</p>'
                        ,bodyCssClass: 'panel-desc'
                        ,border: false
                    },{
                       /* layout: 'columns'
                        ,width: '100%'
                        ,anchor: '100%'*/
                    }]
                });
            }
        }
        return parentFields;
    }
});