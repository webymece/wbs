{config_load file=weby.conf section="setup"}
<!DOCTYPE html>
<html lang='ja'>
<head>
<title>login</title>
<meta charset='UTF-8' />
<!-- 52framework js css -->
{include file="./52framework.tpl"}
<!--/52framework js css-->
</head>

<body>

<section id='styled' class='row'>

<br >

<div class='col_16 col'>
<div style="width:300px;height:100px;position:fixed;top:50%;left:50%;text-align:center;margin-left:-150px;margin-top:-100px;">
  <form method='post' action='#'>
    <fieldset>
      <input type='text' name='username' id='username' placeholder="username" class="box_shadow"><br>
      <input type='password' name='password' id='password' placeholder="password" class="box_shadow"><br>
      <input type='submit' value='login'>
    </fieldset>
  </form>
  <br>
  <div style='color: #666666;font-size: 0.9em;padding: 4px 0;text-align: center;'>all rights reserved &copy; weby conference</div>
</div>
</div>

<br>

</section>

</body>
</html>
