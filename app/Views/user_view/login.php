<main class="form-signin">
    <!--<?= form_open('user/postlogin') ?>-->

    <form method="post" accept-charset="utf-8" action="/user/login">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <div class="form-floating">
        <input type="email" class="form-control" name="email" value="me@example.com">
        <label for="email">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" name="password" value="123456">
        <label for="password">Password</label>
    </div>
    <span class="error"><?= \Config\Services::validation()->listErrors(); ?></span>
    <span class="error">
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
            <?php endif;?>
        </span>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
    </form>