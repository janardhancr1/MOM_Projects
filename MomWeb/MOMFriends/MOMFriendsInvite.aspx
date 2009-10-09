<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMFriendsInvite.aspx.cs" Inherits="MOMFriends_MOMFriendsInvite" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <script type="text/javascript" src="http://www.plaxo.com/css/m/js/util.js"></script>
    <script type="text/javascript" src="http://www.plaxo.com/css/m/js/basic.js"></script>
    <script type="text/javascript" src="http://www.plaxo.com/css/m/js/abc_launcher.js"></script>
    <script type="text/javascript">
        <!--
        function onABCommComplete() 
        {
        }
        //-->
    </script>
    <table width="100%">
        <tr>
            <td Class="grayHeader">
                Invite Your Friends
            </td>
        </tr>
        <tr>
            <td>
                <fieldset>
                     <legend class="grayHeader"><asp:Label ID="momUserFullName" runat="server"></asp:Label></legend>
                     <table width="100%" cellpadding="4">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="2">
                                    <tr>
                                        <td style="width: 75px; text-align: right; vertical-align: top;">
                                            From:
                                        </td>
                                        <td>
                                            <asp:Label id="momUserEmail" runat="server"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 75px; text-align: right; vertical-align: top;">
                                            To:<br />
                                            <small>(use commas to separate emails)</small>
                                        </td>
                                        <td>
                                            <asp:TextBox ID="momFromEmailAddresses" TextMode="multiLine" runat="server" Rows="4" Columns="40">
                                            </asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 75px; text-align: right; vertical-align: top;">
                                            Message:
                                            <small>(Optional)</small>
                                        </td>
                                        <td>
                                            <asp:TextBox ID="momMessageToFrineds" TextMode="multiLine" runat="server" Rows="6" Columns="40">
                                            </asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <small>Invites will be sent in English (US)</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <asp:Button ID="momFriendsInvite" runat="server" Text="Invite" cssClass="btnStyle" OnClick="momFriendsInvite_Click" />
                                            <asp:Button ID="momFriendsCancel" runat="server" Text="Cancel" cssClass="btnStyle" OnClick="momFriendsCancel_Click" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <small>Momburbia will send each person above an invite in your name asking them to join Momburbia.</small>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top;">
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td>
                                            <a href="#" onclick="showPlaxoABChooser('<%=momFromEmailAddresses.ClientID %>', '/MOMFriends/plaxo_cb.html'); return false">
                                                <div class="momInfo">Import Email Addresses &#9654;</div>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <small>from almost any online email service to invite your friends.</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="../images/gmail_logo.gif" />
                                            <img src="../images/yahoo_logo.gif" />                                            
                                            <img src="../images/wl_hotmail_logo.gif" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="momInfo">View All Invites &#9654;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <small>
                                                See your entire history of invitations, including who has joined because of you.
                                            </small>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                     </table>
                </fieldset>
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
</asp:Content>
