<%@ Page Language="C#" AutoEventWireup="true" CodeFile="MOMFeedShare.aspx.cs" Inherits="MOMFeedShare_MOMFeedShare" %>
<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
    <title>Untitled Page</title>
    
    <link href="../css/MomStyle.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="../js/MomJS.js"></script>
    <script language="javascript" src="../js/jquery-1.3.2.js"></script>
    
</head>
<body>    
    <form id="form1" runat="server">
    <asp:ScriptManager ID="ScriptManager1" runat="server"/>
    <asp:UpdatePanel ID="UpdatePanel1" runat="server">
        <ContentTemplate>
            <table width="100%" cellpadding="2" cellspacing="0">
                <tr>
                    <td>
                        <asp:Label ID="momUserName" runat="server" CssClass="grayHeader"></asp:Label>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Tahoma; font-size: 10pt;">
                        <asp:Panel ID="Panel1" runat="server" Width="100%" CssClass="roundedPanel"> 
                        <table>
                            <tr>
                                <td>
                                    <asp:TextBox ID="momShare" runat="server" TextMode="multiLine" Rows="2" Columns="80"></asp:TextBox>
                                    <cc1:TextBoxWatermarkExtender ID="TextBoxWatermarkExtender" runat="server"
                                    TargetControlID="momShare" WatermarkText="What's on your mind?">
                                    </cc1:TextBoxWatermarkExtender>                            
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="1" class="momShareMenu">
                                        <tr>
                                            <td>
                                                Attach
                                            </td>
                                            <td>
                                                <a title="Photos"><img src="../images/home_icon2.gif" width="22px" height="20px"/></a>
                                            </td>
                                            <td>
                                                <a title="Vidoes"><img src="../images/home_icon4.gif" width="22px" height="20px"/></a>
                                            </td>
                                            <td>
                                                <img src="../images/home_icon9.gif" width="22px" height="20px"/>
                                            </td>
                                            <td style="width: 400px; text-align: right;">
                                                <asp:Button ID="momPublish" Text="Share" runat="server" CssClass="btnStyle" OnClick="momPublish_Click" />
                                            </td>
                                        </tr>
                                    </table>                            
                                </td>
                            </tr>
                        </table> 
                        </asp:Panel>    
                        <cc1:RoundedCornersExtender ID="RoundedCornersExtender1" runat="server" TargetControlID="Panel1"
                        Radius="4" Corners="All">
                        </cc1:RoundedCornersExtender>           
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10pt;">
                        <asp:Repeater ID="momFridgeShared" runat="server">
                            <ItemTemplate>
                                <div id="momFeed<%# Container.ItemIndex %>" onmouseover="showHide('feedButton<%# Container.ItemIndex %>')" onmouseout="showHide('feedButton<%# Container.ItemIndex %>')">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table cellpadding="3" width="100%">
                                                    <tr>
                                                        <td rowspan="3" style="width:45px; vertical-align: top;">
                                                            <img src="<%# DataBinder.Eval(Container.DataItem, "PICTURE") %>" width="40" height="40" />
                                                        </td>
                                                        <td>
                                                            <a style="font-weight: bold;"><%# BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "DISPLAY_NAME").ToString()) %></a></strong>
                                                            <%# BOMomburbia.MOMHelper.BreakText(BOMomburbia.MOMHelper.HTMLEncode(DataBinder.Eval(Container.DataItem, "SHARE").ToString()), 50)%>
                                                        </td>
                                                        <td rowspan="3" style="width:95px; vertical-align: top;">
                                                            <div id="feedButton<%# Container.ItemIndex %>" style="display: none;">
                                                                <input type="button" value="Hide" class="btnStyle" onclick="hideFeed('momFeed<%# Container.ItemIndex %>');" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td style="font-size: 8pt; color: darkgray;">
                                                                        <%# DataBinder.Eval(Container.DataItem, "TIME") %> - 
                                                                        <a href="javascript:showWriteComment('momCommentsInfo<%# Container.ItemIndex %>');" >Comment</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-size: 8pt;">
                                                                        <div id="momCommentParent<%# Container.ItemIndex %>">
                                                                        </div>
                                                                        <div id="momCommentsInfo<%# Container.ItemIndex %>" style="display: none; vertical-align: middle;">
                                                                            <div style="background-color:MistyRose;">
                                                                                <input id="momCommentsText<%# Container.ItemIndex %>" type="text" class="tbStyle" style="width: 98%;" />
                                                                            </div>
                                                                            <div style="text-align: right; top: 30px; background-color:MistyRose; text-indent: 10px;">
                                                                                <input type="button" class="btnStyle" value="Comment" onclick="addComments('momCommentParent<%# Container.ItemIndex %>', 'momCommentsText<%# Container.ItemIndex %>');" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>                                 
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="height:1pt; background-color: lightgrey;"></td>
                                        </tr>
                                    </table>
                                </div>
                            </ItemTemplate>
                        </asp:Repeater>
                        <div ID="momParent" runat="server">
                        </div>
                    </td>            
                </tr>
            </table>
        </ContentTemplate>
    </asp:UpdatePanel>
    </form>
</body>
</html>
