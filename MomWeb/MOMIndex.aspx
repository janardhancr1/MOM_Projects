<%@ Page Language="C#" AutoEventWireup="true" CodeFile="MOMIndex.aspx.cs" Inherits="MOMIndex" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
    <title>Momburbia moms Connecting</title>
    <link href="css/MomStyle.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
    <form id="momLoginFrm" runat="server">
    <asp:ScriptManager ID="ScriptManager1" runat="server"/>
    <asp:UpdatePanel ID="UpdatePanel1" runat="server">
    <ContentTemplate>
    <div class="momBrowserSpace">
        <table style="width: 1000px; padding-bottom:0.5pt;" cellspacing="0">
            <tr>
                <td align="right">
                    <table class="momHeaderStyle" cellspacing="0">
                        <tr>
                            <td style="width: 450px;">
                            </td>
                            <td valign="top" style="font-weight: bold;">
                                <asp:CheckBox ID="momRemember" runat="server" Text="Remember Me" />
                            </td> 
                            <td>
                                <asp:TextBox ID="momUserName" runat="server" CssClass="tbStyle"></asp:TextBox>
                                <cc1:TextBoxWatermarkExtender ID="momUserNameExt" runat="server"
                                TargetControlID="momUserName" WatermarkText="Username"></cc1:TextBoxWatermarkExtender>
                            </td>                        
                            <td>
                                <asp:TextBox ID="momPassword" runat="server" CssClass="tbStyle" TextMode="Password"></asp:TextBox>
                                <cc1:TextBoxWatermarkExtender ID="momPasswordExt" runat="server"
                                TargetControlID="momPassword" WatermarkText="Password"></cc1:TextBoxWatermarkExtender>
                            </td>
                            <td>
                                <asp:ImageButton ID="momLogin" runat="server" ImageUrl="~/images/login.gif" OnClick="momLogin_Click" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="middle">
                    <table style="width: 1000px; height: 105px;" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="width: 272px;">
                                <img src="images/logo.gif" width="272" height="90" />
                            </td>
                            <td style="width: 728px;" valign="middle">
                                <iframe id="momHeaderBanner" src="MOMBanners/MOMHeaderBanner.htm" frameborder="0" scrolling="no" width="728" height="92"></iframe>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width:1000px;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width: 478px;">
                                <img src="images/main.jpg" />
                            </td>
                            <td style="width:1px; background-color: MistyRose;">
                            </td>
                            <td valign="top" style="background-color: MistyRose"> 
                                <table style="width: 521px;" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td class="grayHeader" colspan="2" align="left">
                                            Join Momburbia
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt; width: 150px;">First Name:</td>
                                        <td align="left">
                                            <asp:TextBox ID="momFirstName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt;">Last Name:</td>
                                        <td align="left">
                                            <asp:TextBox ID="momLastName" runat="server" CssClass="tbSignIn" MaxLength="50"></asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt;">Your Emails:</td>
                                        <td align="left">
                                            <asp:TextBox ID="momEmail" runat="server" CssClass="tbSignIn" MaxLength="255"></asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt;">New Password:</td>
                                        <td align="left" style="width: 300px;">
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
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt;">Confirm Password:</td>
                                        </td>
                                        <td>
                                            <asp:TextBox ID="momConfirmPass" runat="server" CssClass="tbSignIn" TextMode="Password" MaxLength="15"></asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt;">I am:</td>
                                        <td align="left">
                                            <asp:DropDownList ID="momSex" runat="server" CssClass="tbSignIn">
                                                <asp:ListItem Text="Select Sex" Value="U" Selected="true"></asp:ListItem>
                                                <asp:ListItem Text="Female" Value="F"></asp:ListItem>
                                                <asp:ListItem Text="Male" Value="M"></asp:ListItem>
                                            </asp:DropDownList>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt;">Display Name</td>
                                        <td align="left">
                                            <asp:TextBox ID="momDisplayName" runat="server" CssClass="tbSignIn" MaxLength="25"></asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 8pt; width: 521px;" align="center" colspan="2" align="center">
                                            Your display name is your online identity, so use something you are comfortable with everyone seeing.
                                            Your display name can't be changed, so make sure to type carefully and pick something you love!
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" style="color:#aa3464; font-weight:bold; font-size: 10pt;">Birthday:</td>
                                        <td align="left">
                                            <asp:DropDownList ID="momDOBMonth" runat="server" CssClass="tbSignIn">
                                                <asp:ListItem Text="Month" Value="0" Selected="true"></asp:ListItem>
                                                <asp:ListItem Text="January" Value="01"></asp:ListItem>
                                                <asp:ListItem Text="Feburary" Value="02"></asp:ListItem>
                                                <asp:ListItem Text="March" Value="03"></asp:ListItem>
                                                <asp:ListItem Text="April" Value="04"></asp:ListItem>
                                                <asp:ListItem Text="May" Value="05"></asp:ListItem>
                                                <asp:ListItem Text="June" Value="06"></asp:ListItem>
                                                <asp:ListItem Text="July" Value="07"></asp:ListItem>
                                                <asp:ListItem Text="August" Value="08"></asp:ListItem>
                                                <asp:ListItem Text="September" Value="09"></asp:ListItem>
                                                <asp:ListItem Text="October" Value="12"></asp:ListItem>
                                                <asp:ListItem Text="November" Value="11"></asp:ListItem>
                                                <asp:ListItem Text="December" Value="12"></asp:ListItem>
                                            </asp:DropDownList>
                                            <asp:DropDownList ID="momDOBDay" runat="server" CssClass="tbSignIn">
                                                <asp:ListItem Text="Day" Value="0" Selected="true"></asp:ListItem>
                                                <asp:ListItem Text="01" Value="01"></asp:ListItem>
                                                <asp:ListItem Text="02" Value="02"></asp:ListItem>
                                                <asp:ListItem Text="03" Value="03"></asp:ListItem>
                                                <asp:ListItem Text="04" Value="04"></asp:ListItem>
                                                <asp:ListItem Text="05" Value="05"></asp:ListItem>
                                                <asp:ListItem Text="06" Value="06"></asp:ListItem>
                                                <asp:ListItem Text="07" Value="07"></asp:ListItem>
                                                <asp:ListItem Text="08" Value="08"></asp:ListItem>
                                                <asp:ListItem Text="09" Value="09"></asp:ListItem>
                                                <asp:ListItem Text="10" Value="10"></asp:ListItem>
                                                <asp:ListItem Text="11" Value="11"></asp:ListItem>
                                                <asp:ListItem Text="12" Value="12"></asp:ListItem>
                                                <asp:ListItem Text="13" Value="13"></asp:ListItem>
                                                <asp:ListItem Text="14" Value="14"></asp:ListItem>
                                                <asp:ListItem Text="15" Value="15"></asp:ListItem>
                                                <asp:ListItem Text="16" Value="16"></asp:ListItem>
                                                <asp:ListItem Text="17" Value="17"></asp:ListItem>
                                                <asp:ListItem Text="18" Value="18"></asp:ListItem>
                                                <asp:ListItem Text="19" Value="19"></asp:ListItem>
                                                <asp:ListItem Text="20" Value="20"></asp:ListItem>
                                                <asp:ListItem Text="21" Value="21"></asp:ListItem>
                                                <asp:ListItem Text="22" Value="22"></asp:ListItem>
                                                <asp:ListItem Text="23" Value="23"></asp:ListItem>
                                                <asp:ListItem Text="24" Value="24"></asp:ListItem>
                                                <asp:ListItem Text="25" Value="25"></asp:ListItem>
                                                <asp:ListItem Text="26" Value="26"></asp:ListItem>
                                                <asp:ListItem Text="27" Value="27"></asp:ListItem>
                                                <asp:ListItem Text="28" Value="28"></asp:ListItem>
                                                <asp:ListItem Text="29" Value="29"></asp:ListItem>
                                                <asp:ListItem Text="30" Value="30"></asp:ListItem>
                                                <asp:ListItem Text="31" Value="31"></asp:ListItem>
                                            </asp:DropDownList>
                                            <asp:DropDownList ID="momDOBYear" runat="server" CssClass="tbSignIn">
                                                <asp:ListItem Text="Year" Value="-111" Selected="true"></asp:ListItem>
                                                <asp:ListItem Text="1995" Value="1995"></asp:ListItem>
                                                <asp:ListItem Text="1994" Value="1994"></asp:ListItem>
                                                <asp:ListItem Text="1993" Value="1993"></asp:ListItem>
                                                <asp:ListItem Text="1992" Value="1992"></asp:ListItem>
                                                <asp:ListItem Text="1991" Value="1991"></asp:ListItem>
                                                <asp:ListItem Text="1990" Value="1990"></asp:ListItem>
                                                <asp:ListItem Text="1989" Value="1989"></asp:ListItem>
                                                <asp:ListItem Text="1988" Value="1988"></asp:ListItem>
                                                <asp:ListItem Text="1987" Value="1987"></asp:ListItem>
                                                <asp:ListItem Text="1986" Value="1986"></asp:ListItem>
                                                <asp:ListItem Text="1985" Value="1985"></asp:ListItem>
                                                <asp:ListItem Text="1984" Value="1984"></asp:ListItem>
                                                <asp:ListItem Text="1983" Value="1983"></asp:ListItem>
                                                <asp:ListItem Text="1982" Value="1982"></asp:ListItem>
                                                <asp:ListItem Text="1981" Value="1981"></asp:ListItem>
                                                <asp:ListItem Text="1980" Value="1980"></asp:ListItem>
                                                <asp:ListItem Text="1979" Value="1979"></asp:ListItem>
                                                <asp:ListItem Text="1978" Value="1978"></asp:ListItem>
                                                <asp:ListItem Text="1977" Value="1977"></asp:ListItem>
                                                <asp:ListItem Text="1976" Value="1976"></asp:ListItem>
                                                <asp:ListItem Text="1975" Value="1975"></asp:ListItem>
                                                <asp:ListItem Text="1974" Value="1974"></asp:ListItem>
                                                <asp:ListItem Text="1973" Value="1973"></asp:ListItem>
                                                <asp:ListItem Text="1972" Value="1972"></asp:ListItem>
                                                <asp:ListItem Text="1971" Value="1971"></asp:ListItem>
                                                <asp:ListItem Text="1970" Value="1970"></asp:ListItem>
                                                <asp:ListItem Text="1969" Value="1969"></asp:ListItem>
                                                <asp:ListItem Text="1968" Value="1968"></asp:ListItem>
                                                <asp:ListItem Text="1967" Value="1967"></asp:ListItem>
                                                <asp:ListItem Text="1966" Value="1966"></asp:ListItem>
                                                <asp:ListItem Text="1965" Value="1965"></asp:ListItem>
                                                <asp:ListItem Text="1964" Value="1964"></asp:ListItem>
                                                <asp:ListItem Text="1963" Value="1963"></asp:ListItem>
                                                <asp:ListItem Text="1962" Value="1962"></asp:ListItem>
                                                <asp:ListItem Text="1961" Value="1961"></asp:ListItem>
                                                <asp:ListItem Text="1960" Value="1960"></asp:ListItem>
                                                <asp:ListItem Text="1959" Value="1959"></asp:ListItem>
                                                <asp:ListItem Text="1958" Value="1958"></asp:ListItem>
                                                <asp:ListItem Text="1957" Value="1957"></asp:ListItem>
                                                <asp:ListItem Text="1956" Value="1956"></asp:ListItem>
                                                <asp:ListItem Text="1955" Value="1955"></asp:ListItem>
                                                <asp:ListItem Text="1954" Value="1954"></asp:ListItem>
                                                <asp:ListItem Text="1953" Value="1953"></asp:ListItem>
                                                <asp:ListItem Text="1952" Value="1952"></asp:ListItem>
                                                <asp:ListItem Text="1951" Value="1951"></asp:ListItem>
                                                <asp:ListItem Text="1950" Value="1950"></asp:ListItem>
                                                <asp:ListItem Text="1949" Value="1949"></asp:ListItem>
                                                <asp:ListItem Text="1948" Value="1948"></asp:ListItem>
                                                <asp:ListItem Text="1947" Value="1947"></asp:ListItem>
                                                <asp:ListItem Text="1946" Value="1946"></asp:ListItem>
                                                <asp:ListItem Text="1945" Value="1945"></asp:ListItem>
                                                <asp:ListItem Text="1944" Value="1944"></asp:ListItem>
                                                <asp:ListItem Text="1943" Value="1943"></asp:ListItem>
                                                <asp:ListItem Text="1942" Value="1942"></asp:ListItem>
                                                <asp:ListItem Text="1941" Value="1941"></asp:ListItem>
                                                <asp:ListItem Text="1940" Value="1940"></asp:ListItem>
                                                <asp:ListItem Text="1939" Value="1939"></asp:ListItem>
                                                <asp:ListItem Text="1938" Value="1938"></asp:ListItem>
                                                <asp:ListItem Text="1937" Value="1937"></asp:ListItem>
                                                <asp:ListItem Text="1936" Value="1936"></asp:ListItem>
                                                <asp:ListItem Text="1935" Value="1935"></asp:ListItem>
                                                <asp:ListItem Text="1934" Value="1934"></asp:ListItem>
                                                <asp:ListItem Text="1933" Value="1933"></asp:ListItem>
                                                <asp:ListItem Text="1932" Value="1932"></asp:ListItem>
                                                <asp:ListItem Text="1931" Value="1931"></asp:ListItem>
                                                <asp:ListItem Text="1930" Value="1930"></asp:ListItem>
                                                <asp:ListItem Text="1929" Value="1929"></asp:ListItem>
                                                <asp:ListItem Text="1928" Value="1928"></asp:ListItem>
                                                <asp:ListItem Text="1927" Value="1927"></asp:ListItem>
                                                <asp:ListItem Text="1926" Value="1926"></asp:ListItem>
                                                <asp:ListItem Text="1925" Value="1925"></asp:ListItem>
                                            </asp:DropDownList>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 8pt;" align="center" colspan="2" align="center">
                                            We won't show your age or birthday to anyone unless you want us to!
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td align="right"> <asp:CheckBox ID="momAgreement" runat="server" /></td>
                                        <td>
                                            I agree to Momburbia <a href="MOMIndex.aspx">Terms of service</a>
                                        </td>
                                    </tr>
                                    <tr style="width: 521px;">   
                                        <td align="right"><asp:CheckBox ID="momEmails" runat="server" /></td>
                                        <td>
                                            Send me email updates about messages I've received on the site, my friends' activities, and the latest news from The Momburbia Team
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" colspan="2">
                                            <asp:Button ID="momAddUser" Text="Sign Up" runat="server" CssClass="btnStyle" OnClick="momAddUser_Click" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: Red; font-size: 10pt; height: 30px;" colspan="2" align="center">
                                            <asp:Label ID="momInfo" runat="server" Text=""></asp:Label>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td style="width: 1000px;">
                <hr />
                Momburbia &copy; 2009    
                </td>
            </tr>
        </table>        
    </div>
    </ContentTemplate>
    </asp:UpdatePanel>
    </form>
    <script type="text/javascript">
    
        with(Sys.WebForms.PageRequestManager.getInstance()) 
        {
            add_endRequest(onEndRequest);
        }
        
        function onEndRequest(sender, args)
        {
            $get('momHeaderBanner').src = $get('momHeaderBanner').src;
        }
    
    </script>
</body>
</html>
