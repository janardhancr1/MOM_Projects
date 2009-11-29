<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true"
    CodeFile="MOMProfile.aspx.cs" Inherits="MOMProfile_MOMProfile" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
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
                                                        <input type="button" value="Add Child" onclick="javascript:showHideCancel('kidstable',this,1);"
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
                                                </Content>
                                            </cc1:AccordionPane>
                                            <cc1:AccordionPane ID="momEducation" runat="server">
                                                <Header>
                                                    <a href="" class="accordionLink">Education</a></Header>
                                                <Content>
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
                                                            <table width="100%" >
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
                                                            <asp:Button ID="Button1" runat="server" CssClass="btnStyle" Text="Save" OnClick="FavSave_Click" />
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
    <popUp:momPopup ID="momPopup" runat="server" />
</asp:Content>
<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>
