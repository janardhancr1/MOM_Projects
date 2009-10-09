<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMCreateBlog.aspx.cs" Inherits="MOMBlogs_MOMCreateBlog" %>

<%@ Register Assembly="RichTextEditor" Namespace="AjaxControls" TagPrefix="cc1" %>
<%@ Register Src="~/MOMUserControls/MOMPopUpControl.ascx" TagName="momPopup" TagPrefix="popUp" %>
<%@ Register Assembly="FredCK.FCKeditorV2" Namespace="FredCK.FCKeditorV2" TagPrefix="FCKEditor" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="8" cellspacing="0">
        <tr>
            <td>
                <fieldset>
                     <legend class="grayHeader">Create your blog</legend>
                     <div style="width: 100%">
                        <div class="momInfo">Title</div>
                        <div class="momSpacer5px"></div>
                        <div><asp:TextBox ID="momBlogTitle" runat="server" CssClass="tbSignIn" style="width: 300px;"></asp:TextBox></div>
                        <div class="momSpacer5px"></div>
                        <div class="momInfo">Blog Content</div>
                        <div class="momSpacer5px"></div>
                        <div>
                                <FCKEditor:FCKeditor ID="momBlogContent" runat="server" BasePath="~/js/fckeditor/" ToolbarSet="MOM"
                                    ToolbarCanCollapse="false" EnableViewState="true" Width="95%" Height="200px">
                                </FCKEditor:FCKeditor>
                         </div>
                         <div class="momSpacer5px"></div>
                        <div class="momInfo">Add Tags <div></div>
                            <small>
                                You can give your post "tags" which are like keywords or labels that will help you and other moms to organize and find posts about similar topics. Please separate each with a comma.
                            </small>
                        </div>
                        <div class="momSpacer5px"></div>
                        <div>
                            <asp:TextBox ID="momBlogTags" runat="server" style="width: 300px;">
                                </asp:TextBox>
                        </div>
                        <div class="momSpacer5px"></div>
                        <div>
                            <small>(ex. funny, birthday party, cake)</small>
                        </div>
                        <div class="momSpacer5px"></div>
                        <div class="momInfo">Privacy</div>
                        <div class="momSpacer5px"></div>
                        <div>
                            <small>
                                Select who this post should be visible to (or if you want to post anonymously; anonymous posts can not be edited or deleted once posted):
                            </small>
                        </div>
                        <div class="momSpacer5px"></div>
                        <div>
                            <asp:DropDownList ID="momBlogPrivacy" runat="server">
                                 <asp:ListItem  Value="0">Everyone</asp:ListItem>
                                 <asp:ListItem  Value="1">Momburbia Members</asp:ListItem>
                                 <asp:ListItem  Value="2">Only My Friends</asp:ListItem>
                                 <asp:ListItem  Value="4">Just Me</asp:ListItem>
                                 <asp:ListItem  Value="5">Anonymous</asp:ListItem>                               
                             </asp:DropDownList>
                        </div>
                        <div class="momSpacer5px"></div>
                        <div>
                            <asp:CheckBox Checked="true" ID="momBlogAllowComments" runat="server" Text="Allow other moms to comment on this post." />
                        </div>
                        <div class="momSpacer5px"></div>
                        <div>
                            <asp:CheckBox ID="momBlogEmail" runat="server" Text="Email me whenever someone comments on this post." />
                        </div>
                        <div class="momSpacer10px"></div>
                        <div>
                            <asp:Button ID="momBlogCreate" runat="server" Text="Create Blog" CssClass="btnStyle" OnClick="momBlogCreate_Click" />
                            <asp:Button ID="momBlogCancel" runat="server" Text="Cancel" CssClass="btnStyle" OnClick="momBlogCancel_Click" />
                        </div>
                     </div>
                 </fieldset>
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
