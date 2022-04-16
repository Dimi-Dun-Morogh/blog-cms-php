<table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Author</th>
                              <th>title</th>
                              <th>Category</th>
                              <th>Status</th>
                              <th>Image</th>
                              <th>Tags</th>
                              <th>Comments</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
<?php

$query = "SELECT * from posts";
$select_posts = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_title = $row['post_title'];
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_status = $row['post_status'];

    echo "<tr>";

    echo "<td>$post_id</td>
  <td>$post_author</td>
  <td>$post_title</td>";

    $query = "SELECT * from categories WHERE cat_id = $post_category_id  ";
    $select_categories_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        echo "<td>$cat_title</td>";

    }

   echo "<td>$post_status</td>
  <td><img width='100' src='../images/$post_image'/></td>
  <td>$post_tags</td>
  <td>$post_comment_count</td>
  <td>$post_date</td>
  <td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>
  <td><a href='posts.php?delete=$post_id'>Delete</a></td>";

    echo "</tr>";
}

?>

                          </tbody>
                        </table>



  <?php

if (isset($_GET['delete'])) {

    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = $the_post_id";
    try {
        $delete_query = mysqli_query($connection, $query);
    } catch (Exception) {
        comfirm($delete_query);
    };

}

?>