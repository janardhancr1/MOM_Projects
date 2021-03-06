<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMRecipeExplore.aspx.cs" Inherits="MOMRecipe_MOMRecipeExplore" %>

<%@ Register TagPrefix="MOM" Namespace="App_Code.TagView" %>
<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <div class="tabs">
        <center>
            <div class="left_tabs">
                <ul class="toggle_tabs" id="toggle_tabs_unused">
                    <li class="first "><a href="MOMRecipesHome.aspx" onclick="return true;">Home</a></li>
                    <li><a href="MOMRecipeSearch.aspx" onclick="return true;">Search</a></li>
                    <li><a href="MOMRecipeExplore.aspx" class="selected" onclick="return true;">Explore
                        Tags</a></li>
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
                <table width="100%" height="200">
                    <tr>
                        <td align="center">
                        <MOM:PopularTagCtl ID="TagCtl" runat="server" TagURL="MOMRecipeTagSearch.aspx?tag=" />
                        </td>
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
