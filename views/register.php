<div class="form-container">
    <h2>Registration Form</h2>
<?php $form = \app\core\form\Form::begin('', "post")?>
    <?php echo $form->field($model, 'firstname', 'First Name')?>
    <?php echo $form->field($model, 'lastname', 'Last Name')?>
    <?php echo $form->field($model, 'email', 'Email')?>
    <?php echo $form->field($model, 'password', 'Password')->passwordField()?>
    <?php echo $form->field($model, 'confirm_password', 'Confirm Password')->passwordField()?>
    <button type="submit" class="btn-submit">Submit</button>
<?php echo \app\core\form\Form::end()?>
</div>

<div>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>