<%@ Control Language="C#" AutoEventWireup="true" CodeFile="MOMRecipeSearchControl.ascx.cs"
    Inherits="MOMRecipe_MOMRecipeSearchControl" %>
<asp:Repeater ID="momRcpRpt" runat="server">
    <HeaderTemplate>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr bgcolor="gray">
                <th width="30%">
                    &nbsp;</th>
                <th width="30%" align="left">
                    Recipe</th>
                <th width="20%" align="left">
                    Cooking Time</th>
                <th width="20%">
                    Rating</th>
            </tr>
    </HeaderTemplate>
    <ItemTemplate>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            <img src="<%# DataBinder.Eval(Container.DataItem, "PHOTO") %>" width="40" height="40" /></td>
                    </tr>
                </table>
            </td>
            <td>
                <div>
                    <a href="../MOMRecipe/MOMRecipeDefault.aspx?mrcpid=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "NAME").ToString()) %>
                    </a>
                </div>
                <div>
                    <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DESCRIPTION").ToString()), 80)%>
                </div>
                <div>
                    Submitted by:
                    <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "SUBMITTEDBY").ToString()) %>
                </div>
            </td>
            <td>
                <div>
                    <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "COOKINGTIME").ToString()) %>
                </div>
            </td>
            <td>
                <div>
                <center>
                <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "RATINGPHOTO").ToString())%>
                <br />
                <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "RATINGS").ToString()) %>
                </center>
                </div>
                <div>
                    <center>
                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "VIEWS").ToString()) %> views<br />
                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "COMMENTS").ToString()) %> comments
                    </center>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4"><hr /></td>
        </tr>
    </ItemTemplate>
    <FooterTemplate>
        </table>
    </FooterTemplate>
</asp:Repeater>
