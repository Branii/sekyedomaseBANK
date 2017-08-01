<?php require_once('../auth.php');

include('../db.php');
$pollid=$_GET['pollId'];
$pollOption=$_GET['pollOption'];

$result = mysqli_query($link, "SELECT * FROM motionbasedpoll WHERE idmotionBasedPoll = '$pollOption'");
while ($row = mysqli_fetch_assoc($result)) {
    $currVote = $row['motionBasedPollVoteCount'];
    if($currVote == NULL){
        $addVote = 1;
    }else{
        $addVote = $currVote + 1;
    }

    $query = mysqli_query($link, "UPDATE motionbasedpoll SET motionBasedPollVoteCount = '$addVote' WHERE idmotionBasedPoll = '$pollOption' ");


    header('location: votingComplete.php');

//   if(mysqli_query($link,$query)){
//       echo "Success";
//   }else{
//       echo "Error:" . $query . ".<br>" . mysqli_error($link);
//   }

}

?>
