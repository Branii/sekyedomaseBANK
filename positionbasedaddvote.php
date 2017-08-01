<?php require_once('../auth.php');

include('../db.php');
$pollid=$_GET['pollId'];
$shareholderId=$_GET['shareholderId'];

        $result = mysqli_query($link, "SELECT * FROM positionbasedpoll WHERE pollId = '$pollid' AND shareholderId = '$shareholderId' ");
        while ($row = mysqli_fetch_assoc($result)) {
            $currVote = $row['positionBasedPollVoteCount'];
            if($currVote == NULL){
                $addVote = 1;
            }else{
                $addVote = $currVote + 1;
            }

            $query = mysqli_query($link, "UPDATE positionbasedpoll SET positionBasedPollVoteCount = '$addVote' WHERE pollId = '$pollid' AND shareholderId = '$shareholderId' ");


                header('location: votingComplete.php');

        }

?>