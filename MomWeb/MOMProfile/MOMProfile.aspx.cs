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

public partial class MOMProfile_MOMProfile : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        MOMUsers momUsers = new MOMUsers();
        momUsers.GetUserByName(out isSuccess, out appMessage, out sysMessage, ((MOMDataset.MOM_USRRow)Session["momUser"]).DISPLAY_NAME);
        if (isSuccess)
        {
            momFirstName.Text = momUsers.MOM_USRRow.FIRST_NAME;
            momLastName.Text = momUsers.MOM_USRRow.LAST_NAME;
            momEmail.Text = momUsers.MOM_USRRow.EMAIL_ADDR;
            momZipCode.Text = momUsers.MOM_USRRow.ZIP;
            momLocation.Text = momUsers.MOM_USRRow.LOCATION;
            momCountry.SelectedValue = momUsers.MOM_USRRow.COUNTRY;
            momDisplayName.Text = momUsers.MOM_USRRow.DISPLAY_NAME;
        }

        MOMKids momKids = new MOMKids();
        MOMDataset.MOM_KIDSRow kidsRow = momKids.MOM_KIDSDataTable.NewMOM_KIDSRow();
        kidsRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow) Session["momUser"]).ID;
        momKids.GetMOM_KidsBy_UsrID(out isSuccess, out appMessage, out sysMessage);
        if(isSuccess)
        {
            momKidsGrid.DataSource = momKids.MOM_KIDSDataTable;
            momKidsGrid.DataBind();
        }
    }

    protected void ChangeMenu(object sender, EventArgs e)
    {
        string s = ((HtmlAnchor)sender).Name;
        MultiView1.ActiveViewIndex = Int32.Parse(s);
    }

    protected void AddChild_Click(object sender, EventArgs e)
    {
        
    }
}
