<div class="container-fluid">
    <div class="row">

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- show classes-->
            <div>
                <h2>Classes</h2>
                <?php if ($classes==[]): ?>
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
                            <td><a href="/user/delete_class/<?php echo $class->id; ?>"
                                    class="btn btn-primary">Delete</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
                <!-- add class-->
                <div>
                    <h2>Add Class</h2>
                    <form action="/user/add_class" method="post">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select class="form-control" id="subject" name="subject">
                                <?php foreach ($subjects as $subject): ?>
                                <option value="<?php echo $subject->name; ?>"><?php echo $subject->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time">
                        </div>
                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Class</button>
                    </form>
                </div>

                </div>

            </div>
            <!-- Sidebar -->
            <div class="col-md-3 bg-light">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Information</h4>
                        <hr>

                        <p><?php echo $username;?></p>
                        <p><?php echo $phone ;?></p>
                        <a href="/user/edit" class="btn btn-primary">Edit Info</a>
                        <a href="/user/logout" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>


        
    </div>