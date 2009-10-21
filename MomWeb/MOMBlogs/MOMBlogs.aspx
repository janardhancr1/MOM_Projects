<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMBlogs.aspx.cs" Inherits="MOMBlogs_MOMBlogs" %>

<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="3" cellspacing="0">
        <tr>
            <td colspan="2">
                <div><a href="MOMCreateBlog.aspx" class="grayHeader">Create Blog</a></div>
            </td>
        </tr>
        <tr>
            <td>
                <asp:GridView ID="momBlogGridview" runat="server"
                AllowPaging="True" AutoGenerateColumns="False" ShowHeader="False"
                BorderWidth="0px" BorderColor="white" Width="100%">
                    <Columns>
                        <asp:TemplateField>
                            <ItemTemplate>
                                <div>
                                    <table width="100%" border="0" cellpadding="5">
                                        <tr>
                                            <td>
                                                <a href="MOMBlogRead.aspx?mBI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString())%>">
                                                    <%# BOMomburbia.MOMHelper.HTMLEncode(BOMomburbia.MOMHelper.BreakText(DataBinder.Eval(Container.DataItem, "TITLE").ToString(), 100))%>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small>
                                                    <%# 
                                                        //BOMomburbia.MOMHelper.HTMLEncode(BOMomburbia.MOMHelper.BreakText(DataBinder.Eval(Container.DataItem, "BLOG").ToString(), 100))
                                                        BOMomburbia.MOMHelper.BreakText(DataBinder.Eval(Container.DataItem, "BLOG").ToString(), 100)
                                                    %>
                                                </small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="momSpacer10px"></div>
                            </ItemTemplate>
                        </asp:TemplateField>
                    </Columns>
                </asp:GridView>
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