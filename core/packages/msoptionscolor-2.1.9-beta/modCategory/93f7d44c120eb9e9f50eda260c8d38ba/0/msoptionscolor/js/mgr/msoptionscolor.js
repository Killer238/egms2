var msoptionscolor = function (config) {
	config = config || {};
	msoptionscolor.superclass.constructor.call(this, config);
};
Ext.extend(msoptionscolor, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, tools: {}
});
Ext.reg('msoptionscolor', msoptionscolor);

msoptionscolor = new msoptionscolor();