<div class="container">
    <h2>Grades</h2>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="col-md-6">Assignments Name</th>
            <th class="col-md-3">Points</th>
            <th class="col-md-3">Maximum Points</th>
        </tr>
        </thead>
        <tbody id="gradesTable">

<?php
		$totalEarned = 0;
		$totalAvailable = 0;
		foreach ($grades_list as $grades_item) {	
			$totalEarned += $grades_item['scored_points'];
			$totalAvailable += $grades_item['max_points'];
			echo '<tr>';
			echo '<td>'.$grades_item['assignment_name'].'</td>';
			echo '<td>'.$grades_item['scored_points'].'</td>';	
			echo '<td>'.$grades_item['max_points'].'</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
		if($totalAvailable > 0){
			$percent = round($totalEarned / $totalAvailable * 100, 2);
			
			echo '<p>Total: ' . $totalEarned . '/' . $totalAvailable . ' (' . $percent . '%)</p>';
		}else{
			echo '<p>No grades.</p>';
		}
?>
		<a href="../gradebook"><input  type="button" value="Done" class="btn btn-success"></a>
</div>
