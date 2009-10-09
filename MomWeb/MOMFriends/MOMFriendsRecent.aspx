<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true" CodeFile="MOMFriendsRecent.aspx.cs" Inherits="MOMFriends_MOMRecent" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
</asp:Content>

<asp:Content ContentPlaceHolderID="momCenter" ID="momCenterContent" runat="server">
    <table width="100%" cellpadding="4">
        <tr>
            <td style="text-align: center;">
                This filter shows people that you have recently added as friends. When you add new friends, they will appear here for two weeks.
            </td>
        </tr>
        <tr>
            <td>
                <asp:GridView ID="momUserFriends" runat="server" AllowPaging="True" AutoGenerateColumns="False" ShowHeader="False"
                BorderWidth="0px" Width="100%" BorderColor="white">
                    <PagerSettings Mode="NextPreviousFirstLast"/>
                    <Columns>
                        <asp:TemplateField>
                            <ItemTemplate>
                                <table width="100%">
                                    <tr>
                                        <td style="width: 60px;">
                                            <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">
                                                <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" width="50" height="50" />
                                            </a>
                                        </td>
                                        <td>
                                            <div style="font-weight: bold;">
                                                <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">
                                                    <%# DataBinder.Eval(Container.DataItem, "FULL_NAME") %>
                                                </a>
                                            </div>
                                            <div><small>
                                                <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">
                                                    (<%# DataBinder.Eval(Container.DataItem, "DISPLAY_NAME") %>)
                                                </a></small>
                                            </div>
                                        </td>
                                        <td style="width: 60px; background-color: MistyRose;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="momSpacer5px"></div>
                                            <div class="styleLine"></div>
                                        </td>
                                    </tr>
                                </table>
                            </ItemTemplate>
                        </asp:TemplateField>
                    </Columns>
                </asp:GridView>
                <asp:ObjectDataSource ID="momDataSource" runat="server"></asp:ObjectDataSource>
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
</asp:Content>
