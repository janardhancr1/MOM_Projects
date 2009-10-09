<%@ Control Language="C#" AutoEventWireup="true" CodeFile="MOMHead.ascx.cs" Inherits="MOMUserControls_MOMHead" %>
<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<script type="text/javascript">
    function silentErrorHandler() {return true;}
    window.onerror=silentErrorHandler;
</script>
<table class="momHeaderStyle" cellspacing="0">
    <tr>
        <td style="vertical-align: middle;">
            <table style="width: 300px">
                <tr style="font-weight: bold;">
                    <td style="vertical-align: middle; font-size: 8pt;">
                        <div>
                            <a href="../MOMHome/MOMHome.aspx" style="color: White;">Home</a>
                        </div>                                            
                    </td>
                    <td style="vertical-align: middle; font-size: 8pt;">
                        <a href="../MOMProfile/MOMProfile.aspx" style="color: White;">Profile</a>
                    </td>
                    <td style="vertical-align: middle; font-size: 8pt;">
                        <div id="momFriends" runat="server"><a href="../MOMFriends/MOMRecent.aspx" style="color:White;">Friends<small style="color: White;">&#9660;</small></a></div>
                        <asp:Panel CssClass="popupMenu" ID="momFriendsMenu" runat="server">
                            <div style="border:1px outset white;padding: 5px; width: 175px;">
                                <div id="momFriendsRAHctl" style="padding: 5px;" onmouseout="restoreColor('momFriendsRAHctl');" onmouseover="changeColor('momFriendsRAHctl');">
                                <asp:LinkButton ID="momRecentlyAddedFriends" runat="server" Text="Recently Added" CssClass="popupMenuDiv" OnClick="momRecentlyAddedFriends_Click" /></div>
                                <div id="momFriendsAFHctl" style="padding: 5px;" onmouseout="restoreColor('momFriendsAFHctl');" onmouseover="changeColor('momFriendsAFHctl');">
                                <asp:LinkButton ID="momAllFriends" runat="server" Text="All Friends" CssClass="popupMenuDiv" OnClick="momAllFriends_Click"  /></div>
                                <div style="background-color: MistyRose; padding: 0px; height: 1px;"></div>
                                <div id="momFriendsIFHctl" style="padding: 5px;" onmouseout="restoreColor('momFriendsIFHctl');" onmouseover="changeColor('momFriendsIFHctl');">
                                <asp:LinkButton ID="momInviteFriends" runat="server" Text="Invite Friends" CssClass="popupMenuDiv" OnClick="momInviteFriends_Click"  /></div>
                                <div id="momFriendsFFHctl" style="padding: 5px;" onmouseout="restoreColor('momFriendsFFHctl');" onmouseover="changeColor('momFriendsFFHctl');">
                                <asp:LinkButton ID="momFindFriends" runat="server" Text="Find Friends" CssClass="popupMenuDiv" OnClick="momFindFriends_Click"  /></div>
                            </div>
                        </asp:Panel>                        
                    <cc1:HoverMenuExtender ID="HoverMenuExtender2" runat="server" HoverCssClass="popupHover"
                    PopupControlID="momFriendsMenu" TargetControlID="momFriends" PopupPosition="Bottom" PopDelay="50"
                    OffsetY="5">
                    </cc1:HoverMenuExtender>
                    </td>
                    <td style="vertical-align: middle; font-size: 8pt;">
                        <div id="momInbox" runat="server"><a href="../MOMMail/MOMMailHome.aspx" style="color:White;">Inbox<small style="color: White;">&#9660;</small></a></div>
                        <asp:Panel CssClass="popupMenu" ID="momInboxMenu" runat="server">
                            <div style="border:1px outset white;padding: 5px; width: 175px;">
                                <div id="momVwMsgHctl" style="padding: 5px;" onmouseout="restoreColor('momVwMsgHctl');" onmouseover="changeColor('momVwMsgHctl');">
                                <asp:LinkButton ID="momViewMessageInbox" runat="server" Text="View Message Inbox" CssClass="popupMenuDiv" OnClick="momViewMessageInbox_Click" /></div>
                                <div id="momCmMsgHctl" style="padding: 5px;" onmouseout="restoreColor('momCmMsgHctl');" onmouseover="changeColor('momCmMsgHctl');">
                                <asp:LinkButton ID="momComposeMessage" runat="server" Text="Compose New Message" CssClass="popupMenuDiv" OnClick="momComposeMessage_Click" /></div>
                            </div>
                        </asp:Panel>                        
                    <cc1:HoverMenuExtender ID="HoverMenuExtender1" runat="server" HoverCssClass="popupHover"
                    PopupControlID="momInboxMenu" TargetControlID="momInbox" PopupPosition="Bottom" PopDelay="50"
                    OffsetY="5">
                    </cc1:HoverMenuExtender>
                    </td>
                </tr>
                <script>
                    function changeColor(args)
                    {
                        var object = document.getElementById(args);
                        object.style.backgroundColor  = "Pink";
                        object.style.color = "White";
                    }
                    
                    function restoreColor(args)
                    {
                        var object = document.getElementById(args);
                        object.style.backgroundColor  = "White";
                    }
                </script>
            </table>   
        </td>
        <td align="right">
            <table style="width: 450px" cellspacing="0">
                <tr align="left">
                    <td style="vertical-align: middle; font-size: 8pt;">
                        <asp:Label ID="momUserName" runat="Server"></asp:Label>
                    </td>
                    <td style="vertical-align: middle; font-size: 8pt;">
                        Settings
                    </td>
                    <td style="vertical-align: middle; font-size: 8pt;">
                        <asp:LinkButton ID="momLogout" Text="Logout" runat="server" CssClass="momLink" OnClick="momLogout_Click">
                        </asp:LinkButton>
                    </td>
                    <td align="left" style="width:150px; vertical-align: middle; font-size: 8pt;">
                        <asp:TextBox ID="momSearch" runat="server" CssClass="tbStyle"></asp:TextBox>
                        <cc1:TextBoxWatermarkExtender ID="TextBoxWatermarkExtender1" runat="server" TargetControlID="momSearch" WatermarkText="Search">
                        </cc1:TextBoxWatermarkExtender>
                    </td>
                </tr>
            </table>
        </td>                         
    </tr>
</table>
