<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMCreateGroup.aspx.cs" Inherits="MOMGroups_MOMCreateGroup" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td>
                <fieldset>
                     <legend class="grayHeader">Create a Group</legend>
                     <table width="100%" cellpadding="3" cellspacing="0">
                        <tr>
                            <td>
                                <div class="momInfo">Group Name:</div><small> (Required)</small>
                            </td>
                            <td>
                                <asp:TextBox ID="momGroupName" runat="server" CssClass="tbSignIn" MaxLength="15"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">Description:</div><small> (Required)</small>
                            </td>
                            <td>
                                <asp:TextBox ID="momGroupDescription" runat="server" TextMode="MultiLine" Rows="4" Columns="50" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">Group Type:</div><small> (Required)</small>
                            </td>
                            <td>
                                <asp:DropDownList ID="momGroupType" runat="server">
                                 <asp:ListItem  Value="0">Select Category:</asp:ListItem>
                                 <asp:ListItem  Value="1">Business</asp:ListItem>
                                 <asp:ListItem  Value="2">Common Interest</asp:ListItem>
                                 <asp:ListItem  Value="4">Entertainment</asp:ListItem>
                                 <asp:ListItem  Value="5">Geography</asp:ListItem>
                                 <asp:ListItem  Value="6">Internet</asp:ListItem>
                                 <asp:ListItem  Value="7">Just for Fun</asp:ListItem>
                                 <asp:ListItem  Value="8">Music</asp:ListItem>
                                 <asp:ListItem  Value="9">Organizations</asp:ListItem>
                                 <asp:ListItem  Value="10">Sports</asp:ListItem>
                                 <asp:ListItem  Value="11">Student Groups</asp:ListItem>                                
                                 </asp:DropDownList>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">Recent News:</div>
                            </td>
                            <td>
                                <asp:TextBox ID="momGroupRecentNews" runat="server" TextMode="MultiLine" Rows="4" Columns="50" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">Office:</div>
                            </td>
                            <td>
                                <asp:TextBox ID="momGroupOffice" runat="server" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">Email</div>
                            </td>
                            <td>
                                <asp:TextBox ID="momGroupEmail" runat="server" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">Street:</div
                            </td>
                            <td>
                                <asp:TextBox ID="momGroupStreet" runat="server" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="momInfo">City/Town:</div>
                            </td>
                            <td>
                                <asp:TextBox ID="momGroupCityTown" runat="server" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <asp:Button ID="momGroupCreate" runat="server" Text="Create Group" CssClass="btnStyle" OnClick="momGroupCreate_Click" />
                                <asp:Button ID="momGroupCancel" runat="server" Text="Cancel" CssClass="btnStyle" OnClick="momGroupCancel_Click" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="styleLine"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">  
                                <small>Note: groups that attack a specific person or group of people (e.g. racist, sexist, or other hate groups) will not be tolerated. Creating such a group will result in the immediate termination of your Momburbia account.</small>
                            </td>
                        </tr>
                     </table>
                </fieldset>
            </td>
        </tr>
    </table>
    <popUp:momPopup ID="momPopup" runat="server" />
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>