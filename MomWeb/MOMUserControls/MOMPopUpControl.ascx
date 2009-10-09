<%@ Control Language="C#" AutoEventWireup="true" CodeFile="MOMPopUpControl.ascx.cs" Inherits="MOMUserControls_MOMPopUpControl" %>
<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>

<asp:Panel ID="momPopupPanel" runat="server" BorderColor="black" style="border: black;">
    <table width="500px" cellpadding="5" style="background-color: Pink;">
        <tr>
            <td>
                <div class="grayHeader">Momburbia Info</div>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <asp:Label ID="momPopupLabel" runat="server"></asp:Label>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <asp:Button ID="momPopUpOk" runat="server" Text="Ok" CssClass="btnStyle" />
            </td>
        </tr>
    </table>
</asp:Panel>
<cc1:ModalPopupExtender ID="momModalPopupExtender" 
    runat="server"
    BackgroundCssClass="modalBackground"
    OkControlID="momPopUpOk"
    PopupControlID="momPopupPanel"
    TargetControlID="momDummyButton">
</cc1:ModalPopupExtender>
<div style="display: none;"><asp:Button ID="momDummyButton" runat="server"/></div>
