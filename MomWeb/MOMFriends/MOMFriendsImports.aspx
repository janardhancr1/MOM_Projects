<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMFriendsImports.aspx.cs" Inherits="MOMFriends_MOMFriendsImports" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <style>
        div.scrollTableContainer 
        {
            border: 1px;
            height: 285px;
            overflow: auto;
            width: 500px;
            margin: 15px 0 0 0;
            position: relative;
        }

    </style>
    <table width="100%">
        <tr>
            <td>
                <div class="momInfo">Inviate your friends</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="styleLine"></div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="momInfo">Web Email<small> (Hotmail, Gmail & Yahoo.) Currently we are supporting only Gmail</small></div>
            </td>
        </tr>
        <tr>
            <td>
                Invite contacts from you email.
            </td>
        </tr>
        <tr>
            <td>
                <asp:Panel ID="momEmailExtractPanel" runat="server">
                     <table>
                        <tr>
                            <td>
                                Your Email:
                            </td>
                            <td>
                                <asp:TextBox ID="momEmailAddress" runat="server" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email Password:
                            </td>
                            <td>
                                 <asp:TextBox ID="momEmailPassword" runat="server" TextMode="password" CssClass="tbSignIn"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <asp:Button ID="momFindFriends" runat="server" CssClass="btnStyle" Text="Find Friends" OnClick="momFindFriends_Click" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <small>Momburbia will not store your password. <a href="#">Learn More</a></small>
                            </td>
                        </tr>
                     </table>
                 </asp:Panel>
            </td>
        </tr>
        <tr>
            <td>
                <div class="scrollTableContainer">
                    <table cellspacing="0" cellpadding="3" width="100%">
                        <asp:Repeater ID="momEmailContactsRepeater" runat="server">
                            <ItemTemplate>
                                <tr style="background:<%# Container.ItemIndex % 2 == 0 ? "MistyRose" : "white" %>;">
                                    <td>
                                        <input type="checkbox" name="momImportedEmailAddress" 
                                            value="<%# DataBinder.Eval(Container.DataItem, "EMAIL")%>"
                                            checked="checked" />
                                        <%# DataBinder.Eval(Container.DataItem, "NAME")%>
                                    </td>
                                    <td>
                                        <%# DataBinder.Eval(Container.DataItem, "EMAIL")%>
                                    </td>
                                </tr>                            
                            </ItemTemplate>
                        </asp:Repeater>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
</asp:Content>