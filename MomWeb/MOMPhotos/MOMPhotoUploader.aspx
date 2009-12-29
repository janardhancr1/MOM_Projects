<%@ Page Language="C#" AutoEventWireup="true" CodeFile="MOMPhotoUploader.aspx.cs" Inherits="MOMPhotos_MOMPhotoUploader" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
    <link href="../css/MomStyle.css" rel="stylesheet" type="text/css" />
    <link href="../css/Profile.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="../js/MomJS.js"></script>
    <script language="javascript" src="../js/jquery-1.3.2.js"></script>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <table width="98%">
        <tr>
            <td>
                Select Files
            </td>
        </tr>
        <tr>
            <td>
                <asp:FileUpload ID="momPhotoUpload_1" runat="server" />
            </td>
        </tr>
        <tr>
            <td>
                <asp:FileUpload ID="momPhotoUpload_2" runat="server" />
            </td>
        </tr>
        <tr>
            <td>
                <asp:FileUpload ID="momPhotoUpload_3" runat="server" />
            </td>
        </tr>
        <tr>
            <td>
                <asp:FileUpload ID="momPhotoUpload_4" runat="server" />
            </td>
        </tr>
        <tr>
            <td>
                <asp:FileUpload ID="momPhotoUpload_5" runat="server" />
            </td>
        </tr>
        <tr>   
            <td>
                <asp:Button ID="momPhotoUpload" runat="server" Text="Upload Photos" CssClass="btnStyle" style="width: 150px;" OnClick="momPhotoUpload_Click"/>
            </td>
        </tr>
    </table>
    </div>
    </form>
</body>
</html>
