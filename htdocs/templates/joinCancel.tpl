{include file="header.tpl" title="参加状態変更"}

<!-- section -->
<section class="row">
  <div class="col col_16">
    <h2>以下の会議参加をキャンセルします</h2>
    <p>
      会議: {$c_name}<br>
      名前: {$u_name}<br>
    </p>
    <form  action="./cancelComplete.php" method="post">
      <fieldset>
	<input type="hidden" name="c_id" value="{$c_id}">
	<input type="hidden" name="u_id" value="{$u_id}">
	<input type="button" class="back" value="&larr; やっぱやめた" onClick="history.back()">
	<input type="submit" class="submit" value="キャンセルする &rarr;">
      </fieldset>
    </form>
  </div><!-- col_12 -->
</section><!-- row -->
    
{include file="footer.tpl"}

