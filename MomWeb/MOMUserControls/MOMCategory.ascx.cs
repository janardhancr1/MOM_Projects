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
using System.Data.SqlClient;
using DALMomburbia;
using BOMomburbia;

public partial class MOMUserControls_MOMCategory : System.Web.UI.UserControl
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        try
        {
            MOMCategories momCategory = new MOMCategories();
            momCategory.GetMOM_CATTable(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                momCategoryRepeater.DataSource = momCategory.MOM_CATGTable.DefaultView;
                momCategoryRepeater.DataBind();
            }
            else
            {
                //todo show pop up 
            }
        }
        catch (Exception X)
        {

        }
    }
}
