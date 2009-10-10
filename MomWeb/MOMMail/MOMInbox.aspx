<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMInbox.aspx.cs" Inherits="MOMMail_MOMInbox" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <div class="tabs">
        <center>
            <div class="left_tabs">
                <ul class="toggle_tabs" id="toggle_tabs_unused">
                    <li class="first "><a href="MOMInbox.aspx" class="selected" onclick="return true;">Inbox</a></li>
                    <li><a href="MOMSent.aspx" onclick="return true;">Sent Messages</a></li>
                    <li class="last "><a href="MOMCompose.aspx" onclick="return true;">Compose Message</a></li>
                </ul>
            </div>
        </center>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="95%">
                    <tr>
                        <td align="left">
                            <div class="momInfo">
                                Inbox</div>
                        </td>
                    </tr>
                </table>
                <table width="95%" id="NoMailsTable" runat="server" visible="false">
                    <tr>
                        <td align="left">
                            <font color="red">No Messages found..</font></td>
                    </tr>
                </table>
                <asp:Repeater ID="momMailInbox" runat="server">
                    <HeaderTemplate>
                        <table width="95%" cellpadding="0" cellspacing="0">
                            <tr bgcolor="gray">
                                <th width="10%">
                                    <input type="checkbox" name="selectall" onclick="setSelection(this);" /></th>
                                <th width="30%" align="left">
                                    From</th>
                                <th width="35%" align="left">
                                    Subject</th>
                                <th width="25%" align="left">
                                    Received On</th>
                            </tr>
                    </HeaderTemplate>
                    <ItemTemplate>
                        <tr class="<%# GetCssClass((bool)DataBinder.Eval(Container.DataItem, "MOM_READ")) %>">
                            <td>
                                <input type="checkbox" name="TargetMsgs" value="<%# Eval("ID") %>" />
                            </td>
                            <td align="left">
                                <div>
                                    <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString())%>
                                </div>
                            </td>
                            <td align="left">
                                <div>
                                    <a href="../MOMMail/MOMMailView.aspx?mmailid=<%# BOMomburbia.MOMHelper.Encrypt(DataBinder.Eval(Container.DataItem, "ID").ToString()) %>">
                                        <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "MOM_SUBJECT").ToString()), 80)%>
                                    </a>
                                </div>
                            </td>
                            <td align="left">
                                <div>
                                    <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "TIME").ToString()) %>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <hr />
                            </td>
                        </tr>
                    </ItemTemplate>
                    <FooterTemplate>
                        </table>
                    </FooterTemplate>
                </asp:Repeater>
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
