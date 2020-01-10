<!--noindex-->
<div class="modal fade" id="Cities" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Выбрать город</h4>
            </div>
            <div class="modal-body">
                <div>
                    <input type="text" placeholder="Поиск по городу" class="form-control sd-city-input">
                </div>
                <div>
                    {foreach $groups as $group}
                        <div class="citygroup">
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