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

public partial class MOMRecipe_MOMRecipeSearchControl : System.Web.UI.UserControl
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        //if (((MOMRecipe_MOMRecipeSearch)(this.Page)).SearchResults)
        //{
        //    try
        //    {
        //        MOMRecipe momRecipe = new MOMRecipe();
        //        MOMDataset.MOM_RCPRow momRcpRow = momRecipe.MOM_RCPDataTable.NewMOM_RCPRow();

        //        momRcpRow.NAME = ((MOMRecipe_MOMRecipeSearch)(this.Page)).KeyWord;
        //        momRcpRow.DIFFICULTY = ((MOMRecipe_MOMRecipeSearch)(this.Page)).Difficulty;
        //        momRcpRow.VEGE = ((MOMRecipe_MOMRecipeSearch)(this.Page)).Vege;
        //        momRcpRow.VEGAN = ((MOMRecipe_MOMRecipeSearch)(this.Page)).Vegan;
        //        momRcpRow.DAIRY = ((MOMRecipe_MOMRecipeSearch)(this.Page)).DairyFree;
        //        momRcpRow.GLUTEN = ((MOMRecipe_MOMRecipeSearch)(this.Page)).Gluten;
        //        momRcpRow.NUT = ((MOMRecipe_MOMRecipeSearch)(this.Page)).Nut;
        //        momRcpRow.PHOTO = ((MOMRecipe_MOMRecipeSearch)(this.Page)).Photo;
        //        momRcpRow.INGREDIENTS = ((MOMRecipe_MOMRecipeSearch)(this.Page)).Ingredients;

        //        momRecipe.MOM_RCPRow = momRcpRow;
        //        momRecipe.GetMOM_RCPs(out isSuccess, out appMessage, out sysMessage);

        //        if (isSuccess)
        //        {
        //            momRcpRpt.DataSource = momRecipe.MOM_RCP_SEARCHDataTable.DefaultView;
        //            momRcpRpt.DataBind();
        //        }
        //    }
        //    catch
        //    {
        //    }
        //}
    }

    private bool searchResults;
    public bool SearchResults
    {
        get { return searchResults; }
        set { searchResults = value; }
    }

    private string keyWord;
    public string KeyWord
    {
        get { return keyWord; }
        set { keyWord = value; }
    }

    private string difficulty;
    public string Difficulty
    {
        get { return difficulty; }
        set { difficulty = value; }
    }

    private bool vege;
    public bool Vege
    {
        get { return vege; }
        set { vege = value; }
    }

    private bool vegan;
    public bool Vegan
    {
        get { return vegan; }
        set { vegan = value; }
    }

    private bool dairyFree;
    public bool DairyFree
    {
        get { return dairyFree; }
        set { dairyFree = value; }
    }

    private bool gluten;
    public bool Gluten
    {
        get { return gluten; }
        set { gluten = value; }
    }

    private bool nut;
    public bool Nut
    {
        get { return nut; }
        set { nut = value; }
    }

    private string photo;
    public string Photo
    {
        get { return photo; }
        set { photo = value; }
    }

    private string ingredients;
    public string Ingredients
    {
        get { return ingredients; }
        set { ingredients = value; }
    }
    
}

