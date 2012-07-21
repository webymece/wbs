{include file="header.tpl"}
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/aokayama/joinConf.js'></script>
<section id='styled' class='row'>
            <div class='col col_12'>
                <article>
                	<form action='joinConf.php?c_id={$c_id}&c_max={$c_max}' method='post'>
                	<input type='hidden' id='status' name='status' value='confirm'>
                	<h2>参加登録</h2>
                	<h3>お名前</h3>
                	<input type='text' name='u_name' id='u_name' placeholder='例: 植尾太郎' value='{$u_name}' />
                	<br /><br />
                	<input type='checkbox' name='u_type' id='u_type' value='1' {if $u_type eq 1}checked{/if} />
                	発表する場合はチェックをつけてください
                	<br /><br />
                	<div id='for_presenter' {if $u_type ne 1}style='display:none'{/if}>
                		<h3>発表タイトル</h3>
                		<input type='text' name='u_title' id='u_title' placeholder='例: WebSocketとNode.js' value='{$u_title}' />
                		<br /><br />
                		<h3>発表内容</h3>
                		<textarea name='u_desc' id='u_desc' rows='8' cols='43'>{$u_desc}</textarea>
                	</div>
                	<br />
                	<input class="submit" type="submit" value="登録 &rarr;">
                	<br />
                	</form>        	
                </article>
            </div>
            <div class='col col_4'>
                <h2>参加者</h2>
                <ul>
                    {foreach from=$u_data key=index item=user}
                        {if $index lt $c_max}
                            <li>{math equation='i+1' i=$index}: {$user.u_name}</li>
                        {else}
                            {if $index eq $c_max}
                                </ul>
                                <br />
                                <h4>補欠</h4>
                                <ul>
                            {/if}
                            <li>{math equation='i+1-max' i=$index max=$c_max}: {$user.u_name}</li>
                        {/if}
                    {/foreach}
                </ul>
            </div>
        </section>
{include file="footer.tpl"}
