<?php 
include 'fetch_blogs.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php foreach ($blogs as $blog): ?>
        <h3> <?php echo $blog['title']; ?></h3>
        <h4> <?php echo $blog['text']; ?></h4>
        <a href="blog_details.php?id=<?php echo $blog['id']; ?>">Details</a>

        <!-- Delete trip -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ; ?>" method="POST">
        <input type="hidden" name="blog_id_to_delete" value="<?php echo $blog['id']; ?>">
        <input type="submit" name="delete" value="Delete Blog">

        </form>
    <?php endforeach;?>
</body>
</html>