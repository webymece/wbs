{include file="header.tpl"}
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/aokayama/reg.js'></script>
<!-- section -->
<section class="row">
  <div class="col col_12">
    <h2>会議の登録</h2>
    <form action="./confirm.php" method="post">
      <fieldset class="s_column">
	<legend><span>Next!</span> conference</legend>
	<div>
	  <label for="name">会議</label>
	  <input type="text" id="text" name="name" required="required" class="box_shadow">
	</div>
	<div>
	  <label for="desc">説明</label>
          <input type="text" id="desc" name="desc" required="required" class="box_shadow" wrap="soft"></textarea>
        </div>
	<div>
	  <label for="date">日時</label>
	  <input type="date" id="date" name="date" required="required" class="box_shadow">
	</div>
	<div>
	  <label for="place">会場</label>
        <select name="place_id" id="place_id" required="required">
            <option value="0">市ヶ谷健保会館</option>
            <option value="1">大久保健保会館</option>
            <option value="2">どこか夢の場所</option>
            <option value="3">あの遠い空の向こう</option>
            <option value="4">その他</option>
        </select>
        <div id="hiddenInput" style="display:none">
            <input type="input" name="place" id="place" class="box_shadow" placeholder="会場名">
            <input type="input" name="address" id="address" class="box_shadow" placeholder="住所">
        </div>
    </div>
	<div>
	  <label for="join">参加人数</label>
        <select name="join">
            {section name=cnt start=1  loop=100}
                <option value="{$smarty.section.cnt.index}">{$smarty.section.cnt.index}</option>
            {/section}
        </select>
    </div>
	<div>
	  <label for="presen">プレゼン人数</label>
        <select name="presen">
            {section name=cnt start=1  loop=100}
                 <option value="{$smarty.section.cnt.index}">{$smarty.section.cnt.index}</option>
            {/section}
        </select>
    </div>
    <input class="submit" type="submit" value="登録 &rarr;">
    </fieldset>
    </form>
  </div><!-- col_12 -->

  <div class="col col_4">
    <h2>過去の会議</h2>
    <ul>
      {foreach from=$all_list item=value}
      <li><a href="./conferenceHistory.php?c_num={$value.c_id}">{$value.c_name}</a></li>
      {/foreach}
    </ul>
  </div><!-- col_4 -->
</section><!-- row -->
    
{include file="footer.tpl"}

