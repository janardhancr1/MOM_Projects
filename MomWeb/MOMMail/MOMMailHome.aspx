<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMMailHome.aspx.cs" Inherits="MOMMail_MOMMailHome" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <div class="tabs">
        <center>
            <div class="left_tabs">
                <ul class="toggle_tabs" id="toggle_tabs_unused">
                    <li class="first "><a href="MOMInbox.aspx" onclick="return true;">Inbox</a></li>
                    <li><a href="MOMSent.aspx" onclick="return true;">Sent Messages</a></li>
                    <li class="last "><a href="MOMCompose.aspx" onclick="return true;">Compose Message</a></li>
                </ul>
            </div>
        </center>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <br />
                <br />
                <table width="95%">
                    <tr>
                        <td align="left">
                            <asp:Label ID="NewMailsText" runat="server"></asp:Label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>
