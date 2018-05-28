<?php

function dateMysql($date)
{
	//return mdate('%M %d, %Y - %h:%i %a',mysql_to_unix($date));
	return mdate('%M %d, %Y',mysql_to_unix($date));
}

function dateMysqlWithTime($date)
{
	return mdate('%M %d, %Y - %h:%i %a',mysql_to_unix($date));
}

function dateMysql_($date)
{
	return mdate('%d %F %Y',mysql_to_unix($date));
}

function showdate($date){
	
	return date('l, d M, Y', strtotime($date));	
}

?>