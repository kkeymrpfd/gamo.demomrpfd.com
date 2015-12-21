<?php
// Generate Scoreboard Pages
// @depend core/class.Core.php
class Control_Scoreboard_Page {

    public function generateTestUsers($total = 3) {
        $users = array();
        $names = array('Mark', 'Tim', 'Tom', 'Dean', 'Jaime', 'Russ', 'Amelia', 'Steph', 'Ray', 'Kent', 'Ken', 'Anthony');
        $aToZ = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        while ($total > 0) {
            $users[] = array(
                'display_name' => $names[rand(0,count($names)-1)] . ' ' . $aToZ[rand(0,count($aToZ)-1)] . '.',
                'points' => rand(0,500),
                'profile_picture' => '/img/profile-picture.png',
            );
            $total--;
        }
        return $users;
    }

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;
        
        $rank = (isset($_GET['rank'])) ? $_GET['rank'] : null;
        $page = (isset($_GET['page'])) ? $_GET['page'] : null;
        
        $total = 0;
        switch ($rank) {
            case 'creator' :
                $total = 4;
                break;
            case 'tank' :
                $total = 10;
                break;
            case 'recognizer' :
                $total = 20;
                break;
        }
        
        $data['leaders'] = $this->generateTestUsers($total);
        
        $ranks = array(
            'creator' => 1,
            'tank' => 2,
            'recognizer' => 3
        );

        $points = array(
            'creator' => 5000,
            'tank' => 2500,
            'recognizer' => 1000
        );

        $point_limit = 0;

        if($rank == 'creator') {

            $badge_rank = 3;

        } else if($rank == 'tank') {

            $badge_rank = 2;

        } else if($rank == 'recognizer') {

            $badge_rank = 1;

        }

        $rank = Core::get_input('rank', 'get');

        $use_rank = $ranks[$rank];

        $sql = "SELECT user_id, display_name, points FROM " . GAMO_DB . ".users
        WHERE
        (
            SELECT
            count(*)
            FROM " . GAMO_DB . ".users_info AS a
            WHERE a.user_id = " . GAMO_DB . ".users.user_id
            AND a.rank = :rank
        ) = 1
        AND (
            SELECT
            count(*)
            FROM " . GAMO_DB . ".users_info AS a
            WHERE a.user_id = " . GAMO_DB . ".users.user_id
            AND a.rank > :max_rank
        ) = 0
        ORDER BY points DESC LIMIT 0, " . $total;
        
        $sth = $dbh->prepare($sql);

        $data['leaders'] = array();
        
        $sth->execute(array(
                ':rank' => $badge_rank,
                ':max_rank' => $badge_rank
            )
        );

        while($row = $sth->fetch()) {

            $row = Core::remove_numeric_keys($row);
            
            array_push($data['leaders'], $row);

            if(!file_exists(DIR . '/img/user_images/' . $row['user_id'] . '.png')) {

                copy(DIR . '/pub/img/profile-picture.png', DIR . '/pub/img/user_images/' . $row['user_id'] . '.png');

            }

        }
        
        return $data;
	}

}
