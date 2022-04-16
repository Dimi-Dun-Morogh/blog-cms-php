<form action="" method="post">
                              <div class="form-group">
                                <label for="cat_title">
                                  Edit Category
                                </label>
<?php
if (isset($_GET['edit'])) {

    $cat_id = $_GET['edit'];

    $query = "SELECT * from categories WHERE cat_id = $cat_id ";
    $select_categories_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        ?>

                    <input type="text"
                    class="form-control"
                    name="cat_title"
                    value="<?php if (isset($cat_title)) {echo $cat_title;}?>"
                    >


                    <?php }}?>

<?php
//update category
if (isset($_POST['update-category'])) {
    $the_cat_title = $_POST['cat_title'];
    $query = "UPDATE categories SET cat_title = '{$the_cat_title}'  WHERE cat_id = {$cat_id}";

    try {
        $update_query = mysqli_query($connection, $query);

        header("Location: categories.php");
    } catch (Exception $e) {
        die("query failed" . mysqli_error($connection));
    }

}
?>

                              </div>
                              <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update-category" value="Update Category">

                              </div>
                            </form>

