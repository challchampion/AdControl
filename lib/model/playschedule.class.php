<?php
    class PlaySchedule {
        var $id, $playscheduleid, $name, $userid, $scheduledate, $starttime, $endtime, $scheduletypeid;
    }

    class PlayScheduleItem {
        var $id, $scheduleitemid, $playlistid, $starttime, $endtime, $playtimes,
	$playscheduleid;
    
    }

    class ScheduleType {
        var $id, $scheduletypeid, $name;
    }

?>
