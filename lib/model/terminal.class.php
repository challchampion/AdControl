<?php
    class Terminal {
        var $id, $terminalid, $terminalname, $terminaltype, $ip, $mac, $volume, $terminalstatus, $terminalgroupid, $userid;
    }

    class TerminalInfo {
        var $id, $terminalid, $hardwareinfo, $softwareinfo, $weatheraddress, $remark, $discinfo, $addressinfo, $displayportid, $resolutionid, $aspectratioid;
    }

    class TerminalGroup {
        var $id, $terminalgroupid, $groupname;
    }
?>
