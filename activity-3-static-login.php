<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Form</title>
</head>
<body>
    <div class="container mt-5">
        <?php
            $showAlert = false;
            $successAlert = false;

            $validCredentials = [
                'admin' => [
                    'admin' => 'Pass1234',
                    'renmark' => 'Pogi1234'
                ],
                'content-manager' => [
                    'pepito' => 'manaloto',
                    'patrick' => 'manalo'
                ],
                'system-user' => [
                    'pedro' => 'penduko'
                ]
            ];

            function validateUser($role, $username, $password, $credentials) {
                return isset($credentials[$role][$username]) && $credentials[$role][$username] === $password;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $role = $_POST['userRole'];

                if (validateUser($role, $username, $password, $validCredentials)) {
                    $successAlert = true;
                } else {
                    $showAlert = true;
                }
            }
        ?>

        <?php if ($showAlert): ?>
            <div class="alert alert-danger alert-dismissible fade show mx-auto" style="max-width: 400px;" role="alert">
                Invalid username or password.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if ($successAlert): ?>
            <div class="alert alert-success alert-dismissible fade show mx-auto" style="max-width: 400px;" role="alert">
                Welcome to the System: <?= htmlspecialchars($username); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card card-container mt-4 mx-auto" style="max-width: 400px;">
            <img class="profile-img-card" src="images/avatar_2x.png" alt="Profile Image">
            <form class="form-signin" method="POST">
                <div class="form-group mb-3">
                    <label for="userRole" class="form-label">User Role</label>
                    <select name="userRole" id="userRole" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="content-manager">Content Manager</option>
                        <option value="system-user">System User</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="User Name" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Sign in</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
