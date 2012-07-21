{include file="header.tpl" title="weby 出欠管理"}

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/aokayama/map.js'></script>
<script type='text/javascript' src='js/expand.js'></script>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false&language=ja' charset='UTF-8'></script>

<link rel="stylesheet" type="text/css" href="css/expand.css">

<section id='styled' class='row'>

<div class='col col_12'>
<article>
  <h2><span>Next! </span>{$c_data.c_name}</h2>
  {if $c_data.c_map_url ne 'none' }
      <div id='map' style='width:180px; height:180px;float:right;background-color:black;margin:10px'>
        <input type="hidden" id="m_address" value="{$c_data.c_map_url}"><br>
        <input type="hidden" id="m_place" value="{$c_data.c_place}"><br>
      </div>
  {/if}
  <p>
    日時: {$c_data.c_date}<br>
    会場: {$c_data.c_place}<br>
    住所: {$c_data.c_map_url}<br><br>
    　{$c_data.c_desc}
  </p>

  <hr>

  <br>
	<div id="presenterlist">
  <h2>発表</h2>
    <br>
    {foreach from=$p_data key=index item=presenter}
    {if $index lt $c_data.c_m_presen}
      <!--<div class="presenter_info">-->
			<div class="presenter">
      <h3>{$presenter.u_title}</h3>
      <p style="display:none;">
	{$presenter.u_desc}<br>
      </p>
      <h4>{$presenter.u_name}</h4>
      <!--</div>-->
			</div>
    {else}
    {if $index eq $c_data.c_m_presen}
      <h3>補欠</h3>
      {/if}
      <!--<div class="substitute_info">-->
      <p>
	補欠:{$presenter.u_name}<br>
	タイトル:{$presenter.u_title}<br>
      </p>
      <!--</div>-->
    {/if}
    {/foreach}
	</div><!-- presenter -->
  
</article>
</div>

<div class='col col_4'>
  <h2>参加者</h2>
  <ul>
    {foreach from=$u_data key=index item=user}
    {if $index lt $c_data.c_m_join}
    <li>{math equation='i+1' i=$index}: <a href="joinCancel.php?u_id={$user.u_id}">{$user.u_name}</a>{if $user.u_launch eq true} <image src='/image/launch.png' width='15px' id='launch_icon'>{/if}</li>
    {else}
    {if $index eq $c_data.c_m_join}
  </ul>
  <br>
  <h4>補欠</h4>
  <ul>
    {/if}
    <li>{math equation='i+1-max' i=$index max=$c_data.c_m_join}: <a href="joinCancel.php?u_id={$user.u_id}">{$user.u_name}{if $user.u_launch eq true} <image src='/image/launch.png' width='15    px' id='launch_icon'>{/if}</a></li>
    {/if}
    {/foreach}
  </ul>
</div>
</section>

{include file='footer.tpl'}

