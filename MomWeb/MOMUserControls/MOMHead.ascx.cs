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

public partial class MOMUserControls_MOMHead : System.Web.UI.UserControl
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        Response.Expires = -1;
        Response.CacheControl = "no-cache";
        Response.Buffer = true;

        if (!Page.IsPostBack)
        {
            MOMDataset.MOM_USRRow momUser = (MOMDataset.MOM_USRRow)Session["momUser"];
            momUserName.Text = MOMHelper.HTMLEncode(momUser.FULL_NAME);
        }
    }

    protected void momLogout_Click(object sender, EventArgs e)
    {
        Session.Abandon();
        Response.Redirect("../MOMIndex.aspx");
    }
    protected void momViewMessageInbox_Click(object sender, EventArgs e)
    {
        Response.Redirect("../MOMMail/MOMInbox.aspx");
    }
    protected void momComposeMessage_Click(object sender, EventArgs e)
    {
        Response.Redirect("../MOMMail/MOMCompose.aspx");
    }
    protected void momRecentlyAddedFriends_Click(object sender, EventArgs e)
    {
        Response.Redirect("../MOMFriends/MOMFriendsRecent.aspx?mR=R");
    }
    protected void momAllFriends_Click(object sender, EventArgs e)
    {
        Response.Redirect("../MOMFriends/MOMFriendsRecent.aspx?mR=A");
    }
    protected void momInviteFriends_Click(object sender, EventArgs e)
    {
        Response.Redirect("../MOMFriends/MOMFriendsInvite.aspx");
    }
    protected void momFindFriends_Click(object sender, EventArgs e)
    {
        Response.Redirect("../MOMFriends/MOMFriendsFind.aspx");
    }
}
