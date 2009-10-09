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

public partial class MOMFriends_MOMRecent : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!IsPostBack)
        {
            //momFriendsRecent.Text = Request.QueryString["mR"];
            MOMFriend momFriend = new MOMFriend();
            momFriend.GetMOM_USR_FRNDDataTableByMOM_USR_ID(((MOMDataset.MOM_USRRow)Session["momUser"]).ID, out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                momUserFriends.DataSource = momFriend.MOM_USR_FRNDDataTable.DefaultView;
                momUserFriends.DataBind();
            }
            else
            {
                //show pop up
            }
        }
    }
}
