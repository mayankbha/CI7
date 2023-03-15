<?php

function check_login($login, $redirect)
{
	print_r($login);
	if(isset($login))
	{
		echo 'logged';
	}
}