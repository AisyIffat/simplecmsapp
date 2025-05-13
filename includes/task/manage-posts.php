<?php
  // check if the users is not an admin
  if ( !isusersLoggedIn() ) {
    header("Location: /");
    exit;
  }
?>

<?php
  // 1. connect to database
  $database = connectToDB();
  // 2. get all the users
    // 2.1
  $sql = "SELECT * FROM posts";
  // 2.2
  $query = $database->query( $sql );
  // 2.3
  $query->execute();
  // 2.4
  $posts = $query->fetchAll();

$loggedInUserId = $_SESSION["users"]["id"];
$loggedInUserRole = $_SESSION["users"]["role"];
?>

<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <?php require ("parts/message_success.php"); ?>
        <div class="text-end">
          <a href="/task/manage-posts-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-start">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($posts as $index => $post) : ?>
          <?php if ( $loggedInUserRole == 'admin' || $loggedInUserRole == 'editor' || $post["user_id"] == $loggedInUserId ): ?>
          <tr>
            <th scope="row"><?php echo $post['id']; ?></th>
            <td><?php echo $post['title']; ?></td>
            <td>
              <?php if ( $post['status'] === 'pending' ) : ?>
                <span class="badge bg-warning">Pending Review</span>
              <?php endif; ?> 
              <?php if ( $post['status'] === 'publish' ) : ?>
                <span class="badge bg-success">Publish</span>
              <?php endif; ?>
            </td>
            <td class="text-end">
              <div class="buttons d-flex flex-end">
                <?php if ($post['status'] === 'publish') : ?>
                <a
                  href="/post?id=<?php echo $post['id']; ?>"
                  target="_blank"
                  class="btn btn-primary btn-sm me-2"
                  ><i class="bi bi-eye"></i
                ></a>
                <?php endif; ?>
                <?php if ($post['status'] === 'pending') : ?>
                <a
                  href="/post?id=<?php echo $post['id']; ?>"
                  target="_blank"
                  class="btn btn-primary btn-sm me-2 disabled"
                  ><i class="bi bi-eye"></i
                ></a>
                <?php endif; ?>
                <a
                  href="/task/manage-posts-edit?id=<?php echo $post['id']; ?>"
                  class="btn btn-secondary btn-sm me-2"
                  ><i class="bi bi-pencil"></i
                ></a>
                <!-- Button to trigger delete confirmation modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#usersDeleteModal-<?php echo $post['id']; ?>">
                    <i class="bi bi-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="usersDeleteModal-<?php echo $post['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this post?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-start">
                        <p>You're currently trying to delete this post: <?php echo $post['title']; ?></p>
                        <p>This action cannot be reversed.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form
                          method="POST"
                          action="/post/delete-post"
                          >
                          <input type="hidden" 
                            name="users_id"
                            value="<?= $post["id"]; ?>" />
                          <button class="btn btn-danger"><i class="bi bi-trash me-2">DELETE</i> </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Modal -->
              </div>
            </td>
          </tr>
          <?php endif; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"; ?>
