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

public partial class MOMMail_MOMSent : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        bool isSuccess;
        string appMessage;
        string sysMessage;

        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!IsPostBack)
        {
            MOMMail momMail = new MOMMail();
            MOMDataset.MOM_MAILRow momMailRow = momMail.MOM_MAILDataTable.NewMOM_MAILRow();
            momMailRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momMail.MOM_MAILRow = momMailRow;
            momMail.GetMOM_SEND_MAILS(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                if (momMail.MOM_MAILDataTable.Count > 0)
                {
                    momMailSent.DataSource = momMail.MOM_MAILDataTable.DefaultView;
                    momMailSent.DataBind();
                    NoMailsTable.Visible = false;
                }
                else
                {
                    NoMailsTable.Visible = true;
                }
            }
            else
            {
                NoMailsTable.Visible = true;
            }
        }
    }
}
