{include file="header.tpl"}
        <section id='styled' class='row'>
            <div class='col col_12'>
                <article>
                	<form action='joinConf.php?c_id={$c_id}&c_max={$c_max}' method='post'>
	                	<input type='hidden' id='status' name='status' value='done'>
    	            	<input type='hidden' name='u_name' id='u_name' value='{$u_name}' />
    	            	<input type='hidden' name='u_launch' id='u_launch' value='{$u_launch}' />
						<input type='hidden' name='u_type' id='u_type' value='{$u_type}' />
						<input type='hidden' name='u_title' id='u_title' value='{$u_title}' />
						<input type='hidden' name='u_desc' id='u_desc' value='{$u_desc}'>
                		<h2>参加登録</h2>
                		<h3>お名前</h3>
						<h5>{$u_name}{if $u_launch eq true}　<image src='/image/launch.png' width='30px' style='margin-bottom:-5px;'>{/if}</h5>
						{if $u_type eq '1'}
               				<h3>発表タイトル</h3>
               				<h5>{$u_title}</h5>
               				<h3>発表内容</h3>
               				<p>{$u_desc}</p>
               			{/if}
                		<input type="button" class="back" value="&larr; キャンセル" onClick="history.back()">
                        <input type="submit" class="submit" value="登録 &rarr;">
     
                	</form>        	
                </article>
            </div>
            <div class='col col_4'>
                <h2>参加者</h2>
                <ul>
                    {foreach from=$u_data key=index item=user}
                        {if $index lt $c_max}
                            <li>{math equation='i+1' i=$index}: {$user.u_name}{if $user.u_launch eq true}<image src='/image/launch.png' width='15px' id='launch_icon'>{/if}</li>
                        {else}
                            {if $index eq $c_max}
                                </ul>
                                <br />
                                <h4>補欠</h4>
                                <ul>
                            {/if}
                            <li>{math equation='i+1-max' i=$index max=$c_max}: {$user.u_name}{if $user.u_launch eq true}<image src='/image/launch.png' width='15px' id='launch_icon'>{/if}</li>
                        {/if}
                    {/foreach}
                </ul>
            </div>
        </section>
{include file="footer.tpl"}
