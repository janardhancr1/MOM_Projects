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

public partial class MOMBlogs_MOMBlogs : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        try
        {
            MOMBlogs momBlogs = new MOMBlogs();
            momBlogs.GetMOM_USR_BLGDataTable(out isSuccess, out appMessage, out sysMessage);

            if(isSuccess)
            {
                momBlogGridview.DataSource = momBlogs.MOM_USR_BLGDataTable.DefaultView;
                momBlogGridview.DataBind();
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
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }
}
