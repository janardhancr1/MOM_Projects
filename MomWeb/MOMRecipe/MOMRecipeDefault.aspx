<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMRecipeDefault.aspx.cs" Inherits="MOMRecipe_MOMRecipeDefault" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
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
                <table width="95%">
                    <tr>
                        <td colspan="2">
                            <h1>
                                <asp:Label ID="momRcpName" runat="server"></asp:Label></h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4>
                                <asp:Label ID="momRcpDescription" runat="server"></asp:Label></h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="styleLine">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div>
                                <div class="momInfo" style="float: left;">
                                    Rate this Recipe: &nbsp;
                                </div>
                                <cc1:Rating ID="Rating1" runat="server" CurrentRating="2" MaxRating="5" StarCssClass="ratingStar" WaitingStarCssClass="savedRatingStar"
                                    FilledStarCssClass="filledRatingStar" EmptyStarCssClass="emptyRatingStar" Style="float: left;" OnChanged="Rating_Changed">
                                </cc1:Rating>
                            </div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <asp:Image ID="momRcpPhoto" runat="server" Width="175" Height="180" />
                        </td>
                        <td width="50%">
                            <span class="momInfo">Difficulty:</span>
                            <asp:Label ID="momRcpDifficulty" runat="Server"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="momInfo">
                                Ingredients</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <asp:Label ID="momRcpIngredients" runat="server"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="momInfo">
                                Method</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <asp:Label ID="momRcpMethod" runat="server"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="momInfo">Preparation Time :</span>
                            <asp:Label ID="momRcpPrepTM" runat="server"></asp:Label>
                        </td>
                        <td>
                            <span class="momInfo">Cooking Time :</span>
                            <asp:Label ID="momRcpCookTM" runat="server"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="momInfo">Server To : </span>
                            <asp:Label ID="momRcpServTO" runat="server"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="momInfo">Tags</span></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <asp:Label ID="momRcpTags" runat="server"></asp:Label></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="styleLine">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="momInfo">Comments</span>
                        </td>
                    </tr>
                    <asp:Panel ID="NoCommentsPanel" runat="server">
                        <tr>
                            <td colspan="2">
                                <font color="red">No Comments Yet.</font></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="styleLine">
                                </div>
                            </td>
                        </tr>
                    </asp:Panel>
                    <asp:Repeater ID="momCommentsRpt" runat="server">
                        <ItemTemplate>
                            <tr>
                                <td colspan="2">
                                    <table width="100%">
                                        <tr>
                                            <td width="10%">
                                                <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" width="40" height="40" /></td>
                                            <td width="90%">
                                                <div>
                                                    <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "COMMENTS").ToString()), 80)%>
                                                </div>
                                                <div class="momSpacer10px">
                                                </div>
                                                <div>
                                                    <small>By&nbsp;-&nbsp; <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">
                                                        &nbsp;
                                                        <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "SUBMITTEDBY").ToString()) %>
                                                    </a>&nbsp;-&nbsp;
                                                        <%# DataBinder.Eval(Container.DataItem, "SUBMITIME")%>
                                                    </small>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="styleLine">
                                    </div>
                                </td>
                            </tr>
                        </ItemTemplate>
                    </asp:Repeater>
                    <asp:Panel ID="momCommentFrm" runat="server">
                        <tr>
                            <td colspan="2">
                                <asp:TextBox ID="momCommentText" runat="server" TextMode="multiLine" MaxLength="1000"
                                    Rows="5" Columns="80">
                                </asp:TextBox>
                                <asp:TextBox ID="momRcpIDHide" runat="server" Visible="false"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <asp:Button ID="momSubmitComment" Text="Submit" CssClass="btnStyle" runat="server"
                                    OnClick="momSubmitComment_Click" />
                            </td>
                        </tr>
                    </asp:Panel>
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
