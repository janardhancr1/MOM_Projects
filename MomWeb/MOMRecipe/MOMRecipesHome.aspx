<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMRecipesHome.aspx.cs" Inherits="MOMRecipe_MOMRecipesHome" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <div class="tabs">
        <center>
            <div class="left_tabs">
                <ul class="toggle_tabs" id="toggle_tabs_unused">
                    <li class="first "><a href="MOMRecipesHome.aspx" class="selected" onclick="return true;">Home</a></li>
                    <li><a href="MOMRecipeSearch.aspx" onclick="return true;">Search</a></li>
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
                <center>
                    <div class="submenu">
                        <a href="#"><img src="../images/folder_user.png" alt="My Recipes" /></a><a href="#">My Recipes</a> | 
                        <a href="#"><img src="../images/folder_star.png" alt="Favourite Recipes" /></a><a href="#">Favourite Recipes</a> | 
                        <a href="#"><img src="../images/time.png" alt="Recently Viewed" /></a><a href="#">Recently Viewed Recipes</a> | 
                        <a href="#"><img src="../images/comments.png" alt="Recent Comments" /></a><a href="#">Recent Comments</a>
                    </div>
                </center>
                <br />
                <fieldset>
                    <center>
                        <table>
                            <tr>
                                <td>
                                    Key words:</td>
                                <td>
                                    &nbsp;</td>
                                <td>
                                    <asp:TextBox ID="SearchKW" runat="server"></asp:TextBox>&nbsp;&nbsp;</td>
                                <td>
                                    <asp:Button ID="momRcpSearch" runat="server" Width="120px" Text="Search Recipes"
                                        CssClass="btnStyle" /></td>
                            </tr>
                        </table>
                    </center>
                </fieldset>
                <br />
                <div class="rcp_welcome_div">
                    <h1 style="text-align: center;">
                        Welcome to Recipe Binder, the best resource for finding and sharing recipes on Facebook</h1>
                    <br />
                    <h2>
                        Find Recipes</h2>
                    <span style="color: #666666;"><a href="MOMRecipeSearch.aspx"><b>Search</b></a> for recipes,
                        or just browse the recipes by <a href="MOMRecipeSearch.aspx"><b>tags</b></a>, <a
                            href="MOMRecipeTopRated.aspx"><b>top rated</b></a>, or view the most <a href="MOMRecipeRecent.aspx">
                                <b>recently submitted</b></a> recipes.</span><br />
                    <br />
                    <h2>
                        Favourites</h2>
                    <span style="color: #666666;">If you see a recipe you like add it to &ldquo;My Recipe
                        Binder&rdquo; as a <a href="#"><b>favourite</b></a>.</span><br />
                    <br />
                    <h2>
                        Add Recipes</h2>
                    <span style="color: #666666;">Got a really good recipe? Why not <a href="MOMRecipeAdd.aspx">
                        <b>add it to Recipe Binder</b></a>. You can choose to share it with everyone on
                        Facebook, or just your friends.</span><br />
                    <br />
                    <h2>
                        Share Recipes</h2>
                    <span style="color: #666666;">You can <b>add Recipe Binder to your profile</b>, so that
                        all of your friends can discover your favourite recipes. You can also <b>share recipes</b>
                        with your friends directly via the share button.</span><br />
                    <br />
                    <h2>
                        Ratings and Reviews</h2>
                    <span style="color: #666666;">You can <b>rate recipes</b> and leave helpful <b>comments</b>
                        and hints. The more involved you get the more useful Recipe Binder will become!</span><br />
                    <br />
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
