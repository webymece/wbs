{include file="header.tpl"}
        <section id='styled' class='row'>
            <div class='col col_12'>
                <article>
                	<h1>参加登録が完了しました</h1>
                </article>
            </div>
            <div class='col col_4'>
                <h2>参加者</h2>
                <ul>
                    {foreach from=$u_data key=index item=user}
                        {if $index lt $c_max}
                            <li>{math equation='i+1' i=$index}: {$user.u_name}{if $user.u_launch eq true} <image src='/image/launch.png' width='15px' id='launch_icon'>{/if}</li>
                        {else}
                            {if $index eq $c_max}
                                </ul>
                                <br />
                                <h4>補欠</h4>
                                <ul>
                            {/if}
                            <li>{math equation='i+1-max' i=$index max=$c_max}: {$user.u_name}{if $user.u_launch eq true} <image src='/image/launch.png' width='15px' id='launch_icon'>{/if}</li>
                        {/if}
                    {/foreach}
                </ul>
            </div>
        </section>
{include file="footer.tpl"}
