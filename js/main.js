var Main = {
	//Bring in dependencies.
	assignmentTable : document.getElementById('assignmentTable'),
	gradeSubBtn : document.getElementById('gradeSubmit'),

	init : function(){
		//Set event listeners.
		if(Main.assignmentTable){Main.assignmentTable.addEventListener("click", Main.assignmentTableClick, false)};
		if(Main.gradeSubBtn)	{Main.gradeSubBtn.addEventListener("click", Main.gradeSubmit, false)};
		document.body.addEventListener("click", Main.closeBox, false);
	},

	//Creates a message box based on passed in information. Colors are 'blue', 'green', and 'red'. Pass in true if the box needs an 'Okay' button.
	messageBox : function(content, heading, color, button){
		var panelType;
		switch (color){
			case 'blue': panelType = 'message'; break;
			case 'green': panelType = 'success'; break;
			case 'red': panelType = 'error'; break;
			default: panelType = 'message'; break;
		};
		var box = '<div class="panel panel-primary floater ' + panelType + '"><div class="panel-heading">' + heading + '</div><div class="panel-body"><p>' + content + '</p>';
		if(button){box += '<button type="button" id="closedesc" class="btn btn-primary">Okay</button></div>'};
		if(Main.assignmentTable.getElementsByClassName('panel')[0]){Main.assignmentTable.removeChild(document.getElementsByClassName('panel')[0]);};
		Main.assignmentTable.innerHTML += box;
	},

	//Closes popup boxes.
	closeBox : function(evt){
		//Determines that the proper button is being pressed
		var currentNode = evt.target;
		if(/closedesc/.test(currentNode.id)){
			//Closes description
			Main.assignmentTable.removeChild(document.getElementsByClassName('panel')[0]);
		}
	},

	//If the assignment table is clicked anywhere, determine if one of the buttons is the element that was clicked and take appropriate action.
	assignmentTableClick : function(evt){
		//Get the clicked element.
		var currentNode = evt.target;

		//If it's a button, getting the ids will work.
		var assignmentID = currentNode.parentNode.parentNode.getElementsByClassName('hiddenInfo')[0].innerHTML;
		var courseID = currentNode.parentNode.parentNode.getElementsByClassName('hiddenInfo')[1].innerHTML;

		//If notes, get the notes info stored in the table.
		if(/notes/.test(currentNode.className)){
			var notes = currentNode.parentNode.getElementsByClassName('hiddenInfo')[0].innerHTML;
			Main.messageBox(notes, "Notes", "blue", true);
		};
	},

	//On grades_teacher, if the grade button is clicked, put together a JSON object containing the new grades and send it through the URL.
	gradeSubmit : function(){
		//Get the assignment and course IDs.
		var assignmentID = document.getElementById('assignmentID').innerHTML;
		var courseID = document.getElementById('courseID').innerHTML;

		//Collect information from the table.
		var grades = document.getElementsByClassName('points');
		var userIDs = document.getElementsByClassName('userID');
		var update = document.getElementsByClassName('update');//This determines whether or not this grade needs to be inserted or updated.

		//Create an object with the assignment id. Fill the array with the students' user ids, scored points, and the update statuses of their assignments.
		var gradeObj = {array: [], assignment_id: assignmentID};
		var len = grades.length;
		for(var i = 0; i < len; i++){
			var grade = {user_id: userIDs[i].innerHTML, scored_points: grades[i].value, update: update[i].value};
			gradeObj.array.push(grade);
		};

		//Direct the browser to assignments_view. Pass the object as URI encoded, stringified JSON.
		window.location.href = "../teacher?course=" + courseID + "&saved-grades=" + encodeURIComponent(JSON.stringify(gradeObj));

	}
};

Main.init();
