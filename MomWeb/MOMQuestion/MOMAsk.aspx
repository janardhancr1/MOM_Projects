<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true" CodeFile="MOMAsk.aspx.cs" Inherits="MOMQuestion_MOMAsk" %>
<%@ Register Src="~/MOMUserControls/MOMCategory.ascx" TagName="momCategory" TagPrefix="mc" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>

<asp:Content ContentPlaceHolderID="momLeft" ID="momLeftContent" runat="server">
    <mc:momCategory ID="momCategories" runat="server" />
</asp:Content>

<asp:Content ContentPlaceHolderID="momCenter" ID="momCenterContent" runat="server">
    <table cellpadding="2" cellspacing="0" width="100%">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <a href="MOMQuestions.aspx">
                                <img src="../images/question1.gif" width="150" height="30" />
                            </a>
                        </td>
                        <td>
                            <a href="MOMAsk.aspx">
                            <img src="../images/smily.gif" width="150" height="30" />
                            </a>
                        </td>
                        <td>
                            <img src="../images/tresh.gif" width="150" height="30" />
                        </td>
                    </tr>
                </table><hr />
            </td>
        </tr>
        <tr>
            <td align="left">
            <table cellpadding="10" cellspacing="0" width="100%">
                <tr>
                    <td align="left">
                        <asp:Label ID="momCategoryName" runat="server" CssClass="grayHeader"></asp:Label>
                    </td>
                </tr>
                <asp:Panel ID="momFirstQuestion" runat="server" visible="false">
                    <tr>
                        <td align="center" style="background-color: #b9d300;">
                            Nothing here right now. <br />Why don't you become the first to ask a question instead?
                        </td>
                    </tr>
                </asp:Panel>
            </table>    
            </td>        
        </tr>
        <tr>
            <td colspan="2" align="left">
                <table cellpadding="5" cellspacing="0" width="100%">
                    <asp:Repeater ID="momQuestionsRepeater" runat="server">
                        <ItemTemplate>
                            <tr style="background:<%# Container.ItemIndex % 2 == 0 ? "MistyRose" : "white" %>;">
                                <td rowspan="2" style="width:45px; vertical-align: middle;">
                                    <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE")%>" width="40" height="40" />
                                </td>
                                <td style="font-weight: bolder;">
                                    <a href="MOMAnswer.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>&mQi=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                                    <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "QUESTION").ToString()), 50)%>
                                    </a>
                                </td>
                            </tr>
                            <tr style="background:<%# Container.ItemIndex % 2 == 0 ? "MistyRose" : "white" %>;">
                                    <td>
                                        <small>
                                        <!--<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>-->&nbsp;Asked by&nbsp;-&nbsp;
                                        <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">&nbsp;
                                        <%# DataBinder.Eval(Container.DataItem, "DISPLAY_NAME") %></a>&nbsp;-&nbsp;
                                        <%# DataBinder.Eval(Container.DataItem, "ANSWERS_COUNT")%>&nbsp;answers&nbsp;-&nbsp;
                                        <%# DataBinder.Eval(Container.DataItem, "TIME") %>
                                        </small>
                                    </td>
                            </tr>
                        </ItemTemplate>
                    </asp:Repeater>
                </table>
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>


