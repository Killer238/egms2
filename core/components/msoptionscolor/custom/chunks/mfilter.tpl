<!DOCTYPE html>
<html>
<head>
	[[$Head]]
</head>
<body>
[[$Navbar]]
<div class="container">
	[[$Crumbs]]
	<div id="content" class="inner">
		<h3>[[*pagetitle]]</h3>

		[[!setCategory]]

		[[!mFilter2?
		&limit=`5`
		&parents=`0`
		&element=`msProducts`
		&setMeta=`1`
		&filters=`
		ms|price:number,
		parent:categories,
		msoption|size,
		msoption|color,
		ms|vendor:vendors,
		msoc|color~value~color,
		`

		&showLog=`1`
		&suggestionsRadio=`ms|vendor`
		&_filterOptions=`{"autoLoad":0}`
		&tpls=`tpl.msProducts.row,tpl.msProducts.row`
		&class=`msProduct`
		&sort=`ms|price:desc`
		&tplOuter=`tpl.mFilter2.outer`
		&tplFilter.outer.ms|price=`tpl.mFilter2.filter.slider`
		&tplFilter.row.ms|price=`tpl.mFilter2.filter.number`
		&tplFilter.outer.ms|vendor=`tpl.mFilter2.filter.select`
		&tplFilter.row.ms|vendor=`tpl.mFilter2.filter.option`

		&tplFilter.outer.msoc|color=`tpl.mFilter2.filter.outer`
		&tplFilter.row.msoc|color=`tpl.mFilter2.filter.checkbox.color`

		]]
	</div>
	[[$Footer]]
</div>
</body>
</html>