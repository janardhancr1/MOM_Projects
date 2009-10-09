<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMBlogRead.aspx.cs" Inherits="MOMBlogs_MOMBlogRead" %>

<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="3" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
    <popUp:momPopup ID="momPopup" runat="server" />
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>
