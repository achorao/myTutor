<!-- post form to edit the user passed from controller-->
<h1>Edit User</h1>
<form method="post" action="/user/edit">
<input type="hidden" name="id" value="<?= esc($target_user->id) ?>">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" class="form-control" id="username" value="<?= esc($target_user->username) ?>">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" id="email" value="<?= esc($target_user->email) ?>">
    </div>
    <div class="form-group">
        <label for="role">Role:</label>
        <!--default = student-->
        <select name="role" class="form-control" id="role" >
                <option value="student">Student</option>
                <option value="tutor">Professor</option>
                <option value="admin">Administrator</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>


