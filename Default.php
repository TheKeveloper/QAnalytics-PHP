<%@ Page Language="C#" Inherits="QAnalytics.Default" %>
<!DOCTYPE html>
<html>
<head runat="server">
    <title>Home</title>
    <script src = "/scripts/default.js"></script>
    <link rel = "stylesheet" type = "text/css" href = "/styles/all.css"/>
    <link rel = "stylesheet" type = "text/css" href = "/styles/default.css"/>
</head>
<body>
    <a href = "Default.aspx" id = "pageTitle">Q-Analytics</a>

    <div id = "header" align = "center">
        <a href = "Default.aspx">Courses</a>
        <a href = "General.aspx">General</a>
        <a href = "Departments.aspx">Department</a>
    </div>
	<form id="mainForm" runat="server">
        <asp:HiddenField id = "valSearch" runat="server"></asp:HiddenField>
        <div align = "center" id = "search">
            <asp:TextBox id = "txtSearch" runat="server"></asp:TextBox>
            <asp:Button id = "btnSearch" runat="server" Text = "Search"></asp:Button>
            <br/>
        </div>

        <div id = "nav" align = "center" >
            <asp:HyperLink id = "linkPrev" runat="server">Prev</asp:HyperLink>
            <select id = "listPages" onchange = "listPages_SelectionChanged();">
                <?php
                    
                ?>
            </select>
            <asp:HyperLink id = "linkNext" runat="server">Next</asp:HyperLink>
        </div>

            <br/>
            <table id = "tblCourses">
                <?php

                ?>
            </table>

    </form>

    <div id = "footer" align = "center">
        Created by <a href = "mailto:kevinbi@college.harvard.edu">Kevin Bi</a>.
    </div>
</body>
</html>
