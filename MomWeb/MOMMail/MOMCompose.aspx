<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMCompose.aspx.cs" Inherits="MOMMail_MOMCompose" %>

<%@ Register Assembly="FredCK.FCKeditorV2" Namespace="FredCK.FCKeditorV2" TagPrefix="FCKEditor" %>
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
                <br />
                <fieldset>
                    <legend class="grayHeader">Compose Message</legend>
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="momInfo">
                                    To</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:TextBox ID="momMailTo" runat="server" Width="300px"></asp:TextBox></td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">
                                    Subject</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:TextBox ID="momMailSubject" runat="server" Width="300px"></asp:TextBox></td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">
                                    Message</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <FCKEditor:FCKeditor ID="momMailBody" runat="server" BasePath="~/js/fckeditor/" ToolbarSet="MOM"
                                    ToolbarCanCollapse="false" EnableViewState="true" Width="95%" Height="200px">
                                </FCKEditor:FCKeditor>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Button ID="momMailSend" runat="server" Text="Send" CssClass="btnStyle" OnClick="momMailSend_Click" />
                                <asp:Button ID="momMailCancel" runat="server" Text="Cancel" CssClass="btnStyle" OnClick="momMailCancel_Click" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
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
