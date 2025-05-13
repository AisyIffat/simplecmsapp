<?php
  $database = connectToDB();

  // 3. get the students data from the database
  // 3.1 - SQL command(recipe)
  $sql = "SELECT * FROM posts";
  // 3.2 - prepare SQL query (prepare your material)
  $query = $database->prepare( $sql );
  // 3.3 - execute the SQL query (cook it)
  $query->execute();
  // 3.4 - fetch all the results from the query (eat)
  $posts = $query->fetchAll();
?>
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">My Blog</h1>
      <p><?php echo ( isusersLoggedIn() ? "Welcome back, " . $_SESSION["users"]["name"] : ""); ?></p>
      <?php foreach ($posts as $index => $post) : ?>
      <?php if ($post['status'] === 'publish') : ?>
        <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?php echo $post['title']; ?></h5>
          <p class="card-text"><?php echo "Here's some content about " . $post['title'] . ".";?></p>
          <div class="text-end">
            <a href="/post?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>

      <div class="mt-4 d-flex justify-content-center gap-3">
      <?php if ( isset( $_SESSION["users"] ) ) : ?>
        <a href="/logout" class="btn btn-link btn-sm">Log out</a>
        <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
      <?php else : ?>
        <a href="/login" class="btn btn-link btn-sm">Login</a>
        <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
      <?php endif; ?>
      </div>
    </div>

    <?php require "parts/footer.php"; ?>
