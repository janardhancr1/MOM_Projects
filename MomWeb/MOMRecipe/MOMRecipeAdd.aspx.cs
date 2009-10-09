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
using BOMomburbia;
using DALMomburbia;

public partial class MOMRecipe_MOMRecipeAdd : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");
    }

    protected void momRcpAdd_Click(object sender, EventArgs e)
    {
        try
        {
            if (momRcpName.Text.Trim().Length < 5 || momRcpName.Text.Trim().Length > 100)
                throw new MOMException("Receipe name can have minimum 5 and maximum 100 characters");

            if (momRcpDescription.Text.Trim().Length < 5 || momRcpDescription.Text.Trim().Length > 255)
                throw new MOMException("Description can have minimum 5 and maximum of 255 characters");

            if (momRcpIngredients.Text.Trim().Length ==0 )
                throw new MOMException("Please enter the Ingredients details");

            if (momRcpMethod.Text.Trim().Length == 0)
                throw new MOMException("Please enter the Method details");

            MOMRecipe momRecipe = new MOMRecipe();
            MOMDataset.MOM_RCPRow momRcpRow = momRecipe.MOM_RCPDataTable.NewMOM_RCPRow();
            momRcpRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momRcpRow.NAME = momRcpName.Text;
            momRcpRow.DESCRIPTION = momRcpDescription.Text;
            if (momRcpPhoto.Text.Trim().Length > 0) momRcpRow.PHOTO = momRcpPhoto.Text;
            if (momRcpTags.Text.Trim().Length > 0) momRcpRow.TAGS = momRcpTags.Text;
            if (momRcpPrepTM.Text.Trim().Length > 0) momRcpRow.PREP_TM = momRcpPrepTM.Text;
            if (momRcpCookTM.Text.Trim().Length > 0) momRcpRow.COOK_TM = momRcpCookTM.Text;
            if (momRcpServTO.Text.Trim().Length > 0) momRcpRow.SERVE_TO = momRcpServTO.Text;
            momRcpRow.DIFFICULTY = momRcpDifficulty.SelectedValue;
            momRcpRow.INGREDIENTS = momRcpIngredients.Text;
            momRcpRow.METHOD = momRcpMethod.Text;

            momRcpRow.VEGE = momRcpVege.Checked;
            momRcpRow.VEGAN = momRcpVegan.Checked;
            momRcpRow.DAIRY = momRcpDairy.Checked;
            momRcpRow.GLUTEN = momRcpGluten.Checked;
            momRcpRow.NUT = momRcpNut.Checked;
            momRcpRow.ALLOW = momRcpAllow.Checked;

            momRecipe.MOM_RCPRow = momRcpRow;
            momRecipe.AddMOM_RCPRow(out isSuccess, out appMessage, out sysMessage);

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

    protected void momRcpCancel_Click(object sender, EventArgs e)
    {
        RedirectToMOMRecipes();
    }

    private void RedirectToMOMRecipes()
    {
        Response.Redirect("MOMRecipesHome.aspx");
    }
}
