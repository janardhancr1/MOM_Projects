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

public partial class MOMRecipe_MOMRecipeSearch : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

    }

    protected void Search_Click(object sender, EventArgs e)
    {
        try
        {
            MOMRecipe momRecipe = new MOMRecipe();
            MOMDataset.MOM_RCPRow momRcpRow = momRecipe.MOM_RCPDataTable.NewMOM_RCPRow();

            momRcpRow.NAME = SearchKW.Text + "%";
            momRcpRow.DIFFICULTY = momRcpDifficulty.SelectedValue;
            momRcpRow.INGREDIENTS = "False";
            if (momRcpIngre.Checked) momRcpRow.INGREDIENTS = "True";
            if (momRcpVege.Checked) momRcpRow.VEGE = true;
            if (momRcpVegan.Checked) momRcpRow.VEGAN = true;
            if (momRcpDairy.Checked) momRcpRow.DAIRY = true;
            if (momRcpGluten.Checked) momRcpRow.GLUTEN = true;
            if (momRcpNut.Checked) momRcpRow.NUT  = true;
            if (momRcpPhoto.Checked) momRcpRow.PHOTO  = "True";

            momRecipe.MOM_RCPRow = momRcpRow;
            momRecipe.GetMOM_RCPs(out isSuccess, out appMessage, out sysMessage);
            
            if (isSuccess)
            {
                if (momRecipe.MOM_RCPDataTable.Count > 0)
                {
                    momRcpRpt.Visible = true;
                    momRcpRpt.DataSource = momRecipe.MOM_RCPDataTable.DefaultView;
                    momRcpRpt.DataBind();
                    NoDateTable.Visible = false;
                }
                else
                {
                    momRcpRpt.Visible = false;
                    NoDateTable.Visible = true;   
                }
            }
            else
            {
                momRcpRpt.Visible = false;
                NoDateTable.Visible = true;    
            }
        }
        catch
        {
        }
    }
}
