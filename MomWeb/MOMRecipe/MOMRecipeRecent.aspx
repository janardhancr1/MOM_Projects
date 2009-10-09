<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMRecipeRecent.aspx.cs" Inherits="MOMRecipe_MOMRecipeRecent" %>

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