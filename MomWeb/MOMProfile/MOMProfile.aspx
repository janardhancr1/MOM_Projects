<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true"
    CodeFile="MOMProfile.aspx.cs" Inherits="MOMProfile_MOMProfile" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>
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
        </asp:View>
        <asp:View ID="ViewInfo" runat="server">
            <div class="almtopnav">
                <ul>
                    <li><a id="A3" runat="server" href="#" class="unselected" name="0" onserverclick="ChangeMenu">
                        Wall</a> </li>
                    <li class="selectedtab"><a id="A4" runat="server" href="#" class="homeon" name="1"
                        onserverclick="ChangeMenu">Info</a> </li>
                </ul>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td>
                        <table width="98%" cellpadding="5" cellspacing="0">
                            <tr>
                                <td align="left" style="font-size: larger; font-weight: bolder; color: Gray;">
                                    Click on a profile section below to edit it.
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <cc1:Accordion ID="momProfileAccordion" runat="server" SelectedIndex="0" HeaderCssClass="accordionHeader"
                                        HeaderSelectedCssClass="accordionHeaderSelected" ContentCssClass="accordionContent"
                                        FadeTransitions="true" FramesPerSecond="40" TransitionDuration="250" AutoSize="None"
                                        RequireOpenedPane="false" SuppressHeaderPostbacks="true">
                                        <Panes>
                                            <cc1:AccordionPane ID="accordionLink" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Your Basics</a></Header>
                                                <Content>
                                                    <table width="400" cellpadding="1" cellspacing="0">
                                                        <tr>
                                                            <td align="right">
                                                                <div class="momInfo">
                                                                    First Name:</div>
                                                            </td>
                                                            <td align="left">
                                                                <asp:TextBox ID="momFirstName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">
                                                                <div class="momInfo">
                                                                    Last Name:</div>
                                                            </td>
                                                            <td align="left">
                                                                <asp:TextBox ID="momLastName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">
                                                                <div class="momInfo">
                                                                    Your Email:</div>
                                                            </td>
                                                            <td align="left">
                                                                <asp:TextBox ID="momEmail" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">
                                                                <div class="momInfo">
                                                                    New Password:</div>
                                                            </td>
                                                            <td align="left">
                                                                <asp:TextBox ID="momPass" runat="server" CssClass="tbSignIn" TextMode="Password"
                                                                    MaxLength="15"></asp:TextBox>
                                                                <cc1:PasswordStrength ID="momPassExt" runat="server" TargetControlID="momPass" DisplayPosition="RightSide"
                                                                    StrengthIndicatorType="Text" PrefixText="Strength:" TextStrengthDescriptions="Very Poor;Weak;Average;Strong;Excellent"
                                                                    StrengthStyles="TextIndicator_Strength1;TextIndicator_Strength2;TextIndicator_Strength3;TextIndicator_Strength4;TextIndicator_Strength5"
                                                                    MinimumNumericCharacters="0" MinimumSymbolCharacters="0" TextCssClass="passInfoStyle"
                                                                    RequiresUpperAndLowerCaseCharacters="false" />
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
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">
                                                                <div class="momInfo">
                                                                    Zipcode / Postal code:</div>
                                                            </td>
                                                            <td align="left">
                                                                <asp:TextBox ID="momZipCode" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">
                                                                <div class="momInfo">
                                                                    Location:</div>
                                                            </td>
                                                            <td align="left">
                                                                <asp:TextBox ID="momLocation" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
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
                                                    </table>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momPhotoAvtar" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Photo / Avtar</a>
                                                </Header>
                                                <Content>
                                                    <table width="400" cellpadding="1" cellspacing="0">
                                                        <tr>
                                                            <td>
                                                                Select Photo:
                                                                <asp:FileUpload ID="PhotoUpload" runat="server" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <asp:Button ID="UploadButton" CssClass="btnStyle" runat="server" Text="Upload" /></td>
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
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(0); return(false);">
                                                                                <img id="avatarImg_0" src="../images/profile/avatar_0_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_1" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(1); return(false);">
                                                                                <img id="avatarImg_1" src="../images/profile/avatar_1_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_2" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(2); return(false);">
                                                                                <img id="avatarImg_2" src="../images/profile/avatar_2_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_3" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(3); return(false);">
                                                                                <img id="avatarImg_3" src="../images/profile/avatar_3_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_4" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(4); return(false);">
                                                                                <img id="avatarImg_4" src="../images/profile/avatar_4_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_5" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(5); return(false);">
                                                                                <img id="avatarImg_5" src="../images/profile/avatar_5_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_6" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(6); return(false);">
                                                                                <img id="avatarImg_6" src="../images/profile/avatar_6_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_7" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(7); return(false);">
                                                                                <img id="avatarImg_7" src="../images/profile/avatar_7_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_8" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(8); return(false);">
                                                                                <img id="avatarImg_8" src="../images/profile/avatar_8_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_9" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(9); return(false);">
                                                                                <img id="avatarImg_9" src="../images/profile/avatar_9_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_10" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(10); return(false);">
                                                                                <img id="avatarImg_10" src="../images/profile/avatar_10_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_11" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(11); return(false);">
                                                                                <img id="avatarImg_11" src="../images/profile/avatar_11_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_12" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(12); return(false);">
                                                                                <img id="avatarImg_12" src="../images/profile/avatar_12_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_13" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(13); return(false);">
                                                                                <img id="avatarImg_13" src="../images/profile/avatar_13_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_14" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(14); return(false);">
                                                                                <img id="avatarImg_14" src="../images/profile/avatar_14_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_15" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(15); return(false);">
                                                                                <img id="avatarImg_15" src="../images/profile/avatar_15_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_16" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(16); return(false);">
                                                                                <img id="avatarImg_16" src="../images/profile/avatar_16_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_17" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(17); return(false);">
                                                                                <img id="avatarImg_17" src="../images/profile/avatar_17_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_18" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(18); return(false);">
                                                                                <img id="avatarImg_18" src="../images/profile/avatar_18_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_19" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(19); return(false);">
                                                                                <img id="avatarImg_19" src="../images/profile/avatar_19_md.jpg"
                                                                                    alt="avatar" /></a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momKids" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Kids</a></Header>
                                                <Content>
                                                    <p>
                                                        It also supports three AutoSize modes so it can fit in a variety of layouts.</p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momInterests" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Interests</a></Header>
                                                <Content>
                                                    <p>
                                                        It also supports three AutoSize modes so it can fit in a variety of layouts.</p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momFavorites" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Favorites</a></Header>
                                                <Content>
                                                    <p>
                                                        It also supports three AutoSize modes so it can fit in a variety of layouts.</p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momEducation" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Education</a></Header>
                                                <Content>
                                                    <p>
                                                        It also supports three AutoSize modes so it can fit in a variety of layouts.</p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momPrivacySettings" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Privacy & Settings</a></Header>
                                                <Content>
                                                    <p>
                                                        It also supports three AutoSize modes so it can fit in a variety of layouts.</p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momBlockedUsers" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Blocked Users</a></Header>
                                                <Content>
                                                    <p>
                                                        It also supports three AutoSize modes so it can fit in a variety of layouts.</p>
                                                </Content>
                                            </cc1:AccordionPane>
                                        </Panes>
                                    </cc1:Accordion>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </asp:View>
    </asp:MultiView>
</asp:Content>
<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>
