<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true"
    CodeFile="MOMSent.aspx.cs" Inherits="MOMMail_MOMSent" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="95%" cellpadding="3">
                    <tr>
                        <td style="background-color: MistyRose;">
                            <a href="MOMInbox.aspx">Inbox</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMSent.aspx">Sent Messages</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMMailNotification.aspx">Notifications</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMCompose.aspx">Compose Message</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table width="95%">
                    <tr>
                        <td align="left">
                            <div class="momInfo">
                                Sent Messages</div>
                        </td>
                    </tr>
                </table>
                <table width="95%" id="NoMailsTable" runat="server" visible="false">
                    <tr>
                        <td align="left">
                            <font color="red">No Sent Messages..</font></td>
                    </tr>
                </table>
                <asp:Repeater ID="momMailSent" runat="server">
                    <HeaderTemplate>
                        <table width="95%" cellpadding="0" cellspacing="0">
                            <tr bgcolor="gray">
                                <th width="10%">
                                    <input type="checkbox" name="selectall" onclick="setSelection(this);" /></th>
                                <th width="30%" align="left">
                                    To</th>
                                <th width="35%" align="left">
                                    Subject</th>
                                <th width="25%" align="left">
                                    Sent On</th>
                            </tr>
                    </HeaderTemplate>
                    <ItemTemplate>
                        <tr>
                            <td>
                                <input type="checkbox" name="TargetMsgs" value="<%# Eval("ID") %>" />
                            </td>
                            <td align="left">
                                <div>
                                    <%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "MOM_TO_EMAIL").ToString())%>
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
