{include file="header.tpl"}

<!-- section -->
<section class="row">
  <div class="col col_12">
    <h2>Editing of conference information was done</h2>
 
    <fieldset class="s_column">
     編集を完了しました。
    </fieldset>
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
