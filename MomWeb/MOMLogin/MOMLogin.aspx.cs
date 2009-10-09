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
using BOMomburbia;
using System.Data.SqlClient;

public partial class MOMLogin_MOMLogin : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!this.IsPostBack)
        {
            if (Request.QueryString["momUserID"] != null)
            {
                try
                {
                    MOMUsers activateUser = new MOMUsers();
                    activateUser.ActivateMOM_USRByID((string)Request.QueryString["momUserID"], out isSuccess, out appMessage, out sysMessage);
                }
                catch { }
            }
        }
    }
    protected void momLogin_Click(object sender, EventArgs e)
    {
        try
        {
            MOMDataset momDataset = new MOMDataset();
            MOMDataset.MOM_USRRow myMOM_USRRow = momDataset.MOM_USR.NewMOM_USRRow();
            myMOM_USRRow.EMAIL_ADDR = momEmail.Text;
            myMOM_USRRow.PASSWORD = momPassword.Text;

            MOMUsers checkUser = new MOMUsers();
            checkUser.MOM_USRRow = myMOM_USRRow;

            checkUser.LoginMOM_USRRow(momRemember.Checked, out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                Response.Redirect("../MOMHome/MOMHome.aspx");
            }
        }
        catch { }
    }
}
