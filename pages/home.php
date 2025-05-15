<?php
  
  $search_keyword = isset( $_GET["search"] ) ? $_GET["search"] : "";
  
  $database = connectToDB();

  // 3. get the students data from the database
  // 3.1 - SQL command(recipe)
  $sql = "SELECT * FROM posts WHERE status = 'publish' 
    AND ( title LIKE :keyword OR content LIKE :keyword )
    ORDER BY id DESC";
  // 3.2 - prepare SQL query (prepare your material)
  $query = $database->prepare( $sql );
  // 3.3 - execute the SQL query (cook it)
  $query->execute([
    "keyword" => "%$search_keyword%"
  ]);
  // 3.4 - fetch all the results from the query (eat)
  $posts = $query->fetchAll();
?>
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">My Blog</h1>
      <p><?php echo ( isusersLoggedIn() ? "Welcome back, " . $_SESSION["user"]["name"] : ""); ?></p>
      <form 
        method="GET"
        action="/"
        class="mb-2 d-flex align-items-center gap-2">
        <input 
          type="text" 
          name="search" class="form-control" 
          placeholder="Type a keyword to search..."
          value="<?= $search_keyword; ?>"/>
        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
        <a href="/" class="btn btn-dark">Reset</a>
      </form>
      <?php foreach ($posts as $index => $post) : ?>
        <div class="card mb-2">
          <!-- check if image exists -->
          <?php if ( !empty( $post["image"] ) ) : ?>
            <img src="/<?= $post["image"]; ?>" class="card-img-top" />
          <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title"><?php echo $post['title']; ?></h5>
          <p class="card-text"><?php echo "Here's some content about " . $post['title'] . ".";?></p>
          <div class="text-end">
            <a href="/post?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="mt-4 d-flex justify-content-center gap-3">
      <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <a href="/logout" class="btn btn-link btn-sm">Log out</a>
        <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
      <?php else : ?>
        <a href="/login" class="btn btn-link btn-sm">Login</a>
        <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
      <?php endif; ?>
      </div>
    </div>

    <?php require "parts/footer.php"; ?>
