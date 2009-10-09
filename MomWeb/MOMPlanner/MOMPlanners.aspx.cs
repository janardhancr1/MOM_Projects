using System;
using System.Data;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using DALMomburbia;
using BOMomburbia;

public partial class MOMPlanner_MOMPlanners : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!IsPostBack)
        {
            momCalendarDay.Text = momPlannerCalendar.TodaysDate.Date.ToShortDateString();
        }
    }
    protected void momPlannerCalendar_SelectionChanged(object sender, EventArgs e)
    {
        momCalendarDay.Text = momPlannerCalendar.SelectedDate.Date.ToShortDateString();
    }
    protected void momPlannerCalendar_DayRender(object sender, DayRenderEventArgs e)
    {
        TableCell tCell = e.Cell;
        Image img = new Image();
        img.ImageUrl = "../images/Flower.gif";
        img.Width = 10;
        img.Height = 10;
        tCell.Controls.Add(img);
    }
}
