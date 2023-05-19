
<?php foreach ($subjects as $subject):?>
    <?php if (count($tutor_subjects[$subject->name]) > 0): ?>
<div class="container">
    <h4 class="mb-4"><?php echo esc($subject->name) . " : ";?></h4>
    <div class="container">
        <div class="row d-flex flex-nowrap" style=" overflow-x: scroll; overflow-y: hidden; ">

            <?php foreach ($tutor_subjects[$subject->name] as $user): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card" style="width: 18rem">

                    <img class="card-img-top placeholder-glow"
                        src="https://source.unsplash.com/random/450x450/?profile&<?php echo esc($user->id);?>"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo esc($user->username);?> </h5>
                        <p class="card-text"><?php echo esc($user->email);?></p>
                        <p class="card-text"><?php echo esc($user->phone);?></p>
                        <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?php echo('/user/calender/' . esc($user->id) ."/". esc($subject->name)) ?>" class="btn btn-primary">reserve</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
    <?php endforeach;?>