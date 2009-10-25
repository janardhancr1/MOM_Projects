<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMGroups.aspx.cs" Inherits="MOMGroups_MOMGroups" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="3" cellspacing="0">
        <tr>
            <td colspan="2">
                <div class="grayHeader"><a href="MOMCreateGroup.aspx">Create Groups</a></div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="border: 1px solid pink; width: 335px;">
                    <table width="100%">
                        <tr>
                            <td class="grayHeader" style="height: 25px;">Recently joined by your friends</td>
                        </tr>
                        <tr>
                            <td><div class="styleLine"></div></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%">
                                <asp:Repeater ID="momFriendsGroups" runat="server">
                                    <ItemTemplate>
                                        <tr>
                                            <td style="width: 100px">
                                                <img src="../images/s_default.jpg" width="100px" />
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="MOMGroup.aspx?mGi=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "GRP_MOM_USR_ID").ToString()) %>">
                                                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "MOM_GRP_NAME").ToString())%>
                                                    </a>
                                                </div>
                                                <div class="momSpacer5px"></div>
                                                <div>
                                                    <small>
                                                        <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DESCRIPTION").ToString()), 45)%> 
                                                    </small>
                                                </div>
                                                <div class="momSpacer5px"></div>
                                                <div>
                                                    <small>
                                                        Size <%# DataBinder.Eval(Container.DataItem, "MEMBERS") %> members
                                                    </small>
                                                </div>
                                                <div class="momSpacer5px"></div>
                                                <div>
                                                    <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">
                                                        <%# DataBinder.Eval(Container.DataItem, "MOM_USR_NAME") %>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><div class="styleLine"></div></td>
                                        </tr>
                                    </ItemTemplate>
                                 </asp:Repeater>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div style="border: 1px solid pink;  width: 335px;">
                    <table width="100%">
                        <tr>
                            <td class="grayHeader" style="height: 25px;">Your recently updated groups</td>
                        </tr>
                        <tr>
                            <td><div class="styleLine"></div></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%">
                                    <asp:Repeater ID="momYourGroups" runat="server">
                                        <ItemTemplate>
                                            <tr>
                                                <td style="width: 100px">
                                                    <img src="../images/s_default.jpg" width="100px" />
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="MOMGroup.aspx?mGi=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "GRP_MOM_USR_ID").ToString()) %>">
                                                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "NAME").ToString()) %>
                                                        </a>
                                                    </div>
                                                    <div class="momSpacer5px"></div>
                                                    <div>
                                                        <small>
                                                             <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DESCRIPTION").ToString()), 45)%> 
                                                        </small>
                                                    </div>
                                                    <div class="momSpacer5px"></div>
                                                    <div>
                                                        <small>
                                                            Size <%# DataBinder.Eval(Container.DataItem, "MEMBERS") %> members
                                                        </small>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><div class="styleLine"></div></td>
                                            </tr>
                                        </ItemTemplate>
                                    </asp:Repeater>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>
