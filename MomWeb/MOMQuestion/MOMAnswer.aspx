<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMAnswer.aspx.cs" Inherits="MOMQuestion_MOMAnswer" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center">
                <table cellpadding="5" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <a href="MOMQuestions.aspx">
                                <img src="../images/question1.gif" width="150" height="30" />
                            </a>
                        </td>
                        <td>
                            <a href="MOMQuestionDefault.aspx">
                            <img src="../images/smily.gif" width="150" height="30" />
                            </a>
                        </td>
                        <td>
                            <img src="../images/tresh.gif" width="150" height="30" />
                        </td>
                    </tr>
                </table><div class="styleLine"></div>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="5" cellspacing="5" width="100%">
                    <tr>
                        <td>
                            <asp:Label ID="momQuestionIDlbl" runat="server" CssClass="grayHeader"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: Bisque; height: 70px; vertical-align: top;">
                            <asp:Label ID="momDescription" runat="server"></asp:Label>
                        </td>
                    </tr>
                    <asp:Panel ID="momAnswerFrm" runat="server" visible="false">
                        <tr>
                            <td>
                                <asp:TextBox ID="momAnswerText" runat="server" TextMode="multiLine" MaxLength="1000" Rows="5" Columns="80">
                                </asp:TextBox>
                                <asp:TextBox ID="momQuestionIDHide" runat="server" visible="false"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Button ID="momSubmitAnswer" Text="Submit" cssClass="btnStyle" runat="server" OnClick="momSubmitAnswer_Click" />
                            </td>
                        </tr>
                    </asp:Panel>
                    <tr>
                        <td style="color: Olive;">
                            <small>
                            Answers (<asp:Label ID="momAnswersCount" runat="server"></asp:Label>)&nbsp;
                            <asp:Button ID="momShowAnswerFrm" Text="Answer this" cssClass="btnStyle" runat="server" OnClick="momShowAnswerFrm_Click" />&nbsp;
                            Asked By - <asp:Label ID="momDisplayName" runat="server"></asp:Label>
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="styleLine"></div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="5" cellspacing="0" width="100%">
                    <asp:Repeater ID="momAnswersRpt" runat="server">
                        <ItemTemplate>
                            <tr>
                                <td style="width:45px;">
                                    <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" width="40" height="40" />
                                </td>
                                <td>
                                    <div>
                                        <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "ANSWER").ToString()), 80)%>
                                    </div>
                                    <div class="momSpacer10px"></div>
                                    <div>
                                        <small>
                                            Answered by&nbsp;-&nbsp;
                                            <a href="../MOMHome/MOMHome.aspx?muI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "MOM_USR_ID").ToString()) %>">&nbsp;
                                            <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString()) %></a>&nbsp;-&nbsp;
                                            <%# DataBinder.Eval(Container.DataItem, "TIME") %>
                                        </small>
                                    </div>
                                </td>
                            </tr>    
                            <tr>
                                <td colspan=2">
                                    <div class="styleLine"></div>
                                </td>
                            </tr>                        
                        </ItemTemplate>
                    </asp:Repeater>
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