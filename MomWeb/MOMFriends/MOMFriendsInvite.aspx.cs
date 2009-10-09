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

public partial class MOMFriends_MOMFriendsInvite : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!IsPostBack)
        {
            MOMDataset.MOM_USRRow momUserRow = (MOMDataset.MOM_USRRow)Session["momUser"];

            momUserFullName.Text = MOMHelper.HTMLEncode(momUserRow.FULL_NAME);
            momUserEmail.Text = MOMHelper.HTMLEncode(momUserRow.EMAIL_ADDR);
        }
    }
    protected void momFriendsInvite_Click(object sender, EventArgs e)
    {

    }
    protected void momFriendsCancel_Click(object sender, EventArgs e)
    {
        Response.Redirect("../MOMHome/MOMHome.aspx");
    }
}
