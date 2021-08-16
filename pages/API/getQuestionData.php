<?php
    include('connection.php');
    header('Access-Control-Allow-Origin: *');
    $q_id = $_POST['q_id'];
    $selectFromQuestion = $mysqli -> query("SELECT * FROM questions WHERE question_id = '$q_id'");
    $question__assoc = mysqli_fetch_assoc($selectFromQuestion);
    $question = $question__assoc['question'];
    // $option_name = "";
    $checkOptions = $mysqli -> query("SELECT * FROM options WHERE parent_qid = '$q_id'");
	$post = array();
    while($d = mysqli_fetch_array($checkOptions)) {
		$post['name'] = $d['name'];
	}

	// foreach($post as $row) {
	// 	{
	// 		foreach($row as $element => $e_value) {
	// 				$option_name .= $element[0];
	// 			}
	// 	}
	// }
		
    $returnData = array(
		"question" => $question,
		"description" => $question__assoc['description'],
        "name" => $post
	);
    echo json_encode($returnData);
?>