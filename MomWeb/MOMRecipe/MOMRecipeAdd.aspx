<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMRecipeAdd.aspx.cs" Inherits="MOMRecipe_MOMRecipeAdd" %>

<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <div class="tabs">
        <center>
            <div class="left_tabs">
                <ul class="toggle_tabs" id="toggle_tabs_unused">
                    <li class="first "><a href="MOMRecipesHome.aspx" onclick="return true;">Home</a></li>
                    <li><a href="MOMRecipeSearch.aspx" onclick="return true;">Search</a></li>
                    <li><a href="MOMRecipeExplore.aspx" onclick="return true;">Explore Tags</a></li>
                    <li><a href="MOMRecipeRecent.aspx" onclick="return true;">Most Recent</a></li>
                    <li><a href="MOMRecipeTopRated.aspx" onclick="return true;">Top Rated</a></li>
                    <li class="last "><a href="MOMRecipeAdd.aspx" class="selected" onclick="return true;">Add a Recipe</a></li>
                </ul>
            </div>
        </center>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            <fieldset>
                                <legend class="grayHeader">Recipe Details</legend>
                                <table width="100%" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Recipe Name: &nbsp;<small>(required)</small></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpName" Width="300px" runat="server" CssClass="tbSignIn" MaxLength="100"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Make it short, simple and descriptive</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Description: &nbsp; <small>(required)</small></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpDescription" runat="server" TextMode="MultiLine" Rows="4"
                                                            Columns="100" CssClass="tbSignIn"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Give more details about your recipe. What does it go well with? Why do you like
                                                            it? Make people want to try it!</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Photo
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpPhoto" Width="300px" runat="server" CssClass="tbSignIn" MaxLength="100"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Photos help other people understand what the end result should look like, so
                                                            add one if you can.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Tags
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpTags" Width="300px" runat="server" CssClass="tbSignIn" MaxLength="100"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Separate tags with a space. Tags are used to classify your recipe, so use as
                                                            many tags as you can to make it easy to find. E.g. chicken rice low fat quick</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Preparation Time
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpPrepTM" Width="300px" runat="server" CssClass="tbSignIn" MaxLength="100"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Cooking Time
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpCookTM" Width="300px" runat="server" CssClass="tbSignIn" MaxLength="100"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            How many people does it serve?
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpServTO" Width="300px" runat="server" CssClass="tbSignIn" MaxLength="100"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Difficulty
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:DropDownList ID="momRcpDifficulty" runat="Server" Width="200px">
                                                            <asp:ListItem Value="Easy">Easy - for beginners</asp:ListItem>
                                                            <asp:ListItem Value="Medium">Medium - some experience needed</asp:ListItem>
                                                            <asp:ListItem Value="Difficult">Difficult - for experienced cooks</asp:ListItem>
                                                        </asp:DropDownList>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Ingredients <small>(required)</small>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpIngredients" runat="server" TextMode="MultiLine" Rows="6"
                                                            Columns="100" CssClass="tbSignIn"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Please include quantites, unit of measurement and item for all ingredients.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="momInfo">
                                                            Method <small>(required)</small>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <asp:TextBox ID="momRcpMethod" runat="server" TextMode="MultiLine" Rows="6" Columns="100"
                                                            CssClass="tbSignIn"></asp:TextBox>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Try and split your method into logical steps, and make sure all the ingredients
                                                            you mention are listed above.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="momInfo">
                                                <h3>
                                                    Additional Information
                                                </h3>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                <asp:CheckBox ID="momRcpVege" runat="server" Text=" Suitable for vegetarians?" /></b>
                                            <br />
                                            <span class="checkboxtip">This recipe should contain no meat, fish, seafood, gelatin
                                                or marshmallow (unless specified as a vegetarian version) (see <a href="http://en.wikipedia.org/wiki/Vegetarian"
                                                    target="_blank">Wikipedia</a> for more info)</span>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                <asp:CheckBox ID="momRcpVegan" runat="server" Text=" Suitable for vegans?" /></b>
                                            <br />
                                            <span class="checkboxtip">This recipe should contain no meat, fish, seafood, eggs, dairy,
                                                honey, gelatin or marshmallow (unless specified as a vegetarian version) (see <a
                                                    href="http://en.wikipedia.org/wiki/Vegan" target="_blank">Wikipedia</a> for
                                                more info)</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                <asp:CheckBox ID="momRcpDairy" runat="server" Text=" Dairy free?" /></b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a dairy free diet?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                <asp:CheckBox ID="momRcpGluten" runat="server" Text=" Gluten free?" /></b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a gluten free diet?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                <asp:CheckBox ID="momRcpNut" runat="server" Text=" Nut free?" /></b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a nut free recipe?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                <asp:CheckBox ID="momRcpAllow" runat="server" Text=" Only allow your friends to see this recipe?" /></b>
                                            <br />
                                            <span class="checkboxtip">By selecting this option only your friends will be able to
                                                view this recipe. This means that fewer people can see your recipe, so only select
                                                it if you really need to.</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <asp:Button ID="momRcpAdd" runat="server" Text="Add Recipe" CssClass="btnStyle"
                                                OnClick="momRcpAdd_Click" />
                                            <asp:Button ID="momRcpCancel" runat="server" Text="Cancel" CssClass="btnStyle"
                                                OnClick="momRcpCancel_Click" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                </table>
                <popUp:momPopup ID="momPopup" runat="server" />
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
