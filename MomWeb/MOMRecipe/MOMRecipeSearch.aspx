<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMRecipeSearch.aspx.cs" Inherits="MOMRecipe_MOMRecipeSearch" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <div class="tabs">
        <center>
            <div class="left_tabs">
                <ul class="toggle_tabs" id="toggle_tabs_unused">
                    <li class="first "><a href="MOMRecipesHome.aspx" onclick="return true;">Home</a></li>
                    <li><a href="MOMRecipeSearch.aspx" class="selected" onclick="return true;">Search</a></li>
                    <li><a href="MOMRecipeExplore.aspx" onclick="return true;">Explore Tags</a></li>
                    <li><a href="MOMRecipeRecent.aspx" onclick="return true;">Most Recent</a></li>
                    <li><a href="MOMRecipeTopRated.aspx" onclick="return true;">Top Rated</a></li>
                    <li class="last "><a href="MOMRecipeAdd.aspx" onclick="return true;">Add a Recipe</a></li>
                </ul>
            </div>
        </center>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <asp:Label ID="momQString" runat="server"></asp:Label>
                <br />
                <fieldset>
                    <center>
                        <table>
                            <tr>
                                <td colspan="3" align="center">
                                    Key words:&nbsp;
                                    <asp:TextBox ID="SearchKW" runat="server" Width="300px"></asp:TextBox>&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <asp:CheckBox ID="momRcpVege" runat="server" Text=" Suitable for vegetarians?" />
                                </td>
                                <td>
                                    <asp:CheckBox ID="momRcpVegan" runat="server" Text=" Suitable for vegans?" />
                                </td>
                                <td>
                                    <asp:CheckBox ID="momRcpDairy" runat="server" Text=" Dairy free?" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <asp:CheckBox ID="momRcpGluten" runat="server" Text=" Gluten free?" />
                                </td>
                                <td>
                                    <asp:CheckBox ID="momRcpNut" runat="server" Text=" Nut free?" />
                                </td>
                                <td>
                                    <asp:CheckBox ID="momRcpPhoto" runat="server" Text=" Only show recipes with photos?" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Difficulty :<asp:DropDownList ID="momRcpDifficulty" runat="Server" Width="200px">
                                        <asp:ListItem Value="Easy">Easy - for beginners</asp:ListItem>
                                        <asp:ListItem Value="Medium">Medium - some experience needed</asp:ListItem>
                                        <asp:ListItem Value="Difficult">Difficult - for experienced cooks</asp:ListItem>
                                    </asp:DropDownList>
                                </td>
                                <td>
                                    <asp:CheckBox ID="momRcpIngre" runat="server" Text=" Only search ingredients?" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <input type="checkbox" class="checkboxes" name="friendsonly" value="1" id="Checkbox2" /><label
                                        for="app2471587211_lblfriends">Only search within My Recipe Binder (your recipes
                                        and favourites)
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center">
                                    <asp:Button ID="momRcpSearch" runat="server" Width="120px" Text="Search Recipes"
                                        CssClass="btnStyle" OnClick="Search_Click" />
                                </td>
                            </tr>
                        </table>
                    </center>
                </fieldset>
                <br />
                <asp:Repeater ID="momRcpRpt" runat="server">
                    <HeaderTemplate>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr bgcolor="gray">
                                <th width="20%">
                                    &nbsp;</th>
                                <th width="40%" align="left">
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
                            <td align="center">
                                <cc1:Rating ID="Rating1" runat="server" ReadOnly="true" CurrentRating='<%# DataBinder.Eval(Container.DataItem, "RATING") %>'
                                    MaxRating="5" StarCssClass="ratingStar" WaitingStarCssClass="savedRatingStar"
                                    FilledStarCssClass="filledRatingStar" EmptyStarCssClass="emptyRatingStar" Style="padding-left: 30%;
                                    padding-top: 5%" Visible='<%# RecipeBase.ShowRating(DataBinder.Eval(Container.DataItem, "RATING").ToString()) %>'>
                                </cc1:Rating>
                                <br />
                                <%# RecipeBase.GetRatings(DataBinder.Eval(Container.DataItem, "RATING").ToString())%>
                                <br />
                                <%# RecipeBase.GetViews(DataBinder.Eval(Container.DataItem, "VIEWS").ToString())%>
                                <br />
                                <%# RecipeBase.GetComments(DataBinder.Eval(Container.DataItem, "COMMENTS").ToString())%>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <hr />
                            </td>
                        </tr>
                    </ItemTemplate>
                    <FooterTemplate>
                        </table>
                    </FooterTemplate>
                </asp:Repeater>
                <table width="100%" id="NoDateTable" runat="server" visible="false">
                    <tr>
                        <td>
                            <font color="red">No Recipes found..</font></td>
                    </tr>
                </table>
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
