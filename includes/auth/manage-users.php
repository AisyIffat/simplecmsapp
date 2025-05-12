<?php
  // check if the users is not an admin
  if ( !isAdmin() ) {
    header("Location: /dashboard");
    exit;
  }

  // 1. connect to database
  $database = connectToDB();
  // 2. get all the users
    // 2.1
  $sql = "SELECT * FROM users";
  // 2.2
  $query = $database->query( $sql );
  // 2.3
  $query->execute();
  // 2.4
  $users = $query->fetchAll();
?>
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage users</h1>
        <div class="text-end">
          <a href="/auth/manage-users-add" class="btn btn-primary btn-sm"
            >Add New users</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($users as $index => $users) : ?>
            <tr>
              <th scope="row"><?php echo $users['id']; ?></th>
              <td><?php echo $users['name']; ?></td>
              <td><?php echo $users['email']; ?></td>
              <td>
                <?php if ( $users['role'] === 'admin' ) : ?>
                  <span class="badge bg-primary"><?php echo $users['role']; ?></span>
                <?php endif; ?> 
                <?php if ( $users['role'] === 'editor' ) : ?>
                  <span class="badge bg-info"><?php echo $users['role']; ?></span>
                <?php endif; ?>
                <?php if ( $users['role'] === 'users' ) : ?>
                  <span class="badge bg-success"><?php echo $users['role']; ?></span>
                <?php endif; ?>
              </td>
              <td class="text-end">
                <div class="buttons d-flex">
                  <a
                    href="/auth/manage-users-edit?id=<?php echo $users['id']; ?>"
                    class="btn btn-success btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  <a
                    href="/auth/manage-users-changepwd?id=<?php echo $users['id']; ?>"
                    class="btn btn-warning btn-sm me-2"
                    ><i class="bi bi-key"></i
                  ></a>
                  <!-- Button to trigger delete confirmation modal -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#usersDeleteModal-<?php echo $users['id']; ?>">
                     <i class="bi bi-trash"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="usersDeleteModal-<?php echo $users['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this users?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          <p>You're currently trying to delete this users: <?php echo $users['email']; ?></p>
                          <p>This action cannot be reversed.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form
                            method="POST"
                            action="/users/delete"
                            >
                            <input type="hidden" 
                              name="users_id"
                              value="<?= $users["id"]; ?>" />
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
