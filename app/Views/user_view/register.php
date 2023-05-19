<main class="form-signin">
    <!--<?= form_open('user/postlogin') ?>-->
    <div class="alert alert-danger">
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
</div>
    <form method="post" accept-charset="utf-8" action="/user/register">
    <h1 class="h3 mb-3 fw-normal">Please Register</h1>
    <div class="form-floating">
        <input type="username" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" value="<?= old('username') ?>">
        <label for="username">Username</label>
        <?php if(session('errors.username')) : ?>
            <div class="invalid-feedback">
                <?= session('errors.username') ?>
            </div>
        <?php endif ?>
    </div>
    <div class="form-floating">
        <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" value="<?= old('email') ?>">
        <label for="email">Email address</label>
        <?php if(session('errors.email')) : ?>
            <div class="invalid-feedback">
                <?= session('errors.email') ?>
            </div>
        <?php endif ?>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" value="<?= old('password') ?>">
        <label for="password">Password</label>
        <?php if(session('errors.password')) : ?>
            <div class="invalid-feedback">
                <?= session('errors.password') ?>
            </div>
        <?php endif ?>
    </div>
    <div class="control-group">
          <label class="control-label">User Type:</label>
          <div class="controls">
            <select name="role" class="form-control <?php if(session('errors.role')) : ?>is-invalid<?php endif ?>">
                <option value="student" <?php if(old('role') == 'student') : ?>selected<?php endif ?>>Student</option>
                <option value="tutor" <?php if(old('role') == 'tutor') : ?>selected<?php endif ?>>Professor</option>
                <option value="admin" <?php if(old('role') == 'admin') : ?>selected<?php endif ?>>Administrator</option>
            </select>
            <?php if(session('errors.role')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.role') ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    </form>

    <span class="error">
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>
    </span>
</main>