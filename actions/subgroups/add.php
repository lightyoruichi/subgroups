<?php

elgg_load_library('elgg:subgroups');

$group_guid = get_input('group');
$othergroup_guid = get_input('othergroup');
$othergroup_url = get_input('othergroup_url'); // maybe it isn't used
$group = get_entity($group_guid);
$othergroup = get_entity($othergroup_guid);

if(!$othergroup && $othergroup = subgroups_get_group_from_url($othergroup_url)){
	$othergroup_guid = $othergroup->guid;
}

if ($group instanceof ElggGroup && $group->canEdit() && $othergroup instanceof ElggGroup) {
	if ($othergroup->canEdit() && $group_guid != $othergroup_guid) {
		$othergroup->container_guid = $group_guid;
		$othergroup->save();
		forward(REFERER);
	}
}

register_error(elgg_echo('subgroups:add:error'));
forward(REFERER);

