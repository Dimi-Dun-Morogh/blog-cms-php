<table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Author</th>
                              <th>Content</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>In Response to</th>
                              <th>Date</th>
                              <th>Approve</th>
                              <th>Unapprove</th>
                              <th>Edit</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
<?php

$query = "SELECT * from comments";
$select_comments = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_comments)) {
    $comment_id = $row['comment_id'];
    $comment_author = $row['comment_author'];
    $comment_post_id = $row['comment_post_id'];
    $comment_email = $row['comment_email'];
    $comment_date = $row['comment_date'];
    $comment_status = $row['comment_status'];
    $comment_content = $row['comment_content'];

    echo "<tr>";

    echo "<td>$comment_id</td>
  <td>$comment_author</td>
  <td>$comment_content</td>";

    // $query = "SELECT * from categories WHERE cat_id = $post_category_id  ";
    // $select_categories_id = mysqli_query($connection, $query);

    // while ($row = mysqli_fetch_assoc($select_categories_id)) {
    //     $cat_title = $row['cat_title'];
    //     $cat_id = $row['cat_id'];

    //     echo "<td>$cat_title</td>";

    // }

    echo "<td>$comment_email</td>
  <td>$comment_status</td>";

    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
    $select_post_id_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_post_id_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "<td> <a href='../post.php?p_id=$post_id'>$post_title</a> </td>";
    }

    echo "<td>$comment_date</td>
  <td><a href='comments.php?approve=$comment_id'>Approve</a></td>
  <td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>
  <td><a href='comments.php?edit=$comment_id'>Edit</a></td>
  <td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

    echo "</tr>";
}

?>

                          </tbody>
                        </table>



  <?php

if (isset($_GET['approve'])) {

  $the_comment_id = $_GET['approve'];

  try {
      $query = "UPDATE comments SET  comment_status = 'approved'   WHERE comment_id = $the_comment_id ";
      $approve_query = mysqli_query($connection, $query);
      header("Location: comments.php");
  } catch (Exception) {
      comfirm($approve_query );
  };

}








if (isset($_GET['unapprove'])) {

    $the_comment_id = $_GET['unapprove'];

    try {
        $query = "UPDATE comments SET  comment_status = 'unapprove'   WHERE comment_id = $the_comment_id ";
        $unapprove_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    } catch (Exception) {
        comfirm($delete_query);
    };

}

if (isset($_GET['delete'])) {

    $the_comment_id = $_GET['delete'];

    try {
        $query = "DELETE FROM comments WHERE comment_id = $the_comment_id ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    } catch (Exception) {
        comfirm($delete_query);
    };

}

?>