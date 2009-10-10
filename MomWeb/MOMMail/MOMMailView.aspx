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
                <asp:TextBox ID="momMailIDHide" runat="server" Visible="false"></asp:TextBox>
                <fieldset>
                    <legend class="grayHeader">Message</legend>
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <strong>From :</strong>
                                <asp:Label ID="momMailFrom" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Sent :</strong>
                                <asp:Label ID="momMailSent" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Subject :</strong>
                                <asp:Label ID="momMailSubject" runat="server"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Messge : </strong></td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Label ID="momMailBody" runat="server" Height="200px"></asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><asp:Button ID="momMailReply" runat="server" Text="Reply" CssClass="btnStyle" OnClick="momMailReply_Click" />
                                <asp:Button ID="momMailDelete" runat="server" Text="Delete" CssClass="btnStyle" OnClick="momMailDelete_Click" /></td>
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
