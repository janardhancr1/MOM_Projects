<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMPlanners.aspx.cs" Inherits="MOMPlanner_MOMPlanners" %>
<%@ Register Src="~/MOMUserControls/MOMCategory.ascx" TagName="momCategory" TagPrefix="mc" %>
<%@ Register TagPrefix="pc" TagName="profileControl" Src="~/MOMUserControls/ProfileMenu.ascx" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table cellpadding="3" cellspacing="0" width="100%">
        <tr>
            <td style="width:400px;">
                <asp:Calendar ID="momPlannerCalendar" runat="server" Font-Names="Tahoma" Font-Size="8pt" Height="200px"
                        Width="400px" BackColor="White" BorderColor="White" BorderWidth="1px" ForeColor="Black" NextPrevFormat="FullMonth" OnDayRender="momPlannerCalendar_DayRender" OnSelectionChanged="momPlannerCalendar_SelectionChanged">
                        <SelectedDayStyle BackColor="Gray" ForeColor="White" />
                        <TodayDayStyle BackColor="#CCCCCC" />
                        <OtherMonthDayStyle ForeColor="#999999" />
                        <NextPrevStyle Font-Bold="True" Font-Size="8pt" ForeColor="#333333" VerticalAlign="Bottom" />
                        <DayHeaderStyle Font-Bold="True" Font-Size="8pt" />
                        <TitleStyle BackColor="White" BorderColor="White" BorderWidth="4px" Font-Bold="True"
                            Font-Size="12pt" ForeColor="#333399" />
                </asp:Calendar>
            </td>
            <td width="100%" align="center" style="font-size: 10pt; vertical-align: top; font-weight: bolder;">
                Events for&nbsp;<asp:Label ID="momCalendarDay" runat="server"></asp:Label><hr />
            </td>
        </tr>
        <tr>
            <td>
                
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
    <table>
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>
