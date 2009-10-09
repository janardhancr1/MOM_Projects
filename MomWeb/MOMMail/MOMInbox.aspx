<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMInbox.aspx.cs" Inherits="MOMMail_MOMInbox" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="95%" cellpadding="3">
                    <tr>
                        <td style="background-color: MistyRose;">
                            <a href="MOMInbox.aspx">Inbox</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMSent.aspx">Sent Messages</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMMailNotification.aspx">Notifications</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMCompose.aspx">Compose Message</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
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
