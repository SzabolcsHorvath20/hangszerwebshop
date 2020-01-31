<?php 
  $conn = mysqli_connect('localhost', 'root', '', 'hangszerwebshop');
  if (!$conn) {
    die('Connection failed ' . mysqli_error($conn));
  }
  if (isset($_POST['save'])) {
    $kategoria = $_POST['kategoria'];
    $marka = $_POST['marka'];
    $ar = $_POST['ar'];
    $keszleten = $_POST['keszleten'];
    $sql = "INSERT INTO hangszer (kategoria, marka, ar, keszleten) VALUES ('{$kategoria}', '{$marka}', '{$ar}', '{$keszleten}')";
    if (mysqli_query($conn, $sql)) {
      $id = mysqli_insert_id($conn);
      $saved_comment = '<div class="comment_box">
            <span class="delete" data-id="' . $id . '" >delete</span>
            <span class="edit" data-id="' . $id . '">edit</span>
            <div class="display_name">'. $kategoria .'</div>
            <div class="comment_text">'. $marka .'</div>
            <div class="comment_text">'. $ar .'</div>
            <div class="comment_text">'. $keszleten .'</div>
        </div>';
      echo $saved_comment;
    }else {
      echo "Error: ". mysqli_error($conn);
    }
    exit();
  }
  // delete comment from database
  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM hangszer WHERE id=" . $id;
    mysqli_query($conn, $sql);
    exit();
  }
  if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $kategoria = $_POST['kategoria'];
    $marka = $_POST['marka'];
    $ar = $_POST['ar'];
    $keszleten = $_POST['keszleten'];
    $sql = "UPDATE hangszer SET kategoria='{$kategoria}', marka='{$marka}', ar='{$ar}', keszleten='{$keszleten}' WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
        $id = mysqli_insert_id($conn);
        $saved_comment = '<div class="comment_box">
          <span class="delete" data-id="' . $id . '" >delete</span>
          <span class="edit" data-id="' . $id . '">edit</span>
          <div class="display_name">'. $kategoria .'</div>
          <div class="comment_text">'. $marka .'</div>
          <div class="comment_text">'. $ar .'</div>
          <div class="comment_text">'. $keszleten .'</div>
      </div>';
      echo $saved_comment;
    }else {
      echo "Error: ". mysqli_error($conn);
    }
    exit();
  }

  // Retrieve comments from database
  $sql = "SELECT * FROM hangszer";
  $result = mysqli_query($conn, $sql);
  $comments = '<div id="display_area">'; 
  while ($row = mysqli_fetch_array($result)) {
    $comments .= '<div class="comment_box">
          <span class="delete" data-id="' . $row['id'] . '" >delete</span>
          <span class="edit" data-id="' . $row['id'] . '">edit</span>
          <div class="display_name">'. $row['kategoria'] .'</div>
          <div class="comment_text">'. $row['marka'] .'</div>
          <div class="comment_text">'. $row['ar'] .'</div>
          <div class="comment_text">'. $row['keszleten'] .'</div>
      </div>';
  }
  $comments .= '</div>';