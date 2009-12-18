<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MasterPage.master" AutoEventWireup="true" CodeFile="MOMPhotos.aspx.cs" Inherits="MOMPhotos_MOMPhotos" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
<%@ Import Namespace="BOMomburbia" %>

<asp:Content ContentPlaceHolderID="momLeft" ID="momLeftContent" runat="server">
</asp:Content>

<asp:Content ContentPlaceHolderID="momCenter" ID="momCenterContent" runat="server">
    <table width="90%">
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <div class="grayHeader">
                                <a href="javascript:openAlbumForm()">Create Album</a>
                             </div>
                            <div class="momSpacer10px"></div>
                            <div id="momAlbumFrm" style="display: none;">
                                <table width="90%">
                                    <tr>
                                        <td width="150px">
                                            Title
                                        </td>
                                        <td>
                                            <asp:TextBox ID="momAlbumTitle" runat="server" CssClass="tbSignIn"></asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Description
                                        </td>
                                        <td>
                                            <asp:TextBox ID="momAlbumDescription" runat="server" TextMode="multiLine" CssClass="tbSignIn" Rows="5" Columns="50"></asp:TextBox>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Share With
                                        </td>
                                        <td>
                                            <div>
                                                <asp:DropDownList ID="momAlbumPrivacy" runat="server">
                                                 <asp:ListItem  Value="Momburbia Members">Momburbia Members</asp:ListItem>
                                                 <asp:ListItem  Value="Only My Friends">Only My Friends</asp:ListItem>
                                                 <asp:ListItem  Value="Just Me">Just Me</asp:ListItem>                              
                                             </asp:DropDownList>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <asp:Button ID="momAlbumSave" Text="Save" runat="server" CssClass="btnStyle" OnClick="momAlbumSave_Click" />
                                            <asp:Button ID="momAlbumCancel" Text="Cancel" runat="server" CssClass="btnStyle" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div class="grayHeader">
                    Albums (0)
                </div>
                <div>
                    <asp:Repeater ID="momAlbumsRpt">
                    </asp:Repeater>
                </div>
            </td>
        </tr>
    </table>
    <popUp:momPopup ID="momPopup" runat="server" />
</asp:Content>

<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>