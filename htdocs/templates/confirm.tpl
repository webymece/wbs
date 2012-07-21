{include file="header.tpl" title="内容の確認"}

<!-- section -->
<section class="row">
  <div class="col col_16">
    <h2>MECE?</h2>
    <p>
      会議: {$name}<br>
      詳細: {$desc}<br>
      日時: {$date}<br>
      募集: {$join}名<br>
      発表: {$presen}名<br>
      会場: {$place}<br>
      住所: {$url}<br>
    </p>
    <form  action="./complete.php" method="post">
      <fieldset>
	<input type="hidden" name="name" value="{$name}">
	<input type="hidden" name="desc" value="{$desc}">
	<input type="hidden" name="date" value="{$date}">
	<input type="hidden" name="join" value="{$join}">
	<input type="hidden" name="presen" value="{$presen}">
	<input type="hidden" name="place" value="{$place}">
	<input type="hidden" name="url" value="{$url}">
	<input type="button" class="back" value="&larr; MECEN..." onClick="history.back()">
	<input type="submit" class="submit" value="MECE! &rarr;">
      </fieldset>
    </form>
  </div><!-- col_12 -->
</section><!-- row -->
    
{include file="footer.tpl"}

