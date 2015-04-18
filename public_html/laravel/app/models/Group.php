<?php

class Group {
	
	public static function groupIdByName($group_name) {
		
		$group = \Sentry::findGroupByName($group_name);
		return $group->id;
		
	}
	
}