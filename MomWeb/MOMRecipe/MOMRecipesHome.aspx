<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMRecipesHome.aspx.cs" Inherits="MOMRecipe_MOMRecipesHome" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="95%" cellpadding="3">
                    <tr>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipesHome.aspx">Home</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeSearch.aspx">Search</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeExplore.aspx">Explore Tags</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeRecent.aspx">Most Recent</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeTopRated.aspx">Top Rated</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeAdd.aspx">Add a Recipe</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <div class="submenu">
                        <a href="http://apps.facebook.com/recipebinder/myrecipebinder/default.aspx">
                            <img src="../images/folder_user.png"
                                alt="My Recipes" /></a><a href="http://apps.facebook.com/recipebinder/myrecipebinder/default.aspx">My
                                    Recipes</a> | <a href="http://apps.facebook.com/recipebinder/myrecipebinder/fav.aspx">
                                        <img src="../images/folder_star.png"
                                            alt="Favourite Recipes" /></a><a href="http://apps.facebook.com/recipebinder/myrecipebinder/fav.aspx">Favourite
                                                Recipes</a> | <a href="http://apps.facebook.com/recipebinder/myrecipebinder/recentlyviewed.aspx">
                                                    <img src="../images/time.png" alt="Recently Viewed" /></a><a
                                                        href="http://apps.facebook.com/recipebinder/myrecipebinder/recentlyviewed.aspx">Recently
                                                        Viewed Recipes</a> | <a href="http://apps.facebook.com/recipebinder/myrecipebinder/recentcomments.aspx">
                                                            <img src="../images/comments.png"
                                                                alt="Recent Comments" /></a><a href="http://apps.facebook.com/recipebinder/myrecipebinder/recentcomments.aspx">Recent
                                                                    Comments</a>
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
                        Find Recipes</h2><span style="color: #666666;"><a href="MOMRecipeSearch.aspx">
                        <b>Search</b></a> for recipes, or just browse the recipes by <a href="MOMRecipeSearch.aspx">
                            <b>tags</b></a>, <a href="MOMRecipeTopRated.aspx"><b>top rated</b></a>,
                        or view the most <a href="MOMRecipeRecent.aspx"><b>recently
                            submitted</b></a> recipes.</span><br />
                    <br />
                    <h2>
                        Favourites</h2><span style="color: #666666;">If you see a recipe you like add it to &ldquo;My Recipe
                        Binder&rdquo; as a <a href="#">
                            <b>favourite</b></a>.</span><br />
                    <br />
                    <h2>
                        Add Recipes</h2><span style="color: #666666;">Got a really good recipe? Why not <a href="MOMRecipeAdd.aspx">
                        <b>add it to Recipe Binder</b></a>. You can choose to share it with everyone on
                        Facebook, or just your friends.</span><br />
                    <br />
                    <h2>
                        Share Recipes</h2><span style="color: #666666;">You can <b>add Recipe Binder to your profile</b>, so that
                        all of your friends can discover your favourite recipes. You can also <b>share recipes</b>
                        with your friends directly via the share button.</span><br />
                    <br />
                    <h2>
                        Ratings and Reviews</h2><span style="color: #666666;">You can <b>rate recipes</b> and leave helpful <b>comments</b>
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
