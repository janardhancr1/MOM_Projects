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
                <div class="styleLine"></div>
                <div class="momSpacer10px"></div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="grayHeader">
                    Albums (<asp:Label ID="momAlbumCounts" runat="server"></asp:Label>)
                </div>
                <div>
                    <table width="100%">
                        <asp:Repeater ID="momAlbumsRpt" runat="server">
                            <ItemTemplate>
                                <tr>
                                    <td>
                                        <div class="momSpacer10px"></div>
                                        <table>
                                            <tr>
                                                <td>
                                                    <div style="width: 90px;">
                                                        <img src="<%# DataBinder.Eval(Container.DataItem, "ALBM_PHOTOS").ToString()%>" height="80" width="80" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "TITLE").ToString()), 80)%> 
                                                        ( <%# DataBinder.Eval(Container.DataItem, "PHOTOS").ToString()%> )
                                                    </div>
                                                    <div>
                                                        <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DESCRIPTION").ToString()), 80)%>
                                                    </div>
                                                    <div>
                                                        <%# DataBinder.Eval(Container.DataItem, "TIME").ToString()%>
                                                    </div>
                                                    <div class="momSpacer10px"></div>
                                                    <div>
                                                        <a href="MOMPhotosUpload.aspx?momAlbumId=<%# MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                                                            Add more photos
                                                        </a>
                                                    </div>
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
    <popUp:momPopup ID="momPopup" runat="server" />
</asp:Content>

<asp:Content ContentPlaceHolderID="momRight" ID="momRightContent" runat="server">
</asp:Content>