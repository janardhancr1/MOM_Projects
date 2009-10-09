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

public partial class MOMBlogs_MOMCreateBlog : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

    }
    protected void momBlogCreate_Click(object sender, EventArgs e)
    {
        try
        {
            if(momBlogTitle.Text.Trim().Length < 5 || momBlogTitle.Text.Trim().Length > 100)
                throw new MOMException("Title should have minimum 5 and maximum of 100 characters.");

            if(momBlogContent.Value.Trim().Length < 20)
                throw new MOMException("Blog content shoud have minimu of 20 characters.");

            MOMBlogs momBlogs = new MOMBlogs();
            MOMDataset.MOM_BLGRow blogRow = momBlogs.MOM_BLGDataTable.NewMOM_BLGRow();

            blogRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            blogRow.TITLE = momBlogTitle.Text;
            blogRow.BLOG = momBlogContent.Value;
            blogRow.TAGS = momBlogTags.Text;
            blogRow.PRIVACY = momBlogPrivacy.Text;
            blogRow.ALLOW_COMMENTS = momBlogAllowComments.Checked;
            blogRow.EMAIL_STATUS = momBlogEmail.Checked;

            momBlogs.MOM_BLGRow = blogRow;
            momBlogs.AddMOM_BLGRow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                Response.Redirect("MOMBlogs.aspx");
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
    protected void momBlogCancel_Click(object sender, EventArgs e)
    {
        Response.Redirect("MOMBlogs.aspx");
    }
}
