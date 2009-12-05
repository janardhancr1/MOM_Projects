<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true" CodeFile="MOMHome.aspx.cs" Inherits="_Default" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register TagPrefix="mf" TagName="momFridge" Src="~/MOMUserControls/MOMFridgeMenu.ascx" %>
<%@ Register TagPrefix="mp" TagName="momPopup" Src="~/MOMUserControls/MOMPopUpControl.ascx" %>

<asp:Content ContentPlaceHolderID="momLeft" runat="server">
    <table cellpadding="0" cellspacing="0" width="100%" style="width: 150px;">
        <tr>
            <td>
                <div class="momSpacer10px"></div>
                <div>
                    <table width="98%" cellpadding="5">
                        <tr>
                            <td style="background-image:url('../images/greenbg.gif');">
                                Recent Group Posts
                            </td>
                        </tr>
                        <asp:Repeater ID="momGroupsRecent" runat="server">
                            <ItemTemplate>
                                <tr>
                                    <td>
                                        <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                                            <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString()), 20)%>
                                        </a>
                                        - 
                                        <a style="color: Black;" href="../MOMGroups/MOMGroup.aspx?mGi=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "GRP_MOM_USR_ID").ToString()) %>">
                                            <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "SHARE").ToString()), 20)%>
                                        </a>
                                    </td>
                                </tr>
                            </ItemTemplate>                        
                        </asp:Repeater>
                        <tr>
                            <td>
                                <a href="../MOMGroups/MOMGroups.aspx">
                                    Go to my groups...
                                </a>
                            </td>
                        </tr>
                    </table>                   
                </div>
                <div class="momSpacer10px"></div>
                <div>
                    <table width="98%" cellpadding="5">
                        <tr>
                            <td style="background-image:url('../images/greenbg.gif');">
                                Recent Recipe Posts
                            </td>
                        </tr>
                        <asp:Repeater ID="momRecipeRecent" runat="server">
                            <ItemTemplate>
                                <tr>
                                    <td>
                                        <a style="color: Black;" href="../MOMRecipe/MOMRecipeDefault.aspx?mrcpid=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                                            <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "NAME").ToString()), 20) %>
                                        </a>
                                    </td>
                                </tr>
                            </ItemTemplate>                        
                        </asp:Repeater>
                        <tr>
                            <td>
                                <a href="../MOMRecipe/MOMRecipesHome.aspx">
                                    Go to Recipe Box...
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="momCenter" runat="server">
    <table style="width: 548px" cellpadding="2" cellspacing="0">
        <tr>
            <td>
                <asp:Label ID="momUserName" runat="server" CssClass="grayHeader"></asp:Label>
            </td>
        </tr>
        <tr>
            <td>
                <asp:Panel ID="Panel1" runat="server" Width="100%" CssClass="roundedPanel"> 
                <table>
                    <tr>
                        <td>
                            <div>
                                <asp:TextBox ID="momShare" runat="server" TextMode="multiLine" Rows="2" Columns="80" style="color:#aa3464; width: 500px;">
                                </asp:TextBox>
                                <cc1:TextBoxWatermarkExtender ID="TextBoxWatermarkExtender" runat="server"
                                TargetControlID="momShare" WatermarkText="You've got hands full so type anything!!!">
                                </cc1:TextBoxWatermarkExtender>                            
                            </div>
                            <div class="momSpacer5px"></div>
                            <div id="momShareLinkPanel" style="text-align: center; display: none;">
                                <table width="100%">
                                    <tr>
                                        <td align="center">
                                            <table style="width: 95%; background-color: White; text-align: left;" cellpadding="5"> 
                                                <tr>
                                                    <td>
                                                        Link
                                                    </td>
                                                    <td align="right">
                                                        <a href="javascript:hideSubPanel('momShareLinkPanel');">X</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="styleLine"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <asp:TextBox ID="momShareLink" runat="server" style="width: 400px;"></asp:TextBox>
                                                        <cc1:TextBoxWatermarkExtender ID="TextBoxWatermarkExtender1" runat="server"
                                                        TargetControlID="momShareLink" WatermarkText="http://">
                                                        </cc1:TextBoxWatermarkExtender> 
                                                        <asp:HiddenField ID="momShareLinkStatus" runat="server" Value="F"></asp:HiddenField>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="momSpacer5px"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="1" class="momShareMenu">
                                <tr>
                                    <td class="momInfo">
                                        Attach
                                    </td>
                                    <td>
                                        <a title="Photos"><img src="../images/home_icon2.gif" width="22px" height="20px"/></a>
                                    </td>
                                    <td>
                                        <a title="Vidoes"><img src="../images/home_icon4.gif" width="22px" height="20px"/></a>
                                    </td>
                                    <td>
                                        <img src="../images/home_icon9.gif" width="22px" height="20px" onclick="showSubPanel('momShareLinkPanel');"/>
                                    </td>
                                    <td style="width: 400px; text-align: right;">
                                        <asp:Button ID="momPublish" Text="Share" runat="server" CssClass="btnStyle" OnClick="momPublish_Click" />
                                    </td>
                                </tr>
                            </table>                            
                        </td>
                    </tr>
                </table> 
                </asp:Panel>    
                <cc1:RoundedCornersExtender ID="RoundedCornersExtender1" runat="server" TargetControlID="Panel1"
                Radius="4" Corners="All">
                </cc1:RoundedCornersExtender>           
            </td>
        </tr>
        <tr>
            <td style="font-size: 10pt;">
                <asp:Repeater ID="momFridgeShared" runat="server" OnItemDataBound="momFridgeShared_ItemDataBound">
                    <ItemTemplate>
                        <div id="momFeed<%# DataBinder.Eval(Container.DataItem, "ID") %>" onmouseover="showHide('feedButton<%# DataBinder.Eval(Container.DataItem, "ID") %>')" onmouseout="showHide('feedButton<%# DataBinder.Eval(Container.DataItem, "ID") %>')">
                            <table width="100%" cellpadding="3" cellspacing="0">
                                <tr>
                                    <td>
                                        <table cellpadding="3" width="100%">
                                            <tr>
                                                <td rowspan="3" style="width:45px; vertical-align: top;">
                                                    <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" width="40" height="40" />
                                                </td>
                                                <td>
                                                    <div>
                                                    <a href="?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>" style="font-weight: bold;"><%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString()) %></a>
                                                    <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "SHARE").ToString()), 50)%>
                                                    </div>
                                                    <div>
                                                        <small>
                                                            <%# DataBinder.Eval(Container.DataItem, "TYPE_SHARE").ToString() %>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td rowspan="3" style="width:95px; vertical-align: top;">
                                                    <div id="feedButton<%# DataBinder.Eval(Container.DataItem, "ID") %>" style="display: none;">
                                                        <input type="button" value="Hide" class="btnStyle" onclick="hideFeed('momFeed<%# DataBinder.Eval(Container.DataItem, "ID") %>', <%# DataBinder.Eval(Container.DataItem, "ID") %>);" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" cellpadding="3">
                                                        <tr>
                                                            <td style="font-size: 8pt; color: darkgray;">
                                                                <%# DataBinder.Eval(Container.DataItem, "TIME") %> - 
                                                                <a href="javascript:showWriteComment('momCommentsInfo<%# DataBinder.Eval(Container.DataItem, "ID") %>');" >Comment</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div id="momCommentParent<%# DataBinder.Eval(Container.DataItem, "ID") %>">
                                                                    <asp:Repeater ID="momFridgeCommentsRpt" runat="server">
                                                                        <ItemTemplate>
                                                                            <div id="momFridgeComment<%# DataBinder.Eval(Container.DataItem, "ID") %>" style="background-color: MistyRose; display: block;">
                                                                                <table width="100%" cellspacing="0" cellpadding="3">
                                                                                    <tr>
                                                                                        <td style="width: 29px;" rowspan="2" class="commentStyle">
                                                                                            <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" height="25" width="25" />
                                                                                        </td>
                                                                                        <td class="commentStyle">
                                                                                            <a href="?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>" style="font-weight: bold;"><%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString())%></a> 
                                                                                            <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "COMMENTS").ToString()), 40)%>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="commentStyle">
                                                                                            <%# DataBinder.Eval(Container.DataItem, "TIME") %> * 
                                                                                            <a href="javascript:deleteComment('momFridgeComment<%# DataBinder.Eval(Container.DataItem, "ID") %>', <%# DataBinder.Eval(Container.DataItem, "ID") %>);">delete</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                            <div style="height: 2px; background-color: white;"></div>
                                                                        </ItemTemplate>
                                                                    </asp:Repeater>
                                                                </div>
                                                                <div id="momCommentsInfo<%# DataBinder.Eval(Container.DataItem, "ID") %>" style="display: none; vertical-align: middle;">
                                                                    <div style="background-color:MistyRose;">
                                                                        <input id="momCommentsText<%# DataBinder.Eval(Container.DataItem, "ID") %>" type="text" class="tbStyle" style="width: 98%;" />
                                                                    </div>
                                                                    <div style="text-align: right; top: 30px; background-color:MistyRose; text-indent: 10px;">
                                                                        <input type="button" class="btnStyle" value="Comment" 
                                                                        onclick="addComments('momCommentParent<%# DataBinder.Eval(Container.DataItem, "ID") %>', 'momCommentsInfo<%# DataBinder.Eval(Container.DataItem, "ID") %>', 'momCommentsText<%# DataBinder.Eval(Container.DataItem, "ID") %>', '<%# DataBinder.Eval(Container.DataItem, "ID") %>');" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>                                 
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="styleLine"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </ItemTemplate>
                </asp:Repeater>
                <div ID="momParent" runat="server">
                </div>
            </td>            
        </tr>
    </table>
    <mp:momPopup ID="momPopupExtender" runat="server" />
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="momRight" runat="server">
    <div class="momSpacer10px"></div>
    <table cellpadding="5" cellspacing="0" width="100%" style="background-color: mistyrose;">
        <tr>
            <td>
                <div>
                    <table cellpadding="3">
                        <tr>
                            <td colspan="2" style="font-weight: bold;">
                                Invite Your Friends
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="../images/m.gif" />
                            </td>
                            <td>
                                <div class="momInfo">
                                    <a href="../MOMFriends/MOMFriendsInvite.aspx">Connect With More Friends</a>
                                </div>
                                <div class="momSpacer10px"></div>
                                <div>
                                    <small>
                                        Share the Momburbia experience with more of your friends. Use our simple invite tools to start connecting.
                                    </small>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="styleLine"></div>
                <div class="momSpacer10px"></div>
                <div>
                    <table width="100%">
                        <tr>
                            <td style="width: 80%;font-weight: bold;">
                                People You May Know
                            </td>
                            <td style="width: 20%;" align="right">
                                <a href="">See All</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="momSpacer10px"></div>
                            </td>
                        </tr>
                        <asp:Repeater ID="momKnownFriends" runat="server">
                            <ItemTemplate>
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" cellpadding="3">
                                            <tr>
                                                <td style="width: 10%;">
                                                    <a href="MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                                                        <img height="40" width="40" src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" />
                                                    </a>
                                                </td>
                                                <td style="width: 70%;">
                                                    <div class="momInfo">
                                                        <a href="MOMHome.aspx?<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                                                            <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "FULL_NAME").ToString()), 30) %>
                                                        </a>
                                                    </div>
                                                    <div class="momSpacer5px"></div>
                                                    <div>
                                                        <a href="javascript:addFriend('<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>');">
                                                            Add as Friend
                                                        </a>
                                                    </div>
                                                </td>
                                                <td align="right">
                                                    <img src="../images/icon13.gif" />
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="styleLine"></div>
                                        <div class="momSpacer10px"></div>
                                    </td>
                                </tr>
                            </ItemTemplate>
                        </asp:Repeater>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</asp:Content>