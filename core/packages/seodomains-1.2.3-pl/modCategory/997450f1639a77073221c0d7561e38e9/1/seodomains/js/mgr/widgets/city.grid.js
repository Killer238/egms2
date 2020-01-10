Seodomains.grid.City = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'seodomains-grid-city';
    }
    Ext.apply(config, {
        columns: this.getColumns(),
        fields: this.getFields(),
        tbar: this.getTbar(config),
        autoHeight: true,
        sm: new Ext.grid.CheckboxSelectionModel(),
        viewConfig: {
            forceFit: true,
            enableRowBody: true,
            autoFill: true,
            showPreview: true,
            scrollOffset: 0,
            getRowClass: function (rec) {}
        },
        listeners: {
            rowDblClick: function (grid, rowIndex, e) {
                var row = grid.store.getAt(rowIndex);
                this.updateItem(grid, e, row);
            }
        },
        url: Seodomains.config.connector_url,
        action: 'mgr/city/getlist',
        paging: true,
        pageSize: 20,
        remoteSort: true
    });
    Seodomains.grid.City.superclass.constructor.call(this, config);
    this.store.on('load', function () {
        if (this._getSelectedIds().length) {
            this.getSelectionModel().clearSelections();
        }
    }, this);
}
Ext.extend(Seodomains.grid.City, MODx.grid.Grid);
Ext.reg('seodomains-grid-city', Seodomains.grid.City);


Ext.extend(Seodomains.grid.City, MODx.grid.Grid, {
    getColumns: function () {
        var columns = {
            id: {sortable: true, width: 40, hidden: true},
            domain: {sortable: true, width: 200},
            city: {sortable: true, width: 200},
            city_r: {sortable: true, width: 200},
            phone: {sortable: true, width: 200},
            email: {sortable: true, width: 200},
            address: {sortable: true, width: 200},
            address_full: {sortable: true, width: 200},
            address_coordinats: {sortable: true, width: 200},
            actions: {sortable: true, width: 140, renderer: Seodomains.utils.renderActions, sortable: false, id: 'actions'},
        };
        
        var fields = [];
        for (i in Seodomains.config['city_fields']) {
            if (!Seodomains.config['city_fields'].hasOwnProperty(i)) {
                continue;
            }
            var field = Seodomains.config['city_fields'][i];
            if (columns[field]) {
                Ext.applyIf(columns[field], {
                    header: _('seodomains_city_grid_' + field),
                    dataIndex: field
                });
                fields.push(columns[field]);
            }
        }

        return fields;
        
//        return [
//            {dataIndex: 'id', sortable: true, width: 40, header: 'ID'},
//            {dataIndex: 'domain', sortable: true, width: 230, header: _('seodomains_city_grid_domain')},
//            {dataIndex: 'city', sortable: true, width: 210, header: _('seodomains_city_grid_city')},
//            {dataIndex: 'phone', sortable: true, width: 210, header: _('seodomains_city_grid_phone')},
//            {dataIndex: 'email', sortable: true, width: 210, header: _('seodomains_city_grid_email')},
//            {dataIndex: 'actions', width: 140, header: _('actions'), renderer: Seodomains.utils.renderActions, sortable: false, id: 'actions'}
//        ]
    },
    getFields: function () {
        return Seodomains.config.city_fields;
    },
    getTbar: function (config) {
        return [{
            text: '<i class="icon icon-plus"></i>&nbsp;' + _('add'),
            handler: function () {
                var w = MODx.load({ 
                    xtype: 'seodomains-window-city',
                    listeners: {
                        success: {
                            fn: function () {
                                this.refresh();
                            }, scope: this
                        }
                    }
                });
                w.setValues({active: true});
                w.show();
            },
            scope: this
        }, '->',  {
            xtype: 'textfield',
            id: config.id + '-seodomains-filter-query',
            emptyText: _('seodomains_grid_search_empty'),
            width: 250,
            listeners: {
                render: {
                    fn: function (field) {
                        field.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
                            this.filterSend();
                        }, this);
                    }, scope: this
                },
            }
        }, {
            xtype: 'button',
            text: '<i class="icon icon-check"></i>',
            handler: this.filterSend,
        }, {
            xtype: 'button',
            text: '<i class="icon icon-times"></i>',
            handler: this.filterClear,
        }];
    },
    getMenu: function (grid, rowIndex) {
        var ids = this._getSelectedIds();

        var row = grid.getStore().getAt(rowIndex);
        var menu = Seodomains.utils.getMenu(row.data['actions'], this, ids);

        this.addContextMenuItem(menu);
    },
    duplicateItem: function (btn, e, row) {
        if (typeof(row) != 'undefined') {
            this.menu.record = row.data;
        }
        else if (!this.menu.record) {
            return false;
        }
        var id = this.menu.record.id;

        MODx.Ajax.request({
            url: Seodomains.config.connector_url,
            params: {
                action: 'mgr/city/get',
                id: id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        var w = MODx.load({
                            xtype: 'seodomains-city-window-duplicate',
                            id: Ext.id(),
                            record: r,
                            listeners: {
                                success: {
                                    fn: function () {
                                        this.refresh();
                                    }, scope: this
                                }
                            }
                        });
                        w.reset();
                        w.setValues(r.object);
                        w.show(e.target);
                    }, scope: this
                }
            }
        });
    },
    updateItem: function (btn, e, row) {
        if (typeof(row) != 'undefined') {
            this.menu.record = row.data;
        }
        else if (!this.menu.record) {
            return false;
        }
        var id = this.menu.record.id;

        MODx.Ajax.request({
            url: Seodomains.config.connector_url,
            params: {
                action: 'mgr/city/get',
                id: id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        var w = MODx.load({
                            xtype: 'seodomains-city-window-update',
                            id: Ext.id(),
                            record: r,
                            listeners: {
                                success: {
                                    fn: function () {
                                        this.refresh();
                                    }, scope: this
                                }
                            }
                        });
                        w.reset();
                        w.setValues(r.object);
                        w.show(e.target);
                    }, scope: this
                }
            }
        });
    },
    removeItem: function () {
        var ids = this._getSelectedIds();
        if (!ids.length) {
            return false;
        }
        MODx.msg.confirm({
            title: _('confirm'),
            text: _('remove'),
            url: this.config.url,
            params: {
                action: 'mgr/city/remove',
                ids: Ext.util.JSON.encode(ids),
            },
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        });
        return true;
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
                }
                else if (typeof this[action] === 'function') {
                    this.menu.record = row.data;
                    return this[action](this, e);
                }
            }
        }
        return this.processEvent('click', e);
    },
    _getSelectedIds: function () {
        var ids = [];
        var selected = this.getSelectionModel().getSelections();

        for (var i in selected) {
            if (!selected.hasOwnProperty(i)) {
                continue;
            }
            ids.push(selected[i]['id']);
        }

        return ids;
    },
    
    searchFields: ['query'],

    filterSend: function () {
        if (this.searchFields.length > 0) {
            for (var i = 0; i < this.searchFields.length; i++) {
                this.getStore().baseParams[this.searchFields[i]] = Ext.getCmp(this.id + '-seodomains-filter-' + this.searchFields[i]).getValue();
            }
        }
        this.getBottomToolbar().changePage(1);
    },

    filterClear: function () {
        if (this.searchFields.length > 0) {
            for (var i = 0; i < this.searchFields.length; i++) {
                Ext.getCmp(this.id + '-seodomains-filter-' + this.searchFields[i]).reset();
            }
        }
        this.filterSend();
    },
}); 
Ext.reg('seodomains-grid-city', Seodomains.grid.City);