<?php
  function messages($conn) {
    $sql = "SELECT m.id, m.message, m.lat, m.lng, m.created_at, u.name, u.facebook_id
            FROM messages m INNER JOIN users u ON m.user_id = u.id
            ORDER BY m.id DESC";
    $result = $conn->query($sql);
    $arr = array();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $one = null;
        $one['id'] = $row["id"];
        $one['message'] = $row["message"];
        $one['lat'] = $row["lat"];
        $one['lng'] = $row["lng"];
        $one['created_at'] = $row["created_at"];
        $one['user']['name'] = $row["name"];
        $one['user']['facebook_id'] = $row["facebook_id"];

        $arr[] = $one;
      }
      // $json_result['messages'] = $arr;
    }

    $conn->close();
    return $arr;
  }

  function messagesWithLatLng($conn, $lat, $lng) {
    $sql = "CALL GetMessagesByMyLocation($lat,$lng)";
    $result = $conn->query($sql);
    $arr = array();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $one = null;
        $one['id'] = $row["id"];
        $one['message'] = $row["message"];
        $one['lat'] = $row["lat"];
        $one['lng'] = $row["lng"];
        $one['distance_from_my_location'] = $row["distance_from_my_location"];
        $one['created_at'] = $row["created_at"];
        $one['user']['name'] = $row["name"];
        $one['user']['facebook_id'] = $row["facebook_id"];

        $arr[] = $one;
      }
      // $json_result['messages'] = $arr;
    }

    $conn->close();
    return $arr;
  }

?>
