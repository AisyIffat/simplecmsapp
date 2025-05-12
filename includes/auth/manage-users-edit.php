<?php
  // check if the users is not an admin
  if ( !isAdmin() ) {
    header("Location: /dashboard");
    exit;
  }


  // connect to database
  $database = connectToDB();

  // get the id from the URL
  $id = $_GET["id"];

  // load the users data by id
  // SQL
  $sql = "SELECT * FROM users WHERE id = :id";
  // prepare
  $query = $database->prepare( $sql );
  // execute
  $query->execute([
    "id" => $id
  ]);
  // fetch
  $users = $query->fetch();

?>
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit users</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/users/update">
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $users["name"]; ?>" />
              </div>
              <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $users["email"]; ?>" disabled />
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role">
              <option value="">Select an option</option>
              <option value="users" <?php echo ( $users["role"] === "users" ? "selected" : "" ); ?>>users</option>
              <option value="editor" <?php echo ( $users["role"] === "editor" ? "selected" : "" ); ?>>Editor</option>
              <option value="admin" <?php echo ( $users["role"] === "admin" ? "selected" : "" ); ?>>Admin</option>
            </select>
          </div>
          <div class="d-grid">
            <input type="hidden" name="id" value="<?php echo $users["id"]; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/auth/manage-users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to users</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"; ?>
