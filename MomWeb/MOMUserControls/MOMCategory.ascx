<%@ Control Language="C#" AutoEventWireup="true" CodeFile="MOMCategory.ascx.cs" Inherits="MOMUserControls_MOMCategory" %>

<table cellpadding="3" cellspacing="0">
    <tr>
        <td>
            <a href="?">
                <div style="font-size: 15pt; font-weight: bolder; color: #b9d300;">
                Categories
                </div>            
            </a>
        </td>
    </tr>
    <asp:Repeater ID="momCategoryRepeater" runat="server">
        <ItemTemplate>
          <tr>
            <td style="font-size: 10pt;">
                <a href="?cI=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString())  %>&cN=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "NAME").ToString())  %>">
                    <%# DataBinder.Eval(Container.DataItem, "NAME").ToString()  %>
                </a>
            </td>
          </tr>
        </ItemTemplate>
    </asp:Repeater>
</table>
