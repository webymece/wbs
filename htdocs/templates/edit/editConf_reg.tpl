{include file="header.tpl"}

<!-- section -->
<section class="row">
  <div class="col col_12">
    <h2>Edit conference information</h2>
    <form action="./editConf.php?c_id={$c_id}" method="post">
    	<input type="hidden" name="status" id="status" value="done" />
      <fieldset class="s_column">
    <div>
      <label for="name">会議</label>
      <input type="text" id="text" name="name" required="required" class="box_shadow" value="{$name}">
    </div>
    <div>
      <label for="desc">説明</label>
          <input type="text" id="desc" name="desc" required="required" class="box_shadow" cols="80" wrap="soft" value="{$desc}"></textarea>
        </div>
    <div>
      <label for="date">日時</label>
      <input type="text" id="date" name="date" required="required" class="box_shadow" value="{$date}">
    </div>
    <div>
      <label for="place">場所</label>
      <input type="text" id="place" name="place" required="required" class="box_shadow" value="{$place}">
    </div>
    <div>
      <label for="m_presen">発表者人数</label>
		<select name="m_presen">
		{section name=cnt start=1  loop=100}
		<option value="{$smarty.section.cnt.index}"  {if $smarty.section.cnt.index eq $m_presen}selected{/if}>{$smarty.section.cnt.index}</option>
		{/section}
		</select>
    </div>
    <div>
      <label for="m_join">最大参加人数</label>
		<select name="m_join">
		{section name=cnt start=1  loop=100}
		<option value="{$smarty.section.cnt.index}"  {if $smarty.section.cnt.index eq $m_join}selected{/if}>{$smarty.section.cnt.index}</option>
		{/section}
		</select>
    </div>
    <div>
      <label for="address">会場の住所</label>
          <input type="address" id="address" name="address" required="required" class="box_shadow" value="{$url}">
        </div>
        <input class="submit" type="submit" value="登録 &rarr;">
      </fieldset>
    </form>
  </div><!-- col_12 -->

  <div class="col col_4">
    <h2>All listed</h2>
    <ul>
      {foreach from=$all_list item=value}
      <li><a href="./index.php?c_id={$value.c_id}">{$value.c_name}</a></li>
      {/foreach}
    </ul>
  </div><!-- col_4 -->
</section><!-- row -->

{include file="footer.tpl"}

