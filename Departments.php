<%@ Page Language="C#" Inherits="QAnalytics.Departments" %>
<!DOCTYPE html>
<html>
<head runat="server">
	<title>Departments</title>
	<link rel = "stylesheet" type = "text/css" href = "/styles/all.css"/>
	<script type = "text/javascript" src = "/scripts/libraries/Chart.js"></script>
	<script type = "text/javascript" src = "/scripts/departments.js"></script>
</head>
<body onload = "createChart();">
	<a href = "Default.aspx" id = "pageTitle">Q-Analytics</a>
	<div id = "header" align = "center">
			<a href = "Default.aspx">Courses</a>
			<a href = "General.aspx">General</a>
			<a href = "Departments.aspx">Department</a>
	</div>
	<form id="mainForm" runat="server">
            <div id = "nav" align = "center">
                <asp:DropDownList id = "listDepts" runat="server" AutoPostBack = "true"/>
            </div>

            <asp:HiddenField id = "valDept" runat="server"/>
	</form>
    <div id = "charts" align = "center">
		<canvas id = "chartEnroll" width = "800" height = "400"></canvas>
		<canvas id = "chartRatings" width = "800" height = "400"></canvas>
	</div>
</body>
</html>
