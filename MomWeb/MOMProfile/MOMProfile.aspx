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
                                        RequireOpenedPane="false" SuppressHeaderPostbacks="true" OnLoad="Kids_Load">
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
                                                                                <img id="avatarImg_0" src="../images/profile/avatar_0_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_1" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(1); return(false);">
                                                                                <img id="avatarImg_1" src="../images/profile/avatar_1_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_2" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(2); return(false);">
                                                                                <img id="avatarImg_2" src="../images/profile/avatar_2_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_3" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(3); return(false);">
                                                                                <img id="avatarImg_3" src="../images/profile/avatar_3_md.jpg" alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_4" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(4); return(false);">
                                                                                <img id="avatarImg_4" src="../images/profile/avatar_4_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_5" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(5); return(false);">
                                                                                <img id="avatarImg_5" src="../images/profile/avatar_5_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_6" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(6); return(false);">
                                                                                <img id="avatarImg_6" src="../images/profile/avatar_6_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_7" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(7); return(false);">
                                                                                <img id="avatarImg_7" src="../images/profile/avatar_7_md.jpg" alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_8" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(8); return(false);">
                                                                                <img id="avatarImg_8" src="../images/profile/avatar_8_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_9" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(9); return(false);">
                                                                                <img id="avatarImg_9" src="../images/profile/avatar_9_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_10" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(10); return(false);">
                                                                                <img id="avatarImg_10" src="../images/profile/avatar_10_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_11" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(11); return(false);">
                                                                                <img id="avatarImg_11" src="../images/profile/avatar_11_md.jpg" alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_12" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(12); return(false);">
                                                                                <img id="avatarImg_12" src="../images/profile/avatar_12_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_13" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(13); return(false);">
                                                                                <img id="avatarImg_13" src="../images/profile/avatar_13_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_14" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(14); return(false);">
                                                                                <img id="avatarImg_14" src="../images/profile/avatar_14_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_15" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(15); return(false);">
                                                                                <img id="avatarImg_15" src="../images/profile/avatar_15_md.jpg" alt="avatar" /></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" id="avatar_16" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(16); return(false);">
                                                                                <img id="avatarImg_16" src="../images/profile/avatar_16_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_17" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(17); return(false);">
                                                                                <img id="avatarImg_17" src="../images/profile/avatar_17_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_18" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(18); return(false);">
                                                                                <img id="avatarImg_18" src="../images/profile/avatar_18_md.jpg" alt="avatar" /></a></td>
                                                                        <td align="center" id="avatar_19" class="unselected">
                                                                            <a class="avatarListItem" href="#" onclick="selectAvatar(19); return(false);">
                                                                                <img id="avatarImg_19" src="../images/profile/avatar_19_md.jpg" alt="avatar" /></a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momKidsPane" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Kids</a></Header>
                                                <Content>
                                                    <p>
                                                        <asp:GridView ID="momKidsGrid" runat="server" AutoGenerateColumns="False" Width="100%"
                                                            AllowPaging="False" AllowSorting="False" BorderWidth="0" Visible="false" PageSize="20">
                                                            <HeaderStyle CssClass="nav_header" HorizontalAlign="Left" />
                                                            <EmptyDataTemplate>
                                                                <table width="100%" cellpadding="0" cellspacing="0">
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
                                                            </EmptyDataTemplate>
                                                            <Columns>
                                                                <asp:BoundField DataField="KID_FIRST_NAME" HeaderText="Name" />
                                                                <asp:BoundField DataField="KID_GENDER" HeaderText="Gender" />
                                                                <asp:BoundField DataField="KID_DOB" HeaderText="Birthday" />
                                                            </Columns>
                                                        </asp:GridView>
                                                        <br />
                                                        <asp:Button ID="AddChildButton" runat="server" Text="Add Child" CssClass="btnStyle"
                                                            OnClick="AddChild_Click" />
                                                    </p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momInterests" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Interests</a></Header>
                                                <Content>
                                                    <p>
                                                        <div>
                                                            Add your interests here:</div>
                                                        <div>
                                                            <textarea id="momUserInterests" runat="server" cols="80" rows="5"></textarea>
                                                        </div>
                                                    </p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momFavorites" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Favorites</a></Header>
                                                <Content>
                                                    <p>
                                                        A few of your favorite things</p>
                                                    <div>
                                                        <div>
                                                            Favorite Celebs:</div>
                                                        <div>
                                                            <textarea id="Textarea1" runat="server" cols="80" rows="2"></textarea>
                                                        </div>
                                                        <div>
                                                            Favorite Movies:</div>
                                                        <div>
                                                            <textarea id="Textarea2" runat="server" cols="80" rows="2"></textarea>
                                                        </div>
                                                        <div>
                                                            Favorite TV Shows:</div>
                                                        <div>
                                                            <textarea id="Textarea3" runat="server" cols="80" rows="2"></textarea>
                                                        </div>
                                                        <div>
                                                            Favorite Books:</div>
                                                        <div>
                                                            <textarea id="Textarea4" runat="server" cols="80" rows="2"></textarea>
                                                        </div>
                                                        <div>
                                                            Favorite Music:</div>
                                                        <div>
                                                            <textarea id="Textarea5" runat="server" cols="80" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momEducation" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Education</a></Header>
                                                <Content>
                                                    <p>
                                                        <h5>
                                                            Add/Edit Schools</h5>
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr bgcolor="gray">
                                                                <th width="40%" align="left">
                                                                    Name</th>
                                                                <th width="15%" align="left">
                                                                    Type</th>
                                                                <th width="15%" align="left">
                                                                    Start</th>
                                                                <th width="2015%" align="left">
                                                                    End</th>
                                                                <th width="15%">
                                                                    Edit/Delete</th>
                                                            </tr>
                                                        </table>
                                                        <asp:Repeater ID="Repeater1" runat="server">
                                                            <HeaderTemplate>
                                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                                    <tr bgcolor="gray">
                                                                        <th width="40%" align="left">
                                                                            Name</th>
                                                                        <th width="15%" align="left">
                                                                            Type</th>
                                                                        <th width="15%" align="left">
                                                                            Start</th>
                                                                        <th width="2015%" align="left">
                                                                            End</th>
                                                                        <th width="15%">
                                                                            Edit/Delete</th>
                                                                    </tr>
                                                            </HeaderTemplate>
                                                            <ItemTemplate>
                                                                <tr>
                                                                    <td>
                                                                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "NAME").ToString())%>
                                                                    </td>
                                                                    <td>
                                                                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "BIRTHDAY").ToString()) %>
                                                                    </td>
                                                                    <td>
                                                                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "GENDER").ToString()) %>
                                                                    </td>
                                                                    <td align="center">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <hr />
                                                                    </td>
                                                                </tr>
                                                            </ItemTemplate>
                                                            <FooterTemplate>
                                                                </table>
                                                            </FooterTemplate>
                                                        </asp:Repeater>
                                                        <br />
                                                        <input type="button" value="Add a School" class="btnStyle" /></p>
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momPrivacySettings" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Privacy & Settings</a></Header>
                                                <Content>
                                                    <div>
                                                        <fieldset>
                                                            <div class="formOption">
                                                                <label>
                                                                    Your name:</label>
                                                                <asp:DropDownList ID="NameSearch" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">Searchable</asp:ListItem>
                                                                    <asp:ListItem Value="">Not Searchable</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your birthday and age:</label>
                                                                <asp:DropDownList ID="DropDownList1" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your interests:</label>
                                                                <asp:DropDownList ID="DropDownList2" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your education and schools:</label>
                                                                <asp:DropDownList ID="DropDownList3" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your kids' names and gender:</label>
                                                                <asp:DropDownList ID="DropDownList4" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your kids' birthdays and ages:</label>
                                                                <asp:DropDownList ID="DropDownList5" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your kids' photos:</label>
                                                                <asp:DropDownList ID="DropDownList6" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your Kids' "About" statements:</label>
                                                                <asp:DropDownList ID="DropDownList7" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your kids' interests and challenges:</label>
                                                                <asp:DropDownList ID="DropDownList8" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Your last logged-in date and current logged-in status</label>
                                                                <asp:DropDownList ID="DropDownList9" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">All</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends</asp:ListItem>
                                                                    <asp:ListItem Value="">Private</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                            <div class="formOption">
                                                                <label>
                                                                    Who is allowed to see your profile page.</label>
                                                                <asp:DropDownList ID="DropDownList10" runat="server" Width="153px">
                                                                    <asp:ListItem Value="">Everyone</asp:ListItem>
                                                                    <asp:ListItem Value="">MOM Members Only</asp:ListItem>
                                                                    <asp:ListItem Value="">Friends Only</asp:ListItem>
                                                                </asp:DropDownList></div>
                                                            <br />
                                                        </fieldset>
                                                    </div>
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
