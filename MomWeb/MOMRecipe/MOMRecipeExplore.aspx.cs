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
using App_Code.TagView;
using BOMomburbia;
using DALMomburbia;

public partial class MOMRecipe_MOMRecipeExplore : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        PopulateTagControl(TagCtl);
    }

    virtual protected void PopulateTagControl(PopularTagCtl tagCtl)
    {
        // set popular tags data and render method
        tagCtl.Data = TagData.Get(MOMHelper.MOM_RECIPE_NAMESPACE, 100, false);
        tagCtl.Display = "list";

    }

}
