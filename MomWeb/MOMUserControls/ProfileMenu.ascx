<%@ Control Language="C#" AutoEventWireup="true" CodeFile="ProfileMenu.ascx.cs" Inherits="UserControls_ProfileMenu" %>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
    <script type="text/javascript">
    
        var uploadWindow;
        
        function showUploadPopUp()
        {
            uploadWindow = window.open("../MOMFileUpload/MOMFileUpload.aspx", "_blank", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=200");            
            listenWindows(uploadWindow);
        }
        
        function listenWindows()
        {
            if(!uploadWindow || !uploadWindow.closed)
            {
                setTimeout("listenWindows()", 4000);
            } 
            else
            {
                var img = $get('<% =this.momUserImage.ClientID  %>');
                img.src = img.src + '#';             
            }
        }
    </script>
    <tr>
        <td align="center">
            <img ID="momUserImage" runat="server" src="../images/q_silhouette.gif" width="100" height="100" />
        </td>
    </tr>
    <tr style="height: 20px;">
        <td align="center">
            <a href="javascript:showUploadPopUp();">Upload a Picture</a>
        </td>
    </tr>
    <tr style="height: 20px;">
        <td align="center">
            Edit My Profile
        </td>
    </tr>
</table>