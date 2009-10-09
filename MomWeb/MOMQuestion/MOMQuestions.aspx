<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMQuestions.aspx.cs" Inherits="MOMQuestion_MOMQuestions" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register Src="~/MOMUserControls/MOMCategory.ascx" TagName="momCategory" TagPrefix="mc" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table cellpadding="3" cellspacing="0" width="100%">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" width="100%">
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
                </table><hr />
            </td>
        </tr>
        <tr>
            <td align="left" Class="grayHeader">
                Ask your Question
            </td>
        </tr>
        <%--<tr>
            <td>
                Ask your Question
            </td>
        </tr>--%>
        <tr>
            <td>
                <asp:TextBox ID="momQuestionTextBox" runat="server" MaxLength="100" cssClass="momQuestionTextBox" Width="400px"></asp:TextBox>
                <cc1:TextBoxWatermarkExtender ID="TextBoxWatermarkExtender1" runat="server" 
                TargetControlID="momQuestionTextBox" WatermarkText="What Would You Like To Ask">
                </cc1:TextBoxWatermarkExtender>
            </td>
        </tr>
        <tr>
            <td align="left" Class="grayHeader">
                Now add a little more detail (optional)
            </td>
        </tr>
        <tr>
            <td>
                <asp:TextBox ID="momQuestionDescription" runat="server" TextMode="multiLine" Rows="5" Columns="80"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td  align="left" Class="grayHeader">
                Categories
            </td>
        </tr>
        <tr>
            <td>
                <asp:DropDownList ID="momCategories" runat="server">
                </asp:DropDownList>
            </td>
        </tr>
        <tr>
            <td  align="left" Class="grayHeader">
                Notifications
            </td>
        </tr>
        <tr>
            <td>
                <asp:CheckBox ID="momEmailStatus" runat="server" Text="E-mail me when I receive a new answer"></asp:CheckBox>
            </td>
        </tr>
        <tr>
            <td>
                <asp:Button ID="momSubmitQuestion" runat="server" Text="Ask Question" cssClass="btnStyle" OnClick="momSubmitQuestion_Click" />
                &nbsp;Make sure your question follows the community guidelines.
            </td>
        </tr>
        <tr>
            <td style="font-size: 8pt;">
                Momburbia! does not evaluate or guarantee the accuracy of any Momburbia! Answers content. Click here for the Full Disclaimer. 
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>
