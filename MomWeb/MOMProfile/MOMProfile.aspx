<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true" CodeFile="MOMProfile.aspx.cs" Inherits="MOMProfile_MOMProfile" %>

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
                            <cc1:Accordion ID="momProfileAccordion" runat="server" SelectedIndex="0" 
                            HeaderCssClass="accordionHeader" HeaderSelectedCssClass="accordionHeaderSelected"
                            ContentCssClass="accordionContent" FadeTransitions="true" FramesPerSecond="40" 
                            TransitionDuration="250" AutoSize="None" RequireOpenedPane="false" SuppressHeaderPostbacks="true">
                                <Panes>
                                    <cc1:AccordionPane ID="accordionLink" runat="server">
                                        <Header><a href="" class="accordionLink">Your Basics</a></Header>
                                        <Content>
                                            <table width="400" cellpadding="1" cellspacing="0">
                                                <tr>
                                                    <td align="right"><div class="momInfo">First Name:</div></td>
                                                    <td align="left">
                                                        <asp:TextBox ID="momFirstName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                                     </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">Last Name:</div></td>
                                                    <td align="left">
                                                        <asp:TextBox ID="momLastName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">Your Email:</div></td>
                                                    <td align="left">
                                                        <asp:TextBox ID="momEmail" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">New Password:</div></td>
                                                    <td align="left">
                                                        <asp:TextBox ID="momPass" runat="server" CssClass="tbSignIn" TextMode="Password" MaxLength="15"></asp:TextBox>
                                                        <cc1:PasswordStrength ID="momPassExt" runat="server" TargetControlID="momPass"
                                                            DisplayPosition="RightSide"
                                                            StrengthIndicatorType="Text"
                                                            PrefixText="Strength:"
                                                            TextStrengthDescriptions="Very Poor;Weak;Average;Strong;Excellent"
                                                            StrengthStyles="TextIndicator_Strength1;TextIndicator_Strength2;TextIndicator_Strength3;TextIndicator_Strength4;TextIndicator_Strength5"
                                                            MinimumNumericCharacters="0"
                                                            MinimumSymbolCharacters="0"
                                                            TextCssClass="passInfoStyle"
                                                            RequiresUpperAndLowerCaseCharacters="false"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">
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
                                                    <td align="right"><div class="momInfo">
                                                        Zipcode / Postal code:</div>
                                                    </td>
                                                    <td align="left">
                                                        <asp:TextBox ID="momZipCode" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">Location:</div>
                                                    </td>
                                                    <td align="left">
                                                        <asp:TextBox ID="momLocation" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">Display Name:</div>
                                                    </td>
                                                    <td align="left">
                                                        <asp:Label ID="momDisplayName" runat="server"></asp:Label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">Personal URL:</div>
                                                    </td>
                                                    <td align="left">
                                                        <asp:Label ID="momPersonalURL" runat="server"></asp:Label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><div class="momInfo">Member Since:
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
                                            <p>It also supports three AutoSize modes so it can fit in a variety of layouts.</p>                                
                                        </Content>
                                    </cc1:AccordionPane>
                                    <cc1:AccordionPane ID="momKids" runat="server">
                                        <Header><a href="" class="accordionLink">Kids</a></Header>
                                        <Content>
                                            <p>It also supports three AutoSize modes so it can fit in a variety of layouts.</p>                                
                                        </Content>
                                    </cc1:AccordionPane>
                                    <cc1:AccordionPane ID="momInterests" runat="server">
                                        <Header><a href="" class="accordionLink">Interests</a></Header>
                                        <Content>
                                            <p>It also supports three AutoSize modes so it can fit in a variety of layouts.</p>                                
                                        </Content>
                                    </cc1:AccordionPane>
                                    <cc1:AccordionPane ID="momFavorites" runat="server">
                                        <Header><a href="" class="accordionLink">Favorites</a></Header>
                                        <Content>
                                            <p>It also supports three AutoSize modes so it can fit in a variety of layouts.</p>                                
                                        </Content>
                                    </cc1:AccordionPane>
                                    <cc1:AccordionPane ID="momEducation" runat="server">
                                        <Header><a href="" class="accordionLink">Education</a></Header>
                                        <Content>
                                            <p>It also supports three AutoSize modes so it can fit in a variety of layouts.</p>                                
                                        </Content>
                                    </cc1:AccordionPane>
                                    <cc1:AccordionPane ID="momPrivacySettings" runat="server">
                                        <Header><a href="" class="accordionLink">Privacy & Settings</a></Header>
                                        <Content>
                                            <p>It also supports three AutoSize modes so it can fit in a variety of layouts.</p>                                
                                        </Content>
                                    </cc1:AccordionPane>
                                    <cc1:AccordionPane ID="momBlockedUsers" runat="server">
                                        <Header><a href="" class="accordionLink">Blocked Users</a></Header>
                                        <Content>
                                            <p>It also supports three AutoSize modes so it can fit in a variety of layouts.</p>                                
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
</asp:Content>
<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>
