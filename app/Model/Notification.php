<?php

function get_all_my_notifications($conn, $user_id) {
    $sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $notifications ? $notifications : []; // Return empty array if no notifications
}



function count_notification($conn, $id){
	$sql = "SELECT id FROM notifications WHERE recipient=? AND is_read=0";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}

function insert_notification($conn, $data){
	$sql = "INSERT INTO notifications (message, recipient, type) VALUES(?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

function notification_make_read($conn, $recipient_id, $notification_id){
	$sql = "UPDATE notifications SET is_read=1 WHERE id=? AND recipient=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$notification_id, $recipient_id]);
}