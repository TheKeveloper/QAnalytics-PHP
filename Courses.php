<%@ Page Language="C#" Inherits="QAnalytics.Courses" %>
<!DOCTYPE html>
<html>
<head runat="server">
	<title>Courses</title>
	<script src = "/scripts/libraries/Chart.js"></script>
	<script src = "/scripts/courses.js"></script>
	<script src = "/scripts/default.js"></script>
	<link rel = "stylesheet" type = "text/css" href = "/styles/all.css"/>
	<link rel = "stylesheet" type = "text/css" href = "/styles/course.css"/>
</head>
<body onload = "createChart()">
	<a href = "Default.aspx" id = "pageTitle">Q-Analytics</a>
	<div id = "header" align = "center">
			<a href = "Default.aspx">Courses</a>
			<a href = "General.aspx">General</a>
			<a href = "Departments.aspx">Department</a>
	</div>
	<!--
	<form id="mainForm" align = "center" runat="server">
			<asp:Label id = "lblTitle" Text = "Course" align = "center" runat="server"></asp:Label>
            <asp:HiddenField id = "valCourse" runat="server"></asp:HiddenField>
	</form> -->
	<div id = "charts" align = "center">
		<canvas id = "chartEnroll" class = "chart" width = "800" height = "400"></canvas>
		<canvas id = "chartRatings" class = "chart" width = "800" height = "400"></canvas>
	</div>

</body>
</html>
