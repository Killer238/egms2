var Seodomains = function (config) {
    config = config || {};
    Seodomains.superclass.constructor.call(this, config);
};
Ext.extend(Seodomains, MODx.Component, {
    panel: {}, page: {}, window: {}, grid: {}, tree: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('seodomains', Seodomains);

Seodomains = new Seodomains();