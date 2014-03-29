google.load('visualization', '1', {packages:['table']});
google.setOnLoadCallback(drawTable);

function initialise(){
	loadGroupOverviewStatistics();
	loadGroupMembers();
}

function openLeaveGroupModel(){
	
	$('#leaveGroupModal').modal('show');
}

function leaveGroup(id){
	
	param = "groupNo=" + id;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
			location.replace("social.php");
	    }
	  }
	xmlhttp.open("POST","files/groups/leaveGroup.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}

function openAddFriendsModal(id){
	param = "groupNo=" + id;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    document.getElementById("addFriendsModalContent").innerHTML= xmlhttp.responseText;
	    $('#addFriendsModal').modal('show');
	    }
	  }
	xmlhttp.open("POST","files/groups/addFriendsModal.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}

function addFriendToGroup(friend){
	
	param = "friend=" + friend;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
			if(xmlhttp.responseText == "true"){
				document.getElementById("add_friend_button_"+friend).style.display = "none";	
				document.getElementById("friend_added_button_"+friend).style.display = "inline";	
			}
	    }
	  }
	xmlhttp.open("POST","files/groups/addFriendToGroup.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}

function loadGroupMembers(){

	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
			document.getElementById("group_friends").innerHTML = xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("POST","files/groups/group_members.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
}


function loadGroupOverviewStatistics(){

	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
			document.getElementById("group_statistics").innerHTML = xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("POST","files/groups/groupOverviewStatistics.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
}

function drawTable() {
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Name');
	data.addColumn('number', 'Salary');
	data.addColumn('boolean', 'Full Time Employee');
	data.addRows([
	  ['Mike',  {v: 10000, f: '$10,000'}, true],
	  ['Jim',   {v:8000,   f: '$8,000'},  false],
	  ['Alice', {v: 12500, f: '$12,500'}, true],
	  ['Bob',   {v: 7000,  f: '$7,000'},  true]
	]);
	
	var table = new google.visualization.Table(document.getElementById('group_leaderboard'));
	table.draw(data, {showRowNumber: true});
}