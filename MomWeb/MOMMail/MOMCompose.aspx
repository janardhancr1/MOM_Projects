<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMCompose.aspx.cs" Inherits="MOMMail_MOMCompose" %>

<%@ Register Assembly="FredCK.FCKeditorV2" Namespace="FredCK.FCKeditorV2" TagPrefix="FCKEditor" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <div class="tabs">
        <center>
            <div class="left_tabs">
                <ul class="toggle_tabs" id="toggle_tabs_unused">
                    <li class="first "><a href="MOMInbox.aspx" onclick="return true;">Inbox</a></li>
                    <li><a href="MOMSent.aspx" onclick="return true;">Sent Messages</a></li>
                    <li class="last "><a href="MOMCompose.aspx" class="selected" onclick="return true;">Compose Message</a></li>
                </ul>
            </div>
        </center>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <br />
                <fieldset>
                    <legend class="grayHeader">Compose Message</legend>
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="momInfo">
                                    To :&nbsp;<small>(required)</small></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:TextBox ID="momMailTo" runat="server" Width="300px" ValidationGroup="ComposeMessage"></asp:TextBox>
                                <br />
                                (To enter multiple recipients separate username by comma - username 1, username
                                2, etc upto 25 recipients)</td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">
                                    Subject : &nbsp;<small>(required)</small></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:TextBox ID="momMailSubject" runat="server" Width="300px" MaxLength="100"></asp:TextBox></td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">
                                    Message : &nbsp;<small>(required)</small></div>
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
                <popUp:momPopup ID="momPopup" runat="server" />
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
