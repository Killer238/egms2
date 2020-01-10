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
                <br/>
                <ul>
                    {foreach $rows as $row}
                        <li class="sd-city-item">
                            <a href="{$row.link}" rel="nofollow" class="{$row.active}">{$row.city}</a>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/noindex-->