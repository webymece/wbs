{include file="header.tpl" title='過去の会議'}

<section id="styled" class="row">
  
<div class="col col_12">
<article>
  <h2>会議詳細</h2>
  <h3>{$conf.c_name}</h3>
  <p>{$conf.c_desc}</p>
  <p><font size="4">
    場所: {$conf.c_place}<br>
    日時: {$conf.c_date}<br>
    住所: {$conf.c_map_url}<br>
  </font></p>
    
  <hr>
    
  <table class="conference_table">
    <h3>発表者</h3>
    <tr>
      <th>発表者</th>
      <th>タイトル</th>
      <th>内容</th>
    </tr>
    {foreach from=$users key=res item=i}
    <tr>
      <td>{$i.u_name}</td>
      <td>{$i.u_title}</td>
      <td>{$i.u_desc}</td>
    </tr>
    {/foreach}
  </table>
   
  <!-- 発表者と参加者の変数追加しました TODO　削除  --> 
  <!-- デザインよろしくお願いいたします  TODO　削除--> 
  <table class="conference_table">
    <h3>発表者</h3>
    <tr>
      <th>発表者</th>
      <th>タイトル</th>
      <th>内容</th>
    </tr>
    {foreach from=$announcer key=res item=i}
    <tr>
      <td>{$i.u_name}</td>
      <td>{$i.u_title}</td>
      <td>{$i.u_desc}</td>
    </tr>
    {/foreach}
  </table>

  <table class="conference_table">
    <h3>参加者</h3>
    <tr>
      <th>参加者</th>
      <th>タイトル</th>
      <th>内容</th>
    </tr>
    {foreach from=$attendant key=res item=i}
    <tr>
      <td>{$i.u_name}</td>
      <td>{$i.u_title}</td>
      <td>{$i.u_desc}</td>
    </tr>
    {/foreach}
  </table>

  <!-- コピー方法は考え中  TODO　削除-->
  <form>
    <fieldset>	
    <input type="button" value="copy">
    </fieldset>
  </form>
</article>
</div>

<div class="col col_4">
  <h2>検索</h2>
    <div>日付で検索する</div>
    <div>空検索はすべて表示</div>
    <div>カレンダーとかだと楽かも</div>
</div> 

<div class="col col_4">
  <h2>過去の会議</h2>
  <!--<div>今までの会議のリスト表示</div>-->
  <!--<div>最大表示件数考える</div>-->
  <ul>
    {foreach from=$confs key=result item=item}
    <li><a href ='/conferenceHistory.php?c_num={$item.c_id}'>{$item.c_name}</a></li>
    {/foreach}
  </ul>
</div> 
</section>

{include file="footer.tpl"}
