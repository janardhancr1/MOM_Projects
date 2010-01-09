<%@ Page Language="C#" AutoEventWireup="true" CodeFile="MOMVideoUploader.aspx.cs" Inherits="MOMVideos_MOMVideoUploader" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
    <link href="../css/MomStyle.css" rel="stylesheet" type="text/css" />
    <link href="../css/Profile.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <asp:FileUpload ID="momVideoFileUpload" runat="server" />
        <asp:Button ID="momVideoUpload" runat="server" Text="Upload Video" CssClass="btnStyle" style="width: 150px;" OnClick="momVideoUpload_Click"/> 
        <asp:Label ID="momUploadStatus" runat="server"></asp:Label>
    </div>
    </form>
</body>
</html>
