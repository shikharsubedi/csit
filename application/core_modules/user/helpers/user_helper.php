<?php

function user_access($permission)
{
	if(Current_User::user()->id() == 1)
		return TRUE;
	
	return Current_User::can($permission);
}

function getFullName($userId)
{
	
}
?>