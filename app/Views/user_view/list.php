<h1>Welcome to User list</h1>
<?php foreach ($users as $user) : ?>
    <h1>Welcome to User list</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
        <tr>
            <td><?= esc($user->id) ?></td>
            <td><?= esc($user->username) ?></td>
            <td><?= esc($user->email) ?></td>
            <td><?= esc($user->role) ?></td>
            <td>
                <button type="button" class="btn btn-primary" onclick="window.location.href='/user/edituser/<?= esc($user->id) ?>'">Edit</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= esc($user->id) ?>)">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endforeach; ?>

<script>
function confirmDelete(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch('/user/delete/' + userId, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    alert('user deleted successfully');
                }

            }).then(alert('user deleted') ).then (window.location.reload());
    }
}


</script>