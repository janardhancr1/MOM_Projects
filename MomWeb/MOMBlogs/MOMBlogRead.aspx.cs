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

public partial class MOMBlogs_MOMBlogRead : System.Web.UI.Page
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
                int momBlogId = int.Parse(MOMHelper.Decrypt(Request.QueryString["mBI"]));
                momBlogRemId.Text = Request.QueryString["mBI"];

                MOMBlogs momBlog = new MOMBlogs();
                momBlog.GetMOM_BLGAndMOM_BLG_CMTByMOM_BLG_ID(momBlogId, out isSuccess, out appMessage, out sysMessage);

                if (!isSuccess)
                    throw new MOMException(appMessage);

                momBlogTitle.Text = momBlog.MOM_BLG_MOM_BLG_CMTDataSet.Tables[0].Rows[0]["TITLE"].ToString();
                momBlogContent.Text = momBlog.MOM_BLG_MOM_BLG_CMTDataSet.Tables[0].Rows[0]["BLOG"].ToString();
                

                momBlogCommentRpt.DataSource = momBlog.MOM_BLG_MOM_BLG_CMTDataSet.Tables[1].DefaultView;
                momBlogCommentRpt.DataBind();
            }
            catch (MOMException X)
            {
            }
            catch (SqlException X)
            {
            }
            catch (Exception X)
            {
            }
            finally
            {
            }
        }
    }
    protected void momSubmitComment_Click(object sender, EventArgs e)
    {
        try
        {
            if (momCommentText.Text.Trim().Length < 5 || momCommentText.Text.Trim().Length > 100)
                throw new MOMException("Comment Text should have minimum 5 and maximum 100 characters");

            MOMBlogComment momBlogComment = new MOMBlogComment();
            MOMDataset.MOM_BLG_CMTRow momBlogRow = momBlogComment.MOM_BLG_CMTDataTable.NewMOM_BLG_CMTRow();

            momBlogRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momBlogRow.MOM_BLG_ID = int.Parse(MOMHelper.Decrypt(momBlogRemId.Text));
            momBlogRow.COMMENTS = momCommentText.Text;
            momBlogComment.MOM_BLG_CMTRow = momBlogRow;
            momBlogComment.AddMOM_BLG_CMTRow(out isSuccess, out appMessage, out sysMessage);

            Response.Redirect("../MOMBlogs/MOMBlogRead.aspx?mBI=" + momBlogRemId.Text);
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
}
