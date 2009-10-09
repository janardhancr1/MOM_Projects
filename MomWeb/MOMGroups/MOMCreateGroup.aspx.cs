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
using BOMomburbia;
using DALMomburbia;
using System.Data.SqlClient;

public partial class MOMGroups_MOMCreateGroup : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");
    }

    protected void momGroupCreate_Click(object sender, EventArgs e)
    {
        try
        {
            if (momGroupName.Text.Trim().Length < 5 || momGroupName.Text.Trim().Length > 30)
                throw new MOMException("Group name can have minimum 5 and maximum 30 characters");

            if (momGroupDescription.Text.Trim().Length < 5 || momGroupDescription.Text.Trim().Length > 500)
                throw new MOMException("Description can have minimum 5 and maximum of 500 characters");

            if (momGroupType.Text == "0")
                throw new MOMException("Please select group type");

            MOMGroup momGroup = new MOMGroup();
            MOMDataset.MOM_GRPRow momGroupRow = momGroup.MOM_GRPDataTable.NewMOM_GRPRow();
            momGroupRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momGroupRow.NAME = momGroupName.Text.Trim();
            momGroupRow.DESCRIPTION = momGroupDescription.Text;
            momGroupRow.TYPE = momGroupType.Text;
            momGroupRow.RECENT_NEWS = momGroupRecentNews.Text;
            momGroupRow.OFFICE = momGroupOffice.Text;
            momGroupRow.EMAIL_ADDR = momGroupEmail.Text;
            momGroupRow.STREET = momGroupStreet.Text;
            momGroupRow.CITY = momGroupCityTown.Text;

            momGroup.MOM_GRPRow = momGroupRow;
            momGroup.AddMOM_GRPRow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                RedirectToMOMGroups();
            }
            else
            {
                momPopup.Show(appMessage);
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void momGroupCancel_Click(object sender, EventArgs e)
    {
        RedirectToMOMGroups();
    }

    private void RedirectToMOMGroups()
    {
        Response.Redirect("MOMGroups.aspx");
    }
}
