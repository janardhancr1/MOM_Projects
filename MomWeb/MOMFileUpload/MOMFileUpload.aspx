<%@ Page Language="C#" AutoEventWireup="true" CodeFile="MOMFileUpload.aspx.cs" Inherits="MOMFileUpload_MOMFileUpload" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
    <title>Untitled Page</title>
    <base target=_self>
    <link href="../css/MomStyle.css" rel="stylesheet" type="text/css" />
    <script language="javascript" type="text/javascript">
        function showWait()
        {
            if ($get('momFileUploader').value.length > 0)
            {
                $get('UpdateProgress1').style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <form id="form1" runat="server">
        <asp:ScriptManager ID="ScriptManager1" runat="server">
        </asp:ScriptManager>
    <div>
        <asp:UpdatePanel ID="UpdatePanel1" runat="server">
            <Triggers>
                <asp:PostBackTrigger ControlID="momUploadFileButton" />
            </Triggers>
            <ContentTemplate>
                <table width="100%" cellpadding="5">
                    <tr>
                        <td class="pinkHeader">
                            Upload Your Profile Picture
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small>
                                Select an image file on your computer (4MB max):
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:FileUpload ID="momFileUploader" runat="server" />
                        </td>
                    </tr>
                    <tr>
                        <td><div class="styleLine"></div></td>
                    </tr>
                    <tr>
                        <td>
                            <small>
                                By uploading a file you certify that you have the right to distribute this picture and that it does not violate the Terms of Service.
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Button ID="momUploadFileButton" runat="server" 
                            Text="Upload" CssClass="btnStyle" OnClick="momUploadFileButton_Click" OnClientClick="javascript:showWait();" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:UpdateProgress ID="UpdateProgress1" runat="server" AssociatedUpdatePanelID="UpdatePanel1">
                                <ProgressTemplate>
                                    <small>Please wait ... Uploading file</small>
                                    <asp:Label ID="momUploadStatus" runat="server" Text="Label"></asp:Label>
                                </ProgressTemplate>
                            </asp:UpdateProgress>
                        </td>
                    </tr>
                </table>
            </ContentTemplate>
        </asp:UpdatePanel>
    </div>
    </form>
</body>
</html>
