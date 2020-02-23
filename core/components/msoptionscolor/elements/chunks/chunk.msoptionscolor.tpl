{foreach $colors as $name => $color}
	<div class="form-group">
		<label class="col-md-2 control-label" for="option_{$name}">{('ms2_product_' ~ $name) | lexicon}:</label>
		<div class="col-md-10">
			{foreach $color as $row index=$index}
				<div class="radio-inline pull-left">
					<label class="input-parent">
						<input type="radio" name="options[{$name}]" value="{$row.value}" {$index ? '' : 'checked'}>
						{if $row.pattern?}
							<div>
								<img alt="" title="{$row.value}" class="img-rounded" style="background-image:url({$row.pattern});width:25px;height:25px;">
							</div>
						{else}
							<div>
								<img alt="" title="{$row.value}" class="img-rounded" style="background-color:#{$row.color};width:25px;height:25px;">
							</div>
						{/if}
						{$row.value}
					</label>
				</div>
			{/foreach}
		</div>
	</div>
{/foreach}
