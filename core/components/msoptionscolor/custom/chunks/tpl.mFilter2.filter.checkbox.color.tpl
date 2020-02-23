{var $title = $title|split:'~'}
<label for="mse2_[[+table]][[+delimeter]][[+filter]]_[[+idx]]" class="[[+disabled]] checkbox-inline">
	<span style="display:none;"> {$title[0]} </span>
	<input type="checkbox" name="[[+filter_key]]" id="mse2_[[+table]][[+delimeter]][[+filter]]_[[+idx]]" value="[[+value]]" [[+checked]] [[+disabled]]/>
	<div>
		<img alt="" title="{$title[0]}" class="img-rounded" style="background-color:#{$title[1]};width:25px;height:25px;">
	</div>
	{$title[0]} <sup>[[+num]]</sup>
</label>