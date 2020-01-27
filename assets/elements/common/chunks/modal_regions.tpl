<!--noindex-->
<div class="modal fade" id="Cities" role="dialog">
    <div class="modal-dialog full__dialog">
        <div class="modal-content full__dialog">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;
            </div>
            <div class="modal-body">
                <div>
                    <h4>Поиск по городу</h4>
                    <input type="text" placeholder="Поиск по городу" class="form-control sd-city-input">
                </div>
                <div class="row" style="margin:0px;">
                    {foreach $groups as $group}
                        <div class="col-xs-12 col-sm-6 col-md-2 citygroup">
                            <div class="letter">{$group.letter}</div>
                                <ul>
                                {foreach $group.rows as $row}
                                    <li class="sd-city-item">
                                        <a href="{$row.link}" rel="nofollow" class="{$row.active}">{$row.city}</a>
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</div>
<!--/noindex-->