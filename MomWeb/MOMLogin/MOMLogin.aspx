<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMLogin.master" AutoEventWireup="true" CodeFile="MOMLogin.aspx.cs" Inherits="MOMLogin_MOMLogin" %>

<asp:Content ContentPlaceHolderID="momLoginPlaceHolder" runat="server">
    <table cellpadding="0" cellspacing="0">
        <tr>
             <td>
                 <fieldset>
                     <legend Class="grayHeader">Momburbia</legend>
                             <table style="width: 500px;">
                                 <tr>
                                     <td align="right">
                                         Email Address: 
                                     </td>
                                     <td align="left">
                                         <asp:TextBox ID="momEmail" runat="server" CssClass="tbStyle"></asp:TextBox>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td align="right">
                                         Password: 
                                     </td>
                                     <td align="left">
                                         <asp:TextBox ID="momPassword" runat="server" CssClass="tbStyle" TextMode="Password"></asp:TextBox>
                                     </td>
                                 </tr>
                                 <tr>
                                    <td align="right">
                                        <asp:CheckBox ID="momRemember" runat="server"></asp:CheckBox>
                                    </td>
                                    <td align="left">
                                        Remember Me
                                    </td>
                                 </tr>
                                 <tr>
                                     <td align="center" colspan="2">
                                         <asp:Button ID="momLogin" runat="server" Text="Login" CssClass="btnStyle" OnClick="momLogin_Click" />
                                     </td>
                                 </tr>
                             </table>               
                 </fieldset>
             </td>
        </tr>
    </table> 
</asp:Content>