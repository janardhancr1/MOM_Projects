<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMBlogRead.aspx.cs" Inherits="MOMBlogs_MOMBlogRead" %>

<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="3" cellspacing="0">
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <asp:Label ID="momBlogTitle" runat="server"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="momBlogContent" runat="server"></asp:Label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <asp:Repeater ID="momBlogCommentRpt" runat="server">
            <ItemTemplate>
                <tr>
                    <td>
                        <table width="100%" cellpadding="3">
                            <tr>
                                <td rowspan="2" width="10%">
                                    <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" width="40" height="40" />
                                </td>
                            </tr>
                            <tr>
                                <td width="90%">
                                    <div>
                                        <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "COMMENTS").ToString()), 80)%>
                                    </div>
                                    <div class="momSpacer10px"></div>
                                    <div>
                                        <small>
                                            By&nbsp;-&nbsp; <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">
                                            <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString()) %></a>
                                            &nbsp;-&nbsp;<%# DataBinder.Eval(Container.DataItem, "TIME")%>
                                            
                                        </small>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </ItemTemplate>
        </asp:Repeater>
        <tr>
            <td>
                <asp:TextBox ID="momCommentText" runat="server" TextMode="multiLine" MaxLength="1000"
                                    Rows="5" Columns="80"></asp:TextBox>
                <asp:TextBox ID="momBlogRemId" runat="server" Visible="false"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                <asp:Button ID="momSubmitComment" Text="Submit" CssClass="btnStyle" runat="server" OnClick="momSubmitComment_Click" />
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
