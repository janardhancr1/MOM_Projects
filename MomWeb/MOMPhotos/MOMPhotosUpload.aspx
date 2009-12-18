<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true" CodeFile="MOMPhotosUpload.aspx.cs" Inherits="MOMPhotos_MOMPhotosUpload" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
<%@ Import Namespace="BOMomburbia" %>

<asp:Content ContentPlaceHolderID="momLeft" ID="momLeftContent" runat="server">
</asp:Content>

<asp:Content ContentPlaceHolderID="momCenter" ID="momCenterContent" runat="server">
    <popUp:momPopup ID="momPopup" runat="server" />
</asp:Content>

<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>

