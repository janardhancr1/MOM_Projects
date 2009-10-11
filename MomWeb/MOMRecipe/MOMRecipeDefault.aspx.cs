using System;
using System.Data.SqlClient;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using AjaxControlToolkit;
using BOMomburbia;
using DALMomburbia;

public partial class MOMRecipe_MOMRecipeDefault : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if(!IsPostBack)
        {
            try
            {
                int momRecipeID = Int32.Parse(MOMHelper.Decrypt(Request.QueryString["mrcpid"]));
                momRcpIDHide.Text = Request.QueryString["mrcpid"];

                MOMRecipe momRecipe = new MOMRecipe();
                MOMDataset.MOM_RCPRow momRcpRow = momRecipe.MOM_RCPDataTable.NewMOM_RCPRow();
                momRcpRow.ID = momRecipeID;
                momRecipe.MOM_RCPRow = momRcpRow;

                momRecipe.AddMOM_RCP_VIEWS(out isSuccess, out appMessage, out sysMessage);

                momRecipe.GetMOM_RCPBy_ID(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {
                    momRcpName.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.NAME);
                    momRcpDescription.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.NAME);
                    momRcpDifficulty.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.DIFFICULTY);
                    momRcpIngredients.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.INGREDIENTS);
                    momRcpMethod.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.METHOD);
                    momRcpPrepTM.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.PREP_TM);
                    momRcpCookTM.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.COOK_TM);
                    momRcpServTO.Text = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.SERVE_TO);
                    momRcpTags.Text = MOMHelper.HTMLEncode(momRecipe.MOM_TAGSRow.TAGS);
                    momRcpPhoto.ImageUrl = MOMHelper.HTMLEncode(momRecipe.MOM_RCPRow.PHOTO);

                    Rating2.CurrentRating = momRecipe.MOM_RCPRow.RATING;

                    MOMRecipeComments momRecipeComments = new MOMRecipeComments();
                    MOMDataset.MOM_RCP_CMTRow momRcpCMTRow = momRecipeComments.MOM_RCP_CMTDataTable.NewMOM_RCP_CMTRow();
                    momRcpCMTRow.MOM_RCP_ID = momRecipeID;
                    momRecipeComments.MOM_RCP_CMTRow = momRcpCMTRow;

                    momRecipeComments.GetMOM_RCP_CMT_BY_RCP_ID(out isSuccess, out appMessage, out sysMessage);
                    if(isSuccess)
                    {
                        NoCommentsPanel.Visible = false;
                        momCommentsRpt.DataSource = momRecipeComments.MOM_RCP_CMTDataTable.DefaultView;
                        momCommentsRpt.DataBind();
                    }
                    else
                    {
                        NoCommentsPanel.Visible = true;
                    }
                }
            }
            catch
            { }
        }
    }

    protected void momSubmitComment_Click(object sender, EventArgs e)
    {
        try
        {
            if (momCommentText.Text.Trim().Length < 5 || momCommentText.Text.Trim().Length > 100)
                throw new MOMException("Comment Text should have minimum 5 and maximum 100 characters");

            MOMRecipeComments momRecipeComents = new MOMRecipeComments();
            MOMDataset.MOM_RCP_CMTRow momRcpCMTRow = momRecipeComents.MOM_RCP_CMTDataTable.NewMOM_RCP_CMTRow();

            momRcpCMTRow.MOM_RCP_ID = Int32.Parse(MOMHelper.Decrypt(momRcpIDHide.Text));
            momRcpCMTRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momRcpCMTRow.COMMENTS = momCommentText.Text;

            momRecipeComents.MOM_RCP_CMTRow = momRcpCMTRow;
            momRecipeComents.AddMOM_RCP_CMTRow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                RedirectToMOMRecipes();
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

    protected void Rating_Changed(object sender, RatingEventArgs e)
    {
        //e.CallbackResult = "Update done. Value = " + e.Value + " Tag = " + e.Tag;
        try
        {
            MOMRecipe momRecipe = new MOMRecipe();
            MOMDataset.MOM_RCPRow momRcpRow = momRecipe.MOM_RCPDataTable.NewMOM_RCPRow();
            momRcpRow.ID = Int32.Parse(MOMHelper.Decrypt(momRcpIDHide.Text));
            momRcpRow.RATING = Int32.Parse(e.Value);
            momRecipe.MOM_RCPRow = momRcpRow;

            momRecipe.AddMOM_RCP_RATING(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                RedirectToMOMRecipes();
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

    private void RedirectToMOMRecipes()
    {
        Response.Redirect("MOMRecipeDefault.aspx?mrcpid=" + momRcpIDHide.Text);
    }
}
