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

public partial class MOMRecipe_MOMRecipeTopRated : System.Web.UI.Page
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
            try
            {
                MOMRecipe momRecipe = new MOMRecipe();
                momRecipe.GetMOM_RCP_TopRated(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {
                    if (momRecipe.MOM_RCPDataTable.Count > 0)
                    {
                        momRcpRpt.Visible = true;
                        momRcpRpt.DataSource = momRecipe.MOM_RCPDataTable.DefaultView;
                        momRcpRpt.DataBind();
                    }
                }
            }
            catch
            {
            }
        }
    }
}
