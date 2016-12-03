<!--

filter by:

duty_id
duty_name

-->

<style>
    .browse-duties-title {
        display: inline-block;
        text-align: center;
        width: 100%;
    }
</style>

<div class="panel panel-info">
    <div class="panel-heading">

        <div class="browse-duties-title">
            <h2>My Duties</h2>
        </div>
    </div>
</div><!-- panel-heading -->


<div class="panel-body">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Duty Name</th>
            <th>Duty Description</th>
        </tr>
        </thead>
        <tbody>

        <!-- loop through results -->
        <?php foreach ($dutiesInfo as $dutyInfo) : ?>

            <tr>
                <td><?php echo $dutyInfo['duty_name'] ?></td>
                <td><?php echo $dutyInfo['duty_description'] ?></td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>


</div><!-- panel-body -->