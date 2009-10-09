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

public partial class MOMGroups_MOMGroups : System.Web.UI.Page
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
            MOMGroup momGroup = new MOMGroup();
            momGroup.GetMOM_GRPByMOM_USR_IDAndMOM_GRP_USRByMOM_USR_FRND(out isSuccess, out appMessage, out sysMessage);

            momYourGroups.DataSource = momGroup.MOM_GRPDataTable.DefaultView;
            momYourGroups.DataBind();

            momFriendsGroups.DataSource = momGroup.MOM_GRP_USRDataTable;
            momFriendsGroups.DataBind();
        }
    }
}
