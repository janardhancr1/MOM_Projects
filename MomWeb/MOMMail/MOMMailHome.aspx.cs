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

public partial class MOMMail_MOMMailHome : System.Web.UI.Page
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
            int newMails = momMail.GetMOM_NEW_MAILS(out isSuccess, out appMessage, out sysMessage, "%" + ((MOMDataset.MOM_USRRow)Session["momUser"]).DISPLAY_NAME + "%");

            if (isSuccess)
            {
                if (newMails > 0)
                    NewMailsText.Text = "(<a href='MOMInbox.aspx'>" + newMails + "</a>) New Messages";
                else
                    NewMailsText.Text = "No New Messages";
            }
            else
            {
                NewMailsText.Text = "No New Messages";
            }
        }

    }
}
