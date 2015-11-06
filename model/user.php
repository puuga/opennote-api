<?php
function getUser($conn, $user_id) {
  // get info
  $sql = "SELECT *
          FROM users
          WHERE id = $user_id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $user->id = $user_id;
      $user->firstname = $row["firstname"];
      $user->lastname = $row["lastname"];
      $user->name = $row["name"];
      $user->email = $row["email"];
      $user->facebook_id = $row["facebook_id"];
    }
  }

  // get my messages
  $sql2 = "SELECT * FROM messages WHERE user_id=$user_id ORDER BY id DESC";
  $result2 = $conn->query($sql2);
  if ($result2->num_rows > 0) {
    $messages = array();
    while($row = $result2->fetch_assoc()) {
      $message = new stdClass();
      $message->id = $row["id"];
      $message->message = $row["message"];
      $message->lat = $row["lat"];
      $message->lng = $row["lng"];
      $message->created_at = $row["created_at"];

      $messages[] = $message;
    }
    $user->messages = $messages;
  }

  $conn->close();

  return $user;
}
?>
