<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMMailView.aspx.cs" Inherits="MOMMail_MOMMailView" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="Server">
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
                <br />
                <fieldset>
                    <legend class="grayHeader">Message</legend>
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                From :
                                <asp:Label ID="momMailFrom" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sent :
                                <asp:Label ID="momMailSent" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Subject :
                                <asp:Label ID="momMailSubject" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                Messge:</td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Label ID="momMailBody" runat="server"></asp:Label>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="momRight" runat="Server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>
