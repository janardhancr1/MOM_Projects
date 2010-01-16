<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true"
    CodeFile="MOMProfile.aspx.cs" Inherits="MOMProfile_MOMProfile" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
<%@ Import Namespace="BOMomburbia" %>
<asp:Content ContentPlaceHolderID="momLeft" ID="momLeftContent" runat="server">
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <pc:profileControl ID="userProfile" runat="server" />
            </td>
        </tr>
    </table>
</asp:Content>
<asp:Content ContentPlaceHolderID="momCenter" ID="momCenterContent" runat="server">
    <asp:MultiView ID="MultiView1" runat="server" ActiveViewIndex="0">
        <asp:View ID="ViewWall" runat="server">
            <div class="almtopnav">
                <ul>
                    <li class="selectedtab"><a id="A1" runat="server" href="#" name="0" class="homeon"
                        onserverclick="ChangeMenu">Wall</a> </li>
                    <li><a id="A2" href="#" runat="server" name="1" class="unselected" onserverclick="ChangeMenu">
                        Info</a> </li>
                </ul>
            </div>
            <table style="width: 548px" cellpadding="2" cellspacing="0">
                <tr>
                    <td>
                        <asp:Label ID="momUserName" runat="server" CssClass="grayHeader"></asp:Label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <asp:Panel ID="Panel1" runat="server" Width="100%" CssClass="roundedPanel">
                            <table>
                                <tr>
                                    <td>
                                        <div>
                                            <asp:TextBox ID="momShare" runat="server" TextMode="multiLine" Rows="2" Columns="80"
                                                Style="color: #aa3464; width: 500px;">
                                            </asp:TextBox>
                                            <cc1:TextBoxWatermarkExtender ID="TextBoxWatermarkExtender" runat="server" TargetControlID="momShare"
                                                WatermarkText="You've got hands full so type anything!!!">
                                            </cc1:TextBoxWatermarkExtender>
                                        </div>
                                        <div class="momSpacer5px">
                                        </div>
                                        <div id="momShareLinkPanel" style="text-align: center; display: none;">
                                            <table width="100%">
                                                <tr>
                                                    <td align="center">
                                                        <table style="width: 95%; background-color: White; text-align: left;" cellpadding="5">
                                                            <tr>
                                                                <td>
                                                                    Link
                                                                </td>
                                                                <td align="right">
                                                                    <a href="javascript:hideSubPanel('momShareLinkPanel');">X</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div class="styleLine">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <asp:TextBox ID="momShareLink" runat="server" Style="width: 400px;"></asp:TextBox>
                                                                    <cc1:TextBoxWatermarkExtender ID="TextBoxWatermarkExtender1" runat="server" TargetControlID="momShareLink"
                                                                        WatermarkText="http://">
                                                                    </cc1:TextBoxWatermarkExtender>
                                                                    <asp:HiddenField ID="momShareLinkStatus" runat="server" Value="F"></asp:HiddenField>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="momSpacer5px">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="1" class="momShareMenu">
                                            <tr>
                                                <td class="momInfo">
                                                    Attach
                                                </td>
                                                <td>
                                                    <a title="Photos">
                                                        <img src="../images/home_icon2.gif" width="22px" height="20px" /></a>
                                                </td>
                                                <td>
                                                    <a title="Vidoes">
                                                        <img src="../images/home_icon4.gif" width="22px" height="20px" /></a>
                                                </td>
                                                <td>
                                                    <img src="../images/home_icon9.gif" width="22px" height="20px" onclick="showSubPanel('momShareLinkPanel');" />
                                                </td>
                                                <td style="width: 400px; text-align: right;">
                                                    <asp:Button ID="momPublish" Text="Share" runat="server" CssClass="btnStyle" OnClick="momPublish_Click" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </asp:Panel>
                        <cc1:RoundedCornersExtender ID="RoundedCornersExtender1" runat="server" TargetControlID="Panel1"
                            Radius="4" Corners="All">
                        </cc1:RoundedCornersExtender>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10pt;">
                        <asp:Repeater ID="momFridgeShared" runat="server" OnItemDataBound="momFridgeShared_ItemDataBound">
                            <ItemTemplate>
                                <div id="momFeed<%# DataBinder.Eval(Container.DataItem, "ID") %>" onmouseover="showHide('feedButton<%# DataBinder.Eval(Container.DataItem, "ID") %>')"
                                    onmouseout="showHide('feedButton<%# DataBinder.Eval(Container.DataItem, "ID") %>')">
                                    <table width="100%" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table cellpadding="3" width="100%">
                                                    <tr>
                                                        <td rowspan="3" style="width: 45px; vertical-align: top;">
                                                            <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" width="40" height="40" />
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>"
                                                                    style="font-weight: bold;">
                                                                    <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString()) %>
                                                                </a>
                                                                <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "SHARE").ToString()), 50)%>
                                                            </div>
                                                            <div>
                                                                <small>
                                                                    <%# DataBinder.Eval(Container.DataItem, "TYPE_SHARE").ToString() %>
                                                                </small>
                                                            </div>
                                                        </td>
                                                        <td rowspan="3" style="width: 95px; vertical-align: top;">
                                                            <div id="feedButton<%# DataBinder.Eval(Container.DataItem, "ID") %>" style="display: none;">
                                                                <input type="button" value="Hide" class="btnStyle" onclick="hideFeed('momFeed<%# DataBinder.Eval(Container.DataItem, "ID") %>', <%# DataBinder.Eval(Container.DataItem, "ID") %>);" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="100%" cellpadding="3">
                                                                <tr>
                                                                    <td style="font-size: 8pt; color: darkgray;">
                                                                        <%# DataBinder.Eval(Container.DataItem, "TIME") %>
                                                                        - <a href="javascript:showWriteComment('momCommentsInfo<%# DataBinder.Eval(Container.DataItem, "ID") %>');">
                                                                            Comment</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div id="momCommentParent<%# DataBinder.Eval(Container.DataItem, "ID") %>">
                                                                            <asp:Repeater ID="momFridgeCommentsRpt" runat="server">
                                                                                <ItemTemplate>
                                                                                    <div id="momFridgeComment<%# DataBinder.Eval(Container.DataItem, "ID") %>" style="background-color: MistyRose;
                                                                                        display: block;">
                                                                                        <table width="100%" cellspacing="0" cellpadding="3">
                                                                                            <tr>
                                                                                                <td style="width: 29px;" rowspan="2" class="commentStyle">
                                                                                                    <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" height="25" width="25" />
                                                                                                </td>
                                                                                                <td class="commentStyle">
                                                                                                    <a href="?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>"
                                                                                                        style="font-weight: bold;">
                                                                                                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString())%>
                                                                                                    </a>
                                                                                                    <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "COMMENTS").ToString()), 40)%>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="commentStyle">
                                                                                                    <%# DataBinder.Eval(Container.DataItem, "TIME") %>
                                                                                                    * <a href="javascript:deleteComment('momFridgeComment<%# DataBinder.Eval(Container.DataItem, "ID") %>', <%# DataBinder.Eval(Container.DataItem, "ID") %>);">
                                                                                                        delete</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                    <div style="height: 2px; background-color: white;">
                                                                                    </div>
                                                                                </ItemTemplate>
                                                                            </asp:Repeater>
                                                                        </div>
                                                                        <div id="momCommentsInfo<%# DataBinder.Eval(Container.DataItem, "ID") %>" style="display: none;
                                                                            vertical-align: middle;">
                                                                            <div style="background-color: MistyRose;">
                                                                                <input id="momCommentsText<%# DataBinder.Eval(Container.DataItem, "ID") %>" type="text"
                                                                                    class="tbStyle" style="width: 98%;" />
                                                                            </div>
                                                                            <div style="text-align: right; top: 30px; background-color: MistyRose; text-indent: 10px;">
                                                                                <input type="button" class="btnStyle" value="Comment" onclick="addComments('momCommentParent<%# DataBinder.Eval(Container.DataItem, "ID") %>', 'momCommentsInfo<%# DataBinder.Eval(Container.DataItem, "ID") %>', 'momCommentsText<%# DataBinder.Eval(Container.DataItem, "ID") %>', '<%# DataBinder.Eval(Container.DataItem, "ID") %>');" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="styleLine">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </ItemTemplate>
                        </asp:Repeater>
                        <div id="momParent" runat="server">
                        </div>
                    </td>
                </tr>
            </table>
            <popUp:momPopup ID="momPopupExtender" runat="server" />
        </asp:View>
        <asp:View ID="ViewInfo" runat="server">
        <div class="almtopnav">
                <ul>
                    <li><a id="A25" runat="server" href="#" class="unselected" name="0" onserverclick="ChangeMenu">
                        Wall</a> </li>
                    <li class="selectedtab"><a id="A26" runat="server" href="#" class="homeon" name="1"
                        onserverclick="ChangeMenu">Info</a> </li>
                </ul>
            </div>
        </asp:View>
        <asp:View ID="EditInfo" runat="server">
            <div class="almtopnav">
                <ul>
                    <li><a id="A3" runat="server" href="#" class="unselected" name="0" onserverclick="ChangeMenu">
                        Wall</a> </li>
                    <li class="selectedtab"><a id="A4" runat="server" href="#" class="homeon" name="1"
                        onserverclick="ChangeMenu">Info</a> </li>
                </ul>
            </div>
            <table width="100%">
                <tr>
                    <td colspan="3" align="left" style="font-size: larger; font-weight: bolder; color: Gray;">
                        Click on a profile section below to edit it.
                    </td>
                </tr>
                <tr>
                    <td width="1%">
                    </td>
                    <td width="98%">
                    
                        <div class="accordionHeaderSelected" id="accordionHeader1" onclick="javascript:runAccordion(1, 300);">
                            <a href="javascript:void(0);" class="accordionLink">Your Basics</a>
                        </div>
                        <div class="accordionContent" id="accordionContent1" style="display:block;height:300px">
                            <fieldset>
                                <table width="400">
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                First Name:</div>
                                        </td>
                                        <td align="left">
                                            <asp:TextBox ID="momFirstName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                            <asp:Label ID="momFirstNameLbl" runat="server" CssClass="tbSignIn" Visible="<%# showInfo() %>"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                Last Name:</div>
                                        </td>
                                        <td align="left">
                                            <asp:TextBox ID="momLastName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                            <asp:Label ID="momLastNameLbl" runat="server" CssClass="tbSignIn"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                Your Email:</div>
                                        </td>
                                        <td align="left">
                                            <asp:TextBox ID="momEmail" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                            <asp:Label ID="momEmailLbl" runat="server" CssClass="tbSignIn"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr id="Tr1" runat="server">
                                        <td align="right">
                                            <div class="momInfo">
                                                Password:</div>
                                        </td>
                                        <td align="left">
                                            <a href="#">Change Password</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                Select Your Country:</div>
                                        </td>
                                        <td>
                                            <asp:DropDownList ID="momCountry" runat="server" CssClass="tbSignIn">
                                                <asp:ListItem Text="United States" Value="1" Selected="true"></asp:ListItem>
                                                <asp:ListItem Text="India" Value="2"></asp:ListItem>
                                                <asp:ListItem Text="United Kingdom" Value="3"></asp:ListItem>
                                            </asp:DropDownList>
                                            <asp:Label ID="momCountryLbl" runat="server" CssClass="tbSignIn"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                Zipcode / Postal code:</div>
                                        </td>
                                        <td align="left">
                                            <asp:TextBox ID="momZipCode" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                            <asp:Label ID="momZipCodeLbl" runat="server" CssClass="tbSignIn"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                Location:</div>
                                        </td>
                                        <td align="left">
                                            <asp:TextBox ID="momLocation" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                            <asp:Label ID="momLocationLbl" runat="server" CssClass="tbSignIn"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                Display Name:</div>
                                        </td>
                                        <td align="left">
                                            <asp:Label ID="momDisplayName" runat="server"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                                Personal URL:</div>
                                        </td>
                                        <td align="left">
                                            <asp:Label ID="momPersonalURL" runat="server"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="momInfo">
                                            Member Since:
                                        </td>
                                        <td align="left">
                                            <asp:Label ID="momJoinedDate" runat="server"></asp:Label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            <asp:Button ID="PersonalSaveButton" runat="server" Text="Save" CssClass="btnStyle"
                                                OnClick="DetailsSave_Click" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                        <div class="accordionHeader" id="accordionHeader2" onclick="javascript:runAccordion(2, 700);">
                            <a href="javascript:void(0);" class="accordionLink">Photo / Avtar</a>
                        </div>
                        <div class="accordionContent" id="accordionContent2" style="display: none">
                            <fieldset>
                                <table width="400" cellpadding="1" cellspacing="0">
                                    <tr>
                                        <td>
                                            <iframe src="../MOMFileUpload/MOMFileUpload.aspx?from=profile" height="200" width="500"
                                                frameborder="no"></iframe>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <font size="4">OR</font></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Select from below Avatars:</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table id="avatarChooser" class="avatarChooserTable" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center" id="avatar_0" class="unselected">
                                                        <a id="A5" class="avatarListItem" href="#" name="0" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_0" src="../images/profile/avatar_0_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_1" class="unselected">
                                                        <a id="A6" class="avatarListItem" href="#" name="1" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_1" src="../images/profile/avatar_1_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_2" class="unselected">
                                                        <a id="A7" class="avatarListItem" href="#" name="2" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_2" src="../images/profile/avatar_2_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_3" class="unselected">
                                                        <a id="A8" class="avatarListItem" href="#" name="3" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_3" src="../images/profile/avatar_3_md.jpg" alt="avatar" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" id="avatar_4" class="unselected">
                                                        <a id="A9" class="avatarListItem" href="#" name="4" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_4" src="../images/profile/avatar_4_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_5" class="unselected">
                                                        <a id="A10" class="avatarListItem" href="#" name="5" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_5" src="../images/profile/avatar_5_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_6" class="unselected">
                                                        <a id="A11" class="avatarListItem" href="#" name="6" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_6" src="../images/profile/avatar_6_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_7" class="unselected">
                                                        <a id="A12" class="avatarListItem" href="#" name="7" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_7" src="../images/profile/avatar_7_md.jpg" alt="avatar" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" id="avatar_8" class="unselected">
                                                        <a id="A13" class="avatarListItem" href="#" name="8" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_8" src="../images/profile/avatar_8_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_9" class="unselected">
                                                        <a id="A14" class="avatarListItem" href="#" name="9" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_9" src="../images/profile/avatar_9_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_10" class="unselected">
                                                        <a id="A15" class="avatarListItem" href="#" name="10" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_10" src="../images/profile/avatar_10_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_11" class="unselected">
                                                        <a id="A16" class="avatarListItem" href="#" name="11" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_11" src="../images/profile/avatar_11_md.jpg" alt="avatar" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" id="avatar_12" class="unselected">
                                                        <a id="A17" class="avatarListItem" href="#" name="12" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_12" src="../images/profile/avatar_12_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_13" class="unselected">
                                                        <a id="A18" class="avatarListItem" href="#" name="13" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_13" src="../images/profile/avatar_13_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_14" class="unselected">
                                                        <a id="A19" class="avatarListItem" href="#" name="14" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_14" src="../images/profile/avatar_14_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_15" class="unselected">
                                                        <a id="A20" class="avatarListItem" href="#" name="15" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_15" src="../images/profile/avatar_15_md.jpg" alt="avatar" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" id="avatar_16" class="unselected">
                                                        <a id="A21" class="avatarListItem" href="#" name="16" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_16" src="../images/profile/avatar_16_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_17" class="unselected">
                                                        <a id="A22" class="avatarListItem" href="#" name="17" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_17" src="../images/profile/avatar_17_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_18" class="unselected">
                                                        <a id="A23" class="avatarListItem" href="#" name="18" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_18" src="../images/profile/avatar_18_md.jpg" alt="avatar" /></a></td>
                                                    <td align="center" id="avatar_19" class="unselected">
                                                        <a id="A24" class="avatarListItem" href="#" name="19" runat="server" onserverclick="selectAvatar">
                                                            <img id="avatarImg_19" src="../images/profile/avatar_19_md.jpg" alt="avatar" /></a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>
                        <div class="accordionHeader" id="accordionHeader3" onclick="javascript:runAccordion(3, 400);">
                            <a href="javascript:void(0);" class="accordionLink">Kids</a>
                        </div>
                        <div class="accordionContent" id="accordionContent3" style="display: none">
                            <fieldset>
                                <p>
                                    <h5>
                                        Add/Edit Kids</h5>
                                    <table width="100%" cellpadding="0" cellspacing="0" id="momKidsTable" runat="server">
                                        <tr bgcolor="gray">
                                            <th width="40%" align="left">
                                                Name</th>
                                            <th width="20%" align="left">
                                                BirthDay</th>
                                            <th width="20%" align="left">
                                                Gender</th>
                                            <th width="20%">
                                                Edit/Delete</th>
                                        </tr>
                                    </table>
                                    <br />
                                    <input type="button" id="KidsAddButton" value="Add Child" onclick="javascript:showHideCancel('kidstable',this,1);"
                                        class="btnStyle" />
                                    <br />
                                    <br />
                                    <div id="kidstable" style="display: none">
                                        <fieldset>
                                            <table width="100%">
                                                <tr>
                                                    <td>
                                                        First Name</td>
                                                    <td>
                                                        <asp:TextBox ID="momKidFirstName" runat="server" MaxLength="50"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gender</td>
                                                    <td>
                                                        <asp:RadioButtonList ID="momKidGender" runat="server" RepeatDirection="Horizontal">
                                                            <asp:ListItem Value="Male">Male</asp:ListItem>
                                                            <asp:ListItem Value="FeMale">FeMale</asp:ListItem>
                                                        </asp:RadioButtonList></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Date of Birth</td>
                                                    <td>
                                                        <asp:DropDownList ID="momKidMonth" runat="server">
                                                            <asp:ListItem Value="">Month</asp:ListItem>
                                                            <asp:ListItem Value="01">January</asp:ListItem>
                                                            <asp:ListItem Value="02">February</asp:ListItem>
                                                            <asp:ListItem Value="03">March</asp:ListItem>
                                                            <asp:ListItem Value="04">April</asp:ListItem>
                                                            <asp:ListItem Value="05">May</asp:ListItem>
                                                            <asp:ListItem Value="06">June</asp:ListItem>
                                                            <asp:ListItem Value="07">July</asp:ListItem>
                                                            <asp:ListItem Value="08">August</asp:ListItem>
                                                            <asp:ListItem Value="09">September</asp:ListItem>
                                                            <asp:ListItem Value="10">October</asp:ListItem>
                                                            <asp:ListItem Value="11">November</asp:ListItem>
                                                            <asp:ListItem Value="12">December</asp:ListItem>
                                                        </asp:DropDownList>
                                                        <asp:DropDownList ID="momKidDay" runat="server">
                                                            <asp:ListItem Value="">Day</asp:ListItem>
                                                            <asp:ListItem Value="01">01</asp:ListItem>
                                                            <asp:ListItem Value="02">02</asp:ListItem>
                                                            <asp:ListItem Value="03">03</asp:ListItem>
                                                            <asp:ListItem Value="04">04</asp:ListItem>
                                                            <asp:ListItem Value="05">05</asp:ListItem>
                                                            <asp:ListItem Value="06">06</asp:ListItem>
                                                            <asp:ListItem Value="07">07</asp:ListItem>
                                                            <asp:ListItem Value="08">08</asp:ListItem>
                                                            <asp:ListItem Value="09">09</asp:ListItem>
                                                            <asp:ListItem Value="10">10</asp:ListItem>
                                                            <asp:ListItem Value="11">11</asp:ListItem>
                                                            <asp:ListItem Value="12">12</asp:ListItem>
                                                            <asp:ListItem Value="13">13</asp:ListItem>
                                                            <asp:ListItem Value="14">14</asp:ListItem>
                                                            <asp:ListItem Value="15">15</asp:ListItem>
                                                            <asp:ListItem Value="16">16</asp:ListItem>
                                                            <asp:ListItem Value="17">17</asp:ListItem>
                                                            <asp:ListItem Value="18">18</asp:ListItem>
                                                            <asp:ListItem Value="19">19</asp:ListItem>
                                                            <asp:ListItem Value="20">20</asp:ListItem>
                                                            <asp:ListItem Value="21">21</asp:ListItem>
                                                            <asp:ListItem Value="22">22</asp:ListItem>
                                                            <asp:ListItem Value="23">23</asp:ListItem>
                                                            <asp:ListItem Value="24">24</asp:ListItem>
                                                            <asp:ListItem Value="25">25</asp:ListItem>
                                                            <asp:ListItem Value="26">26</asp:ListItem>
                                                            <asp:ListItem Value="27">27</asp:ListItem>
                                                            <asp:ListItem Value="28">28</asp:ListItem>
                                                            <asp:ListItem Value="29">29</asp:ListItem>
                                                            <asp:ListItem Value="30">30</asp:ListItem>
                                                            <asp:ListItem Value="31">31</asp:ListItem>
                                                        </asp:DropDownList>
                                                        <asp:DropDownList ID="momKidYear" runat="server">
                                                            <asp:ListItem Value="Year">Year</asp:ListItem>
                                                            <asp:ListItem Value="2009">2009</asp:ListItem>
                                                            <asp:ListItem Value="2008">2008</asp:ListItem>
                                                            <asp:ListItem Value="2007">2007</asp:ListItem>
                                                            <asp:ListItem Value="2006">2006</asp:ListItem>
                                                            <asp:ListItem Value="2005">2005</asp:ListItem>
                                                            <asp:ListItem Value="2004">2004</asp:ListItem>
                                                            <asp:ListItem Value="2003">2003</asp:ListItem>
                                                            <asp:ListItem Value="2002">2002</asp:ListItem>
                                                            <asp:ListItem Value="2001">2001</asp:ListItem>
                                                            <asp:ListItem Value="2000">2000</asp:ListItem>
                                                            <asp:ListItem Value="1999">1999</asp:ListItem>
                                                            <asp:ListItem Value="1998">1998</asp:ListItem>
                                                            <asp:ListItem Value="1997">1997</asp:ListItem>
                                                            <asp:ListItem Value="1996">1996</asp:ListItem>
                                                            <asp:ListItem Value="1995">1995</asp:ListItem>
                                                            <asp:ListItem Value="1994">1994</asp:ListItem>
                                                            <asp:ListItem Value="1993">1993</asp:ListItem>
                                                            <asp:ListItem Value="1992">1992</asp:ListItem>
                                                            <asp:ListItem Value="1991">1991</asp:ListItem>
                                                            <asp:ListItem Value="1990">1990</asp:ListItem>
                                                            <asp:ListItem Value="1989">1989</asp:ListItem>
                                                            <asp:ListItem Value="1988">1988</asp:ListItem>
                                                            <asp:ListItem Value="1987">1987</asp:ListItem>
                                                            <asp:ListItem Value="1986">1986</asp:ListItem>
                                                            <asp:ListItem Value="1985">1985</asp:ListItem>
                                                            <asp:ListItem Value="1984">1984</asp:ListItem>
                                                            <asp:ListItem Value="1983">1983</asp:ListItem>
                                                            <asp:ListItem Value="1982">1982</asp:ListItem>
                                                            <asp:ListItem Value="1981">1981</asp:ListItem>
                                                            <asp:ListItem Value="1980">1980</asp:ListItem>
                                                            <asp:ListItem Value="1979">1979</asp:ListItem>
                                                            <asp:ListItem Value="1978">1978</asp:ListItem>
                                                            <asp:ListItem Value="1977">1977</asp:ListItem>
                                                            <asp:ListItem Value="1976">1976</asp:ListItem>
                                                            <asp:ListItem Value="1975">1975</asp:ListItem>
                                                            <asp:ListItem Value="1974">1974</asp:ListItem>
                                                            <asp:ListItem Value="1973">1973</asp:ListItem>
                                                            <asp:ListItem Value="1972">1972</asp:ListItem>
                                                            <asp:ListItem Value="1971">1971</asp:ListItem>
                                                            <asp:ListItem Value="1970">1970</asp:ListItem>
                                                            <asp:ListItem Value="1969">1969</asp:ListItem>
                                                            <asp:ListItem Value="1968">1968</asp:ListItem>
                                                            <asp:ListItem Value="1967">1967</asp:ListItem>
                                                            <asp:ListItem Value="1966">1966</asp:ListItem>
                                                            <asp:ListItem Value="1965">1965</asp:ListItem>
                                                            <asp:ListItem Value="1964">1964</asp:ListItem>
                                                            <asp:ListItem Value="1963">1963</asp:ListItem>
                                                            <asp:ListItem Value="1962">1962</asp:ListItem>
                                                            <asp:ListItem Value="1961">1961</asp:ListItem>
                                                            <asp:ListItem Value="1960">1960</asp:ListItem>
                                                            <asp:ListItem Value="1959">1959</asp:ListItem>
                                                            <asp:ListItem Value="1958">1958</asp:ListItem>
                                                            <asp:ListItem Value="1957">1957</asp:ListItem>
                                                            <asp:ListItem Value="1956">1956</asp:ListItem>
                                                            <asp:ListItem Value="1955">1955</asp:ListItem>
                                                            <asp:ListItem Value="1954">1954</asp:ListItem>
                                                            <asp:ListItem Value="1953">1953</asp:ListItem>
                                                            <asp:ListItem Value="1952">1952</asp:ListItem>
                                                            <asp:ListItem Value="1951">1951</asp:ListItem>
                                                            <asp:ListItem Value="1950">1950</asp:ListItem>
                                                            <asp:ListItem Value="1949">1949</asp:ListItem>
                                                            <asp:ListItem Value="1948">1948</asp:ListItem>
                                                            <asp:ListItem Value="1947">1947</asp:ListItem>
                                                            <asp:ListItem Value="1946">1946</asp:ListItem>
                                                            <asp:ListItem Value="1945">1945</asp:ListItem>
                                                            <asp:ListItem Value="1944">1944</asp:ListItem>
                                                            <asp:ListItem Value="1943">1943</asp:ListItem>
                                                            <asp:ListItem Value="1942">1942</asp:ListItem>
                                                            <asp:ListItem Value="1941">1941</asp:ListItem>
                                                            <asp:ListItem Value="1940">1940</asp:ListItem>
                                                            <asp:ListItem Value="1939">1939</asp:ListItem>
                                                            <asp:ListItem Value="1938">1938</asp:ListItem>
                                                            <asp:ListItem Value="1937">1937</asp:ListItem>
                                                            <asp:ListItem Value="1936">1936</asp:ListItem>
                                                            <asp:ListItem Value="1935">1935</asp:ListItem>
                                                            <asp:ListItem Value="1934">1934</asp:ListItem>
                                                            <asp:ListItem Value="1933">1933</asp:ListItem>
                                                            <asp:ListItem Value="1932">1932</asp:ListItem>
                                                            <asp:ListItem Value="1931">1931</asp:ListItem>
                                                            <asp:ListItem Value="1930">1930</asp:ListItem>
                                                            <asp:ListItem Value="1929">1929</asp:ListItem>
                                                        </asp:DropDownList></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Photo</td>
                                                    <td>
                                                        <asp:TextBox ID="momKidPhoto" runat="server"></asp:TextBox></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        About your kid</td>
                                                    <td>
                                                        <textarea id="momKidAbout" runat="server" cols="40" rows="5"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <asp:Button ID="SaveMomKidButton" runat="server" Text="Save" CssClass="btnStyle"
                                                            OnClick="KidSave_Click" />
                                                        <input type="hidden" runat="server" id="momKidID" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </div>
                                </p>
                            </fieldset>
                        </div>
                        <div class="accordionHeader" id="accordionHeader4" onclick="javascript:runAccordion(4, 910);">
                            <a href="javascript:void(0);" class="accordionLink">Interests</a>
                        </div>
                        <div class="accordionContent" id="accordionContent4" style="display: none">
                            <fieldset>
                                <p>
                                    <div>
                                        Add your interests here:</div>
                                    <div>
                                        <textarea id="momUserInterests" runat="server" cols="80" rows="5"></textarea>
                                    </div>
                                    <h3>
                                        Need some suggestions?</h3>
                                    <p class="formDescrip">
                                        Simply click on an item below and it will be added to your list. Feel free to add
                                        your own if you'd like.</p>
                                    <div class="formOption">
                                        <h4>
                                            About Your Life</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Adoption', '<%= momUserInterests.ClientID %>'));"
                                                value="Adoption" />Adoption</a>,&#13; <a href="#" onclick="return(addInterest('Grandmother', '<%= momUserInterests.ClientID %>'));"
                                                    value="Grandmother" />Grandmother</a>,&#13; <a href="#" onclick="return(addInterest('Military Mom', '<%= momUserInterests.ClientID %>'));"
                                                        value="Military Mom" />Military Mom</a>,&#13; <a href="#" onclick="return(addInterest('Multiples', '<%= momUserInterests.ClientID %>'));"
                                                            value="Multiples" />Multiples</a>,&#13; <a href="#" onclick="return(addInterest('Single Mom', '<%= momUserInterests.ClientID %>'));"
                                                                value="Single Mom" />Single Mom</a>&#13;
                                        </p>
                                        <h4>
                                            Dieting &amp; Exercise</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Dieting', '<%= momUserInterests.ClientID %>'));"
                                                value="Dieting" />Dieting</a>,&#13; <a href="#" onclick="return(addInterest('Going to the Gym', '<%= momUserInterests.ClientID %>'));"
                                                    value="Going to the Gym" />Going to the Gym</a>,&#13; <a href="#" onclick="return(addInterest('Running', '<%= momUserInterests.ClientID %>'));"
                                                        value="Running" />Running</a>,&#13; <a href="#" onclick="return(addInterest('Walking', '<%= momUserInterests.ClientID %>'));"
                                                            value="Walking" />Walking</a>,&#13; <a href="#" onclick="return(addInterest('Yoga', '<%= momUserInterests.ClientID %>'));"
                                                                value="Yoga" />Yoga</a>&#13;
                                        </p>
                                        <h4>
                                            Education</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Choosing a College', '<%= momUserInterests.ClientID %>'));"
                                                value="Choosing a College" />Choosing a College</a>,&#13; <a href="#" onclick="return(addInterest('Continuing Education', '<%= momUserInterests.ClientID %>'));"
                                                    value="Continuing Education" />Continuing Education</a>,&#13; <a href="#" onclick="return(addInterest('Homeschooling', '<%= momUserInterests.ClientID %>'));"
                                                        value="Homeschooling" />Homeschooling</a>,&#13; <a href="#" onclick="return(addInterest('Homework Help', '<%= momUserInterests.ClientID %>'));"
                                                            value="Homework Help" />Homework Help</a>,&#13; <a href="#" onclick="return(addInterest('PTA', '<%= momUserInterests.ClientID %>'));"
                                                                value="PTA" />PTA</a>,&#13; <a href="#" onclick="return(addInterest('Scheduling', '<%= momUserInterests.ClientID %>'));"
                                                                    value="Scheduling" />Scheduling</a>&#13;
                                        </p>
                                        <h4>
                                            Entertainment</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Celebrities', '<%= momUserInterests.ClientID %>'));"
                                                value="Celebrities" />Celebrities</a>,&#13; <a href="#" onclick="return(addInterest('Movies', '<%= momUserInterests.ClientID %>'));"
                                                    value="Movies" />Movies</a>,&#13; <a href="#" onclick="return(addInterest('Music', '<%= momUserInterests.ClientID %>'));"
                                                        value="Music" />Music</a>,&#13; <a href="#" onclick="return(addInterest('TV', '<%= momUserInterests.ClientID %>'));"
                                                            value="TV" />TV</a>&#13;
                                        </p>
                                        <h4>
                                            Food</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Cooking', '<%= momUserInterests.ClientID %>'));"
                                                value="Cooking" />Cooking</a>,&#13; <a href="#" onclick="return(addInterest('Dining Out', '<%= momUserInterests.ClientID %>'));"
                                                    value="Dining Out" />Dining Out</a>,&#13; <a href="#" onclick="return(addInterest('Healthy Eating', '<%= momUserInterests.ClientID %>'));"
                                                        value="Healthy Eating" />Healthy Eating</a>,&#13; <a href="#" onclick="return(addInterest('Recipes', '<%= momUserInterests.ClientID %>'));"
                                                            value="Recipes" />Recipes</a>&#13;
                                        </p>
                                        <h4>
                                            Hobbies &amp; Crafts</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Jewelry Making', '<%= momUserInterests.ClientID %>'));"
                                                value="Jewelry Making" />Jewelry Making</a>,&#13; <a href="#" onclick="return(addInterest('Online Games', '<%= momUserInterests.ClientID %>'));"
                                                    value="Online Games" />Online Games</a>,&#13; <a href="#" onclick="return(addInterest('Photography', '<%= momUserInterests.ClientID %>'));"
                                                        value="Photography" />Photography</a>,&#13; <a href="#" onclick="return(addInterest('Reading', '<%= momUserInterests.ClientID %>'));"
                                                            value="Reading" />Reading</a>,&#13; <a href="#" onclick="return(addInterest('Scrapbooking', '<%= momUserInterests.ClientID %>'));"
                                                                value="Scrapbooking" />Scrapbooking</a>,&#13; <a href="#" onclick="return(addInterest('Sewing/Knitting', '<%= momUserInterests.ClientID %>'));"
                                                                    value="Sewing/Knitting" />Sewing/Knitting</a>&#13;
                                        </p>
                                        <h4>
                                            Home &amp; Garden</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Cleaning &amp; Laundry', '<%= momUserInterests.ClientID %>'));"
                                                value="Cleaning &amp; Laundry" />Cleaning &amp; Laundry</a>,&#13; <a href="#" onclick="return(addInterest('Decorating', '<%= momUserInterests.ClientID %>'));"
                                                    value="Decorating" />Decorating</a>,&#13; <a href="#" onclick="return(addInterest('Gardening', '<%= momUserInterests.ClientID %>'));"
                                                        value="Gardening" />Gardening</a>,&#13; <a href="#" onclick="return(addInterest('Home Improvement', '<%= momUserInterests.ClientID %>'));"
                                                            value="Home Improvement" />Home Improvement</a>,&#13; <a href="#" onclick="return(addInterest('Moving', '<%= momUserInterests.ClientID %>'));"
                                                                value="Moving" />Moving</a>,&#13; <a href="#" onclick="return(addInterest('Organizing', '<%= momUserInterests.ClientID %>'));"
                                                                    value="Organizing" />Organizing</a>,&#13; <a href="#" onclick="return(addInterest('Pets', '<%= momUserInterests.ClientID %>'));"
                                                                        value="Pets" />Pets</a>&#13;
                                        </p>
                                        <h4>
                                            Life/Work Balance</h4>
                                        <p class="formActionText">
                                            <a href="#" onclick="return(addInterest('Career Development', '<%= momUserInterests.ClientID %>'));"
                                                value="Career Development" />Career Development</a>,&#13; <a href="#" onclick="return(addInterest('Childcare', '<%= momUserInterests.ClientID %>'));"
                                                    value="Childcare" />Childcare</a>,&#13; <a href="#" onclick="return(addInterest('Flex Arrangements', '<%= momUserInterests.ClientID %>'));"
                                                        value="Flex Arrangements" />Flex Arrangements</a>,&#13; <a href="#" onclick="return(addInterest('Staying Home', '<%= momUserInterests.ClientID %>'));"
                                                            value="Staying Home" />Staying Home</a>&#13;
                                        </p>
                                    </div>
                                    <asp:Button ID="InterestSave" runat="server" CssClass="btnStyle" Text="Save" OnClick="IntSave_Click" />
                                </p>
                            </fieldset>
                        </div>
                        <div class="accordionHeader" id="accordionHeader5" onclick="javascript:runAccordion(5, 360);">
                            <a href="javascript:void(0);" class="accordionLink">Favorites</a>
                        </div>
                        <div class="accordionContent" id="accordionContent5" style="display: none">
                            <fieldset>
                                <p>
                                    A few of your favorite things</p>
                                <div>
                                    <div>
                                        Favorite Celebs:</div>
                                    <div>
                                        <textarea id="momUsrFavCeleb" runat="server" cols="80" rows="2"></textarea>
                                    </div>
                                    <div>
                                        Favorite Movies:</div>
                                    <div>
                                        <textarea id="momUsrFavMov" runat="server" cols="80" rows="2"></textarea>
                                    </div>
                                    <div>
                                        Favorite TV Shows:</div>
                                    <div>
                                        <textarea id="momUsrFavTv" runat="server" cols="80" rows="2"></textarea>
                                    </div>
                                    <div>
                                        Favorite Books:</div>
                                    <div>
                                        <textarea id="momUsrFavBook" runat="server" cols="80" rows="2"></textarea>
                                    </div>
                                    <div>
                                        Favorite Music:</div>
                                    <div>
                                        <textarea id="momUsrFavMusic" runat="server" cols="80" rows="2"></textarea>
                                    </div>
                                    <br />
                                    <asp:Button ID="FaveSaveButton" runat="server" CssClass="btnStyle" Text="Save" OnClick="FavSave_Click" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="accordionHeader" id="accordionHeader6" onclick="javascript:runAccordion(6, 300);">
                            <a href="javascript:void(0);" class="accordionLink">Education</a>
                        </div>
                        <div class="accordionContent" id="accordionContent6" style="display: none">
                            <fieldset>
                                <p>
                                    <h5>
                                        Add/Edit Schools</h5>
                                    <table width="100%" cellpadding="0" cellspacing="0" id="momEduTable" runat="server">
                                        <tr bgcolor="gray">
                                            <th width="40%" align="left">
                                                Name</th>
                                            <th width="15%" align="left">
                                                Type</th>
                                            <th width="15%" align="left">
                                                Start</th>
                                            <th width="15%" align="left">
                                                End</th>
                                            <th width="15%">
                                                Edit/Delete</th>
                                        </tr>
                                    </table>
                                    <br />
                                    <input type="button" value="Add a School" onclick="javascript:showHideCancel('edutable',this,2);"
                                        class="btnStyle" />
                                    <br />
                                    <br />
                                    <div id="edutable" style="display: none">
                                        <fieldset>
                                            <table width="100%">
                                                <tr>
                                                    <td>
                                                        School Name</td>
                                                    <td>
                                                        <asp:TextBox ID="momSchName" runat="server" MaxLength="50"></asp:TextBox></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Type</td>
                                                    <td>
                                                        <asp:DropDownList ID="momSchType" runat="server">
                                                            <asp:ListItem Value="">Select Type</asp:ListItem>
                                                            <asp:ListItem Value="High School">High School</asp:ListItem>
                                                            <asp:ListItem Value="College">College</asp:ListItem>
                                                            <asp:ListItem Value="Graduate School">Graduate School</asp:ListItem>
                                                            <asp:ListItem Value="Post Graduate">Post Graduate</asp:ListItem>
                                                            <asp:ListItem Value="Trade School">Trade School</asp:ListItem>
                                                        </asp:DropDownList></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Start Year</td>
                                                    <td>
                                                        <asp:DropDownList ID="momSchSt" runat="server">
                                                            <asp:ListItem Value="Year">Year</asp:ListItem>
                                                            <asp:ListItem Value="2009">2009</asp:ListItem>
                                                            <asp:ListItem Value="2008">2008</asp:ListItem>
                                                            <asp:ListItem Value="2007">2007</asp:ListItem>
                                                            <asp:ListItem Value="2006">2006</asp:ListItem>
                                                            <asp:ListItem Value="2005">2005</asp:ListItem>
                                                            <asp:ListItem Value="2004">2004</asp:ListItem>
                                                            <asp:ListItem Value="2003">2003</asp:ListItem>
                                                            <asp:ListItem Value="2002">2002</asp:ListItem>
                                                            <asp:ListItem Value="2001">2001</asp:ListItem>
                                                            <asp:ListItem Value="2000">2000</asp:ListItem>
                                                            <asp:ListItem Value="1999">1999</asp:ListItem>
                                                            <asp:ListItem Value="1998">1998</asp:ListItem>
                                                            <asp:ListItem Value="1997">1997</asp:ListItem>
                                                            <asp:ListItem Value="1996">1996</asp:ListItem>
                                                            <asp:ListItem Value="1995">1995</asp:ListItem>
                                                            <asp:ListItem Value="1994">1994</asp:ListItem>
                                                            <asp:ListItem Value="1993">1993</asp:ListItem>
                                                            <asp:ListItem Value="1992">1992</asp:ListItem>
                                                            <asp:ListItem Value="1991">1991</asp:ListItem>
                                                            <asp:ListItem Value="1990">1990</asp:ListItem>
                                                            <asp:ListItem Value="1989">1989</asp:ListItem>
                                                            <asp:ListItem Value="1988">1988</asp:ListItem>
                                                            <asp:ListItem Value="1987">1987</asp:ListItem>
                                                            <asp:ListItem Value="1986">1986</asp:ListItem>
                                                            <asp:ListItem Value="1985">1985</asp:ListItem>
                                                            <asp:ListItem Value="1984">1984</asp:ListItem>
                                                            <asp:ListItem Value="1983">1983</asp:ListItem>
                                                            <asp:ListItem Value="1982">1982</asp:ListItem>
                                                            <asp:ListItem Value="1981">1981</asp:ListItem>
                                                            <asp:ListItem Value="1980">1980</asp:ListItem>
                                                            <asp:ListItem Value="1979">1979</asp:ListItem>
                                                            <asp:ListItem Value="1978">1978</asp:ListItem>
                                                            <asp:ListItem Value="1977">1977</asp:ListItem>
                                                            <asp:ListItem Value="1976">1976</asp:ListItem>
                                                            <asp:ListItem Value="1975">1975</asp:ListItem>
                                                            <asp:ListItem Value="1974">1974</asp:ListItem>
                                                            <asp:ListItem Value="1973">1973</asp:ListItem>
                                                            <asp:ListItem Value="1972">1972</asp:ListItem>
                                                            <asp:ListItem Value="1971">1971</asp:ListItem>
                                                            <asp:ListItem Value="1970">1970</asp:ListItem>
                                                            <asp:ListItem Value="1969">1969</asp:ListItem>
                                                            <asp:ListItem Value="1968">1968</asp:ListItem>
                                                            <asp:ListItem Value="1967">1967</asp:ListItem>
                                                            <asp:ListItem Value="1966">1966</asp:ListItem>
                                                            <asp:ListItem Value="1965">1965</asp:ListItem>
                                                            <asp:ListItem Value="1964">1964</asp:ListItem>
                                                            <asp:ListItem Value="1963">1963</asp:ListItem>
                                                            <asp:ListItem Value="1962">1962</asp:ListItem>
                                                            <asp:ListItem Value="1961">1961</asp:ListItem>
                                                            <asp:ListItem Value="1960">1960</asp:ListItem>
                                                            <asp:ListItem Value="1959">1959</asp:ListItem>
                                                            <asp:ListItem Value="1958">1958</asp:ListItem>
                                                            <asp:ListItem Value="1957">1957</asp:ListItem>
                                                            <asp:ListItem Value="1956">1956</asp:ListItem>
                                                            <asp:ListItem Value="1955">1955</asp:ListItem>
                                                            <asp:ListItem Value="1954">1954</asp:ListItem>
                                                            <asp:ListItem Value="1953">1953</asp:ListItem>
                                                            <asp:ListItem Value="1952">1952</asp:ListItem>
                                                            <asp:ListItem Value="1951">1951</asp:ListItem>
                                                            <asp:ListItem Value="1950">1950</asp:ListItem>
                                                            <asp:ListItem Value="1949">1949</asp:ListItem>
                                                            <asp:ListItem Value="1948">1948</asp:ListItem>
                                                            <asp:ListItem Value="1947">1947</asp:ListItem>
                                                            <asp:ListItem Value="1946">1946</asp:ListItem>
                                                            <asp:ListItem Value="1945">1945</asp:ListItem>
                                                            <asp:ListItem Value="1944">1944</asp:ListItem>
                                                            <asp:ListItem Value="1943">1943</asp:ListItem>
                                                            <asp:ListItem Value="1942">1942</asp:ListItem>
                                                            <asp:ListItem Value="1941">1941</asp:ListItem>
                                                            <asp:ListItem Value="1940">1940</asp:ListItem>
                                                            <asp:ListItem Value="1939">1939</asp:ListItem>
                                                            <asp:ListItem Value="1938">1938</asp:ListItem>
                                                            <asp:ListItem Value="1937">1937</asp:ListItem>
                                                            <asp:ListItem Value="1936">1936</asp:ListItem>
                                                            <asp:ListItem Value="1935">1935</asp:ListItem>
                                                            <asp:ListItem Value="1934">1934</asp:ListItem>
                                                            <asp:ListItem Value="1933">1933</asp:ListItem>
                                                            <asp:ListItem Value="1932">1932</asp:ListItem>
                                                            <asp:ListItem Value="1931">1931</asp:ListItem>
                                                            <asp:ListItem Value="1930">1930</asp:ListItem>
                                                            <asp:ListItem Value="1929">1929</asp:ListItem>
                                                        </asp:DropDownList></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        End Year</td>
                                                    <td>
                                                        <asp:DropDownList ID="momSchEd" runat="server">
                                                            <asp:ListItem Value="Year">Year</asp:ListItem>
                                                            <asp:ListItem Value="2009">2009</asp:ListItem>
                                                            <asp:ListItem Value="2008">2008</asp:ListItem>
                                                            <asp:ListItem Value="2007">2007</asp:ListItem>
                                                            <asp:ListItem Value="2006">2006</asp:ListItem>
                                                            <asp:ListItem Value="2005">2005</asp:ListItem>
                                                            <asp:ListItem Value="2004">2004</asp:ListItem>
                                                            <asp:ListItem Value="2003">2003</asp:ListItem>
                                                            <asp:ListItem Value="2002">2002</asp:ListItem>
                                                            <asp:ListItem Value="2001">2001</asp:ListItem>
                                                            <asp:ListItem Value="2000">2000</asp:ListItem>
                                                            <asp:ListItem Value="1999">1999</asp:ListItem>
                                                            <asp:ListItem Value="1998">1998</asp:ListItem>
                                                            <asp:ListItem Value="1997">1997</asp:ListItem>
                                                            <asp:ListItem Value="1996">1996</asp:ListItem>
                                                            <asp:ListItem Value="1995">1995</asp:ListItem>
                                                            <asp:ListItem Value="1994">1994</asp:ListItem>
                                                            <asp:ListItem Value="1993">1993</asp:ListItem>
                                                            <asp:ListItem Value="1992">1992</asp:ListItem>
                                                            <asp:ListItem Value="1991">1991</asp:ListItem>
                                                            <asp:ListItem Value="1990">1990</asp:ListItem>
                                                            <asp:ListItem Value="1989">1989</asp:ListItem>
                                                            <asp:ListItem Value="1988">1988</asp:ListItem>
                                                            <asp:ListItem Value="1987">1987</asp:ListItem>
                                                            <asp:ListItem Value="1986">1986</asp:ListItem>
                                                            <asp:ListItem Value="1985">1985</asp:ListItem>
                                                            <asp:ListItem Value="1984">1984</asp:ListItem>
                                                            <asp:ListItem Value="1983">1983</asp:ListItem>
                                                            <asp:ListItem Value="1982">1982</asp:ListItem>
                                                            <asp:ListItem Value="1981">1981</asp:ListItem>
                                                            <asp:ListItem Value="1980">1980</asp:ListItem>
                                                            <asp:ListItem Value="1979">1979</asp:ListItem>
                                                            <asp:ListItem Value="1978">1978</asp:ListItem>
                                                            <asp:ListItem Value="1977">1977</asp:ListItem>
                                                            <asp:ListItem Value="1976">1976</asp:ListItem>
                                                            <asp:ListItem Value="1975">1975</asp:ListItem>
                                                            <asp:ListItem Value="1974">1974</asp:ListItem>
                                                            <asp:ListItem Value="1973">1973</asp:ListItem>
                                                            <asp:ListItem Value="1972">1972</asp:ListItem>
                                                            <asp:ListItem Value="1971">1971</asp:ListItem>
                                                            <asp:ListItem Value="1970">1970</asp:ListItem>
                                                            <asp:ListItem Value="1969">1969</asp:ListItem>
                                                            <asp:ListItem Value="1968">1968</asp:ListItem>
                                                            <asp:ListItem Value="1967">1967</asp:ListItem>
                                                            <asp:ListItem Value="1966">1966</asp:ListItem>
                                                            <asp:ListItem Value="1965">1965</asp:ListItem>
                                                            <asp:ListItem Value="1964">1964</asp:ListItem>
                                                            <asp:ListItem Value="1963">1963</asp:ListItem>
                                                            <asp:ListItem Value="1962">1962</asp:ListItem>
                                                            <asp:ListItem Value="1961">1961</asp:ListItem>
                                                            <asp:ListItem Value="1960">1960</asp:ListItem>
                                                            <asp:ListItem Value="1959">1959</asp:ListItem>
                                                            <asp:ListItem Value="1958">1958</asp:ListItem>
                                                            <asp:ListItem Value="1957">1957</asp:ListItem>
                                                            <asp:ListItem Value="1956">1956</asp:ListItem>
                                                            <asp:ListItem Value="1955">1955</asp:ListItem>
                                                            <asp:ListItem Value="1954">1954</asp:ListItem>
                                                            <asp:ListItem Value="1953">1953</asp:ListItem>
                                                            <asp:ListItem Value="1952">1952</asp:ListItem>
                                                            <asp:ListItem Value="1951">1951</asp:ListItem>
                                                            <asp:ListItem Value="1950">1950</asp:ListItem>
                                                            <asp:ListItem Value="1949">1949</asp:ListItem>
                                                            <asp:ListItem Value="1948">1948</asp:ListItem>
                                                            <asp:ListItem Value="1947">1947</asp:ListItem>
                                                            <asp:ListItem Value="1946">1946</asp:ListItem>
                                                            <asp:ListItem Value="1945">1945</asp:ListItem>
                                                            <asp:ListItem Value="1944">1944</asp:ListItem>
                                                            <asp:ListItem Value="1943">1943</asp:ListItem>
                                                            <asp:ListItem Value="1942">1942</asp:ListItem>
                                                            <asp:ListItem Value="1941">1941</asp:ListItem>
                                                            <asp:ListItem Value="1940">1940</asp:ListItem>
                                                            <asp:ListItem Value="1939">1939</asp:ListItem>
                                                            <asp:ListItem Value="1938">1938</asp:ListItem>
                                                            <asp:ListItem Value="1937">1937</asp:ListItem>
                                                            <asp:ListItem Value="1936">1936</asp:ListItem>
                                                            <asp:ListItem Value="1935">1935</asp:ListItem>
                                                            <asp:ListItem Value="1934">1934</asp:ListItem>
                                                            <asp:ListItem Value="1933">1933</asp:ListItem>
                                                            <asp:ListItem Value="1932">1932</asp:ListItem>
                                                            <asp:ListItem Value="1931">1931</asp:ListItem>
                                                            <asp:ListItem Value="1930">1930</asp:ListItem>
                                                            <asp:ListItem Value="1929">1929</asp:ListItem>
                                                        </asp:DropDownList></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <asp:Button ID="MomSchSave" runat="server" Text="Save" CssClass="btnStyle" OnClick="SchSave_Click" />
                                                        <input type="hidden" runat="server" id="momSchID" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </div>
                                </p>
                            </fieldset>
                        </div>
                        <div class="accordionHeader" id="accordionHeader7" onclick="javascript:runAccordion(7, 550);">
                            <a href="javascript:void(0);" class="accordionLink">Privacy & Settings</a>
                        </div>
                        <div class="accordionContent" id="accordionContent7" style="display: none">
                            <fieldset>
                                <br />
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <label>
                                                Your name:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyName" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your birthday and age:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyDOB" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your interests:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyInterest" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your education and schools:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyEdu" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your kids' names and gender:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyKids" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your kids' birthdays and ages:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyKidsDOB" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your kids' photos:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyKidsPhoto" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your Kids' "About" statements:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyKidsAbout" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your kids' interests and challenges:</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyKidsInterest" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Your last logged-in date and current logged-in status</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyLogin" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                Who is allowed to see your profile page.</label></td>
                                        <td>
                                            <asp:DropDownList ID="momPrivacyProfile" runat="server" Width="153px">
                                                <asp:ListItem Value="">--Select--</asp:ListItem>
                                            </asp:DropDownList></td>
                                    </tr>
                                </table>
                                <br />
                                <asp:Button ID="momPrivacyButton" runat="server" CssClass="btnStyle" Text="Save"
                                    OnClick="PrivacySave_Click" />
                            </fieldset>
                        </div>
                        <div class="accordionHeader" id="accordionHeader8" onclick="javascript:runAccordion(8, 300);">
                            <a href="javascript:void(0);" class="accordionLink">Blocked Users</a>
                        </div>
                        <div class="accordionContent" id="accordionContent8" style="display: none">
                            <fieldset>
                                <p>
                                    <table width="100%" cellpadding="0" cellspacing="0" id="momBlockUsersTable" runat="server">
                                        <tr bgcolor="gray">
                                            <th width="50%" align="left">
                                                Display Name</th>
                                            <th width="50%">
                                                Delete</th>
                                        </tr>
                                    </table>
                                    <br />
                                    <fieldset>
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    User Display Name:</td>
                                                <td>
                                                    <asp:TextBox ID="BlockUserName" runat="server" MaxLength="50"></asp:TextBox></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <asp:Button ID="BlockUserButton" runat="server" CssClass="btnStyle" Text="Block User"
                                                        OnClick="Block_User_Click" />
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </p>
                            </fieldset>
                        </div>
                        
                    </td>
                    <td width="1%">
                    </td>
                </tr>
            </table>
        </asp:View>
    </asp:MultiView>
    <popUp:momPopup ID="momPopup" runat="server" />
</asp:Content>
<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>
