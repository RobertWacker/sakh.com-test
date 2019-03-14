<style type="text/css">
	.login__box {
		margin: 0 auto;
		width: 300px;
		background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,.2);
    border-radius: 3px;
		padding: 30px;
		box-sizing: border-box;
	}

	.login__box input[type='text'] {
		display: block;
		width: 100%;
		padding: 5px;
		box-sizing: border-box;
		outline: none;
	}

	.login__box input[type='password'] {
		display: block;
		width: 100%;
		padding: 5px;
		box-sizing: border-box;
		outline: none;
	}

	.login__box .button_green {
		background: #00b72b;
		color: #fff;
		width: 100%;
		padding: 10px 0;
		border-radius: 3px;
		outline: none;
		cursor: pointer;
	}

	.login__box .button_green:hover {
		background: #049c28;
	}

	.error {
		background: #fb5858;
		color: #222;
		padding: 10px;
		text-align: center;
		border-bottom: 1px solid #ee0000;
		font-weight: bold;
		font-size: 14px;
	}
</style>
<?php if(isset($data) && !empty($data)) echo '<div class="error">'.$data.'</div>'; ?>

<div class="page">
	<h1>Авторизация</h1>
	<div class="login__box">
		<form action="/login" method="post">
			<input type="text" name="login" placeholder="Login" maxlength="32">
			<input type="password" name="password" placeholder="Password" maxlength="32">
			<button class="button_green" type="submit">LOGIN</button>
		</form>
	</div><!-- /login__box -->
</div><!-- /page -->