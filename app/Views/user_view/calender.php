<!-- Include FullCalendar CSS and JS files -->
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
<style>
  .container {
    display: flex;
    width: 100%;
  }

  #calendar-container {
    flex: 1;
  }

  .form-container {
    flex: 1;
  }
</style>

<div class="container">
  <div id='calendar-container'>
    <div id='calendar'></div>
  </div>
  <div class="form-container">
    <form method="post" action="/user/reserveclass">
      <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

      <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>Subject ID</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Select</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($classes as $class): ?>
            <tr>
              <td>
                <?php echo $class->subject_id; ?>
              </td>
              <td>
                <?php echo $class->start_time; ?>
              </td>
              <td>
                <?php echo $class->end_time; ?>
              </td>
              <td>
                <label>
                  <input type="radio" name="class_id" value="<?php echo $class->id ?>">
                </label>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: [
        <?php foreach ($classes as $class): ?>
          {
            title: '<?php echo $class->subject_id; ?>',
            start: '<?php echo $class->start_time; ?>',
            end: '<?php echo $class->end_time; ?>'
          },
        <?php endforeach; ?>
      ]
    });
    calendar.render();
  });
</script>