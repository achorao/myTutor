<div class="container-fluid">
    <div class="row">

        <!-- Main Content -->
        <div class="col-md-9">
            <h1>Welcome to your Profile Page, <?php echo $username;?></h1>
            <h2>Classes reserved:</h2>
            <!-- show classes -->
            <?php
				if ($classes==[]): ?>
            <p>No classes reserved.</p>
            <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">subject</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>

                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classes as $class): ?>
                    <tr>
                        <td><?php echo $class->subject_id ; ?></td>
                        <td><?php echo $class->start_time; ?></td>
                        <td><?php echo $class->end_time; ?></td>
                        <td>
                            <form action="/user/deleteclass" method="post">
                                <input type="hidden" name="class_id" value="<?php echo $class->id; ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>


        <!-- Sidebar -->
        <div class="col-md-3 bg-light">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Information</h4>
                    <hr>

                    <p><?php echo $username;?></p>
                    <p><?php echo $phone ;?></p>
                    <a href="/user/edituser/<?php echo $id; ?>" class="btn btn-primary">Edit Profile</a>
                    <a href="/user/logout" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>