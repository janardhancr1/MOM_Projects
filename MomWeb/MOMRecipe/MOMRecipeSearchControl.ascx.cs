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

public partial class MOMRecipe_MOMRecipeSearchControl : System.Web.UI.UserControl
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        try
        {
            MOMRecipe momRecipe = new MOMRecipe();
            MOMDataset.MOM_RCPRow momRcpRow = momRecipe.MOM_RCPDataTable.NewMOM_RCPRow();

            momRcpRow.NAME = searchRow.NAME;
            momRcpRow.DIFFICULTY = searchRow.DIFFICULTY;
            momRcpRow.INGREDIENTS = searchRow.INGREDIENTS;
            momRcpRow.VEGE = searchRow.VEGE;
            momRcpRow.VEGAN = searchRow.VEGAN;
            momRcpRow.DAIRY = searchRow.DAIRY;
            momRcpRow.GLUTEN = searchRow.GLUTEN;
            momRcpRow.NUT = searchRow.NUT;
            momRcpRow.PHOTO = searchRow.PHOTO;

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

    protected bool ShowRating(string rating)
    {
        int cnt = Convert.ToInt32(rating);
        return cnt == 0 ? false : true;
    }

    protected string GetRatings(string rating)
    {
        int cnt = Convert.ToInt32(rating);
        return cnt == 0 ? MOMHelper.HTMLEncode("No Rating") : MOMHelper.HTMLEncode(cnt + " Ratings");
    }

    protected string GetViews(string viewCont)
    {
        int cnt = Convert.ToInt32(viewCont);
        return cnt == 0 ? MOMHelper.HTMLEncode("No Views") : MOMHelper.HTMLEncode(cnt + " Views");
    }

    protected string GetComments(string commentCount)
    {
        int cnt = Convert.ToInt32(commentCount);
        return cnt == 0 ? MOMHelper.HTMLEncode("No Comments") : MOMHelper.HTMLEncode(cnt + " Comments");
    }

    private MOMDataset.MOM_RCPRow searchRow;
    public MOMDataset.MOM_RCPRow SearchRow
    {
        get { return searchRow; }
        set { searchRow = value; }
    }
    
}

