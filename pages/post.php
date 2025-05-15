<?php
  // 1. connect to database
  $database = connectToDB();
  // 2. get all the users
  $id = $_GET["id"];
  // 2.1
  $sql = "SELECT 
          posts.*, users.name 
          FROM posts 
          JOIN users
          ON posts.user_id = users.id
          WHERE posts.id = :id";
  // 2.2
  $query = $database->prepare( $sql );
  // 2.3
  $query->execute([
    "id" => $id
  ]);
  // 2.4
  $post = $query->fetch();
?>

<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?php echo $post['title'] ?></h1>
      <h4 class="text-center">By <?= $post["name"]; ?></h4>
      <div class="mb-2">
        <img src="<?= $post["image"]; ?>" class="img-fluid" />
      </div>
      <?php 
        /*
          $content = "1,2,3,4,5";
          $content_array = explode( ",", $content );
          $content_array = [ 1, 2, 3, 4, 5 ];
        */
        // $content = $post["content"];
        // $content_array = explode( "\n", $content );
        // foreach ( $content_array as $paragraph ) {
        //   echo "<p>$paragraph</p>";
        // }

        echo nl2br( $post["content"] );
      ?>
      <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"; ?>
